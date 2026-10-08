#!/usr/bin/env bash
# Verify: lint all theme PHP + assert the SEO/lead invariants we must never break.
# Usage: bash scripts/verify.sh
set -uo pipefail
cd "$(dirname "$0")/.."

THEME="wp-content/themes/dental"
fail=0

note() { echo "FAIL: $*"; fail=1; }

# 1) PHP lint of the whole theme (~1s).
while IFS= read -r file; do
  out=$(php -l "$file" 2>&1)
  case "$out" in
    *"No syntax errors"*) : ;;
    *) note "php -l $file"; echo "$out" ;;
  esac
done < <(find "$THEME" -name '*.php' -not -path '*/node_modules/*')

# 2) Lead form endpoint must stay reachable for logged-out visitors (revenue path).
grep -q "add_action('wp_ajax_send_popup_form'" "$THEME/functions.php" \
  || note "wp_ajax_send_popup_form unregistered in $THEME/functions.php"
grep -q "add_action('wp_ajax_nopriv_send_popup_form'" "$THEME/functions.php" \
  || note "wp_ajax_nopriv_send_popup_form unregistered — logged-out users stop sending leads"

# 3) NAP data must be sourced from one function only (no address/phone drift).
grep -q "function liderdent_seo_clinic_nap" "$THEME/inc/seo.php" \
  || note "liderdent_seo_clinic_nap() disappeared from $THEME/inc/seo.php"

# 4) Home hero H1 wording is a deliberate SEO decision — don't rewrite silently.
grep -q "Стоматология в Красноярске" "$THEME/home.php" \
  || note "home H1 (\"Стоматология в Красноярске\") changed in $THEME/home.php — was it approved?"

# 5) The global popups back all Metrika goals (form_open / form_start).
for f in "$THEME/header.php" "$THEME/header-home.php"; do
  for c in popup-callback popup-credit; do
    grep -q "id=\"$c\"" "$f" || note "$f lost #$c (Metrika form goals die without it)"
  done
done
grep -q "open-popup-callback" "$THEME/footer.php" \
  || note "$THEME/footer.php lost the .open-popup-callback trigger"

# 6) Virtual /services-sitemap.xml + AIOSEO index wiring (price-SKU cleanup depends on it).
grep -q "function liderdent_serve_services_sitemap" "$THEME/inc/seo.php" \
  || note "services sitemap renderer removed from $THEME/inc/seo.php"
grep -q "aioseo_sitemap_indexes" "$THEME/inc/seo.php" \
  || note "aioseo_sitemap_indexes filter removed from $THEME/inc/seo.php"

# 7) No secrets committed.
if grep -rqiE "(AKIA[0-9A-Z]{16}|password\s*=\s*['\"][^'\"]{6,})" "$THEME" --include='*.php'; then
  note "possible credential literal found in theme PHP"
fi

if [ "$fail" -eq 0 ]; then
  echo "verify OK — theme PHP lints clean, lead + SEO invariants intact"
fi
exit "$fail"

#!/usr/bin/env bash
set -euo pipefail

TARGET="${1:?usage: security-scan.sh <wp-root> [scan-only|cleanup]}"
MODE="${2:-scan-only}"

if [[ "$MODE" != "scan-only" && "$MODE" != "cleanup" ]]; then
	echo "ERROR: mode must be scan-only or cleanup"
	exit 2
fi

MUDIR="$TARGET/wp-content/mu-plugins"
THEME="$TARGET/wp-content/themes/dental"
FINDINGS=0

note_finding() {
	echo "FINDING: $*"
	FINDINGS=$((FINDINGS + 1))
}

echo "=== Security scan: $TARGET (mode=$MODE) ==="

echo "::group::Known mu-plugin spam files"
for known in perf-cache.php pbn-snip.php; do
	path="$MUDIR/$known"
	if [ -f "$path" ]; then
		note_finding "known mu-plugin present: $path"
		if [ "$MODE" = "cleanup" ]; then
			rm -f "$path"
			echo "removed: $path"
		fi
	else
		echo "ok: $path absent"
	fi
done
echo "mu-plugins dir:"
ls -la "$MUDIR/" 2>/dev/null || echo "(no mu-plugins dir)"
echo "::endgroup::"

echo "::group::Filesystem scan (theme + plugins + mu-plugins + uploads)"
SCAN_PATHS=("$THEME" "$MUDIR" "$TARGET/wp-content/plugins" "$TARGET/wp-content/uploads")
while IFS= read -r infected; do
	[ -z "$infected" ] && continue
	note_finding "php contains pixiupbn: $infected"
	if [ "$MODE" = "cleanup" ]; then
		if [[ "$infected" == "$THEME/"* ]]; then
			echo "skip quarantine in theme (use deploy rsync): $infected"
		else
			mv "$infected" "${infected}.quarantine.$(date +%s)" 2>/dev/null || rm -f "$infected"
			echo "quarantined: $infected"
		fi
	fi
done < <(grep -rl 'pixiupbn' "${SCAN_PATHS[@]}" --include='*.php' 2>/dev/null || true)
echo "::endgroup::"

echo "::group::Database scan"
cd "$TARGET"

echo "wp_options:"
OPTIONS="$(wp --allow-root db query "SELECT option_name FROM wp_options WHERE option_value LIKE '%pixiupbn%'" --skip-column-names 2>/dev/null || true)"
if [ -n "$OPTIONS" ]; then
	while IFS= read -r option_name; do
		[ -z "$option_name" ] && continue
		note_finding "wp_options contains pixiupbn: $option_name"
	done <<< "$OPTIONS"
else
	echo "ok: no pixiupbn in wp_options"
fi

echo "wp_posts:"
POSTS="$(wp --allow-root db query "SELECT ID, post_type, post_title FROM wp_posts WHERE post_content LIKE '%pixiupbn%'" --skip-column-names 2>/dev/null || true)"
if [ -n "$POSTS" ]; then
	while IFS=$'\t' read -r id post_type post_title; do
		[ -z "$id" ] && continue
		note_finding "wp_posts contains pixiupbn: ID=$id type=$post_type title=$post_title"
	done <<< "$POSTS"
else
	echo "ok: no pixiupbn in wp_posts"
fi

if [ "$MODE" = "cleanup" ]; then
	wp --allow-root db query "UPDATE wp_options SET option_value = REPLACE(option_value, '<div style=\"display:none\"><a href=\"https://pixiupbn.com\" rel=\"dofollow\">pixiupbn</a></div>', '') WHERE option_value LIKE '%pixiupbn%'" 2>/dev/null || true
	wp --allow-root db query "UPDATE wp_options SET option_value = REPLACE(option_value, '<div style=display:none><a href=https://pixiupbn.com rel=dofollow>pixiupbn</a></div>', '') WHERE option_value LIKE '%pixiupbn%'" 2>/dev/null || true
	wp --allow-root db query "UPDATE wp_options SET option_value = REPLACE(option_value, '<span class=\"blogroll\" style=\"font-size:12px\"><a href=\"https://pixiupbn.com\">pixiupbn</a></span>', '') WHERE option_value LIKE '%pixiupbn%'" 2>/dev/null || true
	wp --allow-root db query "UPDATE wp_options SET option_value = REPLACE(option_value, '<!-- blogroll -->', '') WHERE option_value LIKE '%pixiupbn%'" 2>/dev/null || true
	wp --allow-root db query "UPDATE wp_posts SET post_content = REPLACE(post_content, '<div style=\"display:none\"><a href=\"https://pixiupbn.com\" rel=\"dofollow\">pixiupbn</a></div>', '') WHERE post_content LIKE '%pixiupbn%'" 2>/dev/null || true
	wp --allow-root db query "UPDATE wp_posts SET post_content = REPLACE(post_content, '<span class=\"blogroll\" style=\"font-size:12px\"><a href=\"https://pixiupbn.com\">pixiupbn</a></span>', '') WHERE post_content LIKE '%pixiupbn%'" 2>/dev/null || true

	wp --allow-root cache flush --quiet 2>/dev/null || true
	rm -rf "$TARGET/wp-content/cache/supercache/"* 2>/dev/null || true
	echo "cleanup applied, cache flushed"
fi
echo "::endgroup::"

echo "=== Summary: findings=$FINDINGS mode=$MODE ==="
if [ "$FINDINGS" -gt 0 ]; then
	exit 1
fi

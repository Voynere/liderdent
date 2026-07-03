#!/usr/bin/env bash
set -euo pipefail

ROOT="${1:?usage: verify-deploy-bundle.sh <bundle-root>}"
LABEL="${2:-bundle}"

require_file() {
	local rel="$1"
	if [ ! -f "$ROOT/$rel" ]; then
		echo "[$LABEL] ERROR: missing $rel"
		exit 1
	fi
}

require_dir() {
	local rel="$1"
	if [ ! -d "$ROOT/$rel" ]; then
		echo "[$LABEL] ERROR: missing directory $rel"
		exit 1
	fi
}

require_dir "wp-content/themes/dental"
require_file "wp-content/themes/dental/functions.php"
require_file "wp-content/themes/dental/style.css"

echo "[$LABEL] OK: dental theme bundle"

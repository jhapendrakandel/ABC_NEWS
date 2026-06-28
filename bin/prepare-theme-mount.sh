#!/usr/bin/env bash
# Symlink the live ABC_News theme source into ./themedata so Docker picks up changes immediately.
set -euo pipefail
SCRIPT_DIR="$(cd "$(dirname "$0")" && pwd)"
TARGET="${SCRIPT_DIR}/themedata"
SOURCE="${SCRIPT_DIR}"

rm -rf "${TARGET}"
ln -s "${SOURCE}" "${TARGET}"
echo "[prepare] themedata -> ${SOURCE}"

#!/usr/bin/env bash
set -euo pipefail

TAG="${1:-latest}"
WP_URL="https://wordpress.org/wordpress-${TAG}.tar.gz"
CORE_DIR="/var/www/html"
TMP="$(mktemp -d)"

echo "[bootstrap] Downloading WordPress ${TAG} from ${WP_URL}"
curl -fsSL "${WP_URL}" -o "${TMP}/wordpress.tar.gz"

echo "[bootstrap] Extracting"
tar -xzf "${TMP}/wordpress.tar.gz" -C "${TMP}"

echo "[bootstrap] Copying core files into ${CORE_DIR}"
cp -r "${TMP}/wordpress/." "${CORE_DIR}/"

echo "[bootstrap] Cleanup"
rm -rf "${TMP}"

echo "[bootstrap] Done. WordPress core is in ${CORE_DIR}"

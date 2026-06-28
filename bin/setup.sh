#!/usr/bin/env bash
set -euo pipefail

# One-time setup script for the ABC WordPress stack.
# Run this AFTER `docker compose up -d` once the containers are healthy.

COMPOSE_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
cd "${COMPOSE_DIR}"

WP="docker compose exec -T wordpress wp-cli"

echo "[setup] Waiting for MariaDB to accept connections..."
for i in $(seq 1 30); do
  if docker compose exec -T wordpress php -r 'exit(@fsockopen("mariadb", 3306) ? 0 : 1);' 2>/dev/null; then
    echo "[setup] MariaDB is reachable."
    break
  fi
  sleep 2
done

echo "[setup] Downloading WordPress core into the volume..."
docker compose exec -T wordpress bash /usr/local/bin/bootstrap-wp-core.sh latest

echo "[setup] Ensuring wp-config.php is in place..."
if ! docker compose exec -T wordpress test -f /var/www/html/wp-config.php; then
  echo "[setup] wp-config.php missing — copying from repo..."
  docker compose exec -T wordpress tee /var/www/html/wp-config.php < ./wp-config.php >/dev/null
fi

echo "[setup] Installing WordPress..."
$WP core install \
  --url="http://192.168.1.78:8085" \
  --title="ABC News Nepal (Local)" \
  --admin_user=admin \
  --admin_password=admin123 \
  --admin_email=admin@abc.local \
  --skip-email \
  --allow-root

echo "[setup] Activating ABC News theme..."
$WP theme activate abc-news --allow-root || true

echo "[setup] Creating categories..."
for slug in news politics business opinion international_news sports english-special province; do
  $WP term create category "${slug}" --allow-root >/dev/null 2>&1 || true
done
for slug in provincial_koshi provincial_madesh provincial_gandaki provincial_lumbini; do
  $WP term create category "${slug}" --allow-root >/dev/null 2>&1 || true
done

echo "[setup] Creating pages with templates..."
$WP post create --post_type=page --post_title='Main News' --post_name='main-news' --post_status=publish --porcelain --allow-root >/dev/null
$WP post create --post_type=page --post_title='Live Update' --post_name='live-update' --post_status=publish --porcelain --allow-root >/dev/null
$WP post create --post_type=page --post_title='Latest News' --post_name='latest-news' --post_status=publish --porcelain --allow-root >/dev/null

echo "[setup] Assigning page templates..."
MAIN_ID=$($WP post list --post_type=page --name=main-news --field=ID --allow-root | tail -1)
LIVE_ID=$($WP post list --post_type=page --name=live-update --field=ID --allow-root | tail -1)
LATEST_ID=$($WP post list --post_type=page --name=latest-news --field=ID --allow-root | tail -1)
$WP post meta update "${MAIN_ID}" _wp_page_template 'index.php' --allow-root 2>/dev/null || true
$WP post meta update "${LIVE_ID}" _wp_page_template 'page-live-update.php' --allow-root 2>/dev/null || true
$WP post meta update "${LATEST_ID}" _wp_page_template 'updates.php' --allow-root 2>/dev/null || true

echo "[setup] Creating a primary menu..."
MENU_ID=$($WP menu create main-menu --porcelain --allow-root 2>/dev/null || $WP menu list --format=ids --allow-root | head -1)
$WP menu item add-post main-menu "$MAIN_ID" --title='Main News' --allow-root 2>/dev/null || true
$WP menu item add-post main-menu "$LIVE_ID" --title='Live Update' --allow-root 2>/dev/null || true
$WP menu item add-post main-menu "$LATEST_ID" --title='Latest News' --allow-root 2>/dev/null || true
$WP menu location assign main-menu main-menu --allow-root 2>/dev/null || true

echo "[setup] Flushing rewrite rules..."
$WP rewrite structure '/%postname%/' --hard --allow-root
$WP rewrite flush --hard --allow-root

echo "[setup] Creating sample posts..."
for i in 1 2 3 4 5 6 7 8 9 10; do
  $WP post create --post_title="Sample News Story ${i}" --post_content="This is sample content for story ${i}." --post_status=publish --post_category=1 --allow-root >/dev/null 2>&1 || true
done

echo ""
echo "[setup] Done."
echo "Frontend : http://192.168.1.78:8085"
echo "Admin    : http://192.168.1.78:8085/wp-admin"
echo "Login    : admin / admin123"

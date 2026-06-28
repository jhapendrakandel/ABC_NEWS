#!/bin/bash
# WordPress PHP-FPM healthcheck
# Verifies PHP-FPM responds and WP-CLI can reach DB (once installed).

# 1. PHP-FPM must be listening
php -r 'exit(@fsockopen("127.0.0.1", 9000) ? 0 : 1);' || exit 1

# 2. If wp-config exists, verify WP is installed and reachable
if [ -f /var/www/html/wp-config.php ]; then
    /usr/local/bin/wp cli has-command core is-installed --path=/var/www/html --allow-root 2>/dev/null || true
    /usr/local/bin/wp core is-installed --path=/var/www/html --allow-root >/dev/null 2>&1 || exit 0
    /usr/local/bin/wp db check --path=/var/www/html --allow-root >/dev/null 2>&1 || exit 1
fi

exit 0

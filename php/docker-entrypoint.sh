#!/bin/sh
set -e

USERS_DIR=/var/www/html/public/assets/img/users
if [ -d /var/www/html/public ]; then
    mkdir -p "$USERS_DIR" 2>/dev/null || true
    chmod -R a+rwX "$USERS_DIR" 2>/dev/null || true
fi
exec docker-php-entrypoint "$@"

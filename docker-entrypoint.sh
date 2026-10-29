#!/bin/sh
set -e
# Render fornece a porta em $PORT
PORT="${PORT:-10000}"
sed -i "s/Listen 80/Listen ${PORT}/" /etc/apache2/ports.conf
sed -i "s/<VirtualHost \*:80>/<VirtualHost *:${PORT}>/" /etc/apache2/sites-available/000-default.conf

# Banco: usa DB_PATH (ex.: /data/loja.db num disco persistente); copia o banco inicial se não existir
DB_PATH="${DB_PATH:-/var/www/html/banco/loja.db}"
mkdir -p "$(dirname "$DB_PATH")"
if [ ! -f "$DB_PATH" ]; then
  cp /var/www/html/banco/loja.db "$DB_PATH"
fi
chown -R www-data:www-data "$(dirname "$DB_PATH")"

exec docker-php-entrypoint "$@"

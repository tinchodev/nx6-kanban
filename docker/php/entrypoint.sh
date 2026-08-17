#!/bin/sh
set -e

if [ ! -f .env ]; then
    echo "Creating .env from .env.example"
    cp .env.example .env
fi

# Point the app at the compose 'mysql' service instead of .env.example's blanks,
# without clobbering any other value a developer may have customized.
sed -i \
    -e "s/^DB_CONNECTION=.*/DB_CONNECTION=mysql/" \
    -e "s/^DB_HOST=.*/DB_HOST=mysql/" \
    -e "s/^DB_PORT=.*/DB_PORT=3306/" \
    -e "s/^DB_DATABASE=.*/DB_DATABASE=${DB_DATABASE:-gitscrum}/" \
    -e "s/^DB_USERNAME=.*/DB_USERNAME=${DB_USERNAME:-gitscrum}/" \
    -e "s/^DB_PASSWORD=.*/DB_PASSWORD=${DB_PASSWORD:-gitscrum}/" \
    .env

if [ ! -d vendor ] || [ ! -f vendor/autoload.php ]; then
    echo "Installing PHP dependencies..."
    composer install --no-interaction --prefer-dist
fi

if [ ! -f node_modules/.bin/vite ]; then
    echo "Installing JS dependencies..."
    npm ci
fi

if [ ! -f public/build/manifest.json ]; then
    echo "Building assets..."
    npm run build
fi

echo "Waiting for MySQL..."
until mysqladmin --skip-ssl ping -h"${DB_HOST:-mysql}" -u"${DB_USERNAME:-gitscrum}" -p"${DB_PASSWORD:-gitscrum}" --silent 2>/dev/null; do
    sleep 2
done

echo "Running migrations..."
php artisan migrate --force

# The config seeders (config_statuses, issue_types, etc.) DELETE then re-insert
# on every run. Safe on a fresh database; unsafe once real Issues/Sprints/etc.
# reference those rows, since the DELETE would then hit a foreign key
# constraint. Only seed on a genuinely empty database.
SEEDED_COUNT=$(mysql --skip-ssl -h"${DB_HOST:-mysql}" -u"${DB_USERNAME:-gitscrum}" -p"${DB_PASSWORD:-gitscrum}" \
    "${DB_DATABASE:-gitscrum}" -N -e "SELECT COUNT(*) FROM config_statuses" 2>/dev/null || echo 0)
if [ "$SEEDED_COUNT" = "0" ]; then
    echo "Seeding config data..."
    php artisan db:seed --force
fi

exec "$@"

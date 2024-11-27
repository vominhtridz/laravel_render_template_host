#!/usr/bin/env bash

echo "Running composer"
composer install --no-dev --working-dir=/var/www/html
echo "Caching config..."
php artisan config:cache

echo "Caching routes..."
php artisan route:cache
echo "optimize clear...."
php artisan optimize:clear
echo "Clearing view cache..."
php artisan view:clear
echo "Clearing compiled views..."
php artisan view:cache
echo "Clearing compiled assets..."
composer dump-autoload
echo "Running migrations..."
php artisan migrate --force
php artisan db:seed --class=RolePermissionSeeder
echo "Running server..."
php artisan serve --host=0.0.0.0 --port=8000

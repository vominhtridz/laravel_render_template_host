#!/usr/bin/env bash

echo "Running composer"
composer install --no-dev --working-dir=/var/www/html
echo "Installing laravel-mix..."
npm install -g laravel-mix
echo "Installing dependencies..."
npm install
npm run build
echo "Caching config..."
php artisan config:cache

echo "Caching routes..."
php artisan route:cache
echo "optimize clear...."
php artisan optimize:clear

echo "Running migrations..."
php artisan migrate --force
php artisan db:seed --class=RolePermissionSeeder
echo "Running server..."
php artisan serve --host=0.0.0.0 --port=8000

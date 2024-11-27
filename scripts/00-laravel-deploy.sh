# Clear old cached views and configurations
php artisan view:clear
php artisan route:clear
php artisan config:clear
npm install
npm run build
# Clear all cached data including optimized files
php artisan optimize:clear

# Rebuild caches
php artisan config:cache
php artisan route:cache

# Clear compiled views and dump autoload
php artisan view:cache
composer dump-autoload

# Run migrations and seeders
php artisan migrate --force
php artisan db:seed --class=RolePermissionSeeder
composer run dev

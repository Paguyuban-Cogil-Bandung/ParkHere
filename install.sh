git stash
git pull origin main
composer install --ignore-platform-reqs
php artisan optimize
php artisan config:cache
php artisan route:cache
php artisan view:cache
cp -rf public/* .
mv public.php index.php
chmod -R 777 storage bootstrap/cache

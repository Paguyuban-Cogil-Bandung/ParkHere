git stash
git pull origin main
composer install --ignore-platform-reqs
php artisan optimize
php artisan config:cache
php artisan route:cache
php artisan view:cache
echo "${{ secrets.ENV_PRODUCTION }}" > .env
php artisan key:generate
cp -rf public/* .
mv public.php index.php
chmod -R 777 storage bootstrap/cache

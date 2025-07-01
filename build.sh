#!/bin/bash

echo "🚀 Running deploy script"

# Reset local changes to avoid git pull conflicts
echo "[0] 🔄 Resetting local changes"
git reset --hard HEAD
git clean -fd

echo "[1/6] 📥 Pulling latest code from GitHub"
git pull origin main

echo "[2/6] 🗃️ Creating database if one isn't found"
touch database/database.sqlite

echo "[3/6] 📦 Installing packages using composer"
php composer.phar install --no-interaction --prefer-dist --optimize-autoloader

echo "[4/6] ⚙️ Publishing API Platform assets"
if php artisan list | grep -q "api-platform:"; then
  php artisan api-platform:install
else
  echo "ℹ️ Skipping api-platform install (not available)"
fi

echo "[5/6] 🧹 Clearing and caching config/routes/views"
php artisan config:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "[6/6] 🛠️ Migrating database"
php artisan migrate --force

echo "✅ The app has been built successfully !"

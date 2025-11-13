# ============================================
# CBT Platform Setup Script
# Migrating Quran Quiz to JAMB/WAEC Platform
# ============================================

Write-Host "🚀 Starting CBT Platform Setup..." -ForegroundColor Green

# Navigate to backend
Set-Location backend

Write-Host "`n📦 Step 1: Installing PHP Dependencies..." -ForegroundColor Cyan
composer require livewire/livewire
composer require laravel/breeze --dev
composer require openai-php/laravel
composer require unicodeveloper/laravel-paystack
composer require maatwebsite/excel

Write-Host "`n📦 Step 2: Installing Node Dependencies..." -ForegroundColor Cyan
npm install
npm install -D tailwindcss postcss autoprefixer
npm install alpinejs
npm install lucide
npm install chart.js

Write-Host "`n🔧 Step 3: Publishing Breeze (Blade + Alpine)..." -ForegroundColor Cyan
php artisan breeze:install blade --dark

Write-Host "`n🔧 Step 4: Publishing Livewire Assets..." -ForegroundColor Cyan
php artisan livewire:publish --config
php artisan livewire:publish --assets

Write-Host "`n✅ Base installation complete!" -ForegroundColor Green
Write-Host "`nNext steps:" -ForegroundColor Yellow
Write-Host "1. Configure .env file (database, OpenAI API key, Paystack keys)"
Write-Host "2. Run: php artisan migrate"
Write-Host "3. Run: npm run dev"
Write-Host "4. Run: php artisan serve"

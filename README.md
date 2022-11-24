`composer create-project laravel/laravel web-forum`

`cd .\web-forum\`

`code .`

`mysql -u sanskar -p`

`create database web_forum;`

`exit`

#### Edit .env file

`git init`

`git add .`

`git commit -m "Initial commit"`

## Add node and composer dependencies
- `composer require laravel/breeze --dev`
- `php artisan breeze:install`
- `npm install`
- `npm install -D @tailwindcss/typography`
- `npm i daisyui`
- Edit `tailwind.config.js` to include `require('@tailwindcss/typography')` and `require('daisyui')`
- `composer require filament/filament`
- Update `composer.json`
- `composer require spatie/laravel-permission`
- `php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"`
- `composer require livewire/livewire`
- `php artisan migrate`
- `php artisan serve`
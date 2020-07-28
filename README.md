# Lumen PHP Framework
For subscription api coding challenge I have used Lumen  
    `"require": {
        "php": "^7.2.5",
        "laravel/lumen-framework": "^7.0"
    },`

## Installation
composer install

## Environment Setup
rename .env.example to .env

DB_CONNECTION=mysql  
DB_HOST=127.0.0.1  
DB_PORT=3306  
DB_DATABASE=<dbname>  
DB_USERNAME=<dbuser>  
DB_PASSWORD=<dbpassword>  

## Migrating Database

> php artisan migrate
> php artisan db:seed


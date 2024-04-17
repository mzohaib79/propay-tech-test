<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Getting started
###  Laravel 11

Requirements

    PHP Version 8.2
    Node Latest Verion
## Installation

Please check the official laravel installation guide for server requirements before you start. [Official Documentation](https://laravel.com/docs/5.4/installation#installation)

Clone the repository

    git clone https://github.com/mzohaib79/propay-tech-test.git

Install all the dependencies using composer

    composer install

Copy the example env file and make the required configuration changes in the .env file
    
    cp .env.example .env

Generate a new application key

     php artisan key:generate

Run the database migrations (**Set the database connection in .env before migrating**)

    php artisan migrate

Run the database seeder
    
    php artisan db:seed

also run 

    npm install
    npm run dev

To configure mail settings for email testing using Mailtrap, you will typically add the necessary configuration to your project's .env file.

    MAIL_MAILER=smtp
    MAIL_HOST=sandbox.smtp.mailtrap.io
    MAIL_PORT=2525
    MAIL_USERNAME=your username
    MAIL_PASSWORD=your password

Start the local development server

    php artisan serve

You can now access the server at http://localhost:8000

Login credentials 

    email: techtest@propay.com
    password: 12345678



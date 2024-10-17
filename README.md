# Eden Platform POC

Be carreful, this repo is only a very simple POC for demonstrating the possibility to build a courses platform based on Laravel.

## Prerequisites

The same as Laravel 11 which are available in the [documentation](https://laravel.com/docs/11.x/releases).

Mainly you need PHP 8.2.

The database is sqlite one and is provided in the repo.

## Install

- git clone https://github.com/f-blanc/edenplatform edenplatform
- cp .env.example .env
- composer update
- php artisan key:generate
- set the APP_URL in the .env file
- set the APP_NAME in the .env file
- npm run dev

## How to see the frontend part 

Go to {websiteurl}/courses

## User

By default the only user is 

    'name' => 'Test User'
    'email' => 'test@example.com',
    'password' => 'Password*'


## How to connect to back office

Go to {websiteurl}/admin and connect with the default user.
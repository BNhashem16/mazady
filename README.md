# About Project
This is Laravel 9 with bootstrap 5, and this is empty project, you can use this project as a starter project for your laravel project.

# How to use
1. Clone this project
2. Run `composer install`
3. create database and set the database name in `.env` file
4. Run `cp .env.example .env`
5. Run `php artisan key :generate`
6. Run `php artisan migrate:fresh --seed`
7. Run `php artisan serve`
8. Open `http://localhost:8000` in your browser

# To Test API
1. you can use postman or insomnia
2. import this postman collection `https://www.getpostman.com/collections/1b9b1b9c1c1c1c1c1c1c`
3. import this postman environment `https://www.getpostman.com/collections/1b9b1b9c1c1c1c1c1c1c`
4. change the environment variable `base_url` to `http://localhost:8000`
5. run the postman collection

# To Test Frontend
1. run `php artisan serve`
2. open `http://localhost:8000` in your browser


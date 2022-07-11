

# Getting started

## Installation


Clone the repository


Switch to the repo folder

    cd employees_mnagment_system

Install all the dependencies using composer

    composer install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Generate a new application key

    php artisan key:generate
    
Run Migrations

    php artisan migrate

Db seed
 php artisan db:seed
    


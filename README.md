# Restaurant Reservation Server

Test rest service, for the management of reservations in a restaurant.

# Endpoints

Postman configuration for test: https://documenter.getpostman.com/view/7670473/TWDXoGrs

* Get all tables in restaurant

    `{{urlserver}}/dinertable`

* Show a table

    `{{urlserver}}/dinertable/show`

    `id:2`  

* Get a table in restaurant
    
    `{{urlserver}}/dinertable/show`

    `id:18`

* Add table in restaurant

    `{{urlserver}}/dinertable/create`

    `
    name:Test
    min_diner:6
    max_diner:10
    `
* Remove table in restaurant

    `{{urlserver}}/dinertable/destroy`

    `id:18`

* Get all reservations

    `{{urlserver}}/reservation`

* Create a reservation

    `{{urlserver}}/reservation/create`

    `
    reservation_date:2021-02-25
    mum_diner:6
    name:Francisco
    dinertable_id:20
    `

* Check Availability for a reservation in a date

    `{{urlserver}}/reservation/checkavailability`

    `
    date:2021-01-01
    num: 3
    `    

* Show reservation

    `{{urlserver}}/reservation/show`

    `id:2`    

* Remove reservation

    `{{urlserver}}/reservation/destroy`

    `id:2`    

# Migrations and seeders

 run your migrations using the command below:
 
`$ php spark migrate`

## Development in CodeIgniter

CodeIgniter is a PHP full-stack web framework that is light, fast, flexible, and secure. 
More information can be found at the [official site](http://codeigniter.com).

## Installation & updates

`composer update` whenever there is a new release of the framework.

When updating, check the release notes to see if there are any changes you might need to apply
to your `app` folder. The affected files can be copied or merged from
`vendor/codeigniter4/framework/app`.

## Setup

Copy `env` to `.env` and tailor for your app, specifically the baseURL
and any database settings.

## Server Requirements

PHP version 7.3 or higher is required, with the following extensions installed:

- [intl](http://php.net/manual/en/intl.requirements.php)
- [libcurl](http://php.net/manual/en/curl.requirements.php) if you plan to use the HTTP\CURLRequest library

Additionally, make sure that the following extensions are enabled in your PHP:

- json (enabled by default - don't turn it off)
- [mbstring](http://php.net/manual/en/mbstring.installation.php)
- [mysqlnd](http://php.net/manual/en/mysqlnd.install.php)
- xml (enabled by default - don't turn it off)

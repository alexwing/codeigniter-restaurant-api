# Restaurant Reservation Server

Test rest service, for the management of reservations in a restaurant.

# Endpoints

* Get all tables in restaurant

    `https://{site}/dinertable`

* Add table in restaurant

    `https://{site}/dinertable/create`

    `
    name:Test
    min_diner:6
    max_diner:10
    `
* Remove table in restaurant

    `https://{site}/dinertable/destroy`

    `id:18`

# Migrations and seeders

 run your migrations using the command below:
 
`$ php spark migrate`

## Development in CodeIgniter

CodeIgniter is a PHP full-stack web framework that is light, fast, flexible, and secure. 
More information can be found at the [official site](http://codeigniter.com).


## Installation & updates

`composer create-project codeigniter4/appstarter` then `composer update` whenever
there is a new release of the framework.

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

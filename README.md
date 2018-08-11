# Project Apollo

A software based solution that can bring efficiency to inventory management, and perform inventory management tasks accurately, effortlessly forecast sales to optimize cashflow and increase business.

## Software Stack
 - PHP (Laravel Framework)[Backend]
 - JS (Vuejs)[Frontend]
 - Less [Frontend Styling]
 - Python [Forecasting]
 - Rscript [Forecasting]
## Features
* Manage Customers and Suppliers
* Manage Products
* Make Purchases and Sales
* Order Generation
* Forecasting
* Reporting
* CSV Exporting
* Messaging System
* Roles & Permissions
* User Mangement
* Notifications

## Requiments
 - PHP >= 7.1
 - Nginx
 - MySQL 5.6
 - RScript
 - Python 3+
## Installation
Fastest way to install and get requirements up and running is using [Laravel Homestead](https://laravel.com/docs/homestead). and then install both Python and RScript into the Homestead VM.

Clone into Homestead directory.
```
git clone https://github.com/johanleroux/apollo.git
```

Set working directory to Apollo

Copy over environment file and update details to your environment.
```
cp .env.example .env
```

Update dependencies
```
composer update
```

Set Application Key
```
php artisan key:generate
```

Migrate DB and Seed Initial Data
```
php artisan migrate --seed
```
Or you can use a snapshot of data already forecasted
```
php artisan snapshot:load db_forecasted
```

## Demo & Credentials
```
sale@paradox.com:secret
manager@paradox.com:secret
admin@paradox.com:secret
```

## Testing
Setup a `apollo_test` mysql database before running the test. This is due to a couple of tests not using the SQLite in memory since it doesn't test certain specific MySQL tests.
```
phpunit
```

## License
The MIT License (MIT). Please see [License File](license.md) for more information.

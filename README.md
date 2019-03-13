# DotLabs test
Test for DotLabs

Instructions:
This test has been developed with PHP 7.2 and MySql 5.6 i used symfony 4
The command below could change depending of machine and set up.

**Steps:**
```
php composer install
```

* set up database on .env like: 
```
DATABASE_URL=mysql://dotlabs:dotlabs@127.0.0.1:3306/dotlabs
```
Also update phpunit.xml.dist with the right DB, Line 15
In order to create Database, create migration:
Updated: Before I used schema, migrations offer solutions to potential future problems.
https://stackoverflow.com/questions/23339711/doctrine-schema-update-or-doctrine-migrations

```
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
```

I used minimum css and JS for this test but I used standard set up encore.
https://symfony.com/doc/4.0/frontend/encore/installation.html
In order to see the up running properly execute the following comands:
```
yarn install
yarn add @symfony/webpack-encore --dev
yarn add sass-loader@^7.0.1 node-sass --dev
yarn add bootstrap
yarn add popper.js
yarn add jquery
yarn encore dev
```


Code standards: I followed https://cs.symfony.com/


**More information**
I created some unit tests, It does not cover all scenarios
but for the purpose of the test I believe is Ok.

Entity Pricing Rule could be done in Entity, but I created a service that fill the purpose of the test.

Obviously in a production enviroment CheckoutController would not look like this, 
but I wanted to be as close as possible at what it was asked. Controller/CheckoutController

Thanks,
Jose



# SilverGoldBull API PHP Client Library

PHP is client for the SilverGoldBull(https://silvergoldbull.com) web service

Installation
------------

There are two ways to install:

 **Require Library**

```php
require_once("/path/to/lib/silvergoldbull.php");
```

**or via [Composer](http://getcomposer.org/):**

Create or add the following to composer.json in your project root:
```javascript
{
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/dboys/php-SilverGoldBull-API"
        }
    ],
    "require": {
        "silvergoldbull/php-silvergoldbull-api": "~0.0.1"
    }
}
```

Install composer dependencies:
```shell
php composer.phar install
```

Example
-------

```php
require_once("path/to/lib/silvergoldbull.php");

$api = new SilverGoldBull\API(array("api_key" => "<api_key>"));

$response = $api->get_currency_list();
if ($response->is_success()) {
    var_dump($response->data());
}
else {
    echo $response->error()
}

$shipping_address = new SilverGoldBull\API\Address(array(
    "last_name" => "Smith",
    "first_name" => "John",
    "phone" => "+1 (403) 668 8648",
    "street" => "888 - 3 ST SW, 10 FLOOR - WEST TOWER",
    "country" => "CA",
    "city" => "Calagary",
    "region" => "AB",
    "postcode" => "T2P 5C5",
    "email" => "sales@silvergoldbull.com"
));

$billing_address = new SilverGoldBull\API\Address(array(
    "last_name" => "Smith",
    "first_name" => "John",
    "phone" => "+1 (403) 668 8648",
    "street" => "888 - 3 ST SW, 10 FLOOR - WEST TOWER",
    "country" => "CA",
    "city" => "Calagary",
    "region" => "AB",
    "postcode" => "T2P 5C5",
    "email" => "sales@silvergoldbull.com"
));

$item = new SilverGoldBull\API\Item(array(
    "id" => "2706",
    "qty" => 1,
    "bid_price" => "468.37"
));

$order = new SilverGoldBull\API\Order(array(
    "shipping" => $shipping_address,
    "billing" => $billing_address,
    "shipping_method" => "1YR_STORAGE",
    "declaration" => "TEST",
    "items" => array($item),
    "currency" => "USD",
    "payment_method" => "paypal"
))

$response = $api->create_order($order);
if ($response->is_success()) {
    var_dump($response->data());
}
else {
    echo $response->error()
}
```

Documentation
--------------------

Up-to-date documentation at: https://silvergoldbull.com/api

Tests
--------------------

```shell
phpunit test/
```
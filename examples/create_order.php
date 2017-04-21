<?php
    require_once(dirname(__FILE__) . '/../lib/silvergoldbull.php');

    $api = new SilverGoldBull\API(array('api_key' => '1c9332e5cf314c44520636d8cbec8a24'));

    $shipping_addr = new SilverGoldBull\API\Address(array(
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

    $billing_addr = new SilverGoldBull\API\Address(array(
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
        "shipping" => $shipping_addr,
        "billing" => $billing_addr,
        "shipping_method" => "1YR_STORAGE",
        "declaration" => "TEST",
        "items" => array($item),
        "currency" => "USD",
        "payment_method" => "paypal"
    ));

    $response = $api->create_order($order);

    if ($response->is_success()) {
        var_dump($response->data());
    }
    else {
        echo $response->error();
    }
?>
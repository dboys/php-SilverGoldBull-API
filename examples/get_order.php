<?php
    require_once(dirname(__FILE__) . '/../lib/silvergoldbull.php');

    $api = new SilverGoldBull\API(array('api_key' => '1c9332e5cf314c44520636d8cbec8a24'));
    $id = '1396940734';
    $response = $api->get_order($id);
    if ($response->is_success()) {
        var_dump($response->data());
    }
    else {
        echo $response->error();
    }
?>
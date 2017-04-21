<?php
// Required PHP extensions
if (!function_exists('curl_init')) {
  throw new Exception('SilverGoldBull needs the CURL PHP extension.');
}
if (!function_exists('json_decode') || !function_exists('json_encode')) {
  throw new Exception('SilverGoldBull needs the JSON PHP extension.');
}

require(dirname(__FILE__) . '/SilverGoldBull/API.php');
require(dirname(__FILE__) . '/SilverGoldBull/API/Response.php');
require(dirname(__FILE__) . '/SilverGoldBull/API/ICommon.php');
require(dirname(__FILE__) . '/SilverGoldBull/API/Address.php');
require(dirname(__FILE__) . '/SilverGoldBull/API/Item.php');
require(dirname(__FILE__) . '/SilverGoldBull/API/Common.php');
require(dirname(__FILE__) . '/SilverGoldBull/API/Order.php');
require(dirname(__FILE__) . '/SilverGoldBull/API/Quote.php');

?>
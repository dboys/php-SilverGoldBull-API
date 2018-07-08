<?php

    namespace SilverGoldBull;

    require_once(dirname(__FILE__) . '/../../lib/silvergoldbull.php');

    class APITest extends \PHPUnit_Framework_TestCase {
        function setUp(){
            $this->api = new API(array('api_key' => '1c9332e5cf314c44520636d8cbec8a24'));
        }

        function tearDown(){
            $this->api = null;
        }

        function responseTests(API\Response $response) {
            $this->assertInstanceOf(API\Response::class, $response);
            $this->assertTrue(method_exists($response,'is_success'));
            $this->assertTrue(method_exists($response,'data'));
            $this->assertTrue(method_exists($response,'error'));

            if ($response->is_success()) {
                $this->assertTrue(is_array($response->data()));
            }
            else {
                $this->assertTrue(is_string($response->error()));
            }
        }

        function testGetCurrencyList() {
            $this->assertTrue(method_exists($this->api,'get_currency_list'));
            $currency_response = $this->api->get_currency_list();

            $this->responseTests($currency_response);
        }

        function testGetPaymentMethodList() {
            $this->assertTrue(method_exists($this->api,'get_payment_method_list'));
            $pm_list_response = $this->api->get_payment_method_list();

            $this->responseTests($pm_list_response);
        }

        function testGetShippingMethodList() {
            $this->assertTrue(method_exists($this->api,'get_shipping_method_list'));
            $ship_list_response = $this->api->get_shipping_method_list();

            $this->responseTests($ship_list_response);
        }

        function testGetProductList() {
            $this->assertTrue(method_exists($this->api,'get_product_list'));
            $product_list_response = $this->api->get_product_list();

            $this->responseTests($product_list_response);
        }

        function testGetProduct() {
            $this->assertTrue(method_exists($this->api,'get_product'));
            $product_response = $this->api->get_product(10);

            $this->responseTests($product_response);
        }

        function testGetOrderList() {
            $this->assertTrue(method_exists($this->api,'get_order_list'));
            $order_list_response = $this->api->get_order_list();

            $this->responseTests($order_list_response);
        }

        function testGetOrder() {
            $this->assertTrue(method_exists($this->api,'get_order'));
            $order_response = $this->api->get_order(13);

            $this->responseTests($order_response);
        }

        function testCreateOrder() {
            $this->assertTrue(method_exists($this->api,'create_order'));
        }

        function testCreateQuote() {
            $this->assertTrue(method_exists($this->api,'create_quote'));
        }
    }

?>
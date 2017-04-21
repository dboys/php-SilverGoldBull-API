<?php
    namespace SilverGoldBull;

    class API {
        /**
         * @var string
         */
        private $api_url = 'https://api.silvergoldbull.com';

        /**
         * @var string
         */
        private $api_key = null;

        /**
         * @var integer
         */
        private $api_version = 1;

        /**
         * @var integer
         */
        private $timeout = 10;

        /**
         * constructor
         *
         * @param mixed $params
         */
        function __construct($params = array()) {
            if (is_array($params)) {
                $required_params_list = array("api_key");
                $option_params_list = array("api_url", "api_version", "timeout");

                foreach ($required_params_list as $val) {
                    if (!empty($params) && !empty($params[$val])) {
                        $this->$val = $params[$val];
                    }
                    else {
                        throw new \Exception("{$val} is required");
                    }
                }

                foreach ($option_params_list as $val) {
                    if (!empty($params) && !empty($params[$val])) {
                        $this->$val = $params[$val];
                    }
                }
            }
            else {
                throw new \Exception("Input parameters should be an array");
            }
        }

        /**
         * make request
         *
         * @param string $method
         * @param string $url
         * @param mixed $params
         * @return SilverGoldBull\API\Response
         */
        private function request($method, $url, $params = null) {
            $response = null;
            $curl = curl_init();
            $curlOptions = array();
            $method = strtoupper($method);
            $headers = array(
                "Content-type: application/json;charset=\"utf-8\"",
                'X-API-KEY: ' . $this->api_key
            );

            if ($method === 'GET') {
                $curlOptions[CURLOPT_HTTPGET] = 1;
            }
            else if ($method == 'POST') {
                $curlOptions[CURLOPT_POST] = 1;
                if (!empty($params)){
                    $curlOptions[CURLOPT_POSTFIELDS] = json_encode($params);
                }
            }
            else {
                $message = "{$method} method is not supported yet";
                return new API\Response(array('is_success' => false, 'error' => $message));
            }

            $curlOptions[CURLOPT_URL] = $url;
            $curlOptions[CURLOPT_RETURNTRANSFER] = true;
            $curlOptions[CURLOPT_HTTPHEADER] = $headers;

            curl_setopt_array($curl, $curlOptions);
            $httpBody = curl_exec($curl);

            if ($httpBody === false) {
                $message = curl_error($curl);
                curl_close($curl);

                return new API\Response(array('is_success' => false, 'error' => $message));
            }

            $httpStatus = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);

            try {
                $response = json_decode($httpBody, true);
            } catch (\Exception $e) {
                $message = "Invalid response body from API: HTTP Status: ({$httpStatus}) {$httpBody}";
                return new API\Response(array('is_success' => false, 'error' => $message));
            }

            if ($httpStatus < 200 || $httpStatus >= 300) {
                return new API\Response(array('is_success' => false, 'error' => ($response['message'] ? $response['message'] : 'Internal Server Error' )));
            }

            return new API\Response(array('is_success' => true, 'data' => $response));
        }

        /**
         * build full URL
         *
         * @param string $api_method
         * @return string
         */
        private function build_url($api_method) {
            return join('/', array($this->api_url, "v{$this->api_version}", $api_method));
        }

        /**
         * get currency list
         *
         * @return SilverGoldBull\API\Response
         */
        public function get_currency_list() {
            return $this->request('GET', $this->build_url('currencies'));
        }

        /**
         * get payment list
         *
         * @return SilverGoldBull\API\Response
         */
        public function get_payment_method_list() {
            return $this->request('GET', $this->build_url('payments/method'));
        }

        /**
         * get shipping list
         *
         * @return SilverGoldBull\API\Response
         */
        public function get_shipping_method_list() {
            return $this->request('GET', $this->build_url('shipping/method'));
        }

        /**
         * get product list
         *
         * @return SilverGoldBull\API\Response
         */
        public function get_product_list() {
            return $this->request('GET', $this->build_url('products'));
        }

        /**
         * get product information
         *
         * @param integer $id
         * @return SilverGoldBull\API\Response
         */
        public function get_product($id) {
            return $this->request('GET', $this->build_url("products/{$id}"));
        }

        /**
         * get order list
         *
         * @return SilverGoldBull\API\Response
         */
        public function get_order_list() {
            return $this->request('GET', $this->build_url('orders'));
        }

        /**
         * get order information
         *
         * @param integer $id
         * @return SilverGoldBull\API\Response
         */
        public function get_order($id) {
            return $this->request('GET', $this->build_url("orders/{$id}"));
        }

        /**
         * create order
         *
         * @param SilverGoldBull\API\Order $order
         * @return SilverGoldBull\API\Response
         */
        public function create_order(API\Order $order) {
            return $this->request('POST', $this->build_url('orders/create'), $order->get_post_params());
        }

        /**
         * create quote
         *
         * @param SilverGoldBull\API\Quote $quote
         * @return SilverGoldBull\API\Response
         */
        public function create_quote(API\Quote $quote) {
            return $this->request('POST', $this->build_url('orders/quote'), $quote->get_post_params());
        }
    }
?>
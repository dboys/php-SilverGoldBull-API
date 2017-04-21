<?php
    namespace SilverGoldBull\API;

    abstract class Common implements ICommon {
        /**
         * @var string
         */
        private $shipping_method = null;

        /**
         * @var string
         */
        private $payment_method = null;

        /**
         * @var string
         */
        private $currency = null;

        /**
         * @var string
         */
        private $declaration = null;

        /**
         * @var mixed
         */
        private $items = null;

        /**
         * @var SilverGoldBull\API\Address
         */
        private $shipping = null;

        /**
         * @var SilverGoldBull\API\Address
         */
        private $billing = null;

        /**
         * constructor
         *
         * @param mixed $params
         */
        function __construct($params = array()) {
            if (is_array($params)) {
                $params_name_list = array('shipping_method', 'payment_method', 'currency', 'declaration', 'items', 'shipping', 'billing');
                foreach ($params_name_list as $param_name) {
                    if (!empty($params) && !empty($params[$param_name])) {
                        $this->$param_name = $params[$param_name];
                    }
                }
            }
            else {
                throw new \Exception("Input parameters should be an array");
            }
        }

        /**
         * get parameters
         *
         * @return mixed
         */
        public function get_post_params() {
            $post_params = array();
            $params_name_simple_list = array('shipping_method', 'payment_method', 'currency', 'declaration');
            foreach ($params_name_simple_list as $param_name) {
                $post_params[$param_name] = $this->$param_name;
            }

            $params_name_complex_list = array('shipping', 'billing');
            foreach ($params_name_complex_list as $param_name) {
                if (method_exists($this->$param_name, 'get_post_params')) {
                    $post_params[$param_name] = $this->$param_name->get_post_params();
                }
            }

            if (is_array($this->items)) {
                foreach($this->items as $item) {
                    if (method_exists($item, 'get_post_params')) {
                        $post_params['items'][] = $item->get_post_params();
                    }
                }
            }

            return $post_params;
        }
    }
?>
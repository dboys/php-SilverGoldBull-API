<?php
    namespace SilverGoldBull\API;

    class Item implements ICommon {
        /**
         * @var float
         */
        public $bid_price = null;

        /**
         * @var integer
         */
        public $qty = null;

        /**
         * @var integer
         */
        public $id = null;

        /**
         * constructor
         *
         * @param mixed $params
         */
        function __construct($params = array()) {
            if (is_array($params)) {
                $params_name_list = array('bid_price', 'qty', 'id');
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
            $params_name_list = array('bid_price', 'qty', 'id');
            foreach ($params_name_list as $param_name) {
                if (!empty($this->$param_name)) {
                    $post_params[$param_name] = $this->$param_name;
                }
            }

            return $post_params;
        }
    }
?>
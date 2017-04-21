<?php
    namespace SilverGoldBull\API;

    class Address implements ICommon {
        /**
         * @var string
         */
        public $first_name = null;

        /**
         * @var string
         */
        public $last_name = null;

        /**
         * @var string
         */
        public $email = null;

        /**
         * @var string
         */
        public $city = null;

        /**
         * @var string
         */
        public $country = null;

        /**
         * @var string
         */
        public $region = null;

        /**
         * @var string
         */
        public $postcode = null;

        /**
         * @var string
         */
        public $street = null;

        /**
         * @var string
         */
        public $phone = null;

        /**
         * constructor
         *
         * @param mixed $params
         */
        function __construct($params = array()) {
            if (is_array($params)) {
                $params_name_list = array('first_name', 'last_name', 'email', 'city', 'country', 'region', 'postcode', 'street', 'phone');
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
            $params_name_list = array('first_name', 'last_name', 'email', 'city', 'country', 'region', 'postcode', 'street', 'phone');
            foreach ($params_name_list as $param_name) {
                if (!empty($this->$param_name)) {
                    $post_params[$param_name] = $this->$param_name;
                }
            }

            return $post_params;
        }
    }
?>
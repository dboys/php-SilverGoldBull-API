<?php
    namespace SilverGoldBull\API;

    class Response {
        /**
         * @var boolean
         */
        private $is_success = null;

        /**
         * @var mixed
         */
        private $data = null;

        /**
         * @var string
         */
        private $error = null;

        /**
         * constructor
         *
         * @param mixed $params
         */
        function __construct($params = array()) {
            if (is_array($params)) {
                $this->is_success = $params['is_success'] ? true : false;

                if ($this->is_success) {
                    $this->data = (!empty($params['data']) ? $params['data'] : null);
                }
                else {
                    $this->error = (!empty($params['error']) ? $params['error'] : null);
                }
            }
            else {
                throw new \Exception("Input parameters should be an array");
            }
        }

        /**
         * is success response
         *
         * @return boolean
         */
        public function is_success(){
            return $this->is_success;
        }

        /**
         * get response data
         *
         * @return mixed
         */
        public function data(){
            return $this->data;
        }

        /**
         * get error
         *
         * @return string
         */
        public function error(){
            return $this->error;
        }
    }
?>
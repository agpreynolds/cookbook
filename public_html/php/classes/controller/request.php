<?php

class request {
        private $request;
        public $response;
        public function __construct() {
            $this->request = $_REQUEST;
                        
            if ( isset($this->request) ) {
                if ( isset($this->request['formID']) ) {
                    $this->handleAjax($this->request['formID'],$this->request);
                }
                elseif ( isset($this->request['method']) ) {
                    $this->handleAjax($this->request['method'],$this->request['data']);
                }
            }
        }
        
        private function handleAjax($method,$data) {
            $this->response = new $method($data);
        }
}

?>
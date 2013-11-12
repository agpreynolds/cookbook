<?php

class request {
        //public $submission;
        private $request;
        public $response;
        public function __construct() {
            $this->request = $_REQUEST;
            //$this->formRequest();
            
            if ( isset($this->request) && isset($this->request['method']) && isset($this->request['data']) ) {
                $this->handleAjax($this->request['method'],$this->request['data']);                    
            }
        }
        // private function formRequest() {
                // if ( isset($this->request) && isset($this->request['formID']) ) {
                        // $formConfig = getFormConfig($this->request['formID']);
                        // 
                       // Derive the handler name and include the class
                        // $formHandler = $this->request['formID'] . 'Handler';
                        // 
                        // $this->submission = new $formHandler($this->request,$formConfig);
                        // $this->submission->process();
                // }
        // }
        private function handleAjax($method,$data) {
            $instance = new $method($this->request['data']);
            $this->response = $instance->getResults(); 
        }
}

?>
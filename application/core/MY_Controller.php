<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

#Core Controller

class Base_Controller extends CI_Controller {
    // if no layout specified here. hooks yield layout will be used.
    var $layout = "main";
    
    function __construct() {
        parent::__construct();
    }

    // general json response
    public function _response($is_error = true, $description = '', $status = '') {
        $this->output->set_status_header(200);
        $this->output->set_content_type('application/json');
        $this->output->set_header('Content-type: application/json');
        $this->output->set_output(json_encode(array(
            'error' => $is_error,
            'description' => $description,
            'code' => $status,
        )))->_display();
        die();
    }

    public function isAjax() {
        header('Content-Type: application/json');
    }

    public function echo_pre($data_array) {
        echo "<pre>";
        print_r($data_array);
        exit;
    }

    public function echo_vardump($data_array) {
        echo "<pre>";
        var_dump($data_array);
        exit;
    }

}

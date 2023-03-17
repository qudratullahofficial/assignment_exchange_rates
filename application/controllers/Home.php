<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Base_Controller {

    function __construct() {
        parent::__construct();
        // if you want to override layout specific to other pages like login,homepage and other pages you can change filename here.
        // if no layout specified here. Base controller layout will be used.
        $this->layout = 'main';
    }

    public function index() {
        $this->load->view('home/index');
    }

    public function getExchangeRates() {
        $base = $this->input->post('base');
        $symbols = "";
        $parameters['apiUrl'] = $this->config->item('api_url') . "?symbols=$symbols&base=$base";
        $parameters['apiKey'] = $this->config->item('api_key');
        $response = executeCurl($parameters);
        $this->_response($response['error'], $response['description'], $response['code']);
    }

    public function pageNotFound() {
        $data['title'] = "Oops!";
        $data['description'] = "The page you are trying to access does not exist.<br/>Please verify the URL.";
        $this->load->view('404', $data);
    }

}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class api extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->helper(['url', 'language']);

        //Models
        $this->load->model('api_models');
    }

    function index(){
        echo "Hello World";
    }
    
}

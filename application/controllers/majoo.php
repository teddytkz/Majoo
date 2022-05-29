<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class majoo extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->helper(['url', 'language']);
    }

    function index(){
        $this->load->view('majoo/index');
    }
    
}

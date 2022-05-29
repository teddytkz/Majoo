<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class product extends CI_Controller{
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
    function details($id=null){
        if($id==null){
            redirect(base_url());
        }
        $data['id_product'] = $id;
        $this->load->view('majoo/details',$data);
    }
    
}

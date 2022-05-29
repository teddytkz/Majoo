<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class dashboard extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->helper(['url', 'language','form']);
        $this->load->library(['form_validation','session']);
        
        //Models
        $this->load->model('dashboard_models');

        if($this->session->userdata('logged_in')==null){
            redirect(base_url().'auth');
        }
    }

    public function index(){
        $data['message']='<div class="alert alert-info" role="alert">'.$this->session->flashdata('message').'</div>';
        $this->load->view('dashboard/partial/header');
        $this->load->view('dashboard/index');
        $this->load->view('dashboard/partial/footer');
    }

    public function product(){
        $data['message']='<div class="alert alert-info" role="alert">'.$this->session->flashdata('message').'</div>';
        $this->load->view('dashboard/partial/header');
        $this->load->view('dashboard/product');
        $this->load->view('dashboard/partial/footer');
    }

    public function category(){
        $data['message']='<div class="alert alert-info" role="alert">'.$this->session->flashdata('message').'</div>';
        $this->load->view('dashboard/partial/header');
        $this->load->view('dashboard/category');
        $this->load->view('dashboard/partial/footer');
    }

    public function add_product(){
        $data['message']='<div class="alert alert-info" role="alert">'.$this->session->flashdata('message').'</div>';
        $this->load->view('dashboard/partial/header');
        $this->load->view('dashboard/product/add');
        $this->load->view('dashboard/partial/footer');
    }

    public function add_category(){
        $data['message']='<div class="alert alert-info" role="alert">'.$this->session->flashdata('message').'</div>';
        $this->load->view('dashboard/partial/header');
        $this->load->view('dashboard/category/add');
        $this->load->view('dashboard/partial/footer');
    }


}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class auth extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->helper(['url', 'language','form']);
        $this->load->library(['form_validation','session']);
        
        //Models
        $this->load->model('auth_models');
    }

    public function index(){
        redirect(base_url().'auth/login');
    }

    public function login(){
        if($this->session->userdata('logged_in')!=null){
            redirect(base_url().'dashboard');
        }
        $this->load->view('auth/login');
    }

    public function logout(){
        $this->session->sess_destroy();
        $this->session->set_flashdata('message', 'Success Logout');
        $this->load->view('auth/login');
    }

    public function prosesLogin(){
        $this->form_validation->set_rules('username','Username','required');
        $this->form_validation->set_rules('password','Password','required');
        if($this->form_validation->run()==FALSE){
            $this->session->set_flashdata('message', validation_errors());
            redirect(base_url().'auth/login');
        }else{
            if($this->session->userdata('logged_in')!=null){
                $this->session->sess_destroy();
            }
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $checkData = $this->auth_models->prosesLogin($username,md5($password));
            if($checkData->num_rows()==1){
                $session_login = array(
                    'id'=>$checkData->row()->id,
                    'username'=>$checkData->row()->username
                );
                $this->session->set_userdata('logged_in',$session_login);
                $this->session->set_flashdata('message', 'Success Login');
                redirect(base_url().'dashboard');
            }else{
                $this->session->set_flashdata('message', 'Login Failed Username or Password Not Match');
                redirect(base_url().'auth/login');
            }
        }
    }
}

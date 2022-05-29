<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class auth_models extends CI_Model{

  public function __construct(){
    parent::__construct();
  }

  public function prosesLogin($username,$password){
    $this->db->select('users.*');
    $this->db->from('users');
    $this->db->where('users.username',$username);
    $this->db->where('users.password',$password);
    return $this->db->get();
  }


}

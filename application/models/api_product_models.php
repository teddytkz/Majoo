<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class api_product_models extends CI_Model{

  public function __construct(){
    parent::__construct();
  }

  public function getListProductFront(){
    $this->db->select('product.*');
    $this->db->from('product');
    $this->db->limit(4);
    return $this->db->get();
  }

  public function countListProduct(){
    $this->db->select('product.*');
    $this->db->from('product');
    return $this->db->get();
  }


  public function getListProduct($limit,$start){
    $this->db->select('product.*');
    $this->db->from('product');
    $this->db->limit($limit, $start);
    return $this->db->get();
  }

  public function getListCategory($limit,$start){
    $this->db->select('category.*');
    $this->db->from('category');
    $this->db->limit($limit,$start);
    return $this->db->get();
  }


}
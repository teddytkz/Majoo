<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class api_product_models extends CI_Model{

  public function __construct(){
    parent::__construct();
  }

  public function deleteProduct($id){
    $this->db->where('id',$id);
    $this->db->delete('product');
    return true;
  }

  public function saveProduct($data){
    $this->db->insert('product',$data);
    return true;
  }

  public function saveCategory($data){
    $this->db->insert('category',$data);
    return true;
  }

  public function listCategorySelect($input){
    $this->db->select("category.*");
    $this->db->from("category");
    $this->db->where("category.nama LIKE '%$input%'");
    $this->db->order_by("category.nama","ASC");
    return $this->db->get();
  }

  public function getDataProduct($id_product){
    $this->db->select('product.*');
    $this->db->from('product');
    $this->db->where('product.id',$id_product);
    return $this->db->get();
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

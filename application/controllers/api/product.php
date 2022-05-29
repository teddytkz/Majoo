<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class product extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->helper(['url', 'language']);
        $this->load->library(['pagination','form_validation','session']);

        //Models
        $this->load->model('api_product_models');
    }

    public function index(){
        echo "Hello World";
    }

    public function list_category_select(){
        $input=$this->input->get("q");
        $listCategory = $this->api_product_models->listCategorySelect($input);
        $data=array();
        foreach ($listCategory->result() as $key => $row) {
            $json[] = ['id'=>$row->id, 'text'=>$row->nama];
        }
        echo json_encode($json);
    }

    public function get_data_category(){
        $id = $this->input->post('id');
        $dataCategory = $this->api_product_models->getDataCategory($id)->row();
        $data = array(
            'id'=>$dataCategory->id,
            'nama'=>$dataCategory->nama,
            'deskripsi'=>$dataCategory->deskripsi,
        );
        echo json_encode($data);
    }

    public function get_data_product_id(){
        $id = $this->input->post('id');
        $dataProduct = $this->api_product_models->getDataProduct($id)->row();
        $data = array(
            'id'=>$dataProduct->id,
            'nama'=>$dataProduct->nama,
            'deskripsi'=>$dataProduct->deskripsi,
            'harga'=>$dataProduct->harga,
        );
        echo json_encode($data);
    }

    public function delete_product(){
        $idProduct = $this->input->post('id_product');
        $deleteProduct = $this->api_product_models->deleteProduct($idProduct);
        echo json_encode(array('code'=>'200','message'=>'Success Delete Product'));
    }

    public function delete_category(){
        $idCategory = $this->input->post('id_category');
        $deleteCategory = $this->api_product_models->deleteCategory($idCategory);
        echo json_encode(array('code'=>'200','message'=>'Success Delete Category'));
    }

    public function add_product(){
        $this->form_validation->set_rules('nama_produk','Nama Produk','required');
        $this->form_validation->set_rules('deskripsi_produk','Deskripsi Produk','required');
        $this->form_validation->set_rules('harga_produk','Harga Produk','required');
        $this->form_validation->set_rules('kategori_produk','Kategori Produk','required');
        $this->form_validation->set_rules('image_produk','Image Produk','xss_clean');
        if($this->form_validation->run()==FALSE){
            $errors = str_replace('<p>','',validation_errors());
            $errors = str_replace('</p>','',$errors);
            echo json_encode(array('code'=>'400','message'=>$errors));
        }else{
            $config['upload_path']="./assets/images";
            $config['allowed_types']='gif|jpg|png';
            $config['encrypt_name'] = TRUE;
            $this->load->library('upload',$config);
            if($this->upload->do_upload("image_produk")){
                $data = array('upload_data' => $this->upload->data());
                $image= $data['upload_data']['file_name'];
                $dataProduk['nama'] = $this->input->post('nama_produk');
                $dataProduk['deskripsi'] = $this->input->post('deskripsi_produk');
                $dataProduk['harga'] = $this->input->post('harga_produk');
                $dataProduk['kategori'] = $this->input->post('kategori_produk');
                $dataProduk['images'] = $image;
                $saveProduct = $this->api_product_models->saveProduct($dataProduk);
                echo json_encode(array('code'=>'200','message'=>'Sukses Tambah Produk'));
            }else{
                echo json_encode(array('code'=>'400','message'=>'Image Not Found'));
            }
        }
    }

    public function add_category(){
        $this->form_validation->set_rules('nama_category','Nama Kategori','required');
        $this->form_validation->set_rules('deskripsi_category','Deskripsi Kategori','required');
        if($this->form_validation->run()==FALSE){
            $errors = str_replace('<p>','',validation_errors());
            $errors = str_replace('</p>','',$errors);
            echo json_encode(array('code'=>'400','message'=>$errors));
        }else{
            $dataCategory['nama'] = $this->input->post('nama_category');
            $dataCategory['deskripsi'] = $this->input->post('deskripsi_category');
            $saveCategory = $this->api_product_models->saveCategory($dataCategory);
            echo json_encode(array('code'=>'200','message'=>'Sukses Tambah Category'));
        }
    }

    public function update_product(){
        $this->form_validation->set_rules('nama_produk','Nama Produk','required');
        $this->form_validation->set_rules('deskripsi_produk','Deskripsi Produk','required');
        $this->form_validation->set_rules('harga_produk','Harga Produk','required');
        if($this->form_validation->run()==FALSE){
            $errors = str_replace('<p>','',validation_errors());
            $errors = str_replace('</p>','',$errors);
            echo json_encode(array('code'=>'400','message'=>$errors));
        }else{
            $id = $this->input->post('id');
            $dataProduk['nama'] = $this->input->post('nama_produk');
            $dataProduk['deskripsi'] = $this->input->post('deskripsi_produk');
            $dataProduk['harga'] = $this->input->post('harga_produk');
            $updateProduct = $this->api_product_models->updateProduct($id,$dataProduk);
            echo json_encode(array('code'=>'200','message'=>'Sukses Update Produk'));
            
        }
    }

    public function update_category(){
        $this->form_validation->set_rules('nama_category','Nama Kategori','required');
        $this->form_validation->set_rules('deskripsi_category','Deskripsi Kategori','required');
        if($this->form_validation->run()==FALSE){
            $errors = str_replace('<p>','',validation_errors());
            $errors = str_replace('</p>','',$errors);
            echo json_encode(array('code'=>'400','message'=>$errors));
        }else{
            $id = $this->input->post('id');
            $dataCategory['nama'] = $this->input->post('nama_category');
            $dataCategory['deskripsi'] = $this->input->post('deskripsi_category');
            $updateCategory = $this->api_product_models->updateCategory($id,$dataCategory);
            echo json_encode(array('code'=>'200','message'=>'Sukses Update Category'));
        }
    }

    public function get_data_product(){
        $id_product = $this->input->get('id_product');
        $data_product = $this->api_product_models->getDataProduct($id_product);
        $data = array();
        foreach($data_product->result() as $result){
            $data=array(
                'namaProduk'=>$result->nama,
                'descriptionProduk'=>$result->deskripsi,
                'harga'=>$this->rupiah($result->harga),
                'images'=>base_url().'assets/images/'.$result->images
            );
        }
        echo json_encode($data);
    }
    
    function get_product_front(){
        $listProduct = $this->api_product_models->getListProductFront();
        $data = array();
        foreach($listProduct->result() as $result){
            array_push($data,array(
                'id'=>$result->id,
                'namaProduk'=>$result->nama,
                'descriptionProduk'=>$result->deskripsi,
                'harga'=>$this->rupiah($result->harga),
                'images'=>base_url().'assets/images/'.$result->images
            ));
        }
        echo json_encode($data);
    }

    function get_product(){
        $page = $this->input->get('page',0);
        $config['base_url'] = "#"; //site url
        $config['total_rows'] = $this->db->count_all('product'); //total row
        $config['per_page'] = 10; //show record per halaman
        $config['enable_query_strings'] = TRUE;
        $config['page_query_string'] = TRUE;
        $config['use_page_numbers'] = TRUE;
        $config['reuse_query_string'] = TRUE;
        $config['query_string_segment'] = 'page';
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = floor($choice);
        $config['first_link'] = 'First';
        $config['last_link'] = 'Last';
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Prev';
        $config['full_tag_open'] = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close'] = '</ul></nav></div>';
        $config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close'] = '</span></li>';
        $config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close'] = '</span></li>';
        $config['next_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close'] = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close'] = '</span>Next</li>';
        $config['first_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close'] = '</span></li>';
        $this->pagination->initialize($config);
        $start = ($page - 1) * $config["per_page"];
        $productList = $this->api_product_models->getListProduct($config["per_page"], $start);
        $tableProduct = '<table class="table table-bordered">';
        $tableProduct .= '<tr>';
        $tableProduct .= '<th>#</th>';
        $tableProduct .= '<th>Id</th>';
        $tableProduct .= '<th>Name</th>';
        $tableProduct .= '<th>Action</th>';
        $tableProduct .= '</tr>';
        $no=1;
        foreach($productList->result() as $result){
            $actionDelete = '<a href="#" id="btnDeleteProduct" ids="'.$result->id.'" class="btn btn-warning" style="margin:2px">Delete</a>';
            $actionEdit = '<a href="'.base_url().'dashboard/edit_product/'.$result->id.'" class="btn btn-success" style="margin:2px">Edit</a>';
            $tableProduct .= '<tr>';
            $tableProduct .= '<td>'.$no++.'</td>';
            $tableProduct .= '<td>'.$result->id.'</td>';
            $tableProduct .= '<td>'.$result->nama.'</td>';
            $tableProduct .= '<td>'.$actionEdit.$actionDelete.'</td>';
            $tableProduct .= '</tr>';
        }
        $tableProduct .= '</table>';
        $output = array(
            'pagenationLink' => $this->pagination->create_links(),
            'tableProduct' => $tableProduct
        );
        echo json_encode($output);
    }

    function get_category(){
        $page = $this->input->get('page',0);
        $config['base_url'] = "#"; //site url
        $config['total_rows'] = $this->db->count_all('product'); //total row
        $config['per_page'] = 10; //show record per halaman
        $config['enable_query_strings'] = TRUE;
        $config['page_query_string'] = TRUE;
        $config['use_page_numbers'] = TRUE;
        $config['reuse_query_string'] = TRUE;
        $config['query_string_segment'] = 'page';
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = floor($choice);
        $config['first_link'] = 'First';
        $config['last_link'] = 'Last';
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Prev';
        $config['full_tag_open'] = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close'] = '</ul></nav></div>';
        $config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close'] = '</span></li>';
        $config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close'] = '</span></li>';
        $config['next_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close'] = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close'] = '</span>Next</li>';
        $config['first_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close'] = '</span></li>';
        $this->pagination->initialize($config);
        $start = ($page - 1) * $config["per_page"];
        $categoryList = $this->api_product_models->getListCategory($config["per_page"], $start);
        $tableCategory = '<table class="table table-bordered">';
        $tableCategory .= '<tr>';
        $tableCategory .= '<th>#</th>';
        $tableCategory .= '<th>Id</th>';
        $tableCategory .= '<th>Name</th>';
        $tableCategory .= '<th>Action</th>';
        $tableCategory .= '</tr>';
        $no=1;
        foreach($categoryList->result() as $result){
            $actionDelete = '<a href="#" id="btnDeleteCategory" ids="'.$result->id.'" class="btn btn-warning" style="margin:2px">Delete</a>';
            $actionEdit = '<a href="'.base_url().'dashboard/edit_category/'.$result->id.'" class="btn btn-success" style="margin:2px">Edit</a>';
            $tableCategory .= '<tr>';
            $tableCategory .= '<td>'.$no++.'</td>';
            $tableCategory .= '<td>'.$result->id.'</td>';
            $tableCategory .= '<td>'.$result->nama.'</td>';
            $tableCategory .= '<td>'.$actionEdit.$actionDelete.'</td>';
            $tableCategory .= '</tr>';
        }
        $tableCategory .= '</table>';
        $output = array(
            'pagenationLink' => $this->pagination->create_links(),
            'tableCategory' => $tableCategory
        );
        echo json_encode($output);
    }

    private function rupiah($number){
        $rupiah="Rp. ".number_format($number,0,',','.');
        return $rupiah;
    }
}

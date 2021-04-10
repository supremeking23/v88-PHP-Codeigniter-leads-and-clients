<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Manila');

class Products extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

    

	public function index(){	
        $data["products"] = $this->product->get_all_products();
        $this->load->view('ecommerce/index',$data);
         
	}

    public function add_to_cart(){
        $qty = $this->input->post("qty");
        $product_id = $this->input->post("product-id");
        $session_id = $this->session->session_id;
        
        if($this->session->has_userdata("cart_id")){
            $cart_id = $this->session->userdata("cart_id");
            
        }else{
            $cart_id = $this->product->add_product_to_cart($session_id);
            $this->session->set_userdata("cart_id",$cart_id);
        }


        $cart_details = array(
            "qty" => $qty,
            "product_id" => $product_id,
            "cart_id" => $cart_id
            
        ); 
       
        $add_product = $this->product->add_product_to_cart_items($cart_details);
        // update total in cart

        redirect(base_url()."cart");
        
        // insert to database
    }

    public function cart(){	
       
        $cart_id = $this->session->userdata("cart_id");
        $data["cart_items"] = $this->product->get_products_from_cart($cart_id);
        $data['total'] = $this->product->get_total_amount_from_cart($cart_id);
		$this->load->view('ecommerce/cart',$data);
         
	}

    public function remove_item(){
       $this->product->remove_item_in_cart($this->input->post("product-id"));

       $this->session->set_flashdata("remove-item",'<div class="alert alert-success">Item has been remove to cart</div>');
       redirect(base_url()."cart");
    }

    // public function show($id){	
       
	// 	$data["product"] = $this->product->get_product_by_id($id);
    //     if(empty($data["product"])){
    //         redirect(base_url());
    //     }
	// 	$this->load->view('products/show',$data);
         
	// }

	// public function new(){
	// 	$this->load->view('products/new');

	// }

    // public function create(){	
	// 	$this->load->library("form_validation");
    //     $this->form_validation->set_rules("product", "Product Name", "trim|required");
	// 	$this->form_validation->set_rules("price", "Product Price", "trim|required|numeric");
    //     if($this->form_validation->run() === FALSE){
    //         $errors = validation_errors('<div class="alert alert-danger">', '</div>');
    //         $this->session->set_flashdata('errors', $errors);
    //         redirect(base_url() ."new");

    //     }else{
    //         //codes to run on success validation here
    //         $product_details = array(
    //             "product_name" => $this->input->post("product"),
	// 			"price" => $this->input->post("price"),
    //             "description" => $this->input->post("product-description")
    //         ); 
    //         $add_product = $this->product->add_product($product_details);
    //         if($add_product === TRUE) {
    //             // echo "Course is added!";
	// 			$this->session->set_flashdata('add-product-success', "<div class=\"alert alert-success\">New product has been added successfully.</div>");
    //             redirect(base_url()."products");
    //         }
            
    //     }
		
         
	// }

    // public function update(){	
	// 	$this->load->library("form_validation");
	// 	$id = $this->input->post("product-id");
    //     $this->form_validation->set_rules("product", "Product Name", "trim|required");
	// 	$this->form_validation->set_rules("price", "Product Price", "trim|required|numeric");
    //     if($this->form_validation->run() === FALSE){
    //         $errors = validation_errors('<div class="alert alert-danger">', '</div>');
    //         $this->session->set_flashdata('errors', $errors);
    //         redirect(base_url() ."edit/".$id);

    //     }else{
    //         // codes to run on success validation here
    //         $product_details = array(
    //             "product_name" => $this->input->post("product"),
	// 			"price" => $this->input->post("price"),
    //             "description" => $this->input->post("product-description"),
	// 			"product_id" => $this->input->post("product-id"),
    //         ); 
    //         $update_product = $this->product->update_product($product_details);
    //         if($update_product === TRUE) {
    //             // echo "Course is added!";
	// 			$this->session->set_flashdata('update-product-success', "<div class=\"alert alert-success\">Product has been updated successfully.</div>");
    //             redirect(base_url()."edit/".$id);
    //         }
            
    //     }
         
	// }


	// public function destroy(){
	// 	$delete_product = $this->product->delete_product($this->input->post("product-id"));
    //     // var_dump($delete_course);
    //     if($delete_product){
    //         $this->session->set_flashdata('delete-product-success','<div class="alert alert-success">Product has been deleted successfully</div>');
    //         redirect(base_url()."products");
    //     }
	// }

   


    

}

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product extends CI_Model {
    function get_all_products(){
        return $this->db->query("SELECT * FROM products")->result_array();
    }
    function get_product_by_id($product_id){
        return $this->db->query("SELECT * FROM products WHERE id = ?", array($product_id))->row_array();
    }
    // function add_product($product)
    // {
    //     $query = "INSERT INTO products (product_name, description,price, created_at) VALUES (?,?,?,?)";
    //     $values = array($product['product_name'], $product['description'], $product['price'], date("Y-m-d, H:i:s")); 
    //     return $this->db->query($query, $values);
    // }

    function add_product_to_cart($session_id){
        // cart table first
        $query = "INSERT INTO carts (session_id, created_at) VALUES (?,?)";
        
        $values = array($session_id, date("Y-m-d, H:i:s")); 
        $this->db->query($query, $values);
        return $this->db->insert_id();

        // $query = "INSERT INTO products (product_name, description,price, created_at) VALUES (?,?,?,?)";
        // $values = array($product['product_name'], $product['description'], $product['price'], date("Y-m-d, H:i:s")); 
    }

    function add_product_to_cart_items($cart_details){
        $query = "INSERT INTO cartitems (cart_id, product_id, qty, created_at) VALUES (?,?,?,?)";
        $values = array($cart_details['cart_id'], $cart_details['product_id'], $cart_details['qty'], date("Y-m-d, H:i:s")); 

        return $this->db->query($query, $values);
    }

    function get_products_from_cart($cart_id){

        //  $query = "SELECT cartitems.product_id,products.product_name,products.price,cartitems.qty, products.price * cartitems.qty as sub_total  FROM products INNER JOIN cartitems ON products.id = cartitems.product_id WHERE cartitems.cart_id = ? ";

        // $query = "SELECT SUM(products.price * cartitems.qty) as grand_total  FROM products INNER JOIN cartitems ON products.id = cartitems.product_id GROUP BY cartitems.cart_id HAVING cartitems.cart_id = ?";

        $query = "SELECT cartitems.product_id,products.product_name,products.price, COUNT(cartitems.qty) AS qty, SUM(products.price * cartitems.qty) as sub_total  FROM products INNER JOIN cartitems ON products.id = cartitems.product_id WHERE cartitems.cart_id = ? GROUP BY products.id ";
        $values = array($cart_id); 
        return $this->db->query($query,$values)->result_array();
    }

    function get_total_amount_from_cart($cart_id){
        $query = "SELECT SUM(products.price * cartitems.qty) as grand_total  FROM products INNER JOIN cartitems ON products.id = cartitems.product_id GROUP BY cartitems.cart_id HAVING cartitems.cart_id = ?";
        $values = array($cart_id); 
        return $this->db->query($query,$values)->row_array();
    }

    // function update_product($product)
    // {
    //     $query = "UPDATE products SET product_name = ?, description = ?, price = ?, updated_at = ? WHERE id = ?";
    //     $values = array($product['product_name'], $product['description'], $product['price'], date("Y-m-d, H:i:s"),$product['product_id']); 
    //     return $this->db->query($query, $values);
    // }

    function remove_item_in_cart($product_id){
        $query = "DELETE FROM cartitems WHERE product_id = ?";
        $value = array($product_id);
        return $this->db->query($query,$value);
    }
}

?>
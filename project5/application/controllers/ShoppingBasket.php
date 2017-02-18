<?php 
class ShoppingBasket extends CI_Controller{
    public function __construct(){
        parent::__construct();
        // Resume the session that's created at login
        session_start();
        $this->load->model('ShoppingBasket_Model');
    }
    public function index(){
        $data['page'] = "Shopping Basket";
        $data['buyUrl'] = base_url()."index.php/shoppingbasket/buy";
        $data['logoutUrl'] = base_url()."index.php/logout";
        $data['searchUrl'] = base_url()."index.php/search";
        $data['basketUrl'] = base_url().'index.php/shoppingbasket';

        if(!isset($_SESSION['username'])){
            $data['fatal'] = true;
            $this->load->view("pages/login",$data);
            exit;
        }
        // Get all items in cart
        $items_session = $_SESSION['basket']['items'];
        // Get the price for all items in the cart from the database
        $_SESSION['basket']['items'] = $this->ShoppingBasket_Model->calculateSubtotal($items_session);
        // Calculate the total price for the cart
        $_SESSION['basket']['totalPrice'] = $this->ShoppingBasket_Model->calculateTotalPrice($_SESSION['basket']['items']);

        $this->load->view("common/header",$data);
        $this->load->view("pages/shoppingbasket", $data);
    }

    public function addtocart(){
        // Create a new item
        $item = array();
        $item['isbn'] = $this->input->post('isbn');
        $item['basketId'] = $this->input->post('basketId');
        $item['number'] = intval($this->input->post('qty'));
        $item['book'] = $this->input->post('bookTitle');
        $item['stockcount'] = $this->input->post('stockcount');
        $item['price'] = 0.00;
        $item['subtotal'] = 0.00;
        // Update the number if this item already exists otherwise add it to the basket 
        $items_session = $_SESSION['basket']['items'];
        $updateItem = false;
        $i=0;
        // Iterate the items in basket to find out if it exists
        foreach($items_session as $item_session){
            // Match found
            if($item_session['isbn'] == $item['isbn']){
                // Update the number for this item
                $updateItem = true;
                $_SESSION['basket']['items'][$i]['number'] = $item['number'];
                // Update the shopping basket counter based on this updated quantity for this item
                if($item_session['number'] < $item['number']){
                    $_SESSION['basket']['counter'] += ($item['number'] - $item_session['number']);
                } else if($item_session['number'] > $item['number']){
                    $_SESSION['basket']['counter'] -= ($item_session['number'] - $item['number']);
                }
                break;
            }
            $i++;
        }
        // No match found
        if(!$updateItem){
             // Add the warehouses to be updated for this item
            $item['warehouses'] = $this->ShoppingBasket_Model->getWarehouses($item);
            // Add this item to the items array in shopping basket 
            array_push($_SESSION['basket']['items'], $item);
            // Increment the counter for the basket after adding this item
            $_SESSION['basket']['counter'] += $item['number'];
        }
        // Send a response back to the ajax call
        $data = array();
        $data['success'] = true;
        $data['newcount'] = $_SESSION['basket']['counter'];
        echo json_encode($data);
    }

    public function buy(){
        echo json_encode($this->ShoppingBasket_Model->buy($_SESSION['basket']));
    }
}
?>
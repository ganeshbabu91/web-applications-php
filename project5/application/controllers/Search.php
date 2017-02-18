<?php 
class Search extends CI_Controller{
    public function __construct(){
        parent::__construct();
        // Resume the session that's created at login
        session_start();
        $this->load->model('Search_Model');
    }
    public function index(){
        $data['page'] = "Search Books";
        $data['actionUrl'] = base_url().'index.php/search/processSearchForm';
        $data['basketUrl'] = base_url().'index.php/shoppingbasket';
        $data['books'] = array();
        $data['addtocartUrl'] = base_url().'index.php/shoppingbasket/addtocart';
        $data['basketUrl'] = base_url().'index.php/shoppingbasket';
        $data['logoutUrl'] = base_url().'index.php/logout';
        $data['searchUrl'] = base_url()."index.php/search";

        if(!isset($_SESSION['username'])){
            $data['fatal'] = true;
            $this->load->view("pages/login",$data);
            exit;
        }

        $this->load->view("common/header",$data);
        $this->load->view("pages/search", $data);
    }

    public function processSearchForm(){
        $data['actionUrl'] = base_url().'index.php/search/processSearchForm';
        $category = $this->input->get('search');
        $term = $this->input->get('term');
        $data['books'] = $this->Search_Model->search($term, $category);
        $data['addtocartUrl'] = base_url().'index.php/shoppingbasket/addtocart';
        $data['basketUrl'] = base_url().'index.php/shoppingbasket';
        $data['logoutUrl'] = base_url().'index.php/logout';
        $data['searchUrl'] = base_url()."index.php/search";

        $this->load->view("common/header",$data);
        $this->load->view("pages/search", $data);
    }
}
?>
<?php 
class Logout extends CI_Controller{
    public function __construct(){
        parent::__construct();
        session_start();
        session_unset();
        session_destroy();
    }
    public function index(){
        redirect('/login');
    }
}
?>
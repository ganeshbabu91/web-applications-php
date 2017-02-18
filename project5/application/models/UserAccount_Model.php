<?php 
class UserAccount_Model extends CI_Model{

    public function __construct(){
        $this->load->database();
    }

    public function login($user){
        $sql = "select * from customers where username='".$user['username']."' and password='".$user['password']."'";
        $query = $this->db->query($sql);
        $row = $query->row();
        return isset($row);
    }

    public function register($user){
        $this->db->insert('customers', $user);
    }
    
}
?>
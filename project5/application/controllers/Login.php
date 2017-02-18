<?php 
class Login extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('UserAccount_Model');
    }
    public function index(){
        $data['page'] = "Login";
        $data['actionUrl'] = base_url().'index.php/login/processLoginForm';
        $data['signupUrl'] = base_url().'index.php/login/register';
        $this->load->view("common/header",$data);
        $this->load->view("pages/login", $data);
    }

    public function processLoginForm(){
        $data['actionUrl'] = base_url().'index.php/login/processLoginForm';
        $data['signupUrl'] = base_url().'index.php/login/register';

        $data['page'] = "Login";
        $user = array(
            'username' => $this->input->post('username'),
            'password' => $this->input->post('password'),
        );
        
        $data['isLoginValid'] = $this->UserAccount_Model->login($user);
        if($data['isLoginValid'] == "1"){
            // Create a new session
            session_start();
            session_regenerate_id(true);
            $_SESSION['username'] = $_POST['username'];
            // Create a new empty shopping basket for this user in session
            $basket = array();
            $basket['basketID'] = session_id();
            $basket['counter'] = 0;
            $basket['totalPrice'] = 0.00;
            $basket['username'] = $_POST['username'];
            $basket['items'] = array();
            $_SESSION['basket'] = $basket;
            // Redirect to the search controller
            redirect('/search');
            return;
        }
        $data['success'] = "false";
        $this->load->view("common/header",$data);
        $this->load->view("pages/login", $data);
    }

    public function register(){
        $data['page'] = "Register";
        $data['processSignup'] = base_url()."index.php/login/processRegistrationForm";
        $this->load->view("common/header",$data);
        $this->load->view('pages/register', $data);
    }

    public function processRegistrationForm(){
        $user = array(
            'username' => $this->input->post('username'),
            'password' => $this->input->post('password'),
            'address' => $this->input->post('address'),
            'phone' => $this->input->post('mobile'),
            'email' => $this->input->post('email')            
        );
        $this->UserAccount_Model->register($user);
        $data["success"] = true;
        $data['page'] = "Login";
        $data['actionUrl'] = base_url().'index.php/login/processLoginForm';
        $data['signupUrl'] = base_url().'index.php/login/register';
        $this->load->view("common/header",$data);
        $this->load->view('pages/login', $data);
    }
}
?>
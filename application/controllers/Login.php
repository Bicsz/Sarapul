<?php

//session_start(); //we need to start session in order to access it through CI

Class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();

        // Load form helper library
        $this->load->helper('form');

        // Load form validation library
        $this->load->library('form_validation');

        // Load session library
        $this->load->library('session');

        // Load database
        $this->load->model('accaunt_model');
    }

    // Show login page
    public function index() {
        
        
        if(isset($this->session->userdata['logged_in'])){
                $this->load->view('crm');
            }else{
                $this->load->view('login');
            }
        
    }

    

    

    // Check for user login process
    public function user_login_process() {

        $this->form_validation->set_rules('login', 'Login', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
           $this->load->view('login');
        } else {
            $data = array(
            'login' => $this->input->post('login'),
            'password' => $this->input->post('password')
            );
            $result = $this->accaunt_model->Check($data);
            if (count($result)>0) {

                $username = $this->input->post('username');
                
                
                
                    $session_data = array(
                        'id' => $result["id"],
                        'login' => $result["login"],
                        'password' => $result["password"],
                    );
                    // Add user data in session
                    $this->session->set_userdata('logged_in', $session_data);
                    $this->load->view('crm');
                
            } else {
                $data = array(
                'signIn_error' => 'Invalid Username or Password'
                );
                $this->load->view('login', $data);
                }
        }
    }

    // Logout from admin page
    public function logout() {

    // Removing session data
    $sess_array = array(
    'username' => ''
    );
    $this->session->unset_userdata('logged_in', $sess_array);
    $data['message_display'] = 'Successfully Logout';
    $this->load->view('login_form', $data);
    }

}

?>
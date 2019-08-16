<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Crm extends CI_Controller {


	public function index()
	{
        
        if(isset($this->session->userdata['logged_in'])){
                $this->load->view('crm');
            }else{
                $this->load->view('login');
            }
	}
    
    public function exit_()
	{
        session_destroy();
        $this->load->view('login');
	}
    
    public function __construct()
        {
                parent::__construct();
                $this->load->model('accaunt_model');
        
        }
    
    
        
        
}

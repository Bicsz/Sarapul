<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class All_message extends CI_Controller {


	public function index($data=array())
	{
        
        if(isset($this->session->userdata['logged_in'])){
             $result = $this->messages_model->Show_message();
            
          
             
            
            $data["messages"]=json_encode($result,JSON_UNESCAPED_UNICODE);
            
            
                $this->load->view('all_message',$data);
            }else{
                redirect('../login');
            }
        
        
	}
    
   
    
    
    //на вход давать строку json
    public function create()
	{
        $data_error=array();
        $data=array();
        ////этот иф убрать, если данные в функцию будут приходить джисон строкой
        if($this->input->get("data")==null){
            if($this->input->post('fio')!=null && $this->input->post('phone')!=null && $this->input->post('email')!=null){
                $data=array(
                    "fio"=>$this->input->post('fio'),
                    "phone"=>$this->input->post('phone'),
                    "email"=>$this->input->post('email')
                );
                $data=json_encode($data);
            }
        }else
            $data=$this->input->get("data");
        ////////////////////////////////////////////////////////
        
        
        if($data!=array() ||( $this->input->post('fio')!=null && $this->input->post('phone')!=null && $this->input->post('email')!=null)){
                $result = $this->messages_model->Create_message($data);
                $this->index();
            }else{
                $data_error+=["errors"=>"null json object given"];
                $this->index($data_error);
            }
        
        
	}
    
    
    public function __construct()
        {
                parent::__construct();
                $this->load->model('messages_model');
        
        }
    
    
        
        
}

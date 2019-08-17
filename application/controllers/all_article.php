<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class All_article extends CI_Controller {


	public function index($data=array())
	{
        
        if(isset($this->session->userdata['logged_in'])){
             $result = $this->articles_model->Show_article();
            
          
             
            
            $data["articles"]=json_encode($result,JSON_UNESCAPED_UNICODE);
            
            
                $this->load->view('all_article',$data);
            }else{
                redirect('../login');
            }
        
        
	}
    
    public function delete()
	{
        //заменить на переменную, если она будет получиаться иным образом чем постом
        if($this->input->post('id')!=null){
             $result = $this->articles_model->Delete_article($this->input->post('id'));
                $this->index();
            }else{
                $data=array("errors"=>"id cant be null");
                $this->index($data);
            }
        
        
	}
    
    
    //на вход давать строку json
    public function create()
	{
        $data_error=array();
        $data=array();
        ////этот иф убрать, если данные в функцию будут приходить джисон строкой
        if($this->input->get("data")==null){
            if($this->input->post('title')!=null && $this->input->post('text')!=null){
                $data=array(
                    "title"=>$this->input->post('title'),
                    "text"=>$this->input->post('text')
                );
                $data=json_encode($data);
            }
        }else
            $data=$this->input->get("data");
        ////////////////////////////////////////////////////////
        
        
        if($data!=array() ||( $this->input->post('title')!=null && $this->input->post('text')!=null)){
                $result = $this->articles_model->Create_article($data);
                $this->index();
            }else{
                $data_error+=["errors"=>"null json object given"];
                $this->index($data_error);
            }
        
        
	}
    
    
    public function __construct()
        {
                parent::__construct();
                $this->load->model('articles_model');
        
        }
    
    
        
        
}

<?php
class Messages_model extends CI_Model {

    
        public function __construct()
        {
                $this->load->database();
        }
    
        public function Show_message($id = false)
        {
            
                if ($id === false)
                {
                        $query = $this->db->get('messages');
                        return $query->result_array();
                }else{
                    $query = $this->db->get_where('id', $id);
                    return $query->row_array();
                }
                

                
        }
    
        public function Create_message($data)
        {
            $data = json_decode($data);
            $this->db->insert('messages', $data);      
        }
    
       
}
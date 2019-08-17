<?php
class Articles_model extends CI_Model {

    
        public function __construct()
        {
                $this->load->database();
        }
    
        public function Show_article($id = false)
        {
            
                if ($id === false)
                {
                        $query = $this->db->get('articles');
                        return $query->result_array();
                }else{
                    $query = $this->db->get_where('id', $id);
                    return $query->row_array();
                }
                

                
        }
    
        public function Create_article($data)
        {
            $data = json_decode($data);
            $this->db->insert('articles', $data);      
        }
    
        public function Delete_article($id)
        {
            $this -> db -> where('id', $id);
            $this -> db -> delete('articles');
            
        }
}
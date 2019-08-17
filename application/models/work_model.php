<?php
class Work_model extends CI_Model {

    
        public function __construct()
        {
                $this->load->database();
        }
    
        public function Show_work($id = false)
        {
            
                if ($id === false)
                {
                        $query = $this->db->get('works');
                        return $query->result_array();
                }else{
                    $query = $this->db->get_where('id', $id);
                    return $query->row_array();
                }
                

                
        }
    
        public function Create_work($data)
        {
            $data = json_decode($data);
            $this->db->insert('works', $data);      
        }
    
        public function Delete_work($id)
        {
            $this -> db -> where('id', $id);
            $this -> db -> delete('works');
            
        }
}
<?php
class Accaunt_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }
    
        public function Check($data)
        {
            /*
                if ($slug === FALSE)
                {
                        $query = $this->db->get('users');
                        return $query->result_array();
                }
                */

                $query = $this->db->get_where('users', $data);
                return $query->row_array();
        }
}
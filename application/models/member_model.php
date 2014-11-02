<?php

class Member_Model extends CI_Model{
    
    public function __construct() {
        parent:: __construct();
    }
    
    public function getMember($id = null){
        if ($id){
            // Get one specific user
            $this->db->select('*, business_directory.id');
            $this->db->from('business_directory');
            $this->db->join('chamber_category', 'chamber_category.id = business_directory.category_id');
            $this->db->where('business_directory.id', $id);
            
            $query = $this->db->get();
            $result = $query->row_array();
        } else {
            // Get full list of member
            // TODO : pagination
            $this->db->select('*, business_directory.id');
            $this->db->from('business_directory');
            $this->db->join('chamber_category', 'chamber_category.id = business_directory.category_id');
            
            $query = $this->db->get();
            $result = $query->result_array();
        }
        if ($result) {
            return $result;
        } else {
            return false;
        }
    }
    
    public function getMeberByCategory($category, $discount){
        
        $this->db->select('*, business_directory.id');
        $this->db->from('business_directory');
        $this->db->join('chamber_category', 'chamber_category.id = business_directory.category_id');
        if ($category){
            $this->db->where('business_directory.category_id', $category);
        }
        if ($discount){
            $this->db->where('business_directory.mem_to_mem_description IS NOT NULL');
            $this->db->where('TRIM(business_directory.mem_to_mem_description) <> ""');
        }

        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }


    // Parametter $data is an array()
    public function insertMember($data){
        
        $result = $this->db->insert('business_directory', $data);
        
        if ($result){
            return $this->db->insert_id();
        } else {
            return FALSE;
        }        
    }
    
    public function updateMember($id, $data){
        
        $query = $this->db->get_where('business_directory', array('id'=>$id));
        
        if ($query->row_array()){
            $this->db->where('id', $id);
            return $this->db->update('business_directory', $data);
        } else {
            return $this->createMember($id, $data);
        }
    }
    
    public function createMember($id, $data){
        $data['id'] = $id;
        return $this->db->insert('business_directory', $data);      
    }
    
    public function deleteMember($id){
        $result = $this->db->delete('business_directory', array('id'=>$id));
        if ($this->db->affected_rows() == 0){
            return FALSE;
        }
        return $result;
    }
    
}

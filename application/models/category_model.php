<?php

class Category_Model extends CI_Model{
    
    public function __construct() {
        parent:: __construct();
    }
    
    public function getCategory($id = null){
        if ($id){
            $query = $this->db->get_where('chamber_category', array('id'=>$id));
            $result = $query->row_array();
        } else {
            $query = $this->db->get('chamber_category');
            $result = $query->result_array();
        }
        if ($result) {
            return $result;
        } else {
            return false;
        }
    }
    
    public function getCategories(){
        $query = $this->db->get('chamber_category');
        if ($query->result_array()){
            return $query->result_array();
        } else {
            return false;
        }
    }
    
    public function insertCategory($category){
        $data = array(
            'category_name'=>$category
        );
        $result = $this->db->insert('chamber_category', $data);
        
        if ($result){
            return $this->db->insert_id();
        } else {
            return FALSE;
        }        
    }
    
    public function updateCategory($id, $category){
        $data = array(
            'category_name' => $category
        );
        
        $query = $this->db->get_where('chamber_category', array('id'=>$id));
        
        if ($query->row_array()){
            $this->db->where('id', $id);
            return $this->db->update('chamber_category', $data);
        } else {
            return $this->createCategory($id, $category);
        }
    }
    
    public function createCategory($id, $category){
        $data = array(
            'id' => $id,
            'category_name' => $category
        );
        return $this->db->insert('chamber_category', $data);      
    }
    
    // TODO : Catch delete constrain with foreign key.
    public function deleteCategory($id){
        try {
            $result = $this->db->delete('chamber_category', array('id'=>$id));
            if ($this->db->affected_rows() == 0){
                return FALSE;
            }
            return $result;
        } catch (Exception $e){
            echo "error";
        }
    }
}

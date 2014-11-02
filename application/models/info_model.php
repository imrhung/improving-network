<?php

class Info_Model extends CI_Model{
    
    public function __construct() {
        parent:: __construct();
    }
    
    public function getInfo(){
        $query = $this->db->get_where('area_info', array('id'=>1));
        $result = $query->row_array();
        if ($result) {
            return $result;
        } else {
            return false;
        }
    }
    
    public function updateInfo($phone, $headerUrl, $description){
        $data = array(
            'phone_number' => $phone,
            'description' => $description
        );
        if (!empty($headerUrl)){
            $data['header_photo_url'] = $headerUrl;
        }
        
        $query = $this->db->get_where('area_info', array('id'=>1));
        
        if ($query->row_array()){
            $this->db->where('id', 1);
            return $this->db->update('area_info', $data);
        } else {
            return $this->createInfo(1, $phone, $headerUrl, $description);
        }
    }
    
    public function createInfo($id, $phone, $headerUrl, $description){
        $data = array(
            'id' => $id,
            'phone_number' => $phone,
            'header_photo_url' => $headerUrl,
            'description' => $description
        );
        return $this->db->insert('area_info', $data);      
    }
    
}

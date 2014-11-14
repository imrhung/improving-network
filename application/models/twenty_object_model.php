<?php

class Twenty_Object_Model extends CI_Model{
    
    public function __construct() {
        parent:: __construct();
    }
    
    public function getWord($id = null){
        if ($id){
            $idList = explode(',', $id);
            if (count($idList) > 1 ){
                $this->db->where_in('id',$idList);
                $query = $this->db->get('game_twenty_object');
                $result = $query->result_array();
            } else {
                $query = $this->db->get_where('game_twenty_object', array('id'=>$id));
                $result = $query->row_array();
            }
            
            return $result;
        } else {
            return false;
        }
    }
    
    public function getRandomWord(){
        $this->db->order_by('id', 'random');
        $this->db->limit(1);
        $query = $this->db->get('game_twenty_object');
        $result = $query->row_array();

        return $result;
    }
    
    public function getNewWord($userId){ sdfsfddsf
        $this->db->order_by('id', 'random');
        $this->db->limit(1);
        $query = $this->db->get('game_twenty_object');
        $result = $query->row_array();

        return $result;
    }
    
    public function queryWord($word){
        if ($word){
            $idList = explode(',', $word);
            if (count($idList) > 1 ){
                $this->db->where_in('name',$idList);
                $query = $this->db->get('game_twenty_object');
                $result = $query->result_array();
            } else {
                $query = $this->db->get_where('game_twenty_object', array('name'=>$word));
                $result = $query->row_array();
            }
            
            return $result;
        } else {
            return false;
        }
    }
    
    public function getWordList($limit, $offset){
        // Limit the result
        if ($limit){
            if ($offset){
                $this->db->limit($limit, $offset);
            } else {
                $this->db->limit($limit);
            }
        }
        // Get the result back
        $query = $this->db->get('game_twenty_object');
        return $query->result_array();
    }
    
    public function createWord($data){
        
        $result = $this->db->insert('game_twenty_object', $data);
        
        if ($result){
            return $this->db->insert_id();
        } else {
            return FALSE;
        }        
    }
    
    public function updateWord($id, $data){
        
        $query = $this->db->get_where('game_twenty_object', array('id'=>$id));
        
        if ($query->row_array()){
            $this->db->where('id', $id);
            return $this->db->update('game_twenty_object', $data);
        } else {
            return $this->putWord($id, $data);
        }
    }
    
    public function putWord($id, $data){
        $insertData = array_merge(array('id'=>$id),$data);

        return $this->db->insert('game_twenty_object', $insertData);      
    }
    
    // TODO : Catch delete constrain with foreign key.
    public function deleteWord($id){
        try {
            $result = $this->db->delete('game_twenty_object', array('id'=>$id));
            if ($this->db->affected_rows() == 0){
                return FALSE;
            }
            return $result;
        } catch (Exception $e){
            return FALSE;
        }
    }
}

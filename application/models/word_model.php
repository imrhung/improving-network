<?php

class Word_Model extends CI_Model{
    
    public function __construct() {
        parent:: __construct();
    }
    
    public function getWord($id = null){
        if ($id){
            $idList = explode(',', $id);
            if (count($idList) > 1 ){
                $this->db->where_in('id',$idList);
                $query = $this->db->get('words_eng');
                $result = $query->result_array();
            } else {
                $query = $this->db->get_where('words_eng', array('id'=>$id));
                $result = $query->row_array();
            }
            
            return $result;
        } else {
            return false;
        }
    }
    
    public function queryWord($word){
        if ($word){
            $idList = explode(',', $word);
            if (count($idList) > 1 ){
                $this->db->where_in('word',$idList);
                $query = $this->db->get('words_eng');
                $result = $query->result_array();
            } else {
                $query = $this->db->get_where('words_eng', array('word'=>$word));
                $result = $query->row_array();
            }
            
            return $result;
        } else {
            return false;
        }
    }
    
    public function getWordList($limit, $offset, $picture, $part, $difficulty, $random){
        // Check picture
        if ($picture === '1'){
            $this->db->where('words_eng.picture_url IS NOT NULL');
            $this->db->where('TRIM(words_eng.picture_url) <> ""');
        }
        // Check part of speech
        if ($part){
            $partList = explode(',', $part);
            $this->db->where_in('part_of_speech', $partList);
        }
        // Check difficulty
        if ($difficulty){
            $difficultyList = explode(',', $difficulty);
            $this->db->where_in('difficulty', $difficultyList);
        }
        // Check random
        // Improve this query: http://jan.kneschke.de/projects/mysql/order-by-rand/
        if ($random === '1'){
            $this->db->order_by('id', 'random');
        }
        // Limit the result
        if ($limit){
            if ($offset){
                $this->db->limit($limit, $offset);
            } else {
                $this->db->limit($limit);
            }
        }
        // Get the result back
        $query = $this->db->get('words_eng');
        return $query->result_array();
    }
    
    public function createWord($data){
        
        $result = $this->db->insert('words_eng', $data);
        
        if ($result){
            return $this->db->insert_id();
        } else {
            return FALSE;
        }        
    }
    
    public function updateWord($id, $data){
        
        $query = $this->db->get_where('words_eng', array('id'=>$id));
        
        if ($query->row_array()){
            $this->db->where('id', $id);
            return $this->db->update('words_eng', $data);
        } else {
            return $this->putWord($id, $data);
        }
    }
    
    public function putWord($id, $data){
        $insertData = array_merge(array('id'=>$id),$data);

        return $this->db->insert('words_eng', $insertData);      
    }
    
    // TODO : Catch delete constrain with foreign key.
    public function deleteWord($id){
        try {
            $result = $this->db->delete('words_eng', array('id'=>$id));
            if ($this->db->affected_rows() == 0){
                return FALSE;
            }
            return $result;
        } catch (Exception $e){
            return FALSE;
        }
    }
}

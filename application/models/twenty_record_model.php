<?php

class Twenty_Record_Model extends CI_Model{
    
    public function __construct() {
        parent:: __construct();
    }
    
    // TODO: This function use multiple call to database to get data. This will be not good
    // for the performance. Consider improve it later.
    public function getRecord($userId, $objectId, $random, $limit, $offset){
        
        if ($userId) {
            $this->db->where('user_id', $userId);
        }
        if ($objectId) {
            $this->db->where('object_id', $objectId);
        }
        if ($random){
            $this->db->order_by('id', 'random');
        } else {
            $this->db->order_by('timestamp', 'DESC');
        }
        // Limit the result
        if ($limit){
            if ($offset){
                $this->db->limit($limit, $offset);
            } else {
                $this->db->limit($limit);
            }
        }
        $this->db->select('game_twenty_record.*, users.first_name, users.last_name, game_twenty_object.name, game_twenty_object.image_url');
        $this->db->from('game_twenty_record');
        $this->db->join('users', 'game_twenty_record.user_id = users.id');
        $this->db->join('game_twenty_object', 'game_twenty_record.object_id = game_twenty_object.id');
        $query = $this->db->get();
        $recordList = $query->result_array();
        
        // Now we add record detail into the array:
        $arrLength = count($recordList);
        for ($i=0; $i<$arrLength; $i++){
            $this->db->where('record_id', $recordList[$i]['id']);
            $this->db->select('id, content');
            $query = $this->db->get('game_twenty_idea');
            $ideaList = $query->result_array();
            
            $recordList[$i]['ideas'] = $ideaList;
        }
        
        return $recordList;
    }
    
    public function getRecordObject($objectId, $limit, $offset){
        
    }
    
    public function getRecordRandom(){
        
    }
    
    public function queryWord($word){
        if ($word){
            $idList = explode(',', $word);
            if (count($idList) > 1 ){
                $this->db->where_in('name',$idList);
                $query = $this->db->get('game_twenty_records');
                $result = $query->result_array();
            } else {
                $query = $this->db->get_where('game_twenty_records', array('name'=>$word));
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
        $query = $this->db->get('game_twenty_records');
        return $query->result_array();
    }
    
    public function createRecord($userId, $objectId, $contentArr){
        
        $record = array(
            'user_id' => $userId,
            'object_id' => $objectId
        );
        $this->db->insert('game_twenty_record', $record);
        $recordId = $this->db->insert_id();
        
        $data = array();
        // Loop through the array.
        foreach ($contentArr as $content ){
            $record = array(
                'record_id' => $recordId,
                'content' => $content->text
            );
            $data[] = $record;
        }
        $result = $this->db->insert_batch('game_twenty_idea', $data);
        
        if ($result){
            return TRUE;
        } else {
            return FALSE;
        }        
    }
    
    public function updateWord($id, $data){
        
        $query = $this->db->get_where('game_twenty_records', array('id'=>$id));
        
        if ($query->row_array()){
            $this->db->where('id', $id);
            return $this->db->update('game_twenty_records', $data);
        } else {
            return $this->putWord($id, $data);
        }
    }
    
    public function putWord($id, $data){
        $insertData = array_merge(array('id'=>$id),$data);

        return $this->db->insert('game_twenty_records', $insertData);      
    }
    
    // TODO : Catch delete constrain with foreign key.
    public function deleteWord($id){
        try {
            $result = $this->db->delete('game_twenty_records', array('id'=>$id));
            if ($this->db->affected_rows() == 0){
                return FALSE;
            }
            return $result;
        } catch (Exception $e){
            return FALSE;
        }
    }
}

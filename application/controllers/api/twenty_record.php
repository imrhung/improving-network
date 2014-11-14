<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH . '/libraries/REST_Controller.php';

class Twenty_Record extends REST_Controller {
    
    public function __construct() {
        parent:: __construct();
        $this->load->model('twenty_record_model');
    }

    function get() {

        $userId = $this->_get('user_id');
        
        $objectId = $this->_get('object_id');
        /* or */
        // just get random record
        $random = $this->_get('random');
        
        /* and */
        $limit = $this->_get('limit');
        $offset = $this->_get('offset');
        
        $response = $this->twenty_record_model->getRecord($userId, $objectId, $random, $limit, $offset);
        
        if ($response){
            $code = 200;
        } else {
            $code = 404;
            $response = array('error' => "404 - Not found");
        }
        $this->response($response, $code);
    }

    function post() {
        //$data = $this->_post_args;
        
        $userId = $this->_post('user_id');
        $objectId = $this->_post('object_id');
        $contentJson = $this->_post('content');
        $contentArr = json_decode($contentJson);
        
        $id = $this->twenty_record_model->createRecord($userId, $objectId, $contentArr);
        if ($id) {
            $this->response(array('success' => 'Content added'), 201); // 201 being the HTTP response code
        } else {
            $this->response(array('error' => 'Could not be created'), 404);
        }
    }

    public function put() {
        $id = $this->_get('id');
        if (!$id) {
            $this->response(array('error' => '400 - An "id" must be supplied by GET parameter to delete a word'), 400);
        } else {
            $data = $this->_put_args;
            if ($this->twenty_record_model->updateWord($id, $data)){
                $response = array_merge(array('id'=>$id),$data);
                $this->response($response, 200); // 201 being the HTTP response code
            } else {
                $this->response(array('error' => "Error"), 500);
            }
        }
    }

    function delete() {
        $id = $this->_get('id');
        if (!$id) {
            $this->response(array('error' => '400 - An "id" must be supplied by GET parameter to delete a word'), 400);
        } else {
            if ($this->twenty_record_model->deleteWord($id)){
                $this->response(array('id'=>$id), 200);
            } else {
                // Not found
                $this->response(array('error' => '404 - Word could not be found'), 404);
            }
        }
    }

}

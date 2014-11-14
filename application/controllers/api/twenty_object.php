<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH . '/libraries/REST_Controller.php';

class Twenty_Object extends REST_Controller {
    
    public function __construct() {
        parent:: __construct();
        $this->load->model('twenty_object_model');
    }

    function get() {

        $id = $this->_get('id');
        /* or */
        // get by query name :)
        $word = $this->_get('name');
        /* or */
        // just get random object
        $random = $this->_get('random');
        // or
        $userId = $this->_get('user_id');
        /* or */
        $limit = $this->_get('limit');
        $offset = $this->_get('offset');
        
        if ($id){
            $response = $this->twenty_object_model->getWord($id);
        } else if ($word) {
            $response = $this->twenty_object_model->queryWord($word);
        } else if ($random) {
            $response = $this->twenty_object_model->getRandomWord();
        } else if ($userId) {
            $response = $this->twenty_object_model->getNewWord($userId);
        } else {
            // If no "id" or 'word' provided.
            $response = $this->twenty_object_model->getWordList($limit, $offset);
        }
        if ($response){
            $code = 200;
        } else {
            $code = 404;
            $response = array('error' => "404 - Not found");
        }
        $this->response($response, $code);
    }

    function post() {
        $data = $this->_post_args;
        
        $word = strtolower($data['word']);
        
        // Check if word existed.
        if ($this->twenty_object_model->queryWord($word)){
            $this->response(array('error' => '409 - Conflict: Word existed'), 409);
        }
        // TODO : lower the 'word' before creating.
        $id = $this->twenty_object_model->createWord($data);
        if ($id) {
            $response = array_merge(array('id'=>$id),$data);

            $this->response($response, 201); // 201 being the HTTP response code
        } else {
            $this->response(array('error' => 'Word could not be created'), 404);
        }
    }

    public function put() {
        $id = $this->_get('id');
        if (!$id) {
            $this->response(array('error' => '400 - An "id" must be supplied by GET parameter to delete a word'), 400);
        } else {
            $data = $this->_put_args;
            if ($this->twenty_object_model->updateWord($id, $data)){
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
            if ($this->twenty_object_model->deleteWord($id)){
                $this->response(array('id'=>$id), 200);
            } else {
                // Not found
                $this->response(array('error' => '404 - Word could not be found'), 404);
            }
        }
    }

}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH . '/libraries/REST_Controller.php';

class Word extends REST_Controller {
    
    public function __construct() {
        parent:: __construct();
        $this->load->model('word_model');
    }

    function get() {

        $id = $this->_get('id');
        /* or */
        // get by query word :)
        $word = $this->_get('word');
        /* or */
        $limit = $this->_get('limit');
        $offset = $this->_get('offset');
        $picture = $this->_get('picture');
        $part = $this->_get('part_of_speech');
        $difficulty = $this->_get('difficulty');
        $random = $this->_get('random');
        
        if ($id){
            $response = $this->word_model->getWord($id);
        } else if ($word) {
            $response = $this->word_model->queryWord($word);
        } else {
            // If no "id" or 'word' provided.
            $response = $this->word_model->getWordList($limit, $offset, $picture, $part, $difficulty, $random);
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
        if ($this->word_model->queryWord($word)){
            $this->response(array('error' => '409 - Conflict: Word existed'), 409);
        }
        // TODO : lower the 'word' before creating.
        $id = $this->word_model->createWord($data);
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
            if ($this->word_model->updateWord($id, $data)){
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
            if ($this->word_model->deleteWord($id)){
                $this->response(array('id'=>$id), 200);
            } else {
                // Not found
                $this->response(array('error' => '404 - Word could not be found'), 404);
            }
        }
    }

}

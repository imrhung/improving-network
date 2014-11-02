<?php

/*
 * Code written by Nguyen Van Hung
 * Feel free to re-use or share it.
 * Happy code!!!
 */

defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH . '/libraries/REST_Controller.php';

class Service extends REST_Controller {
    
    public function __construct() {
        parent:: __construct();
        $this->load->model('category_model');
        $this->load->model('info_model');
        $this->load->model('member_model');
    }
    
    /*
     * One Member API
     */
    function member_get(){
        $id = $this->get('id');
        if ($id){
            $response = $this->member_model->getMember($id);
        } else {
            // If no "id" provided.
            // Check if category param?
            $category = $this->get('category');
            $discount = $this->get('discount');
            if ($category || $discount){
                // Filter
                $response = $this->member_model->getMeberByCategory($category, $discount);
            } else {
                // Get all member
                $response = $this->member_model->getMember();
            }
        }
        if ($response){
            $code = 200;
        } else {
            $code = 404;
            $response = "404 -Not found";
        }
        $this->response($response, $code);
    }
    
    // TODO : find the way to handle the $data more officient. If user send strange parametter, all error.
    function member_post(){
        $data = $this->post();
        // Check if valid input data
        if ($data){
            $id = $this->member_model->insertMember($data);
            if ($id){
                $code = 201;
                $response = array_merge(array('id'=>$id),$data);
            } else {
                $code = 500;
                $response = "500 - Internal Server Error - Database error";
            }
            $this->response($response, $code);
        } else {
            // Invalid input data
            $code = 400;
            $response = "400 - Bad Request.";
        }
    }
    
    function member_put(){
        $id = $this->get('id');
        $data = $this->put();
        if ($data && $id){
            if ($this->member_model->updateMember($id, $data)){
                $code = 200;
                $response = array_merge(array('id'=>$id),$data);
            } else {
                $code = 500;
                $response = "500 - Internal Server Error - Database error";
            }
        } else {
            // Invalid input data
            $code = 400;
            $response = "400 - Bad Request.";
        }
        $this->response($response, $code);
    }
    
    function member_delete(){
        $id = $this->get('id');
        if ($this->member_model->deleteMember($id)){
            $code = 200;
            $response = array(
                'id' => $id
            );
        } else {
            $code = 404;
            $response = "404 - Member not exist.";
        }
        $this->response($response, $code);
    }
    
    /*
     * Member list API
     */
    /*
     * Get list of member
     * Parameter: 
     *  *Get base on category
     */
    function members_get(){
        
    }
    
    /*
     * Category API
     */
    /*
     * Get Category resource
     * Provide "id" to get a specific category. Omit the "id" if you want to get all the list.
     */
    function category_get(){
        $id = $this->get('id');
        if ($id){
            $response = $this->category_model->getCategory($id);
        } else {
            // If no "id" provided, get full list
            $response = $this->category_model->getCategories();
        }
        if ($response){
            $code = 200;
        } else {
            $code = 404;
            $response = "404 - Category not found";
        }
        $this->response($response, $code);
    }
    
    function category_post(){
        $category = $this->post('category');
        if (! $category){
            $code = 400;
            $response = "400 - category field is required.";
        } else {
            $id = $this->category_model->insertCategory($category);
            if ($id){
                $code = 201;
                $response = array(
                    'id' => $id,
                    'category_name' => $category
                );
            } else {
                $code = 500;
                $response = "500 - Internal Server Error - Database error";
            }
        }
        $this->response($response, $code);
    }
    
    /*
     * PUT method
     */
    function category_put(){
        $id = $this->get('id');
        $category = $this->put('category');
        if (! $id) {
            $code = 400;
            $response = "400 - Bad request.";
        } else {
            if ($this->category_model->updateCategory($id, $category)){
                $code = 200;
                $response = array(
                    'id' => $id,
                    'category' => $category
                );
            } else {
                $code = 500;
                $response = "500 - Internal Server Error - Database error";
            }
            $this->response($response, $code);
        }
    }
    
    function category_delete(){
        $id = $this->get('id');
        if ($this->category_model->deleteCategory($id)){
            $code = 200;
            $response = array(
                'id' => $id
            );
        } else {
            $code = 404;
            $response = "404 - Category not exist in database.";
        }
        $this->response($response, $code);
    }
    
    /*
     * Get list Category
     * Not in use anymore.
     */
    function categories_get(){
        $response = $this->category_model->getCategories();
        if ($response){
            $code = 200;
        } else {
            $code = 404;
            $response = "404 - Category not found";
        }
        $this->response($response, $code);
    }
    
    /*
     * Area Information API
     */
    function info_get(){
        $response = $this->info_model->getInfo();
        if ($response){
            $code = 200;
        } else {
            $code = 404;
            $response = "404 - Not found";
        }
        $this->response($response, $code);
    }
    
    function info_put(){
        // Get parametters
        if ($this->put()){
            $phone = $this->put('phone_number');
            $headerUrl = $this->put('header_photo_url');
            $description = $this->put('description');

            if ($this->info_model->updateInfo($phone, $headerUrl, $description)){
                $code = 200;
                $response = array(
                    'id' => 1,
                    'phone_number' => $phone,
                    'header_photo_url' => $headerUrl,
                    'description' => $description
                );
            } else {
                $code = 500;
                $response = "500 - Internal Server Error - Database error";
            }
        } else {
            $code = 400;
            $response = "400 - Bad Request.";
        }
        $this->response($response, $code);
    }
    
    
    
    
    
    
    /*
     * Example code from http://philsturgeon.co.uk/blog/2009/06/REST-implementation-for-CodeIgniter
     */
    function user_get() {
        if (!$this->get('id')) {
            $this->response(NULL, 400);
        }

        // $user = $this->some_model->getSomething( $this->get('id') );
        $users = array(
            1 => array('id' => 1, 'name' => 'Some Guy', 'email' => 'example1@example.com', 'fact' => 'Loves swimming'),
            2 => array('id' => 2, 'name' => 'Person Face', 'email' => 'example2@example.com', 'fact' => 'Has a huge face'),
            3 => array('id' => 3, 'name' => 'Scotty', 'email' => 'example3@example.com', 'fact' => 'Is a Scott!', array('hobbies' => array('fartings', 'bikes'))),
        );

        $user = @$users[$this->get('id')];

        if ($user) {
            $this->response($user, 200); // 200 being the HTTP response code
        } else {
            $this->response(array('error' => 'User could not be found'), 404);
        }
    }

    function user_post() {
        //$this->some_model->updateUser( $this->get('id') );
        $message = array('id' => $this->get('id'), 'name' => $this->post('name'), 'email' => $this->post('email'), 'message' => 'ADDED!');

        $this->response($message, 200); // 200 being the HTTP response code
    }

    function user_delete() {
        //$this->some_model->deletesomething( $this->get('id') );
        $message = array('id' => $this->get('id'), 'message' => 'DELETED!');

        $this->response($message, 200); // 200 being the HTTP response code
    }

    function users_get() {
        //$users = $this->some_model->getSomething( $this->get('limit') );
        $users = array(
            array('id' => 1, 'name' => 'Some Guy', 'email' => 'example1@example.com'),
            array('id' => 2, 'name' => 'Person Face', 'email' => 'example2@example.com'),
            3 => array('id' => 3, 'name' => 'Scotty', 'email' => 'example3@example.com', 'fact' => array('hobbies' => array('fartings', 'bikes'))),
        );

        if ($users) {
            $this->response($users, 200); // 200 being the HTTP response code
        } else {
            $this->response(array('error' => 'Couldn\'t find any users!'), 404);
        }
    }

    public function send_post() {
        
        var_dump($this->post());
    }

    public function send_put() {
        var_dump($this->put());
    }
    
    public function send_delete(){
        var_dump($this->get('id'));
    }

}

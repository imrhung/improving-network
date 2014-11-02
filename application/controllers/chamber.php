<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Chamber extends App_Controller {

    public function __construct() {
        parent::__construct();
        
        // Check if user login
        if ($this->ion_auth->logged_in()) {
            // Do nothing
        } else {
            // Redirect user to login page
            redirect('login');
        }
    }

    public function index() {
        redirect('member');
    }
    
    public function member(){
        $this->body_class[] = 'home';
        $this->page_title = 'Member Directory';
        $this->current_section = 'member';
        
        $this->assets_css[] = 'plugins/dataTables/dataTables.bootstrap.css';
        $this->assets_js[] = 'plugins/dataTables/jquery.dataTables.js';
        $this->assets_js[] = 'plugins/dataTables/dataTables.bootstrap.js';
        $this->assets_js[] = 'chamber/member.js';
        $this->assets_js[] = 'bootbox/bootbox.min.js';

        $this->render_page('chamber/member');
    }
    
    public function category(){
        $this->body_class[] = 'home';
        $this->page_title = 'Category';
        $this->current_section = 'category';
        
        $this->assets_js[] = 'chamber/category.js';
        $this->assets_js[] = 'bootbox/bootbox.min.js';

        $this->render_page('chamber/category');
    }
    
    public function calendar(){
        $this->page_title = 'Calendar';
        $this->current_section = 'calendar';

        $this->render_page('chamber/calendar');
    }
    
    public function area_info(){
        $this->page_title = 'Area Information';
        $this->current_section = 'area_info';
        
        $this->assets_js[] = 'chamber/area_info.js';
        $this->assets_js[] = 'bootbox/bootbox.min.js';

        $this->render_page('chamber/area_info');
    }
    
    public function create_member(){
        $this->page_title = "Create a new member";
        $this->current_section = 'member';
        
        $this->assets_js[] = 'chamber/create_member.js';
        
        $data['memberId'] = 0;
        
        $this->render_page('chamber/create_member', $data);
    }
    
    public function edit_member($id = NULL){
        
        if ($id === NULL){
            redirect('member');
        }
        $this->page_title = "Edit member";
        $this->current_section = 'member';
        
        $this->assets_js[] = 'chamber/edit_member.js';
        
        $data['memberId'] = $id;
        
        $this->render_page('chamber/create_member', $data);
    }
}

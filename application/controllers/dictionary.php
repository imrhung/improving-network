<?php

/* 
 * Code written by Nguyen Van Hung at @imrhung
 * Feel free to re-use or share it.
 * Happy code!!!
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Dictionary extends App_Controller {

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
        $this->body_class[] = 'admin';
        $this->page_title = 'Dictionary';
        $this->current_section = 'dictionary';
        
        $this->assets_css[] = 'plugins/dataTables/dataTables.bootstrap.css';
        $this->assets_css[] = 'fileupload/jquery.fileupload.css';
        $this->assets_css[] = 'dictionary/dictionary.css';
        
        $this->assets_js[] = 'plugins/dataTables/jquery.dataTables.js';
        $this->assets_js[] = 'plugins/dataTables/dataTables.bootstrap.js';
        
        $this->assets_js[] = 'plugins/fileupload/vendor/jquery.ui.widget.js';
        $this->assets_js[] = 'plugins/fileupload/jquery.iframe-transport.js';
        $this->assets_js[] = 'plugins/fileupload/jquery.fileupload.js';
        
        $this->assets_js[] = 'dictionary/dictionary.js';
        $this->assets_js[] = 'bootbox/bootbox.min.js';

        $this->render_page('dictionary/dictionary');
    }
    
    
}

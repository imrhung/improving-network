<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class File extends App_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url', 'file'));
    }

    /*
     * Upload photo to same folder of source code. :)
     */

    // Using jQuery File Upload:
    // Name of the file field is : 'userfile'
    public function do_upload() {
        $upload_path_url = base_url() . 'assets/uploads/';

        $config['upload_path'] = FCPATH . 'assets/uploads/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['max_size'] = '30000';

        $this->load->library('upload', $config);

        if ($this->input->server('REQUEST_METHOD') === 'GET') {
            //Load the list of existing files in the upload directory
            $existingFiles = get_dir_file_info($config['upload_path']);
            $foundFiles = array();
            $f = 0;
            foreach ($existingFiles as $fileName => $info) {
                if ($fileName != 'thumbs') {//Skip over thumbs directory
                    //set the data for the json array   
                    $foundFiles[$f]['name'] = $fileName;
                    $foundFiles[$f]['size'] = $info['size'];
                    $foundFiles[$f]['url'] = $upload_path_url . $fileName;
                    $foundFiles[$f]['thumbnailUrl'] = $upload_path_url . 'thumbs/' . $fileName;
                    $foundFiles[$f]['deleteUrl'] = base_url() . 'api/file/deleteImage/' . $fileName;
                    $foundFiles[$f]['deleteType'] = 'DELETE';
                    $foundFiles[$f]['error'] = null;

                    $f++;
                }
            }
            $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode(array('files' => $foundFiles)));
        } else if (!$this->upload->do_upload()){
            // Upload error
            $error = array('error' => $this->upload->display_errors());
            //$this->load->view('upload', $error);
            //set the data for the json array
            $info = new StdClass;
            $info->name = null;
            $info->size = 0;
            $info->error = $this->upload->display_errors();

            $files[] = $info;
            
            echo json_encode(array("files" => $files));
        } else {
            $data = $this->upload->data();
            /*
             * Array
              (
              [file_name] => png1.jpg
              [file_type] => image/jpeg
              [file_path] => /home/ipresupu/public_html/uploads/
              [full_path] => /home/ipresupu/public_html/uploads/png1.jpg
              [raw_name] => png1
              [orig_name] => png.jpg
              [client_name] => png.jpg
              [file_ext] => .jpg
              [file_size] => 456.93
              [is_image] => 1
              [image_width] => 1198
              [image_height] => 1166
              [image_type] => jpeg
              [image_size_str] => width="1198" height="1166"
              )
             */
            // to re-size for thumbnail images un-comment and set path here and in json array
            $config = array();
            $config['image_library'] = 'gd2';
            $config['source_image'] = $data['full_path'];
            $config['create_thumb'] = TRUE;
            $config['new_image'] = $data['file_path'] . 'thumbs/';
            $config['maintain_ratio'] = TRUE;
            $config['thumb_marker'] = '';
            $config['width'] = 75;
            $config['height'] = 50;
            $this->load->library('image_lib', $config);
            $this->image_lib->resize();


            //set the data for the json array
            $info = new StdClass;
            $info->name = $data['file_name'];
            $info->size = $data['file_size'] * 1024;
            $info->type = $data['file_type'];
            $info->url = $upload_path_url . $data['file_name'];
            // I set this to original file since I did not create thumbs.  change to thumbnail directory if you do = $upload_path_url .'/thumbs' .$data['file_name']
            $info->thumbnailUrl = $upload_path_url . 'thumbs/' . $data['file_name'];
            $info->deleteUrl = base_url() . 'api/file/deleteImage/' . $data['file_name'];
            $info->deleteType = 'DELETE';
            $info->error = null;

            $files[] = $info;
            //this is why we put this in the constants to pass only json data
            if (IS_AJAX) {
                echo json_encode(array("files" => $files));
                //this has to be the only data returned or you will get an error.
                //if you don't give this a json array it will give you a Empty file upload result error
                //it you set this without the if(IS_AJAX)...else... you get ERROR:TRUE (my experience anyway)
                // so that this will still work if javascript is not enabled
            } else {
//                $file_data['upload_data'] = $this->upload->data();
//                $this->load->view('upload/upload_success', $file_data);
                echo json_encode(array("files" => $files));
            }
        }
    }

    public function deleteImage($file) {//gets the job done but you might want to add error checking and security
        $success = unlink(FCPATH . 'assets/uploads/' . $file);
        $success = unlink(FCPATH . 'assets/uploads/thumbs/' . $file);
        //info to see if it is doing what it is supposed to
        $info = new StdClass;
        $info->sucess = $success;
        $info->path = base_url() . 'uploads/' . $file;
        $info->file = is_file(FCPATH . 'uploads/' . $file);

        if (IS_AJAX) {
            //I don't think it matters if this is set but good for error checking in the console/firebug
            echo json_encode(array($info));
        } else {
            //here you will need to decide what you want to show for a successful delete        
//            $file_data['delete_data'] = $file;
//            $this->load->view('admin/delete_success', $file_data);
            echo json_encode(array($info));
        }
    }
    
    // Using jQuery File Upload for sound file:
    // Name of the file field is : 'userfile'
    public function do_upload_sound() {
        $upload_path_url = base_url() . 'assets/uploads/sound/';

        $config['upload_path'] = FCPATH . 'assets/uploads/sound/';
        $config['allowed_types'] = 'mp3|acc|wav';
        $config['max_size'] = '30000';

        $this->load->library('upload', $config);

        if ($this->input->server('REQUEST_METHOD') === 'GET') {
            //Load the list of existing files in the upload directory
            $existingFiles = get_dir_file_info($config['upload_path']);
            $foundFiles = array();
            $f = 0;
            foreach ($existingFiles as $fileName => $info) {
                if ($fileName != 'thumbs') {//Skip over thumbs directory
                    //set the data for the json array   
                    $foundFiles[$f]['name'] = $fileName;
                    $foundFiles[$f]['size'] = $info['size'];
                    $foundFiles[$f]['url'] = $upload_path_url . $fileName;
                    $foundFiles[$f]['deleteUrl'] = base_url() . 'api/file/deleteSound/' . $fileName;
                    $foundFiles[$f]['deleteType'] = 'DELETE';
                    $foundFiles[$f]['error'] = null;

                    $f++;
                }
            }
            $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode(array('files' => $foundFiles)));
        } else if (!$this->upload->do_upload()){
            // Upload error
            $error = array('error' => $this->upload->display_errors());
            //$this->load->view('upload', $error);
            //set the data for the json array
            $info = new StdClass;
            $info->name = null;
            $info->size = 0;
            $info->error = $this->upload->display_errors();

            $files[] = $info;
            
            echo json_encode(array("files" => $files));
        } else {
            $data = $this->upload->data();
            /*
             * Array
              (
              [file_name] => png1.jpg
              [file_type] => image/jpeg
              [file_path] => /home/ipresupu/public_html/uploads/
              [full_path] => /home/ipresupu/public_html/uploads/png1.jpg
              [raw_name] => png1
              [orig_name] => png.jpg
              [client_name] => png.jpg
              [file_ext] => .jpg
              [file_size] => 456.93
              [is_image] => 1
              [image_width] => 1198
              [image_height] => 1166
              [image_type] => jpeg
              [image_size_str] => width="1198" height="1166"
              )
             */


            //set the data for the json array
            $info = new StdClass;
            $info->name = $data['file_name'];
            $info->size = $data['file_size'] * 1024;
            $info->type = $data['file_type'];
            $info->url = $upload_path_url . $data['file_name'];
            $info->deleteUrl = base_url() . 'api/file/deleteSound/' . $data['file_name'];
            $info->deleteType = 'DELETE';
            $info->error = null;

            $files[] = $info;
            //this is why we put this in the constants to pass only json data
            if (IS_AJAX) {
                echo json_encode(array("files" => $files));
                //this has to be the only data returned or you will get an error.
                //if you don't give this a json array it will give you a Empty file upload result error
                //it you set this without the if(IS_AJAX)...else... you get ERROR:TRUE (my experience anyway)
                // so that this will still work if javascript is not enabled
            } else {
//                $file_data['upload_data'] = $this->upload->data();
//                $this->load->view('upload/upload_success', $file_data);
                echo json_encode(array("files" => $files));
            }
        }
    }

    public function deleteSound($file) {//gets the job done but you might want to add error checking and security
        $success = unlink(FCPATH . 'assets/uploads/sound/' . $file);
        //info to see if it is doing what it is supposed to
        $info = new StdClass;
        $info->sucess = $success;
        $info->path = base_url() . 'uploads/sound/' . $file;
        $info->file = is_file(FCPATH . 'uploads/sound/' . $file);

        if (IS_AJAX) {
            //I don't think it matters if this is set but good for error checking in the console/firebug
            echo json_encode(array($info));
        } else {
            //here you will need to decide what you want to show for a successful delete        
//            $file_data['delete_data'] = $file;
//            $this->load->view('admin/delete_success', $file_data);
            echo json_encode(array($info));
        }
    }

    //    Using barly Codeigniter
    public function upload() {
        // Codeigniter config
        $config['upload_path'] = './assets/uploads/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '1000';
        $config['max_width'] = '2024';
        $config['max_height'] = '1768';

        //set filename in config for upload
        $config['file_name'] = md5(time());

        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        // Init result json file:
        $result = array();
        $result['code'] = -1;
        $result['message'] = "";
        $result['info'] = array();

        if ($this->upload->do_upload()) {

            // Upload successful
            $result['code'] = 1;
            $result['message'] = "Success";
            $result['info'] = array(
                'file_name' => $this->upload->file_name
            );
        } else {
            // Upload error
            $result['code'] = 0;
            $result['message'] = "Fail";
        }

        echo json_encode($result);
    }

    /*
     * Import the word from http://www.englishclass101.com/english-word-lists/?coreX=100
     */
    public function importclass101(){
        $this->load->model('word_model');
        
        //header('Content-type: application/json');
        // Get the json file
        $data = json_decode(file_get_contents('php://input'),true);
        
        //var_dump($data);
        
        // Now save to ther database.
        foreach($data as $word){
            
            $wordData = array();
            $wordData['word'] = $word['word'];
            if (sizeof($word['phrases'])){
                $wordData['definition'] = $word['phrases'][0]['text'];
            }
            if (sizeof($word['sentences'])){
                $wordData['example'] = $word['sentences'][0]['text'];
                $wordData['sound_example_url'] = $word['sentences'][0]['audio'];
            }
            $wordData['picture_url'] = 'http://cdn.innovativelanguage.com/wordlists/media/thumb/'.$word['img'].'_90s_.jpg';
            $wordData['sound_url'] = $word['audio'];
            if ($word['class'] == 'noun'){
                $wordData['part_of_speech'] = 1;
            } else if ($word['class'] == 'pronoun'){
                $wordData['part_of_speech'] = 2;
            } else if ($word['class'] == 'adjective'){
                $wordData['part_of_speech'] = 3;
            } else if ($word['class'] == 'determiner'){
                $wordData['part_of_speech'] = 4;
            } else if ($word['class'] == 'verb'){
                $wordData['part_of_speech'] = 5;
            } else if ($word['class'] == 'adverb'){
                $wordData['part_of_speech'] = 6;
            } else if ($word['class'] == 'preposition'){
                $wordData['part_of_speech'] = 7;
            } else if ($word['class'] == 'conjunction'){
                $wordData['part_of_speech'] = 8;
            } else if ($word['class'] == 'interjection'){
                $wordData['part_of_speech'] = 9;
            } else if ($word['class'] == 'expression'){
                $wordData['part_of_speech'] = 10;
            } else if ($word['class'] == 'proper noun'){
                $wordData['part_of_speech'] = 11;
            } else {
                $wordData['part_of_speech'] = 0;
            }
            $wordData['difficulty'] = 1;
            
            $this->word_model->createWord($wordData);
            
        }
        echo "OK";
    }
}

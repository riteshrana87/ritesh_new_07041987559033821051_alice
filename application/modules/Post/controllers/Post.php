<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Post extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('upload');
        $this->load->library('mongo_db', array('activate' => 'default'), 'mongo_db');
    }

    public function index() {
        $data['catagory'] = $this->mongo_db->get('catagoryCollection');
        $this->load->view('addpost', $data);
    }

    public function addPostData() {
        $files = $_FILES;
        $cpt = count($_FILES['userfile']['name']);
        for ($i = 0; $i < $cpt; $i++) {
            $_FILES['userfile']['name'] = $files['userfile']['name'][$i];
            $_FILES['userfile']['type'] = $files['userfile']['type'][$i];
            $_FILES['userfile']['tmp_name'] = $files['userfile']['tmp_name'][$i];
            $_FILES['userfile']['error'] = $files['userfile']['error'][$i];
            $_FILES['userfile']['size'] = $files['userfile']['size'][$i];
            $this->upload->initialize($this->set_upload_options());
            $this->upload->do_upload();
            $fileName = $_FILES['userfile']['name'];
            $images[] = $fileName;
        }
        $fileName = implode(',', $images);
        $data = array('title' => $this->input->post('post_title'),
            'description' => $this->input->post('post_desc'),
            'catagories' => $this->input->post('post_catag'),
            'saved_at' => date('d-m-Y'),
            'featureImage' => $fileName
        );
        $this->mongo_db->insert('postCollection', $data);
        redirect(site_url('post/viewpost'));
    }

    private function set_upload_options() {
        $config = array();
        $config['upload_path'] = './upload/'; //give the path to upload the image in folder
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = '0';
        $config['overwrite'] = FALSE;
        return $config;
    }

    public function viewPost() {
        $data['user'] = $this->mongo_db->get('postCollection');
        $this->load->view('viewpost', $data);
    }

    public function editPost($id) {
// echo $id;
        $data['user'] = $this->mongo_db->get_where('postCollection', array('_id' => new \MongoId($id)));
        $this->load->view('editPost', $data);
    }

    public function deletePost($id) {
        $id = new MongoId($id);
        $this->mongo_db->where(array('_id' => $id))->delete('postCollection');
        redirect(site_url('post/viewPost'));
    }

    public function updatePost() {
        $id = $this->input->post('post_id');
        $data = array('title' => $this->input->post('post_title'),
            'description' => $this->input->post('post_desc'),
            'catagories' => $this->input->post('post_catag'),
            'saved_at' => date('d-m-Y')
        );
        $this->mongo_db->where('_id', new MongoId($id))->set($data)->update('postCollection');
        redirect(site_url('post/viewPost'));
    }

}

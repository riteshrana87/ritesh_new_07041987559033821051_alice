<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Ideal extends Public_controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('upload');
        $this->load->library('mongo_db', array('activate' => 'default'), 'mongo_db');
        $this->module = $this->router->fetch_class();
        $this->viewname = $this->router->fetch_class();
    }

    public function index() {
		 $data['pageTitle'] = lang('ideal_payment');
        $data['main_content'] = '/AddEditIdeal';
        $data['footerJs'][0] = base_url('uploads/assets/plugins/parsleyjs/dist/parsley.min.js');
        $data['footerJs'][1] = base_url('uploads/custom/paypal/paypal.js');
        $id=$this->session->userdata('alice_session')['_id'];
		$data['ideal'] = $this->mongo_db->get_where('ideal_config', array('client_id' => new \MongoId($id)));
		/*pr($data['paypal']);
		die();*/
		
		
        $this->parser->parse('layouts/PageTemplate', $data);
        
    }

    public function GridView() {
        $data['main_content'] = '/GridView';
        $data['pageTitle'] = lang('clients');
        $data['clients'] = $this->mongo_db->get('Client');
        $data['footerJs'][0] = base_url('uploads/assets/plugins/bootstrap-sweetalert/sweet-alert.min.js');
        $data['footerJs'][1] = base_url('assets/pages/jquery.sweet-alert.init.js');
        $data['footerJs'][2] = base_url('uploads/custom/client/client.js');
        $data['headerCss'][0] = base_url('uploads/assets/plugins/bootstrap-sweetalert/sweet-alert.css');
        $data['headerCss'][1] = base_url('uploads/custom/Developer.css');
        $this->parser->parse('layouts/PageTemplate', $data);
    }

    public function Add() {

        $data['pageTitle'] = lang('create_client');
        $data['main_content'] = '/AddClient';
        $data['footerJs'][0] = base_url('uploads/assets/plugins/parsleyjs/dist/parsley.min.js');
        $data['footerJs'][1] = base_url('uploads/custom/client/client.js');

        $this->parser->parse('layouts/PageTemplate', $data);
    }

    public function Edit($id) {

        $data['pageTitle'] = lang('edit_client');
        if ($id != '') {
            $data['client'] = $this->mongo_db->get_where('Client', array('_id' => new \MongoId($id)));

            $data['main_content'] = '/EditClient';
            $data['footerJs'][0] = base_url('uploads/assets/plugins/parsleyjs/dist/parsley.min.js');
            $data['footerJs'][1] = base_url('uploads/custom/client/client.js');

            $this->parser->parse('layouts/PageTemplate', $data);
        } else {
            redirect(base_url('Client'));
        }
    }

    public function InsertData() {

        $this->load->library('form_validation');
        $marchangeid = $this->input->post('marchangeid');
        $key = $this->input->post('key');
        $keyversion = $this->input->post('kerversion');
        
        $this->form_validation->set_error_delimiters(ERROR_START_DIV_NEW, ERROR_END_DIV);
        $this->form_validation->set_rules('marchangeid', 'marchangeid', 'trim|required');
        $this->form_validation->set_rules('key', 'key', 'trim|required');
        $this->form_validation->set_rules('keyversion', 'kerversion', 'trim|required');

        //$this->form_validation->set_rules('password', 'Password', 'trim|required|callback_check_database');



        if ($this->form_validation->run() == FALSE) {
            $error_msg = validation_errors();
            $this->session->set_flashdata('error', $error_msg);
            redirect(site_url('Paypal'));
            //Field validation failed.  User redirected to login page
        } else {
            // $files = $_FILES;
            $data = array('marchangeid' => $this->input->post('marchangeid'),
				'key' => $this->input->post('key'),
				'keyversion' => $this->input->post('keyversion'),
                'client_id' => $this->session->userdata('alice_session')['_id'],
                'created_at' => date('Y-m-d h:i:s'),
                'created_by' => $this->session->userdata('alice_session')['_id'],
            );
            $id=$this->session->userdata('alice_session')['_id'];
            $data['ideal'] = $this->mongo_db->get_where('ideal_config', array('client_id' => new \MongoId($id)));
            if(count($data['ideal'])>0){
				$this->mongo_db->where('client_id', new MongoId($id))->set($data)->update('ideal_config');
			$error_msg = SUCCESS_START_DIV_NEW . lang('ideal_key_message_edit') . SUCCESS_END_DIV;
            $this->session->set_flashdata('message', $error_msg);
				}
            else{
            $this->mongo_db->insert('ideal_config', $data);
            $error_msg = SUCCESS_START_DIV_NEW . lang('ideal_key_message_add') . SUCCESS_END_DIV;
            $this->session->set_flashdata('message', $error_msg);
				}
            
            redirect(base_url('Ideal'));
        }
    }

    public function Delete($id) {
        $id = new MongoId($id);
        $this->mongo_db->where(array('_id' => $id))->delete('Client');
        $error_msg = SUCCESS_START_DIV_NEW . lang('account_del_msg') . SUCCESS_END_DIV;
        $this->session->set_flashdata('message', $error_msg);
        redirect(site_url('Client'));
    }

    public function UpdateData() {

        $id = $this->input->post('_id');
        $this->load->library('form_validation');
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $this->form_validation->set_error_delimiters(ERROR_START_DIV_NEW, ERROR_END_DIV);
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('firstname', 'firstname', 'trim|required');
        $this->form_validation->set_rules('lastname', 'lastname', 'trim|required');
        $this->form_validation->set_rules('company', 'company', 'trim|required');
        //$this->form_validation->set_rules('password', 'Password', 'trim|required|callback_check_database');



        if ($this->form_validation->run() == FALSE) {
            $error_msg = ERROR_START_DIV_NEW . lang('common_error_form_submit') . ERROR_END_DIV;
            $this->session->set_flashdata('error', $error_msg);
            //Field validation failed.  User redirected to login page
            //$error_array = validation_errors();
            redirect($this->viewname);
        } else {
            // $files = $_FILES;
            $data = array('firstname' => $this->input->post('firstname'),
                'lastname' => $this->input->post('lastname'),
                'company' => $this->input->post('company'),
                'email' => $this->input->post('email'),
                'phone' => $this->input->post('phone'),
                'address' => $this->input->post('address'),
                'zipcode' => $this->input->post('zipcode'),
                'city' => $this->input->post('city'),
                'state' => $this->input->post('state'),
                'country' => $this->input->post('country'),
                'updated_at' => date('Y-m-d h:i:s'),
                'updated_by' => $this->session->userdata('alice_session')['_id'],
            );
            $this->mongo_db->where('_id', new MongoId($id))->set($data)->update('Client');

            $error_msg = SUCCESS_START_DIV_NEW . lang('account_update_msg') . SUCCESS_END_DIV;
            $this->session->set_flashdata('message', $error_msg);
            redirect(site_url('Client'));
        }
    }

}

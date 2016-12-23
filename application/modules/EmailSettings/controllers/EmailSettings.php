<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class EmailSettings extends Public_controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('upload');
        $this->load->library('mongo_db', array('activate' => 'default'), 'mongo_db');
        $this->module = $this->router->fetch_class();
        $this->viewname = $this->router->fetch_class();
    }

    public function index() {
        $data['main_content'] = '/AddSettings';
        $data['pageTitle'] = lang('emailsettings');
		$data['useremailsettings'] = $this->mongo_db->get('EmailSettings');
        //$parameters['total_rows']=
        //Pagination Sample code

        $parameters = isset($_GET) ? $_GET : array();
        $itemsPerPage = 10;
        $sortOrderParam = -1;
        $data['sortOrder'] = (isset($parameters['sortOrder'])) ? $parameters['sortOrder'] : 'asc';
        if ($data['sortOrder'] == 'asc') {
            $sortOrderParam = 0;
        }
        $data['sortField'] = (isset($parameters['sortField'])) ? $parameters['sortField'] : '_id';


        $data['search'] = (isset($parameters['search'])) ? $parameters['search'] : '';
        if ($data['search'] != '') {
            $data['search'] = $parameters['search'];
        }
        if (isset($parameters['start_rows'])) {
            $currentPage = $parameters['start_rows'];
        } else {
            $currentPage = 0;
        }
        $url = base_url('Client?start_rows=' . $currentPage);
//        if ((isset($parameters['total_rows']) && !empty($parameters['total_rows'])) && (isset($parameters['start_rows']))) {
//            $itemsPerPage = $parameters['total_rows'];
//            $currentPage = $parameters['start_rows'];
//        } else {
//            $currentPage = 0;
//            
//        }
        //$this->mongo_db is the handler of MongoDB library
        //  pr($parameters);
//     /   echo $currentPage;
        $pagination = new MongoPagination($this->mongo_db, $parameters);
        $parseParam = array(
            '#collection' => 'Profile',
            '#select' => array('_id', 'firstname', 'lastname', 'username','password', 'company','company_info', 'phone','phone-2', 'address', 'zipcode', 'city', 'state', 'country','profile_picture','company_logo', 'created_at'),
            // '#find' => array('age' => '25'),
            '#sort' => array($data['sortField'] => $sortOrderParam),
        );
        if ($data['search'] != '') {
            $value = $data['search'];
            $flags = 'i';
            $value = (string) trim($value);
            $value = quotemeta($value);
            $value = "^" . $value;
            $value .= "$";
            $regex = "/$value/$flags";
            $filteredSearch= new MongoRegex($regex);
            echo $filteredSearch;
            die;
            $parseParam['#find'] = array('company' => $filteredSearch);
        }
        $pagination->setParameters($parseParam, $currentPage, $itemsPerPage);

        $dataSet = $pagination->Paginate();
        $result = $dataSet['dataset'];
        $data['pagination']['totalPages'] = $dataSet['totalPages'];
        $data['pagination']['totalItems'] = $dataSet['totalItems'];
        $data['pagination']['links'] = $pagination->getPageLinks();
        //$data['profile'] = $result; //$this->mongo_db->get('Client');
        $data['profile'] = $this->mongo_db->get('User');
        //$this->mongo_db->explain();
        //  $data['clients']=$this->mongo_db->get('Client');
        $data['footerJs'][0] = base_url('uploads/assets/plugins/bootstrap-sweetalert/sweet-alert.min.js');
        $data['footerJs'][1] = base_url('assets/pages/jquery.sweet-alert.init.js');
        $data['footerJs'][2] = base_url('uploads/custom/client/client.js');
        $data['headerCss'][0] = base_url('uploads/assets/plugins/bootstrap-sweetalert/sweet-alert.css');
        $data['headerCss'][1] = base_url('uploads/custom/Developer.css');
        $data['url'] = $url;

        if ($this->input->is_ajax_request()) {
            if ($this->input->post('view') == 'grid') {
                $this->load->view('GridView', $data);
            } else {
                $this->load->view('ListView', $data);
            }
        } else {
            $this->parser->parse('layouts/PageTemplate', $data);
        }
    }

    public function GridView() {
        $data['main_content'] = '/GridView';
        $data['pageTitle'] = lang('clients');
        $data['clients'] = $this->mongo_db->get('Client');
        $data['footerJs'][0] = base_url('uploads/assets/plugins/bootstrap-sweetalert/sweet-alert.min.js');
        $data['footerJs'][1] = base_url('assets/pages/jquery.sweet-alert.init.js');
        $data['footerJs'][2] = base_url('uploads/custom/client/client.js');
        $data['footerJs'][3] = base_url('uploads/assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js');
        $data['footerJs'][4] = base_url('uploads/assets/plugins/bootstrap-daterangepicker/daterangepicker.js');
        $data['footerJs'][5] = base_url('uploads/assets/plugins/multiselect/js/jquery.multi-select.js');
        $data['footerJs'][6] = base_url('uploads/assets/plugins/jquery-quicksearch/jquery.quicksearch.js');
        $data['footerJs'][7] = base_url('uploads/assets/plugins/select2/dist/js/select2.min.js');
		
		$data['headerCss'][0] = base_url('uploads/assets/plugins/bootstrap-sweetalert/sweet-alert.css');
        $data['headerCss'][1] = base_url('uploads/custom/Developer.css');
		$data['headerCss'][2] = base_url('uploads/assets/plugins/multiselect/css/multi-select.css');
        $data['headerCss'][3] = base_url('uploads/assets/plugins/select2/dist/css/select2.css');
        $data['headerCss'][4] = base_url('uploads/assets/plugins/select2/dist/css/select2-bootstrap.css');
        $this->parser->parse('layouts/PageTemplate', $data);
    }

    public function Add() {

        $data['pageTitle'] = lang('create_client');
        $data['main_content'] = '/AddProfile';
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
            redirect(base_url('Profile'));
        }
    }

    public function InsertData() {


        $this->load->library('form_validation');
       /*  $email = $this->input->post('email');
        $password = $this->input->post('password'); */
        $this->form_validation->set_error_delimiters(ERROR_START_DIV_NEW, ERROR_END_DIV);
		$this->form_validation->set_rules('smtpfromemail', 'smtpfromemail', 'trim|valid_email');
		$this->form_validation->set_rules('smtpfromname', 'smtpfromname', 'trim');
		$this->form_validation->set_rules('smtphost', 'smtphost', 'trim');
		$this->form_validation->set_rules('smtptypeofencryption', 'smtptypeofencryption', 'trim');
		$this->form_validation->set_rules('smtpport', 'smtpport', 'trim');
		$this->form_validation->set_rules('smtpauthentication', 'smtpauthentication', 'trim');
		$this->form_validation->set_rules('smtpusername', 'smtpusername', 'trim');
		$this->form_validation->set_rules('smtpupassword', 'smtpupassword', 'trim');
		$this->form_validation->set_rules('imapfromemail', 'imapfromemail', 'trim|valid_email');
		$this->form_validation->set_rules('imapfromname', 'imapfromname', 'trim');
		$this->form_validation->set_rules('imaphost', 'imaphost', 'trim');
		$this->form_validation->set_rules('imapport', 'imapport', 'trim');
		$this->form_validation->set_rules('imapusername', 'imapusername', 'trim');
        $this->form_validation->set_rules('imappassword', 'imappassword', 'trim');
       /*  $this->form_validation->set_rules('profile_picture', 'profile_picture', 'required');
        $this->form_validation->set_rules('company_logo', 'company_logo', 'required'); */
        //$this->form_validation->set_rules('password', 'Password', 'trim|required|callback_check_database');


        if ($this->form_validation->run() == FALSE) {
            $error_msg = validation_errors();
            $this->session->set_flashdata('error', $error_msg);
            redirect(site_url('EmailSettings'));
            //Field validation failed.  User redirected to login page
        } else {
           
			$old_data = $this->mongo_db->get('User');
			
            $data = array('user_id' => $this->session->userdata('alice_session')['_id'],
				'smtpfromemail' => $this->input->post('smtpfromemail'),
                'smtpfromname' => $this->input->post('smtpfromname'),
                'smtphost' => $this->input->post('smtphost'),
                'smtptypeofencryption' => $this->input->post('smtptypeofencryption'),
				'smtpport' => $this->input->post('smtpport'),
				'smtpauthentication' => $this->input->post('smtpauthentication'),
                'smtpusername' => $this->input->post('smtpusername'),
                'smtpupassword' => $this->input->post('smtpupassword'),
                'imapfromemail' => $this->input->post('imapfromemail'),
                'imapfromname' => $this->input->post('imapfromname'),
                'imaphost' => $this->input->post('imaphost'),
                'imapport' => $this->input->post('imapport'),
                'imapusername' => $this->input->post('imapusername'),
                'imappassword' => $this->input->post('imappassword'),
                'created_at' => date('Y-m-d h:i:s'),
                'created_by' => $this->session->userdata('alice_session')['_id']
            );
			
			
		/* 	 print_r($data);
			die();  
			 */
		//echo $this->session->userdata['alice_session']['firstname'].' '.$this->session->userdata['alice_session']['lastname'];
		  
           $this->mongo_db->insert('EmailSettings', $data);
			//$this->mongo_db->where('_id', new MongoId($this->session->userdata('alice_session')['_id']))->set($data)->update('User'); 
			//$this->session->set_userdata('alice_session', $data);
            $error_msg = SUCCESS_START_DIV_NEW . lang('profile_add_msg') . SUCCESS_END_DIV;
            $this->session->set_flashdata('message', $error_msg);
            redirect(base_url('Emailsettings'));
        }

    }

    public function Delete($id) {
        $id = new MongoId($id);
        $this->mongo_db->where(array('_id' => $id))->delete('Client');
        $error_msg = SUCCESS_START_DIV_NEW . lang('account_del_msg') . SUCCESS_END_DIV;
        $this->session->set_flashdata('message', $error_msg);
        redirect(site_url('Profile'));
    }

    public function UpdateData() {

        $id = $this->input->post('_id');
        $this->load->library('form_validation');
       /*  $email = $this->input->post('email');
        $password = $this->input->post('password'); */
        $this->form_validation->set_error_delimiters(ERROR_START_DIV_NEW, ERROR_END_DIV);
		$this->form_validation->set_rules('smtpfromemail', 'smtpfromemail', 'trim|valid_email');
		$this->form_validation->set_rules('smtpfromname', 'smtpfromname', 'trim');
		$this->form_validation->set_rules('smtphost', 'smtphost', 'trim');
		$this->form_validation->set_rules('smtptypeofencryption', 'smtptypeofencryption', 'trim');
		$this->form_validation->set_rules('smtpport', 'smtpport', 'trim');
		$this->form_validation->set_rules('smtpauthentication', 'smtpauthentication', 'trim');
		$this->form_validation->set_rules('smtpusername', 'smtpusername', 'trim');
		$this->form_validation->set_rules('smtpupassword', 'smtpupassword', 'trim');
		$this->form_validation->set_rules('imapfromemail', 'imapfromemail', 'trim|valid_email');
		$this->form_validation->set_rules('imapfromname', 'imapfromname', 'trim');
		$this->form_validation->set_rules('imaphost', 'imaphost', 'trim');
		$this->form_validation->set_rules('imapport', 'imapport', 'trim');
		$this->form_validation->set_rules('imapusername', 'imapusername', 'trim');
        $this->form_validation->set_rules('imappassword', 'imappassword', 'trim');
        //$this->form_validation->set_rules('password', 'Password', 'trim|required|callback_check_database');



        if ($this->form_validation->run() == FALSE) {
            $error_msg = ERROR_START_DIV_NEW . lang('common_error_form_submit') . ERROR_END_DIV;
            $this->session->set_flashdata('error', $error_msg);
            //Field validation failed.  User redirected to login page
            //$error_array = validation_errors();
            redirect($this->viewname);
        } else {
           $data = array('user_id' => $this->session->userdata('alice_session')['_id'],
				'smtpfromemail' => $this->input->post('smtpfromemail'),
                'smtpfromname' => $this->input->post('smtpfromname'),
                'smtphost' => $this->input->post('smtphost'),
                'smtptypeofencryption' => $this->input->post('smtptypeofencryption'),
				'smtpport' => $this->input->post('smtpport'),
				'smtpauthentication' => $this->input->post('smtpauthentication'),
                'smtpusername' => $this->input->post('smtpusername'),
                'smtpupassword' => $this->input->post('smtpupassword'),
                'imapfromemail' => $this->input->post('imapfromemail'),
                'imapfromname' => $this->input->post('imapfromname'),
                'imaphost' => $this->input->post('imaphost'),
                'imapport' => $this->input->post('imapport'),
                'imapusername' => $this->input->post('imapusername'),
                'imappassword' => $this->input->post('imappassword')
            );
            
			
			/* print_r($data);
			die(); */
			
			$this->mongo_db->where('_id', new MongoId($id))->set($data)->update('EmailSettings');
            $error_msg = SUCCESS_START_DIV_NEW . lang('emailsetting_update_msg') . SUCCESS_END_DIV;
            $this->session->set_flashdata('message', $error_msg);
            redirect(site_url('EmailSettings'));
        }
    }

}

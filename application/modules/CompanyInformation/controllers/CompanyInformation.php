<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class CompanyInformation extends Public_controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('upload');
        $this->load->library('mongo_db', array('activate' => 'default'), 'mongo_db');
        $this->module = $this->router->fetch_class();
        $this->viewname = $this->router->fetch_class();
    }

    public function index() {
        $data['main_content'] = '/AddCompanyInformation';
        $data['pageTitle'] = lang('confirm_company_details');
		$data['countries'] = $this->mongo_db->get('country');
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
        $url = base_url('CompanyInformation?start_rows=' . $currentPage);
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
            '#collection' => 'CompanyInformation',
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
        $data['CompanyInformation'] = $this->mongo_db->get('CompanyInformation');
        //$this->mongo_db->explain();
        //  $data['clients']=$this->mongo_db->get('Client');
        $data['footerJs'][0] = base_url('uploads/assets/plugins/parsleyjs/dist/parsley.min.js');
        $data['footerJs'][1] = base_url('uploads/assets/plugins/bootstrap-sweetalert/sweet-alert.min.js');
        $data['footerJs'][2] = base_url('assets/pages/jquery.sweet-alert.init.js');
        $data['footerJs'][3] = base_url('uploads/custom/client/client.js');
        $data['footerJs'][4] = base_url('uploads/assets/plugins/datatables/jquery.dataTables.min.js');
        $data['footerJs'][5] = base_url('uploads/assets/plugins/datatables/dataTables.responsive.min.js');
        $data['footerJs'][6] = base_url('uploads/custom/CompanyInformation/CompanyInformation.js');
        $data['footerJs'][7] = base_url('uploads/assets/plugins/select2/dist/js/select2.min.js');
		
        
        $data['headerCss'][0] = base_url('uploads/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css');
        $data['headerCss'][1] = base_url('uploads/assets/plugins/datatables/jquery.dataTables.min.css');
        $data['headerCss'][2] = "//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css";
		$data['headerCss'][3] = base_url('uploads/assets/plugins/bootstrap-sweetalert/sweet-alert.css');
        $data['headerCss'][4] = base_url('uploads/custom/Developer.css');
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
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $this->form_validation->set_error_delimiters(ERROR_START_DIV_NEW, ERROR_END_DIV);
        /* $this->form_validation->set_rules('email', 'email', 'trim|required|valid_email'); */
        $this->form_validation->set_rules('company_email', 'company_email', 'trim|required|valid_email');
        $this->form_validation->set_rules('company', 'company', 'trim|required');
        $this->form_validation->set_rules('address', 'address', 'trim|required');
        $this->form_validation->set_rules('company_currency', 'company_currency', 'trim|required');
        //$this->form_validation->set_rules('password', 'Password', 'trim|required|callback_check_database');

        if ($this->form_validation->run() == FALSE) {
            $error_msg = validation_errors();
            $this->session->set_flashdata('error', $error_msg);
            redirect(site_url('CompanyInformation'));
            //Field validation failed.  User redirected to login page
        } else {
           //$files = $_FILES;
		   $files = $_FILES;
		   
			$old_data = $this->mongo_db->get('CompanyInformation');
			
			if(!empty($files['company_logo']['name'])){
				$temp = explode(".", $files['company_logo']['name']);
				$tt = str_replace('.', '_', $files['company_logo']['name']) . '.' . end($temp);
			}
			else{
				$tt = '';
			}
			/* if(!empty($old_data[0]['company_logo'])){
				
			} */
			// Company Logo
				$_FILES['company_logo']['name'] = $tt;
				$_FILES['company_logo']['type'] = $files['company_logo']['type'];
				$_FILES['company_logo']['tmp_name'] = $files['company_logo']['tmp_name'];
				$_FILES['company_logo']['error'] = $files['company_logo']['error'];
				$_FILES['company_logo']['size'] = $files['company_logo']['size'];
				$this->upload->initialize($this->set_upload_options1());
				$this->upload->do_upload('company_logo');
				//$company_fileName = $_FILES['company_logo']['name'];
				if($_FILES['company_logo']['name'] == ''){
					//$company_fileName = $tt_old;
					/* $temp_old = explode(".", $old_data[0]['company_logo']);
					$tt_old = str_replace('.', '_', $old_data[0]['company_logo']) . '.' . end($temp_old); */
					$company_fileName = $old_data[0]['company_logo'];
				}
				else{
					$company_fileName = $_FILES['company_logo']['name'];
				}
				
				$company_fileName = str_replace(' ', '_', $company_fileName);
				
            $data = array('user_id' => $this->session->userdata('alice_session')['_id'],
					'company' => $this->input->post('company'),
					'address' => $this->input->post('address'),
					'phone' => $this->input->post('phone'),
					'mobno' => $this->input->post('mobno'),
					'company_email' => $this->input->post('company_email'),
					'company_website' => $this->input->post('company_website'),
					'company_currency' => $this->input->post('company_currency'),
					'company_logo' => $company_fileName,
					'created_at' => date('Y-m-d h:i:s'),
					'created_by' => $this->session->userdata('alice_session')['_id'],
					'compnay_flag' => 1,
            );
			
			//echo $this->session->userdata('alice_session')['_id']. "<br>";
            $CompanyInformation = $this->mongo_db->get_where('CompanyInformation', array('user_id' => new \MongoId($this->session->userdata('alice_session')['_id'])));
			//echo $this->session->userdata['alice_session']['firstname'].' '.$this->session->userdata['alice_session']['lastname'];
			
			//print_r($CompanyInformation[0]['user_id']);
			/* die(); */
			
			if(!empty($CompanyInformation)){
				$this->mongo_db->where('user_id', new MongoId($this->session->userdata('alice_session')['_id']))->set($data)->update('CompanyInformation'); 				
				$saveactivity = $this->save_activity($this->session->userdata('alice_session')['_id'],lang('company_update_msg'),'CompanyInformation');
				$error_msg = SUCCESS_START_DIV_NEW . lang('company_update_msg') . SUCCESS_END_DIV;
			}
			else{
				$this->mongo_db->insert('CompanyInformation', $data);
				$saveactivity = $this->save_activity($this->session->userdata('alice_session')['_id'],lang('company_add_msg'),'CompanyInformation');
				$error_msg = SUCCESS_START_DIV_NEW . lang('company_add_msg') . SUCCESS_END_DIV;
			}
            $this->session->set_flashdata('message', $error_msg);
            redirect(base_url('CompanyInformation'));
        }
//        $cpt = count($_FILES['userfile']['name']);
//        for ($i = 0; $i < $cpt; $i++) {
//            $_FILES['userfile']['name'] = $files['userfile']['name'][$i];
//            $_FILES['userfile']['type'] = $files['userfile']['type'][$i];
//            $_FILES['userfile']['tmp_name'] = $files['userfile']['tmp_name'][$i];
//            $_FILES['userfile']['error'] = $files['userfile']['error'][$i];
//            $_FILES['userfile']['size'] = $files['userfile']['size'][$i];
//            $this->upload->initialize($this->set_upload_options());
//            $this->upload->do_upload();
//            $fileName = $_FILES['userfile']['name'];
//            $images[] = $fileName;
//        }
//        $fileName = implode(',', $images);
    }
	
	public function Insert_statutoryData() {

        $this->load->library('form_validation');
        $tin_number = $this->input->post('tin_number');
        $cst_number = $this->input->post('cst_number');
        $pan_number = $this->input->post('pan_number');
        $tan_number = $this->input->post('tan_number');
        $cin = $this->input->post('cin');
        $servicetax_number = $this->input->post('servicetax_number');
		
        $this->form_validation->set_error_delimiters(ERROR_START_DIV_NEW, ERROR_END_DIV);
        $this->form_validation->set_rules('tin_number', 'tin_number', 'trim');
        $this->form_validation->set_rules('cst_number', 'cst_number', 'trim');
        $this->form_validation->set_rules('pan_number', 'pan_number', 'trim');
        $this->form_validation->set_rules('tan_number', 'tan_number', 'trim');
        $this->form_validation->set_rules('cin', 'cin', 'trim');
        $this->form_validation->set_rules('servicetax_number', 'servicetax_number', 'trim');
       
        if ($this->form_validation->run() == FALSE) {
            $error_msg = validation_errors();
            $this->session->set_flashdata('error', $error_msg);
            redirect(site_url('CompanyInformation'));
            //Field validation failed.  User redirected to login page
        } else {
           //$files = $_FILES;
		   $files = $_FILES;
			$old_data = $this->mongo_db->get('User');
			
            $data = array('user_id' => $this->session->userdata('alice_session')['_id'],
            'tin_number' => $this->input->post('tin_number'),
                'cst_number' => $this->input->post('cst_number'),
                'pan_number' => $this->input->post('pan_number'),
				'tan_number' => $this->input->post('tan_number'),
				'cin' => $this->input->post('cin'),
				'servicetax_number' => $this->input->post('servicetax_number')
            );
			/*  
			print_r($data);
			die();  */
            $CompanyInformation = $this->mongo_db->get_where('CompanyInformation', array('user_id' => new \MongoId($this->session->userdata('alice_session')['_id'])));
			//echo $this->session->userdata['alice_session']['firstname'].' '.$this->session->userdata['alice_session']['lastname'];
			
			if(!empty($CompanyInformation)){
			//die('s');
				$this->mongo_db->where('user_id', new MongoId($this->session->userdata('alice_session')['_id']))->set($data)->update('CompanyInformation'); 				
				$saveactivity = $this->save_activity($this->session->userdata('alice_session')['_id'],lang('company_update_msg'),'CompanyInformation');
				$error_msg = SUCCESS_START_DIV_NEW . lang('company_update_msg') . SUCCESS_END_DIV;
			}
			else{
			//die('f');
				$this->mongo_db->insert('CompanyInformation', $data);
				$saveactivity = $this->save_activity($this->session->userdata('alice_session')['_id'],lang('company_add_msg'),'CompanyInformation');
				$error_msg = SUCCESS_START_DIV_NEW . lang('company_add_msg') . SUCCESS_END_DIV;
			}
		 		
            $this->session->set_flashdata('message', $error_msg);
            redirect(base_url('CompanyInformation'));
        }
//        
    }
	
	
	private function set_upload_options() {
        $config = array();
		
		if (!is_dir('./upload/profile_images/')) {
			@mkdir('./uploads/profile_images/', 0777, TRUE);
		}
        $config['upload_path'] = './uploads/profile_images/'; //give the path to upload the image in folder
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = '0';
        $config['overwrite'] = FALSE;
        return $config;
    }
	private function set_upload_options1() {
        $config = array();
        if (!is_dir('./upload/company_logo/')) {
			@mkdir('./uploads/company_logo/', 0777, TRUE);
		}
		$config['upload_path'] = './uploads/company_logo/'; //give the path to upload the image in folder
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = '0';
        $config['overwrite'] = FALSE;
        return $config;
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
            redirect(site_url('Profile'));
        }
    }
	
	
	public function ChangePassword() {
		$data['main_content'] = '/ChangePassword';
        $data['pageTitle'] = lang('change_password');
        /* $id = $this->input->post('_id');
        $this->load->library('form_validation');
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $this->form_validation->set_error_delimiters(ERROR_START_DIV_NEW, ERROR_END_DIV);
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('firstname', 'firstname', 'trim|required');
        $this->form_validation->set_rules('lastname', 'lastname', 'trim|required');
        $this->form_validation->set_rules('company', 'company', 'trim|required'); */
        //$this->form_validation->set_rules('password', 'Password', 'trim|required|callback_check_database');

		$this->parser->parse('layouts/PageTemplate', $data);

        /* if ($this->form_validation->run() == FALSE) {
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
            redirect(site_url('ChangePassword'));
        } */
    }
	
	
	public function Change() {
		$this->load->library('form_validation');
        $this->form_validation->set_error_delimiters(ERROR_START_DIV_NEW, ERROR_END_DIV);
        $this->form_validation->set_rules('current_password', 'Current Password', 'required');
        $this->form_validation->set_rules('pass1', 'Password', 'required');
        $this->form_validation->set_rules('passWord2', 'Confirm Password', 'required|matches[pass1]');
		
		
        $current_password = $this->input->post('current_password');
        $password = $this->input->post('pass1');
        $passWord2 = $this->input->post('passWord2');

		$old_data = $this->mongo_db->get('User');
		// Current Password
		$old_password = $old_data[0]['password'];
			
        if ($this->form_validation->run() == FALSE) {
            $error_msg = validation_errors();
            $this->session->set_flashdata('error', $error_msg);
            redirect(site_url('Profile/ChangePassword'));
            //Field validation failed.  User redirected to ChangePassword page
        } 
		elseif($old_password != $current_password){
			$error_msg = 'Current Password is not correct';
            $this->session->set_flashdata('error', $error_msg);
            redirect(site_url('Profile/ChangePassword'));
			
		}
		
		else {
			/* $old_data = $this->mongo_db->get('User');
			$old_password = $old_data[0]['password']; */
			
			if($old_password == $current_password)
			{
				$data = array(
					'password' => $password
				);
			}
			
			$this->mongo_db->where('_id', new MongoId($this->session->userdata('alice_session')['_id']))->set($data)->update('User'); 
			
			$saveactivity = $this->save_activity($this->session->userdata('alice_session')['_id'],lang('password_change_msg'),'Profile');
			
            $error_msg = SUCCESS_START_DIV_NEW . lang('password_change_msg') . SUCCESS_END_DIV;
            $this->session->set_flashdata('message', $error_msg);
            redirect(base_url('Profile/ChangePassword'));
        }
	}

}

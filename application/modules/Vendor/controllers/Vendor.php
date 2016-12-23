<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Vendor extends Public_controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('upload');
        $this->load->library('mongo_db', array('activate' => 'default'), 'mongo_db');
        $this->module = $this->router->fetch_class();
        $this->viewname = $this->router->fetch_class();
    }

    public function index($view = 'grid') {
        $data['main_content'] = '/index';
        $data['pageTitle'] = lang('vendor');

        //$parameters['total_rows']=
        //Pagination Sample code

        $parameters = isset($_GET) ? $_GET : array();
        $itemsPerPage = 10000;
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
        $url = base_url('Vendor?start_rows=' . $currentPage);
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
            '#collection' => 'Vendor',
            '#select' => array('_id', 'vendor_name', 'vendor_country', 'vendor_country_name', 'vendor_address1', 'vendor_address2', 'vendor_zipcode', 'vendor_city', 'vendor_state', 'vendor_branch', 'vendor_email', 'vendor_phone', 'created_at'),
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
            $filteredSearch = new MongoRegex($regex);
//            echo $filteredSearch;
//            die;
            $parseParam['#find'] = array('company' => $filteredSearch);
        }
        $pagination->setParameters($parseParam, $currentPage, $itemsPerPage);

        $dataSet = $pagination->Paginate();
        $result = $dataSet['dataset'];
        $data['pagination']['totalPages'] = $dataSet['totalPages'];
        $data['pagination']['totalItems'] = $dataSet['totalItems'];
        $data['pagination']['links'] = $pagination->getPageLinks();
        $data['vendors'] = $result; //$this->mongo_db->get('Client');
        //$this->mongo_db->explain();
        //  $data['products']=$this->mongo_db->get('Client');
        $data['footerJs'][0] = base_url('uploads/assets/plugins/bootstrap-sweetalert/sweet-alert.min.js');
		$data['footerJs'][1] = base_url('uploads/assets/js/filterizr/jquery.filterizr.js');
        $data['footerJs'][2] = base_url('uploads/assets/pages/jquery.sweet-alert.init.js');
        $data['footerJs'][3] = base_url('uploads/assets/plugins/datatables/jquery.dataTables.min.js');
        $data['footerJs'][4] = base_url('uploads/assets/plugins/datatables/dataTables.responsive.min.js');
        $data['footerJs'][5] = base_url('uploads/custom/Vendor/vendor.js');
        $data['headerCss'][0] = base_url('uploads/assets/plugins/bootstrap-sweetalert/sweet-alert.css');
        $data['headerCss'][1] = base_url('uploads/assets/plugins/datatables/jquery.dataTables.min.css');
		$data['headerCss'][2] = base_url('uploads/assets/css/filter.css');
        $data['headerCss'][3] = base_url('uploads/custom/Developer.css');
        $data['url'] = $url;
		$data['view'] = $view;
        /* if ($this->input->is_ajax_request()) {
            if ($this->input->post('view') == 'grid') {
                $this->load->view('GridView', $data);
            } else {
                $this->load->view('ListView', $data);
            }
        } else {
            $this->parser->parse('layouts/PageTemplate', $data);
        } */
		$this->parser->parse('layouts/PageTemplate', $data);
    }

    public function GridView() {
        $data['main_content'] = '/GridView';
        $data['pageTitle'] = lang('vendor');
        $data['vendors'] = $this->mongo_db->get('Vendor');
        $data['footerJs'][0] = base_url('uploads/assets/plugins/bootstrap-sweetalert/sweet-alert.min.js');
        $data['footerJs'][1] = base_url('assets/pages/jquery.sweet-alert.init.js');
        $data['footerJs'][2] = base_url('uploads/custom/client/client.js');
        $data['headerCss'][0] = base_url('uploads/assets/plugins/bootstrap-sweetalert/sweet-alert.css');
        $data['headerCss'][1] = base_url('uploads/custom/Developer.css');
        $this->parser->parse('layouts/PageTemplate', $data);
    }
    public function loadMore() {
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
        $url = base_url('Client/loadMore?start_rows=' . $currentPage);
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
            '#collection' => 'Client',
            '#select' => array('_id', 'firstname', 'lastname', 'email', 'company', 'phone', 'address', 'zipcode', 'city', 'state', 'country', 'created_at'),
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
            $filteredSearch = new MongoRegex($regex);
//            echo $filteredSearch;
//            die;
            $parseParam['#find'] = array('company' => $filteredSearch);
        }
        $pagination->setParameters($parseParam, $currentPage, $itemsPerPage);

        $dataSet = $pagination->Paginate();
        $result = $dataSet['dataset'];
        $data['pagination']['totalPages'] = $dataSet['totalPages'];
        $data['pagination']['totalItems'] = $dataSet['totalItems'];
        $data['pagination']['links'] = $pagination->getPageLinks();
        $data['clients'] = $result; //$this->mongo_db->get('Client');
        //$this->mongo_db->explain();
        //  $data['clients']=$this->mongo_db->get('Client');
        $data['footerJs'][0] = base_url('uploads/assets/plugins/bootstrap-sweetalert/sweet-alert.min.js');
        $data['footerJs'][1] = base_url('assets/pages/jquery.sweet-alert.init.js');
        $data['footerJs'][2] = base_url('uploads/custom/client/client.js');
        $data['headerCss'][0] = base_url('uploads/assets/plugins/bootstrap-sweetalert/sweet-alert.css');
        $data['headerCss'][1] = base_url('uploads/custom/Developer.css');
        $data['url'] = $url;

        if ($this->input->is_ajax_request()) {
          
                $this->load->view('GridView', $data);
          
        }
    }


    public function Add() {

        $data['pageTitle'] = lang('new_vendor');
        $data['main_content'] = '/AddVendor';
        $data['footerJs'][0] = base_url('uploads/assets/plugins/parsleyjs/dist/parsley.min.js');
        $data['footerJs'][1] = base_url('uploads/custom/client/client.js');
		$data['footerJs'][2] = base_url('uploads/assets/plugins/switchery/switchery.min.js');
		$data['footerJs'][9] = base_url('uploads/assets/plugins/timepicker/bootstrap-timepicker.min.js');
        $data['footerJs'][3] = base_url('uploads/assets/plugins/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js');
        $data['footerJs'][4] = base_url('uploads/assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js');
		$data['footerJs'][5] = base_url('uploads/assets/plugins/bootstrap-daterangepicker/daterangepicker.js');
        $data['footerJs'][6] = base_url('uploads/assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js');
        $data['footerJs'][7] = base_url('uploads/assets/plugins/tinymce/tinymce.min.js');
        $data['footerJs'][10] = base_url('uploads/assets/plugins/bootstrap-sweetalert/sweet-alert.min.js');
        $data['footerJs'][11] = base_url('uploads/assets/pages/jquery.sweet-alert.init.js');
		$data['footerJs'][14] = base_url('uploads/assets/js/jquery.core.js');
		$data['footerJs'][15] = base_url('uploads/custom/Vendor/vendor.js');
		
		
		$data['headerCss'][0] = base_url('uploads/assets/plugins/multiselect/css/multi-select.css');
        $data['headerCss'][1] = base_url('uploads/assets/plugins/select2/dist/css/select2.css');
        $data['headerCss'][2] = base_url('uploads/assets/plugins/select2/dist/css/select2-bootstrap.css');
        $data['headerCss'][3] = base_url('uploads/assets/plugins/bootstrap-sweetalert/sweet-alert.css');
        $data['headerCss'][4] = base_url('uploads/custom/Developer.css');
        $data['headerCss'][5] = base_url('uploads/assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css');
        $data['headerCss'][6] = base_url('uploads/assets/plugins/bootstrap-sweetalert/sweet-alert.css');
        $data['headerCss'][7] = base_url('uploads/custom/Developer.css');
        $data['headerCss'][8] = base_url('uploads/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css');
        $data['headerCss'][9] = base_url('uploads/assets/plugins/bootstrap-daterangepicker/daterangepicker.css');
        $data['headerCss'][10] = base_url('uploads/assets/plugins/switchery/switchery.min.css');
        $this->parser->parse('layouts/PageTemplate', $data);
    }

    public function Edit($id) {

        $data['pageTitle'] = lang('edit_vendor');
        if ($id != '') {
        
		$data['vendor_id'] = $id;
		
		$data['vendors'] = $this->mongo_db->get_where('Vendor', array('_id' => new \MongoId($id)));

        $data['main_content'] = '/EditVendor';
        $data['footerJs'][0] = base_url('uploads/assets/plugins/parsleyjs/dist/parsley.min.js');
        $data['footerJs'][1] = base_url('uploads/custom/client/client.js');
		$data['footerJs'][2] = base_url('uploads/assets/plugins/switchery/switchery.min.js');
		$data['footerJs'][9] = base_url('uploads/assets/plugins/timepicker/bootstrap-timepicker.min.js');
        $data['footerJs'][3] = base_url('uploads/assets/plugins/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js');
        $data['footerJs'][4] = base_url('uploads/assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js');
		$data['footerJs'][5] = base_url('uploads/assets/plugins/bootstrap-daterangepicker/daterangepicker.js');
        $data['footerJs'][6] = base_url('uploads/assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js');
        $data['footerJs'][7] = base_url('uploads/assets/plugins/tinymce/tinymce.min.js');
        $data['footerJs'][9] = base_url('uploads/custom/invoice/recurring.js');
        $data['footerJs'][8] = base_url('uploads/custom/invoice/invoice.js');
        $data['footerJs'][10] = base_url('uploads/assets/plugins/bootstrap-sweetalert/sweet-alert.min.js');
        $data['footerJs'][11] = base_url('uploads/assets/pages/jquery.sweet-alert.init.js');
		$data['footerJs'][12] = base_url('uploads/custom/invoice/recurring.js');
		$data['footerJs'][13] = base_url('uploads/custom/Vendor/vendor.js');
		$data['footerJs'][14] = base_url('uploads/assets/js/jquery.core.js');
		$data['footerJs'][15] = base_url('uploads/custom/Product/product.js');
		
		$data['headerCss'][0] = base_url('uploads/assets/plugins/multiselect/css/multi-select.css');
        $data['headerCss'][1] = base_url('uploads/assets/plugins/select2/dist/css/select2.css');
        $data['headerCss'][2] = base_url('uploads/assets/plugins/select2/dist/css/select2-bootstrap.css');
        $data['headerCss'][3] = base_url('uploads/assets/plugins/bootstrap-sweetalert/sweet-alert.css');
        $data['headerCss'][4] = base_url('uploads/custom/Developer.css');
        $data['headerCss'][5] = base_url('uploads/assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css');
        $data['headerCss'][6] = base_url('uploads/assets/plugins/bootstrap-sweetalert/sweet-alert.css');
        $data['headerCss'][7] = base_url('uploads/custom/Developer.css');
        $data['headerCss'][8] = base_url('uploads/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css');
        $data['headerCss'][9] = base_url('uploads/assets/plugins/bootstrap-daterangepicker/daterangepicker.css');
        $data['headerCss'][10] = base_url('uploads/assets/plugins/switchery/switchery.min.css');
		//$data['footerJs'][2] = base_url('uploads/custom/invoice/recurring.js');
		//$data['footerJs'][3] = base_url('uploads/custom/invoice/invoice.js');

            $this->parser->parse('layouts/PageTemplate', $data);
        } else {
            redirect(base_url('Vendor'));
        }
    }
       public function View($id)
     {
		 $data['pageTitle'] = lang('view_vendor');
        if ($id != '') {
        
		$data['vendor_id'] = $id;
		
		$data['vendor'] = $this->mongo_db->get_where('Vendor', array('_id' => new \MongoId($id)));
        $data['main_content'] = '/ViewVendor';
        $data['footerJs'][0] = base_url('uploads/assets/plugins/parsleyjs/dist/parsley.min.js');
        $data['footerJs'][13] = base_url('uploads/custom/client/client.js');
		$data['footerJs'][15] = base_url('uploads/assets/plugins/timepicker/bootstrap-timepicker.min.js');
        $data['footerJs'][2] = base_url('uploads/assets/plugins/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js');
        $data['footerJs'][3] = base_url('uploads/assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js');
		$data['footerJs'][4] = base_url('uploads/assets/plugins/bootstrap-daterangepicker/daterangepicker.js');
        $data['footerJs'][5] = base_url('uploads/assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js');
        $data['footerJs'][6] = base_url('uploads/assets/plugins/tinymce/tinymce.min.js');
        $data['footerJs'][8] = base_url('uploads/custom/invoice/recurring.js');
        $data['footerJs'][7] = base_url('uploads/custom/invoice/invoice.js');
        $data['footerJs'][9] = base_url('uploads/assets/plugins/bootstrap-sweetalert/sweet-alert.min.js');
        $data['footerJs'][10] = base_url('uploads/assets/pages/jquery.sweet-alert.init.js');
		$data['footerJs'][11] = base_url('uploads/custom/invoice/recurring.js');
		$data['footerJs'][12] = base_url('uploads/custom/invoice/invoice.js');
		$data['footerJs'][14] = base_url('uploads/custom/Vendor/vendor.js');
		$data['footerJs'][1] = base_url('uploads/assets/plugins/switchery/switchery.min.js');
		$data['footerJs'][9] = base_url('uploads/assets/js/jquery.core.js');
		$data['footerJs'][16] = base_url('uploads/assets/js/switchable.min.js');
		
		$data['headerCss'][0] = base_url('uploads/assets/plugins/multiselect/css/multi-select.css');
        $data['headerCss'][1] = base_url('uploads/assets/plugins/select2/dist/css/select2.css');
        $data['headerCss'][2] = base_url('uploads/assets/plugins/select2/dist/css/select2-bootstrap.css');
        $data['headerCss'][3] = base_url('uploads/assets/plugins/bootstrap-sweetalert/sweet-alert.css');
        $data['headerCss'][4] = base_url('uploads/custom/Developer.css');
        $data['headerCss'][5] = base_url('uploads/assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css');
        $data['headerCss'][6] = base_url('uploads/assets/plugins/bootstrap-sweetalert/sweet-alert.css');
        $data['headerCss'][7] = base_url('uploads/custom/Developer.css');
        $data['headerCss'][8] = base_url('uploads/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css');
        $data['headerCss'][9] = base_url('uploads/assets/plugins/bootstrap-daterangepicker/daterangepicker.css');
        $data['headerCss'][11] = base_url('uploads/assets/css/switchable.min.css');
        $data['headerCss'][10] = base_url('uploads/assets/plugins/switchery/switchery.min.css');

            $this->parser->parse('layouts/PageTemplate', $data);
        } else {
            redirect(base_url('Vendor'));
        }
    }
    
    

    public function InsertData() {


        $this->load->library('form_validation');
        $vendor_name = $this->input->post('vendor_name');
        $vendor_country = $this->input->post('vendor_country');
        $vendor_company_name = $this->input->post('vendor_company_name');
        $vendor_address1 = $this->input->post('vendor_address1');
        $vendor_address2 = $this->input->post('vendor_address2');
        $vendor_zipcode = $this->input->post('vendor_zipcode');
        $vendor_city = $this->input->post('vendor_city');
        $vendor_state = $this->input->post('vendor_state');
        $vendor_branch = $this->input->post('vendor_branch');
        $vendor_email = $this->input->post('vendor_email');
        $vendor_phone = $this->input->post('vendor_phone');
        $vendor_description = $this->input->post('vendor_description');
		
        $this->form_validation->set_error_delimiters(ERROR_START_DIV_NEW, ERROR_END_DIV);
        $this->form_validation->set_rules('vendor_company_name', 'vendor_company_name', 'required');
        $this->form_validation->set_rules('vendor_name', 'vendor_name', 'required');
        $this->form_validation->set_rules('vendor_email', 'vendor_email', 'trim|required|valid_email');
        $this->form_validation->set_rules('vendor_zipcode', 'vendor_zipcode', 'trim|required');
        $this->form_validation->set_rules('vendor_country', 'vendor_country', 'trim|required');
        //$this->form_validation->set_rules('password', 'Password', 'trim|required|callback_check_database');



        if ($this->form_validation->run() == FALSE) {
            $error_msg = validation_errors();
            $this->session->set_flashdata('error', $error_msg);
            redirect(site_url('Vendor/Add'));
            //Field validation failed.  User redirected to login page
			//die($error_msg);
        } else {
			
           $data = array('vendor_name' => $this->input->post('vendor_name'),
		   'vendor_country' => $this->input->post('vendor_country'),
                'vendor_company_name' => $this->input->post('vendor_company_name'),
                'vendor_address1' => $this->input->post('vendor_address1'),
                'vendor_address2' => $this->input->post('vendor_address2'),
                'vendor_zipcode' => $this->input->post('vendor_zipcode'),
                'vendor_city' => $this->input->post('vendor_city'),
                'vendor_state' => $this->input->post('vendor_state'),
                'vendor_branch' => $this->input->post('vendor_branch'),
                'vendor_email' => $this->input->post('vendor_email'),
                'vendor_phone' => $this->input->post('vendor_phone'),
                'vendor_description' => $this->input->post('vendor_description'),
                'created_at' => date('Y-m-d h:i:s'),
                'created_by' => $this->session->userdata('alice_session')['_id'],
                'is_deleted' => 0
            );
            
				$this->mongo_db->insert('Vendor', $data);
				$saveactivity = $this->save_activity($this->session->userdata('alice_session')['_id'],lang('vendor_add_msg'),'Product');
				$error_msg = SUCCESS_START_DIV_NEW . lang('vendor_add_msg') . SUCCESS_END_DIV;
				$this->session->set_flashdata('message', $error_msg);
				redirect(base_url('Vendor'));
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

    public function Delete($id) {
        $id = new MongoId($id);
        //$this->mongo_db->where(array('_id' => $id))->delete('product');
		$this->mongo_db->where('_id', new MongoId($id))->set(array('is_deleted' => 1))->update('Vendor');
        $error_msg = SUCCESS_START_DIV_NEW . lang('product_del_msg') . SUCCESS_END_DIV;
        $this->session->set_flashdata('message', $error_msg);
        redirect(site_url('Product'));
    }

    public function UpdateData() {
		$vendor_id = $this->input->post('vendor_id');
		
        $this->load->library('form_validation');
        $vendor_name = $this->input->post('vendor_name');
        $vendor_country = $this->input->post('vendor_country');
        $vendor_company_name = $this->input->post('vendor_company_name');
        $vendor_address1 = $this->input->post('vendor_address1');
        $vendor_address2 = $this->input->post('vendor_address2');
        $vendor_zipcode = $this->input->post('vendor_zipcode');
        $vendor_city = $this->input->post('vendor_city');
        $vendor_state = $this->input->post('vendor_state');
        $vendor_branch = $this->input->post('vendor_branch');
        $vendor_email = $this->input->post('vendor_email');
        $vendor_phone = $this->input->post('vendor_phone');
        $vendor_description = $this->input->post('vendor_description');
		
        $this->form_validation->set_error_delimiters(ERROR_START_DIV_NEW, ERROR_END_DIV);
        $this->form_validation->set_rules('vendor_company_name', 'vendor_company_name', 'required');
        $this->form_validation->set_rules('vendor_name', 'vendor_name', 'required');
        $this->form_validation->set_rules('vendor_email', 'vendor_email', 'trim|required|valid_email');
        $this->form_validation->set_rules('vendor_zipcode', 'vendor_zipcode', 'trim|required');
        $this->form_validation->set_rules('vendor_country', 'vendor_country', 'trim|required');
        //$this->form_validation->set_rules('password', 'Password', 'trim|required|callback_check_database');
		
        if ($this->form_validation->run() == FALSE) {
            $error_msg = ERROR_START_DIV_NEW . lang('common_error_form_submit') . ERROR_END_DIV;
            $this->session->set_flashdata('error', $error_msg);
            //Field validation failed.  User redirected to login page
            //$error_array = validation_errors();
            redirect($this->viewname);
        } else {
            // $files = $_FILES;
           $data = array('vendor_name' => $this->input->post('vendor_name'),
		   'vendor_country' => $this->input->post('vendor_country'),
                'vendor_company_name' => $this->input->post('vendor_company_name'),
                'vendor_address1' => $this->input->post('vendor_address1'),
                'vendor_address2' => $this->input->post('vendor_address2'),
                'vendor_zipcode' => $this->input->post('vendor_zipcode'),
                'vendor_city' => $this->input->post('vendor_city'),
                'vendor_state' => $this->input->post('vendor_state'),
                'vendor_branch' => $this->input->post('vendor_branch'),
                'vendor_email' => $this->input->post('vendor_email'),
                'vendor_phone' => $this->input->post('vendor_phone'),
                'vendor_description' => $this->input->post('vendor_description'),
                'updated_at' => date('Y-m-d h:i:s'),
                'updated_by' => $this->session->userdata('alice_session')['_id'],
            );
			
            $this->mongo_db->where('_id', new MongoId($vendor_id))->set($data)->update('Vendor');
			$saveactivity = $this->save_activity($this->session->userdata('alice_session')['_id'],lang('vendor_edit_msg'),'Vendor');
            $error_msg = SUCCESS_START_DIV_NEW . lang('vendor_edit_msg') . SUCCESS_END_DIV;
            $this->session->set_flashdata('message', $error_msg);
            redirect(site_url('Vendor'));
        }
    }
	
	
	
	
	 public function curlanAdd() {
		 
        //$this->load->library('form_validation');
        $invoice_currency = $this->input->post('invoice_currency');
        $invoice_language = $this->input->post('invoice_language');
        $client_idcurlang = $this->input->post('client_idcurlang');
        
        
            $data = array('currency' => $this->input->post('invoice_currency'),
				'language' => $this->input->post('invoice_language')
            );
            //$id=$this->session->userdata('alice_session')['_id'];
            //$data['client'] = $this->mongo_db->get_where('Client', $client_idcurlang);
            $data_client = $this->mongo_db->get_where('Client',array('_id' => new \MongoId($client_idcurlang)));
			
			if(count($data_client)>0){
				$this->mongo_db->where('_id', new MongoId($client_idcurlang))->set($data)->update('Client');
				$saveactivity = $this->save_activity($this->session->userdata('alice_session')['_id'],lang('client_currency_update'),'Client');
				$error_msg = SUCCESS_START_DIV_NEW . lang('ideal_key_message_edit') . SUCCESS_END_DIV;
				$this->session->set_flashdata('message', $error_msg);
				print_r($error_msg);
				die('sd');
			}
            
            //redirect(base_url(''));
			
       // }
    }
	 public function feeoverdueAdd() {
		 
        //$this->load->library('form_validation');
        $overdue_days = $this->input->post('overdue_days');
        $overdue_fees = $this->input->post('overdue_fees');
        $client_idfeeoverdue = $this->input->post('client_idfeeoverdue');
        
        
            $data = array('overdue_fees' => $this->input->post('overdue_fees'),
				'overdue_days' => $this->input->post('overdue_days')
            );
            //$id=$this->session->userdata('alice_session')['_id'];
            //$data['client'] = $this->mongo_db->get_where('Client', $client_idfeeoverdue);
            $data_client = $this->mongo_db->get_where('Client',array('_id' => new \MongoId($client_idfeeoverdue)));
			
			if(count($data_client)>0){
				$this->mongo_db->where('_id', new MongoId($client_idfeeoverdue))->set($data)->update('Client');
				$saveactivity = $this->save_activity($this->session->userdata('alice_session')['_id'],lang('client_currency_update'),'Client');
				$error_msg = SUCCESS_START_DIV_NEW . lang('ideal_key_message_edit') . SUCCESS_END_DIV;
				$this->session->set_flashdata('message', $error_msg);
				print_r($error_msg);
				die('sd');
			}
            
            //redirect(base_url(''));
			
       // }
    }

}

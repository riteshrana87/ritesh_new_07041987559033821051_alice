<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends Public_controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('upload');
        $this->load->library('mongo_db', array('activate' => 'default'), 'mongo_db');
        $this->module = $this->router->fetch_class();
        $this->viewname = $this->router->fetch_class();
    }

    public function index($view = 'grid') {
        $data['main_content'] = '/index';
        $data['pageTitle'] = lang('product');

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
        $url = base_url('Product?start_rows=' . $currentPage);
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
            '#collection' => 'product',
            '#select' => array('_id', 'product_name', 'sku', 'product_description', 'opening_stock', 'purchases', 'sales', 'closing_stock', 'minimum_in_stock', 'perishable', 'useable_days', 'created_at'),
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
        
		
		if($this->input->post('shorting'))
		{
			$quantity_short = $this->input->post('given_year');
			$perisable_short = $this->input->post('perisable_short');
			$status_short = $this->input->post('status_short');
			
			if(!empty($quantity_short) && !empty($perisable_short) && !empty($status_short)){
				//$data['prs'] =$this->mongo_db->get('product');
				if($status_short == 'In Stock'){
					$data['products'] = $this->mongo_db->where(array('perishable' => $perisable_short))->where_ne('is_deleted',1)->where_gt('closing_stock','0')->get('product');
					$rt = array();
						foreach($data['products'] as $alpro)
						{
							if($alpro['closing_stock'] < $quantity_short){
								array_push($rt, $alpro);
							}
						}
						$data['products'] = $rt;
				}
				else if($status_short == 'Out Of Stock'){
					$data['products'] = $this->mongo_db->where(array('perishable' => $perisable_short))->where_ne('is_deleted',1)->where_lte('closing_stock','0')->get('product');
					$rt = array();
						foreach($data['products'] as $alpro)
						{
							if($alpro['closing_stock'] < $quantity_short){
								array_push($rt, $alpro);
							}
						}
						$data['products'] = $rt;
				}
				else{
				}
			}
			
			else if(empty($quantity_short) && empty($perisable_short) && empty($status_short)){
				$data['products'] =$this->mongo_db->where_ne('is_deleted',1)->get('product'); //$result; //$this->mongo_db->get('Client');
			}
			
			else if(!empty($perisable_short)){
				/* check that one of them is empty or not*/
				if(!empty($quantity_short) && !empty($status_short)){
					$data['products'] = $this->mongo_db->where(array('perishable' => $perisable_short))->where_ne('is_deleted',1)->get('product');
					$rt = array();
						foreach($data['products'] as $alpro)
						{
							if($alpro['closing_stock'] < $quantity_short){
								array_push($rt, $alpro);
							}
						}
						$data['products'] = $rt;
				}
				else if(!empty($quantity_short) && empty($status_short)){
					$data['products'] = $this->mongo_db->where(array('perishable' => $perisable_short))->where_ne('is_deleted',1)->get('product');
					$rt = array();
						foreach($data['products'] as $alpro)
						{
							if($alpro['closing_stock'] < $quantity_short){
								array_push($rt, $alpro);
							}
						}
						$data['products'] = $rt;
				}
				else if(empty($quantity_short) && !empty($status_short)){
					if($status_short == 'In Stock'){
						$data['products'] = $this->mongo_db->where(array('perishable' => $perisable_short))->where_ne('is_deleted',1)->where_gt('closing_stock','0')->get('product');
					}
					else if($status_short == 'Out Of Stock'){
						$data['products'] = $this->mongo_db->where(array('perishable' => $perisable_short))->where_ne('is_deleted',1)->where_lte('closing_stock','0')->get('product');
					}
				}
				else if(empty($quantity_short) && empty($status_short)){
					$data['products'] = $this->mongo_db->where(array('perishable' => $perisable_short))->where_ne('is_deleted',1)->get('product');
				}
				
			}
			else{
				/* check that one of them is empty or not*/
				if(!empty($quantity_short) && !empty($status_short)){
					if($status_short == 'In Stock'){
						$data['products'] = $this->mongo_db->where_ne('is_deleted',1)->where_gt('closing_stock','0')->get('product');
						$rt = array();
						foreach($data['products'] as $alpro)
						{
							if($alpro['closing_stock'] < $quantity_short){
								array_push($rt, $alpro);
							}
						}
						$data['products'] = $rt;
					}
					else if($status_short == 'Out Of Stock'){
						$data['products'] = $this->mongo_db->where_ne('is_deleted',1)->where_lte('closing_stock','0')->get('product');
						$rt = array();
						foreach($data['products'] as $alpro)
						{
							if($alpro['closing_stock'] < $quantity_short){
								array_push($rt, $alpro);
							}
						}
						$data['products'] = $rt;
					}
					//$data['products'] = $this->mongo_db->where_lte('closing_stock',$quantity_short)->get('product');
				}
				else if(!empty($quantity_short) && empty($status_short)){
						$data['products'] = $this->mongo_db->where_ne('is_deleted',1)->get('product');
						
						$rt = array();
						foreach($data['products'] as $alpro)
						{
							if($alpro['closing_stock'] < $quantity_short){
								array_push($rt, $alpro);
							}
						}
						$data['products'] = $rt;
						
				}
				else if(empty($quantity_short) && !empty($status_short)){
					if($status_short == 'In Stock'){
						$data['products'] = $this->mongo_db->where_gt('closing_stock','0')->where_ne('is_deleted',1)->get('product');
					}
					else if($status_short == 'Out Of Stock'){
						$data['products'] = $this->mongo_db->where_lte('closing_stock','0')->where_ne('is_deleted',1)->get('product');
					}
				}
			}
		}
		else{
			$data['products'] =$this->mongo_db->where_ne('is_deleted',1)->get('product'); //$result; //$this->mongo_db->get('Client');
		/* 	echo "<pre>";
				print_r($data['products']);
				echo "</pre>"; */
		}
				
				//die();
		
        //$this->mongo_db->explain();
        //  $data['products']=$this->mongo_db->get('Client');
        $data['footerJs'][0] = base_url('uploads/assets/plugins/bootstrap-sweetalert/sweet-alert.min.js');
        $data['footerJs'][1] = base_url('uploads/assets/pages/jquery.sweet-alert.init.js');
        $data['footerJs'][2] = base_url('uploads/assets/plugins/datatables/jquery.dataTables.min.js');
        $data['footerJs'][3] = base_url('uploads/assets/plugins/datatables/dataTables.responsive.min.js');
        $data['footerJs'][4] = base_url('uploads/custom/client/client.js');
        $data['footerJs'][5] = base_url('uploads/assets/js/controls.js');
        $data['footerJs'][6] = base_url('uploads/assets/js/filterizr/jquery.filterizr.js');
		$data['footerJs'][7] = base_url('uploads/custom/Product/product.js');
		
        $data['headerCss'][0] = base_url('uploads/assets/plugins/bootstrap-sweetalert/sweet-alert.css');
        $data['headerCss'][1] = base_url('uploads/assets/plugins/datatables/jquery.dataTables.min.css');
        $data['headerCss'][2] = base_url('uploads/custom/Developer.css');
        $data['headerCss'][3] = base_url('uploads/assets/css/filter.css');
        $data['url'] = $url;
		$data['view'] = $view;
        if ($this->input->is_ajax_request()) {
            if ($this->input->post('view') == 'grid') {
                $this->load->view('GridView', $data);
            } else {
                $this->load->view('ListView', $data);
            }
        } else {
            $this->parser->parse('layouts/PageTemplate', $data);
        } 
		//$this->parser->parse('layouts/PageTemplate', $data);
    }

    public function GridView() {
        $data['main_content'] = '/GridView';
        $data['pageTitle'] = lang('product');
        $data['products'] = $this->mongo_db->get('product');
        $data['footerJs'][0] = base_url('uploads/assets/plugins/bootstrap-sweetalert/sweet-alert.min.js');
        $data['footerJs'][1] = base_url('assets/pages/jquery.sweet-alert.init.js');
        $data['footerJs'][2] = base_url('uploads/custom/client/client.js');
        $data['footerJs'][3] = base_url('uploads/assets/js/controls.js');
        $data['footerJs'][4] = base_url('uploads/assets/js/filterizr/jquery.filterizr.js');
		$data['footerJs'][5] = base_url('uploads/custom/Product/product.js');
		
        $data['headerCss'][0] = base_url('uploads/assets/plugins/bootstrap-sweetalert/sweet-alert.css');
        $data['headerCss'][1] = base_url('uploads/custom/Developer.css');
        $data['headerCss'][2] = base_url('uploads/assets/css/filter.css');
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

        $data['pageTitle'] = lang('create_product');
        $data['main_content'] = '/AddProduct';
        $data['footerJs'][0] = base_url('uploads/assets/plugins/parsleyjs/dist/parsley.min.js');
        $data['footerJs'][1] = base_url('uploads/custom/client/client.js');
		$data['footerJs'][2] = base_url('uploads/assets/plugins/switchery/switchery.min.js');
		$data['footerJs'][9] = base_url('uploads/assets/plugins/timepicker/bootstrap-timepicker.min.js');
        $data['footerJs'][3] = base_url('uploads/assets/plugins/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js');
        $data['footerJs'][4] = base_url('uploads/assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js');
		$data['footerJs'][5] = base_url('uploads/assets/plugins/bootstrap-daterangepicker/daterangepicker.js');
        $data['footerJs'][6] = base_url('uploads/assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js');
        $data['footerJs'][7] = base_url('uploads/assets/plugins/tinymce/tinymce.min.js');
        //$data['footerJs'][9] = base_url('uploads/custom/invoice/recurring.js');
        //$data['footerJs'][8] = base_url('uploads/custom/invoice/invoice.js');
        $data['footerJs'][10] = base_url('uploads/assets/plugins/bootstrap-sweetalert/sweet-alert.min.js');
        $data['footerJs'][11] = base_url('uploads/assets/pages/jquery.sweet-alert.init.js');
		//$data['footerJs'][12] = base_url('uploads/custom/invoice/recurring.js');
		//$data['footerJs'][13] = base_url('uploads/custom/invoice/invoice.js');
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
        $this->parser->parse('layouts/PageTemplate', $data);
    }

    public function Edit($id) {

        $data['pageTitle'] = lang('edit_client');
        if ($id != '') {
        
		$data['product_id'] = $id;
		
		$data['products'] = $this->mongo_db->get_where('product', array('_id' => new \MongoId($id)));

        $data['pageTitle'] = lang('edit_product');
        $data['main_content'] = '/EditProduct';
        $data['footerJs'][0] = base_url('uploads/assets/plugins/parsleyjs/dist/parsley.min.js');
        $data['footerJs'][1] = base_url('uploads/custom/client/client.js');
		$data['footerJs'][2] = base_url('uploads/assets/plugins/switchery/switchery.min.js');
		$data['footerJs'][9] = base_url('uploads/assets/plugins/timepicker/bootstrap-timepicker.min.js');
        $data['footerJs'][3] = base_url('uploads/assets/plugins/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js');
        $data['footerJs'][4] = base_url('uploads/assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js');
		$data['footerJs'][5] = base_url('uploads/assets/plugins/bootstrap-daterangepicker/daterangepicker.js');
        $data['footerJs'][6] = base_url('uploads/assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js');
        $data['footerJs'][7] = base_url('uploads/assets/plugins/tinymce/tinymce.min.js');
       // $data['footerJs'][9] = base_url('uploads/custom/invoice/recurring.js');
       // $data['footerJs'][8] = base_url('uploads/custom/invoice/invoice.js');
        $data['footerJs'][10] = base_url('uploads/assets/plugins/bootstrap-sweetalert/sweet-alert.min.js');
        $data['footerJs'][11] = base_url('uploads/assets/pages/jquery.sweet-alert.init.js');
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
            redirect(base_url('Product'));
        }
    }
       public function View($id)
     {
		 $data['pageTitle'] = lang('view_product');
        if ($id != '') {
        
		$data['product_id'] = $id;
		
		$data['product'] = $this->mongo_db->get_where('product', array('_id' => new \MongoId($id)));
        $data['main_content'] = '/ViewProduct';
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
		$data['footerJs'][14] = base_url('uploads/custom/Product/product.js');
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
            redirect(base_url('Product'));
        }
    }
    
    

    public function InsertData() {
        $this->load->library('form_validation');
        $product_name = $this->input->post('product_name');
        $sku = $this->input->post('sku');
        $product_description = $this->input->post('product_description');
        $opening_stock = $this->input->post('opening_stock');
        $purchases = $this->input->post('purchases');
        $sales = $this->input->post('sales');
        $closing_stock = $this->input->post('closing_stock');
        $minimum_in_stock = $this->input->post('minimum_in_stock');
		if(! $this->input->post('perishable')){
			$perishable = $this->input->post('perishable');
		}
		else{
			$perishable = 'off';
		}
        $useable_days = $this->input->post('useable_days');
		
		$product_id = $this->input->post('product_id');
		
        $this->form_validation->set_error_delimiters(ERROR_START_DIV_NEW, ERROR_END_DIV);
        $this->form_validation->set_rules('product_name', 'product_name', 'required');
        $this->form_validation->set_rules('sku', 'sku', 'trim|required');
        $this->form_validation->set_rules('opening_stock', 'opening_stock', 'trim|required');
        $this->form_validation->set_rules('closing_stock', 'closing_stock', 'trim|required');
        //$this->form_validation->set_rules('password', 'Password', 'trim|required|callback_check_database');

		$check_sku = $this->mongo_db->get_where('product', array('sku' => $sku));
		if(!empty($check_sku)){
			$error_msg = SUCCESS_START_DIV_NEW . lang('sku_unique') . SUCCESS_END_DIV;
            $this->session->set_flashdata('message', $error_msg);
            redirect(site_url('Product/Add'));
		}


        if ($this->form_validation->run() == FALSE) {
            $error_msg = validation_errors();
            $this->session->set_flashdata('error', $error_msg);
            redirect(site_url('Product/Add'));
            //Field validation failed.  User redirected to login page
			//die($error_msg);
        } else {
			
			//die('success');/
           $data = array('product_name' => $this->input->post('product_name'),
                'sku' => $this->input->post('sku'),
                'product_description' => $this->input->post('product_description'),
                'opening_stock' => $this->input->post('opening_stock'),
                'purchases' => $this->input->post('purchases'),
                'sales' => $this->input->post('sales'),
                'closing_stock' => $this->input->post('closing_stock'),
                'minimum_in_stock' => $this->input->post('minimum_in_stock'),
                'perishable' => $perishable,
                'useable_days' => $this->input->post('useable_days'),
                'created_at' => date('Y-m-d h:i:s'),
                'created_by' => $this->session->userdata('alice_session')['_id'],
                'is_deleted' => 0
            );
            
			
				$this->mongo_db->insert('product', $data);
				$saveactivity = $this->save_activity($this->session->userdata('alice_session')['_id'],lang('product_add_msg'),'Product');
				$error_msg = SUCCESS_START_DIV_NEW . lang('product_add_msg') . SUCCESS_END_DIV;
				$this->session->set_flashdata('message', $error_msg);
            redirect(base_url('Product'));
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
		$this->mongo_db->where('_id', new MongoId($id))->set(array('is_deleted' => 1))->update('product');
        $error_msg = SUCCESS_START_DIV_NEW . lang('product_del_msg') . SUCCESS_END_DIV;
        $this->session->set_flashdata('message', $error_msg);
        redirect(site_url('Product'));
    }

    public function UpdateData() {

        $this->load->library('form_validation');
        $product_name = $this->input->post('product_name');
        $sku = $this->input->post('sku');
        $product_description = $this->input->post('product_description');
        $opening_stock = $this->input->post('opening_stock');
		$purchases = $this->input->post('purchases');
        $sales = $this->input->post('sales');
        $closing_stock = $this->input->post('closing_stock');
        $minimum_in_stock = $this->input->post('minimum_in_stock');
		if(!$this->input->post('perishable')){
			$perishable = $this->input->post('perishable');
		}
		else{
			$perishable = 'off';
		}
        $useable_days = $this->input->post('useable_days');
		
		$product_id = $this->input->post('product_id');
		
        $this->form_validation->set_error_delimiters(ERROR_START_DIV_NEW, ERROR_END_DIV);
        $this->form_validation->set_rules('product_name', 'product_name', 'required');
        $this->form_validation->set_rules('sku', 'sku', 'trim|required');
        $this->form_validation->set_rules('opening_stock', 'opening_stock', 'trim|required');
        $this->form_validation->set_rules('closing_stock', 'closing_stock', 'trim|required');
		
		$older = $this->mongo_db->get_where('product', array('_id' => new \MongoId($product_id)));
		
		if($older[0]['sku'] != $sku){
			$check_sku = $this->mongo_db->get_where('product', array('sku' => $sku));
			if(!empty($check_sku)){
				$error_msg = SUCCESS_START_DIV_NEW . lang('sku_unique') . SUCCESS_END_DIV;
				$this->session->set_flashdata('message', $error_msg);
				redirect(site_url('Product/Edit/' . $product_id));
			}
		}
		
        if ($this->form_validation->run() == FALSE) {
            $error_msg = ERROR_START_DIV_NEW . lang('common_error_form_submit') . ERROR_END_DIV;
            $this->session->set_flashdata('error', $error_msg);
            //Field validation failed.  User redirected to login page
            //$error_array = validation_errors();
            redirect($this->viewname);
        } else {
            // $files = $_FILES;
            $data = array('product_name' => $this->input->post('product_name'),
                'sku' => $this->input->post('sku'),
                'product_description' => $this->input->post('product_description'),
                'opening_stock' => $this->input->post('opening_stock'),
                'purchases' => $this->input->post('purchases'),
                'sales' => $this->input->post('sales'),
                'closing_stock' => $this->input->post('closing_stock'),
                'minimum_in_stock' => $this->input->post('minimum_in_stock'),
                'perishable' => $perishable,
                'useable_days' => $this->input->post('useable_days'),
                'updated_at' => date('Y-m-d h:i:s'),
                'updated_by' => $this->session->userdata('alice_session')['_id'],
            );
			
            $this->mongo_db->where('_id', new MongoId($product_id))->set($data)->update('product');
			$saveactivity = $this->save_activity($this->session->userdata('alice_session')['_id'],lang('product_edit_msg'),'Product');
            $error_msg = SUCCESS_START_DIV_NEW . lang('product_edit_msg') . SUCCESS_END_DIV;
            $this->session->set_flashdata('message', $error_msg);
            redirect(site_url('Product'));
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
	 
	 public function Perishable() {
        $perishable_selected = $this->input->post('selectedValue');
		echo $perishable_selected;
		if($perishable_selected == 'Perishable'){
			$data['product_perishable_on'] = $this->mongo_db->get_where('product', array('perishable' => 'on'));
			
		}
		else{
			$data['product_perishable_off'] = $this->mongo_db->get_where('product', array('perishable' => 'off'));
		}
    }
    
     public function Excel_upload()
        {
           $this->load->library('Excel');
             //print_r($_FILES['upload']);
            if(isset($_POST) && !empty($_FILES['upload']['name']))
            {
               
                $namearr = explode(".",$_FILES['upload']['name']);
                if(end($namearr) != 'xls' && end($namearr) != 'xlsx' && end($namearr) != 'csv')
                {
                    echo '<p> Invalid File </p>';
                    $invalid = 1;
                }
                if($invalid != 1)
                    {
                    $target_dir = "uploads/";
                    $target_file = $_FILES["upload"]["tmp_name"];//$target_dir . basename($_FILES["upload"]["name"]);
                   // $response = move_uploaded_file($_FILES['upload']['tmp_name'],$target_file); // Upload the file to the current folder
                      //print_r($target_file);
                            try {
                            $objPHPExcel = PHPExcel_IOFactory::load($target_file);
                            } catch(Exception $e) {
                            die('Error : Unable to load the file : "'.pathinfo($_FILES['upload']['name'],PATHINFO_BASENAME).'": '.$e->getMessage());
                            }
                            $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
                            //print_r($allDataInSheet);
                            $arrayCount = count($allDataInSheet); // Total Number of rows in the uploaded EXCEL file
                            //echo $arrayCount;
                            //print_r($arrayCount);
									$success_counter = 0;
									$fail_counter = 0;
                                    for($i=2;$i<=$arrayCount;$i++){

									if($allDataInSheet[$i]["I"] != ''){
										if($allDataInSheet[$i]["I"] == 1){
											$perishable_status = 'on';
										}
										else{
											$perishable_status = 'off';
										}
									}
									else{
										$perishable_status = 'off';
									}
                                   $data = array('product_name' => (($allDataInSheet[$i]["A"] != '')?$allDataInSheet[$i]["A"]:''),
                                                'sku' => (($allDataInSheet[$i]["B"] != '')?$allDataInSheet[$i]["B"]:''),
                                                'product_description' => (($allDataInSheet[$i]["C"] != '')?$allDataInSheet[$i]["C"]:''),
                                                'opening_stock' => (($allDataInSheet[$i]["D"] != '')?$allDataInSheet[$i]["D"]:''),
                                                'purchases' => (($allDataInSheet[$i]["E"] != '')?$allDataInSheet[$i]["E"]:''),
                                                'sales' => (($allDataInSheet[$i]["F"] != '')?$allDataInSheet[$i]["F"]:''),
                                                'closing_stock' => (($allDataInSheet[$i]["G"] != '')?$allDataInSheet[$i]["G"]:''),
                                                'minimum_in_stock' => (($allDataInSheet[$i]["H"] != '')?$allDataInSheet[$i]["H"]:''),
                                                'perishable' => $perishable_status,
                                                'useable_days' => (($allDataInSheet[$i]["J"] != '')?$allDataInSheet[$i]["J"]:''),
                                                'created_at' => date('Y-m-d h:i:s'),
                                                'created_by' => $this->session->userdata('alice_session')['_id'],
                                                'is_deleted' => 0
                                            );

                                                if($allDataInSheet[$i]["A"] != ''){
                                                    //print_r($allDataInSheet[$i]);
                                                    $inserted = $this->mongo_db->insert('product', $data);
													if($inserted){
														$success_counter = $success_counter + 1;
													}else{
														$fail_counter = $fail_counter + 1;
													}
                                                }
                                    }
											$saveactivity = $this->save_activity($this->session->userdata('alice_session')['_id'],lang('product_add_msg'),'Product');
											$error_msg = SUCCESS_START_DIV_NEW . $success_counter .' Products successfully Imported. '. $fail_counter .' Products failed to import.' . SUCCESS_END_DIV;
											$this->session->set_flashdata('message', $error_msg);
                                   
                                     redirect(base_url('Product'));   
                                }
        }
        }
}

<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Expenses extends Public_controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('upload');
        $this->load->library('mongo_db', array('activate' => 'default'), 'mongo_db');
        $this->module = $this->router->fetch_class();
        $this->viewname = $this->router->fetch_class();
    }

    public function index($view = 'grid') {
		
			
        $data['main_content'] = '/index';
        $data['pageTitle'] = lang('expenses');

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
        $data['expenses'] = $this->mongo_db->get('expense_master'); //$this->mongo_db->get('Client');
		$data['expense_categories'] = $this->mongo_db->get('ExpenseCategory');
        //$this->mongo_db->explain();
        //  $data['clients']=$this->mongo_db->get('Client');
        $data['footerJs'][0] = base_url('uploads/assets/plugins/bootstrap-sweetalert/sweet-alert.min.js');
        $data['footerJs'][1] = base_url('uploads/assets/pages/jquery.sweet-alert.init.js');
        $data['footerJs'][2] = base_url('uploads/assets/plugins/datatables/jquery.dataTables.min.js');
        $data['footerJs'][3] = base_url('uploads/assets/plugins/datatables/dataTables.responsive.min.js');
        $data['footerJs'][4] = base_url('uploads/custom/client/client.js');
        $data['footerJs'][5] = base_url('uploads/assets/js/filterizr/jquery.filterizr.js');
        $data['footerJs'][6] = base_url('uploads/custom/expense/expense.js');
		
        $data['headerCss'][0] = base_url('uploads/assets/plugins/bootstrap-sweetalert/sweet-alert.css');
        $data['headerCss'][1] = base_url('uploads/assets/plugins/datatables/jquery.dataTables.min.css');
        $data['headerCss'][2] = base_url('uploads/custom/Developer.css');
        $data['headerCss'][3] = base_url('uploads/assets/css/filter.css');
        $data['url'] = $url;
		$data['view1'] = $view;
//        if ($this->input->is_ajax_request()) {
//            if ($this->input->post('view') == 'grid') {
//                $this->load->view('GridView', $data);
//            } else {
//                $this->load->view('ListView', $data);
//            }
//        } else {
//            $this->parser->parse('layouts/PageTemplate', $data);
//        }
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
        $data['pageTitle'] = lang('new_expense');
        $data['main_content'] = '/Add';
        $data['categories'] = $this->mongo_db->get_where('category_master', array('is_deleted' => 0));
		$data['expense_categories'] = $this->mongo_db->get('ExpenseCategory');
		
        $data['tax'] = $this->mongo_db->get_where('Tax', array('is_deleted' => 0));
        $data['footerJs'][0] = base_url('uploads/assets/plugins/switchery/switchery.min.js');
        $data['footerJs'][1] = base_url('uploads/assets/plugins/select2/dist/js/select2.min.js');
        $data['footerJs'][2] = base_url('uploads/assets/plugins/tinymce/tinymce.min.js');
        $data['footerJs'][4] = base_url('uploads/custom/expense/expense.js');
        $data['footerJs'][3] = base_url('uploads/assets/plugins/bootstrap-sweetalert/sweet-alert.min.js');
        $data['footerJs'][5] = base_url('uploads/assets/pages/jquery.sweet-alert.init.js');
        $data['footerJs'][6] = base_url('uploads/assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js');
        $data['footerJs'][7] = base_url('uploads/assets/plugins/parsleyjs/dist/parsley.min.js');
        $data['footerJs'][8] = base_url('uploads/assets/js/filterizr/jquery.filterizr.js');
        $data['footerJs'][9] = base_url('uploads/assets/plugins/fileuploads/js/dropify.min.js');
        $data['footerJs'][10] = base_url('uploads/custom/invoice/invoice.js');
        $data['footerJs'][11] = base_url('uploads/custom/Product/product.js');
        $data['i'] = 0;
        $data['tax_inc'] = 0;
        $data['tax'] = $this->mongo_db->get('Tax');

      $data['headerCss'][0] = base_url('uploads/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css');
        $data['headerCss'][1] = base_url('uploads/assets/plugins/select2/dist/css/select2.css');
        $data['headerCss'][2] = base_url('uploads/assets/plugins/select2/dist/css/select2-bootstrap.css');
        $data['headerCss'][3] = base_url('uploads/assets/plugins/bootstrap-sweetalert/sweet-alert.css');
        $data['headerCss'][4] = base_url('uploads/assets/plugins/switchery/switchery.min.css');
        $data['headerCss'][5] = "//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css";
        $data['headerCss'][6] = base_url("uploads/assets/plugins/fileuploads/css/dropify.min.css");


        $this->parser->parse('layouts/PageTemplate', $data);
    }

    public function getProductBox() {
        $data['tax'] = $this->mongo_db->get('Tax');

        $data['categories'] = $this->mongo_db->get_where('category_master', array('is_deleted' => 0));
        $data['i'] = $this->input->post('i');
        $this->load->view('productBox', $data);
    }

    public function getTaxBox() {
        $data['tax'] = $this->mongo_db->get('Tax');
        //$data['categories'] = $this->mongo_db->get_where('category_master', array('is_deleted' => 0));
        $data['tax_inc'] = $this->input->post('i');
        $this->load->view('taxbox', $data);
    }

    public function Edit($id) {

        $data['pageTitle'] = lang('edit_expense');
        if ($id != '') {
            $data['expense'] = $this->mongo_db->get_where('expense_master', array('_id' => new \MongoId($id)));
            $data['product'] = $this->mongo_db->get_where('expense_product', array('expense_id' => new \MongoId($id)));
            $data['data_tax'] = $this->mongo_db->get_where('expense_taxes', array('expense_id' => new \MongoId($id)));
            $data['tax'] = $this->mongo_db->get('Tax');
            $data['categories'] = $this->mongo_db->get_where('category_master', array('is_deleted' => 0));
			$data['expense_categories'] = $this->mongo_db->get('ExpenseCategory');
            $data['expense_id'] = $id;
            $data['ExpensePaid_data'] = $this->mongo_db->get_where('ExpensePaid', array('expense_id' => new \MongoId($id)));   
            $data['payment_mode'] = $this->mongo_db->get('payment_mode');   
            $data['i'] = 0;
            $data['tax_inc'] = 0;
            $data['main_content'] = '/Edit';
            $data['footerJs'][0] = base_url('uploads/assets/plugins/parsleyjs/dist/parsley.min.js');
            $data['footerJs'][1] = base_url('uploads/assets/plugins/select2/dist/js/select2.min.js');
            $data['footerJs'][2] = base_url('uploads/assets/plugins/tinymce/tinymce.min.js');
            $data['footerJs'][4] = base_url('uploads/custom/expense/expense.js');
            $data['footerJs'][3] = base_url('uploads/assets/plugins/bootstrap-sweetalert/sweet-alert.min.js');
            $data['footerJs'][5] = base_url('uploads/assets/pages/jquery.sweet-alert.init.js');
            $data['footerJs'][6] = base_url('uploads/assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js');
			$data['footerJs'][9] = base_url('uploads/assets/plugins/fileuploads/js/dropify.min.js');
            $data['headerCss'][0] = base_url('uploads/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css');
            $data['headerCss'][1] = base_url('uploads/assets/plugins/select2/dist/css/select2.css');
            $data['headerCss'][2] = base_url('uploads/assets/plugins/select2/dist/css/select2-bootstrap.css');
        $data['headerCss'][5] = "//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css";
            $data['headerCss'][3] = base_url('uploads/assets/plugins/bootstrap-sweetalert/sweet-alert.css');

            $this->parser->parse('layouts/PageTemplate', $data);
        } else {
            redirect(base_url('Expense'));
        }
    }

    public function InsertData() {
        $this->load->library('form_validation');
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $this->form_validation->set_error_delimiters(ERROR_START_DIV_NEW, ERROR_END_DIV);
        $this->form_validation->set_rules('category', 'category', 'trim|required');
        $this->form_validation->set_rules('vendorname', 'vendorname', 'trim|required');

        //$this->form_validation->set_rules('password', 'Password', 'trim|required|callback_check_database');

        if ($this->form_validation->run() == FALSE) {
            $error_msg = validation_errors();
            $this->session->set_flashdata('error', $error_msg);
            redirect(site_url('Expenses/Add'));
            //Field validation failed.  User redirected to login page
        } else {
            // $files = $_FILES;
            $data = array('category' => new MongoId($this->input->post('category')),
                'vendorname' => $this->input->post('vendorname'),
                'description' => $this->input->post('description'),
                'excluding_taxx' => $this->input->post('excluding_tax'),
                'total' => $this->input->post('total'),
                'created_at' => $this->input->post('startdate'),
                'created_by' => $this->session->userdata('alice_session')['_id'],
            );
            $expenseid = $this->mongo_db->insert('expense_master', $data);
            $product_name = $this->input->post('product_name');
			
			
            $qty = $this->input->post('qty');
            $category = $this->input->post('product_category');
            $tax = $this->input->post('product_tax');
            $product_tax = $this->input->post('product_tax');
            $product_price = $this->input->post('product_price');
			
            if (count($product_name) > 0) {
                $i = 0;
                foreach ($product_name as $product) {
					
					if(!empty($category[$i])){
						$pci = new MongoId($category[$i]);
					}
					else{
						$pci = '';
					}
					if(!empty($tax[$i])){
						$tci = new MongoId($tax[$i]);
					}
					else{
						$tci = '';
					}
					
                    $productData = array(
                        'expense_id' => $expenseid,
                        'product_name' => $product_name[$i],
                        'qty' => $qty[$i],
                        'category' => $pci,
                        'product_tax' => $tci,
                        'product_price' => $product_price[$i],
                        'created_at' => date('Y-m-d h:i:s'),
                        'created_by' => $this->session->userdata('alice_session')['_id'],
                    );
                    $this->mongo_db->insert('expense_product', $productData);
                    $i++;
                }
            }

            $tax_name = $this->input->post('tax_name');
            $tax_value = $this->input->post('tax_value');
            $taxData = array();
            if (count($tax_name) > 0) {
                $j = 0;
                foreach ($tax_name as $taxdata) {
                    $taxData = array(
                        'expense_id' => $expenseid,
                        'tax_id' => $tax_name[$j],
                        'tax_value' => $tax_value[$j],
                        'created_at' => date('Y-m-d h:i:s'),
                        'created_by' => $this->session->userdata('alice_session')['_id'],
                    );
                    $this->mongo_db->insert('expense_taxes', $taxData);

                    $j++;
                }
            }
            $error_msg = SUCCESS_START_DIV_NEW . lang('account_add_msg') . SUCCESS_END_DIV;
            $this->session->set_flashdata('message', $error_msg);
            redirect(base_url('Expenses'));
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
        $this->mongo_db->where(array('_id' => $id))->delete('expense_master');
        $error_msg = SUCCESS_START_DIV_NEW . lang('expense_del_msg') . SUCCESS_END_DIV;
        $this->session->set_flashdata('message', $error_msg);
        redirect(site_url('Expenses'));
    }

    public function UpdateData() {

        $id = $this->input->post('_id');

        $this->load->library('form_validation');
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $this->form_validation->set_error_delimiters(ERROR_START_DIV_NEW, ERROR_END_DIV);
        $this->form_validation->set_rules('category', 'category', 'trim|required');
        $this->form_validation->set_rules('vendorname', 'vendorname', 'trim|required');

        //$this->form_validation->set_rules('password', 'Password', 'trim|required|callback_check_database');

        if ($this->form_validation->run() == FALSE) {
            $error_msg = validation_errors();
            $this->session->set_flashdata('error', $error_msg);
            redirect(site_url('Expenses/Add'));
            //Field validation failed.  User redirected to login page
        } else {
            // $files = $_FILES;
            $data = array('category' => new MongoId($this->input->post('category')),
                'vendorname' => $this->input->post('vendorname'),
                'description' => $this->input->post('description'),
                'excluding_taxx' => $this->input->post('excluding_tax'),
                'total' => $this->input->post('total'),
                'updated_at' => date('Y-m-d h:i:s'),
                'updated_by' => $this->session->userdata('alice_session')['_id'],
            );
			
            $this->mongo_db->where('_id', new MongoId($id))->set($data)->update('expense_master');
            $product_name = $this->input->post('product_name');
            $qty = $this->input->post('qty');
            $category = $this->input->post('product_category');
            $product_tax = $this->input->post('product_tax');
            $product_price = $this->input->post('product_price');
			
			echo "<br>" . $id . "<br>";
			
			print_r($product_tax);
			//die();
			
			
            if (count($product_name) > 0) {
                $i = 0;
				for($x=0;$x<count($product_name);$x++){
					$this->mongo_db->where(array('expense_id' => new MongoId($id)))->delete('expense_product');
				}
				
				foreach ($product_name as $product) {
					if(!empty($category[$i])){
						$pci = new MongoId($category[$i]);
					}
					else{
						$pci = '';
					}
					if(!empty($product_tax[$i])){
						$tci = new MongoId($product_tax[$i]);
					}
					else{
						$tci = '';
					}
					
                    $productData = array(
                        'expense_id' => new MongoId($id),
                        'product_name' => $product_name[$i],
                        'qty' => $qty[$i],
                        'category' => $pci,
                        'product_tax' => $tci,
                        'product_price' => $product_price[$i],
                        'created_at' => date('Y-m-d h:i:s'),
                        'created_by' => $this->session->userdata('alice_session')['_id'],
                    );
                    $this->mongo_db->insert('expense_product', $productData);
                    $i++;
                }
            }

            $tax_name = $this->input->post('tax_name');
            $tax_value = $this->input->post('tax_value');
            $taxData = array();
            if (count($tax_name) > 0) {
                $j = 0;
                $this->mongo_db->where(array('expense_id' => $id))->delete('expense_taxes');
                foreach ($tax_name as $taxdata) {
                    $taxData = array(
                        'expense_id' => $id,
                        'tax_id' => $tax_name[$j],
                        'tax_value' => $tax_value[$j],
                        'created_at' => date('Y-m-d h:i:s'),
                        'created_by' => $this->session->userdata('alice_session')['_id'],
                    );
                    $this->mongo_db->insert('expense_taxes', $taxData);

                    $j++;
                }
            }
            $error_msg = SUCCESS_START_DIV_NEW . lang('account_add_msg') . SUCCESS_END_DIV;
            $this->session->set_flashdata('message', $error_msg);
            redirect(base_url('Expenses'));
        }
    }

    function addTax() {
        $this->load->view('View_page');
    }
    
       public function expensePayment(){
            $paid_amount = $this->input->post('paid_amount');
            $expense_id = $this->input->post('expense_id');
           // $invoice_number = $this->input->post('invoice_auto_id');
            $internal_note = $this->input->post('internal_note');
            $payment_mode = $this->input->post('payment_mode');
            $paid_date = $this->input->post('paid_date');
            
            $expensepaid = array('expense_id' => new \MongoId($expense_id),
                //'invoice_number' => $invoice_number,
                'paid_amount' => $paid_amount,
                'payment_mode' => '',
                'payment_id' => '',
                'receipt_id' => '',
                'balance_transaction' => '',
                'customer_id' => '',
                'card_id' => '',
                'card_brand' => '',
                'card_type' => '',
                'card_last4' => '',
                'card_exp_month' => '',
                'card_exp_year' => '',
                'payment_date' => $paid_date,
                'payment_with' => $payment_mode,
            );
            //pr($invoicepaid);exit;
            $inserted = $this->mongo_db->insert('ExpensePaid', $expensepaid);
        $error_msg = SUCCESS_START_DIV_NEW . lang('profile_add_msg') . SUCCESS_END_DIV;
	$this->session->set_flashdata('message', $error_msg);
        redirect($this->viewname . '/Edit/' . $expense_id);
        
    }
	
	   function initInvoice() {
        //  pr($_FILES);
        // die;
        $arrayOutput = array();
        $api_key = 'AIzaSyDYZYZjt3dcJnsmzIVjTYwLGM4-vwDmm0s';
        $cvurl = "https://vision.googleapis.com/v1/images:annotate?key=" . $api_key;
        $type = "TEXT_DETECTION";
        //  echo "<pre>";
        if (isset($_FILES['invimg']['name'])) {
            if (!$_FILES['invimg']['error']) {
                $valid_file = true;
                if ($_FILES['invimg']['size'] > (4024000)) {
                    $valid_file = false;
                    die('Your file\'s size is too large.');
                }

                if ($valid_file) {
                    //convert it to base64
                    $fname = $_FILES['invimg']['tmp_name'];
                    $dataz = file_get_contents($fname);

                    $r_json1 = '{
                "requests": [
                    {
                      "image": {
                        "content":"' . base64_encode($dataz) . '"
                      },
                      "features": [
                          {
                            "type": "' . $type . '",
                           
                          }
                      ]
                    }
                ]
            }';


                    $curl = curl_init();
                    curl_setopt($curl, CURLOPT_URL, $cvurl);
                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                        'Content-Type: application/json',
                        'Content-Length: ' . strlen($r_json1))
                    );
// curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
                    curl_setopt($curl, CURLOPT_POST, true);
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $r_json1);
                    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                    $json_response = curl_exec($curl);

                    $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

                    curl_close($curl);
                    //  var_dump($status);
                    if ($status != 200) {
                        die("Error: $cvurl failed status $status");
                    }
                    $jsn = json_decode($json_response);
                    $taxnot1 = $jsn->responses[0]->textAnnotations[0]->description;
                    $expdata = explode("\n", $taxnot1);
                    $itemNameIdentfier = array('Item Name', 'Item', 'Description of Goods', 'Particulars'); //'[Item Name|Item|Description of Goods|Particulars]';
                    $itemRateIdentfier = array('Price', 'Rate'); //'[Price|Rate]';
                    $itemQtyIdentfier = array('Qty', 'Quantity'); //'[Qty|Quantity]';
                    $itemAmtIdentfier = array('Amt.', 'Amount'); //'[Amt.|Amount]';
                    $totalIdentfier = array('Total', 'Sub Total'); //'[\w*Total\w*]';
                    $gtotalIdentfier = array('Grand Total', 'Net Amount', 'Final Total'); //'[Grand Total|Net Amount|Final Total]';
                    $totalAmnt = 0;
                    $companytName = '';
                    $nextOffsetForLineItem = 0;
                    $lastOffsetForLineItem = 0;
                    $itemsArray = array();
                    //pr($expdata);die;
                    if (count($expdata) > 0) {
                        for ($i = 0; $i < count($expdata); $i++) {

                            $companytName = $expdata[0];
                            /* it identifies item name */
                            if (in_array($expdata[$i], $itemNameIdentfier)) {
                                "Name:- " . $expdata[$i] . "</br>";
                                //echo filter_mydate($expdata[$i]);
                            }
                            /* it identifies item name */
                            if (in_array($expdata[$i], $itemRateIdentfier)) {
                                "Price:- " . $expdata[$i] . "</br>";
                                //echo filter_mydate($expdata[$i]);
                            }
                            /* it identifies Qty */
                            if (in_array($expdata[$i], $itemQtyIdentfier))
                                "Qty:- " . $expdata[$i] . "</br>";
                            //echo filter_mydate($expdata[$i]);

                            /* it identifies Amount */
                            if (in_array($expdata[$i], $itemAmtIdentfier)) {
                                "Amount:- " . $expdata[$i] . "</br>";
                                $nextOffsetForLineItem = $i;
                                //echo filter_mydate($expdata[$i]);
                            }
                            if (in_array($expdata[$i], $totalIdentfier)) {
                                // if (in_array($totalIdentfier, str_replace(' ', '', $expdata[$i])) === 1) {
                                //  $itemsArray[]=array('ItemName'=>$expdata[$i])
                                $totalAmnt = $expdata[$i + 1] . "</br>";
                                $lastOffsetForLineItem = $i;
                            }
                        }
                    }



                    $data['company_name'] = $companytName;
                    $arrayOutput['total'] = $totalAmnt;
                    $newarray = array();
                    $newarray2 = array();
                    $itemarr = array();
                    $str = '';
                    /*
                     * identfy no of items   
                     * =24/4
                     */
                    $itemDiff = $lastOffsetForLineItem - $nextOffsetForLineItem;
                    $totalLineItem = $itemDiff / 4;

                    //  print_r($expdata);
                    for ($k = $nextOffsetForLineItem + 1, $x = 1; $k <= $lastOffsetForLineItem - 1; $k++, $x++) {
                        //echo ($k%1==0)?$k:'';
                        /*
                         * for the item name

                          if($x%4==0)
                          {
                          $itemsArray[$x][] =$expdata[$k];
                          }
                         * 
                         */

                        $newarray[$x] = $expdata[$k];

                        // echo $k . "<br/>";
                        // echo $expdata[$k] . "<br/>";
                        // $str=implode('//',$expdata[$k]);
                        if (preg_match('/^[a-zA-Z\s]+$/', $expdata[$k])) {

                            // echo   $itemsArray[] = $expdata[$k]."<br/>";
                        }

                        //  echo   $itemsArray[]= $expdata[$k+1]."<br/>";;
                        //echo "X";
                    }
                    if (count($newarray) < $itemDiff) {
//    print_r($newarray);exit;
                        foreach ($newarray as $newitems) {

                            if (preg_match('/^[a-zA-Z\s]+$/', $newitems)) {

                                $itemarr[$newitems][] = $newitems;
                                $tempname = $newitems;
                            } else {
                                $itemarr[$tempname][] = $newitems;
                            }
                        }

                        $newarray2[] = $itemarr;

                        $new_array = array_values($itemarr);
                        //  $conts = array_count_values($new_array);
                        $counts = array_map('count', $new_array);
                        $key = array_flip($counts)[max($counts)];
                        $largest_arr = $new_array[$key];
                      //  echo $maxcont =$largest_arr;
                        //   print_r($conts);
                        //  echo $maxcont = max($conts);
                        foreach ($new_array as $err) {
                            if (count($err) < $maxcont) {
                                $err[] = 0;
                            }
                        }

                        // exit;
                    } else {
                        $chunckedArry = (array_chunk($newarray, 4));
                    }

                    //$itemView = $this->load->view('productBoxEdit',$data);
                    //   $chunckedArry = (array_chunk($newarray, 4));
                    $data['pageTitle'] = lang('new_expense');
                    $data['main_content'] = '/OCR';
                    $data['categories'] = $this->mongo_db->get_where('category_master', array('is_deleted' => 0));
                    $data['product'] = $new_array;

                    $data['tax'] = $this->mongo_db->get_where('Tax', array('is_deleted' => 0));

                    $data['footerJs'][0] = base_url('uploads/assets/plugins/switchery/switchery.min.js');
                    $data['footerJs'][1] = base_url('uploads/assets/plugins/select2/dist/js/select2.min.js');
                    $data['footerJs'][2] = base_url('uploads/assets/plugins/tinymce/tinymce.min.js');
                    $data['footerJs'][4] = base_url('uploads/custom/expense/expense.js');
                    $data['footerJs'][3] = base_url('uploads/assets/plugins/bootstrap-sweetalert/sweet-alert.min.js');
                    $data['footerJs'][5] = base_url('uploads/assets/pages/jquery.sweet-alert.init.js');
                    $data['footerJs'][6] = base_url('uploads/assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js');
                    $data['footerJs'][7] = base_url('uploads/assets/plugins/parsleyjs/dist/parsley.min.js');
                    $data['footerJs'][8] = base_url('uploads/assets/js/filterizr/jquery.filterizr.js');
                    $data['footerJs'][9] = base_url('uploads/assets/plugins/fileuploads/js/dropify.min.js');
                    $data['footerJs'][10] = base_url('uploads/custom/invoice/invoice.js');
                    $data['footerJs'][11] = base_url('uploads/custom/Product/product.js');
                    $data['i'] = 0;
                    $data['tax_inc'] = 0;

                    $data['headerCss'][0] = base_url('uploads/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css');
                    $data['headerCss'][1] = base_url('uploads/assets/plugins/select2/dist/css/select2.css');
                    $data['headerCss'][2] = base_url('uploads/assets/plugins/select2/dist/css/select2-bootstrap.css');
                    $data['headerCss'][3] = base_url('uploads/assets/plugins/bootstrap-sweetalert/sweet-alert.css');
                    $data['headerCss'][4] = base_url('uploads/assets/plugins/switchery/switchery.min.css');
                    $data['headerCss'][5] = "//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css";
                    $data['headerCss'][6] = base_url("uploads/assets/plugins/fileuploads/css/dropify.min.css");
                    $this->parser->parse('layouts/PageTemplate', $data);
                    // $arrayOutput['items'] = $itemView;
                    // echo json_encode($arrayOutput);
                    //  die;
                }
            } else {
                echo "Error";
                die('Drror:  ' . $_FILES['photo']['error']);
            }
        }
    }

}

<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Journals extends Public_controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('upload');
        $this->load->library('mongo_db', array('activate' => 'default'), 'mongo_db');
        $this->module = $this->router->fetch_class();
        $this->viewname = $this->router->fetch_class();
    }

    public function index($view = 'grid') {

        $data['main_content'] = '/'.$this->viewname;
        $data['footerJs'][0] = base_url('uploads/assets/plugins/parsleyjs/dist/parsley.min.js');
        $data['footerJs'][1] = base_url('uploads/assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js');
        $data['footerJs'][2] = base_url('uploads/assets/plugins/bootstrap-daterangepicker/daterangepicker.js');
        $data['footerJs'][3] = base_url('uploads/assets/plugins/multiselect/js/jquery.multi-select.js');
        $data['footerJs'][4] = base_url('uploads/assets/plugins/jquery-quicksearch/jquery.quicksearch.js');
        $data['footerJs'][5] = base_url('uploads/assets/plugins/select2/dist/js/select2.min.js');
        $data['footerJs'][6] = base_url('uploads/assets/plugins/datatables/jquery.dataTables.min.js');
        $data['footerJs'][7] = base_url('uploads/assets/plugins/datatables/dataTables.responsive.min.js');
        $data['footerJs'][8] = base_url('uploads/assets/js/filterizr/jquery.filterizr.js');
        $data['footerJs'][9] = base_url('uploads/custom/invoice/invoice.js');

        $data['headerCss'][0] = base_url('uploads/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css');
        $data['headerCss'][1] = base_url('uploads/assets/plugins/bootstrap-daterangepicker/daterangepicker.css');
        $data['headerCss'][2] = base_url('uploads/assets/plugins/multiselect/css/multi-select.css');
        $data['headerCss'][3] = base_url('uploads/assets/plugins/select2/dist/css/select2.css');
        $data['headerCss'][4] = base_url('uploads/assets/plugins/select2/dist/css/select2-bootstrap.css');
        $data['headerCss'][5] = base_url('uploads/assets/plugins/datatables/jquery.dataTables.min.css');
        $data['headerCss'][6] = base_url('uploads/assets/css/filter.css');

        $data['main_content'] = '/index';
        $data['pageTitle'] = lang('journals');

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
        $url = base_url('Invoice?start_rows=' . $currentPage);

        $pagination = new MongoPagination($this->mongo_db, $parameters);
        $parseParam = array(
            '#collection' => 'Journals',
            '#select' => array('_id', 'total_debit', 'total_credit', 'journal_code', 'created_date'),
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
//            echo $filteredSearch;
//            die;
            $parseParam['#find'] = array('discount' => $filteredSearch);
        }
        $pagination->setParameters($parseParam, $currentPage, $itemsPerPage);

        $dataSet = $pagination->Paginate();
        $result = $dataSet['dataset'];
        //pr($result);exit;

//        foreach ($result as $results){
//            $data_client = $this->mongo_db->get_where('Client',array('_id' => new \MongoId($results['client_id'])));
//
//
//        }exit;

       $data['invoicepaid']=$this->mongo_db->get('InvoicePaid');
       
        $data['invoice_from'] = 1;
        $data['invoice_to'] = 0;
        $data['pagination']['totalPages'] = $dataSet['totalPages'];
        $data['pagination']['totalItems'] = $dataSet['totalItems'];
        $data['pagination']['links'] = $pagination->getPageLinks();
        $data['journals'] = $result; //$this->mongo_db->get('Client');
        //pr($data['invoices']);exit;
        //$this->mongo_db->explain();
        //  $data['clients']=$this->mongo_db->get('Client');
        $data['footerJs'][0] = base_url('uploads/assets/plugins/bootstrap-sweetalert/sweet-alert.min.js');
        $data['footerJs'][1] = base_url('assets/pages/jquery.sweet-alert.init.js');
        //$data['footerJs'][2] = base_url('uploads/custom/invoice/invoice.js');
        $data['headerCss'][0] = base_url('uploads/assets/plugins/bootstrap-sweetalert/sweet-alert.css');
        $data['headerCss'][1] = base_url('uploads/custom/Developer.css');
        $data['url'] = $url;
        $data['view'] = $view;
//        if ($this->input->is_ajax_request()) {
//            if ($this->input->post('view') == 'grid') {
//                $data['GridView_invoice'] = 'GridView'; 
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
        $data['pageTitle'] = lang('journals');
        $data['journals'] = $this->mongo_db->get('Journals');
		//$data['invoicepaid']=$this->mongo_db->get('InvoicePaid');
        $data['footerJs'][0] = base_url('uploads/assets/plugins/bootstrap-sweetalert/sweet-alert.min.js');
        $data['footerJs'][1] = base_url('assets/pages/jquery.sweet-alert.init.js');
        $data['footerJs'][2] = base_url('uploads/assets/js/filterizr/jquery.filterizr.js');
        $data['footerJs'][3] = base_url('uploads/custom/invoice/invoice.js');
        $data['headerCss'][0] = base_url('uploads/assets/plugins/bootstrap-sweetalert/sweet-alert.css');
        $data['headerCss'][1] = base_url('uploads/custom/Developer.css');
        $data['headerCss'][2] = base_url('uploads/assets/css/filter.css');
        $this->parser->parse('layouts/PageTemplate', $data);
    }
    
    public function recurringadd() {
		
		/*pr($_POST);
		die();*/
        //$insert_data['main_content'] = '/'.$this->viewname;
		$insert_data['next_issue_date'] = $this->input->post('next_issue_date');
		$insert_data['howoften'] = $this->input->post('howoften');
		$insert_data['howmany'] = $this->input->post('howmany');
		$insert_data['delivery'] = $this->input->post('delivery');
		$insert_data['invoice_id'] = $this->input->post('invoice_id');
		$this->mongo_db->insert('invoice_recurring', $insert_data);
		$saveactivity = $this->save_activity($this->session->userdata('alice_session')['_id'],lang('recurring_add_msg'),'Recurring');
		echo json_encode(array('status'=>1,'url'=>base_url('Invoice')));
		die;
    }
    
     public function reminderadd() {
		
		/*pr($_POST);
		die();*/
        //$insert_data['main_content'] = '/'.$this->viewname;
		$insert_data['days'] = $this->input->post('days');
		$insert_data['subject'] = $this->input->post('subject');
		$insert_data['issue_description'] = $this->input->post('issue_description');
		$insert_data['reminder_type'] = $this->input->post('reminder_type');
		$insert_data['invoice_id'] = $this->input->post('invoice_id');
		
		$this->mongo_db->insert('send_reminder', $insert_data);
		$saveactivity = $this->save_activity($this->session->userdata('alice_session')['_id'],lang('reminder_add_msg'),'Reminder');
		$error_msg = SUCCESS_START_DIV_NEW . lang('reminder_add_msg') . SUCCESS_END_DIV;
		echo json_encode(array('status'=>1,'msg'=>$error_msg,'url'=>base_url('Invoice')));
		die;
    }

    function journal_auto_gen_Id() {
        return 'JV' . mt_rand(100000, 999999);
    }
    
    public function Add() {
        
        $data['pageTitle'] = lang('new_journal');
        $data['main_content'] = '/AddJournal';
        $data['categories'] = $this->mongo_db->get_where('category_master', array('is_deleted' => 0));
		
        $data['tax'] = $this->mongo_db->get_where('Tax', array('is_deleted' => 0));
        $data['footerJs'][0] = base_url('uploads/assets/plugins/switchery/switchery.min.js');
        $data['footerJs'][1] = base_url('uploads/assets/plugins/select2/dist/js/select2.min.js');
        $data['footerJs'][2] = base_url('uploads/assets/plugins/tinymce/tinymce.min.js');
        $data['footerJs'][4] = base_url('uploads/custom/journal/journal.js');
        $data['footerJs'][3] = base_url('uploads/assets/plugins/bootstrap-sweetalert/sweet-alert.min.js');
        $data['footerJs'][5] = base_url('uploads/assets/pages/jquery.sweet-alert.init.js');
        $data['footerJs'][6] = base_url('uploads/assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js');
        $data['footerJs'][7] = base_url('uploads/assets/plugins/parsleyjs/dist/parsley.min.js');
        $data['footerJs'][8] = base_url('uploads/assets/js/filterizr/jquery.filterizr.js');
        $data['footerJs'][9] = base_url('uploads/assets/plugins/fileuploads/js/dropify.min.js');
       // $data['footerJs'][10] = base_url('uploads/custom/invoice/invoice.js');
       // $data['footerJs'][11] = base_url('uploads/custom/Product/product.js');
        
        $data['i'] = 0;
        $data['tax_inc'] = 0;
        $data['tax'] = $this->mongo_db->get('Tax');
        $data['clients'] = $this->mongo_db->get('Client');
        $data['$categories'] = $this->mongo_db->get('category_master');
        $data['vendors'] = $this->mongo_db->distinct('expense_master','vendorname');
        $data['payment_with'] = $this->mongo_db->distinct('InvoicePaid','payment_with');
        $data['journal_accounts'] = $this->mongo_db->get('JournalAccount');
        $data['journal_auto_id'] = $this->journal_auto_gen_Id();
      $data['headerCss'][0] = base_url('uploads/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css');
        $data['headerCss'][1] = base_url('uploads/assets/plugins/select2/dist/css/select2.css');
        $data['headerCss'][2] = base_url('uploads/assets/plugins/select2/dist/css/select2-bootstrap.css');
        $data['headerCss'][3] = base_url('uploads/assets/plugins/bootstrap-sweetalert/sweet-alert.css');
        $data['headerCss'][4] = base_url('uploads/assets/plugins/switchery/switchery.min.css');
        $data['headerCss'][5] = "//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css";
        $data['headerCss'][6] = base_url("uploads/assets/plugins/fileuploads/css/dropify.min.css");


        $this->parser->parse('layouts/PageTemplate', $data);
    }

    public function InsertJournal() {
    
        $currency = $this->mongo_db->get('CompanyInformation');
        
        $journal_data['created_date'] = $this->input->post('startdate');
        $journal_data['total_debit'] = $this->input->post('total_debit');
        $journal_data['total_credit'] = $this->input->post('total_credit');
        //$journal_data['currency'] = $currency[0]['company_currency'];//$this->input->post('country_info');
        $journal_data['journal_code'] = $this->input->post('journal_auto_id');
        
         $journal_data1['journal_category'] = $this->input->post('journal_category');
         $journal_data1['category_type'] = $this->input->post('category_type');
         $journal_data1['description'] = $this->input->post('description');
         $journal_data1['debit'] = $this->input->post('debit');
         $journal_data1['credit'] = $this->input->post('credit');
        
          $id = $this->mongo_db->insert('Journals', $journal_data);
          
          $msg = $this->lang->line('journal_add_msg');
       
          $journaitems = array();
          if (count($journal_data1['journal_category']) > 0) {
            for ($i = 0; $i < count($journal_data1['journal_category']); $i++) {
            $journaitems[$i]['journal_id'] = $id;
             if(($journal_data1['category_type'][$i] == 'journal')||($journal_data1['category_type'][$i] == 'client')||($journal_data1['category_type'][$i] == 'category')){
                 $journaitems[$i]['journal_category'] = new MongoId($journal_data1['journal_category'][$i]);
            }else{
                 $journaitems[$i]['journal_category'] = $journal_data1['journal_category'][$i];
            }
            $journaitems[$i]['category_type'] = $journal_data1['category_type'][$i];
            $journaitems[$i]['description'] = $journal_data1['description'][$i];
            $journaitems[$i]['debit'] = $journal_data1['debit'][$i];
            $journaitems[$i]['credit'] = $journal_data1['credit'][$i];
            }
          }
           $this->mongo_db->batch_insert('Journal_items', $journaitems);
           $this->session->set_flashdata('msg', "<div class='alert alert-success text-center'>$msg</div>");
           $saveactivity = $this->save_activity($this->session->userdata('alice_session')['_id'],lang('create_new_journal'),'Journals');
          
            redirect($this->viewname . '/Journals');
        exit;
    }
    
    public function getProductBox() {
        $data['tax'] = $this->mongo_db->get('Tax');
        $data['clients'] = $this->mongo_db->get('Client');
        $data['$categories'] = $this->mongo_db->get('category_master');
         $data['vendors'] = $this->mongo_db->distinct('expense_master','vendorname');
        $data['payment_with'] = $this->mongo_db->distinct('InvoicePaid','payment_with');
         $data['journal_accounts'] = $this->mongo_db->get('JournalAccount');

        $data['categories'] = $this->mongo_db->get_where('category_master', array('is_deleted' => 0));
        $data['i'] = $this->input->post('i');
        $this->load->view('productBox', $data);
    }
    
    public function Edit($id) {

         $data['pageTitle'] = lang('edit_journal');
        if ($id != '') {
            $data['footerJs'][1] = base_url('uploads/assets/plugins/select2/dist/js/select2.min.js');
        $data['footerJs'][2] = base_url('uploads/assets/plugins/tinymce/tinymce.min.js');
        $data['footerJs'][4] = base_url('uploads/custom/journal/journal.js');
        $data['footerJs'][3] = base_url('uploads/assets/plugins/bootstrap-sweetalert/sweet-alert.min.js');
        $data['footerJs'][5] = base_url('uploads/assets/pages/jquery.sweet-alert.init.js');
        $data['footerJs'][6] = base_url('uploads/assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js');
        $data['footerJs'][7] = base_url('uploads/assets/plugins/parsleyjs/dist/parsley.min.js');
        $data['footerJs'][8] = base_url('uploads/assets/js/filterizr/jquery.filterizr.js');
        $data['footerJs'][9] = base_url('uploads/assets/plugins/fileuploads/js/dropify.min.js');
            $data['journal'] = $this->mongo_db->get_where('Journals', array('_id' => new \MongoId($id)));
            $data['items'] = $this->mongo_db->get_where('Journal_items', array('journal_id' => new \MongoId($id)));
            //$data['data_tax'] = $this->mongo_db->get_where('expense_taxes', array('expense_id' => new \MongoId($id)));
           // $data['tax'] = $this->mongo_db->get('Tax');
           // $data['categories'] = $this->mongo_db->get_where('category_master', array('is_deleted' => 0));
            $data['journal_id'] = $id;
           // $data['ExpensePaid_data'] = $this->mongo_db->get_where('ExpensePaid', array('expense_id' => new \MongoId($id)));   
          //  $data['payment_mode'] = $this->mongo_db->get('payment_mode');   
            $data['i'] = 0;
          //  $data['tax_inc'] = 0;
            $data['main_content'] = '/EditJournal';
            $data['tax'] = $this->mongo_db->get('Tax');
            $data['clients'] = $this->mongo_db->get('Client');
            $data['categories'] = $this->mongo_db->get('category_master');
            $data['vendors'] = $this->mongo_db->distinct('expense_master','vendorname');
            $data['payment_with'] = $this->mongo_db->distinct('InvoicePaid','payment_with');
            $data['journal_accounts'] = $this->mongo_db->get('JournalAccount');
            $data['footerJs'][0] = base_url('uploads/assets/plugins/switchery/switchery.min.js');
        
         $data['headerCss'][0] = base_url('uploads/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css');
        $data['headerCss'][1] = base_url('uploads/assets/plugins/select2/dist/css/select2.css');
        $data['headerCss'][2] = base_url('uploads/assets/plugins/select2/dist/css/select2-bootstrap.css');
        $data['headerCss'][3] = base_url('uploads/assets/plugins/bootstrap-sweetalert/sweet-alert.css');
        $data['headerCss'][4] = base_url('uploads/assets/plugins/switchery/switchery.min.css');
        $data['headerCss'][5] = "//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css";
        $data['headerCss'][6] = base_url("uploads/assets/plugins/fileuploads/css/dropify.min.css");

            $this->parser->parse('layouts/PageTemplate', $data);
        } else {
            redirect(base_url('Journals'));
        }
    }
    
    public function Get_products() {
        $term = $this->input->post('term');
        $product_list = $this->mongo_db->like('product_name',$term,'i',true,true)->get('product');
       /*pr($product_list);
        die('here');*/
        foreach($product_list as $prod){
            $product_array['product'][] = $prod['product_name'];
            
            $product_array['product_description'][] = strip_tags($prod['product_description']);
        }
        if(empty($product_array))
        {
            $product_array[] = '';
        }
//        exit;
//        print_r($product_list);exit;
        echo json_encode($product_array);
    }
    
    public function Delete($id) {
        $id = new MongoId($id);
        $this->mongo_db->where(array('_id' => $id))->delete('Journals');
        $this->mongo_db->where(array('journal_id' => $id))->delete('Journal_items');

        $error_msg = SUCCESS_START_DIV_NEW . lang('account_del_msg') . SUCCESS_END_DIV;
        $this->session->set_flashdata('message', $error_msg);
        redirect(site_url('Journals'));
    }

	function GetTax() {
        $tax = $this->input->post('taxs');
        $delval = $this->input->post('delval');
        $deltax = $this->input->post('deltax');
		$subtotal = 0;
		$disctount_type = $this->input->post('disctount_type');
        $discounts = $this->input->post('discounts');
        $taxTot = 0;
        $subtotalCost = 0;
        $taxvalue = 0;

        if (count($tax) > 0) {
            $data = array();

            foreach ($tax as $obj) {
                $taxDataPost = explode('=>', $obj);
                $subtotal += $taxDataPost[1];
            }


            foreach ($tax as $obj) {
                $taxDataPost = explode('=>', $obj);
                $taxid = $taxDataPost[0];

//              $taxvalue = $taxDataPost[1];
				if($taxid != 0){
					//die('llll');
					$taxDbData = $this->mongo_db->get_where('Tax', array('_id' => new \MongoId($taxid)));
					$taxName = $taxDbData[0]['tax_name'];
					$taxPerc = $taxDbData[0]['tax'];
				}
				if($taxid == 0){
					//die('ffffff');
					$taxName = '';
					$taxPerc = 1;
				}
						
                if ($disctount_type == 2) {
                   echo "#" . $taxvalue = ((($taxDataPost[1] - ($discounts / $subtotal) * $taxDataPost[1])) * $taxPerc) / 100;
                   echo "#" . $subtotalCost += (($taxDataPost[1] - ($discounts / $subtotal) * $taxDataPost[1]));
                } else {
                    $taxvalue = ((($taxDataPost[1] - ($discounts * $taxDataPost[1]) / 100)) * $taxPerc) / 100;
                    $subtotalCost += (($taxDataPost[1] - ($discounts * $taxDataPost[1]) / 100));
                }
                //pr($taxvalue);exit;
				if($taxid != 0){
					$taxTot += $taxvalue;
				}
				if($taxid == 0){
					$taxTot += 0;
				}
                if ($delval != $taxvalue && $deltax != $taxid) {
                   $data[$taxid][] = array('name' => $taxName, 'tax' => number_format($taxvalue, 2));
                }
            }
            // echo $subtotalCost;exit;
//            echo $subtotal;exit;
            $subtotalCost += $taxTot;
            $finalarr = array();
            if (count($data) > 0) {
                foreach ($data as $key => $val) {
                    $finalarr[$key] = array_sum(array_column($val, 'tax'));
                }
            }

            echo json_encode(array('status' => 1, 'data' => $finalarr, 'taxTot' => $taxTot, 'total' => $subtotalCost,));
            die;
        }
    }

    function Client_data() {
        $client_id = $this->input->post('client');
        $data['client_data'] = $this->mongo_db->get_where('Client', array('_id' => new \MongoId($client_id)));
        $this->load->view($this->viewname . '/Client_detail', $data);
    }
	
    public function UpdateData() {

        $currency = $this->mongo_db->get('CompanyInformation');
        $id = $this->input->post('_id');
        $journal_data['created_date'] = $this->input->post('startdate');
        $journal_data['total_debit'] = $this->input->post('total_debit');
        $journal_data['total_credit'] = $this->input->post('total_credit');
        //$journal_data['currency'] = $currency[0]['company_currency'];//$this->input->post('country_info');
        $journal_data['journal_code'] = $this->input->post('journal_auto_id');
        
         $journal_data1['journal_category'] = $this->input->post('journal_category');
         $journal_data1['category_type'] = $this->input->post('category_type');
         $journal_data1['description'] = $this->input->post('description');
         $journal_data1['debit'] = $this->input->post('debit');
         $journal_data1['credit'] = $this->input->post('credit');
        
          //$id = $this->mongo_db->insert('Journals', $journal_data);
           $this->mongo_db->where('_id', new MongoId($id))->set($journal_data)->update('Journals');
          $msg = $this->lang->line('journal_edit_msg');
          
           $journal_items = $this->mongo_db->get_where('Journal_items', array('journal_id' => new \MongoId($id)));
          
            if (count($journal_items) > 0) {
               
				for($x=0;$x<count($journal_items);$x++){
					$this->mongo_db->where(array('journal_id' => new MongoId($id)))->delete('Journal_items');
				}
            }
          
          $journaitems = array();
          if (count($journal_data1['journal_category']) > 0) {
            for ($i = 0; $i < count($journal_data1['journal_category']); $i++) {
            $journaitems[$i]['journal_id'] = new MongoId($id);
            if(($journal_data1['category_type'][$i] == 'journal')||($journal_data1['category_type'][$i] == 'client')||($journal_data1['category_type'][$i] == 'category')){
                 $journaitems[$i]['journal_category'] = new MongoId($journal_data1['journal_category'][$i]);
            }else{
                 $journaitems[$i]['journal_category'] = $journal_data1['journal_category'][$i];
            }
            $journaitems[$i]['category_type'] = $journal_data1['category_type'][$i];
            $journaitems[$i]['description'] = $journal_data1['description'][$i];
            $journaitems[$i]['debit'] = $journal_data1['debit'][$i];
            $journaitems[$i]['credit'] = $journal_data1['credit'][$i];
            }
          }
           $this->mongo_db->batch_insert('Journal_items', $journaitems);
           $this->session->set_flashdata('msg', "<div class='alert alert-success text-center'>$msg</div>");
           $saveactivity = $this->save_activity($this->session->userdata('alice_session')['_id'],lang('create_new_journal'),'Journals');
          
            redirect($this->viewname . '/Journals');
        exit;
        
    }
	
	
	
	 public function stripeAdd() {
        $this->load->library('form_validation');
        $email = $this->input->post('sk_key');
        $password = $this->input->post('pk_key');
        $this->form_validation->set_error_delimiters(ERROR_START_DIV_NEW, ERROR_END_DIV);
        $this->form_validation->set_rules('sk_key', 'sk_key', 'trim|required');
        $this->form_validation->set_rules('pk_key', 'pk_key', 'trim|required');
        
        //$this->form_validation->set_rules('password', 'Password', 'trim|required|callback_check_database');



        if ($this->form_validation->run() == FALSE) {
            $error_msg = validation_errors();
            $this->session->set_flashdata('error', $error_msg);
            redirect(site_url('Invoice/Add'));
            //Field validation failed.  User redirected to login page
        } else {
            // $files = $_FILES;
            $data = array('sk_key' => $this->input->post('sk_key'),
                'pk_key' => $this->input->post('pk_key'),
                'client_id' => $this->session->userdata('alice_session')['_id'],                
                'created_at' => date('Y-m-d h:i:s'),
                'created_by' => $this->session->userdata('alice_session')['_id'],
            );
            $id=$this->session->userdata('alice_session')['_id'];
            $data['stripe'] = $this->mongo_db->get_where('stripe_config', array('client_id' => new \MongoId($id)));
            if(count($data['stripe'])>0){
			$this->mongo_db->where('client_id', new MongoId($id))->set($data)->update('stripe_config');
			$saveactivity = $this->save_activity($this->session->userdata('alice_session')['_id'],lang('stripe_key_message_edit'),'Stripe');
			$error_msg = SUCCESS_START_DIV_NEW . lang('stripe_key_message_edit') . SUCCESS_END_DIV;
            $this->session->set_flashdata('message', $error_msg);
				}
            else{
            $this->mongo_db->insert('stripe_config', $data);
			$saveactivity = $this->save_activity($this->session->userdata('alice_session')['_id'],lang('stripe_key_message_add'),'Stripe');
            $error_msg = SUCCESS_START_DIV_NEW . lang('stripe_key_message_add') . SUCCESS_END_DIV;
            $this->session->set_flashdata('message', $error_msg);
				}
            //redirect(base_url('Stripe'));
        }
    }
	
	
	public function paypalAdd() {

        $this->load->library('form_validation');
        echo $email = $this->input->post('paypal_email');
        
        $this->form_validation->set_error_delimiters(ERROR_START_DIV_NEW, ERROR_END_DIV);
        $this->form_validation->set_rules('email', 'email', 'trim|valid_email');	
        //$this->form_validation->set_rules('password', 'Password', 'trim|required|callback_check_database');

        if ($this->form_validation->run() == FALSE) {
			
            $error_msg = validation_errors();
            $this->session->set_flashdata('error', $error_msg);
            redirect(site_url('Invoice/Add'));
            //Field validation failed.  User redirected to login page
        } else {
            // $files = $_FILES;
            $data = array('email' => $this->input->post('paypal_email'),
                'client_id' => $this->session->userdata('alice_session')['_id'],
                'created_at' => date('Y-m-d h:i:s'),
                'created_by' => $this->session->userdata('alice_session')['_id'],
            );
            $id=$this->session->userdata('alice_session')['_id'];
            $data['paypal'] = $this->mongo_db->get_where('paypal_config', array('client_id' => new \MongoId($id)));
            if(count($data['paypal'])>0){
			$this->mongo_db->where('client_id', new MongoId($id))->set($data)->update('paypal_config');
			$saveactivity = $this->save_activity($this->session->userdata('alice_session')['_id'],lang('paypal_key_message_edit'),'Paypal');
			$error_msg = SUCCESS_START_DIV_NEW . lang('paypal_key_message_edit') . SUCCESS_END_DIV;
            $this->session->set_flashdata('message', $error_msg);
				}
            else{
            $this->mongo_db->insert('paypal_config', $data);
			$saveactivity = $this->save_activity($this->session->userdata('alice_session')['_id'],lang('paypal_key_message_add'),'Paypal');
            $error_msg = SUCCESS_START_DIV_NEW . lang('paypal_key_message_add') . SUCCESS_END_DIV;
            $this->session->set_flashdata('message', $error_msg);
				}
            redirect(base_url('Invoice'));
        }
    }
	
	 public function idealAdd() {
		 
        $this->load->library('form_validation');
        $marchangeid = $this->input->post('marchangeid');
        $key = $this->input->post('key');
        $kerversion = $this->input->post('kerversion');
        
        $this->form_validation->set_error_delimiters(ERROR_START_DIV_NEW, ERROR_END_DIV);
        $this->form_validation->set_rules('marchangeid', 'marchangeid', 'trim');	
        $this->form_validation->set_rules('key', 'key', 'trim');	
        $this->form_validation->set_rules('kerversion', 'kerversion', 'trim');	

        //$this->form_validation->set_rules('password', 'Password', 'trim|required|callback_check_database');

        if ($this->form_validation->run() == FALSE) {
            $error_msg = validation_errors();
            $this->session->set_flashdata('error', $error_msg);
            redirect(site_url('Invoice/Add'));
            //Field validation failed.  User redirected to login page
        } else {
            // $files = $_FILES;
            $data = array('marchangeid' => $this->input->post('marchangeid'),
				'key' => $this->input->post('key'),
				'kerversion' => $this->input->post('kerversion'),
                'client_id' => $this->session->userdata('alice_session')['_id'],
                'created_at' => date('Y-m-d h:i:s'),
                'created_by' => $this->session->userdata('alice_session')['_id'],
            );
            $id=$this->session->userdata('alice_session')['_id'];
            $data['ideal'] = $this->mongo_db->get_where('ideal_config', array('client_id' => new \MongoId($id)));
            if(count($data['ideal'])>0){
				$this->mongo_db->where('client_id', new MongoId($id))->set($data)->update('ideal_config');
				$saveactivity = $this->save_activity($this->session->userdata('alice_session')['_id'],lang('ideal_key_message_edit'),'Ideal');
				$error_msg = SUCCESS_START_DIV_NEW . lang('ideal_key_message_edit') . SUCCESS_END_DIV;
				$this->session->set_flashdata('message', $error_msg);
			}
            else{
				$this->mongo_db->insert('ideal_config', $data);
			$saveactivity = $this->save_activity($this->session->userdata('alice_session')['_id'],lang('ideal_key_message_add'),'Ideal');
				$error_msg = SUCCESS_START_DIV_NEW . lang('ideal_key_message_add') . SUCCESS_END_DIV;
				$this->session->set_flashdata('message', $error_msg);
			}
            redirect(base_url('Ideal'));
			
        }
    }
	
	 public function curlanAdd() {
		 
        //$this->load->library('form_validation');
        $invoice_currency = $this->input->post('invoice_currency');
        $invoice_language = $this->input->post('invoice_language');
        $invoice_idcurlang = $this->input->post('invoice_idcurlang');
        $client_idcurlang = $this->input->post('client_idcurlang');
        
        //$this->form_validation->set_error_delimiters(ERROR_START_DIV_NEW, ERROR_END_DIV);
        //$this->form_validation->set_rules('invoice_currency', 'invoice_currency', 'trim');	
        //$this->form_validation->set_rules('invoice_language', 'invoice_language', 'trim');	

        //$this->form_validation->set_rules('password', 'Password', 'trim|required|callback_check_database');

       /*  if ($this->form_validation->run() == FALSE) {
            $error_msg = validation_errors();
            $this->session->set_flashdata('error', $error_msg);
			//redirect(site_url('Invoice/Add'.$error_msg));
            //Field validation failed.  User redirected to login page
        } else { */
			//
            // $files = $_FILES;
            $data = array('currency' => $this->input->post('invoice_currency'),
				'language' => $this->input->post('invoice_language')
            );
            //$id=$this->session->userdata('alice_session')['_id'];
            //$data['client'] = $this->mongo_db->get_where('Client', $client_idcurlang);
            $data_client = $this->mongo_db->get_where('Client',array('_id' => new \MongoId($client_idcurlang)));
			
			if(count($data_client)>0){
				$this->mongo_db->where('_id', new MongoId($client_idcurlang))->set($data)->update('Client');
				$saveactivity = $this->save_activity($this->session->userdata('alice_session')['_id'],lang('client_currency_update'),'Invoice');
				$error_msg = SUCCESS_START_DIV_NEW . lang('ideal_key_message_edit') . SUCCESS_END_DIV;
				$this->session->set_flashdata('message', $error_msg);
				$result = array('status'=>true,'res'=>$error_msg);
                                echo json_encode($result);
			}
            
            //redirect(base_url(''));
			
       // }
    }
	
	
	public function curlanCheck() {
		
			$client_id = $this->input->post('client_id');
        
            $data_client = $this->mongo_db->get_where('Client',array('_id' => new \MongoId($client_id)));
			
			if(count($data_client)>0){
				/* echo "<pre>";
				print_r($data_client);
				echo "</pre><br>"; */
				if(!empty($data_client[0]['currency'])){
					$result['cur'] = $data_client[0]['currency'];
				}
				else{
					$result['cur'] = '';
				}
				if(!empty($data_client[0]['language'])){
					$result['lan'] = $data_client[0]['language'];
				}
				else{
					$result['lan'] = '';
				}
				
				echo json_encode($result);
				
			}
            
    }

    public function invoicePayment(){
            $paid_amount = $this->input->post('paid_amount');
            $invoice_id = $this->input->post('invoice_id');
            $invoice_number = $this->input->post('invoice_auto_id');
            $internal_note = $this->input->post('internal_note');
            $payment_mode = $this->input->post('payment_mode');
            $paid_date = $this->input->post('paid_date');
            
            $invoicepaid = array('invoice_id' => new \MongoId($invoice_id),
                'invoice_number' => $invoice_number,
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
            $inserted = $this->mongo_db->insert('InvoicePaid', $invoicepaid);
        $error_msg = SUCCESS_START_DIV_NEW . lang('profile_add_msg') . SUCCESS_END_DIV;
	$this->session->set_flashdata('message', $error_msg);
        redirect($this->viewname . '/Edit/' . $invoice_id);
        
    }
    
    public function InsertAccount(){
            $account_type = $this->input->post('account_type');
            $account_name = $this->input->post('account_name');
            $account_description = $this->input->post('account_description');
            $type = $this->input->post('type');
            $amount = $this->input->post('amount');
            $startdate = $this->input->post('startdate1');
            
            
            $account = array(
                'account_type' => $account_type,
                'account_name' => $account_name,
                'account_description' => $account_description,
                'type' => $type,
                'amount' => $amount,
                'created_date'=>$startdate,
               
            );
            //pr($invoicepaid);exit;
            $inserted = $this->mongo_db->insert('JournalAccount', $account);
        $error_msg = SUCCESS_START_DIV_NEW . lang('profile_add_msg') . SUCCESS_END_DIV;
	$this->session->set_flashdata('message', $error_msg);
        redirect($this->viewname . '/Journals');
        
    }
}

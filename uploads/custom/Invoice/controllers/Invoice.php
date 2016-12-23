<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Invoice extends Public_controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('upload');
        $this->load->library('mongo_db', array('activate' => 'default'), 'mongo_db');
        $this->module = $this->router->fetch_class();
        $this->viewname = $this->router->fetch_class();
    }

    public function index() {

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
        $data['pageTitle'] = lang('invoices');

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
            '#collection' => 'invoices',
            '#select' => array('_id', 'client_id', 'amount', 'total_payment', 'currency', 'discount', 'total_tax', 'invoice_code', 'created_date','due_date','payment_status','save_type'),
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

        $data['pagination']['totalPages'] = $dataSet['totalPages'];
        $data['pagination']['totalItems'] = $dataSet['totalItems'];
        $data['pagination']['links'] = $pagination->getPageLinks();
        $data['invoices'] = $result; //$this->mongo_db->get('Client');
        //pr($data['invoices']);exit;
        //$this->mongo_db->explain();
        //  $data['clients']=$this->mongo_db->get('Client');
        $data['footerJs'][0] = base_url('uploads/assets/plugins/bootstrap-sweetalert/sweet-alert.min.js');
        $data['footerJs'][1] = base_url('assets/pages/jquery.sweet-alert.init.js');
        //$data['footerJs'][2] = base_url('uploads/custom/invoice/invoice.js');
        $data['headerCss'][0] = base_url('uploads/assets/plugins/bootstrap-sweetalert/sweet-alert.css');
        $data['headerCss'][1] = base_url('uploads/custom/Developer.css');
        $data['url'] = $url;
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
        $data['pageTitle'] = lang('clients');
        $data['clients'] = $this->mongo_db->get('Client');
		$data['invoicepaid']=$this->mongo_db->get('InvoicePaid');
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
		echo json_encode(array('status'=>1,'url'=>base_url('Invoice')));
		die;
    }

    function invoice_auto_gen_Id() {
        return 'INV' . mt_rand(100000, 999999);
    }

    public function Add() {
        $data['main_content'] = '/AddInvoice';

		if(isset($_GET)){
			$data['selected_client'] = $_GET['client'];	
			$data['selected_client_details'] = $this->mongo_db->get_where('Client',array('_id' => new \MongoId($_GET['client'])));
		}
			
        $data['footerJs'][0] = base_url('uploads/assets/plugins/bootstrap-sweetalert/sweet-alert.min.js');
        $data['footerJs'][1] = base_url('uploads/assets/pages/jquery.sweet-alert.init.js');
        $data['footerJs'][2] = base_url('uploads/assets/plugins/parsleyjs/dist/parsley.min.js');
        $data['footerJs'][3] = base_url('uploads/assets/plugins/switchery/switchery.min.js');
        $data['footerJs'][4] = base_url('uploads/assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js');
        $data['footerJs'][5] = base_url('uploads/assets/plugins/multiselect/js/jquery.multi-select.js');
        $data['footerJs'][6] = base_url('uploads/assets/plugins/jquery-quicksearch/jquery.quicksearch.js');
        $data['footerJs'][7] = base_url('uploads/assets/plugins/select2/dist/js/select2.min.js');
        $data['footerJs'][8] = base_url('uploads/assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js');
        $data['footerJs'][9] = base_url('uploads/assets/plugins/bootstrap-inputmask/bootstrap-inputmask.min.js');
        $data['footerJs'][10] = base_url('uploads/assets/plugins/moment/moment.js');
        $data['footerJs'][11] = base_url('uploads/assets/plugins/timepicker/bootstrap-timepicker.min.js');
        $data['footerJs'][12] = base_url('uploads/assets/plugins/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js');
        $data['footerJs'][13] = base_url('uploads/assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js');
		$data['footerJs'][14] = base_url('uploads/assets/plugins/bootstrap-daterangepicker/daterangepicker.js');
        $data['footerJs'][15] = base_url('uploads/assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js');
        $data['footerJs'][16] = base_url('uploads/assets/plugins/tinymce/tinymce.min.js');
        $data['footerJs'][18] = base_url('uploads/custom/invoice/recurring.js');
        $data['footerJs'][17] = base_url('uploads/custom/invoice/invoice.js');
        $data['footerJs'][19] = base_url('uploads/custom/Product/product.js');
        
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
        $data['headerCss'][10] = "//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css";
         $data['headerCss'][11] = base_url('uploads/assets/plugins/switchery/switchery.min.css');
  
        $id = $this->session->userdata['alice_session']['_id'];
        $data['user_details'] = $this->mongo_db->get_where('User',array('_id' => new \MongoId($id)));
        $data['CompanyInformation'] = $this->mongo_db->get_where('CompanyInformation',array('user_id' => new \MongoId($id)));
        $data['clients']=$this->mongo_db->get('Client');
        $data['taxes']=$this->mongo_db->get('Tax');
        $data['country_info']=$this->mongo_db->get('country');
        $data['send_reminder']=$this->mongo_db->get('send_reminder');
        $data['product_list'] = $this->mongo_db->get('product');    
        //pr($data['product_list']);exit;
        //pr($data['country_info']);exit;

	//$id=$this->session->userdata('alice_session')['_id'];
        $data['stripe_data'] = $this->mongo_db->get_where('stripe_config', array('client_id' => new \MongoId($id)));
        $data['paypal_data'] = $this->mongo_db->get_where('paypal_config', array('client_id' => new \MongoId($id)));
        $data['ideal_data'] = $this->mongo_db->get_where('ideal_config', array('client_id' => new \MongoId($id)));
		
		/* print_r($id);
		die(); */
		
        //pr($data['taxes']);exit;

        $data['invoice_auto_id'] = $this->invoice_auto_gen_Id();

        $this->parser->parse('layouts/PageTemplate', $data);
    }


    public function Edit($invoice_id) {

        $data['pageTitle'] = lang('edit_client');

        if ($invoice_id != '') {
            //$data['main_content'] = '/EditInvoice';
            $data['main_content'] = '/EditInvoice';

            $data['footerJs'][0] = base_url('uploads/assets/plugins/bootstrap-sweetalert/sweet-alert.min.js');
            $data['footerJs'][1] = base_url('uploads/assets/pages/jquery.sweet-alert.init.js');
            $data['footerJs'][2] = base_url('uploads/assets/plugins/parsleyjs/dist/parsley.min.js');
            //$data['footerJs'][3] = base_url('uploads/assets/plugins/switchery/switchery.min.js');
            $data['footerJs'][3] = base_url('uploads/assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js');
            $data['footerJs'][4] = base_url('uploads/assets/plugins/multiselect/js/jquery.multi-select.js');
            
            $data['footerJs'][5] = base_url('uploads/assets/plugins/jquery-quicksearch/jquery.quicksearch.js');
            $data['footerJs'][6] = base_url('uploads/assets/plugins/select2/dist/js/select2.min.js');
            $data['footerJs'][7] = base_url('uploads/assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js');
            $data['footerJs'][8] = base_url('uploads/assets/plugins/bootstrap-inputmask/bootstrap-inputmask.min.js');
            $data['footerJs'][9] = base_url('uploads/assets/plugins/moment/moment.js');
            $data['footerJs'][10] = base_url('uploads/assets/plugins/timepicker/bootstrap-timepicker.min.js');
             $data['footerJs'][11] = base_url('uploads/assets/plugins/switchery/switchery.min.js');
            $data['footerJs'][12] = base_url('uploads/assets/plugins/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js');
            $data['footerJs'][13] = base_url('uploads/assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js');
            $data['footerJs'][14] = base_url('uploads/assets/plugins/bootstrap-daterangepicker/daterangepicker.js');
            $data['footerJs'][15] = base_url('uploads/assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js');
			$data['footerJs'][16] = base_url('uploads/assets/plugins/tinymce/tinymce.min.js');
			$data['footerJs'][18] = base_url('uploads/custom/invoice/recurring.js');
			$data['footerJs'][17] = base_url('uploads/custom/invoice/invoice.js');
                        $data['footerJs'][19] = base_url('uploads/custom/Product/product.js');
                       
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
            $data['headerCss'][10] = "//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css";
             $data['headerCss'][11] = base_url('uploads/assets/plugins/switchery/switchery.min.css');
			$id = $this->session->userdata['alice_session']['_id'];
			$data['send_reminder']=$this->mongo_db->get('send_reminder');
			$data['stripe_data'] = $this->mongo_db->get_where('stripe_config', array('client_id' => new \MongoId($id)));
			$data['paypal_data'] = $this->mongo_db->get_where('paypal_config', array('client_id' => new \MongoId($id)));
			$data['ideal_data'] = $this->mongo_db->get_where('ideal_config', array('client_id' => new \MongoId($id)));
            $data['invoice_auto_id'] = $this->invoice_auto_gen_Id();
            
            $data['activities_data'] = $this->mongo_db->where(array('user_id' => new \MongoId($this->session->userdata('alice_session')['_id'])))->limit(5)->get('Activities');
            //pr($data['activities_data']);exit;
            $data['editrecord'] = $this->mongo_db->get_where('invoices', array('_id' => new \MongoId($invoice_id)));
            $data['invoice_client_data'] = $this->mongo_db->get_where('Client', array('_id' => new \MongoId($data['editrecord'][0]['client_id'])));
            if (empty($data['editrecord']) && count($data['editrecord']) == 0) {
                $this->session->set_flashdata('msg', ERROR_DANGER_DIV . lang('error') . ERROR_END_DIV);
                redirect($this->viewname); //Redirect On Listing page   
                exit;
            }
            $ESTActionInfo = $this->session->userdata('ESTAction');
            $ESTChangeEmailTMP = $this->session->userdata('ESTChangeEmailTMP');
            //Get Prospect Owner 
            if(isset($ESTChangeEmailTMP) && !empty($ESTChangeEmailTMP) && count($ESTChangeEmailTMP) != 0)
			{
                                $templates_id = '58315e33b1599814fc693ee0';
				$data['EmailTMPInfo']	= $this->mongo_db->get_where('email_templates', array('_id' => new \MongoId($templates_id)));
                                $ESTChngEmiTMP = $ESTChangeEmailTMP;
                                
				$this->session->unset_userdata('ESTChangeEmailTMP');
			} else {
				$ESTChngEmiTMP = "";
			}
            // echo $ESTChngEmiTMP;exit;
            //echo $ESTChangeEmailTMP;exit;
            if (isset($ESTActionInfo) && !empty($ESTActionInfo) && count($ESTActionInfo) != 0) {
                $estAction = $ESTActionInfo['EstAction'];
                $this->session->unset_userdata('ESTAction');
            } else {
                $estAction = "";
            }
            $data['estAction'] = $estAction;
            $data['ESTChngEmiTMP'] = $ESTChngEmiTMP;
            //echo $data['ESTChngEmiTMP'];exit;
            //pr($data['editrecord']);exit;
            $data['invoice_items'] = $this->mongo_db->get('invoice_items');
            $data['item_details'] = $this->mongo_db->get_where('invoice_items', array('invoice_id' => new \MongoId($invoice_id)));
            //  pr($data['item_details']);exit;
            $user_id = $data['editrecord'][0]['created_by'];
            $data['user_details'] = $this->mongo_db->get_where('User', array('_id' => new \MongoId($user_id)));
			$data['CompanyInformation'] = $this->mongo_db->get_where('CompanyInformation',array('user_id' => new \MongoId($id)));
            $data['InvoicePaid_data'] = $this->mongo_db->get_where('InvoicePaid', array('invoice_id' => new \MongoId($invoice_id)));    
            //pr($data['InvoicePaid_data']);exit;    
            $data['clients'] = $this->mongo_db->get('Client');
            $data['taxes'] = $this->mongo_db->get('Tax');
            $data['country_info'] = $this->mongo_db->get('country');
            $data['product_list'] = $this->mongo_db->get('product');   

             $data['invoice_id']= $invoice_id;   
             //pr($data['invoice_id']);exit;
             $pdfFileName = "Invoice" . $data['editrecord'][0]['invoice_code'] . ".pdf";
             $data['pdf_report_link'] = FCPATH . "uploads/invoice/" . $pdfFileName;
                
            $this->parser->parse('layouts/PageTemplate', $data);
        } else {
            redirect(base_url('Invoice'));
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
    
       public function Insert_product() {
        $this->load->library('form_validation');
        $product_name = $this->input->post('product_name');
        $sku = $this->input->post('sku');
        $product_description = $this->input->post('product_description');
        $opening_stock = $this->input->post('opening_stock');
        $purchases = $this->input->post('purchases');
        $sales = $this->input->post('sales');
        $closing_stock = $this->input->post('closing_stock');
        $minimum_in_stock = $this->input->post('minimum_in_stock');
        $perishable = $this->input->post('perishable');
        $useable_days = $this->input->post('useable_days');
		
		$product_id = $this->input->post('product_id');
		
        $this->form_validation->set_error_delimiters(ERROR_START_DIV_NEW, ERROR_END_DIV);
        $this->form_validation->set_rules('product_name', 'product_name', 'required');
        $this->form_validation->set_rules('sku', 'sku', 'trim|required');
        $this->form_validation->set_rules('opening_stock', 'opening_stock', 'trim|required');
        $this->form_validation->set_rules('closing_stock', 'closing_stock', 'trim|required');
        //$this->form_validation->set_rules('password', 'Password', 'trim|required|callback_check_database');



        if ($this->form_validation->run() == FALSE) {
            echo validation_errors();
            //$this->session->set_flashdata('error', $error_msg);
            //redirect(site_url('Product/Add'));
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
                'perishable' => $this->input->post('perishable'),
                'useable_days' => $this->input->post('useable_days'),
                'created_at' => date('Y-m-d h:i:s'),
                'created_by' => $this->session->userdata('alice_session')['_id'],
                'is_deleted' => 0
            );
            
			
				$this->mongo_db->insert('product', $data);
				$saveactivity = $this->save_activity($this->session->userdata('alice_session')['_id'],lang('product_add_msg'),'Product');
				//$error_msg = SUCCESS_START_DIV_NEW . lang('product_add_msg') . SUCCESS_END_DIV;
				//$this->session->set_flashdata('message', $error_msg);
            //redirect(base_url('Product'));
                                echo lang('product_add_msg');
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
    public function View($invoice_id) {

        $data['pageTitle'] = lang('edit_client');
	
        if ($invoice_id != '') {
            //$data['main_content'] = '/EditInvoice';
            $data['main_content'] = '/ViewInvoice';

            $data['footerJs'][0] = base_url('uploads/assets/plugins/bootstrap-sweetalert/sweet-alert.min.js');
            $data['footerJs'][1] = base_url('uploads/assets/pages/jquery.sweet-alert.init.js');
            $data['footerJs'][2] = base_url('uploads/assets/plugins/parsleyjs/dist/parsley.min.js');
            $data['footerJs'][3] = base_url('uploads/assets/plugins/switchery/switchery.min.js');
            $data['footerJs'][4] = base_url('uploads/assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js');
            $data['footerJs'][5] = base_url('uploads/assets/plugins/multiselect/js/jquery.multi-select.js');
            $data['footerJs'][6] = base_url('uploads/assets/plugins/jquery-quicksearch/jquery.quicksearch.js');
            $data['footerJs'][7] = base_url('uploads/assets/plugins/select2/dist/js/select2.min.js');
            $data['footerJs'][8] = base_url('uploads/assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js');
            $data['footerJs'][9] = base_url('uploads/assets/plugins/bootstrap-inputmask/bootstrap-inputmask.min.js');
            $data['footerJs'][10] = base_url('uploads/assets/plugins/moment/moment.js');
            $data['footerJs'][11] = base_url('uploads/assets/plugins/timepicker/bootstrap-timepicker.min.js');
            $data['footerJs'][12] = base_url('uploads/assets/plugins/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js');
            $data['footerJs'][13] = base_url('uploads/assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js');
            $data['footerJs'][14] = base_url('uploads/assets/plugins/bootstrap-daterangepicker/daterangepicker.js');
            $data['footerJs'][15] = base_url('uploads/assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js');
			$data['footerJs'][16] = 'https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.debug.js';
			$data['footerJs'][17] = base_url('uploads/assets/plugins/tinymce/tinymce.min.js');
			$data['footerJs'][19] = base_url('uploads/custom/invoice/recurring.js');
			$data['footerJs'][18] = base_url('uploads/custom/invoice/invoice.js');

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


			$data['send_reminder']=$this->mongo_db->get('send_reminder');
			
            $data['invoice_auto_id'] = $this->invoice_auto_gen_Id();
            //pr($data['activities_data']);exit;
            $data['editrecord'] = $this->mongo_db->get_where('invoices', array('_id' => new \MongoId($invoice_id)));
            //pr($data['editrecord']);exit;
            $data['client_data'] = $this->mongo_db->get_where('Client', array('_id' => new \MongoId($data['editrecord'][0]['client_id'])));
            
            if (empty($data['editrecord']) && count($data['editrecord']) == 0) {
                $this->session->set_flashdata('msg', ERROR_DANGER_DIV . lang('error') . ERROR_END_DIV);
                redirect($this->viewname); //Redirect On Listing page   
                exit;
            }
            $ESTActionInfo = $this->session->userdata('ESTAction');
            $ESTChangeEmailTMP = $this->session->userdata('ESTChangeEmailTMP');
            //Get Prospect Owner 
            if(isset($ESTChangeEmailTMP) && !empty($ESTChangeEmailTMP) && count($ESTChangeEmailTMP) != 0)
			{
                                $templates_id = '58315e33b1599814fc693ee0';
				$data['EmailTMPInfo']	= $this->mongo_db->get_where('email_templates', array('_id' => new \MongoId($templates_id)));
                                $ESTChngEmiTMP = $ESTChangeEmailTMP;
                                
				$this->session->unset_userdata('ESTChangeEmailTMP');
			} else {
				$ESTChngEmiTMP = "";
			}
            // echo $ESTChngEmiTMP;exit;
            //echo $ESTChangeEmailTMP;exit;
            if (isset($ESTActionInfo) && !empty($ESTActionInfo) && count($ESTActionInfo) != 0) {
                $estAction = $ESTActionInfo['EstAction'];
                $this->session->unset_userdata('ESTAction');
            } else {
                $estAction = "";
            }
            $data['estAction'] = $estAction;
            $data['ESTChngEmiTMP'] = $ESTChngEmiTMP;
            $data['item_details'] = $this->mongo_db->get_where('invoice_items', array('invoice_id' => new \MongoId($invoice_id)));
            //pr($data['item_details']);exit;
            $user_id = $data['editrecord'][0]['created_by'];
            $data['user_details'] = $this->mongo_db->get_where('User', array('_id' => new \MongoId($user_id)));
			$data['CompanyInformation'] = $this->mongo_db->get_where('CompanyInformation',array('user_id' => new \MongoId($user_id)));
            //pr($data['InvoicePaid_data']);exit;    
            $data['taxes'] = $this->mongo_db->get('Tax');
            
            $data['invoice_id']= $invoice_id;   
            
			$data['InvoicePaid'] = $this->mongo_db->get_where('InvoicePaid',array('invoice_id' => new \MongoId($invoice_id)));
			
			
            $delval = '';
        $deltax = '';
        $subtotal = 0;
        $disctount_type = $data['editrecord'][0]['discount_type'];
        $discounts = $data['editrecord'][0]['discount'];
        $taxTot = 0;
        $subtotalCost = 0;
        $taxvalue = 0;
        $tax = array();
        //pr($subtotal);exit
        if (count($data['item_details']) > 0) {
            foreach ($data['item_details'] as $item_details) {
                $subtotal += $item_details['cost_rate'];
            }
            foreach ($data['item_details'] as $text_rate) {
                $taxid = $text_rate['tax_rate'];
                $taxDataPost = $text_rate['cost_rate'];

                $taxDbData = $this->mongo_db->get_where('Tax', array('_id' => new \MongoId($taxid)));
                $taxName = $taxDbData[0]['tax_name'];
                $taxPerc = $taxDbData[0]['tax'];

                if ($disctount_type == 2) {
                    $taxvalue = ((($taxDataPost - ($discounts / $subtotal) * $taxDataPost)) * $taxPerc) / 100;
                    $subtotalCost += (($taxDataPost - ($discounts / $subtotal) * $taxDataPost));
                } else {
                    $taxvalue = ((($taxDataPost - ($discounts * $taxDataPost) / 100)) * $taxPerc) / 100;
                    $subtotalCost += (($taxDataPost - ($discounts * $taxDataPost) / 100));
                }

                $taxTot += $taxvalue;
                if ($delval != $taxvalue && $deltax != $taxid) {
                    $taxdata[$taxid][] = array('name' => $taxName, 'tax' => number_format($taxvalue, 2));
                }
            }
            $subtotalCost += $taxTot;
            $finalarr = array();
            if (count($taxdata) > 0) {
                foreach ($taxdata as $key => $val) {
                    $finalarr[$key] = array_sum(array_column($val, 'tax'));
                }
            }
            $data['finalarr'] = $finalarr;
            $data['taxTot'] = $taxTot;
            $data['total'] = $subtotalCost;
        }
             //pr($data);exit;
             
            $this->parser->parse('layouts/PageTemplate', $data);
        } else {
            redirect(base_url('Invoice'));
        }
    }

     /*
      @Author : Ritesh Rana
      @Desc   : Insert/update data
      @Input  : Post data/Update id
      @Output : Insert/update data
      @Date   : 05/11/2016
     */

    public function insertdata() {
        $id = '';
        if ($this->input->post('invoice_id')) {
            $id = $this->input->post('invoice_id');
        }

        $invoice_data['client_id'] = $this->input->post('client_id');
        $invoice_data['amount'] = $this->input->post('amount_total');
        $invoice_data['total_payment'] = $this->input->post('add_dis_amount_total');
        $invoice_data['currency'] = $this->input->post('country_info');
        $invoice_data['discount'] = $this->input->post('discount');
        $invoice_data['total_tax'] = $this->input->post('total_tax_payment');
        $invoice_data['tax_amunt'] = $this->input->post('tax_amunt');
        $invoice_data['terms_and_conditions'] = $this->input->post('terms_and_conditions');
        $invoice_data['summary'] = $this->input->post('summary');
        $invoice_data['sub_price'] = $this->input->post('sub_price');
        $invoice_data['discount_type'] = $this->input->post('discount_type');
        $invoice_data['save_type'] = $this->input->post('HdnSubmitBtnVlaue');

        $invoice_data['status'] = 1;
        //Insert Record in Database

        if (!empty($id)) { //update
            $invoice_data['invoice_code'] = $this->input->post('invoice_auto_id');
            $invoice_data['created_by'] = $this->input->post('user_id');
            $invoice_data['created_date'] = $this->input->post('created_date');
            $invoice_data['due_date'] = $this->input->post('due_date');
            $success_update = $this->mongo_db->where('_id', new MongoId($id))->set($invoice_data)->update('invoices');
            $saveactivity = $this->save_activity($this->session->userdata('alice_session')['_id'],lang('update_new_invoice'),'Invoice');
            
            //Delete invoie item
            $delete_item_id = $this->input->post('delete_item_id');
            //pr($delete_item_id);exit;
            if (!empty($delete_item_id)) {
                $delete_item = substr($delete_item_id, 0, -1);
                $delete_item_id = explode(',', $delete_item);
                foreach ($delete_item_id as $delete_item) {
                    $success_update = $this->mongo_db->where('_id', new MongoId($delete_item))->where('invoice_id', new MongoId($id))->delete('invoice_items');
                }
            }
            //update invoice item
            $invoice_item = $this->mongo_db->get_where('invoice_items', array('invoice_id' => new \MongoId($id)));
            //pr($invoice_item);exit;
            if (!empty($invoice_item)) {
                for ($i = 0; $i < count($invoice_item); $i++) {
                    # code...
                    $update_item['qty_hours'] = $this->input->post('qty_hours_' . $invoice_item[$i]['_id']);
                    $update_item['product_name'] = $this->input->post('product_name_' . $invoice_item[$i]['_id']);
                    $update_item['rate'] = $this->input->post('rate_' . $invoice_item[$i]['_id']);
                    $update_item['description'] = $this->input->post('description_' . $invoice_item[$i]['_id']);
                    $update_item['tax_rate'] = $this->input->post('tax_rate_' . $invoice_item[$i]['_id']);
                    $update_item['cost'] = $this->input->post('cost_' . $invoice_item[$i]['_id']);
                    $update_item['cost_rate'] = $this->input->post('cost_rate_' . $invoice_item[$i]['_id']);
                    $update_item['tax_sub_data'] = $this->input->post('tax_sub_data_' . $invoice_item[$i]['_id']);
                    $update_item['tax_total_val'] = $this->input->post('tax_total_val_' . $invoice_item[$i]['_id']);
					$this->mongo_db->where('_id', new MongoId($invoice_item[$i]['_id']))->set($update_item)->update('invoice_items');
                }
            }
        } else { //insert
            $invoice_data['invoice_code'] = $this->input->post('invoice_auto_id');
            $invoice_data['created_by'] = $this->input->post('user_id');
            $invoice_data['created_date'] = $this->input->post('created_date');
            $invoice_data['due_date'] = $this->input->post('due_date');

            //pr($invoice_data);
            $id = $this->mongo_db->insert('invoices', $invoice_data);
            $msg = $this->lang->line('invoice_add_msg');
            $this->session->set_flashdata('msg', "<div class='alert alert-success text-center'>$msg</div>");
            $saveactivity = $this->save_activity($this->session->userdata('alice_session')['_id'],lang('create_new_invoice'),'Invoice');
            
        }
        if ($this->input->post('invoice_id')) {
            $id = $this->input->post('invoice_id');
        }
            
        //Insert new item limit
        $qty_hours = $this->input->post('qty_hours');
        $product_name = $this->input->post('product_name');
        $rate = $this->input->post('rate');
        $description = $this->input->post('description');
        $tax_rate = $this->input->post('tax_rate');
        $cost = $this->input->post('cost');
        $cost_rate = $this->input->post('cost_rate');
        $tax_sub_data = $this->input->post('tax_sub_data');
        $tax_total_val = $this->input->post('tax_total_val');
        
        //pr($product_insert_id);exit;

        if (count($qty_hours) > 0) {
            for ($i = 0; $i < count($qty_hours); $i++) {
                $item_data[$i]['invoice_id'] = new MongoId($id);
                $item_data[$i]['qty_hours'] = $qty_hours[$i];
                $item_data[$i]['rate'] = $rate[$i];
                $item_data[$i]['description'] = $description[$i];
                $item_data[$i]['tax_rate'] = $tax_rate[$i];
                $item_data[$i]['cost'] = $cost[$i];
                $item_data[$i]['cost_rate'] = $cost_rate[$i];
                $item_data[$i]['tax_sub_data'] = $tax_sub_data[$i];
                $item_data[$i]['tax_total_val'] = $tax_total_val[$i];
                
                //$item_data[$i]['product_name'] = $product_name[$i];
                
        $product_record = $this->mongo_db->get_where('product', array('product_name' => $product_name[$i]));
        
        if ($product_record) {
            $item_data[$i]['product_id'] = $product_record[0]['_id'];
        } else {
            $product_data['product_name'] = $product_name[$i];
        }
        if (count($product_record) == 0) {
            //INSERT Branch
            $product_data['created_date'] = datetimeformat();
            $product_data['modified_date'] = datetimeformat();
            $product_data['status'] = 1;

            $product_data_list = array(
                'product_name' => $product_data['product_name'],
                'price'=>$item_data[$i]['rate'],
                'created_date' => $product_data['created_date'],
                'modified_date' => $product_data['modified_date'],
                'status' => $product_data['status'],
            );
            $product_insert_id = $this->mongo_db->insert('product', $product_data_list);    
            $item_data[$i]['product_id'] = $product_insert_id;
        }
       }    
            $this->mongo_db->batch_insert('invoice_items', $item_data);
        }

        /* if ($this->input->post('hdn_submit_status') == 'print') {
          $section = $this->input->post('hdn_submit_status');
          $this->SendInvoice($id,$section);
          //echo $this->GeneratePrintPDF($id,$section);
          }
         */

        /* new code */
        $EstsubmitValue = $this->input->post('HdnSubmitBtnVlaue');
        $ESTActionArray = array();
        if ($EstsubmitValue == 'print') {
            //Direct Call the Generate Print function and redirect in Edit page
            echo $this->GeneratePrintPDF($id, 'print');
            $ESTActionArray = array('EstAction' => 'print');
            $RedirectMSG = lang('SUCCESS_SAVE_MSG');
        } elseif ($EstsubmitValue == 'sendInvoice') {
            //Call The Send Estimate Function and then redirect on 
            //$this->SendEstimate($id);
            //exit;
            $HdnChangeEmailTmp = $this->input->post('HdnChangeEmailTmp');
            if ($HdnChangeEmailTmp == 'yes') {
                $this->session->set_userdata('ESTChangeEmailTMP', $HdnChangeEmailTmp);
            }
            $ESTActionArray = array('EstAction' => 'sendInvoice');
            $RedirectMSG = lang('SUCCESS_SAVE_MSG');
        } else {
            $RedirectMSG = lang('SUCCESS_SAVE_MSG');
        }
        if (!empty($ESTActionArray) && $ESTActionArray != "") {
            $this->session->set_userdata('ESTAction', $ESTActionArray);
        }

        $error_msg = lang('invoice_add_msg');
        $this->session->set_flashdata('message', $error_msg);
        redirect($this->viewname . '/Edit/' . $id);
        exit;
    }
    
    public function SendInvoice() {
        $this->load->library('upload');
        $id = $this->input->post('invoice_id');
        $chngEmlTmp = 'takeEmailContent';
        $newEmailSubject = $this->input->post('emailTemplate_sub');
        $newEmailTemplateBody = $this->input->post('emailTemplate_body');
        $file_url='';
        if(!empty($_FILES)){
				$files = $_FILES;
		   	// Company Logo
				$_FILES['attach_file']['name'] = $files['attach_file']['name'];
				$_FILES['attach_file']['type'] = $files['attach_file']['type'];
				$_FILES['attach_file']['tmp_name'] = $files['attach_file']['tmp_name'];
				$_FILES['attach_file']['error'] = $files['attach_file']['error'];
				$_FILES['attach_file']['size'] = $files['attach_file']['size'];
                                
                $this->upload->initialize($this->set_upload_attach_file());
                $this->upload->do_upload('attach_file');
                $file_url = base_url('/uploads/attach_file/'.$_FILES['attach_file']['name']);
				
        }
        
        $data['editRecord'] = $this->mongo_db->get_where('invoices', array('_id' => new \MongoId($id)));
        $InvInfo = $data['editRecord'];
        $data['client_data'] = $this->mongo_db->get_where('Client', array('_id' => new \MongoId($data['editRecord'][0]['client_id'])));
        
        
        if (!empty($data['client_data'])) {
            $data['InvoicePdfreport'] = $this->mongo_db->get_where('invoices', array('_id' => new \MongoId($id)));
            $data['item_details'] = $this->mongo_db->get_where('invoice_items', array('invoice_id' => new \MongoId($id)));

            $user_id = $data['InvoicePdfreport'][0]['created_by'];
            $data['user_details'] = $this->mongo_db->get_where('User', array('_id' => new \MongoId($user_id)));
            $data['CompanyInformation'] = $this->mongo_db->get_where('CompanyInformation', array('user_id' => new \MongoId($user_id)));
            $PDFHtml = $this->DownloadPDF($id, 'StorePDF');
            if ($PDFHtml == 1) {
                $data['item_details'] = $this->mongo_db->get_where('invoice_items', array('invoice_id' => new \MongoId($id)));
                //$data['client_data'] = $this->mongo_db->get_where('Client', array('_id' => new \MongoId($data['editRecord'][0]['client_id'])));
                    $pdfFileName = "Invoice" . $data['editRecord'][0]['invoice_code'] . ".pdf";
                    $email_send_to = $data['client_data'][0]['email'];
                    $email_atached_arr[] = FCPATH . "uploads/invoice/" . $pdfFileName;
                    $this->sendMailToClient($email_send_to, $id, $chngEmlTmp, $newEmailSubject, $newEmailTemplateBody, $file_url);
                //Insert Data in Send Estimate Table
                $istSendInfo['invoice_id'] = $id;
                $istSendInfo['recipient_id'] = $data['editRecord'][0]['client_id'];
                $istSendInfo['created_date'] = datetimeformat();
                $LastId = $this->mongo_db->insert('invoice_send_to_client', $istSendInfo);
            }
            echo json_encode(array('status'=>1));
        }
        // return true;
    }

private function set_upload_attach_file() {
        $config = array();
        if (!is_dir('./upload/attach_file/')) {
			@mkdir('./uploads/attach_file/', 0777, TRUE);
		}
		$config['upload_path'] = './uploads/attach_file/'; //give the path to upload the image in folder
        //$config['upload_path'] = base_url('/uploads/attach_file/');     
        $config['allowed_types'] = '*';
        $config['max_size'] = 204800;
        $config['overwrite'] = FALSE;
        return $config;
    }
    
    function sendMailToClient($email_send_to, $id, $chngEmlTmp, $newEmailSubject, $newEmailTemplateBody, $file_url) {
        //echo $chngEmlTmp.' - '.$newEmailSubject.' - '.$newEmailTemplateBody;
        if (isset($email_send_to) && $email_send_to != "") {
            $pdfInvFileName = "invoice" . $id . ".pdf";
            $pdfInvPath = FCPATH . 'uploads/invoice/';
            if(!empty($file_url)){
                $attachfile = array('pdf_file' =>$pdfInvPath . $pdfInvFileName,'file_attach'=>$file_url);
            }else{
                $attachfile = array('pdf_file' =>$pdfInvPath . $pdfInvFileName);
            }
            
            
            $subject = "BLAZEDESK :: " . $newEmailSubject;
            $message = $newEmailTemplateBody;
            if (send_mail($email_send_to, $subject, $message, $attachfile)) {
                $saveactivity = $this->save_activity($this->session->userdata('alice_session')['_id'],lang('invoice_send_client'),'Invoice');
                $msg = ERROR_SUCCESS_DIV . 'Send Invoice To Client Successfully.' . ERROR_END_DIV;
            } else {
                $msg = ERROR_DANGER_DIV . lang('error') . ERROR_END_DIV;
            }
            echo $msg;
        }
    }

//$id,$section = NULL
    public function DownloadPDF($id, $section = NULL) {
         /*$id = '58372449085906d02600002d';
          $section = "StorePDF";
        */
        $data = [];
        //Get Invoice main records
        $data['editRecord'] = $this->mongo_db->get_where('invoices', array('_id' => new \MongoId($id)));
        $data['item_details'] = $this->mongo_db->get_where('invoice_items', array('invoice_id' => new \MongoId($id)));

        //Client information
        $data['client_data'] = $this->mongo_db->get_where('Client', array('_id' => new \MongoId($data['editRecord'][0]['client_id'])));
        //  pr($data['client_data']);exit;
        //Get All Tax Value
        $data['allTaxesArray'] = $this->mongo_db->get('Tax');

        //Get Estimate created user name

        $user_id = $data['editRecord'][0]['created_by'];
        $data['user_details'] = $this->mongo_db->get_where('User', array('_id' => new \MongoId($user_id)));
        $data['CompanyInformation'] = $this->mongo_db->get_where('CompanyInformation', array('user_id' => new \MongoId($user_id)));
        // $data['country_info']=$this->mongo_db->get('country');

        $data['taxes'] = $this->mongo_db->get('Tax');

        //Get Estimate created user name
        //Get added Estimate Symbol
        $PDFCuntArray = array();
        if (!empty($data['editRecord'][0]['currency']) && isset($data['editRecord'][0]['currency']) && $data['editRecord'][0]['currency'] != "") {
            $currency_id = $data['editRecord'][0]['currency'];
            $PDFCuntArray = $this->mongo_db->get_where('country', array('_id' => new \MongoId($currency_id)));
        }
        $data['PDFCuntArray'] = $PDFCuntArray;
        //pr($data['PDFCuntArray']);exit;

        $delval = '';
        $deltax = '';
        $subtotal = 0;
        $disctount_type = $data['editRecord'][0]['discount_type'];
        $discounts = $data['editRecord'][0]['discount'];
        $taxTot = 0;
        $subtotalCost = 0;
        $taxvalue = 0;
        $tax = array();
        //pr($subtotal);exit
        if (count($data['item_details']) > 0) {
            foreach ($data['item_details'] as $item_details) {
                $subtotal += $item_details['cost_rate'];
            }
            foreach ($data['item_details'] as $text_rate) {
                $taxid = $text_rate['tax_rate'];
                $taxDataPost = $text_rate['cost_rate'];

                $taxDbData = $this->mongo_db->get_where('Tax', array('_id' => new \MongoId($taxid)));
                $taxName = $taxDbData[0]['tax_name'];
                $taxPerc = $taxDbData[0]['tax'];

                if ($disctount_type == 2) {
                    $taxvalue = ((($taxDataPost - ($discounts / $subtotal) * $taxDataPost)) * $taxPerc) / 100;
                    $subtotalCost += (($taxDataPost - ($discounts / $subtotal) * $taxDataPost));
                } else {
                    $taxvalue = ((($taxDataPost - ($discounts * $taxDataPost) / 100)) * $taxPerc) / 100;
                    $subtotalCost += (($taxDataPost - ($discounts * $taxDataPost) / 100));
                }

                $taxTot += $taxvalue;
                if ($delval != $taxvalue && $deltax != $taxid) {
                    $taxdata[$taxid][] = array('name' => $taxName, 'tax' => number_format($taxvalue, 2));
                }
            }
            $subtotalCost += $taxTot;
            $finalarr = array();
            if (count($taxdata) > 0) {
                foreach ($taxdata as $key => $val) {
                    $finalarr[$key] = array_sum(array_column($val, 'tax'));
                }
            }
            $data['finalarr'] = $finalarr;
            $data['taxTot'] = $taxTot;
            $data['total'] = $subtotalCost;
        }




        $data['main_content'] = '/files/invoicepdf';
        $data['section'] = $section;
        $html = $this->parser->parse('layouts/PDFTemplate', $data);
        $pdfFileName = "Invoice" . $data['editRecord'][0]['invoice_code'] . ".pdf";
        $pdfFilePath = FCPATH . 'uploads/invoice/';
        if (!is_dir(FCPATH . 'uploads/invoice/')) {
            @mkdir(FCPATH . 'uploads/invoice/', 0777, TRUE);
        }
        if (file_exists($pdfFilePath . $pdfFileName)) {
            unlink($pdfFilePath . $pdfFileName);
        }

        $this->load->library('m_pdf');

        if ($section == 'StorePDF') {
            ob_clean();
                
            $this->m_pdf->pdf->WriteHTML($html);

            $this->m_pdf->pdf->Output($pdfFilePath . $pdfFileName, 'F');
            return 1;
            die;
        } elseif ($section == 'print') {
            $html;
        } else {
            $this->m_pdf->pdf->WriteHTML($html);
            $this->m_pdf->pdf->Output($pdfFileName, "D");
        }
    }

    function GeneratePrintPDF($id, $section = NULL) {
        $data = [];
        //Get Invoice main records
        $data['editRecord'] = $this->mongo_db->get_where('invoices', array('_id' => new \MongoId($id)));
        $data['item_details'] = $this->mongo_db->get_where('invoice_items', array('invoice_id' => new \MongoId($id)));

        //Client information
        $data['client_data'] = $this->mongo_db->get_where('Client', array('_id' => new \MongoId($data['editRecord'][0]['client_id'])));
        //  pr($data['client_data']);exit;
        //Get All Tax Value
        $data['allTaxesArray'] = $this->mongo_db->get('Tax');

        //Get Estimate created user name

        $user_id = $data['editRecord'][0]['created_by'];
        $data['user_details'] = $this->mongo_db->get_where('User', array('_id' => new \MongoId($user_id)));
        $data['CompanyInformation'] = $this->mongo_db->get_where('CompanyInformation', array('user_id' => new \MongoId($user_id)));
        // $data['country_info']=$this->mongo_db->get('country');

        $data['taxes'] = $this->mongo_db->get('Tax');

        //Get Estimate created user name
        //Get added Estimate Symbol
        $PDFCuntArray = array();
        if (!empty($data['editRecord'][0]['currency']) && isset($data['editRecord'][0]['currency']) && $data['editRecord'][0]['currency'] != "") {
            $currency_id = $data['editRecord'][0]['currency'];
            $PDFCuntArray = $this->mongo_db->get_where('country', array('_id' => new \MongoId($currency_id)));
        }
        $data['PDFCuntArray'] = $PDFCuntArray;
        //pr($data['PDFCuntArray']);exit;

        $delval = '';
        $deltax = '';
        $subtotal = 0;
        $disctount_type = $data['editRecord'][0]['discount_type'];
        $discounts = $data['editRecord'][0]['discount'];
        $taxTot = 0;
        $subtotalCost = 0;
        $taxvalue = 0;
        $tax = array();
        //pr($subtotal);exit
        if (count($data['item_details']) > 0) {
            foreach ($data['item_details'] as $item_details) {
                $subtotal += $item_details['cost_rate'];
            }
            foreach ($data['item_details'] as $text_rate) {
                $taxid = $text_rate['tax_rate'];
                $taxDataPost = $text_rate['cost_rate'];

                $taxDbData = $this->mongo_db->get_where('Tax', array('_id' => new \MongoId($taxid)));
                $taxName = $taxDbData[0]['tax_name'];
                $taxPerc = $taxDbData[0]['tax'];

                if ($disctount_type == 2) {
                    $taxvalue = ((($taxDataPost - ($discounts / $subtotal) * $taxDataPost)) * $taxPerc) / 100;
                    $subtotalCost += (($taxDataPost - ($discounts / $subtotal) * $taxDataPost));
                } else {
                    $taxvalue = ((($taxDataPost - ($discounts * $taxDataPost) / 100)) * $taxPerc) / 100;
                    $subtotalCost += (($taxDataPost - ($discounts * $taxDataPost) / 100));
                }

                $taxTot += $taxvalue;
                if ($delval != $taxvalue && $deltax != $taxid) {
                    $taxdata[$taxid][] = array('name' => $taxName, 'tax' => number_format($taxvalue, 2));
                }
            }
            $subtotalCost += $taxTot;
            $finalarr = array();
            if (count($taxdata) > 0) {
                foreach ($taxdata as $key => $val) {
                    $finalarr[$key] = array_sum(array_column($val, 'tax'));
                }
            }
            $data['finalarr'] = $finalarr;
            $data['taxTot'] = $taxTot;
            $data['total'] = $subtotalCost;
        }

        $data['main_content'] = '/files/invoicepdf';
        $data['section'] = $section;
        $html = $this->parser->parse('layouts/PDFTemplate', $data);
        $pdfFileName = "Invoice" . $data['editRecord'][0]['invoice_code'] . ".pdf";
        $pdfFilePath = FCPATH . 'uploads/invoice/';
        if (!is_dir(FCPATH . 'uploads/invoice/')) {
            @mkdir(FCPATH . 'uploads/invoice/', 0777, TRUE);
        }
        if (file_exists($pdfFilePath . $pdfFileName)) {
            unlink($pdfFilePath . $pdfFileName);
        }

        $this->load->library('m_pdf');
        if ($section == 'pdf') {
            $pdfFilePath = "Estimates.pdf";
            //load mPDF library
            //$this->load->library('m_pdf');
            //generate the PDF from the given html
            $this->m_pdf->pdf->WriteHTML($html);
            //download it.
            $this->m_pdf->pdf->Output($pdfFilePath, "D");
            //redirect('download/thassos_wonder_brochure', 'refresh'); 
        } elseif ($section == 'PDFStore') {
            return $html;
        } else {
            //echo $html;
        }
    }



    public function Delete($id) {
        $id = new MongoId($id);
        $this->mongo_db->where(array('_id' => $id))->delete('invoices');
        $this->mongo_db->where(array('_id' => $id))->delete('invoice_items');

        $error_msg = SUCCESS_START_DIV_NEW . lang('account_del_msg') . SUCCESS_END_DIV;
        $this->session->set_flashdata('message', $error_msg);
        redirect(site_url('Invoice'));
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
}

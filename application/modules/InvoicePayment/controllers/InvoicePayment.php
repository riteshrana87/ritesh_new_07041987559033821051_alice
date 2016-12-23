<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class InvoicePayment extends Public_controller {

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
        $data['footerJs'][6] = base_url('uploads/custom/invoice/invoice.js');

        $data['headerCss'][0] = base_url('uploads/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css');
        $data['headerCss'][1] = base_url('uploads/assets/plugins/bootstrap-daterangepicker/daterangepicker.css');
        $data['headerCss'][2] = base_url('uploads/assets/plugins/multiselect/css/multi-select.css');
        $data['headerCss'][3] = base_url('uploads/assets/plugins/select2/dist/css/select2.css');
        $data['headerCss'][4] = base_url('uploads/assets/plugins/select2/dist/css/select2-bootstrap.css');

        //$data['main_content'] = '/InvoicePayment';
        $data['pageTitle'] = lang('invoicePayment');
		
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
            '#select' => array('_id', 'client_id', 'amount', 'total_payment', 'currency', 'discount', 'total_tax', 'invoice_code', 'created_date','due_date','status'),
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

//        $data['clients']=$this->mongo_db->get('Client');

        $data['pagination']['totalPages'] = $dataSet['totalPages'];
        $data['pagination']['totalItems'] = $dataSet['totalItems'];
        $data['pagination']['links'] = $pagination->getPageLinks();
        $data['invoices'] = $result; //$this->mongo_db->get('Client');
        //pr($data['invoices']);exit;
        //$this->mongo_db->explain();
        //  $data['clients']=$this->mongo_db->get('Client');
        $data['footerJs'][0] = base_url('uploads/assets/plugins/bootstrap-sweetalert/sweet-alert.min.js');
        $data['footerJs'][1] = base_url('assets/pages/jquery.sweet-alert.init.js');
        $data['footerJs'][2] = base_url('uploads/custom/invoice/invoice.js');
        $data['headerCss'][0] = base_url('uploads/assets/plugins/bootstrap-sweetalert/sweet-alert.css');
        $data['headerCss'][1] = base_url('uploads/custom/Developer.css');
        $data['url'] = $url;
        if ($this->input->is_ajax_request()) {
            if ($this->input->post('view') == 'grid') {
                //pr($data);exit;
                $this->load->view('GridView', $data);
            } else {
                $this->load->view('ListView', $data);
            }
        } else {
            $this->parser->parse('layouts/PageTemplate', $data);
        }
    }
	public function Pay($invoice_id = '') {
		
		if(!empty($invoice_id)){
		$data['main_content'] = '/'.$this->viewname;
		$data['invoice_id'] = $invoice_id;
        $data['footerJs'][0] = base_url('uploads/assets/plugins/parsleyjs/dist/parsley.min.js');
        $data['footerJs'][1] = base_url('uploads/assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js');
        $data['footerJs'][2] = base_url('uploads/assets/plugins/bootstrap-daterangepicker/daterangepicker.js');
        $data['footerJs'][3] = base_url('uploads/assets/plugins/multiselect/js/jquery.multi-select.js');
        $data['footerJs'][4] = base_url('uploads/assets/plugins/jquery-quicksearch/jquery.quicksearch.js');
        $data['footerJs'][5] = base_url('uploads/assets/plugins/select2/dist/js/select2.min.js');
        $data['footerJs'][6] = base_url('uploads/custom/invoice/invoice.js');
        $data['footerJs'][7] = base_url('uploads/custom/InvoicePay/invoicepay.js');

        $data['headerCss'][0] = base_url('uploads/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css');
        $data['headerCss'][1] = base_url('uploads/assets/plugins/bootstrap-daterangepicker/daterangepicker.css');
        $data['headerCss'][2] = base_url('uploads/assets/plugins/multiselect/css/multi-select.css');
        $data['headerCss'][3] = base_url('uploads/assets/plugins/select2/dist/css/select2.css');
        $data['headerCss'][4] = base_url('uploads/assets/plugins/select2/dist/css/select2-bootstrap.css');
        $data['headerCss'][5] = base_url('uploads/custom/InvoicePay/invoicepay.css');
		

        //$data['main_content'] = '/InvoicePayment';
        $data['pageTitle'] = lang('invoicePayment');
		//$id = $this->session->userdata['alice_session']['_id'];
       
        $data['invoice_details'] = $this->mongo_db->get_where('invoices',array('_id' => new \MongoId($invoice_id)));
        //$data['invoice_details'] = $this->mongo_db->get_where('invoices',array('invoice_code' => $invoice_id));
        $data['invoice_items'] = $this->mongo_db->get_where('invoice_items',array('invoice_id' => new \MongoId($invoice_id)));
        
		$invoce_create_by = $data['invoice_details'][0]['created_by'];
		$data['user_details'] = $this->mongo_db->get_where('User',array('_id' => new \MongoId($invoce_create_by)));
		$data['CompanyInformation'] = $this->mongo_db->get_where('CompanyInformation',array('user_id' => new \MongoId($invoce_create_by)));
		 
		$data['clients']=$this->mongo_db->get('Client');
        $data['taxes']=$this->mongo_db->get('Tax');
        $data['country_info']=$this->mongo_db->get('country');
		
        $data['stripedetails']=$this->mongo_db->get_where('stripe_config',array('client_id' => new \MongoId($invoce_create_by)));
        $data['paypaldetails']=$this->mongo_db->get_where('paypal_config',array('client_id' => new \MongoId($invoce_create_by)));
        $data['idealdetails']=$this->mongo_db->get_where('ideal_config',array('client_id' => new \MongoId($invoce_create_by)));
		
		$this->parser->parse('layouts/InvoicePayTempalate', $data);
		
		}
		
	}
	
	public function PaymentGateway($invoice_id = '') {
		
		if(!empty($invoice_id)){
		
		$this->load->library('Paypal_lib');	
			
		$data['main_content'] = '/PaymentGateway';
		$data['invoice_id'] = $invoice_id;
        $data['footerJs'][0] = base_url('uploads/assets/plugins/parsleyjs/dist/parsley.min.js');
        $data['footerJs'][1] = base_url('uploads/assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js');
        $data['footerJs'][2] = base_url('uploads/assets/plugins/bootstrap-daterangepicker/daterangepicker.js');
        $data['footerJs'][3] = base_url('uploads/assets/plugins/multiselect/js/jquery.multi-select.js');
        $data['footerJs'][4] = base_url('uploads/assets/plugins/jquery-quicksearch/jquery.quicksearch.js');
        $data['footerJs'][5] = base_url('uploads/assets/plugins/select2/dist/js/select2.min.js');
        $data['footerJs'][6] = base_url('uploads/custom/invoice/invoice.js');
        $data['footerJs'][7] = base_url('uploads/custom/InvoicePay/invoicepay.js');

        $data['headerCss'][0] = base_url('uploads/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css');
        $data['headerCss'][1] = base_url('uploads/assets/plugins/bootstrap-daterangepicker/daterangepicker.css');
        $data['headerCss'][2] = base_url('uploads/assets/plugins/multiselect/css/multi-select.css');
        $data['headerCss'][3] = base_url('uploads/assets/plugins/select2/dist/css/select2.css');
        $data['headerCss'][4] = base_url('uploads/assets/plugins/select2/dist/css/select2-bootstrap.css');
        $data['headerCss'][5] = base_url('uploads/custom/InvoicePay/invoicepay.css');
		
		$invoice_installment_amount = $this->input->post('invoice_installment_amount');
		$total_amount_to_pay = $this->input->post('total_amount_to_pay');
		$radioInline = $this->input->post('radioInline');
		
		$data['invoice_installment_amount'] = $invoice_installment_amount;
		$data['total_amount_to_pay'] = $total_amount_to_pay;
		$data['radioInline'] = $radioInline;
		
		$data['clients']=$this->mongo_db->get('Client');
		
		
        //$data['main_content'] = '/InvoicePayment';
        $data['pageTitle'] = lang('invoicePayment');
		//$id = $this->session->userdata['alice_session']['_id'];
       
        $data['invoice_details'] = $this->mongo_db->get_where('invoices',array('_id' => new \MongoId($invoice_id)));
        //$data['invoice_details'] = $this->mongo_db->get_where('invoices',array('invoice_code' => $invoice_id));
        $data['invoice_items'] = $this->mongo_db->get_where('invoice_items',array('invoice_id' => new \MongoId($invoice_id)));
        
		$invoce_create_by = $data['invoice_details'][0]['created_by'];
		$data['user_details'] = $this->mongo_db->get_where('User',array('_id' => new \MongoId($invoce_create_by)));
		$data['CompanyInformation'] = $this->mongo_db->get_where('CompanyInformation',array('user_id' => new \MongoId($invoce_create_by)));
		 
		$data['clients']=$this->mongo_db->get('Client');
        $data['taxes']=$this->mongo_db->get('Tax');
        $data['country_info']=$this->mongo_db->get('country');
		
        $data['stripedetails']=$this->mongo_db->get_where('stripe_config',array('client_id' => new \MongoId($invoce_create_by)));
        $data['paypaldetails']=$this->mongo_db->get_where('paypal_config',array('client_id' => new \MongoId($invoce_create_by)));
        $data['idealdetails']=$this->mongo_db->get_where('ideal_config',array('client_id' => new \MongoId($invoce_create_by)));
		
		$this->parser->parse('layouts/InvoicePayTempalate', $data);
		
		
		/* Paypal Configuration*/
		//Set variables for paypal form
		/* $returnURL = base_url().'/PaypalSuccess'; //payment success url
		$cancelURL = base_url().'PaypalCancel'; //payment cancel url
		$notifyURL = base_url().'PaypalIpn'; //ipn url
		$product = $this->product->getRows($id);
		$userID = 1; //current user id
		
		$this->paypal_lib->add_field('return', $returnURL);
		$this->paypal_lib->add_field('cancel_return', $cancelURL);
		$this->paypal_lib->add_field('notify_url', $notifyURL);
		$this->paypal_lib->add_field('item_name', $product['name']);
		$this->paypal_lib->add_field('custom', $userID);
		$this->paypal_lib->add_field('item_number',  $product['id']);
		$this->paypal_lib->add_field('amount',  $product['price']);		
		
		$this->paypal_lib->paypal_auto_form(); */
		}
		
	}
	public function PayWithPaypal() {
		/* Paypal Configuration*/
		$this->load->library('Paypal_lib');	
		$invoice_id = $this->input->post('paypal_invoiceid');
		$payable_amount = $this->input->post('payable_amount');
		$paypal_email = $this->input->post('paypal_email');
		
		$paypal_radioInline = $this->input->post('paypal_radioInline');
		$paypal_totalamounttopay = $this->input->post('paypal_totalamounttopay');
		
		///die();
		//Set variables for paypal form
		$returnURL = base_url().'InvoicePayment/PaypalSuccess'; //payment success url
		$cancelURL = base_url().'InvoicePayment/Pay/'.$invoice_id; //payment cancel url
		$notifyURL = base_url().'InvoicePayment/PaypalIpn'; //ipn url
		//get particular product data
		$userID = 1; //current user id
		$data['invoice_details'] = $this->mongo_db->get_where('invoices',array('_id' => new \MongoId($invoice_id)));
		$this->paypal_lib->add_field('return', $returnURL);
		$this->paypal_lib->add_field('cancel_return', $cancelURL);
		$this->paypal_lib->add_field('notify_url', $notifyURL);
		
		$data['currency_details'] = $this->mongo_db->get_where('country',array('currrency_symbol' => $data['invoice_details'][0]['currency']));
		
		if(!empty($data['currency_details'][0]['currency_code'])){
			$currency_code = $data['currency_details'][0]['currency_code'];
		}
		else{
			$currency_code = 'USD';
		}
		$this->paypal_lib->add_field('item_name', 'Invoice '.$data['invoice_details'][0] ['invoice_code']);
		$this->paypal_lib->add_field('custom', $invoice_id);
		$this->paypal_lib->add_field('paypalradioInline', $paypal_radioInline);
		$this->paypal_lib->add_field('paypaltotalamounttopay', $paypal_totalamounttopay);
		$this->paypal_lib->add_field('item_number', $data['invoice_details'][0] ['invoice_code']);
		$this->paypal_lib->add_field('invoice_id',  $invoice_id);
		$this->paypal_lib->add_field('amount', $payable_amount);		
		$this->paypal_lib->add_field('currency_code', $currency_code);		
		
		//die();
		$this->paypal_lib->paypal_auto_form();
	}
	
	public function PaypalSuccess() {
		$paypalInfo = $this->input->get();
			
		//$this->CI->load->config('paypallib_config');
		
		$paypalInfo2 = $this->input->post();
		echo "<br> <br> <pre>";
		//print_r($paypalInfo2);
		echo "</pre>";
		$invoice_id = $paypalInfo2['custom']; 
		$invoice_details = $this->mongo_db->get_where('invoices',array('_id' => new \MongoId($invoice_id)));
		$paypal_totalamounttopay = $invoice_details[0]['total_payment'];
		
		$invoice_number = $paypalInfo2['item_number'];
		$paid_amount = $paypalInfo2["payment_gross"];
		$payment_id = $paypalInfo2['txn_id'];
		$receipt_id = $paypalInfo2['receipt_id'];
		$balance_transaction = '';
		$customer_id = '';
		$card_id = '';
		$card_brand = '';
		$card_type = '';
		$card_last4 = '';
		$card_exp_month= '';
		$card_exp_year = '';
		
		//pass the transaction data to view
       // $this->load->view('paypal/success', $data);
	   if($paypalInfo2["payment_gross"] >= $paypal_totalamounttopay){
		$payment_mode = 'full';
	   }
	   else{
	    $payment_mode = 'partial';
	   }
	   
	   $invoicepaid = array('invoice_id' => new \MongoId($invoice_id),
                'invoice_number' => $invoice_number,
                'paid_amount' => $paid_amount,
                'payment_mode' => $payment_mode,
                'payment_id' => $payment_id,
                'receipt_id' => $receipt_id,
                'balance_transaction' => $balance_transaction,
                'customer_id' => $customer_id,
                'card_id' => $card_id,
                'card_brand' => $card_brand,
                'card_type' => $card_type,
                'card_last4' => $card_last4,
                'card_exp_month' => $card_exp_month,
                'card_exp_year' => $card_exp_year,
                'payment_date' => date('Y-m-d h:i:s'),
                'payment_with' => 'Paypal'
            );
            
			$inserted = $this->mongo_db->insert('InvoicePaid', $invoicepaid);
			
		
			 if($inserted){
				$invoice_paid = $this->mongo_db->get_where('InvoicePaid',array('invoice_id' => $invoice_id));
				
				$tot = 0;
				foreach($invoice_paid as $inv){
					$tot = $tot + $inv['paid_amount'];
				}
				
				if($tot >= $paypal_totalamounttopay){
					$datatoinvoicecollection = array(
						'payment_status' => 'full'
					);
				}
				else{
					$datatoinvoicecollection = array(
						'payment_status' => 'partial'
					);
				}
				
				$this->mongo_db->where('_id', new MongoId($invoice_id))->set($datatoinvoicecollection)->update('invoices'); 
			}
	    
	   
			$error_msg = SUCCESS_START_DIV_NEW . lang('profile_add_msg') . SUCCESS_END_DIV;
			$this->session->set_flashdata('message', $error_msg);
			redirect(base_url('InvoicePayment/PaymentSuccess'));
	}	
	
	public function PaypalIpn() {
		$paypalInfo = $this->input->post();
		echo "<br> <br>PaypalIpn:: <br>";  
		print_r($paypalInfo);
		$data['item_number'] = $paypalInfo['item_number']; 
		$data['txn_id'] = $paypalInfo["tx"];
		$data['payment_amt'] = $paypalInfo["amt"];
		$data['currency_code'] = $paypalInfo["cc"];
		$data['status'] = $paypalInfo["st"];
		
		//pass the transaction data to view
       // $this->load->view('paypal/success', $data);
	}	
	
	
	public function PayWithStripe() {
		/* Paypal Configuration */
		//$this->load->library('stripe');	
		require_once(APPPATH.'libraries/payment/lib/Stripe.php');
		
		$invoice_id = $this->input->post('stripe_invoiceid');
		$payable_amount = $this->input->post('payable_amount');
		$stripe_radioInline = $this->input->post('stripe_radioInline');
		$stripe_totalamounttopay = $this->input->post('stripe_totalamounttopay');
		
		$data['invoice_details'] = $this->mongo_db->get_where('invoices',array('_id' => new \MongoId($invoice_id)));
		$data['currency_details'] = $this->mongo_db->get_where('country',array('currrency_symbol' => $data['invoice_details'][0]['currency']));
		
		if(!empty($data['currency_details'][0]['currency_code'])){
			$currency_code = $data['currency_details'][0]['currency_code'];
		}
		else{
			$currency_code = 'USD';
		}
		
		//print_r($payable_amount);
		//die();
		
		if ($this->input->post('stripeToken')) {
			
		//print_r($this->input->post('stripeToken'));	
		
		try {
			$STRIPE_KEY_SK = 'sk_test_WouBifyaf8ool8fg6f4bpNgr';
			//$STRIPE_KEY_SK = 'sk_test_ELazZ12erwvhGaSFfpzaAAmB';
			Stripe::setApiKey($STRIPE_KEY_SK);
			$stripe = array( "secret_key" => $STRIPE_KEY_SK);
			$token=$this->input->post('stripeToken');
			
			if($this->input->post('cust_id')==''){
				//die('blank');
				//echo  "in";
				try{
					  $customer = Stripe_Customer::create(array(
                      "source" => $this->input->post('stripeToken'),
                      "plan" => 'crm_alice',
                      "email" => $this->input->post('stripe_email')
                      ), $STRIPE_KEY_SK);
                      
                      $cust_id=$customer->id;
			   
			   $invoice = Stripe_Charge::create( array(
							'customer'    => $cust_id, // the customer to apply the fee to
							'description' => "Charge for test@example.com",
							'receipt_email' => $this->input->post('stripe_email'),
							'currency'=>'usd',//REQUIRED
							'amount'=>($payable_amount*100) //REQUIRED
							), $STRIPE_KEY_SK );
					}catch(Exception $e){
						echo $e->getmessage();
						exit;
						
					}
			   /* print_r($invoice);
			   die('create'); */
			}
			else{
				try{
				$cust_id=$this->input->post("cust_id");
				 $customer = Stripe_Customer::retrieve($this->input->post("cust_id"), $STRIPE_KEY_SK);
                    $customer->updateSubscription(array(
                        'plan' => 'crm_alice'
                            )
                    );
                    
                    $customer->save();
                    $invoice = Stripe_Charge::create( array(
							'customer'    => $cust_id, // the customer to apply the fee to
							'description' => "Charge for test@example.com",
							'receipt_email' => $this->input->post('stripe_email'),
							'currency'=>'usd',
							'amount'=>$payable_amount
							), $STRIPE_KEY_SK );
					}catch(Exception $e){
						//echo $e->getmessage();
						
						
					}
					
					
					//die('update');
			}
				/* pr($data['setup']);
				die('here'); */
				
				/*$tot_pm_user=$data['setup'][0]['pm_user'] + $this->input->post('pm_user');
				$tot_support_user=$data['setup'][0]['support_user'] + $this->input->post('support_user');
				$tot_crm_user=$data['setup'][0]['crm_user'] + $this->input->post('crm_user');*/
				/*echo $tot_amount;
				die('here');*/
				$tot_crm_user=7;
				$setup_master['crm_user'] = 456;
				//$total_user = $data['setup'][0]['pm_user'] + $data['setup'][0]['support_user'] + $tot_amount;
				$setup_master['total_user'] = 510;
				$setup_master['cust_id'] = $cust_id;
				
				//$where = array('setup_id' => $setup_master_id);
			
				/* pr($setup_master);
				die('here'); */
				//$success_setup = $this->common_model->update_data(SETUP,$setup_master,$where);
			
			/*pr($customer->id);
			die();*/
				
				
			/* to save into the databse */
			$payment_source = $invoice->source;
			$paid = $invoice->paid;
			$user_id = $this->input->post('stripe_userid');
			$client_id = $this->input->post('stripe_clientid');
			$invoice_id = $invoice_id;
			$invoice_number = $this->input->post('stripe_invoicenumber');
			$payment_date = date('Y-m-d h:i:s');
			$paid_amount = $payable_amount;	
			$payment_id = $invoice->id;
			$balance_transaction = $invoice->balance_transaction;
			$customer_id = $cust_id;
			$card_id = $payment_source->id ;
			$card_brand = $payment_source->brand ;
			$card_type = $payment_source->funding ;
			$card_last4 = $payment_source->last4 ;
			$card_exp_month = $payment_source->exp_month ;
			$card_exp_year = $payment_source->exp_year ;
			if($stripe_radioInline == 'full_payment'){
				$payment_mode = 'full';
			}
			else{
				$payment_mode = 'partial';
			}	
			
			if($payment_source->status=='succeeded'){
			
			$invoicepaid = array('invoice_id' => new \MongoId($invoice_id),
                'invoice_number' => $invoice_number,
                'paid_amount' => $paid_amount,
                'payment_mode' => $payment_mode,
                'payment_id' => $payment_id,
                'balance_transaction' => $balance_transaction,
                'customer_id' => $customer_id,
                'card_id' => $card_id,
                'card_brand' => $card_brand,
                'card_type' => $card_type,
                'card_last4' => $card_last4,
                'card_exp_month' => $card_exp_month,
                'card_exp_year' => $card_exp_year,
                'payment_date' => date('Y-m-d h:i:s'),
                'payment_with' => 'Stripe'
            );
            
			$inserted = $this->mongo_db->insert('InvoicePaid', $invoicepaid);
			
			/* 
			echo "<br> <br> <br>Inserted::";
			print_r($inserted);
			echo "<br>"; */
			if($inserted){
				$invoice_paid = $this->mongo_db->get_where('InvoicePaid',array('invoice_id' => new \MongoId($invoice_id)));
				
				/* echo "<br> <br> <br>invoice_paid::";
				print_r($invoice_paid);
				echo "<br>"; */
				$tot = 0;
				foreach($invoice_paid as $inv){
					$tot = $tot + $inv['paid_amount'];
				}
				/* echo "<br>tot: ";
				print_R($tot); */
				if($tot >= $stripe_totalamounttopay){
					$datatoinvoicecollection = array(
						'payment_status' => 'full'
					);
				}
				else{
					$datatoinvoicecollection = array(
						'payment_status' => 'partial'
					);
				}
				
				/* print_r($datatoinvoicecollection); */
				$this->mongo_db->where('_id', new MongoId($invoice_id))->set($datatoinvoicecollection)->update('invoices'); 
			}
			
		
		$error_msg = SUCCESS_START_DIV_NEW . lang('profile_add_msg') . SUCCESS_END_DIV;
        $this->session->set_flashdata('message', $error_msg);
        redirect(base_url('InvoicePayment/PaymentSuccess'));
		}
		
		else{
			redirect(base_url('InvoicePayment/PaymentFail'));
		}
			
		}
 
		catch(Stripe_CardError $e) {
 
		}
		catch (Stripe_InvalidRequestError $e) {
 
		} catch (Stripe_AuthenticationError $e) {
		} catch (Stripe_ApiConnectionError $e) {
		} catch (Stripe_Error $e) {
		} catch (Exception $e) {
			
		}
		
		
	}
	}
	
	
	public function PayWithIdeal() {
		require_once(APPPATH.'libraries/src/Mollie/API/Autoloader.php');		
		$mollie = new Mollie_API_Client;
		//$mollie->setAccessToken("access_Wwvu7egPcJLLJ9Kb7J632x8wJ2zMeJ");
		$mollie->setApiKey("test_SpWmjKGrPanhSs2pNf3ubN8DTnpVda");
		/*
 * Example 4 - How to prepare an iDEAL payment with the Mollie API.
 */

	try
	{
		/*
		 * Initialize the Mollie API library with your API key.
		 *
		 * See: https://www.mollie.com/beheer/account/profielen/
		 */
		//include "initialize.php";

		/*
		 * First, let the customer pick the bank in a simple HTML form. This step is actually optional.
		 */
		if ($_SERVER["REQUEST_METHOD"] != "POST")
		{
			echo "<br>1:: <br>";
			$issuers = $mollie->issuers->all();

			echo '<form method="post">Select your bank: <select name="issuer">';

			foreach ($issuers as $issuer)
			{
				if ($issuer->method == Mollie_API_Object_Method::IDEAL)
				{
					echo '<option value=' . htmlspecialchars($issuer->id) . '>' . htmlspecialchars($issuer->name) . '</option>';
				}
			}
			echo '<option value="">or select later</option>';
			echo '</select><button>OK</button></form>';
			exit;
		}

		/*
		 * Generate a unique order id for this example. It is important to include this unique attribute
		 * in the redirectUrl (below) so a proper return page can be shown to the customer.
		 */
		$order_id = time();

		/*
		 * Determine the url parts to these example files.
		 */
		$protocol = isset($_SERVER['HTTPS']) && strcasecmp('off', $_SERVER['HTTPS']) !== 0 ? "https" : "http";
		$hostname = $_SERVER['HTTP_HOST'];
		$path     = dirname(isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : $_SERVER['PHP_SELF']);

		/*
		 * Payment parameters:
		 *   amount        Amount in EUROs. This example creates a € 27.50 payment.
		 *   method        Payment method "ideal".
		 *   description   Description of the payment.
		 *   redirectUrl   Redirect location. The customer will be redirected there after the payment.
		 *   metadata      Custom metadata that is stored with the payment.
		 *   issuer        The customer's bank. If empty the customer can select it later.
		 */
		$payment = $mollie->payments->create(array(
			"amount"       => $this->input->post('payable_amount'),
			"method"       => Mollie_API_Object_Method::IDEAL,
			"description"  => "My first iDEAL payment",
			"redirectUrl"  => base_url('InvoicePayment/PaymentSuccessIdeal/odr_'.$order_id),
			"metadata"     => array(
				"order_id" => $order_id,
				"payable_amount" => $this->input->post('payable_amount'),
				
			),
			"issuer"       => !empty($_POST["issuer"]) ? $_POST["issuer"] : NULL
		));

		/*
		 * In this example we store the order with its payment status in a database.
		 */
		//database_write($order_id, $payment->status);

		/*
		 * Send the customer off to complete the payment.
		 */
		//header("Location: " . $payment->getPaymentUrl());
	 	
			echo "<br> <br><pre>";
			print_r($payment);
			echo "</pre><br><br>****"; 
			
		
		
		}
		catch (Mollie_API_Exception $e)
		{
			echo "API call failed: " . htmlspecialchars($e->getMessage());
		}
		
		
		/* to save into the databse */
			$user_id = $this->input->post('ideal_userid');
			$client_id = $this->input->post('ideal_clientid');
			$invoice_id = $this->input->post('ideal_invoiceid');
			$invoice_number = $this->input->post('ideal_invoicenumber');
			$payment_date = date('Y-m-d h:i:s');
			$paid_amount = $this->input->post('payable_amount');
			$payment_id = $payment->id;
			$payment_url = $payment->links->paymentUrl;
			$balance_transaction = '';
			$customer_id = '';
			$card_id = '' ;
			$card_brand = '';
			$card_type = '';
			$card_last4 = '';
			$card_exp_month = '';
			$card_exp_year = '';
			$ideal_radioInline = $this->input->post('ideal_radioInline');
			if($ideal_radioInline == 'full_payment'){
				$payment_mode = 'full';
			}
			else{
				$payment_mode = 'partial';
			}
		
		$invoicepaid = array('invoice_id' => new \MongoId($invoice_id),
                'invoice_number' => $invoice_number,
                'paid_amount' => $paid_amount,
                'payment_mode' => $payment_mode,
                'payment_id' => $payment_id,
                'balance_transaction' => $balance_transaction,
                'customer_id' => $customer_id,
                'card_id' => $card_id,
                'card_brand' => $card_brand,
                'card_type' => $card_type,
                'card_last4' => $card_last4,
                'card_exp_month' => $card_exp_month,
                'card_exp_year' => $card_exp_year,
                'payment_date' => date('Y-m-d h:i:s'),
                'payment_with' => 'Ideal',
                'ideal_status' => 'open',
                'ideal_uniquecode' => 'odr_'.$order_id
            );
            
			$inserted = $this->mongo_db->insert('InvoicePaid', $invoicepaid);
			
			/* 
			echo "<br> <br> <br>Inserted::";
			print_r($inserted);
			echo "<br>"; */
			if($inserted){
				$invoice_paid = $this->mongo_db->get_where('InvoicePaid',array('invoice_id' => new \MongoId($invoice_id)));
				
				$tot = 0;
				foreach($invoice_paid as $inv){
					$tot = $tot + $inv['paid_amount'];
				}
				
				if($tot >= $this->input->post('ideal_totalamounttopay')){
					$datatoinvoicecollection = array(
						'payment_status' => 'full'
					);
				}
				else{
					$datatoinvoicecollection = array(
						'payment_status' => 'partial'
					);
				}
				/* print_r($datatoinvoicecollection); */
				$this->mongo_db->where('_id', new MongoId($invoice_id))->set($datatoinvoicecollection)->update('invoices'); 
			}
		
		
		$this->session->set_flashdata('transaction_id_ideal', $payment_id);
		$payment22 = $this->paymentStatusCheck($this->session->flashdata('transaction_id_ideal'));
		/* 
		
		echo "<br>xc::<br>";
		print_r($this->session->flashdata('transaction_id_ideal'));
		echo "<br>cv:: <br>";
		print_r($payment22);
		die('iDEAL'); */
		
		$error_msg = SUCCESS_START_DIV_NEW . lang('profile_add_msg') . SUCCESS_END_DIV;
        $this->session->set_flashdata('message', $error_msg);
		redirect($payment->links->paymentUrl);
		
		//die();
	}
		
    public function paymentStatusCheck($payment_id) {
		
		require_once(APPPATH.'libraries/src/Mollie/API/Autoloader.php');		
		$mollie = new Mollie_API_Client;
		//$mollie->setAccessToken("access_Wwvu7egPcJLLJ9Kb7J632x8wJ2zMeJ");
		$mollie->setApiKey("test_SpWmjKGrPanhSs2pNf3ubN8DTnpVda");
		
		$payment22  = $mollie->payments->get($payment_id);
		return $payment22;
	}
	
	
    public function GridView() {
        $data['main_content'] = '/GridView';
        $data['pageTitle'] = lang('clients');
        $data['clients'] = $this->mongo_db->get('Client');
        $data['footerJs'][0] = base_url('uploads/assets/plugins/bootstrap-sweetalert/sweet-alert.min.js');
        $data['footerJs'][1] = base_url('assets/pages/jquery.sweet-alert.init.js');
        $data['footerJs'][2] = base_url('uploads/custom/invoice/invoice.js');
        $data['headerCss'][0] = base_url('uploads/assets/plugins/bootstrap-sweetalert/sweet-alert.css');
        $data['headerCss'][1] = base_url('uploads/custom/Developer.css');
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
		
		$this->mongo_db->insert('invoice_recurring', $insert_data);
		
		echo json_encode(array('status'=>1,'url'=>base_url('Invoice')));
		die;
    }

    function invoice_auto_gen_Id() {
        return 'INV' . mt_rand(100000, 999999);
    }

    public function Add() {
        $data['main_content'] = '/AddInvoice';

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
        $data['footerJs'][16] = base_url('uploads/custom/invoice/invoice.js');


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

        $id = $this->session->userdata['alice_session']['_id'];
        $data['user_details'] = $this->mongo_db->get_where('User',array('_id' => new \MongoId($id)));
        $data['CompanyInformation'] = $this->mongo_db->get_where('CompanyInformation',array('user_id' => new \MongoId($id)));
        $data['clients']=$this->mongo_db->get('Client');
        $data['taxes']=$this->mongo_db->get('Tax');
        $data['country_info']=$this->mongo_db->get('country');
        //pr($data['country_info']);exit;

        //pr($data['taxes']);exit;

        $data['invoice_auto_id'] = $this->invoice_auto_gen_Id();

        $this->parser->parse('layouts/PageTemplate', $data);
    }


    public function Edit($invoice_id) {

        $data['pageTitle'] = lang('edit_client');

        if ($invoice_id != '') {
            //$data['main_content'] = '/EditInvoice';
            $data['main_content'] = '/AddInvoice';

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


            //$user_id = $this->session->userdata['alice_session']['_id'];
            $data['invoice_auto_id'] = $this->invoice_auto_gen_Id();
            //echo 'invoice :-'. $invoice_id;
            $data['editrecord'] = $this->mongo_db->get_where('invoices', array('_id' => new \MongoId($invoice_id)));
            //pr($data['editrecord']);exit;
            $data['invoice_items']=$this->mongo_db->get('invoice_items');
            $data['item_details'] = $this->mongo_db->get_where('invoice_items', array('invoice_id' => new \MongoId($invoice_id)));
          //  pr($data['item_details']);exit;
            $user_id = $data['editrecord'][0]['created_by'];
            $data['user_details'] = $this->mongo_db->get_where('User',array('_id' => new \MongoId($user_id)));
            $data['CompanyInformation'] = $this->mongo_db->get_where('CompanyInformation',array('user_id' => new \MongoId($user_id)));


            $data['clients']=$this->mongo_db->get('Client');
            $data['taxes']=$this->mongo_db->get('Tax');
            $data['country_info']=$this->mongo_db->get('country');




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

    public function insertdata()
    {
        //pr($_POST);exit;
        if ($this->input->post('save')) {
            if ($this->input->post('invoice_id')) {
                $id  = $this->input->post('invoice_id');
            }

            $invoice_data['client_id'] = $this->input->post('client_id');
            $invoice_data['amount'] = $this->input->post('amount_total');
            $invoice_data['total_payment'] = $this->input->post('add_dis_amount_total');
            $invoice_data['currency'] = $this->input->post('country_info');
            $invoice_data['discount'] = $this->input->post('discount');
            $invoice_data['total_tax'] = $this->input->post('total_tax_payment');
            $invoice_data['tax_amount'] = $this->input->post('tax_amount');
            $invoice_data['status'] = 1;
            //Insert Record in Database

            if (!empty($id)) { //update
                $invoice_data['invoice_code'] = $this->input->post('invoice_auto_id');
                $invoice_data['created_by'] = $this->input->post('user_id');
                $invoice_data['created_date'] = $this->input->post('order_date');
                $invoice_data['due_date'] = $this->input->post('due_date');
                $success_update = $this->mongo_db->where('_id', new MongoId($id))->set($invoice_data)->update('invoices');
                //Delete invoie item
                $delete_item_id = $this->input->post('delete_item_id');
                //pr($delete_item_id);exit;
                if (!empty($delete_item_id)) {
                    $delete_item = substr($delete_item_id, 0, -1);
                    $delete_item_id = explode(',', $delete_item);
                    foreach ($delete_item_id as $delete_item){
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
                        $update_item['rate'] = $this->input->post('rate_' . $invoice_item[$i]['_id']);
                        $update_item['description'] = $this->input->post('description_' . $invoice_item[$i]['_id']);
                        $update_item['tax_rate'] = $this->input->post('tax_rate_' . $invoice_item[$i]['_id']);
                        $update_item['cost'] = $this->input->post('cost_' . $invoice_item[$i]['_id']);
                        $update_item['cost_rate'] = $this->input->post('cost_rate_' . $invoice_item[$i]['_id']);
                        $update_item['tax_sub_data'] = $this->input->post('tax_sub_data_' . $invoice_item[$i]['_id']);
                        $update_item['tax_total_val'] = $this->input->post('tax_total_val_' . $invoice_item[$i]['_id']);

                    //    $success_update = $this->mongo_db->where('_id', new MongoId($invoice_item[$i]['_id']))->set($update_item)->update('invoice_items');
                    }

                }


            } else { //insert
                $invoice_data['invoice_code'] = $this->input->post('invoice_auto_id');
                $invoice_data['created_by'] = $this->input->post('user_id');
                $invoice_data['created_date'] = $this->input->post('order_date');
                $invoice_data['due_date'] = $this->input->post('due_date');

                //pr($invoice_data);
                $id= $this->mongo_db->insert('invoices', $invoice_data);
                $msg = $this->lang->line('invoice_add_msg');
                $this->session->set_flashdata('msg', "<div class='alert alert-success text-center'>$msg</div>");
            }
            if ($this->input->post('invoice_id')) {
                $id  = $this->input->post('invoice_id');
            }

            //Insert new item limit
            $qty_hours = $this->input->post('qty_hours');
            $rate = $this->input->post('rate');
            $description = $this->input->post('description');
            $tax_rate = $this->input->post('tax_rate');
            $cost = $this->input->post('cost');
            $cost_rate = $this->input->post('cost_rate');
            $tax_sub_data = $this->input->post('tax_sub_data');
            $tax_total_val = $this->input->post('tax_total_val');


            if(count($qty_hours) > 0) {
                for ($i = 0; $i < count($qty_hours); $i++) {
                    $item_data[$i]['invoice_id'] =  new MongoId($id);
                    $item_data[$i]['qty_hours'] = $qty_hours[$i];
                    $item_data[$i]['rate'] = $rate[$i];
                    $item_data[$i]['description'] = $description[$i];
                    $item_data[$i]['tax_rate'] = $tax_rate[$i];
                    $item_data[$i]['cost'] = $cost[$i];
                    $item_data[$i]['cost_rate'] = $cost_rate[$i];
                    $item_data[$i]['tax_sub_data'] = $tax_sub_data[$i];
                    $item_data[$i]['tax_total_val'] = $tax_total_val[$i];

                }
                $this->mongo_db->batch_insert('invoice_items', $item_data);
            }

            if($this->input->post('send') == 'send'){
                $this->SendInvoice($id);
            }

            $error_msg = lang('invoice_add_msg');
            $this->session->set_flashdata('message', $error_msg);
            redirect(base_url('Invoice'));

        }
    }

    public function SendInvoice($id){

        $data['InvoicePdfreport'] = $this->mongo_db->get_where('invoices', array('_id' => new \MongoId($id)));
        //$data['invoice_items']=$this->mongo_db->get('invoice_items');
        $data['item_details'] = $this->mongo_db->get_where('invoice_items', array('invoice_id' => new \MongoId($id)));

        $user_id = $data['InvoicePdfreport'][0]['created_by'];
        $data['user_details'] = $this->mongo_db->get_where('User',array('_id' => new \MongoId($user_id)));
        $data['CompanyInformation'] = $this->mongo_db->get_where('CompanyInformation',array('user_id' => new \MongoId($user_id)));

        $PDFHtml = $this->DownloadPDF($id,'StorePDF');


    }

    public function DownloadPDF($section = NULL) {
        $id = '5829e59c085906300500002d';
        $data = [];
        //Get Estimate main records
        $data['editRecord'] = $this->mongo_db->get_where('invoices', array('_id' => new \MongoId($id)));

        $data['item_details'] = $this->mongo_db->get_where('invoice_items', array('invoice_id' => new \MongoId($id)));
        //pr($data['editRecord']);exit;
        //Client information
        $data['client_data'] = $this->mongo_db->get_where('Client', array('_id' => new \MongoId($data['editRecord'][0]['client_id'])));
        //  pr($data['client_data']);exit;
        //Get All Tax Value
        $data['allTaxesArray'] = $this->mongo_db->get('Tax');

        //Get Estimate created user name

        $user_id = $data['editRecord'][0]['created_by'];
        $data['user_details'] = $this->mongo_db->get_where('User',array('_id' => new \MongoId($user_id)));
        $data['CompanyInformation'] = $this->mongo_db->get_where('CompanyInformation',array('user_id' => new \MongoId($user_id)));

        //Get Estimate created user name
        //Get added Estimate Symbol
        $PDFCuntArray = array();
        if (!empty($data['editRecord'][0]['currency']) && isset($data['editRecord'][0]['currency']) && $data['editRecord'][0]['currency'] != "") {
            $currency_id = $data['editRecord'][0]['currency'];
            $PDFCuntArray = $this->mongo_db->get_where('country',array('_id' => new \MongoId($currency_id)));
        }
        $data['PDFCuntArray'] 			= $PDFCuntArray;
        //pr($data['PDFCuntArray']);exit;


        $data['main_content'] = '/files/invoicepdf';
        $data['section'] = $section;
        echo $html = $this->parser->parse('layouts/PDFTemplate', $data);
        exit;

        $pdfFileName = "Estimates".$data['editRecord'][0]['estimate_auto_id'].".pdf";
        $pdfFilePath = FCPATH.'uploads/estimate/';
        //Estimate Header Data Array
        $PDFBZInformation 			= array();
        $BZQueryData['fields'] 		= ['cnf.value'];
        $BZQueryData['table'] 		= CONFIG . ' as cnf';
        $BZQueryData['match_and'] 	= 'cnf.config_key="general_settings"';
        $BZCompanyInfo = $this->common_model->get_records_array($BZQueryData);
        $BZComInfoArray = array(json_decode($BZCompanyInfo[0]['value']));
        //Get Dynamic Country name as per
        if(!empty($BZComInfoArray) && isset($BZComInfoArray[0]->country_id) && $BZComInfoArray[0]->country_id != "")
        {
            $BZCntName['fields'] 		= ['conh.country_name'];
            $BZCntName['table'] 		= COUNTRIES . ' as conh';
            $BZCntName['match_and'] 	= 'conh.country_id='.$BZComInfoArray[0]->country_id;
            $BZCntName = $this->common_model->get_records_array($BZCntName);
            $PDFBZInformation['country_name'] = $BZCntName[0];
        }
        $PDFBZInformation['BZCompanyInfo'] = $BZComInfoArray;
        if($section == 'StorePDF')
        {
            $PDFHeaderHTML 	= $this->load->view('files/estpdfHeader', $PDFBZInformation, true);
            //Estimate Footer View
            $PDFFooterHTML 		= $this->load->view('files/estpdfFooter', $PDFBZInformation, true);
            //Set Header Footer and Content For PDF
            $this->m_pdf->pdf->SetHTMLHeader($PDFHeaderHTML, 'O');
            $this->m_pdf->pdf->SetHTMLFooter($PDFFooterHTML);
            $this->m_pdf->pdf->WriteHTML($html);
            //Store PDF in Estimate Folder
            //$StorePDF = $this->m_pdf->pdf->Output($pdfFilePath.$pdfFileName, 'F');
            $this->m_pdf->pdf->Output($pdfFilePath.$pdfFileName, 'F');
        } elseif ($section == 'print') {
            $html;
        } else {
            //Pass BZ information In
            $PDFHeaderHTML 	= $this->load->view('files/estpdfHeader', $PDFBZInformation, true);
            //Estimate Footer View
            $PDFFooterHTML 	= $this->load->view('files/estpdfFooter', $PDFBZInformation, true);
            //Set Header Footer and Content For PDF
            $this->m_pdf->pdf->SetHTMLHeader($PDFHeaderHTML, 'O');
            $this->m_pdf->pdf->SetHTMLFooter($PDFFooterHTML);
            $this->m_pdf->pdf->WriteHTML($html);
            //Store PDF in Estimate Folder
            $this->m_pdf->pdf->Output($pdfFileName, "D");
        }
    }



    public function Delete($id) {
        $id = new MongoId($id);
        $this->mongo_db->where(array('_id' => $id))->delete('invoices');
        $this->mongo_db->where(array('_id' => $id))->delete('invoice_items');

        $error_msg = SUCCESS_START_DIV_NEW . lang('account_del_msg') . SUCCESS_END_DIV;
        $this->session->set_flashdata('message', $error_msg);
        redirect(site_url('Client'));
    }

    public function PaymentSuccess() {
		//echo "<h1> Payment Successsfull </h1>";
		 $data['footerJs'][0] = base_url('uploads/assets/plugins/parsleyjs/dist/parsley.min.js');
        $data['footerJs'][1] = base_url('uploads/assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js');
        $data['footerJs'][2] = base_url('uploads/assets/plugins/bootstrap-daterangepicker/daterangepicker.js');
        $data['footerJs'][3] = base_url('uploads/assets/plugins/multiselect/js/jquery.multi-select.js');
        $data['footerJs'][4] = base_url('uploads/assets/plugins/jquery-quicksearch/jquery.quicksearch.js');
        $data['footerJs'][5] = base_url('uploads/assets/plugins/select2/dist/js/select2.min.js');
        $data['footerJs'][6] = base_url('uploads/custom/invoice/invoice.js');
        $data['footerJs'][7] = base_url('uploads/custom/InvoicePay/invoicepay.js');

        $data['headerCss'][0] = base_url('uploads/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css');
        $data['headerCss'][1] = base_url('uploads/assets/plugins/bootstrap-daterangepicker/daterangepicker.css');
        $data['headerCss'][2] = base_url('uploads/assets/plugins/multiselect/css/multi-select.css');
        $data['headerCss'][3] = base_url('uploads/assets/plugins/select2/dist/css/select2.css');
        $data['headerCss'][4] = base_url('uploads/assets/plugins/select2/dist/css/select2-bootstrap.css');
        $data['headerCss'][5] = base_url('uploads/custom/InvoicePay/invoicepay.css');
		
		$data['main_content'] = '/PaymentSuccess';
		$this->parser->parse('layouts/InvoicePayTempalate', $data);
	}
	
	public function PaymentSuccessIdeal($ideal_uniquecode) {
		
		//echo "<h1> Payment Successsfull </h1>";
		$data['footerJs'][0] = base_url('uploads/assets/plugins/parsleyjs/dist/parsley.min.js');
        $data['footerJs'][1] = base_url('uploads/assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js');
        $data['footerJs'][2] = base_url('uploads/assets/plugins/bootstrap-daterangepicker/daterangepicker.js');
        $data['footerJs'][3] = base_url('uploads/assets/plugins/multiselect/js/jquery.multi-select.js');
        $data['footerJs'][4] = base_url('uploads/assets/plugins/jquery-quicksearch/jquery.quicksearch.js');
        $data['footerJs'][5] = base_url('uploads/assets/plugins/select2/dist/js/select2.min.js');
        $data['footerJs'][6] = base_url('uploads/custom/invoice/invoice.js');
        $data['footerJs'][7] = base_url('uploads/custom/InvoicePay/invoicepay.js');

        $data['headerCss'][0] = base_url('uploads/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css');
        $data['headerCss'][1] = base_url('uploads/assets/plugins/bootstrap-daterangepicker/daterangepicker.css');
        $data['headerCss'][2] = base_url('uploads/assets/plugins/multiselect/css/multi-select.css');
        $data['headerCss'][3] = base_url('uploads/assets/plugins/select2/dist/css/select2.css');
        $data['headerCss'][4] = base_url('uploads/assets/plugins/select2/dist/css/select2-bootstrap.css');
        $data['headerCss'][5] = base_url('uploads/custom/InvoicePay/invoicepay.css');
		
		$invtest = $this->mongo_db->get_where('InvoicePaid',array('ideal_uniquecode' => $ideal_uniquecode));
		$ideal_payment_id = $invtest[0]['payment_id']; 
		$invoice_id = $invtest[0]['invoice_id']; 
		
		$payment22 = $this->paymentStatusCheck($ideal_payment_id);
		
		$status = $payment22->status;
		
		if($status == 'paid'){
			$data['pay_st'] = "paid";
			
			$datatoinvoicecollection = array(
				'ideal_status' => 'paid'
			);
			
			$success_update =  $this->mongo_db->where('payment_id', $ideal_payment_id)->set($datatoinvoicecollection)->update('InvoicePaid'); 
			
			if($success_update){
				$invoice_paid = $this->mongo_db->get_where('InvoicePaid',array('invoice_id' => new \MongoId($invoice_id)));
				$invoice_details = $this->mongo_db->get_where('invoices',array('_id' => new \MongoId($invoice_id)));
				$total_payment = $invoice_details[0]['total_payment'];
				$tot = 0;
				foreach($invoice_paid as $inv){
					$tot = $tot + $inv['paid_amount'];
				}
				/* echo "<br>tot: ";
				print_R($tot); */
				if($tot >= $total_payment){
					$datatoinvoicecollection1 = array(
						'payment_status' => 'full'
					);
				}
				else{
					$datatoinvoicecollection1 = array(
						'payment_status' => 'partial'
					);
				}
				$this->mongo_db->where('_id', new MongoId($invoice_id))->set($datatoinvoicecollection1)->update('invoices'); 
			}
		}
		else{
			$success_update =  $this->mongo_db->where(array('payment_id' => $ideal_payment_id))->delete('InvoicePaid');
			$data['pay_st'] = "canceled";
		}
		$data['main_content'] = '/PaymentSuccessIdeal';
		$this->parser->parse('layouts/InvoicePayTempalate', $data);
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

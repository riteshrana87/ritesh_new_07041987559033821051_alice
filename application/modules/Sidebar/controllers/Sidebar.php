<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Sidebar extends CI_Controller {

    function __construct() {
       // parent::__construct();
		$this->CI = & get_instance(); 
		$this->CI->load->library('upload');
        $this->CI->load->library('mongo_db', array('activate' => 'default'), 'mongo_db');
		//$this->load->library('mongo_db', array('activate' => 'default'), 'mongo_db');
    }

    /*
      Author : Ritesh Rana
      Desc   : Call Head area
      Input  : Bunch of Array
      Output : All CSS and JS
      Date   : 01/10/2016
     */

    public function head($param = NULL) {
		$data['param'] = $param;           //Default Parameter 
        $data['cur_viewname'] = $this->CI->router->fetch_class();     //Current View 
        
        $this->CI->load->view('Sidebar/head', $data);
    }

    /*
      Author : Ritesh Rana
      Desc   : Call Header For all the template
      Input  : Bunch of Array
      Output : Top Side Header(Logo, Menu, Language)
      Date   : 01/10/2016
     */

    public function header($param = NULL) {
		$data['view']=$this->CI->router->fetch_class();
		//$data['footerJs'][0] = base_url('uploads/custom/head/head.js');
		$data['invoice'] = $this->CI->mongo_db->limit(10)->get('invoices');
		$date_today=strtotime(date('m/d/Y'));
                $currency = $this->CI->mongo_db->get('CompanyInformation');
                //print_r($data); die;
		//echo $date_today;
                $i = 0;
		$notification_Arr=array();
		foreach($data['invoice'] as $invoice){
			$comparedate=strtotime($invoice['created_date']);
				if($comparedate <= $date_today){
					
					//1)paid status 
					if(!empty($invoice['payment_status']) && $invoice['payment_status']=='full')
					{
						echo $invoice['_id']."Invoice is paid";
						$notification_Arr[$i]['invoice'] = $invoice;
                                                $notification_Arr[$i]['status'] = 'Invoice is paid';
						}
					//2) overdue date
					if($date_today > $invoice['due_date']){
							
						if(empty($invoice['payment_status']) || $invoice['payment_status']=='partial'){
							
								echo $invoice['_id']."Invoice is Overdue";
							$notification_Arr[$i]['invoice'] = $invoice;
                                                        $notification_Arr[$i]['status'] = 'Invoice is Overdue';
							}
								
								
						}
					//3)outstanding date	
					if($date_today < $invoice['due_date']){
							
						if(empty($invoice['payment_status']) || $invoice['payment_status']=='partial'){
							
								echo $invoice['_id']."Invoice is Outstanding";
                                                                $notification_Arr[$i]['invoice'] = $invoice;
                                                                $notification_Arr[$i]['status'] = 'Invoice is Outstanding';
							}
								
								
						}
                                                $net_payment_paid =0;
                                                 $invoices_paid = $this->CI->mongo_db->get_where('InvoicePaid', array('invoice_id' => new \MongoId($invoice['_id']->{'$id'})));
						//print_r($invoice);die;
                                                 foreach($invoices_paid as $paid_invoice){
                                                    if(isset($paid_invoice['paid_amount'])){
                                                        //if($invoice['invoice_type'] != 1)
                                                         $net_payment_paid += $paid_invoice['paid_amount'];
                                                       // else
                                                       //      $net_payment_paid -= $paid_invoice['paid_amount'];
                                                    }
                                                    }
                                                     $notification_Arr[$i]['net_payment_paid'] = $net_payment_paid;
                                                     $notification_Arr[$i]['currency'] = $currency[0]['company_currency'];
                                                     $notification_Arr[$i]['net_due'] = $invoice['total_payment'] - $net_payment_paid;
					}
				$i++;
			}
		
		/*pr($notification_Arr);
		die();*/
		$data['notification_Arr'] = $notification_Arr;
		
		$this->CI->load->view('Sidebar/header',$data);
    }

    /*
      Author : Ritesh Rana
      Desc   : Call Footer
      Input  : Bunch of Array
      Output : Top Side Header(Logo, Menu, Language)
      Date   : 01/10/2016
     */

    public function footer($param = NULL) {
        $data['param'] = $param;           //Default Parameter 
        $data['cur_viewname'] = $this->CI->router->fetch_class();     //Current View 
        $this->CI->load->view('Sidebar/footer', $data);
    }

    /*
      Author : Ritesh Rana
      Desc   : Call Left Menu area
      Input  : Bunch of array
      Output : Unset Error Session
      Date   : 01/10/2016
     */

    public function leftmenu($param = NULL) {
        $data['param'] = $param;           //Default Parameter
        $data['cur_viewname'] = $this->CI->router->fetch_class();
        
		$id = $this->CI->session->userdata['alice_session']['_id'];
		
		$data['user_details'] = $this->CI->mongo_db->get_where('User',array('_id' => new \MongoId($id)));
		
        $data['cur_viewname'] = $this->CI->router->fetch_class();     //Current View 
		$data['sub_domain']=array_shift((explode(".",$_SERVER['HTTP_HOST'])));
				  
        $this->CI->load->view('Sidebar/leftmenu', $data);
    }

   
  
}

<?php
/*
@Author : Ritesh rana
@Desc   : Dashboard
@Date   : 01/10/2016
*/
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Public_controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library('upload');
        $this->load->library('mongo_db', array('activate' => 'default'), 'mongo_db');
        $this->module = $this->router->fetch_class();
        $this->viewname = $this->router->fetch_class();
    }
    /*
@Author : Ritesh rana
@Desc   : Dashboard Model Index Page
@Input 	:
@Output	:
@Date   : 01/10/2016
*/

    public function index()
    {
		/*pr($_COOKIE);
		die('here');*/
		/*pr($this->input->cookie('remember_me_email', TRUE));
							die('here');*/
							/*pr($this->session);
							die();*/
			$data['footerJs'][0] = base_url('uploads/assets/js/jquery.min.js');
			$data['footerJs'][1] = base_url('uploads/assets/js/bootstrap.min.js');
			$data['footerJs'][2] = base_url('uploads/assets/js/detect.js');
			$data['footerJs'][3] = base_url('uploads/assets/js/fastclick.js');
			$data['footerJs'][4] = base_url('uploads/assets/js/jquery.slimscroll.js');
			$data['footerJs'][5] = base_url('uploads/assets/js/jquery.blockUI.js');
			$data['footerJs'][6] = base_url('uploads/assets/js/waves.js');
			$data['footerJs'][7] = base_url('uploads/assets/js/jquery.nicescroll.js');
			$data['footerJs'][8] = base_url('uploads/assets/js/jquery.scrollTo.min.js');
			
		
			$data['footerJs'][9] = base_url('uploads/assets/plugins/morris/morris.min.js');
			$data['footerJs'][10] = base_url('uploads/assets/plugins/raphael/raphael-min.js');
			$data['footerJs'][11] = base_url('uploads/assets/plugins/chartist/dist/chartist.min.js');
			$data['footerJs'][12] = base_url('uploads/assets/plugins/chartist/dist/chartist-plugin-tooltip.min.js');
			//$data['footerJs'][12] = base_url('uploads/assets/pages/jquery.morris.init.js');
			//$data['footerJs'][11] = base_url('uploads/assets/pages/jquery.chartist.init.js');
			$data['footerJs'][13] = base_url('uploads/custom/Dashboard/chartinator.js');
			$data['footerJs'][14] = base_url('uploads/custom/Dashboard/Dashboard.js');
			
			$data['footerJs'][15] = base_url('uploads/assets/js/jquery.core.js');
			$data['footerJs'][16] = base_url('uploads/assets/js/jquery.app.js');
			
        $data['headerCss'][0] = base_url('uploads/assets/plugins/morris/morris.css');
        $data['headerCss'][0] = base_url('uploads/assets/plugins/chartist/dist/chartist.min.css');
        $data['headerCss'][1] = base_url('uploads/assets/css/bootstrap.min.css');
        $data['headerCss'][2] = base_url('uploads/assets/css/core.css');
        $data['headerCss'][3] = base_url('uploads/assets/css/components.css');
        $data['headerCss'][4] = base_url('uploads/assets/css/icons.css');
        $data['headerCss'][5] = base_url('uploads/assets/css/pages.css');
        $data['headerCss'][6] = base_url('uploads/assets/css/menu.css');
        $data['headerCss'][7] = base_url('uploads/assets/css/responsive.css');

        $data['headerCss'][8] = base_url('uploads/custom/Developer.css');
        $data['headerCss'][9] = base_url('uploads/custom/alice.css');

		
		//$data['activities'] = $this->mongo_db->get('Activities')->limit('5');
		$data['companyinformation']=$this->mongo_db->get('CompanyInformation');
		$data['activities_data'] = $this->mongo_db->where(array('user_id' => new \MongoId($this->session->userdata('alice_session')['_id'])))->limit(5)->get('Activities');
		
			/* To get total profit*/
			$data['total_profit'] = $this->mongo_db->get('InvoicePaid');
			$profit = 0;
			foreach($data['total_profit'] as $profit_total){
				$profit = $profit + $profit_total['paid_amount'];
			}
			$data['profit'] = $profit;
			
			/* To get total spending*/
			$data['total_spending'] = $this->mongo_db->get('expense_master');
			$spending = 0;
			foreach($data['total_spending'] as $spending_total){
				$spending = $spending + $spending_total['total'];
			}
			$data['spending'] = $spending;
			
			
			/* Get year & month wise profit*/
			
				$dd = array();
				foreach($data['total_profit'] as $payment){
					$thismonth_profit = 0;
					$payment_date = $payment['payment_date'];
					$year =  date('Y', strtotime($payment_date));
					$month =  date('m', strtotime($payment_date));
					if(date('Y') == $year){
						for($i=1;$i<=12;$i++){
							if($month == $i){
								$thismonth_profit = $payment['paid_amount'];
								$gg = array($i=>$thismonth_profit);
								array_push($dd,$gg); 
							}
						}
					}
				}
				$sumArray = array();

				foreach ($dd as $k=>$subArray) {
				  foreach ($subArray as $id=>$value) {
					$sumArray[$id]+=$value;
				  }
				}

				if(!empty($sumArray['12'])){
					$data['dec'] = $sumArray['12'];
				}
				else{
					$data['dec'] = 0;
				}
				if(!empty($sumArray['11'])){
					$data['nov'] = $sumArray['11'];
				}
				else{
					$data['nov'] = 0;
				}
				if(!empty($sumArray['10'])){
					$data['oct'] = $sumArray['10'];
				}
				else{
					$data['oct'] = 0;
				}
				if(!empty($sumArray['9'])){
					$data['sept'] = $sumArray['9'];
				}
				else{
					$data['sept'] = 0;
				}
				if(!empty($sumArray['8'])){
					$data['aug'] = $sumArray['8'];
				}
				else{
					$data['aug'] = 0;
				}
				if(!empty($sumArray['7'])){
					$data['jul'] = $sumArray['7'];
				}
				else{
					$data['jul'] = 0;
				}
				if(!empty($sumArray['6'])){
					$data['jun'] = $sumArray['6'];
				}
				else{
					$data['jun'] = 0;
				}
				if(!empty($sumArray['5'])){
					$data['may'] = $sumArray['5'];
				}
				else{
					$data['may'] = 0;
				}
				if(!empty($sumArray['4'])){
					$data['apr'] = $sumArray['4'];
				}
				else{
					$data['apr'] = 0;
				}
				if(!empty($sumArray['3'])){
					$data['mar'] = $sumArray['3'];
				}
				else{
					$data['mar'] = 0;
				}
				if(!empty($sumArray['2'])){
					$data['feb'] = $sumArray['2'];
				}
				else{
					$data['feb'] = 0;
				}
				if(!empty($sumArray['1'])){
					$data['jan'] = $sumArray['1'];
				}
				else{
					$data['jan'] = 0;
				}
				
				$data['year'] = $year;
			/* Get year & month wise profit OVER */
			
			
			/* Get year & month wise Spending*/
			$dd_spending = array();
				foreach($data['total_spending'] as $spending){
					$thismonth_spending = 0;
					$spending_date = $spending['created_at'];
					$year_spending =  date('Y', strtotime($spending_date));
					$month_spending =  date('m', strtotime($spending_date));
					if(date('Y') == $year_spending){
						for($i=1;$i<=12;$i++){
							if($month_spending == $i){
								$thismonth_spending = $spending['total'];
								$gg = array($i=>$thismonth_spending);
								array_push($dd_spending,$gg); 
							}
						}
					}
				}
				$sumArray_spending = array();

				foreach ($dd_spending as $k=>$subArray) {
				  foreach ($subArray as $id=>$value) {
					$sumArray_spending[$id]+=$value;
				  }
				}

				if(!empty($sumArray_spending['12'])){
					$data['dec_spending'] = $sumArray_spending['12'];
				}
				else{
					$data['dec_spending'] = 0;
				}
				if(!empty($sumArray_spending['11'])){
					$data['nov_spending'] = $sumArray_spending['11'];
				}
				else{
					$data['nov_spending'] = 0;
				}
				if(!empty($sumArray_spending['10'])){
					$data['oct_spending'] = $sumArray_spending['10'];
				}
				else{
					$data['oct_spending'] = 0;
				}
				if(!empty($sumArray_spending['9'])){
					$data['sept_spending'] = $sumArray_spending['9'];
				}
				else{
					$data['sept_spending'] = 0;
				}
				if(!empty($sumArray_spending['8'])){
					$data['aug_spending'] = $sumArray_spending['8'];
				}
				else{
					$data['aug_spending'] = 0;
				}
				if(!empty($sumArray_spending['7'])){
					$data['jul_spending'] = $sumArray_spending['7'];
				}
				else{
					$data['jul_spending'] = 0;
				}
				if(!empty($sumArray_spending['6'])){
					$data['jun_spending'] = $sumArray_spending['6'];
				}
				else{
					$data['jun_spending'] = 0;
				}
				if(!empty($sumArray_spending['5'])){
					$data['may_spending'] = $sumArray_spending['5'];
				}
				else{
					$data['may_spending'] = 0;
				}
				if(!empty($sumArray_spending['4'])){
					$data['apr_spending'] = $sumArray_spending['4'];
				}
				else{
					$data['apr_spending'] = 0;
				}
				if(!empty($sumArray_spending['3'])){
					$data['mar_spending'] = $sumArray_spending['3'];
				}
				else{
					$data['mar_spending'] = 0;
				}
				if(!empty($sumArray_spending['2'])){
					$data['feb_spending'] = $sumArray_spending['2'];
				}
				else{
					$data['feb_spending'] = 0;
				}
				if(!empty($sumArray_spending['1'])){
					$data['jan_spending'] = $sumArray_spending['1'];
				}
				else{
					$data['jan_spending'] = 0;
				}
			/* Get year & month wise Spending Over*/
			
			
			/* Work for Spending by category */
			/* $data['category_master'] = $this->mongo_db->get('category_master');
			$expense_category = $data['category_master']; */
			
			$data['category_master'] = $this->mongo_db->get('ExpenseCategory');
			$expense_category = $data['category_master'];
			$tt = array();
			
			//print_r($expense_category);
			
			foreach($expense_category as $ex_cat){
				$individual_expense = $this->mongo_db->where(array('category' => new \MongoId($ex_cat['_id'])))->limit(8)->get('expense_master');
				$total_per_cat = 0;
				
				foreach($individual_expense as $ie){
					$total_per_cat = $total_per_cat + $ie['total']; 
				}
				
				$gg = array($ex_cat['CategoryName']=>$total_per_cat);
				array_push($tt,$gg); 
			}
			
				/* echo "<br>3:";
			print_r($tt);
			die(); */  
			 $sumArray_categories = array();

				foreach ($tt as $k=>$subArray) {
				  foreach ($subArray as $id=>$value) {
					$sumArray_categories[$id]+=$value;
				  }
				} 
			$data['categories_spend'] = json_encode($sumArray_categories);
			$data['categories_spend_try'] = $sumArray_categories;
			
			/* print_r($data['categories_spend_try']);
			
			die();  */
			//$data['total_spending']
			
			/* Work for Spending by category Ends*/
			
			
			/* Outstanding revenue dishit */
			//echo "<pre>";
	//print_r($invoicepaid);
	//echo "</pre>";
	$invoices = $this->mongo_db->get('invoices');
	$invoicepaid = $this->mongo_db->get('InvoicePaid');
	
	
	$today_date = strtotime(date('F d, Y'));
	
	$overdue_total_amount = 0;
	$outstanding_total_amount = 0;
	$draft_total_amount = 0;
	
	$tome_overdue_total_amount = 0;
	$tome_outstanding_total_amount = 0;
	
	$total_paid1 = 0;
	$total_paid = 0;
	
	foreach($invoices as $invoice){
		
		$rt =strtotime($invoice['due_date']);
		
		if($today_date > $rt && $invoice['save_type'] != 'save' ){
			if(empty($invoice['payment_status'])  || $invoice['payment_status'] == 'partial'){
				foreach($invoicepaid as $ip){
					if($ip['invoice_id'] == $invoice['_id']){
						$total_paid = $total_paid + $ip['paid_amount'];
					}
					else{
						$total_paid = $total_paid + 0;
					}
				}	
				$overdue_total_amount = $overdue_total_amount + ( $invoice['total_payment'] - $total_paid );
				
			}
		}
		else if($today_date <= $rt && $invoice['save_type'] != 'save'){
			if(empty($invoice['payment_status'])  || $invoice['payment_status'] == 'partial'){
				foreach($invoicepaid as $ip1){
					if($ip1['invoice_id'] == $invoice['_id']){
						$total_paid1 = $total_paid1 + $ip1['paid_amount'];
					}
					else{
						$total_paid1 = $total_paid1 + 0;
					}
				}	
				$outstanding_total_amount = $outstanding_total_amount + ($invoice['total_payment'] - $total_paid1 );
			}
		}
		
		if($invoice['save_type'] == 'save'){
			$draft_total_amount = $draft_total_amount + $invoice['total_payment'] ;
		}
	}
			
			
			$data['overdue_total_amount'] = $overdue_total_amount;
			$data['outstanding_total_amount'] = $outstanding_total_amount;
			$data['draft_total_amount'] = $draft_total_amount;
			
			/* Outstanding revenue dishit Over*/
			
            $data['main_content'] = '/'.$this->viewname;
            $this->parser->parse('layouts/PageTemplate', $data);
        
    }
	
	
	public function GetProfitByYear(){
		$data['total_profit'] = $this->mongo_db->get('InvoicePaid');
		$selected_year = $this->input->post('selected_year');
		
		/* Get year & month wise profit*/
			
				$dd = array();
				foreach($data['total_profit'] as $payment){
					$thismonth_profit = 0;
					$payment_date = $payment['payment_date'];
					$year =  date('Y', strtotime($payment_date));
					$month =  date('m', strtotime($payment_date));
					if($selected_year == $year){
						for($i=1;$i<=12;$i++){
							if($month == $i){
								$thismonth_profit = $payment['paid_amount'];
								$gg = array($i=>$thismonth_profit);
								array_push($dd,$gg); 
							}
						}
					}
				}
				
				//die('sds');
				$sumArray = array();

				foreach ($dd as $k=>$subArray) {
				  foreach ($subArray as $id=>$value) {
					$sumArray[$id]+=$value;
				  }
				}

				if(!empty($sumArray['12'])){
					$data['dec'] = $sumArray['12'];
				}
				else{
					$data['dec'] = 0;
				}
				if(!empty($sumArray['11'])){
					$data['nov'] = $sumArray['11'];
				}
				else{
					$data['nov'] = 0;
				}
				if(!empty($sumArray['10'])){
					$data['oct'] = $sumArray['10'];
				}
				else{
					$data['oct'] = 0;
				}
				if(!empty($sumArray['9'])){
					$data['sept'] = $sumArray['9'];
				}
				else{
					$data['sept'] = 0;
				}
				if(!empty($sumArray['8'])){
					$data['aug'] = $sumArray['8'];
				}
				else{
					$data['aug'] = 0;
				}
				if(!empty($sumArray['7'])){
					$data['jul'] = $sumArray['7'];
				}
				else{
					$data['jul'] = 0;
				}
				if(!empty($sumArray['6'])){
					$data['jun'] = $sumArray['6'];
				}
				else{
					$data['jun'] = 0;
				}
				if(!empty($sumArray['5'])){
					$data['may'] = $sumArray['5'];
				}
				else{
					$data['may'] = 0;
				}
				if(!empty($sumArray['4'])){
					$data['apr'] = $sumArray['4'];
				}
				else{
					$data['apr'] = 0;
				}
				if(!empty($sumArray['3'])){
					$data['mar'] = $sumArray['3'];
				}
				else{
					$data['mar'] = 0;
				}
				if(!empty($sumArray['2'])){
					$data['feb'] = $sumArray['2'];
				}
				else{
					$data['feb'] = 0;
				}
				if(!empty($sumArray['1'])){
					$data['jan'] = $sumArray['1'];
				}
				else{
					$data['jan'] = 0;
				}
				
				//$data['year'] = $year;
				$result = array('status'=>true,'res'=>$data);
				echo json_encode($result);
				
			/* Get year & month wise profit OVER */
	}
	
	
	
	public function GetSpendingByYear(){
		$data['total_spending'] = $this->mongo_db->get('expense_master');
		$selected_year = $this->input->post('selected_year');
		
		/* Get year & month wise profit*/
			
				$dd_spending = array();
				foreach($data['total_spending'] as $spending){
					$thismonth_spending = 0;
					$spending_date = $spending['created_at'];
					$year_spending =  date('Y', strtotime($spending_date));
					$month_spending =  date('m', strtotime($spending_date));
					if($selected_year == $year_spending){
						for($i=1;$i<=12;$i++){
							if($month_spending == $i){
								$thismonth_spending = $spending['total'];
								$gg = array($i=>$thismonth_spending);
								array_push($dd_spending,$gg); 
							}
						}
					}
				}
				$sumArray_spending = array();

				foreach ($dd_spending as $k=>$subArray) {
				  foreach ($subArray as $id=>$value) {
					$sumArray_spending[$id]+=$value;
				  }
				}

				if(!empty($sumArray_spending['12'])){
					$data['dec_spending'] = $sumArray_spending['12'];
				}
				else{
					$data['dec_spending'] = 0;
				}
				if(!empty($sumArray_spending['11'])){
					$data['nov_spending'] = $sumArray_spending['11'];
				}
				else{
					$data['nov_spending'] = 0;
				}
				if(!empty($sumArray_spending['10'])){
					$data['oct_spending'] = $sumArray_spending['10'];
				}
				else{
					$data['oct_spending'] = 0;
				}
				if(!empty($sumArray_spending['9'])){
					$data['sept_spending'] = $sumArray_spending['9'];
				}
				else{
					$data['sept_spending'] = 0;
				}
				if(!empty($sumArray_spending['8'])){
					$data['aug_spending'] = $sumArray_spending['8'];
				}
				else{
					$data['aug_spending'] = 0;
				}
				if(!empty($sumArray_spending['7'])){
					$data['jul_spending'] = $sumArray_spending['7'];
				}
				else{
					$data['jul_spending'] = 0;
				}
				if(!empty($sumArray_spending['6'])){
					$data['jun_spending'] = $sumArray_spending['6'];
				}
				else{
					$data['jun_spending'] = 0;
				}
				if(!empty($sumArray_spending['5'])){
					$data['may_spending'] = $sumArray_spending['5'];
				}
				else{
					$data['may_spending'] = 0;
				}
				if(!empty($sumArray_spending['4'])){
					$data['apr_spending'] = $sumArray_spending['4'];
				}
				else{
					$data['apr_spending'] = 0;
				}
				if(!empty($sumArray_spending['3'])){
					$data['mar_spending'] = $sumArray_spending['3'];
				}
				else{
					$data['mar_spending'] = 0;
				}
				if(!empty($sumArray_spending['2'])){
					$data['feb_spending'] = $sumArray_spending['2'];
				}
				else{
					$data['feb_spending'] = 0;
				}
				if(!empty($sumArray_spending['1'])){
					$data['jan_spending'] = $sumArray_spending['1'];
				}
				else{
					$data['jan_spending'] = 0;
				}
				
				//$data['year'] = $year;
				$result = array('status'=>true,'res'=>$data);
				echo json_encode($result);
				
			/* Get year & month wise profit OVER */
	}
	
	public function getcat_trial(){
		
			/* Work for Spending by category */
			$data['category_master'] = $this->mongo_db->get('category_master');
			$expense_category = $data['category_master'];
			$tt = array();
			foreach($expense_category as $ex_cat){
				$individual_expense = $this->mongo_db->where(array('category' => new \MongoId($ex_cat['_id'])))->get('expense_master');
				$total_per_cat = 0;
				foreach($individual_expense as $ie){
					$total_per_cat = $total_per_cat + $ie['total']; 
				}
				
				$gg = array($ex_cat['categoryname']=>$total_per_cat);
				array_push($tt,$gg); 
			}
			 $sumArray_categories = array();

				foreach ($tt as $k=>$subArray) {
				  foreach ($subArray as $id=>$value) {
					$sumArray_categories[$id]+=$value;
				  }
				} 
			$data['categories_spend'] = json_encode($sumArray_categories);
			
			
			$result = array('status'=>true,'res'=>$data);
			echo json_encode($sumArray_categories);
				
			//die();
			//$data['total_spending']
			
			/* Work for Spending by category Ends*/
	}
	

}


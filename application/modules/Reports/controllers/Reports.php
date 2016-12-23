<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends Public_controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('upload');
        $this->load->library('mongo_db', array('activate' => 'default'), 'mongo_db');
        $this->module = $this->router->fetch_class();
        $this->viewname = $this->router->fetch_class();
    }

    public function index() {
        $data['main_content'] = '/index';
        $data['pageTitle'] = lang('reports');

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
        $i=0;
        foreach($data['expenses'] as $expense)
        {           
            $categories = $this->mongo_db->get_where('category_master', array('_id' => new \MongoId($expense['category'])));
            $data['expenses'][$i]['category_name'] = $categories[0]['categoryname'];
            $i++;
        }
       
        //$this->mongo_db->explain();
        //  $data['clients']=$this->mongo_db->get('Client');
        $data['footerJs'][0] = base_url('uploads/assets/plugins/bootstrap-sweetalert/sweet-alert.min.js');
        $data['footerJs'][1] = base_url('uploads/assets/pages/jquery.sweet-alert.init.js');
        $data['footerJs'][2] = base_url('uploads/assets/plugins/datatables/jquery.dataTables.min.js');
        $data['footerJs'][3] = base_url('uploads/assets/plugins/datatables/dataTables.responsive.min.js');
        
         $data['footerJs'][4] = base_url('uploads/assets/plugins/datatables/dataTables.buttons.min.js');
         $data['footerJs'][5] = base_url('uploads/assets/plugins/datatables/buttons.bootstrap.min.js');
         $data['footerJs'][6] = base_url('uploads/assets/plugins/datatables/pdfmake.min.js');
         $data['footerJs'][7] = base_url('uploads/assets/plugins/datatables/vfs_fonts.js');
         $data['footerJs'][8] = base_url('uploads/assets/plugins/datatables/buttons.html5.min.js');
         $data['footerJs'][9] = base_url('uploads/assets/plugins/datatables/buttons.print.min.js');
         $data['footerJs'][10] = base_url('uploads/custom/reports/reports.js');
        $data['headerCss'][0] = base_url('uploads/assets/plugins/bootstrap-sweetalert/sweet-alert.css');
        $data['headerCss'][1] = base_url('uploads/assets/plugins/datatables/jquery.dataTables.min.css');
        $data['headerCss'][2] = base_url('uploads/custom/Developer.css');
        $data['headerCss'][3] = base_url('uploads/assets/plugins/datatables/buttons.bootstrap.min.css');
         $data['headerCss'][4] = 'https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css';
        $data['url'] = $url;

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

      public function Expense_report() {
        $data['main_content'] = '/expense_report';
        $data['pageTitle'] = lang('expense_report');

        //$parameters['total_rows']=
        //Pagination Sample code
        $data['comp_info'] = $this->mongo_db->get('CompanyInformation');
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
        $i=0;
        foreach($data['expenses'] as $expense)
        {           
            $categories = $this->mongo_db->get_where('category_master', array('_id' => new \MongoId($expense['category'])));
            $data['expenses'][$i]['category_name'] = $categories[0]['categoryname'];
            $i++;
        }
       
        //$this->mongo_db->explain();
        //  $data['clients']=$this->mongo_db->get('Client');
        $data['footerJs'][0] = base_url('uploads/assets/plugins/bootstrap-sweetalert/sweet-alert.min.js');
        $data['footerJs'][1] = base_url('uploads/assets/pages/jquery.sweet-alert.init.js');
        $data['footerJs'][2] = base_url('uploads/assets/plugins/datatables/jquery.dataTables.min.js');
        $data['footerJs'][3] = base_url('uploads/assets/plugins/datatables/dataTables.responsive.min.js');
        
         $data['footerJs'][4] = base_url('uploads/assets/plugins/datatables/dataTables.buttons.min.js');
         $data['footerJs'][5] = base_url('uploads/assets/plugins/datatables/buttons.bootstrap.min.js');
         $data['footerJs'][6] = base_url('uploads/assets/plugins/datatables/pdfmake.min.js');
         $data['footerJs'][7] = base_url('uploads/assets/plugins/datatables/vfs_fonts.js');
         $data['footerJs'][8] = base_url('uploads/assets/plugins/datatables/buttons.html5.min.js');
         $data['footerJs'][9] = base_url('uploads/assets/plugins/datatables/buttons.print.min.js');
         $data['footerJs'][10] = base_url('uploads/custom/reports/reports.js');
        $data['headerCss'][0] = base_url('uploads/assets/plugins/bootstrap-sweetalert/sweet-alert.css');
        $data['headerCss'][1] = base_url('uploads/assets/plugins/datatables/jquery.dataTables.min.css');
        $data['headerCss'][2] = base_url('uploads/custom/Developer.css');
        $data['headerCss'][3] = base_url('uploads/assets/plugins/datatables/buttons.bootstrap.min.css');
         $data['headerCss'][4] = 'https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css';
        $data['url'] = $url;

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



    public function Ledger() {
        $data['pageTitle'] = lang('ledger');
        $data['main_content'] = '/Ledger';
        $data['categories'] = $this->mongo_db->get_where('category_master', array('is_deleted' => 0));
        $data['tax'] = $this->mongo_db->get_where('Tax', array('is_deleted' => 0));
        $data['comp_info'] = $this->mongo_db->get('CompanyInformation');
        $data['footerJs'][0] = base_url('uploads/assets/plugins/switchery/switchery.min.js');
        $data['footerJs'][1] = base_url('uploads/assets/plugins/select2/dist/js/select2.min.js');
        $data['footerJs'][2] = base_url('uploads/assets/plugins/tinymce/tinymce.min.js');
        //$data['footerJs'][4] = base_url('uploads/custom/expense/expense.js');
        $data['footerJs'][3] = base_url('uploads/assets/plugins/bootstrap-sweetalert/sweet-alert.min.js');
        $data['footerJs'][5] = base_url('uploads/assets/pages/jquery.sweet-alert.init.js');
        $data['footerJs'][6] = base_url('uploads/assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js');
        $data['footerJs'][7] = base_url('uploads/assets/plugins/parsleyjs/dist/parsley.min.js');
        $data['footerJs'][8] = base_url('uploads/assets/plugins/datatables/dataTables.buttons.min.js');
        $data['footerJs'][9] = base_url('uploads/assets/plugins/datatables/buttons.bootstrap.min.js');
        $data['footerJs'][10] = base_url('uploads/assets/plugins/datatables/pdfmake.min.js');
        $data['footerJs'][11] = base_url('uploads/assets/plugins/datatables/vfs_fonts.js');
        $data['footerJs'][12] = base_url('uploads/assets/plugins/datatables/buttons.html5.min.js');
        $data['footerJs'][13] = base_url('uploads/assets/plugins/datatables/buttons.print.min.js');
        $data['footerJs'][14] = base_url('uploads/custom/reports/reports.js');
        $data['i'] = 0;
        $data['tax_inc'] = 0;
        $data['tax'] = $this->mongo_db->get('Tax');
        $data['clients'] = $this->mongo_db->get('Client');
        $data['$categories'] = $this->mongo_db->get('category_master');
        $data['vendors'] = $this->mongo_db->distinct('expense_master','vendorname');
        $data['journal_accounts'] = $this->mongo_db->get('JournalAccount');
        $data['payment_with'] = $this->mongo_db->distinct('InvoicePaid','payment_with');
        $data['headerCss'][0] = base_url('uploads/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css');
        $data['headerCss'][1] = base_url('uploads/assets/plugins/select2/dist/css/select2.css');
        $data['headerCss'][2] = base_url('uploads/assets/plugins/select2/dist/css/select2-bootstrap.css');
        $data['headerCss'][3] = base_url('uploads/assets/plugins/bootstrap-sweetalert/sweet-alert.css');
        $data['headerCss'][4] = base_url('uploads/assets/plugins/switchery/switchery.min.css');
        $data['headerCss'][5] = "//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css";
         $data['headerCss'][6] = base_url('uploads/assets/plugins/datatables/buttons.bootstrap.min.css');
         $data['headerCss'][7] = 'https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css';        

        $this->parser->parse('layouts/PageTemplate', $data);
    }
    
    public function Get_ledger_data()
    {
        $data = $this->input->post('data');
        $type = $this->input->post('type');
        
        $date_start = $this->input->post('start_limit');
        $date_end = $this->input->post('end_limit');

        $currency = $this->mongo_db->get('CompanyInformation');
          if($date_end =='')
                {
                    $date_end = date('m/d/Y');
                }
             //   echo '<pre>';
        if($type=='client')
        {
            if($date_start != ''){
              
               // $invoices = $this->mongo_db->get_where('invoices', array('client_id' => $data,'created_date'=>$date));
                $invoices = $this->mongo_db->where_plus_between('invoices','created_date',$date_start,$date_end, array('client_id' => $data));
                $client_journal = $this->mongo_db->where_plus_between('Journal_items','created_date',$date_start,$date_end, array('journal_category' => new \MongoId($data)));
            }else{
                $invoices = $this->mongo_db->get_where('invoices', array('client_id' => $data));
                $client_journal = $this->mongo_db->get_where('Journal_items', array('journal_category' => new \MongoId($data)));
            }
          
           $invoice_array = array();
           $i =0;
           $j=0;
           $net_payment = 0;
           $net_payment_paid = 0;
           $journal_array = array();
            foreach($invoices as $invoice)
            {   
               
                 $invoices_paid = $this->mongo_db->get_where('InvoicePaid', array('invoice_id' => new \MongoId($invoice['_id']->{'$id'})));
                   $all_tax = $this->mongo_db->get_where('invoice_items', array('invoice_id' => new \MongoId($invoice['_id']->{'$id'})));
                     // begin the iteration for grouping category name and calculate the amount
                  
                    $amount = array();
                    $array_cat = array();
                    $net_tax = 0;
                    $cat_index =-1;
                    foreach($all_tax as $tax) {
                        if($tax['tax_rate'] != ''){
                            $index = $this->Tax_exist($tax['tax_rate'], $array_cat);
                            if ($index < 0) {
                                $cat_index++;
                                $category = $this->mongo_db->get_where('Tax', array('_id' => new \MongoId($tax['tax_rate'])));

                              $array_cat[$cat_index]['tax_rate']=$tax['tax_rate'];

                                $amount[$cat_index]['tax_name'] = $category[0]['tax_name'];

                                $amount[$cat_index]['tax_total_val'] =  $tax['tax_total_val'];

                            }
                            else {

                                 $amount[$cat_index]['tax_total_val'] +=  $tax['tax_total_val'];
                            }
                            $net_tax += $tax['tax_total_val'];
                       }
                    }
                    
                   $invoice_array[$i]['type'] = 'invoice';
                   $invoice_array[$i]['ínvoice'] = $invoice;
                   $invoice_array[$i]['invoice_paid'] = $invoices_paid;
                   $invoice_array[$i]['currency'] = $currency[0]['company_currency'];
                    $invoice_array[$i]['tax'] = $amount;
                    $invoice_array[$i]['net_income'] = $invoice['total_payment'] - $net_tax;
                        if($invoice['invoice_type'] != 1)
                        $net_payment += $invoice['total_payment'];
                        else
                            $net_payment -= $invoice['total_payment'];
                   foreach($invoices_paid as $paid_invoice){
                   if(isset($paid_invoice['paid_amount'])){
                       if($invoice['invoice_type'] != 1)
                        $net_payment_paid += $paid_invoice['paid_amount'];
                       else
                            $net_payment_paid -= $paid_invoice['paid_amount'];
                   }
                   }
                //   print_r($invoice_array);
                   $i++;
            }
            
            foreach ($client_journal as $journal)
            {
                $journal_code = $this->mongo_db->get_where('Journals', array('_id' => $journal['journal_id']));
                $invoice_array[$i]['type'] = 'journal';
                $invoice_array[$i]['currency'] = $currency[0]['company_currency'];
                $invoice_array[$i]['journal'] = $journal;
                $invoice_array[$i]['journal_code'] = $journal_code[0]['journal_code'];
                $invoice_array[$i]['date'] = $journal_code[0]['created_date'];
                $net_payment += $journal['debit'];
                $net_payment_paid += $journal['credit'];
                 $i++;
            }
                $remaining_amount = $net_payment-$net_payment_paid;
                    $net_array = array(
                        'net_payment' => $net_payment,
                        'net_payment_paid' => $net_payment_paid,
                        'remaining' => abs($remaining_amount),
                        'remaining_in'=> (($remaining_amount>0)?'Receivable Amount':'Payable Amount'),
                        'currency' =>$currency[0]['company_currency']
                    );
            //print_r($invoice_array);
            array_push($invoice_array,$net_array);
            echo json_encode($invoice_array);
        }

           if($type=='vendor')
        {
           if($date_start != ''){
                //$expenses = $this->mongo_db->get_where('expense_master', array('vendorname' => $data,'created_at'=>$date));
                $expenses = $this->mongo_db->where_plus_between('expense_master','created_at',$date_start,$date_end, array('vendorname' => $data));
                $client_journal = $this->mongo_db->where_plus_between('Journal_items','created_date',$date_start,$date_end, array('journal_category' => $data));
            }else{
                $expenses = $this->mongo_db->get_where('expense_master', array('vendorname' => $data));
                $client_journal = $this->mongo_db->get_where('Journal_items', array('journal_category' =>$data));
            }
          
            $expense_array = array();
            $i =0;
            $net_expense = 0;
            $net_expense_paid = 0;
            foreach ($expenses as $expense)
             {  
               
                 $expenses_paid = $this->mongo_db->get_where('ExpensePaid', array('expense_id' => new \MongoId($expense['_id']->{'$id'})));
                   $all_tax = $this->mongo_db->get_where('expense_product', array('expense_id' => new \MongoId($expense['_id']->{'$id'})));
                     // begin the iteration for grouping category name and calculate the amount
                 // print_r($all_tax);
                    $amount = array();
                    $array_cat = array();
                    $net_tax = 0;
                    $cat_index =-1;
                    foreach($all_tax as $tax) {
                        if($tax['product_tax'] != ''){
                            $index = $this->Tax_exist_expense($tax['product_tax']->{'$id'}, $array_cat);
                            if ($index < 0) {
                                $cat_index++;
                                $category = $this->mongo_db->get_where('Tax', array('_id' => new \MongoId($tax['product_tax']->{'$id'})));

                              $array_cat[$cat_index]['tax_rate']=$tax['product_tax']->{'$id'};

                                $amount[$cat_index]['tax_name'] = $category[0]['tax_name'];

                                $amount[$cat_index]['tax_total_val'] =  $tax['product_price']*$category[0]['tax']/100;

                            }
                            else {

                                 $amount[$cat_index]['tax_total_val'] +=  $tax['product_price']*$category[0]['tax']/100;
                            }
                            $net_tax += $tax['tax_total_val'];
                       }
                    }
                   // print_r($amount);
                    $expense_array[$i]['type'] = 'expense';
                   $expense_array[$i]['expense'] = $expense;
                   $expense_array[$i]['expense_paid'] = $expenses_paid;
                   $expense_array[$i]['currency'] = $currency[0]['company_currency'];
                    $expense_array[$i]['tax'] = $amount;
                    $expense_array[$i]['net_expense'] = $expense['total'] - $net_tax;
                   $net_expense += $expense['total'];
                   foreach($expenses_paid as $paid_invoice){
                   if(isset($paid_invoice['paid_amount'])){
                        $net_expense_paid += $paid_invoice['paid_amount'];
                   }
                   }
                 //  print_r($invoice_array);
                   $i++;
            }
            
            foreach ($client_journal as $journal)
            {
                $journal_code = $this->mongo_db->get_where('Journals', array('_id' => $journal['journal_id']));
                $expense_array[$i]['type'] = 'journal';
                $expense_array[$i]['currency'] = $currency[0]['company_currency'];
                $expense_array[$i]['journal'] = $journal;
                $expense_array[$i]['journal_code'] = $journal_code[0]['journal_code'];
                $expense_array[$i]['date'] = $journal_code[0]['created_date'];
                $net_expense += $journal['debit'];
                $net_expense_paid += $journal['credit'];
                 $i++;
            }
                $remaining_amount = $net_expense-$net_expense_paid;
                    $net_array = array(
                        'net_expense' => $net_expense,
                        'net_expense_paid' => $net_expense_paid,
                        'remaining' => abs($remaining_amount),
                        'remaining_in'=> (($remaining_amount>0)?'Payable Amount':'Receivable Amount'),
                        'currency' =>$currency[0]['company_currency']
                    );
           // print_r($expense_array);
            array_push($expense_array,$net_array);
            echo json_encode($expense_array);
        }
        
            if($type=='category')
        {
             if($date_start != ''){
                //$expenses = $this->mongo_db->get_where('expense_master', array('vendorname' => $data,'created_at'=>$date));
                 $expenses = $this->mongo_db->where_plus_between('expense_master','created_at',$date_start,$date_end, array('category' => new \MongoId($data)));
                 $client_journal = $this->mongo_db->where_plus_between('Journal_items','created_date',$date_start,$date_end, array('journal_category' => new \MongoId($data)));
            }else{
                $expenses = $this->mongo_db->get_where('expense_master', array('category' => new \MongoId($data)));
                 $client_journal = $this->mongo_db->get_where('Journal_items', array('journal_category' =>new \MongoId($data)));
            }
               $expense_array = array();
               $i =0;
               $net_expense = 0;
              foreach ($expenses as $expense)
              {
                  $expense_array[$i]['type'] = 'expense';
                   $expense_array[$i]['expense'] = $expense;
                   $expense_array[$i]['currency'] = $currency[0]['company_currency'];
                   $net_expense += $expense['total'];
                   $i++;
              }
                foreach ($client_journal as $journal)
            {
                $journal_code = $this->mongo_db->get_where('Journals', array('_id' => $journal['journal_id']));
                $expense_array[$i]['type'] = 'journal';
                $expense_array[$i]['currency'] = $currency[0]['company_currency'];
                $expense_array[$i]['journal'] = $journal;
                $expense_array[$i]['journal_code'] = $journal_code[0]['journal_code'];
                $expense_array[$i]['date'] = $journal_code[0]['created_date'];
                $net_expense += $journal['debit'];
                $net_expense -= $journal['credit'];
                 $i++;
            }
              $net_array = array(
                  'net_expense' =>$net_expense,
                  'currency' =>$currency[0]['company_currency']
              );
              array_push($expense_array,$net_array);
              echo json_encode($expense_array);
        }
        
        if($type=='bank')
        {
             if($date_start != ''){
                //$expenses = $this->mongo_db->get_where('expense_master', array('vendorname' => $data,'created_at'=>$date));
                 $bank_tranc = $this->mongo_db->where_plus_between('InvoicePaid','payment_date',$date_start,$date_end, array('payment_with' => $data));
                  $client_journal = $this->mongo_db->where_plus_between('Journal_items','created_date',$date_start,$date_end, array('journal_category' => $data));
            }else{
                $bank_tranc = $this->mongo_db->get_where('InvoicePaid', array('payment_with' => $data));
                $client_journal = $this->mongo_db->get_where('Journal_items', array('journal_category' =>$data));
            }
            
             $bank_array = array();
               $i =0;
               $net_transaction = 0;
              
              foreach ($bank_tranc as $bank)
              {
                   $invoice = $this->mongo_db->get_where('invoices', array('_id' => new \MongoId($bank['invoice_id']->{'$id'})));
                   $client = $this->mongo_db->get_where('Client', array('_id' => new \MongoId($invoice[0]['client_id'])));
                   $bank_array[$i]['type'] = 'bank';
                   $bank_array[$i]['bank'] = $bank;
                   $bank_array[$i]['client_name'] = $client[0]['firstname'].' '.$client[0]['lastname']; 
                   $bank_array[$i]['currency'] = $currency[0]['company_currency'];
                   $net_transaction += $bank['paid_amount'];
                   $i++;
              }
              
               foreach ($client_journal as $journal)
            {
                $journal_code = $this->mongo_db->get_where('Journals', array('_id' => $journal['journal_id']));
                $bank_array[$i]['type'] = 'journal';
                $bank_array[$i]['currency'] = $currency[0]['company_currency'];
                $bank_array[$i]['journal'] = $journal;
                $bank_array[$i]['journal_code'] = $journal_code[0]['journal_code'];
                $bank_array[$i]['date'] = $journal_code[0]['created_date'];
                $net_transaction -= $journal['debit'];
                $net_transaction += $journal['credit'];
                 $i++;
            }
              $net_transaction_array = array(
                  'net_transaction' =>$net_transaction,
                  'currency' =>$currency[0]['company_currency']
              );
              array_push($bank_array,$net_transaction_array);
              echo json_encode($bank_array);
        }
        
         if($type=='sales')
        {
            if($date_start != ''){
              
               // $invoices = $this->mongo_db->get_where('invoices', array('client_id' => $data,'created_date'=>$date));
                $invoices = $this->mongo_db->where_between('created_date',$date_start,$date_end)->get('invoices');
                $client_journal = $this->mongo_db->where_plus_between('Journal_items','created_date',$date_start,$date_end, array('journal_category' =>$data));
            }else{
                $invoices = $this->mongo_db->get('invoices');
                $client_journal = $this->mongo_db->get_where('Journal_items', array('journal_category' => $data));
            }
            
             $invoice_array = array();
           $i =0;
           $net_payment = 0;
           $net_payment_paid = 0;
            foreach($invoices as $invoice)
            {   
                if($invoice['invoice_type'] == 0){
                  $client = $this->mongo_db->get_where('Client', array('_id' => new \MongoId($invoice['client_id'])));
                  $invoice_array[$i]['ínvoice'] = $invoice;   
                  $invoice_array[$i]['type'] = 'invoice';
                  $invoice_array[$i]['currency'] = $currency[0]['company_currency'];
                  $invoice_array[$i]['client'] = $client[0]['firstname'].' '.$client[0]['lastname'];    
                   $i++;  
                }
            }
            
            foreach ($client_journal as $journal)
            {
                $journal_code = $this->mongo_db->get_where('Journals', array('_id' => $journal['journal_id']));
                $journal_account = $this->mongo_db->get_where('JournalAccount', array('_id' => $journal['journal_id']));
                $invoice_array[$i]['type'] = 'journal';
                $invoice_array[$i]['currency'] = $currency[0]['company_currency'];
                $invoice_array[$i]['journal'] = $journal;
                $invoice_array[$i]['journal_code'] = $journal_code[0]['journal_code'];
                $invoice_array[$i]['date'] = $journal_code[0]['created_date'];
                $net_payment -= $journal['debit'];
                $net_payment += $journal['credit'];
                 $i++;
            }
           
            echo json_encode($invoice_array);
        }
           if($type=='purchases')
        {
            if($date_start != ''){
               $invoices = $this->mongo_db->where_between('created_date',$date_start,$date_end)->get('invoices');
                $client_journal = $this->mongo_db->where_plus_between('Journal_items','created_date',$date_start,$date_end, array('journal_category' =>$data));
            }else{
                $invoices = $this->mongo_db->get('invoices');
                $client_journal = $this->mongo_db->get_where('Journal_items', array('journal_category' => $data));
            }
            
             $invoice_array = array();
           $i =0;
           $net_payment = 0;
           $net_payment_paid = 0;
            foreach($invoices as $invoice)
            {   
                if($invoice['invoice_type'] == 1){
                  $client = $this->mongo_db->get_where('Client', array('_id' => new \MongoId($invoice['client_id'])));
                  $invoice_array[$i]['type'] = 'purchases';
                  $invoice_array[$i]['ínvoice'] = $invoice;   
                  $invoice_array[$i]['currency'] = $currency[0]['company_currency'];
                  $invoice_array[$i]['client'] = $client[0]['firstname'].' '.$client[0]['lastname'];    
                   $i++;  
                }
            }
                foreach ($client_journal as $journal)
                {
                    $journal_code = $this->mongo_db->get_where('Journals', array('_id' => $journal['journal_id']));
                    $journal_account = $this->mongo_db->get_where('JournalAccount', array('_id' => $journal['journal_id']));
                    $invoice_array[$i]['type'] = 'journal';
                    $invoice_array[$i]['currency'] = $currency[0]['company_currency'];
                    $invoice_array[$i]['journal'] = $journal;
                    $invoice_array[$i]['journal_code'] = $journal_code[0]['journal_code'];
                    $invoice_array[$i]['date'] = $journal_code[0]['created_date'];
                    $net_payment -= $journal['debit'];
                    $net_payment += $journal['credit'];
                     $i++;
                }
            echo json_encode($invoice_array);
        }
             if($type=='journal')
        {
           if($date_start != ''){
                
                 //$JournalAccount = $this->mongo_db->where_plus_between('JournalAccount','created_at',$date_start,$date_end, array('_id' => new \MongoId($data)));
                 $client_journal = $this->mongo_db->where_plus_between('Journal_items','created_date',$date_start,$date_end, array('journal_category' => new \MongoId($data)));
            }else{
                // $JournalAccount = $this->mongo_db->get_where('JournalAccount', array('_id' => new \MongoId($data)));
                 $client_journal = $this->mongo_db->get_where('Journal_items', array('journal_category' =>new \MongoId($data)));
            }
               $journal_array = array();
               $i =0;
               $net_amount = 0;
                $JournalAccount = $this->mongo_db->get_where('JournalAccount', array('_id' =>new \MongoId($data)));
                foreach ($client_journal as $journal)
            {
                $journal_code = $this->mongo_db->get_where('Journals', array('_id' => $journal['journal_id']));
                if($JournalAccount[0]['type']== 'Debit')
                    $net_amount += $JournalAccount[0]['amount'];
                else
                     $net_amount -= $JournalAccount[0]['amount'];
                $journal_array[$i]['opening_balance'] = $JournalAccount[0]['amount'];
                $journal_array[$i]['currency'] = $currency[0]['company_currency'];
                $journal_array[$i]['journal'] = $journal;
                $journal_array[$i]['journal_code'] = $journal_code[0]['journal_code'];
                $journal_array[$i]['date'] = $journal_code[0]['created_date'];
                $net_amount += $journal['debit'];
                $net_amount -= $journal['credit'];
                 $i++;
            }
              $net_array = array(
                  'net_amount' =>abs($net_amount),
                  'currency' =>$currency[0]['company_currency'],
                  'type'     => (($net_amount>0)?'debit':'credit'),
              );
              array_push($journal_array,$net_array);
              echo json_encode($journal_array);
        }
    }
    
      public function Trial_balance() {
        $data['pageTitle'] = lang('trial_balance');
        $data['main_content'] = '/Trial_balance';
        $data['comp_info'] = $this->mongo_db->get('CompanyInformation');
        $data['footerJs'][0] = base_url('uploads/assets/plugins/switchery/switchery.min.js');
        $data['footerJs'][1] = base_url('uploads/assets/plugins/select2/dist/js/select2.min.js');
        $data['footerJs'][2] = base_url('uploads/assets/plugins/tinymce/tinymce.min.js');
        //$data['footerJs'][4] = base_url('uploads/custom/expense/expense.js');
        $data['footerJs'][3] = base_url('uploads/assets/plugins/bootstrap-sweetalert/sweet-alert.min.js');
        $data['footerJs'][5] = base_url('uploads/assets/pages/jquery.sweet-alert.init.js');
        $data['footerJs'][6] = base_url('uploads/assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js');
        $data['footerJs'][7] = base_url('uploads/assets/plugins/parsleyjs/dist/parsley.min.js');
        $data['footerJs'][8] = base_url('uploads/assets/plugins/datatables/dataTables.buttons.min.js');
        $data['footerJs'][9] = base_url('uploads/assets/plugins/datatables/buttons.bootstrap.min.js');
        $data['footerJs'][10] = base_url('uploads/assets/plugins/datatables/pdfmake.min.js');
        $data['footerJs'][11] = base_url('uploads/assets/plugins/datatables/vfs_fonts.js');
        $data['footerJs'][12] = base_url('uploads/assets/plugins/datatables/buttons.html5.min.js');
        $data['footerJs'][13] = base_url('uploads/assets/plugins/datatables/buttons.print.min.js');
        $data['footerJs'][14] = base_url('uploads/custom/reports/reports.js');
        
        
        $data['clients'] = $this->mongo_db->get('Client');
        $currency = $this->mongo_db->get('CompanyInformation');
        $i = 0;
        
        
        $remaining_amount = 0;
        $trial_bal= array();
        foreach($data['clients'] as $client)
        {
            $total_payment = 0;
            $total_amount = 0;
             $invoices = $this->mongo_db->get_where('invoices', array('client_id' => $client['_id']->{'$id'}));
             $client_journal = $this->mongo_db->get_where('Journal_items', array('journal_category' => new \MongoId($client['_id']->{'$id'})));
             //print_r($invoices);
             
             if(count($invoices) >0){
             foreach($invoices as $invoice)
             {
                 $invoices_paid = $this->mongo_db->get_where('InvoicePaid', array('invoice_id' => new \MongoId($invoice['_id']->{'$id'})));
                 // print_r($invoices_paid);
                  foreach($invoices_paid as $invoice_paid)
                  {
                       if($invoice['invoice_type'] != 1)
                        $total_payment += $invoice_paid['paid_amount'];
                       else
                          $total_payment -= $invoice_paid['paid_amount']; 
                  }
                   if($invoice['invoice_type'] != 1)
                  $total_amount += $invoice['total_payment'];
                   else
                       $total_amount -= $invoice['total_payment'];
             }
              foreach ($client_journal as $journal)
            {               
                $total_amount += $journal['debit'];
                $total_payment += $journal['credit'];
            }
            $remaining_amount = $total_amount - $total_payment;
            $remaining_in = (($remaining_amount>0)?'Receivable Amount':'Payable Amount');
            $client_info = array(
                'client_name'=> $client['firstname'].' '.$client['lastname'],
                'total_amount'=>$total_amount,
                'total_payment'=>$total_payment,
                'remaining_amount'=>abs($remaining_amount),
                'remaining_in'=>$remaining_in,
                'currency' => $currency[0]['company_currency'],
            );         
                  }else{
                        $client_info = array(
                            'client_name'=> $client['firstname'].' '.$client['lastname'],
                            'currency' => $currency[0]['company_currency'],
                            );
                  }
                   array_push($trial_bal, $client_info);
             $i++;
             
        }
        $data['trial_bal'] = $trial_bal;
       
        // counting total sales
        $total_sale_ex_tax = 0;
        $total_tax = 0;
        $sales_array = array();
        $sale_invoices = $this->mongo_db->get('invoices');
        foreach($sale_invoices as $invoice)
             {
                if($invoice['invoice_type'] == 0)
                $total_sale_ex_tax += $invoice['amount'];
                $total_tax += $invoice['tax_amunt'];
             }
             $sales_array = array(
                 'total_sale'=>$total_sale_ex_tax,
                 'total_tax'=> $total_tax,
                'currency' => $currency[0]['company_currency'],
             );
             $data['sales'] = $sales_array;
             
               // counting total Purchases
        $total_purchase_ex_tax = 0;
        $purchases_array = array();
        $purchase_invoices = $this->mongo_db->get('invoices');
        foreach($purchase_invoices as $invoice_p)
             {
                if($invoice_p['invoice_type'] == 1)
                $total_purchase_ex_tax += $invoice_p['amount'];
                $total_tax += $invoice['tax_amunt'];
             }
             
             $purchases_array = array(
                 'total_purchase'=>$total_purchase_ex_tax,
                 'total_tax'=> $total_tax,
                'currency' => $currency[0]['company_currency'],
             );
             $data['purchase'] = $purchases_array;
             
             //counting for expenses by categories
              $expense_categories = $this->mongo_db->get('category_master');
              $cat_expense_array = array();
              foreach($expense_categories as $cat)
              {
                    $expenses = $this->mongo_db->get_where('expense_master', array('category' => new \MongoId($cat['_id']->{'$id'})));
                    $client_journal = $this->mongo_db->get_where('Journal_items', array('journal_category' => new \MongoId($cat['_id']->{'$id'})));
                
               $i =0;
               $net_expense = 0;
              foreach ($expenses as $expense)
              {
                  
                   $net_expense += $expense['total'];
                   $i++;
              }
               foreach ($client_journal as $journal)
            {               
                $net_expense += $journal['debit'];
                $net_expense -= $journal['credit'];
            }
              $net_array = array(
                  'category_name'=> $cat['categoryname'],
                  'net_expense' =>$net_expense,
                  'currency' =>$currency[0]['company_currency']
              );
              array_push($cat_expense_array,$net_array);
              }
             $data['cat_expense_array'] = $cat_expense_array;
           
             // counting expense for vendorname
             
             $expenses = $this->mongo_db->get('expense_master');
               $expense_array = array();
               $i =0;
               $net_expense = 0;
                $amount = array();
                    $array_ex = array();
                    $net_expense = 0;
                    $expense_index =-1;
              foreach ($expenses as $expense)
              {
                  
                    
                        $index = $this->expense_exist($expense['vendorname'], $array_ex);
                        if ($index < 0) {
                            $expense_index++;
                           
                          $array_ex[$expense_index]['vendorname']=$expense['vendorname'];
                          $array_ex[$expense_index]['index']=$expense_index;
                            $amount[$expense_index]['vendorname'] = $expense['vendorname'];
                            $amount[$expense_index]['currency'] =  $currency[0]['company_currency'];
                            $amount[$expense_index]['total'] =  $expense['total'];

                        }
                        else {
                                foreach($array_ex as $a_ex)
                                {
                                    if($a_ex['vendorname'] == $expense['vendorname'])
                                    $amount[$a_ex['index']]['total'] +=  $expense['total'];
                        
                                }
                             }
                       
                    
                  /* $expense_array[$i]['expense'] = $expense['total'];
                   $expense_array[$i]['currency'] = $currency[0]['company_currency'];
                   $net_expense += $expense['total'];*/
                   $i++;
              }
            /*  $net_array = array(
                  'net_expense' =>$net_expense,
                  'currency' =>$currency[0]['company_currency']
              );*/
            //  array_push($expense_array,$net_array);
            
              $data['vendor_expense'] = $amount;
              
              // bank trial balance
              
               $bank_trial = $this->mongo_db->get('InvoicePaid');
               $$bank_trial_array = array();
               $i =0;
               $net_payment = 0;
                $amount = array();
                    $array_bank = array();
                   
                    $bank_index =-1;
              foreach ($bank_trial as $bank_trial)
              {
                  
                    
                        $index = $this->Bank_exist($bank_trial['payment_with'], $array_bank);
                        if ($index < 0) {
                            $bank_index++;
                           
                          $array_bank[$bank_index]['payment_with']=$bank_trial['payment_with'];
                          $array_bank[$bank_index]['index']=$bank_index;
                            $amount[$bank_index]['payment_with'] = $bank_trial['payment_with'];
                            $amount[$bank_index]['currency'] =  $currency[0]['company_currency'];
                            $amount[$bank_index]['paid_amount'] =  $bank_trial['paid_amount'];

                        }
                        else {
                                foreach($array_bank as $a_ex)
                                {
                                    if($a_ex['payment_with'] == $bank_trial['payment_with'])
                                    $amount[$a_ex['index']]['paid_amount'] +=  $bank_trial['paid_amount'];
                        
                                }
                             }
                       
                    
                  /* $expense_array[$i]['expense'] = $expense['total'];
                   $expense_array[$i]['currency'] = $currency[0]['company_currency'];
                   $net_expense += $expense['total'];*/
                   $i++;
              }
              $data['banks'] = $amount;
        $data['headerCss'][0] = base_url('uploads/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css');
        $data['headerCss'][1] = base_url('uploads/assets/plugins/select2/dist/css/select2.css');
        $data['headerCss'][2] = base_url('uploads/assets/plugins/select2/dist/css/select2-bootstrap.css');
        $data['headerCss'][3] = base_url('uploads/assets/plugins/bootstrap-sweetalert/sweet-alert.css');
        $data['headerCss'][4] = base_url('uploads/assets/plugins/switchery/switchery.min.css');
        $data['headerCss'][5] = "//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css";
        $data['headerCss'][6] = base_url('uploads/assets/plugins/datatables/buttons.bootstrap.min.css');
        $data['headerCss'][7] = 'https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css';        

        $this->parser->parse('layouts/PageTemplate', $data);
    }
    
    function Get_trial_data()
    {
        $invoice_date = $this->input->post('invoice_start');
       
        $date_end = date('m/d/Y');
         $currency = $this->mongo_db->get('CompanyInformation');
               // $invoices = $this->mongo_db->get_where('invoices', array('client_id' => $data,'created_date'=>$date));
                
                
                   $data['clients'] = $this->mongo_db->get('Client');
        
        $i = 0;
        $total_amount = 0;
        $total_payment = 0;
        $remaining_amount = 0;
        $trial_bal= array();
        foreach($data['clients'] as $client)
        {
             $invoices = $this->mongo_db->where_plus_between('invoices','created_date',$invoice_date,$date_end, array('client_id' => $client['_id']->{'$id'}));
             //print_r($invoices);
             
               if(count($invoices) >0){
             foreach($invoices as $invoice)
             {
                 $invoices_paid = $this->mongo_db->get_where('InvoicePaid', array('invoice_id' => new \MongoId($invoice['_id']->{'$id'})));
                 // print_r($invoices_paid);
                  foreach($invoices_paid as $invoice_paid)
                  {
                      $total_payment += $invoice_paid['paid_amount'];
                  }
                  $total_amount += $invoice['total_payment'];
             }
            $remaining_amount = $total_amount - $total_payment;
            $remaining_in = (($remaining_amount>0)?'Receivable Amount':'Payable Amount');
            $client_info = array(
                'client_name'=> $client['firstname'].' '.$client['lastname'],
                'total_amount'=>$total_amount,
                'total_payment'=>$total_payment,
                'remaining_amount'=>abs($remaining_amount),
                'remaining_in'=>$remaining_in,
                'currency' => $currency[0]['company_currency'],
            );         
                  }else{
                        $client_info = array(
                            'client_name'=> $client['firstname'].' '.$client['lastname'],
                            'currency' => $currency[0]['company_currency'],
                            );
                  }
                   array_push($trial_bal, $client_info);
             $i++;
             
        }
        echo json_encode($trial_bal);
           
    }
      // for search if a tax has been added into $amount, returns the key (index)
    public function Tax_exist($categoryname, $array) {
        $result = -1;
       
        for($i=0; $i<sizeof($array); $i++) {
          
            if ($array[$i]['tax_rate'] == $categoryname) {
                
                $result = $i;
                break;
            }
        }
        return $result;
    }
    
        // for search if a tax has been added into $amount, returns the key (index)
    public function Tax_exist_expense($categoryname, $array) {
        $result = -1;
       
        for($i=0; $i<sizeof($array); $i++) {
          
            if ($array[$i]['tax_rate'] == $categoryname) {
                
                $result = $i;
                break;
            }
        }
        return $result;
    }
    
       // for search if a expense has been added into $amount, returns the key (index)
    public function Expense_exist($categoryname, $array) {
        $result = -1;
       
        for($i=0; $i<sizeof($array); $i++) {
          
            if ($array[$i]['vendorname'] == $categoryname) {
                
                $result = $i;
                break;
            }
        }
        return $result;
    }
    
          // for search if a bank pay has been added into $amount, returns the key (index)
    public function Bank_exist($categoryname, $array) {
        $result = -1;
       
        for($i=0; $i<sizeof($array); $i++) {
          
            if ($array[$i]['payment_with'] == $categoryname) {
                
                $result = $i;
                break;
            }
        }
        return $result;
    }
    
     public function Cashflow() {
        $data['pageTitle'] = lang('cash_flow');
        
        $data['main_content'] = '/CashFlow';
        $invoice_paid = $this->mongo_db->get('InvoicePaid');
        $data['total_invoice'] = 0;
        foreach($invoice_paid as $invoice)
        {
            
            $data['total_invoice'] += $invoice['paid_amount']; 
        }
          $expenses = $this->mongo_db->get('expense_master');
            $data['total_expense'] = 0;
            foreach($expenses as $expense)
            {

                $data['total_expense'] += $expense['excluding_tax']; 
            }
            $data['net_cash'] = $data['total_invoice']-$data['total_expense'];
            $data['currency'] = $this->mongo_db->get('CompanyInformation');
           
            $data['currency'] = $data['currency'][0]['company_currency'];
         $expenses = $this->mongo_db->get('expense_master');
        
       // begin the iteration for grouping category name and calculate the amount
        
        $amount = array();
        $array_cat = array();
        $cat_index =-1;
        foreach($expenses as $expense) {
            $index = $this->cat_exists($expense['category'], $array_cat);
            if ($index < 0) {
                $cat_index++;
                $category = $this->mongo_db->get_where('category_master', array('_id' => new \MongoId($expense['category'])));
                
              $array_cat[$cat_index]['category']=$expense['category'];
                
                $amount[$cat_index]['category'] = $category[0]['categoryname'];
                
                $amount[$cat_index]['excluding_tax'] =  $expense['excluding_tax'];
               
            }
            else {
               
                $amount[$index]['excluding_tax'] +=  $expense['excluding_tax'];
            }
        }
       $data['all_expenses'] = $amount;
        $data['footerJs'][0] = base_url('uploads/assets/plugins/select2/dist/js/select2.min.js');
        $data['footerJs'][1] = base_url('uploads/assets/plugins/tinymce/tinymce.min.js');
        $data['footerJs'][2] = base_url('uploads/assets/plugins/bootstrap-sweetalert/sweet-alert.min.js');
        $data['footerJs'][3] = base_url('uploads/assets/pages/jquery.sweet-alert.init.js');
        $data['footerJs'][4] = base_url('uploads/assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js');
        $data['footerJs'][5] = base_url('uploads/assets/plugins/parsleyjs/dist/parsley.min.js');
        $data['i'] = 0;
        $data['tax_inc'] = 0;
        $data['tax'] = $this->mongo_db->get('Tax');

        $data['headerCss'][0] = base_url('uploads/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css');
        $data['headerCss'][1] = base_url('uploads/assets/plugins/select2/dist/css/select2.css');
        $data['headerCss'][2] = base_url('uploads/assets/plugins/select2/dist/css/select2-bootstrap.css');
        $data['headerCss'][3] = base_url('uploads/assets/plugins/bootstrap-sweetalert/sweet-alert.css');

                $data['headerCss'][4] = "//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css";

        $this->parser->parse('layouts/PageTemplate', $data);
    }
    
    // for search if a category has been added into $amount, returns the key (index)
    public function cat_exists($categoryname, $array) {
        $result = -1;
       
        for($i=0; $i<sizeof($array); $i++) {
          
            if ($array[$i]['category'] == $categoryname) {
                
                $result = $i;
                break;
            }
        }
        return $result;
    }
    
    public function Low_stock_register()
    {
         $data['pageTitle'] = lang('low_stock_register');
        $data['main_content'] = '/Low_stock_register';
        $data['comp_info'] = $this->mongo_db->get('CompanyInformation');
        $data['footerJs'][0] = base_url('uploads/assets/plugins/switchery/switchery.min.js');
        $data['footerJs'][1] = base_url('uploads/assets/plugins/select2/dist/js/select2.min.js');
        $data['footerJs'][2] = base_url('uploads/assets/plugins/tinymce/tinymce.min.js');
        //$data['footerJs'][4] = base_url('uploads/custom/expense/expense.js');
        $data['footerJs'][3] = base_url('uploads/assets/plugins/bootstrap-sweetalert/sweet-alert.min.js');
        $data['footerJs'][5] = base_url('uploads/assets/pages/jquery.sweet-alert.init.js');
        $data['footerJs'][6] = base_url('uploads/assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js');
        $data['footerJs'][7] = base_url('uploads/assets/plugins/parsleyjs/dist/parsley.min.js');
        $data['footerJs'][8] = base_url('uploads/assets/plugins/datatables/dataTables.buttons.min.js');
        $data['footerJs'][9] = base_url('uploads/assets/plugins/datatables/buttons.bootstrap.min.js');
        $data['footerJs'][10] = base_url('uploads/assets/plugins/datatables/pdfmake.min.js');
        $data['footerJs'][11] = base_url('uploads/assets/plugins/datatables/vfs_fonts.js');
        $data['footerJs'][12] = base_url('uploads/assets/plugins/datatables/buttons.html5.min.js');
        $data['footerJs'][13] = base_url('uploads/assets/plugins/datatables/buttons.print.min.js');
        $data['footerJs'][14] = base_url('uploads/custom/reports/reports.js');
        $data['comp_info'] = $this->mongo_db->get('CompanyInformation');
        
        $products = $this->mongo_db->get('product');
        $currency = $this->mongo_db->get('CompanyInformation');
        $low_stock_product = array();
            foreach($products as $product)
            {
                if($product['closing_stock'] <=$product['minimum_in_stock'])
                {
                   
                    if($product['closing_stock'] == '')
                    {
                        $product['closing_stock'] = 0;
                    }
                    if($product['minimum_in_stock'] == '')
                    {
                        $product['minimum_in_stock'] = 0;
                    }
                    array_push($low_stock_product, $product);
                }
            }
            $data['products'] = $low_stock_product;
        $data['headerCss'][0] = base_url('uploads/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css');
        $data['headerCss'][1] = base_url('uploads/assets/plugins/select2/dist/css/select2.css');
        $data['headerCss'][2] = base_url('uploads/assets/plugins/select2/dist/css/select2-bootstrap.css');
        $data['headerCss'][3] = base_url('uploads/assets/plugins/bootstrap-sweetalert/sweet-alert.css');
        $data['headerCss'][4] = base_url('uploads/assets/plugins/switchery/switchery.min.css');
        $data['headerCss'][5] = "//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css";
         $data['headerCss'][6] = base_url('uploads/assets/plugins/datatables/buttons.bootstrap.min.css');
         $data['headerCss'][7] = 'https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css';        

        $this->parser->parse('layouts/PageTemplate', $data);
    }
    
     public function Stock_summary()
    {
         $data['pageTitle'] = lang('stock_summary');
        $data['main_content'] = '/Stock_summary';
        $data['comp_info'] = $this->mongo_db->get('CompanyInformation');
        $data['footerJs'][0] = base_url('uploads/assets/plugins/switchery/switchery.min.js');
        $data['footerJs'][1] = base_url('uploads/assets/plugins/select2/dist/js/select2.min.js');
        $data['footerJs'][2] = base_url('uploads/assets/plugins/tinymce/tinymce.min.js');
        //$data['footerJs'][4] = base_url('uploads/custom/expense/expense.js');
        $data['footerJs'][3] = base_url('uploads/assets/plugins/bootstrap-sweetalert/sweet-alert.min.js');
        $data['footerJs'][5] = base_url('uploads/assets/pages/jquery.sweet-alert.init.js');
        $data['footerJs'][6] = base_url('uploads/assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js');
        $data['footerJs'][7] = base_url('uploads/assets/plugins/parsleyjs/dist/parsley.min.js');
        $data['footerJs'][8] = base_url('uploads/assets/plugins/datatables/dataTables.buttons.min.js');
        $data['footerJs'][9] = base_url('uploads/assets/plugins/datatables/buttons.bootstrap.min.js');
        $data['footerJs'][10] = base_url('uploads/assets/plugins/datatables/pdfmake.min.js');
        $data['footerJs'][11] = base_url('uploads/assets/plugins/datatables/vfs_fonts.js');
        $data['footerJs'][12] = base_url('uploads/assets/plugins/datatables/buttons.html5.min.js');
        $data['footerJs'][13] = base_url('uploads/assets/plugins/datatables/buttons.print.min.js');
        $data['footerJs'][14] = base_url('uploads/custom/reports/reports.js');
        $data['comp_info'] = $this->mongo_db->get('CompanyInformation');
        
        $data['products'] = $this->mongo_db->get('product');
        $currency = $this->mongo_db->get('CompanyInformation');
        
        $data['headerCss'][0] = base_url('uploads/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css');
        $data['headerCss'][1] = base_url('uploads/assets/plugins/select2/dist/css/select2.css');
        $data['headerCss'][2] = base_url('uploads/assets/plugins/select2/dist/css/select2-bootstrap.css');
        $data['headerCss'][3] = base_url('uploads/assets/plugins/bootstrap-sweetalert/sweet-alert.css');
        $data['headerCss'][4] = base_url('uploads/assets/plugins/switchery/switchery.min.css');
        $data['headerCss'][5] = "//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css";
         $data['headerCss'][6] = base_url('uploads/assets/plugins/datatables/buttons.bootstrap.min.css');
         $data['headerCss'][7] = 'https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css';        

        $this->parser->parse('layouts/PageTemplate', $data);
    }
    
    public function Tax_Summary()
    {   
        $data['pageTitle'] = lang('tax_summary');
        $data['main_content'] = '/Tax_Summary';
        $data['comp_info'] = $this->mongo_db->get('CompanyInformation');
        $data['footerJs'][0] = base_url('uploads/assets/plugins/switchery/switchery.min.js');
        $data['footerJs'][1] = base_url('uploads/assets/plugins/select2/dist/js/select2.min.js');
        $data['footerJs'][2] = base_url('uploads/assets/plugins/tinymce/tinymce.min.js');
        //$data['footerJs'][4] = base_url('uploads/custom/expense/expense.js');
        $data['footerJs'][3] = base_url('uploads/assets/plugins/bootstrap-sweetalert/sweet-alert.min.js');
        $data['footerJs'][5] = base_url('uploads/assets/pages/jquery.sweet-alert.init.js');
        $data['footerJs'][6] = base_url('uploads/assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js');
        $data['footerJs'][7] = base_url('uploads/assets/plugins/parsleyjs/dist/parsley.min.js');
        $data['footerJs'][8] = base_url('uploads/assets/plugins/datatables/dataTables.buttons.min.js');
        $data['footerJs'][9] = base_url('uploads/assets/plugins/datatables/buttons.bootstrap.min.js');
        $data['footerJs'][10] = base_url('uploads/assets/plugins/datatables/pdfmake.min.js');
        $data['footerJs'][11] = base_url('uploads/assets/plugins/datatables/vfs_fonts.js');
        $data['footerJs'][12] = base_url('uploads/assets/plugins/datatables/buttons.html5.min.js');
        $data['footerJs'][13] = base_url('uploads/assets/plugins/datatables/buttons.print.min.js');
        $data['footerJs'][14] = base_url('uploads/custom/reports/reports.js');
        $data['comp_info'] = $this->mongo_db->get('CompanyInformation');
        $data['all_taxes'] = $this->mongo_db->get('Tax');
        
        $currency = $this->mongo_db->get('CompanyInformation');
        
                $invoices = $this->mongo_db->get('invoices');
        
           $invoice_array = array();
           $i =0;
           $total_tax = 0;
           $net_payment_paid = 0;
            foreach($invoices as $invoice)
            {   
               
                   $all_tax = $this->mongo_db->get_where('invoice_items', array('invoice_id' => new \MongoId($invoice['_id']->{'$id'})));
                     // begin the iteration for grouping category name and calculate the amount
                   
                 // print_r($invoices_paid);
                    $amount = array();
                    $array_cat = array();
                    $net_tax = 0;
                    $cat_index =-1;
                    foreach($all_tax as $tax) {
                        $index = $this->Tax_exist($tax['tax_rate'], $array_cat);
                        if ($index < 0) {
                            $cat_index++;
                            //$category = $this->mongo_db->get_where('Tax', array('_id' => new \MongoId($tax['tax_rate'])));

                          $array_cat[$cat_index]['tax_rate']=$tax['tax_rate'];

                            $amount[$cat_index]['tax_name'] = $category[0]['tax_name'];
                            $amount[$cat_index]['tax_rate'] = $tax['tax_rate'];
                            $amount[$cat_index]['tax_total_val'] =  $tax['tax_total_val'];

                        }
                        else {

                             $amount[$cat_index]['tax_total_val'] +=  $tax['tax_total_val'];
                        }
                        $net_tax += $tax['tax_total_val'];
                    }

                   
                   foreach($amount as $amount)
                   {
                       $invoice_array[$i]['ínvoice'] = $invoice['invoice_code'];
                       $invoice_array[$i]['ínvoice_date'] = $invoice['created_date'];
                       $invoice_array[$i]['currency'] = $currency[0]['company_currency'];
                       $invoice_array[$i]['tax_name'] = $amount['tax_name'];
                       $invoice_array[$i]['tax_val'] = $amount['tax_total_val'];
                        $invoice_array[$i]['tax_rate'] = $amount['tax_rate'];
                       $invoice_array[$i]['net_tax'] = $net_tax;
                       $i++;
                   }
                   
                    $total_tax += $net_tax;
                   
            }
                
                    $net_array = array(
                        'total_tax' => $total_tax,
                     
                        'currency' =>$currency[0]['company_currency']
                    );
           
            array_push($invoice_array,$net_array);
           print_r($invoice_array);
           $data['tax_array'] = $invoice_array;
        $data['headerCss'][0] = base_url('uploads/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css');
        $data['headerCss'][1] = base_url('uploads/assets/plugins/select2/dist/css/select2.css');
        $data['headerCss'][2] = base_url('uploads/assets/plugins/select2/dist/css/select2-bootstrap.css');
        $data['headerCss'][3] = base_url('uploads/assets/plugins/bootstrap-sweetalert/sweet-alert.css');
        $data['headerCss'][4] = base_url('uploads/assets/plugins/switchery/switchery.min.css');
        $data['headerCss'][5] = "//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css";
         $data['headerCss'][6] = base_url('uploads/assets/plugins/datatables/buttons.bootstrap.min.css');
         $data['headerCss'][7] = 'https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css';        

        $this->parser->parse('layouts/PageTemplate', $data);
         
    }
    
    public function Tax_summary_ajax()
    {
        $tax_rate = $this->input->post('data');
         $currency = $this->mongo_db->get('CompanyInformation');
        $date_start = $this->input->post('start_limit');
        $date_end = $this->input->post('end_limit');
         if($date_end =='')
                {
                    $date_end = date('m/d/Y');
                }
          if($tax_rate != ''){
                $all_taxes = $this->mongo_db->get_where('invoice_items', array('tax_rate' =>$tax_rate));
          }else{
               $all_taxes = $this->mongo_db->get('invoice_items');
          }
       /* $invoice_id_array = array();
        foreach($all_invoices as $invoices){
            array_push($invoice_id_array, $invoices['invoice_id']->{'$id'});
        }
        print_r($invoice_id_array);
        $invoice_id_array = array_values(array_unique($invoice_id_array));
        print_r($invoice_id_array);*/
       // $invoices = $this->mongo_db->get('invoices');
        
           $invoice_array = array();
           $i =0;
           $total_tax = 0;
           $net_payment_paid = 0;
            foreach($all_taxes as $all_tax)
            {   
                if($date_start != ''){
              
               // $invoices = $this->mongo_db->get_where('invoices', array('client_id' => $data,'created_date'=>$date));
                $invoice = $this->mongo_db->where_plus_between('invoices','created_date',$date_start,$date_end, array('_id' => new \MongoId($all_tax['invoice_id']->{'$id'})));
            }else{
                $invoice = $this->mongo_db->get_where('invoices', array('_id' => new \MongoId($all_tax['invoice_id']->{'$id'})));
            }
               
                   
                   //print_r($all_tax['invoice_id']->{'$id'});
                   $category = $this->mongo_db->get_where('Tax', array('_id' => new \MongoId($all_tax['tax_rate'])));
                     // begin the iteration for grouping category name and calculate the amount
                     if(!empty($invoice))
                     {
                       $invoice_array[$i]['ínvoice'] = $invoice[0]['invoice_code'];
                       $invoice_array[$i]['ínvoice_date'] = $invoice[0]['created_date'];
                       $invoice_array[$i]['currency'] = $currency[0]['company_currency'];
                       $invoice_array[$i]['tax_name'] = $category[0]['tax_name'];
                       $invoice_array[$i]['tax_val'] = $all_tax['tax_total_val'];
                       $invoice_array[$i]['tax_rate'] = $all_tax['tax_rate'];
                       //$invoice_array[$i]['net_tax'] = $net_tax;
                       $i++;
                     
                       $total_tax += $all_tax['tax_total_val'];
                     }
                   
            }
                
                    $net_array = array(
                        'total_tax' => $total_tax,
                     
                        'currency' =>$currency[0]['company_currency']
                    );
           
            array_push($invoice_array,$net_array);
          // print_r($invoice_array);
           echo json_encode($invoice_array);
    }
    
      public function Vat_Summary()
    {
         $data['pageTitle'] = lang('vat_summary');
        $data['main_content'] = '/Vat_Summary';
        $data['comp_info'] = $this->mongo_db->get('CompanyInformation');
        $data['footerJs'][0] = base_url('uploads/assets/plugins/switchery/switchery.min.js');
        $data['footerJs'][1] = base_url('uploads/assets/plugins/select2/dist/js/select2.min.js');
        $data['footerJs'][2] = base_url('uploads/assets/plugins/tinymce/tinymce.min.js');
        //$data['footerJs'][4] = base_url('uploads/custom/expense/expense.js');
        $data['footerJs'][3] = base_url('uploads/assets/plugins/bootstrap-sweetalert/sweet-alert.min.js');
        $data['footerJs'][5] = base_url('uploads/assets/pages/jquery.sweet-alert.init.js');
        $data['footerJs'][6] = base_url('uploads/assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js');
        $data['footerJs'][7] = base_url('uploads/assets/plugins/parsleyjs/dist/parsley.min.js');
        $data['footerJs'][8] = base_url('uploads/assets/plugins/datatables/dataTables.buttons.min.js');
        $data['footerJs'][9] = base_url('uploads/assets/plugins/datatables/buttons.bootstrap.min.js');
        $data['footerJs'][10] = base_url('uploads/assets/plugins/datatables/pdfmake.min.js');
        $data['footerJs'][11] = base_url('uploads/assets/plugins/datatables/vfs_fonts.js');
        $data['footerJs'][12] = base_url('uploads/assets/plugins/datatables/buttons.html5.min.js');
        $data['footerJs'][13] = base_url('uploads/assets/plugins/datatables/buttons.print.min.js');
        $data['footerJs'][14] = base_url('uploads/custom/reports/reports.js');
        $data['comp_info'] = $this->mongo_db->get('CompanyInformation');
        $data['all_taxes'] = $this->mongo_db->get('Tax');
        
        $currency = $this->mongo_db->get('CompanyInformation');
        $tax = $this->mongo_db->get_where('Tax', array('tax_name' =>'VAT'));
     
                if($tax != ''){
                $all_taxes = $this->mongo_db->get_where('invoice_items', array('tax_rate' =>$tax[0]['_id']->{'$id'}));
          }else{
               $all_taxes = $this->mongo_db->get('invoice_items');
          }
          
       /* $invoice_id_array = array();
        foreach($all_invoices as $invoices){
            array_push($invoice_id_array, $invoices['invoice_id']->{'$id'});
        }
        print_r($invoice_id_array);
        $invoice_id_array = array_values(array_unique($invoice_id_array));
        print_r($invoice_id_array);*/
       // $invoices = $this->mongo_db->get('invoices');
        
           $invoice_array = array();
           $i =0;
           $total_tax = 0;
           $net_payment_paid = 0;
            foreach($all_taxes as $all_tax)
            {   
                if($date_start != ''){
              
               // $invoices = $this->mongo_db->get_where('invoices', array('client_id' => $data,'created_date'=>$date));
                $invoice = $this->mongo_db->where_plus_between('invoices','created_date',$date_start,$date_end, array('_id' => new \MongoId($all_tax['invoice_id']->{'$id'})));
            }else{
                $invoice = $this->mongo_db->get_where('invoices', array('_id' => new \MongoId($all_tax['invoice_id']->{'$id'})));
            }
               
                   
                   //print_r($all_tax['invoice_id']->{'$id'});
                   $category = $this->mongo_db->get_where('Tax', array('_id' => new \MongoId($all_tax['tax_rate'])));
                     // begin the iteration for grouping category name and calculate the amount
                     if(!empty($invoice))
                     {
                       $invoice_array[$i]['ínvoice'] = $invoice[0]['invoice_code'];
                       $invoice_array[$i]['ínvoice_date'] = $invoice[0]['created_date'];
                       $invoice_array[$i]['currency'] = $currency[0]['company_currency'];
                       $invoice_array[$i]['tax_name'] = $category[0]['tax_name'];
                       $invoice_array[$i]['tax_val'] = $all_tax['tax_total_val'];
                       $invoice_array[$i]['tax_rate'] = $all_tax['tax_rate'];
                       //$invoice_array[$i]['net_tax'] = $net_tax;
                       $i++;
                     
                       $total_tax += $all_tax['tax_total_val'];
                     }
                   
            }
                
                    $net_array = array(
                        'total_tax' => $total_tax,
                     
                        'currency' =>$currency[0]['company_currency']
                    );
           
            array_push($invoice_array,$net_array);
           
           $data['tax_array'] = $invoice_array;
        $data['headerCss'][0] = base_url('uploads/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css');
        $data['headerCss'][1] = base_url('uploads/assets/plugins/select2/dist/css/select2.css');
        $data['headerCss'][2] = base_url('uploads/assets/plugins/select2/dist/css/select2-bootstrap.css');
        $data['headerCss'][3] = base_url('uploads/assets/plugins/bootstrap-sweetalert/sweet-alert.css');
        $data['headerCss'][4] = base_url('uploads/assets/plugins/switchery/switchery.min.css');
        $data['headerCss'][5] = "//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css";
         $data['headerCss'][6] = base_url('uploads/assets/plugins/datatables/buttons.bootstrap.min.css');
         $data['headerCss'][7] = 'https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css';        

        $this->parser->parse('layouts/PageTemplate', $data);
         
    }
    
       public function Profit_loss()
    {
         $data['pageTitle'] = lang('profit_loss');
        $data['main_content'] = '/Profit_loss';
        $data['comp_info'] = $this->mongo_db->get('CompanyInformation');
        $data['footerJs'][0] = base_url('uploads/assets/plugins/switchery/switchery.min.js');
        $data['footerJs'][1] = base_url('uploads/assets/plugins/select2/dist/js/select2.min.js');
        $data['footerJs'][2] = base_url('uploads/assets/plugins/tinymce/tinymce.min.js');
        //$data['footerJs'][4] = base_url('uploads/custom/expense/expense.js');
        $data['footerJs'][3] = base_url('uploads/assets/plugins/bootstrap-sweetalert/sweet-alert.min.js');
        $data['footerJs'][5] = base_url('uploads/assets/pages/jquery.sweet-alert.init.js');
        $data['footerJs'][6] = base_url('uploads/assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js');
        $data['footerJs'][7] = base_url('uploads/assets/plugins/parsleyjs/dist/parsley.min.js');
        $data['footerJs'][8] = base_url('uploads/assets/plugins/datatables/dataTables.buttons.min.js');
        $data['footerJs'][9] = base_url('uploads/assets/plugins/datatables/buttons.bootstrap.min.js');
        $data['footerJs'][10] = base_url('uploads/assets/plugins/datatables/pdfmake.min.js');
        $data['footerJs'][11] = base_url('uploads/assets/plugins/datatables/vfs_fonts.js');
        $data['footerJs'][12] = base_url('uploads/assets/plugins/datatables/buttons.html5.min.js');
        $data['footerJs'][13] = base_url('uploads/assets/plugins/datatables/buttons.print.min.js');
        $data['footerJs'][14] = base_url('uploads/custom/reports/reports.js');
        $data['comp_info'] = $this->mongo_db->get('CompanyInformation');
        $data['all_taxes'] = $this->mongo_db->get('Tax');
        
        $currency = $this->mongo_db->get('CompanyInformation');
        
                $invoices = $this->mongo_db->get('invoices');
        
           
           $i =0;
           $sales_tax = 0;
           $sales_without_tax = 0;
            $net_sales = 0;
            foreach($invoices as $invoice)
            {   
               
                    $sales_tax += $invoice['tax_amunt'];
                    $sales_without_tax += $invoice['amount'];
                    $net_sales += $invoice['total_payment'];
                   
            }
            $sales_array = array(
                'sales_tax' => $sales_tax,
                'sales_without_tax'=>$sales_without_tax,
                'net_sales' => $net_sales,
            );
          
           $data['sales_array'] = $sales_array;
           
               //counting for expenses by categories
              $expense_categories = $this->mongo_db->get('category_master');
              $cat_expense_array = array();
              $total_expense = 0;
              foreach($expense_categories as $cat)
              {
                   $expenses = $this->mongo_db->get_where('expense_master', array('category' => $cat['_id']->{'$id'}));
            
                
               $i =0;
               $net_expense = 0;
              foreach ($expenses as $expense)
              {
                  
                   $net_expense += $expense['total'];
                   $i++;
              }
                $total_expense += $net_expense;
              $net_array = array(
                  'category_name'=> $cat['categoryname'],
                  'net_expense' =>$net_expense,
                  'currency' =>$currency[0]['company_currency']
              );
              array_push($cat_expense_array,$net_array);
              }
             $data['cat_expense_array'] = $cat_expense_array;
             $data['total_expense'] = $total_expense;
        $data['headerCss'][0] = base_url('uploads/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css');
        $data['headerCss'][1] = base_url('uploads/assets/plugins/select2/dist/css/select2.css');
        $data['headerCss'][2] = base_url('uploads/assets/plugins/select2/dist/css/select2-bootstrap.css');
        $data['headerCss'][3] = base_url('uploads/assets/plugins/bootstrap-sweetalert/sweet-alert.css');
        $data['headerCss'][4] = base_url('uploads/assets/plugins/switchery/switchery.min.css');
        $data['headerCss'][5] = "//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css";
         $data['headerCss'][6] = base_url('uploads/assets/plugins/datatables/buttons.bootstrap.min.css');
         $data['headerCss'][7] = 'https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css';        

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
            $data = array('category' => $this->input->post('category'),
                'vendorname' => $this->input->post('vendorname'),
                'description' => $this->input->post('description'),
                'excluding_tax' => $this->input->post('excluding_tax'),
                'total' => $this->input->post('total'),
                'created_at' => $this->input->post('startdate'),
                'created_by' => $this->session->userdata('alice_session')['_id'],
            );
            $expenseid = $this->mongo_db->insert('expense_master', $data);
            $product_name = $this->input->post('product_name');
            $qty = $this->input->post('qty');
            $category = $this->input->post('product_category');
            $product_tax = $this->input->post('product_tax');
            $product_price = $this->input->post('product_price');
            if (count($product_name) > 0) {
                $i = 0;
                foreach ($product_name as $product) {

                    $productData = array(
                        'expense_id' => $expenseid,
                        'product_name' => $product_name[$i],
                        'qty' => $qty[$i],
                        'category' => $category[$i],
                        //    'product_tax' => $product_tax[$i],
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
        $this->mongo_db->where(array('_id' => $id))->delete('Client');
        $error_msg = SUCCESS_START_DIV_NEW . lang('account_del_msg') . SUCCESS_END_DIV;
        $this->session->set_flashdata('message', $error_msg);
        redirect(site_url('Client'));
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
            $data = array('category' => $this->input->post('category'),
                'vendorname' => $this->input->post('vendorname'),
                'description' => $this->input->post('description'),
                'excluding_tax' => $this->input->post('excluding_tax'),
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
            if (count($product_name) > 0) {
                $i = 0;
                $this->mongo_db->where(array('expense_id' => $id))->delete('expense_product');

                foreach ($product_name as $product) {

                    $productData = array(
                        'expense_id' => $id,
                        'product_name' => $product_name[$i],
                        'qty' => $qty[$i],
                        'category' => $category[$i],
                        //    'product_tax' => $product_tax[$i],
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

}

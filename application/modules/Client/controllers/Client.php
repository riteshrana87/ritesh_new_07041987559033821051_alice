<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Client extends Public_controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('upload');
        $this->load->library('mongo_db', array('activate' => 'default'), 'mongo_db');
        $this->module = $this->router->fetch_class();
        $this->viewname = $this->router->fetch_class();
    }

    public function index($view = 'grid') {
        $data['main_content'] = '/index';
        $data['pageTitle'] = lang('clients');

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
        $data['clients'] = $result; //$this->mongo_db->get('Client');
        //$this->mongo_db->explain();
        //  $data['clients']=$this->mongo_db->get('Client');
        $data['footerJs'][0] = base_url('uploads/assets/plugins/bootstrap-sweetalert/sweet-alert.min.js');
        $data['footerJs'][1] = base_url('uploads/assets/pages/jquery.sweet-alert.init.js');
        $data['footerJs'][2] = base_url('uploads/assets/plugins/datatables/jquery.dataTables.min.js');
        $data['footerJs'][3] = base_url('uploads/assets/plugins/datatables/dataTables.responsive.min.js');
        $data['footerJs'][4] = base_url('uploads/assets/js/filterizr/jquery.filterizr.js');
        $data['footerJs'][5] = base_url('uploads/custom/client/client.js');
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

        $data['pageTitle'] = lang('create_client');
        $data['main_content'] = '/AddClient';
        $data['footerJs'][0] = base_url('uploads/assets/plugins/parsleyjs/dist/parsley.min.js');
        $data['footerJs'][1] = base_url('uploads/custom/client/client.js');
        $data['footerJs'][9] = base_url('uploads/assets/plugins/timepicker/bootstrap-timepicker.min.js');
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

        $this->parser->parse('layouts/PageTemplate', $data);
    }

    public function Edit($id) {

        $data['pageTitle'] = lang('edit_client');
        if ($id != '') {
            $data['client'] = $this->mongo_db->get_where('Client', array('_id' => new \MongoId($id)));
			 $data['invoice'] = $this->mongo_db->get_where('invoices', array('client_id' => $id));
            $now   = date('m/d/Y');
          
           $show_reminders = array();
            foreach($data['invoice'] as $row)
            {
               
                if(strtotime($row['due_date']) <= strtotime('today'))
                {
                   $diff = strtotime('today') - strtotime($row['due_date']);
                   $number_of_days = $diff/86400;
                    
                    $reminders = $this->mongo_db->get_where('send_reminder', array('invoice_id' => $row['invoice_code']));
					
					/* echo "<pre>";
					print_r($reminders);
					echo "</pre>"; */
					//die();
                    //print_r($reminders);
                      foreach ($reminders as $remind)
                        {
                               
                                $created_date=strtotime($row['created_date']);
                                $invoice_date=date('m/d/Y',$created_date);

                                if($remind['reminder_type']==1){
                                                                    $date1 = date('Y-m-d');
                                                                    $date2 = strtotime($date1);
                                                                    $date = strtotime($invoice_date);
                                                                    $after_date = strtotime("+".$remind['days']." day",$date);

                                                                    $reminder_date=date('m/d/Y', $after_date);
                                                                    strtotime($reminder_date);
																	
                                                                    if($date2 >= strtotime($reminder_date)){
																		
                                                                        $days_after_create = $date2 - strtotime($reminder_date);
                                                                        $days_after_create = $days_after_create/86400;
                                                                        $remind['invoice_date'] = $invoice_date;
                                                                         $remind['days_after_create'] = $days_after_create;
                                                                          
                                                                            array_push($show_reminders,$remind);
																			
                                                                            }
																			


                                }
                                if($remind['reminder_type']==2){


                                                                $date1 = date('Y-m-d');
                                                                    $date2 = strtotime($date1);
                                                                    $date = strtotime($invoice_date);
                                                                    $after_date = strtotime("-".$remind['days']." day",$date);

                                                                    $reminder_date=date('m/d/Y', $after_date);

                                                                    if($date2 >= strtotime($reminder_date)){

                                                                          $days_after_create = $date2 - strtotime($reminder_date);
                                                                          $days_after_create = $days_after_create/86400;
                                                                          $remind['invoice_date'] = $invoice_date;
                                                                           $remind['days_after_create'] = $days_after_create;
                                                                            //die;
                                                                            //pr($remind);
                                                                           // echo "after match data";
                                                                            array_push($show_reminders,$remind);
                                                                            }


                                 }
                                if($remind['reminder_type']==3){

                                                            $reminder_date=date('m/d/Y', strtotime($remind['days']));
                                                                    if($now >= $reminder_date){
                                                                        print_r($now);
                                                                        print_r($reminder_date);
                                                                         $days_after_create = strtotime($now) - strtotime($reminder_date);
                                                                         $days_after_create = $days_after_create/86400;
                                                                         $remind['invoice_date'] = $invoice_date;
                                                                         $remind['days_after_create'] = $days_after_create;
                                                                         
                                                                            //die;
                                                                           // pr($remind);
                                                                            //echo "custom match data";
                                                                            array_push($show_reminders,$remind);
                                                                            } 

                                 }

                        }
                }
            }
		
            sort($show_reminders);
            $data['show_reminders'] = $show_reminders;
			
			
            $data['main_content'] = '/EditClient';
            $data['footerJs'][0] = base_url('uploads/assets/plugins/parsleyjs/dist/parsley.min.js');
            $data['footerJs'][1] = base_url('uploads/custom/client/client.js');
            //$data['footerJs'][2] = base_url('uploads/custom/invoice/recurring.js');
            //$data['footerJs'][3] = base_url('uploads/custom/invoice/invoice.js');

            $this->parser->parse('layouts/PageTemplate', $data);
        } else {
            redirect(base_url('Client'));
        }
    }


    public function InsertData() {
        $this->load->library('form_validation');
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $this->form_validation->set_error_delimiters(ERROR_START_DIV_NEW, ERROR_END_DIV);
        $this->form_validation->set_rules('email', 'email', 'trim|required|valid_email');
        $this->form_validation->set_rules('firstname', 'firstname', 'trim|required');
        $this->form_validation->set_rules('lastname', 'lastname', 'trim|required');
        $this->form_validation->set_rules('company', 'company', 'trim|required');
        //$this->form_validation->set_rules('password', 'Password', 'trim|required|callback_check_database');



        if ($this->form_validation->run() == FALSE) {
            $error_msg = validation_errors();
            $this->session->set_flashdata('error', $error_msg);
            redirect(site_url('Client/Add'));
            //Field validation failed.  User redirected to login page
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
                'created_at' => date('Y-m-d h:i:s'),
                'created_by' => $this->session->userdata('alice_session')['_id'],
            );
            $this->mongo_db->insert('Client', $data);
            $saveactivity = $this->save_activity($this->session->userdata('alice_session')['_id'], lang('account_add_msg'), 'Client');

            $error_msg = SUCCESS_START_DIV_NEW . lang('account_add_msg') . SUCCESS_END_DIV;
            $this->session->set_flashdata('message', $error_msg);
            redirect(base_url('Client'));
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
            $saveactivity = $this->save_activity($this->session->userdata('alice_session')['_id'], lang('account_update_msg'), 'Client');
            $error_msg = SUCCESS_START_DIV_NEW . lang('account_update_msg') . SUCCESS_END_DIV;
            $this->session->set_flashdata('message', $error_msg);
            redirect(site_url('Client'));
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
        $data_client = $this->mongo_db->get_where('Client', array('_id' => new \MongoId($client_idcurlang)));

        if (count($data_client) > 0) {
            $this->mongo_db->where('_id', new MongoId($client_idcurlang))->set($data)->update('Client');
            $saveactivity = $this->save_activity($this->session->userdata('alice_session')['_id'], lang('client_currency_update'), 'Client');
            $error_msg = SUCCESS_START_DIV_NEW . lang('client_currency_update') . SUCCESS_END_DIV;
            $this->session->set_flashdata('message', $error_msg);
			$result = array('status'=>true,'res'=>$error_msg);
			echo json_encode($result);
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
        $data_client = $this->mongo_db->get_where('Client', array('_id' => new \MongoId($client_idfeeoverdue)));

        if (count($data_client) > 0) {
            $this->mongo_db->where('_id', new MongoId($client_idfeeoverdue))->set($data)->update('Client');
            $saveactivity = $this->save_activity($this->session->userdata('alice_session')['_id'], lang('client_currency_update'), 'Client');
            $error_msg = SUCCESS_START_DIV_NEW . lang('ideal_key_message_edit') . SUCCESS_END_DIV;
            $this->session->set_flashdata('message', $error_msg);
            print_r($error_msg);
            die('sd');
        }

        //redirect(base_url(''));
        // }
    }

    function AddNote() {
     
            $client_id = $this->input->post('clientid');
            $notes = $this->input->post('notes');
            $data1 = array('clientid' => new \MongoId($client_id), 'notes' => $notes);
            $this->mongo_db->insert('client_notes', $data1);
            $data['notes'] = $this->mongo_db->get_where('client_notes', array('clientid' => new \MongoId($client_id)));
            // $this->load->view('Notes', $data);
			redirect(base_url('Client/View_page/').$client_id);
    }

    public function DeleteNote($id) {
        $id = new MongoId($id);
        $this->mongo_db->where(array('_id' => new \MongoId($id)))->delete('client_notes');
        echo json_encode(array('status' => 1, 'id' => $id));
    }

    public function view_page($id,$view='grid') {
        $data['pageTitle'] = lang('edit_client');
        if ($id != '') {
            $data['client'] = $this->mongo_db->get_where('Client', array('_id' => new \MongoId($id)));
		/* By dishit for reminder show*/
		$data['invoice'] = $this->mongo_db->get_where('invoices', array('client_id' => $id));
            $now   = date('m/d/Y');
          
           $show_reminders = array();
            foreach($data['invoice'] as $row)
            {
                /* if(strtotime($row['due_date']) <= strtotime('today'))
                { */
                   $diff = strtotime('today') - strtotime($row['due_date']);
                   $number_of_days = $diff/86400;
                    
                    $reminders = $this->mongo_db->get_where('send_reminder', array('invoice_id' => $row['invoice_code']));
					
					/* echo "<pre>";
					print_r($reminders);
					echo "</pre>"; */
					//die();
                    //print_r($reminders);
                      foreach ($reminders as $remind)
                        {
                               
                                $created_date=strtotime($row['created_date']);
                                $invoice_date=date('m/d/Y',$created_date);

                                if($remind['reminder_type']==1){
                                                                    $date1 = date('Y-m-d');
                                                                    $date2 = strtotime($date1);
                                                                    $date = strtotime($invoice_date);
                                                                    $after_date = strtotime("+".$remind['days']." day",$date);

                                                                    $reminder_date=date('m/d/Y', $after_date);
                                                                    strtotime($reminder_date);
																	
                                                                    if($date2 >= strtotime($reminder_date)){
																		
                                                                        $days_after_create = $date2 - strtotime($reminder_date);
                                                                        $days_after_create = $days_after_create/86400;
                                                                        $remind['invoice_date'] = $invoice_date;
                                                                         $remind['days_after_create'] = $days_after_create;
                                                                          
                                                                            array_push($show_reminders,$remind);
																			
                                                                            }
																			


                                }
                                if($remind['reminder_type']==2){


                                                                $date1 = date('Y-m-d');
                                                                    $date2 = strtotime($date1);
                                                                    $date = strtotime($invoice_date);
                                                                    $after_date = strtotime("-".$remind['days']." day",$date);

                                                                    $reminder_date=date('m/d/Y', $after_date);

                                                                    if($date2 >= strtotime($reminder_date)){

                                                                          $days_after_create = $date2 - strtotime($reminder_date);
                                                                          $days_after_create = $days_after_create/86400;
                                                                          $remind['invoice_date'] = $invoice_date;
                                                                           $remind['days_after_create'] = $days_after_create;
                                                                            //die;
                                                                            //pr($remind);
                                                                           // echo "after match data";
                                                                            array_push($show_reminders,$remind);
                                                                            }


                                 }
                                if($remind['reminder_type']==3){

                                                            $reminder_date=date('m/d/Y', strtotime($remind['days']));
                                                                    if($now >= $reminder_date){
                                                                        /* print_r($now);
                                                                        print_r($reminder_date); */
                                                                         $days_after_create = strtotime($now) - strtotime($reminder_date);
                                                                         $days_after_create = $days_after_create/86400;
                                                                         $remind['invoice_date'] = $invoice_date;
                                                                         $remind['days_after_create'] = $days_after_create;
                                                                         
                                                                            //die;
                                                                           // pr($remind);
                                                                            //echo "custom match data";
                                                                            array_push($show_reminders,$remind);
                                                                            } 

                                 }

                        }
               // }
            }
		
            sort($show_reminders);
            $data['show_reminders'] = $show_reminders;
			
		
		/* By dishit for reminder show ends*/
		
        $data['main_content'] = '/viewClient';
        $data['footerJs'][0] = base_url('uploads/assets/plugins/parsleyjs/dist/parsley.min.js');
        $data['footerJs'][1] = base_url('uploads/assets/plugins/select2/dist/js/select2.min.js');
		$data['footerJs'][7] = base_url('uploads/assets/js/filterizr/jquery.filterizr.js');
        $data['footerJs'][9] = base_url('uploads/assets/plugins/timepicker/bootstrap-timepicker.min.js');
        $data['footerJs'][3] = base_url('uploads/assets/plugins/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js');
        $data['footerJs'][4] = base_url('uploads/assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js');
        $data['footerJs'][5] = base_url('uploads/assets/plugins/bootstrap-daterangepicker/daterangepicker.js');
        $data['footerJs'][6] = base_url('uploads/assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js');
        $data['footerJs'][8] = base_url('uploads/assets/plugins/tinymce/tinymce.min.js');
        $data['footerJs'][9] = base_url('uploads/custom/invoice/recurring.js');
        $data['footerJs'][10] = base_url('uploads/custom/invoice/invoice.js');
        $data['footerJs'][11] = base_url('uploads/assets/plugins/bootstrap-sweetalert/sweet-alert.min.js');
        $data['footerJs'][12] = base_url('uploads/assets/pages/jquery.sweet-alert.init.js');
        $data['footerJs'][13] = base_url('uploads/assets/plugins/datatables/jquery.dataTables.min.js');
        $data['footerJs'][14] = base_url('uploads/assets/plugins/datatables/dataTables.responsive.min.js');
        $data['footerJs'][2] = base_url('uploads/custom/client/client.js');

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
        $data['headerCss'][10] = base_url('uploads/assets/plugins/datatables/jquery.dataTables.min.css');
        $data['headerCss'][3] = base_url('uploads/assets/css/filter.css');
        $data['headerCss'][12] = base_url('uploads/assets/plugins/select2/dist/css/select2.css');
        $data['headerCss'][13] = base_url('uploads/assets/plugins/select2/dist/css/select2-bootstrap.css');

            $data['invoices'] = $this->mongo_db->get_where('invoices', array('client_id' => $id));
            $data['client_id'] = $id;
			/* print_r($id);
			
			echo "<pre>";
			print_r($data['invoices']);
			echo "</pre>";
			die(); */
            $data['notes'] = $this->mongo_db->get_where('client_notes', array('clientid' => new \MongoId($id)));

            $data['invoiceView'] = 'ListViewInvoice';
			
            $data['view'] = $view;
            if ($this->input->is_ajax_request()) {
                $vtype = $this->input->get('view');
                if ($vtype == 'List') {
                    $data['invoiceView'] = 'ListViewInvoice';
                } else {
                    $data['invoiceView'] = 'GridViewInvoice';
                }
            } else {
                $data['invoiceView'] = 'GridViewInvoice';
            }
            $data['id'] = $id;
            $this->parser->parse('layouts/PageTemplate', $data);
            //$this->load->view('/View_page',$data);
        } else {
            exit('No Direct scripts are allowed');
        }
    }

    public function view_ajax($id) {
        $data['pageTitle'] = lang('edit_client');
        if ($id != '') {
            $data['client'] = $this->mongo_db->get_where('Client', array('_id' => new \MongoId($id)));

            $data['main_content'] = '/viewClient';
            $data['footerJs'][0] = base_url('uploads/assets/plugins/bootstrap-sweetalert/sweet-alert.min.js');
            $data['footerJs'][1] = base_url('uploads/assets/pages/jquery.sweet-alert.init.js');
            $data['footerJs'][2] = base_url('uploads/assets/plugins/datatables/jquery.dataTables.min.js');
            $data['footerJs'][3] = base_url('uploads/assets/plugins/datatables/dataTables.responsive.min.js');
			$data['footerJs'][4] = base_url('uploads/assets/js/filterizr/jquery.filterizr.js');
            $data['footerJs'][5] = base_url('uploads/custom/client/client.js');
            $data['headerCss'][0] = base_url('uploads/assets/plugins/bootstrap-sweetalert/sweet-alert.css');
            $data['headerCss'][1] = base_url('uploads/assets/plugins/datatables/jquery.dataTables.min.css');
            $data['headerCss'][2] = base_url('uploads/custom/Developer.css');
			$data['headerCss'][3] = base_url('uploads/assets/css/filter.css');
            $data['footerJs'][6] = base_url('uploads/assets/plugins/parsleyjs/dist/parsley.min.js');
            $data['invoices'] = $this->mongo_db->get_where('invoices', array('client_id' => $id));
            $data['invoiceView'] = 'ListViewInvoice';
            if ($this->input->is_ajax_request()) {
                $vtype = $this->input->get('view');
                if ($vtype == 'List') {
                    $data['invoiceView'] = 'ListViewInvoice';
                } else {
                    $data['invoiceView'] = 'GridViewInvoice';
                }
            } else {
                $data['invoiceView'] = 'GridViewInvoice';
            }
            $data['id'] = $id;
            // $this->parser->parse('layouts/PageTemplate', $data);
            $this->load->view($data['invoiceView'], $data);
        } else {
            exit('No Direct scripts are allowed');
        }
    }

}

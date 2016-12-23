<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class EmailTemplates extends Public_controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('upload');
        $this->load->library('mongo_db', array('activate' => 'default'), 'mongo_db');
        $this->module = $this->router->fetch_class();
        $this->viewname = $this->router->fetch_class();
    }

    public function index() {
        $data['main_content'] = '/index';
        $data['pageTitle'] = lang('emailTemplate_list');

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
        $url = base_url('Project?start_rows=' . $currentPage);
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
            '#collection' => 'email_templates',
            '#select' => array('_id', 'template_title', 'subject', 'variables', 'body', 'created_date'),
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
            $parseParam['#find'] = array('template_title' => $filteredSearch);
        }
        $pagination->setParameters($parseParam, $currentPage, $itemsPerPage);

        $dataSet = $pagination->Paginate();
        $result = $dataSet['dataset'];
        $data['pagination']['totalPages'] = $dataSet['totalPages'];
        $data['pagination']['totalItems'] = $dataSet['totalItems'];
        $data['pagination']['links'] = $pagination->getPageLinks();
        $data['dataset'] = $result; //$this->mongo_db->get('Client');
        //$this->mongo_db->explain();
        //  $data['clients']=$this->mongo_db->get('Client');
        $data['footerJs'][0] = base_url('uploads/assets/plugins/bootstrap-sweetalert/sweet-alert.min.js');
        $data['footerJs'][1] = base_url('assets/pages/jquery.sweet-alert.init.js');
        $data['footerJs'][2] = base_url('uploads/custom/emailtemplate/emailtemplate.js');
        $data['headerCss'][0] = base_url('uploads/assets/plugins/bootstrap-sweetalert/sweet-alert.css');
        $data['headerCss'][1] = base_url('uploads/custom/Developer.css');
        $data['url'] = $url;

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

    public function Add() {

        $data['pageTitle'] = lang('create_project');
        $data['main_content'] = '/Add';
        $data['clients'] = $this->mongo_db->get('email_templates');
        $data['footerJs'][0] = base_url('uploads/assets/plugins/parsleyjs/dist/parsley.min.js');
        $data['footerJs'][1] = base_url('uploads/assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js');
        $data['footerJs'][2] = base_url('uploads/custom/emailtemplate/emailtemplate.js');
        $data['footerJs'][3] = base_url('uploads/assets/plugins/select2/dist/js/select2.min.js');
        $data['footerJs'][4] = base_url('uploads/assets/plugins/tinymce/tinymce.min.js');

        $data['headerCss'][0] = base_url('uploads/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css');
        $data['headerCss'][1] = base_url('uploads/assets/plugins/select2/dist/css/select2.css');
        $data['headerCss'][2] = base_url('uploads/assets/plugins/select2/dist/css/select2-bootstrap.css');

        $this->parser->parse('layouts/PageTemplate', $data);
    }
    
    
    public function AddEmailTemplates() {

        $data['pageTitle'] = 'Add Email Template';
            $data['main_content'] = '/AddEmailTemplates';
            $data['footerJs'][0] = base_url('uploads/assets/plugins/parsleyjs/dist/parsley.min.js');
            $data['footerJs'][1] = base_url('uploads/assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js');
            $data['footerJs'][2] = base_url('uploads/custom/emailtemplate/emailtemplate.js');
            $data['footerJs'][3] = base_url('uploads/assets/plugins/select2/dist/js/select2.min.js');
            $data['footerJs'][4] = base_url('uploads/assets/plugins/tinymce/tinymce.min.js');
            $data['headerCss'][0] = base_url('uploads/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css');
            $data['headerCss'][1] = base_url('uploads/assets/plugins/select2/dist/css/select2.css');
            $data['headerCss'][2] = base_url('uploads/assets/plugins/select2/dist/css/select2-bootstrap.css');

            $this->parser->parse('layouts/PageTemplate', $data);
        
    }
    

    public function Edit($id) {

        $data['pageTitle'] = lang('emailTemplate_header_update');
        if ($id != '') {
            $data['email'] = $this->mongo_db->get_where('email_templates', array('_id' => new \MongoId($id)));
            $data['main_content'] = '/Edit';
            $data['footerJs'][0] = base_url('uploads/assets/plugins/parsleyjs/dist/parsley.min.js');
            $data['footerJs'][1] = base_url('uploads/assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js');
            $data['footerJs'][2] = base_url('uploads/custom/emailtemplate/emailtemplate.js');
            $data['footerJs'][3] = base_url('uploads/assets/plugins/select2/dist/js/select2.min.js');
            $data['footerJs'][4] = base_url('uploads/assets/plugins/tinymce/tinymce.min.js');
            $data['headerCss'][0] = base_url('uploads/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css');
            $data['headerCss'][1] = base_url('uploads/assets/plugins/select2/dist/css/select2.css');
            $data['headerCss'][2] = base_url('uploads/assets/plugins/select2/dist/css/select2-bootstrap.css');

            $this->parser->parse('layouts/PageTemplate', $data);
        } else {
            redirect(base_url('EmailTemplate'));
        }
    }

    public function InsertData() {


        $this->load->library('form_validation');

        $this->form_validation->set_error_delimiters(ERROR_START_DIV_NEW, ERROR_END_DIV);
        $this->form_validation->set_rules('projectname', 'projectname', 'trim|required');
        $this->form_validation->set_rules('clientid', 'clientid', 'trim|required');
        $this->form_validation->set_rules('startdate', 'startdate', 'trim|required');
        $this->form_validation->set_rules('duedate', 'duedate', 'trim|required');
        //$this->form_validation->set_rules('password', 'Password', 'trim|required|callback_check_database');

        if ($this->form_validation->run() == FALSE) {
            $error_msg = validation_errors();
            $this->session->set_flashdata('error', $error_msg);
            redirect(site_url('Project/Add'));
            //Field validation failed.  User redirected to login page
        } else {
            // $files = $_FILES;
            $data = array('projectname' => $this->input->post('projectname'),
                'clientid' => $this->input->post('clientid'),
                'startdate' => $this->input->post('startdate'),
                'duedate' => $this->input->post('duedate'),
                'description' => $this->input->post('description'),
                'hourlyprice' => $this->input->post('hourlyprice'),
                'fixedprojectprice' => $this->input->post('fixedprojectprice'),
                'created_at' => date('Y-m-d h:i:s'),
                'created_by' => $this->session->userdata('alice_session')['_id'],
            );
            $this->mongo_db->insert('project_master', $data);
            $error_msg = SUCCESS_START_DIV_NEW . str_replace('{pname}', $this->input->post('projectname'), lang('project_create_msg')) . SUCCESS_END_DIV;
            $this->session->set_flashdata('message', $error_msg);
            redirect(base_url('Project'));
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
        $this->form_validation->set_rules('projectname', 'projectname', 'trim|required');
        $this->form_validation->set_rules('clientid', 'clientid', 'trim|required');
        $this->form_validation->set_rules('startdate', 'startdate', 'trim|required');
        $this->form_validation->set_rules('duedate', 'duedate', 'trim|required');
        //$this->form_validation->set_rules('password', 'Password', 'trim|required|callback_check_database');

  // '#select' => array('_id', 'template_title', 'subject', 'variables', 'body', 'created_date'),

        if ($this->form_validation->run() == FALSE) {
            $error_msg = ERROR_START_DIV_NEW . lang('common_error_form_submit') . ERROR_END_DIV;
            $this->session->set_flashdata('error', $error_msg);
            //Field validation failed.  User redirected to login page
            //$error_array = validation_errors();
            redirect($this->viewname);
        } else {
            // $files = $_FILES;
            $data = array('template_title' => $this->input->post('template_title'),
                'subject' => $this->input->post('subject'),
                'startdate' => $this->input->post('startdate'),
                'body' => $this->input->post('body'),
                'updated_date' => date('Y-m-d h:i:s'),
            );
            $this->mongo_db->where('_id', new MongoId($id))->set($data)->update('project_master');

            $error_msg = SUCCESS_START_DIV_NEW . lang('project_update_msg') . SUCCESS_END_DIV;
            $this->session->set_flashdata('message', $error_msg);
            redirect(site_url('EmailTemplates'));
        }
    }
    
    public function InsertEmailTemplate() {

        $this->load->library('form_validation');
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $this->form_validation->set_error_delimiters(ERROR_START_DIV_NEW, ERROR_END_DIV);
        $this->form_validation->set_rules('projectname', 'projectname', 'trim|required');
        $this->form_validation->set_rules('clientid', 'clientid', 'trim|required');
        $this->form_validation->set_rules('startdate', 'startdate', 'trim|required');
        $this->form_validation->set_rules('duedate', 'duedate', 'trim|required');
        //$this->form_validation->set_rules('password', 'Password', 'trim|required|callback_check_database');

  // '#select' => array('_id', 'template_title', 'subject', 'variables', 'body', 'created_date'),

        if ($this->form_validation->run() == FALSE) {
            $error_msg = ERROR_START_DIV_NEW . lang('common_error_form_submit') . ERROR_END_DIV;
            $this->session->set_flashdata('error', $error_msg);
            //Field validation failed.  User redirected to login page
            //$error_array = validation_errors();
            redirect($this->viewname);
        } else {
            // $files = $_FILES;
            $data = array('template_title' => $this->input->post('template_title'),
                'subject' => $this->input->post('subject'),
                'startdate' => $this->input->post('startdate'),
                'body' => $this->input->post('body'),
                'updated_date' => date('Y-m-d h:i:s'),
            );
            
            $this->mongo_db->insert('email_templates', $data);
            
            $error_msg = SUCCESS_START_DIV_NEW . lang('project_update_msg') . SUCCESS_END_DIV;
            $this->session->set_flashdata('message', $error_msg);
            redirect(site_url('EmailTemplates'));
        }
    }

}

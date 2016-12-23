<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Currency extends Public_controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('upload');
        $this->load->library('mongo_db', array('activate' => 'default'), 'mongo_db');
        $this->module = $this->router->fetch_class();
        $this->viewname = $this->router->fetch_class();
    }

    public function index() {

        $data['main_content'] = '/index';
        $data['pageTitle'] = lang('currency');

        /*get country data

        $this->load->database();
        $this->load->model('common_model');
        //$parameters['total_rows']=
        //Pagination Sample code
        $table = 'countryinfo as pro';
        $fields = array("pro.name,pro.capital,pro.currency_code,pro.currency_name,pro.currrency_symbol");
        $client_info = $this->common_model->get_records($table, $fields, '', '', '');

        foreach ($client_info as $country){
            $data = array('country_name' => $country['name'],
                'capital' => $country['capital'],
                'currency_code' => $country['currency_code'],
                'currency_name' => $country['currency_name'],
                'currrency_symbol' => $country['currrency_symbol'],
            );

            $this->mongo_db->insert('country', $data);
        }

*/
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
        $url = base_url('Tax?start_rows=' . $currentPage);
        $pagination = new MongoPagination($this->mongo_db, $parameters);
        $parseParam = array(
            '#collection' => 'country',
            '#select' => array('_id', 'country_name', 'capital','currency_code','currency_name','currrency_symbol'),
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
            $parseParam['#find'] = array('company' => $filteredSearch);
        }
        $pagination->setParameters($parseParam, $currentPage, $itemsPerPage);

        $dataSet = $pagination->Paginate();
        $result = $dataSet['dataset'];
        $data['pagination']['totalPages'] = $dataSet['totalPages'];
        $data['pagination']['totalItems'] = $dataSet['totalItems'];
        $data['pagination']['links'] = $pagination->getPageLinks();
        $data['currency'] = $result;

        $data['footerJs'][0] = base_url('uploads/assets/plugins/bootstrap-sweetalert/sweet-alert.min.js');
        $data['footerJs'][1] = base_url('assets/pages/jquery.sweet-alert.init.js');
        $data['footerJs'][2] = base_url('uploads/custom/client/client.js');
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
        $data['pageTitle'] = lang('tax');
        $data['tax'] = $this->mongo_db->get('tax');
        $data['footerJs'][0] = base_url('uploads/assets/plugins/bootstrap-sweetalert/sweet-alert.min.js');
        $data['footerJs'][1] = base_url('assets/pages/jquery.sweet-alert.init.js');
        $data['footerJs'][2] = base_url('uploads/custom/client/client.js');
        $data['headerCss'][0] = base_url('uploads/assets/plugins/bootstrap-sweetalert/sweet-alert.css');
        $data['headerCss'][1] = base_url('uploads/custom/Developer.css');
        $this->parser->parse('layouts/PageTemplate', $data);
    }

    public function Add() {

        $data['pageTitle'] = lang('create_tax');
        $data['main_content'] = '/AddTax';
        $data['footerJs'][0] = base_url('uploads/assets/plugins/parsleyjs/dist/parsley.min.js');
        $data['footerJs'][1] = base_url('uploads/custom/client/client.js');

        $this->parser->parse('layouts/PageTemplate', $data);
    }

    public function Edit($id) {

        $data['pageTitle'] = lang('edit_tax');
        if ($id != '') {
            $data['taxs'] = $this->mongo_db->get_where('Tax', array('_id' => new \MongoId($id)));

            $data['main_content'] = '/EditTax';
            $data['footerJs'][0] = base_url('uploads/assets/plugins/parsleyjs/dist/parsley.min.js');
            $data['footerJs'][1] = base_url('uploads/custom/client/client.js');

            $this->parser->parse('layouts/PageTemplate', $data);
        } else {
            redirect(base_url('Tax'));
        }
    }

    public function InsertData() {


        $this->load->library('form_validation');
        $tax_name = $this->input->post('tax_name');
        $tax = $this->input->post('tax');
        $this->form_validation->set_error_delimiters(ERROR_START_DIV_NEW, ERROR_END_DIV);
        $this->form_validation->set_rules('tax_name', 'tax_name', 'trim|required');
        $this->form_validation->set_rules('tax', 'tax', 'trim|required');
        //$this->form_validation->set_rules('password', 'Password', 'trim|required|callback_check_database');



        if ($this->form_validation->run() == FALSE) {
            $error_msg = validation_errors();
            $this->session->set_flashdata('error', $error_msg);
            redirect(site_url('Tax/Add'));
            //Field validation failed.  User redirected to login page
        } else {
            $data = array('tax_name' => $this->input->post('tax_name'),
                'tax' => $this->input->post('tax'),
                'created_at' => date('Y-m-d h:i:s'),
            );
            $this->mongo_db->insert('Tax', $data);
            $error_msg = SUCCESS_START_DIV_NEW . lang('account_add_msg') . SUCCESS_END_DIV;
            $this->session->set_flashdata('message', $error_msg);
            redirect(base_url('Tax'));
        }
    }

    public function Delete($id) {
        $id = new MongoId($id);
        $this->mongo_db->where(array('_id' => $id))->delete('Tax');
        $error_msg = SUCCESS_START_DIV_NEW . lang('account_del_msg') . SUCCESS_END_DIV;
        $this->session->set_flashdata('message', $error_msg);
        redirect(site_url('Tax'));
    }

    public function UpdateData() {

        $id = $this->input->post('_id');
        $this->load->library('form_validation');
        $tax_name = $this->input->post('tax_name');
        $tax = $this->input->post('tax');
        $this->form_validation->set_error_delimiters(ERROR_START_DIV_NEW, ERROR_END_DIV);
        $this->form_validation->set_rules('tax_name', 'tax_name', 'trim|required');
        $this->form_validation->set_rules('tax', 'tax', 'trim|required');


        if ($this->form_validation->run() == FALSE) {
            $error_msg = ERROR_START_DIV_NEW . lang('common_error_form_submit') . ERROR_END_DIV;
            $this->session->set_flashdata('error', $error_msg);
            //Field validation failed.  User redirected to login page
            //$error_array = validation_errors();
            redirect($this->viewname);
        } else {
            // $files = $_FILES;
            $data = array('tax_name' => $this->input->post('tax_name'),
                'tax' => $this->input->post('tax'),
                'updated_at' => date('Y-m-d h:i:s'),
            );
            $this->mongo_db->where('_id', new MongoId($id))->set($data)->update('Tax');

            $error_msg = SUCCESS_START_DIV_NEW . lang('account_update_msg') . SUCCESS_END_DIV;
            $this->session->set_flashdata('message', $error_msg);
            redirect(site_url('Tax'));
        }
    }
}

<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends Public_controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('upload');
        $this->load->library('mongo_db', array('activate' => 'default'), 'mongo_db');
        $this->module = $this->router->fetch_class();
        $this->viewname = $this->router->fetch_class();
    }

    public function index() {

        $data['main_content'] = '/index';
        $data['pageTitle'] = lang('categories');
        $data['dataset'] = $this->mongo_db->get('category_master');
        $data['footerJs'][0] = base_url('uploads/assets/plugins/bootstrap-sweetalert/sweet-alert.min.js');
        $data['footerJs'][1] = base_url('assets/pages/jquery.sweet-alert.init.js');
        $data['footerJs'][4] = base_url('uploads/custom/category/category.js');
        $data['footerJs'][2] = base_url('uploads/assets/plugins/datatables/jquery.dataTables.min.js');
        $data['footerJs'][3] = base_url('uploads/assets/plugins/datatables/dataTables.responsive.min.js');
        $data['headerCss'][0] = base_url('uploads/assets/plugins/bootstrap-sweetalert/sweet-alert.css');
        $data['headerCss'][2] = base_url('uploads/assets/plugins/datatables/jquery.dataTables.min.css');

        $data['headerCss'][1] = base_url('uploads/custom/Developer.css');
        $this->parser->parse('layouts/PageTemplate', $data);
    }

    public function Add() {

        $data['pageTitle'] = lang('add_category');
        $data['main_content'] = '/Add';
        $data['footerJs'][0] = base_url('uploads/assets/plugins/parsleyjs/dist/parsley.min.js');
        $data['footerJs'][1] = base_url('uploads/custom/category/category.js');

        $this->parser->parse('layouts/PageTemplate', $data);
    }

    public function Edit($id) {

        $data['pageTitle'] = lang('edit_category');
        if ($id != '') {
            $data['dataset'] = $this->mongo_db->get_where('category_master', array('_id' => new \MongoId($id)));

            $data['main_content'] = '/Edit';
            $data['footerJs'][0] = base_url('uploads/assets/plugins/parsleyjs/dist/parsley.min.js');
            $data['footerJs'][1] = base_url('uploads/custom/category/category.js');

            $this->parser->parse('layouts/PageTemplate', $data);
        } else {
            redirect(base_url('Category'));
        }
    }

    public function InsertData() {


        $this->load->library('form_validation');

        $this->form_validation->set_error_delimiters(ERROR_START_DIV_NEW, ERROR_END_DIV);
        $this->form_validation->set_rules('categoryname', 'categoryname', 'trim|required');
        // $this->form_validation->set_rules('company', 'company', 'trim|required');
        //$this->form_validation->set_rules('password', 'Password', 'trim|required|callback_check_database');

        if ($this->form_validation->run() == FALSE) {
            $error_msg = validation_errors();
            $this->session->set_flashdata('error', $error_msg);
            redirect(site_url('Category/Add'));
            //Field validation failed.  User redirected to login page
        } else {

            $data = array('categoryname' => $this->input->post('categoryname'),
                'created_at' => date('Y-m-d h:i:s'),
                'is_deleted' => 0,
                'created_by' => $this->session->userdata('alice_session')['_id'],
            );
            if ($this->mongo_db->insert('category_master', $data)) {
                
            }
            $error_msg = SUCCESS_START_DIV_NEW . lang('category_add_msg') . SUCCESS_END_DIV;
            $this->session->set_flashdata('message', $error_msg);
            redirect(base_url('Category'));
        }
    }

    public function Delete($id) {

        //$this->mongo_db->where(array('_id' => $id))->delete('User');
        $this->mongo_db->where('_id', new MongoId($id))->set(array('is_deleted' => 1))->update('category_master');
        $error_msg = SUCCESS_START_DIV_NEW . lang('category_del_msg') . SUCCESS_END_DIV;
        $this->session->set_flashdata('message', $error_msg);
        redirect(base_url('Category'));
    }

    public function UpdateData() {

        $id = $this->input->post('_id');

        $this->load->library('form_validation');

        $this->form_validation->set_error_delimiters(ERROR_START_DIV_NEW, ERROR_END_DIV);
        $this->form_validation->set_rules('categoryname', 'categoryname', 'trim|required');

        if ($this->form_validation->run() == FALSE) {

            $this->session->set_flashdata('error', alidation_errors());
            //Field validation failed.  User redirected to login page
            //$error_array = validation_errors();
            redirect('Category/Edit/' . $id);
        } else {
            // $files = $_FILES;
            $data = array('categoryname' => $this->input->post('categoryname'),
                'updated_at' => date('Y-m-d h:i:s'),
                'updated_by' => $this->session->userdata('alice_session')['_id'],
            );

            $this->mongo_db->where('_id', new MongoId($id))->set($data)->update('category_master');

            $error_msg = SUCCESS_START_DIV_NEW . lang('category_update_msg') . SUCCESS_END_DIV;
            $this->session->set_flashdata('message', $error_msg);
            redirect(base_url('Category'));
        }
    }

    function test() {
        $this->load->library('email');

        $subject = 'This is a test';
        $message = '<p>This message has been sent for testing purposes.</p>';

// Get full html:
        $body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=' . strtolower(config_item('charset')) . '" />
    <title>' . html_escape($subject) . '</title>
    <style type="text/css">
        body {
            font-family: Arial, Verdana, Helvetica, sans-serif;
            font-size: 16px;
        }
    </style>
</head>
<body>
' . $message . '
</body>
</html>';
// Also, for getting full html you may use the following internal method:
//$body = $this->email->full_html($subject, $message);

        $result = $this->email
                ->from('mactest@gmail.com')
                // ->reply_to('moulik2007dec@gmail.com')    // Optional, an account where a human being reads.
                ->to('moulik2007dec@gmail.com')
                ->subject($subject)
                ->message($body)
                ->send();

        var_dump($result);
        echo '<br />';
        echo $this->email->print_debugger();
        exit;
    }

}

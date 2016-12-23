<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class TeamMember extends Public_controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('upload');
        $this->load->library('mongo_db', array('activate' => 'default'), 'mongo_db');
        $this->module = $this->router->fetch_class();
        $this->viewname = $this->router->fetch_class();
    }

    public function index() {
        $data['main_content'] = '/index';
        $data['pageTitle'] = lang('teammembers');

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
        $url = base_url('TeamMember?start_rows=' . $currentPage);
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
            '#collection' => 'User',
            '#select' => array('_id', 'firstname', 'lastname', 'email', 'user_role', 'contact_no', 'created_at'),
            '#find' => array('user_role' => 1),
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
            $parseParam['#find'] = array('email' => $filteredSearch);
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
        $data['footerJs'][2] = base_url('uploads/assets/plugins/datatables/jquery.dataTables.min.js');
        $data['footerJs'][3] = base_url('uploads/assets/plugins/datatables/dataTables.responsive.min.js');
        $data['footerJs'][4] = base_url('uploads/custom/teammember/teammember.js');
        $data['headerCss'][0] = base_url('uploads/assets/plugins/bootstrap-sweetalert/sweet-alert.css');
        $data['headerCss'][1] = base_url('uploads/assets/plugins/datatables/jquery.dataTables.min.css');
        $data['headerCss'][2] = base_url('uploads/custom/Developer.css');
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
        //  pr($parameters);// 'firstname', 'lastname', 'email', 'password', 'user_role', 'contact_no','created_at','company_id
//     /   echo $currentPage;
        $pagination = new MongoPagination($this->mongo_db, $parameters);
        $parseParam = array(
            '#collection' => 'User',
            '#select' => array('_id', 'firstname', 'lastname', 'email', 'user_role', 'contact_no', 'created_at'),
            '#find' => array('user_role' => 1),
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
            $parseParam['#find'] = array('email' => $filteredSearch);
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
        $data['footerJs'][2] = base_url('uploads/custom/teammember/teammember.js');
        $data['headerCss'][0] = base_url('uploads/assets/plugins/bootstrap-sweetalert/sweet-alert.css');
        $data['headerCss'][1] = base_url('uploads/custom/Developer.css');
        $data['url'] = $url;

        if ($this->input->is_ajax_request()) {

            $this->load->view('GridView', $data);
        }
    }

    public function Add() {

        $data['pageTitle'] = lang('add_team_member');
        $data['main_content'] = '/Add';
        $data['footerJs'][0] = base_url('uploads/assets/plugins/parsleyjs/dist/parsley.min.js');
        $data['footerJs'][1] = base_url('uploads/custom/teammember/teammember.js');

        $this->parser->parse('layouts/PageTemplate', $data);
    }

    public function Edit($id) {

        $data['pageTitle'] = lang('edit_team_member');
        if ($id != '') {
            $data['dataset'] = $this->mongo_db->get_where('User', array('_id' => new \MongoId($id)));

            $data['main_content'] = '/Edit';
            $data['footerJs'][0] = base_url('uploads/assets/plugins/parsleyjs/dist/parsley.min.js');
            $data['footerJs'][1] = base_url('uploads/custom/teammember/teammember.js');

            $this->parser->parse('layouts/PageTemplate', $data);
        } else {
            redirect(base_url('TeamMember'));
        }
    }
    
    public function view_page($id)
    {
        $data['pageTitle'] = lang('edit_team_member');
        if ($id != '') {
                    $data['dataset'] = $this->mongo_db->get_where('User', array('_id' => new \MongoId($id)));

            $data['main_content'] = '/Edit';
            $data['footerJs'][0] = base_url('uploads/assets/plugins/parsleyjs/dist/parsley.min.js');
            $data['footerJs'][1] = base_url('uploads/custom/teammember/teammember.js');


            $data['id'] = $id;
        $data['main_content'] = '/View_page';
        $this->load->view('/View_page',$data);
        
        //    $this->parser->parse('layouts/PageTemplate', $data);
        } else {
            exit('No Direct scripts are allowed');
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
        // $this->form_validation->set_rules('company', 'company', 'trim|required');
        //$this->form_validation->set_rules('password', 'Password', 'trim|required|callback_check_database');



        if ($this->form_validation->run() == FALSE) {
            $error_msg = validation_errors();
            $this->session->set_flashdata('error', $error_msg);
            redirect(site_url('TeamMember/Add'));
            //Field validation failed.  User redirected to login page
        } else {
            $fileName = '';
            $config = array();
            if (isset($_FILES['profile_image']) && $_FILES['profile_image']['name'][0]!='') {
				
                $uploadPath = FCPATH . '\uploads\profile_image\\';
                if (!is_dir($uploadPath)) {
                    mkdir($uploadPath, 777);
                }
                $config['upload_path'] = FCPATH . '\uploads\profile_image\\'; //give the path to upload the image in folder
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size'] = '0';
                $config['overwrite'] = FALSE;

                $this->upload->initialize($config);
                //  $imgs = $this->upload->do_upload();
                if ($this->upload->do_upload('profile_image')) {
                    $FileDataArr[] = $this->upload->data();
                    $fileName = $FileDataArr[0]['file_name'];
                } else {
                    // echo  $CI->upload->display_errors();
                    // die;
                    $this->session->set_flashdata('message', "<div class='alert alert-danger text-center'>" . $this->upload->display_errors() . "</div>");
                    redirect($redirect);
                    die;
                }
//                }
            }

            // 'firstname', 'lastname', 'email', 'password', 'user_role', 'contact_no','created_at','company_id
            // $files = $_FILES;
            $data = array('firstname' => $this->input->post('firstname'),
                'lastname' => $this->input->post('lastname'),
                'company_id' => $this->session->userdata('alice_session')['_id'],
                'email' => $this->input->post('email'),
                'contact_no' => $this->input->post('contact_no'),
                'password' => md5($this->input->post('password')),
                'profile_picture' => $fileName,
                'user_role' => 1,
                'created_at' => date('Y-m-d h:i:s'),
                'is_deleted' => 0,
                'created_by' => $this->session->userdata('alice_session')['_id'],
            );
            if ($this->mongo_db->insert('User', $data)) {
            }
            $error_msg = SUCCESS_START_DIV_NEW . lang('account_add_msg') . SUCCESS_END_DIV;
            $this->session->set_flashdata('message', $error_msg);
            redirect(base_url('TeamMember'));
        }

    }

    public function Delete($id) {
        $id = new MongoId($id);
        //$this->mongo_db->where(array('_id' => $id))->delete('User');
        $this->mongo_db->where('_id', new MongoId($id))->set(array('is_deleted' => 1))->update('User');
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



        if ($this->form_validation->run() == FALSE) {
            $error_msg = ERROR_START_DIV_NEW . validation_errors() . ERROR_END_DIV;
            $this->session->set_flashdata('error', $error_msg);
            //Field validation failed.  User redirected to login page
            //$error_array = validation_errors();
            redirect($this->viewname);
        } else {
            // $files = $_FILES;
            $data = array('firstname' => $this->input->post('firstname'),
                'lastname' => $this->input->post('lastname'),
                'company_id' => $this->session->userdata('alice_session')['_id'],
                'email' => $this->input->post('email'),
                'contact_no' => $this->input->post('contact_no'),
                'updated_at' => date('Y-m-d h:i:s'),
                'updated_by' => $this->session->userdata('alice_session')['_id'],
            );
            $fileName = '';
            $config = array();
            if (isset($_FILES['profile_image']) && count($_FILES['profile_image']['name']) > 0) {
                $uploadPath = FCPATH . '\uploads\profile_image\\';
                if (!is_dir($uploadPath)) {
                    mkdir($uploadPath, 777);
                }
                $config['upload_path'] = FCPATH . '\uploads\profile_image\\'; //give the path to upload the image in folder
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size'] = '0';
                $config['overwrite'] = FALSE;

                $this->upload->initialize($config);
                //  $imgs = $this->upload->do_upload();
                if ($this->upload->do_upload('profile_image')) {
                    $FileDataArr[] = $this->upload->data();
                     $this->config->item('profile_image_path').$this->input->post('old_image');
                    
                    $this->unset_image($this->config->item('profile_image_root_url').$this->input->post('old_image'));
                    $fileName = $FileDataArr[0]['file_name'];
                } else {
                    // echo  $CI->upload->display_errors();
                    // die;
                    $this->session->set_flashdata('message', "<div class='alert alert-danger text-center'>" . $this->upload->display_errors() . "</div>");
                    redirect($redirect);
                    die;
                }


//                }
            }


            if ($this->input->post('password') != '') {
                $data['password'] = md5($this->input->post('password'));
            }
            if ($fileName != '') {
                $data['profile_picture'] = $fileName;
            }
           
            $this->mongo_db->where('_id', new MongoId($id))->set($data)->update('User');

            $error_msg = SUCCESS_START_DIV_NEW . lang('teammember_update_msg') . SUCCESS_END_DIV;
            $this->session->set_flashdata('message', $error_msg);
            redirect(base_url('TeamMember'));
        }
    }
    function unset_image($path)
    {
        unset($path);
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

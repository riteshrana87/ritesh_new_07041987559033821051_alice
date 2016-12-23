<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class project extends Public_controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('upload');
        $this->load->library('mongo_db', array('activate' => 'default'), 'mongo_db');
        $this->module = $this->router->fetch_class();
        $this->viewname = $this->router->fetch_class();
        $this->userId = $this->session->userdata('alice_session')['_id'];
    }

    public function index($view='grid') {
        $data['main_content'] = '/index';
        $data['pageTitle'] = lang('projects');
        $data['viewType'] = 'Active';
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
            '#collection' => 'project_master',
            '#select' => array('_id', 'projectname', 'clientid', 'hourlyprice', 'fixedprojectprice', 'created_at', 'duedate', 'project_status'),
            '#find' => array('is_deleted' => 0),
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
            $parseParam['#find'] = array('projectname' => $filteredSearch);
        }
        $pagination->setParameters($parseParam, $currentPage, $itemsPerPage);

        $dataSet = $pagination->Paginate();
        $result = $dataSet['dataset'];
        $dataSet['dataset']=$this->mongo_db->get('project_master');
        $data['pagination']['totalPages'] = $dataSet['totalPages'];
        $data['pagination']['totalItems'] = $dataSet['totalItems'];
        $data['pagination']['links'] = $pagination->getPageLinks();

        $data['dataset'] = $this->mongo_db->get('project_master');
        $data['dataset'] = $this->mongo_db->where(array('is_deleted'=>0))->get('project_master');
        //$this->mongo_db->explain();
        //  $data['clients']=$this->mongo_db->get('Client');
        $data['footerJs'][0] = base_url('uploads/assets/plugins/bootstrap-sweetalert/sweet-alert.min.js');
        $data['footerJs'][1] = base_url('assets/pages/jquery.sweet-alert.init.js');
        $data['footerJs'][2] = base_url('uploads/assets/plugins/datatables/jquery.dataTables.min.js');
        $data['footerJs'][3] = base_url('uploads/assets/plugins/datatables/dataTables.responsive.min.js');
        $data['footerJs'][4] = base_url('uploads/assets/js/filterizr/jquery.filterizr.js');
        $data['footerJs'][5] = base_url('uploads/custom/project/project.js');
        $data['headerCss'][0] = base_url('uploads/assets/plugins/bootstrap-sweetalert/sweet-alert.css');
        $data['headerCss'][1] = base_url('uploads/assets/plugins/datatables/jquery.dataTables.min.css');
        $data['headerCss'][2] = base_url('uploads/assets/css/filter.css');
        $data['headerCss'][3] = base_url('uploads/custom/Developer.css');
        $data['url'] = $url;

        /*
         * project counts with status
         */
        $planned_count = 0;
        $inprogress_count = 0;
        $onhold_count = 0;
        $overdue_count = 0;
        $completed_count = 0;
        $allProjects = array();
         $data['planned_count'] = $planned_count;
            $data['inprogress_count'] = $inprogress_count;
            $data['onhold_count'] = $onhold_count;
            $data['overdue_count'] = $overdue_count;
            $data['completed_count'] = $completed_count;

        if (count($data['dataset']) > 0) {
			
            foreach ($data['dataset'] as $proj) {
			
                $data['planned_count'] = $count = $this->mongo_db->where(array('status' => 0, 'projectid' => new \MongoId($proj['_id'])))->count('task_master');
                $data['inprogress_count'] = $count = $this->mongo_db->where(array('status' => 1, 'projectid' => new \MongoId($proj['_id'])))->count('task_master');
                $data['onhold_count'] = $count = $this->mongo_db->where(array('status' => 2, 'projectid' => new \MongoId($proj['_id'])))->count('task_master');
                $data['overdue_count'] = $count = $this->mongo_db->where(array('status' => 4, 'projectid' => new \MongoId($proj['_id'])))->count('task_master');
                $data['completed_count'] = $count = $this->mongo_db->where(array('status' => 3, 'projectid' => new \MongoId($proj['_id'])))->count('task_master');
                
                $data['all_tasks'] = $count = $this->mongo_db->where(array('projectid' => new \MongoId($proj['_id'])))->count('task_master');
/* removed because of conflict
                if ($data['planned_count'] > 0 && $data['inprogress_count'] == 0 && $data['onhold_count'] == 0 && $data['overdue_count'] == 0 && $data['completed_count'] == 0) {
                    $planned_count = $planned_count + 1;
                    $proj['status'] = 'Planned';
                    $proj['status_count'] = $planned_count;
                } else if ($data['inprogress_count'] > 0 && $data['onhold_count'] == 0 && $data['overdue_count'] == 0 && $data['completed_count'] == 0) {
                    $inprogress_count = $inprogress_count + 1;
                    $proj['status'] = 'inprogress';
                    $proj['status_count'] = $inprogress_count;
                    $allProjects[] = $proj;
                } else if ($data['onhold_count'] > 0 && $data['overdue_count'] == 0) {
                    $onhold_count = $onhold_count + 1;
                    $proj['status'] = 'OnHold';
                    $proj['status_count'] = $onhold_count;
                    $allProjects[] = $proj;
                } else if ($data['overdue_count'] > 0) {
                    $overdue_count = $overdue_count + 1;
                    $proj['status'] = 'Overdue';
                    $proj['status_count'] = $overdue_count;
                    $allProjects[] = $proj;
                } else if ($data['completed_count'] == $data['all_tasks']) {
                    $completed_count = $completed_count + 1;
                    $proj['status'] = 'Completed';
                    $proj['status_count'] = $completed_count;

*/
                    if ($data['all_tasks'] > 0) {
                    if ($data['planned_count'] > 0 && $data['inprogress_count'] == 0 && $data['onhold_count'] == 0 && $data['overdue_count'] == 0 && $data['completed_count'] == 0) {
                        $planned_count = $planned_count + 1;
                        $proj['status'] = 'Planned';
                        $proj['status_count'] = $planned_count;
                        $allProjects[] = $proj;
                    } else if ($data['inprogress_count'] > 0 && $data['onhold_count'] == 0 && $data['overdue_count'] == 0 && $data['completed_count'] == 0) {
                        $inprogress_count = $inprogress_count + 1;
                        $proj['status'] = 'inprogress';
                        $proj['status_count'] = $inprogress_count;
                        $allProjects[] = $proj;
                    } else if ($data['onhold_count'] > 0 && $data['overdue_count'] == 0) {
                        $onhold_count = $onhold_count + 1;
                        $proj['status'] = 'OnHold';
                        $proj['status_count'] = $onhold_count;
                        $allProjects[] = $proj;
                    } else if ($data['overdue_count'] > 0) {
                        $overdue_count = $overdue_count + 1;
                        $proj['status'] = 'Overdue';
                        $proj['status_count'] = $overdue_count;
                        $allProjects[] = $proj;
                    } else if ($data['completed_count'] == $data['all_tasks']) {
                        $planned_count = $planned_count + 1;
                        $proj['status'] = 'Completed';
                        $proj['status_count'] = $completed_count;
                        $allProjects[] = $proj;
                    }
                } else {
					//$planned_count = $planned_count + 1;
                    $proj['status'] = 'New';
                    $proj['status_count'] = $planned_count;
                    $allProjects[] = $proj;
                   
                }
                 //
            }
            
            $data['dataset'] = $allProjects;
            $data['planned_count'] = $planned_count;
            $data['inprogress_count'] = $inprogress_count;
            $data['onhold_count'] = $onhold_count;
            $data['overdue_count'] = $overdue_count;
            $data['completed_count'] = $completed_count;
        }

		$data['view2'] = $view;
        if ($this->input->is_ajax_request()) {
            if ($this->input->post('view') == 'grid') {
                $this->load->view('GridView', $data);
            } else if ($this->input->post('view') == 'list') {
                $this->load->view('ListView', $data);
            } else {
                $this->load->view('GridView', $data);
            }
        } else {
            $this->parser->parse('layouts/PageTemplate', $data);
        }
    }

    public function completedProject($view='grid') {
        $data['main_content'] = '/index';
        $data['pageTitle'] = lang('projects');
        $data['viewType'] = 'archive';
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
            '#collection' => 'project_master',
            '#select' => array('_id', 'projectname', 'clientid', 'hourlyprice', 'fixedprojectprice', 'created_at', 'duedate', 'project_status'),
            '#find' => array('is_deleted' => 0),
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
            $parseParam['#find'] = array('projectname' => $filteredSearch);
        }
        $pagination->setParameters($parseParam, $currentPage, $itemsPerPage);

        $dataSet = $pagination->Paginate();
        $result = $dataSet['dataset'];
        $data['pagination']['totalPages'] = $dataSet['totalPages'];
        $data['pagination']['totalItems'] = $dataSet['totalItems'];
        $data['pagination']['links'] = $pagination->getPageLinks();
        $data['dataset'] = $this->mongo_db->get('project_master');
        //$this->mongo_db->explain();
        //  $data['clients']=$this->mongo_db->get('Client');
        $data['footerJs'][0] = base_url('uploads/assets/plugins/bootstrap-sweetalert/sweet-alert.min.js');
        $data['footerJs'][1] = base_url('assets/pages/jquery.sweet-alert.init.js');
        $data['footerJs'][2] = base_url('uploads/assets/plugins/datatables/jquery.dataTables.min.js');
        $data['footerJs'][3] = base_url('uploads/assets/plugins/datatables/dataTables.responsive.min.js');
        $data['footerJs'][4] = base_url('uploads/assets/js/filterizr/jquery.filterizr.js');
        $data['footerJs'][5] = base_url('uploads/custom/project/project.js');
        $data['headerCss'][0] = base_url('uploads/assets/plugins/bootstrap-sweetalert/sweet-alert.css');
        $data['headerCss'][1] = base_url('uploads/assets/plugins/datatables/jquery.dataTables.min.css');
        $data['headerCss'][2] = base_url('uploads/assets/css/filter.css');
        $data['headerCss'][3] = base_url('uploads/custom/Developer.css');
        $data['url'] = $url;

        /*
         * project counts with status
         */
        $planned_count = 0;
        $inprogress_count = 0;
        $onhold_count = 0;
        $overdue_count = 0;
        $completed_count = 0;
        $allProjects = array();
//echo $completed_count;exit;
        $data['planned_count'] = $planned_count;
            $data['inprogress_count'] = $inprogress_count;
            $data['onhold_count'] = $onhold_count;
            $data['overdue_count'] = $overdue_count;
            $data['completed_count'] = $completed_count;

        if (count($data['dataset']) > 0) {
            foreach ($data['dataset'] as $proj) {
                $data['planned_count'] = $count = $this->mongo_db->where(array('status' => 0, 'projectid' => new \MongoId($proj['_id'])))->count('task_master');
                $data['inprogress_count'] = $count = $this->mongo_db->where(array('status' => 1, 'projectid' => new \MongoId($proj['_id'])))->count('task_master');
                $data['onhold_count'] = $count = $this->mongo_db->where(array('status' => 2, 'projectid' => new \MongoId($proj['_id'])))->count('task_master');
                $data['overdue_count'] = $count = $this->mongo_db->where(array('status' => 4, 'projectid' => new \MongoId($proj['_id'])))->count('task_master');
                $data['completed_count'] = $count = $this->mongo_db->where(array('status' => 3, 'projectid' => new \MongoId($proj['_id'])))->count('task_master');
                $data['all_tasks'] = $count = $this->mongo_db->where(array('projectid' => new \MongoId($proj['_id'])))->count('task_master');
                
                if ($data['planned_count'] > 0 && $data['inprogress_count'] == 0 && $data['onhold_count'] == 0 && $data['overdue_count'] == 0 && $data['completed_count'] == 0) {
                    $planned_count = $planned_count + 1;
                    $proj['status'] = 'Planned';
                    $proj['status_count'] = $planned_count;
                } else if ($data['inprogress_count'] > 0 && $data['onhold_count'] == 0 && $data['overdue_count'] == 0 && $data['completed_count'] == 0) {
                    $inprogress_count = $inprogress_count + 1;
                    $proj['status'] = 'inprogress';
                    $proj['status_count'] = $inprogress_count;
                } else if ($data['onhold_count'] > 0 && $data['overdue_count'] == 0) {
                    $onhold_count = $onhold_count + 1;
                    $proj['status'] = 'OnHold';
                    $proj['status_count'] = $onhold_count;
                } else if ($data['overdue_count'] > 0) {
                    $overdue_count = $overdue_count + 1;
                    $proj['status'] = 'Overdue';
                    $proj['status_count'] = $overdue_count;
                } else if ($data['completed_count'] == $data['all_tasks'] && $data['all_tasks']!=0) {
                    $completed_count = $completed_count + 1;
                    $proj['status'] = 'Completed';
                    $proj['status_count'] = $completed_count;
                    $allProjects[] = $proj;
                }
            }
            $data['dataset'] = $allProjects;
            $data['planned_count'] = $planned_count;
            $data['inprogress_count'] = $inprogress_count;
            $data['onhold_count'] = $onhold_count;
            $data['overdue_count'] = $overdue_count;
            $data['completed_count'] = $completed_count;
        }
        
		$rt = array();
		if (count($data['dataset']) > 0) {
            foreach ($data['dataset'] as $proj) {
				$tasks_count = $this->mongo_db->where(array('projectid' => new \MongoId($proj['_id'])))->count('task_master');
				$completed_count = $this->mongo_db->where(array('status' => 3, 'projectid' => new \MongoId($proj['_id'])))->count('task_master');
				
				if($tasks_count == $completed_count){
					array_push($rt,$proj);
				}
			}
			
			$data['completed'] = $rt;
			
		}
		
		$data['view'] = $view;
        if ($this->input->is_ajax_request()) {
            if ($this->input->post('view') == 'grid') {
                $this->load->view('GridView', $data);
            } else if ($this->input->post('view') == 'list') {
                $this->load->view('ListView', $data);
            } else {
                $this->load->view('GridView', $data);
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
        $data['main_content'] = '/AddProject';
        $id = $this->session->userdata('alice_session')['_id'];

        $data['clients'] = $this->mongo_db->where(array('created_by' => new \MongoId($id)))->get('Client');
        $data['footerJs'][0] = base_url('uploads/assets/plugins/parsleyjs/dist/parsley.min.js');
        $data['footerJs'][1] = base_url('uploads/assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js');
        $data['footerJs'][2] = base_url('uploads/custom/project/project.js');
        $data['footerJs'][3] = base_url('uploads/assets/plugins/select2/dist/js/select2.min.js');
        $data['footerJs'][4] = base_url('uploads/assets/plugins/tinymce/tinymce.min.js');

        $data['headerCss'][0] = base_url('uploads/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css');
        $data['headerCss'][1] = base_url('uploads/assets/plugins/select2/dist/css/select2.css');
        $data['headerCss'][2] = base_url('uploads/assets/plugins/select2/dist/css/select2-bootstrap.css');

        $this->parser->parse('layouts/PageTemplate', $data);
    }

    public function Edit($id) {

        $data['pageTitle'] = lang('edit_project');
        if ($id != '') {
            $data['project'] = $this->mongo_db->get_where('project_master', array('_id' => new \MongoId($id)))[0];

            $data['client_data'] = $this->mongo_db->get_where('Client', array('_id' => new \MongoId($data['project']['clientid'])));

            $data['main_content'] = '/EditProject';
            $data['clients'] = $this->mongo_db->get('Client');
            $data['footerJs'][0] = base_url('uploads/assets/plugins/parsleyjs/dist/parsley.min.js');
            $data['footerJs'][1] = base_url('uploads/assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js');
            $data['footerJs'][2] = base_url('uploads/custom/project/project.js');
            $data['footerJs'][3] = base_url('uploads/assets/plugins/select2/dist/js/select2.min.js');
            $data['footerJs'][4] = base_url('uploads/assets/plugins/tinymce/tinymce.min.js');
            $data['headerCss'][0] = base_url('uploads/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css');
            $data['headerCss'][1] = base_url('uploads/assets/plugins/select2/dist/css/select2.css');
            $data['headerCss'][2] = base_url('uploads/assets/plugins/select2/dist/css/select2-bootstrap.css');

            $this->parser->parse('layouts/PageTemplate', $data);
        } else {
            redirect(base_url('Project'));
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
                'is_deleted' => 0,
                'project_status' => 0,
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
        $this->mongo_db->where('_id', new MongoId($id))->set(array('is_deleted' => 1))->update('project_master');
        // $this->mongo_db->where(array('_id' => $id))->delete('project_master');
        $error_msg = SUCCESS_START_DIV_NEW . lang('project_delete_msg') . SUCCESS_END_DIV;
        $this->session->set_flashdata('message', $error_msg);
        redirect(site_url('Project'));
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



        if ($this->form_validation->run() == FALSE) {
            $error_msg = ERROR_START_DIV_NEW . lang('common_error_form_submit') . ERROR_END_DIV;
            $this->session->set_flashdata('error', $error_msg);
            //Field validation failed.  User redirected to login page
            //$error_array = validation_errors();
            redirect($this->viewname);
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
            $this->mongo_db->where('_id', new MongoId($id))->set($data)->update('project_master');

            $error_msg = SUCCESS_START_DIV_NEW . lang('project_update_msg') . SUCCESS_END_DIV;
            $this->session->set_flashdata('message', $error_msg);
            redirect(site_url('Project'));
        }
    }

    public function view_page($id) {

        $data['pageTitle'] = lang('edit_client');
        if ($id != '') {
            $data['project'] = $this->mongo_db->get_where('project_master', array('_id' => new \MongoId($id)))[0];

            $data['client_data'] = $this->mongo_db->get_where('Client', array('_id' => new \MongoId($data['project']['clientid'])));

            //$data['main_content'] = '/EditProject';
            $data['clients'] = $this->mongo_db->get('Client');
            $data['footerJs'][0] = base_url('uploads/assets/plugins/parsleyjs/dist/parsley.min.js');
            $data['footerJs'][1] = base_url('uploads/assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js');
            $data['footerJs'][2] = base_url('uploads/custom/project/project.js');
            $data['footerJs'][3] = base_url('uploads/assets/plugins/select2/dist/js/select2.min.js');
            $data['footerJs'][4] = base_url('uploads/assets/plugins/tinymce/tinymce.min.js');
            $data['headerCss'][0] = base_url('uploads/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css');
            $data['headerCss'][1] = base_url('uploads/assets/plugins/select2/dist/css/select2.css');
            $data['headerCss'][2] = base_url('uploads/assets/plugins/select2/dist/css/select2-bootstrap.css');

            $data['id'] = $id;
            $data['main_content'] = '/View_page';
            $this->load->view('/View_page', $data);

            //    $this->parser->parse('layouts/PageTemplate', $data);
        } else {
            exit('No Direct scripts are allowed');
        }
    }

}

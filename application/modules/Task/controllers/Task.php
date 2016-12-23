<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Task extends Public_controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('upload');
        $this->load->library('mongo_db', array('activate' => 'default'), 'mongo_db');
        $this->module = $this->router->fetch_class();
        $this->viewname = $this->router->fetch_method();
        $this->userId = $this->session->userdata('alice_session')['_id'];
        $this->projectId = $this->input->get('project');
        $this->url = base_url('Task?project=' . $this->projectId);
        $this->load->model('task_model');
    }

    public function index($project) {
        if (empty($project)) {
			redirect('Project');
        }
        
        
        

        $this->projectId = $project;
        $data['projectId'] = $project;
       // die($this->projectId);
        $this->projectDetails = $this->mongo_db->get_where('project_master', array('_id' => new \MongoId($this->projectId)));
        
        $this->clientDetails = $this->mongo_db->get_where('Client', array('_id' => new \MongoId($this->projectDetails[0]['clientid'])));
        if (count($this->projectDetails) == 0) {
            redirect(base_url('Project'));
        }
        $data['viewType'] = 'Active';
        $data['main_content'] = '/index';
        $data['pageTitle'] = $this->projectDetails[0]['projectname'];
        $data['projectDetails'] = $this->projectDetails[0];
        $data['clients'] = $this->clientDetails[0];
        //$parameters['total_rows']=
        //Pagination Sample code
        $data['project'] = $this->mongo_db->get_where('project_master', array('_id' => new \MongoId($this->projectId)));
        $data['members'] = $this->mongo_db->where(array('user_role' => 1, 'company_id' => new \MongoId($this->userId)))->get('User');
        $data['status'] = array(0 => '<a href="javascript:;" class="btn btn-info btn-lg">' . lang('planned') . '</a>',
            1 => '<a href="javascript:;" class="btn btn-warning btn-lg">' . lang('inprogress') . '</a>',
            2 => '<a href="javascript:;" class="btn btn-purple btn-lg">' . lang('onhold') . '</a>',
            3 => '<a href="javascript:;" class="btn btn-success btn-lg">' . lang('completed') . '</a>',
            4 => '<a href="javascript:;" class="btn btn-danger btn-lg">' . lang('overdue') . '</a>');

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
        $url = base_url('Task/' . $this->projectId);
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
//        $opn = array('$lookup' => array(
//        'from' => 'task_master',
//        'localField'=>'_id',
//        'foreignField' =>'task_id', // uid = _id.$id
//        'as' =>'orderRes'
//        )
//        );
//        pr($this->mongo_db->aggregate("task_members",$opn));
//        die;
        $pagination = new MongoPagination($this->mongo_db, $parameters);
        $parseParam = array(
            '#collection' => 'task_master',
            '#select' => array('_id', 'taskname', 'client_id', 'start_date', 'due_date', 'status', 'project_id', 'created_at', 'timer_status', 'timer_startdate', 'timer_pausedate'),
            '#wherenot' => array('status' => array('3')),
            '#sort' => array($data['sortField'] => $sortOrderParam),
        );
        $advancedFilter = array();
        if ($this->input->post('members')) {
            //  $advancedFilter['']
        }
        if ($this->input->post('duedate') != '') {
            $data['duedate'] = $this->input->post('duedate');
            $parseParam ['#where_lt'] = array('due_date' => $this->input->post('duedate'));
        }
       
        if ($this->input->post('status') != '') {
         /*    $data['status'] = $this->input->post('status');
            $parseParam['#find'] = array('status' => $this->input->post('status')); */
        }
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
		
		 if ($this->input->post('members') != '') {
		$member_id = $this->input->post('members');
		$getMember = $this->mongo_db->where(array('member_id'=> "$member_id" ))->get('task_members');
		 foreach($result as $res){
				foreach($getMember as $gm){
					if($res['_id'] == $gm['task_id']){
						$counttask = $counttask + 1;
						$rt[] = $res;
					}
					$ff = 1;
				}
		 } 
        }
				
		if($ff){
			$result = $rt;
		}
		        $this->url = base_url('Task?project=' . $this->projectId);
		if ($this->input->post('status') != '') {
			   $taskstatus = $this->input->post('status');
			  
				foreach($result as $res){
					
				  if($res['status'] == $taskstatus){
				   $rtx[] = $res;
				  }
				  $ffx = 1;
				} 
					} 
			  if($ffx){
			$result = $rtx;
		}
        $data['pagination']['totalPages'] = $dataSet['totalPages'];
        $data['pagination']['totalItems'] = $dataSet['totalItems'];
        $data['pagination']['links'] = $pagination->getPageLinks();
       
        $dataArr = array();
        if (count($result) > 0) {
            foreach ($result as $re) {
                $getCurrentMembers=$this->mongo_db->where(array('task_id'=>new \MongoId($re['_id'])))->get('task_members');
               
                if(count($getCurrentMembers)>0)
                {
                    foreach($getCurrentMembers as $mem)
                    {
                        $re['members'][]=$this->mongo_db->where(array('_id'=>new \MongoId($mem['member_id'])))->get('User')[0];
                    }
                }
                $dataArr[] = $re;
            }
        }
       
        $data['dataset'] = $dataArr; //$this->mongo_db->get('Client');
        //$this->mongo_db->explain();
        //  $data['clients']=$this->mongo_db->get('Client');
        /*
         * status wise count code starts
         */
        $data['planned_count'] = $count = $this->mongo_db->where(array('status' => 0))->count('task_master');
        $data['inprogress_count'] = $count = $this->mongo_db->where(array('status' => 1))->count('task_master');
        $data['onhold_count'] = $count = $this->mongo_db->where(array('status' => 2))->count('task_master');
        $data['overdue_count'] = $count = $this->mongo_db->where(array('status' => 4))->count('task_master');
        /*
         * count code ends
         */

        $data['footerJs'][0] = base_url('uploads/assets/plugins/bootstrap-sweetalert/sweet-alert.min.js');
        $data['footerJs'][1] = base_url('assets/pages/jquery.sweet-alert.init.js');
        $data['footerJs'][2] = base_url('uploads/custom/project/project.js');
        $data['footerJs'][3] = base_url('uploads/assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js');
        $data['footerJs'][4] = base_url('uploads/custom/task/task.js');

        $data['headerCss'][0] = base_url('uploads/assets/plugins/bootstrap-sweetalert/sweet-alert.css');
        $data['headerCss'][1] = base_url('uploads/custom/Developer.css');
        $data['headerCss'][2] = base_url('uploads/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css');

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

    public function completedTask($project_id) {
        if (empty($project_id)) {
            redirect('Project');
        }
        $data['project_id'] = $project_id;
        $data['viewType'] = 'Completed';
        $this->projectId = $project_id;
        $this->projectDetails = $this->mongo_db->get_where('project_master', array('_id' => new \MongoId($this->projectId)));
        $this->clientDetails = $this->mongo_db->get_where('Client', array('_id' => new \MongoId($this->projectDetails[0]['clientid'])));
        if (count($this->projectDetails) == 0) {
            redirect(base_url('Project'));
        }
        $data['main_content'] = '/index';
        $data['pageTitle'] = $this->projectDetails[0]['projectname'];
        $data['projectDetails'] = $this->projectDetails[0];
        $data['clients'] = $this->clientDetails[0];
        //$parameters['total_rows']=
        //Pagination Sample code
        $data['project'] = $this->mongo_db->get_where('project_master', array('_id' => new \MongoId($this->projectId)));
        $data['members'] = $this->mongo_db->where(array('user_role' => 1, 'company_id' => new \MongoId($this->userId)))->get('User');
        /*pr($data['members']);
        die('here');*/
        $data['status'] = array(0 => '<a href="javascript:;" class="btn btn-info btn-lg">' . lang('planned') . '</a>',
            1 => '<a href="javascript:;" class="btn btn-warning btn-lg">' . lang('inprogress') . '</a>',
            2 => '<a href="javascript:;" class="btn btn-purple btn-lg">' . lang('onhold') . '</a>',
            3 => '<a href="javascript:;" class="btn btn-success btn-lg">' . lang('completed') . '</a>',
            4 => '<a href="javascript:;" class="btn btn-danger btn-lg">' . lang('overdue') . '</a>');

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
        $url = base_url('Task/completedTask?start_rows=' . $currentPage);
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
            '#collection' => 'task_master',
            '#select' => array('_id', 'taskname', 'client_id', 'start_date', 'due_date', 'status', 'project_id', 'created_at', 'timer_status', 'timer_startdate', 'timer_pausedate'),
            '#find' => array('status' => '3','is_deleted'=>'0'),
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
        $data['dataset'] = $result; //$this->mongo_db->get('Client');
        //$this->mongo_db->explain();
        //  $data['clients']=$this->mongo_db->get('Client');


        /*
         * status wise count code starts
         */
        $data['completed_count'] = $this->task_model->getCounts('3');
        /*
         * count code ends
         */

		$dataArr = array();
        if (count($result) > 0) {
            foreach ($result as $re) {
                $getCurrentMembers=$this->mongo_db->where(array('task_id'=>new \MongoId($re['_id'])))->get('task_members');
               
                if(count($getCurrentMembers)>0)
                {
                    foreach($getCurrentMembers as $mem)
                    {
                        $re['members'][]=$this->mongo_db->where(array('_id'=>new \MongoId($mem['member_id'])))->get('User')[0];
                    }
                }
                $dataArr[] = $re;
                
            }
        }
       
        $data['dataset'] = $dataArr; //$this->mongo_db->get('Client');
        $data['footerJs'][0] = base_url('uploads/assets/plugins/bootstrap-sweetalert/sweet-alert.min.js');
        $data['footerJs'][1] = base_url('assets/pages/jquery.sweet-alert.init.js');
        $data['footerJs'][2] = base_url('uploads/custom/project/project.js');
        $data['footerJs'][3] = base_url('uploads/assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js');
        $data['footerJs'][4] = base_url('uploads/custom/task/task.js');

        $data['headerCss'][0] = base_url('uploads/assets/plugins/bootstrap-sweetalert/sweet-alert.css');
        $data['headerCss'][1] = base_url('uploads/custom/Developer.css');
        $data['headerCss'][2] = base_url('uploads/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css');

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

    public function Add($project_id) {
        if (empty($project_id)) {
            redirect('Project');
        }
		
        $data['project_id'] = $project_id;
        $this->projectId = $project_id;
        $this->projectDetails = $this->mongo_db->get_where('project_master', array('_id' => new \MongoId($this->projectId)));
        $this->clientDetails = $this->mongo_db->get_where('Client', array('_id' => new \MongoId($this->projectDetails[0]['clientid'])));
        if (count($this->projectDetails) == 0) {
            redirect(base_url('Project'));
        }
        $data['pageTitle'] = lang('create_new_task');
        $data['main_content'] = '/Add';
        $data['members'] = $this->mongo_db->where(array('user_role' => 1, 'company_id' => new \MongoId($this->userId)))->get('User');

        $data['footerJs'][0] = base_url('uploads/assets/plugins/parsleyjs/dist/parsley.min.js');
        $data['footerJs'][1] = base_url('uploads/assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js');
        $data['footerJs'][2] = base_url('uploads/custom/task/task.js');
        $data['footerJs'][3] = base_url('uploads/assets/plugins/select2/dist/js/select2.min.js');

        $data['headerCss'][0] = base_url('uploads/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css');
        $data['headerCss'][1] = base_url('uploads/assets/plugins/select2/dist/css/select2.css');
        $data['headerCss'][2] = base_url('uploads/assets/plugins/select2/dist/css/select2-bootstrap.css');

        $this->parser->parse('layouts/PageTemplate', $data);
    }

    public function Edit($id) {
        if ($this->input->get('project') == '') {
            redirect('Project');
        }

        $this->projectDetails = $this->mongo_db->get_where('project_master', array('_id' => new \MongoId($this->projectId)));
        $this->clientDetails = $this->mongo_db->get_where('Client', array('_id' => new \MongoId($this->projectDetails[0]['clientid'])));
        if (count($this->projectDetails) == 0) {
            redirect(base_url('Project'));
        }
        $data['pageTitle'] = lang('edit_client');
        if ($id != '') {
            $data['data'] = $this->mongo_db->get_where('task_master', array('_id' => new \MongoId($id)));
            if (count($data['data']) == 0) {
                redirect(base_url('Task?project=' . $this->projectId));
            }
            $data['membersData'] = $this->mongo_db->get_where('task_members', array('task_id' => new \MongoId($data['data'][0]['_id'])));
            $data['members'] = $this->mongo_db->where(array('user_role' => 1, 'company_id' => new \MongoId($this->userId)))->get('User');
            $members = array();
            if (count($data['membersData']) > 0) {
                foreach ($data['membersData'] as $member):
                    $members[] = $member['member_id'];
                endforeach;
            }
            $data['dbmembers'] = $members;

            $data['main_content'] = '/Edit';
            $data['footerJs'][0] = base_url('uploads/assets/plugins/parsleyjs/dist/parsley.min.js');
            $data['footerJs'][1] = base_url('uploads/assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js');
            $data['footerJs'][2] = base_url('uploads/custom/task/task.js');
            $data['footerJs'][3] = base_url('uploads/assets/plugins/select2/dist/js/select2.min.js');
            $data['headerCss'][0] = base_url('uploads/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css');
            $data['headerCss'][1] = base_url('uploads/assets/plugins/select2/dist/css/select2.css');
            $data['headerCss'][2] = base_url('uploads/assets/plugins/select2/dist/css/select2-bootstrap.css');

            $this->parser->parse('layouts/PageTemplate', $data);
        } else {
            redirect(base_url('Task?project=' . $this->projectId));
        }
    }

    public function InsertData() {
		/*echo "Dishit";
print_r($_POST);
	print_r($this->input->post('projectid'));*/
        $this->load->library('form_validation');


        $this->form_validation->set_error_delimiters(ERROR_START_DIV_NEW, ERROR_END_DIV);
        $this->form_validation->set_rules('taskname', 'taskname', 'trim|required');
        $this->form_validation->set_rules('startdate', 'startdate', 'trim|required');
        $this->form_validation->set_rules('duedate', 'duedate', 'trim|required');
        //$this->form_validation->set_rules('password', 'Password', 'trim|required|callback_check_database');
        $this->projectId = $this->input->post('projectid');
        if ($this->form_validation->run() == FALSE) {
            $error_msg = validation_errors();
            $this->session->set_flashdata('error', $error_msg);
            redirect(site_url('Task/Add'));
            //Field validation failed.  User redirected to login page
        } else {
            // $files = $_FILES;
            $data = array('taskname' => $this->input->post('taskname'),
                'projectid' => $this->projectId,
                'company_id' => $this->userId,
                'start_date' => $this->input->post('startdate'),
                'due_date' => $this->input->post('duedate'),
                'created_at' => date('Y-m-d h:i:s'),
                'status' => 0,
                'created_by' => $this->session->userdata('alice_session')['_id'],
            );

            $taskId = $this->mongo_db->insert('task_master', $data);

            $members = $this->input->post('members');

            if (count($members) > 0) {
                foreach ($members as $member) {
                    $membersArray = array('task_id' => $taskId, 'project_id' => $this->projectId, 'company_id' => $this->userId, 'member_id' => $member);
                    $this->mongo_db->insert('task_members', $membersArray);
                }
            }
            $error_msg = SUCCESS_START_DIV_NEW . str_replace('{tname}', $this->input->post('taskname'), lang('task_create_msg')) . SUCCESS_END_DIV;
            $this->session->set_flashdata('message', $error_msg);
            redirect(base_url('Task?project=' . $this->projectId));
        }
    }

    public function Delete($id) {
		//die($id);
        $id = new MongoId($id);
        $this->mongo_db->where('_id', new MongoId($id))->set(array('is_deleted' => 1))->update('task_master');
        // $this->mongo_db->where(array('_id' => $id))->delete('project_master');
        $error_msg = SUCCESS_START_DIV_NEW . lang('project_delete_msg') . SUCCESS_END_DIV;
        $this->session->set_flashdata('message', $error_msg);
        redirect(site_url('Project'));
    }

    public function UpdateData() {

        $id = $this->input->post('_id');
        $this->load->library('form_validation');

        $this->form_validation->set_error_delimiters(ERROR_START_DIV_NEW, ERROR_END_DIV);
        $this->form_validation->set_rules('taskname', 'taskname', 'trim|required');
        $this->form_validation->set_rules('startdate', 'startdate', 'trim|required');
        $this->form_validation->set_rules('duedate', 'duedate', 'trim|required');
        //$this->form_validation->set_rules('password', 'Password', 'trim|required|callback_check_database');

        $this->projectId = $this->input->post('projectid');


        if ($this->form_validation->run() == FALSE) {
            $error_msg = ERROR_START_DIV_NEW . lang('common_error_form_submit') . ERROR_END_DIV;
            $this->session->set_flashdata('error', $error_msg);
            //Field validation failed.  User redirected to login page
            //$error_array = validation_errors();
            redirect(base_url('Task?project=' . $this->projectId));
        } else {
            // $files = $_FILES;
            $data = array('taskname' => $this->input->post('taskname'),
                'start_date' => $this->input->post('startdate'),
                'due_date' => $this->input->post('duedate'),
                'updated_at' => date('Y-m-d h:i:s'),
                'updated_by' => $this->session->userdata('alice_session')['_id'],
            );

            $taskId = $id;
            $this->mongo_db->where('_id', new MongoId($id))->set($data)->update('task_master');

            $members = $this->input->post('members');

            if (count($members) > 0) {
                $this->mongo_db->where(array('task_id' => $taskId))->delete('task_members');

                foreach ($members as $member) {
                    $membersArray = array('task_id' => $taskId, 'project_id' => $this->projectId, 'company_id' => $this->userId, 'member_id' => $member);
                    $this->mongo_db->insert('task_members', $membersArray);
                }
            }

            $error_msg = SUCCESS_START_DIV_NEW . lang('task_updated_msg') . SUCCESS_END_DIV;
            $this->session->set_flashdata('message', $error_msg);
            redirect(base_url('Task?project=' . $this->projectId));
        }
    }

    function updateTaskStatus($id) {
        if ($id == '') {
            redirect(base_url('Task?project=' . $this->projectId));
        } else {
            $status = $this->input->get('status');
            $stat = array(0 => lang('planned'),
                1 => lang('inprogress'),
                2 => lang('onhold'),
                3 => lang('completed'),
                4 => lang('overdue'));
            $taskdata = $this->mongo_db->where('_id', new MongoId($id))->get('task_master');

            if ($this->mongo_db->where('_id', new MongoId($id))->set(array('status' => $status))->update('task_master')) {

                $msg = '';
                $find = array('{teammember}', '{task}');
                $find = array(
                    '{teammember}',
                    '{task}',
                        //    '{DATE}'
                );

                $replace = array(
                    'teammember' => $this->session->userdata('alice_session')['firstname'],
                    'task' => $taskdata[0]['taskname'],
                );

                if ($status == 1) {
                    $msg = lang('task_status_inprogress');
                } else if ($status == 2) {
                    $msg = lang('task_status_onhold');
                } else if ($status == 3) {
                    $msg = lang('task_status_completed');
                }
                $format = $msg;
                $body = str_replace(array("\r\n",
                    "\r",
                    "\n"), '<br />', preg_replace(array("/\s\s+/",
                    "/\r\r+/",
                    "/\n\n+/"), '<br />', trim(str_replace($find, $replace, $format))));

                echo json_encode(array('status' => 1, 'message' => $body));
            } else {
                
            }
        }
    }

    function starttimer($id) {
        if ($id == '') {
            redirect(base_url('Task?project=' . $this->projectId));
        } else {
            $status = $this->input->get('status');
            $timer_startdate = $this->input->post('timer_startdate');

            $taskdata = $this->mongo_db->where('_id', new MongoId($id))->get('task_master');

            if ($this->mongo_db->where('_id', new MongoId($id))->set(array('timer_status' => 1, 'timer_startdate' => $timer_startdate))->update('task_master')) {

                $msg = '';
                $find = array(
                    '{teammember}',
                    '{task}',
                );

                $replace = array(
                    'teammember' => $this->session->userdata('alice_session')['firstname'],
                    'task' => $taskdata[0]['taskname'],
                );


                $format = lang('task_status_inprogress');
                $body = str_replace(array("\r\n",
                    "\r",
                    "\n"), '<br />', preg_replace(array("/\s\s+/",
                    "/\r\r+/",
                    "/\n\n+/"), '<br />', trim(str_replace($find, $replace, $format))));

                echo json_encode(array('status' => 1, 'message' => $body));
            } else {
                
            }
        }
    }

    function pausetimer($id) {
        if ($id == '') {
            redirect(base_url('Task?project=' . $this->projectId));
        } else {
            $status = $this->input->get('status');
            $timer_startdate = $this->input->post('timer_pausedate');
            $duration = $this->input->post('duration');

            $taskdata = $this->mongo_db->where('_id', new MongoId($id))->get('task_master');

            if ($this->mongo_db->where('_id', new MongoId($id))->set(array('timer_status' => 0, 'timer_pausedate' => $timer_startdate, 'duration' => $duration))->update('task_master')) {

                $msg = '';
                $find = array(
                    '{teammember}',
                    '{task}',
                );

                $replace = array(
                    'teammember' => $this->session->userdata('alice_session')['firstname'],
                    'task' => $taskdata[0]['taskname'],
                );


                $format = lang('task_status_onhold');
                $body = str_replace(array("\r\n",
                    "\r",
                    "\n"), '<br />', preg_replace(array("/\s\s+/",
                    "/\r\r+/",
                    "/\n\n+/"), '<br />', trim(str_replace($find, $replace, $format))));

                echo json_encode(array('status' => 1, 'message' => $body));
            } else {
                
            }
        }
    }

}

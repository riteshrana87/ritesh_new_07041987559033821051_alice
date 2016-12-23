<?php
/*
@Author : Ritesh rana
@Desc   : Dashboard
@Date   : 01/10/2016
*/
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends Public_controller
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
		//$saveactivity = $this->save_activity($this->session->userdata('alice_session')['_id'],lang('logout_suceess_msg'),'Logout');
		$this->session->unset_userdata('alice_session');
		setcookie('remember_me_email', 'gone', time()-60*60*24*100, "/");	
		$this->session->set_flashdata('error', $logout_msg);
		redirect(base_url('/'));
    }

}


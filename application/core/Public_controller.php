<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Public_controller extends MY_Controller
{
    function __construct()
    {
		
		
        parent::__construct();
          $this->lang->load('label', 'english');
         if(!$this->session->has_userdata('alice_session'))
        
         {
			
			//$path_parts = explode('/', $parts['path']);
            $actual_link = "$_SERVER[REQUEST_URI]";
			$path_parts = explode('/', $actual_link);
			$invoicepayfront = $path_parts[count($path_parts) - 2];
			
			if($invoicepayfront == 'Pay' || $invoicepayfront == 'PaymenyGateway'){
				//redirect(base_url());
			}
			else{
				redirect(base_url());
			}
         }
         else{
			 
			 
			 $module=array('Project');
			 $session_data=$this->session->userdata('alice_session');
			 $access_module=$this->router->fetch_class();
			 /*pr($session_data['user_role']);
			 die('here');*/
			 if(isset($session_data['user_role']) && $session_data['user_role']==1){
					
					$module=array('Project','Dashboard');
					if(in_array($access_module,$module)){
						
						die('Yes');
						
						}
						else{
						
						//die('No');
							
							}
				 
				 }
				 
			 
			 }
			 

        // If the user is using a mobile, use a mobile theme   
    }
	
	public function save_activity($user_id,$user_activity,$activity_module){
            	$id = new MongoId($user_id);
		$activity = $user_activity;
		$activity_module = $activity_module;
		$this->load->library('mongo_db', array('activate' => 'default'), 'mongo_db');
		//die();
        $data = array('user_id' => $id,
            'activity' => $activity,
            'activity_module' => $activity_module,
            'created_at' => date('Y-m-d h:i:s'),
            'created_by' => $this->session->userdata('alice_session')['_id']
        );
        $this->mongo_db->insert('Activities', $data);
           //redirect(base_url('Client'));
	}
}

<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
  @Author : Dishit
  @Desc   : This module is for email management
  @Input 	:
  @Output	:
  @Date   : 1/03/2016
 */

class Email_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

public function getClientData($user_id) {
		/* echo $user_id;
		die(); */
        $client_data = $this->mongo_db->get_where('EmailSettings', array('user_id' => new \MongoId($user_id)));
        return  $client_data;
    }


}

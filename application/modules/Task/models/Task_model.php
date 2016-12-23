<?php

class Task_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->library('mongo_db', array('activate' => 'default'), 'mongo_db');
    }

    /*
     * function is used to get count of tasks status wise
     */

    public function getCounts($status ='0') {
        
        $count=$this->mongo_db->where(array('status' => $status))->count('task_master');
        if($count>0)
        {
            return $count;
        }
        else 
        {
            return 0;
        }
    }

}

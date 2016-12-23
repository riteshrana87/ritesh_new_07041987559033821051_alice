<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Imap extends Public_controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('upload');
        $this->load->library('mongo_db', array('activate' => 'default'), 'mongo_db');
        $this->module = $this->router->fetch_class();
        $this->viewname = $this->router->fetch_class();
		
		$this->load->library('Imap');
    }

            // IMAP/POP3 (mail server) LOGIN
        var $imap_server    = 'mail.example.org';
        var $imap_user      = 'user@example.org';
        var $imap_pass      = 'password';


        // index

        function index() {

            $inbox = $this->imap->cimap_open($this->imap_server, 'INBOX', $this->imap_user, $this->imap_pass) or die(imap_last_error());

            $data_array['totalmsg']    = $this->imap->cimap_num_msg($inbox);
            $data_array['quota']    = $this->imap->cimap_get_quota($inbox);
            $this->load->view('mail_view', $data_array);    
        }
}

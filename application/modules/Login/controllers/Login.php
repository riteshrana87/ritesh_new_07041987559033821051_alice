<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	

    public function __construct() {
		
        parent::__construct();
        $this->load->library('upload');
        
        $this->load->library('mongo_db', array('activate' => 'default'), 'mongo_db');
        
        $this->module = $this->router->fetch_class();
        
        $this->viewname = $this->router->fetch_class();
        
        $this->lang->load('label', 'english');
        
        $this->load->library('form_validation');
        $this->load->library('session');
        
         if($this->session->has_userdata('alice_session'))
        
         {
			 
             redirect(base_url('Dashboard'));
         }
         
    }

    public function index() {
		
		
        $data['title'] = 'Alice';
        $this->load->view('Login', $data);		
		
    }

    public function Validate() {
		
        $this->load->library('form_validation');
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $this->form_validation->set_error_delimiters(ERROR_START_DIV_NEW, ERROR_END_DIV);
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        //$this->form_validation->set_rules('password', 'Password', 'trim|required|callback_check_database');



        if ($this->form_validation->run() == FALSE) {
            $error_msg = ERROR_START_DIV_NEW . lang('LOGIN_EMAIL_ERROR') . ERROR_END_DIV;
            $this->session->set_flashdata('error', $error_msg);
            //Field validation failed.  User redirected to login page
            //$error_array = validation_errors();
            redirect($this->viewname);
        } else {
            $userDetails = $this->mongo_db->get_where('User', array('email' => $email, 'password' => md5($password)));
			/* print_r($password);
			echo "<br>";
			print_r(md5($password));
			die(); */
            if (count($userDetails) > 0) {
                $this->session->set_userdata('alice_session', $userDetails[0]);
                	if($_REQUEST['remember_me'] == "on") {	// if user check the remember me checkbox		
							setcookie('remember_me_email', $userDetails[0]['email'], time()+60*60*24*100, "/");
							setcookie('remember_me_password', $userDetails[0]['password'], time()+60*60*24*100, "/");
					
						}
						
				//$saveactivity = $this->save_activity($this->session->userdata('alice_session')['_id'],lang('login_suceess_msg'),'Login');
				
                redirect(base_url('Dashboard'));
            } else {
                $error_msg = ERROR_START_DIV_NEW . lang('ERROR_MSG_LOGIN') . ERROR_END_DIV;
                $this->session->set_flashdata('error', $error_msg);
                redirect($this->viewname);
            }
        }
    }

    public function addPostData() {
        $files = $_FILES;
        $cpt = count($_FILES['userfile']['name']);
        for ($i = 0; $i < $cpt; $i++) {
            $_FILES['userfile']['name'] = $files['userfile']['name'][$i];
            $_FILES['userfile']['type'] = $files['userfile']['type'][$i];
            $_FILES['userfile']['tmp_name'] = $files['userfile']['tmp_name'][$i];
            $_FILES['userfile']['error'] = $files['userfile']['error'][$i];
            $_FILES['userfile']['size'] = $files['userfile']['size'][$i];
            $this->upload->initialize($this->set_upload_options());
            $this->upload->do_upload();
            $fileName = $_FILES['userfile']['name'];
            $images[] = $fileName;
        }
        $fileName = implode(',', $images);
        $data = array('title' => $this->input->post('post_title'),
            'description' => $this->input->post('post_desc'),
            'catagories' => $this->input->post('post_catag'),
            'saved_at' => date('d-m-Y'),
            'featureImage' => $fileName
        );
        $this->mongo_db->insert('postCollection', $data);
        redirect(site_url('post/viewpost'));
    }

    private function set_upload_options() {
        $config = array();
        $config['upload_path'] = './upload/'; //give the path to upload the image in folder
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = '0';
        $config['overwrite'] = FALSE;
        return $config;
    }

    public function viewPost() {
        $data['user'] = $this->mongo_db->get('postCollection');
        $this->load->view('viewpost', $data);
    }

    public function editPost($id) {
// echo $id;
        $data['user'] = $this->mongo_db->get_where('postCollection', array('_id' => new \MongoId($id)));
        $this->load->view('editPost', $data);
    }

    public function deletePost($id) {
        $id = new MongoId($id);
        $this->mongo_db->where(array('_id' => $id))->delete('postCollection');
        redirect(site_url('post/viewPost'));
    }

    public function updatePost() {
        $id = $this->input->post('post_id');
        $data = array('title' => $this->input->post('post_title'),
            'description' => $this->input->post('post_desc'),
            'catagories' => $this->input->post('post_catag'),
            'saved_at' => date('d-m-Y')
        );
        $this->mongo_db->where('_id', new MongoId($id))->set($data)->update('postCollection');
        redirect(site_url('post/viewPost'));
    }
    
      
    
    public function forgotpassword() {


        $data['title'] = 'Alice';
        $this->load->view('Login/Forgotpassword', $data);
    }
    
    
    
     public function resetpassword() {
		 

        $this->form_validation->set_error_delimiters(ERROR_START_DIV, ERROR_END_DIV);
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		
        if ($this->form_validation->run() == FALSE) {
			
            $msg = validation_errors();
            $this->session->set_flashdata('msgs', $msg);
            redirect('Login/forgotpassword');
        } else {
			
          
                if ($this->input->post('email')) {
					
                   /* $token = md5($this->input->post('email') . date("Y-m-d H:i:s"));
                    $subject = "<a href='" . base_url() . "/Login/updatepassword?token=" . $token . "'>" . "Click Here" . "</a>";

                    // Get Template from Template Master
                    /*$table = EMAIL_TEMPLATE_MASTER . ' as et';
                    // $match = "et.subject ='Forgot Password' ";
                    $match = "et.template_id =29";
                    $fields = array("et.subject,et.body");
                    $template = $this->common_model->get_records($table, $fields, '', '', $match);

                    $body1 = str_replace("{PASS_KEY_URL}", $newpasswordlink, $template[0]['body']);

                    $to = $this->input->post('email');
                    $body = str_replace("{SITE_NAME}", base_url(), $body1);
                    $subject = "BLAZEDESK :: " . $template[0]['subject'];*/

                    /*$data = array('reset_password_token' => $token, 'modified_date' => datetimeformat());
                    $where = array('email' => $this->input->post('email'));*/
                    $data['user_data'] = $this->mongo_db->get_where('User', array('email' => $this->input->post('email')));
                     $to=$data['user_data'][0]['email'];
                     $subject = "Reset Password";
                     $body="<a href='" . base_url() . "/Login/updatepassword?email=" . $data['user_data'][0]['email'] . "'>" . "Click Here" . "</a>";
                   

                    if (!empty($data['user_data'])) {
						//die('here');
                        //send_mail($to, $subject, $body);
                        if (send_mail($to, $subject, $body)) {
							
                            $msg = $this->lang->line('new_password_sent');
                        } else {

                            $msg = $this->lang->line('FAIL_WITH_SENDING_EMAILS');
                        }

                        $this->session->set_flashdata('msg', "<div class='alert alert-success text-center'>$msg</div>");
                        redirect('Login/forgotpassword');
                    } else {
                        // error
                        $msg = $this->lang->line('error_msg');
                        $this->session->set_flashdata('msg', "<div class='alert alert-danger text-center'>$msg</div>");
                        //redirect('user/register');
                        redirect('Login/forgotpassword');
                    }
                }
            

            redirect('Masteradmin/forgotpassword');
        }
    }

}

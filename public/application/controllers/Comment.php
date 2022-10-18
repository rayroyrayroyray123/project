<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comment extends CI_Controller {

	public function index()
	{
        if (!$this->session->userdata('logged_in'))//check if user already login
		{
            if (get_cookie('remember')) { // check if user activate the "remember me" feature  
				$username = get_cookie('username'); //get the username from cookie
				$password = get_cookie('password'); //get the username from cookie
				if ( $this->user_model->login($username, $password) )//check username and password correct
				{
					$user_data = array('username' => $username,'logged_in' => true );
					$this->session->set_userdata($user_data); //set user status to login in session
					$this->load->view('file',array('error' => ' ')); //if user already logined show upload page
				}
			}else{
				redirect('login'); //if user already logined direct user to home page
			}
        }else{
            $this->load->model('Comment_model');
            $data['query'] = $this->Comment_model->retrieve_comment();
            $data['error']= "";
            $this->load->view('template/header');
            $this->load->view('comment', $data);
            $this->load->view('template/footer');
        }
	}

    public function do_comment(){
        $this->load->model('Comment_model');
        $comment = $this->input->post('comment');
        $username = $this->session->userdata('username');
        if($comment != ""){
            $this->Comment_model->save_comment($comment, $username);
            $data['query'] = $this->Comment_model->retrieve_comment();
            $data['error']= "";
            $this->load->view('template/header');
            $this->load->view('comment', $data);
            $this->load->view('template/footer');
        }else{
            $this->Comment_model->save_comment($comment);
            $data['query'] = "";
            $data['error']= "Please fill in some words";
            $this->load->view('template/header');
            $this->load->view('comment', $data);
            $this->load->view('template/footer');
        }
    }
}

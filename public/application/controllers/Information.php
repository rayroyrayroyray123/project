<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Information extends CI_Controller {

	public function index()
	{
        $this->load->model('user_model');
        $this->load->model('Favourite_model');
        $data = array(
            'error' => "",
            'username' =>  $this->session->userdata('username'),
            'query' => $this->Favourite_model->search_UserFavourite($this->session->userdata('username')),
            'email' => $this->user_model->get_email($this->session->userdata('username'))
        );

        $this->load->view('template/header'); 
    	if (!$this->session->userdata('logged_in'))//check if user already login
		{	
			if (get_cookie('remember')) { // check if user activate the "remember me" feature  
				$username = get_cookie('username'); //get the username from cookie
				$password = get_cookie('password'); //get the username from cookie
				if ( $this->user_model->login($username, $password) )//check username and password correct
				{
					$user_data = array('username' => $username,'logged_in' => true );
					$this->session->set_userdata($user_data); //set user status to login in session
					$this->load->view('file',array('error' => ' ')); 
                    $this->load->view('information', array('error' => ' '));
                    $this->load->view('map');//if user already logined show upload page
				}
			}else{
				redirect('login'); //if user already logined direct user to home page
			}
		}else{
			$this->load->view('information', $data);
            $this->load->view('map'); //if user already logined show login page
		}
		$this->load->view('template/footer');
	}

    public function change_information(){
        $this->load->model('user_model');

        $new_password = $this->input->post('password');
        if($new_password == ""){
            $new_password = $this->user_model->get_password($this->session->userdata('username'));
        }

        $username = $this->session->userdata('username');

        $new_email = $this->input->post('email');
        if($new_email == ""){
            $new_email =  $this->user_model->get_email($this->session->userdata('username'));
        }
        
        if($this->user_model->alter_information($username, $new_password, $new_email)){
            $this->load->model('user_model');
            $data = array(
                'error' => "User profile update success",
                'username' =>  $this->session->userdata('username'),
                'email' => $this->user_model->get_email($this->session->userdata('username'))
            );
            $this->load->view('template/header');
            $this->load->view('information', $data);
            $this->load->view('map');
            $this->load->view('template/footer');
        }else{
            $this->load->model('user_model');
            $data = array(
                'error' => "User profile update failed. Cannot have the same email address",
                'username' =>  $this->session->userdata('username'),
                'email' => $this->user_model->get_email($this->session->userdata('username'))
            );
            $this->load->view('template/header');
            $this->load->view('information', $data);
            $this->load->view('map');
            $this->load->view('template/footer');
        }
    }
}

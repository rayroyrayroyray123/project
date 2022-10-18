<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class login extends CI_Controller {
	public function index()
	{
		$data['error']= "";
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->helper('captcha');
		
		$this->load->view('template/header');

		$vals = array(
            //'word'        => 'Random word',
            'img_path'    => '/var/www/htdocs/book/assets/img/',
            'img_url'    => base_url().'/assets/img/',
            'font_path'     => '/var/www/htdocs/book/system/fonts/texb.ttf',
            'img_width'     => '150',
            'img_height'    => 30,
            'expiration'    => 7200
        );
        
        
        $cap = create_captcha($vals);
        echo $cap['word'];
		$user_data['captcha'] = $cap['word'];
		$data['captcha'] = $cap['image'];
		if (!$this->session->userdata('logged_in'))//check if user already login
		{	
			if (get_cookie('remember')) { // check if user activate the "remember me" feature  
				$username = get_cookie('username'); //get the username from cookie
				$password = get_cookie('password'); //get the password from cookie
				$encry_password = md5($password);
				if ( $this->user_model->login($username, $encry_password) )//check username and password correct
				{
					$user_data = array(
						'username' => $username,
						'logged_in' => true 	//create session variable
					);
					$this->session->set_userdata($user_data); //set user status to login in session
					$this->load->view('welcome_message'); //if user already logined show main page
				}
			}else{
				$this->load->view('login', $data);	//if username password incorrect, show error msg and ask user to login
			}
		}else{
			$this->load->view('welcome_message'); //if user already logined show main page
		}
		$this->session->set_userdata($user_data); 
		$this->load->view('template/footer');
	}
	
	public function check_login()
	{
		$this->load->model('user_model');		//load user model
		$data['error']= "<div class=\"alert alert-danger\" role=\"alert\"> Incorrect username or passwrod!! OR You haven't finished email vertification!!</div> ";
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->view('template/header');
		$username = $this->input->post('username'); //getting username from login form
		$password = $this->input->post('password'); //getting password from login form
		$encry_password = md5($password);
		$remember = $this->input->post('remember'); //getting remember checkbox from login form
		$captcha = $this->input->post('captcha'); //getting remember checkbox from login form

		if($captcha != $this->session->userdata('captcha')){
			echo "Captcha incorrect";
			// echo $captcha;
			// echo $this->session->userdata('captcha');
			redirect('login'); //if user already logined direct user to home page
		}

		echo $encry_password;
		if(!$this->session->userdata('logged_in')){	//Check if user already login
			// echo "check!";
			if ( $this->user_model->login($username, $encry_password) )//check username and password
			{
				// echo "Login success";
				$user_data = array(
					'username' => $username,
					'captcha' => $captcha,
					'logged_in' => true 	//create session variable
				);
				if($remember) { // if remember me is activated create cookie
					set_cookie("username", $username, '300'); //set cookie username
					set_cookie("password", $encry_password, '300'); //set cookie password
					set_cookie("remember", $remember, '300'); //set cookie remember
					set_cookie("captcha", $captcha, '300');
				}	
				$this->session->set_userdata($user_data); //set user status to login in session
				redirect('login'); // direct user home page
			}else
			{
				$this->load->view('login', $data);	//if username password incorrect, show error msg and ask user to login
			}
		}else{
			{
				redirect('login'); //if user already logined direct user to home page
			}
		$this->load->view('template/footer');
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('logged_in'); //delete login status
		redirect('login'); // redirect user back to login
	}
}
?>
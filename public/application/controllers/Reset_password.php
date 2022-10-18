<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reset_password extends CI_Controller {

	public function index()
	{
        $data['error'] = "";
        $this->load->view('template/header');
		$this->load->view('reset_password', $data);
        $this->load->view('template/footer');
	}

    public function reset(){
		$this->load->helper('cookie');

        $username = get_cookie('username'); //get the username from cookie
		// echo get_cookie('password'); //get the password from cookie
        $first_password = $this->input->post('new_password');
        $second_password = $this->input->post('password');

        if($first_password == $second_password){
            $this->user_model->reset_password($username, $first_password);
            $data['error'] = "Password change successfully";
            $data['captcha'] = $this->generate_captcha();
            $this->load->view('template/header');
            $this->load->view('login', $data);
            $this->load->view('template/footer');
        }else{
            $data['error'] = "Both password should be the same";
            $this->load->view('template/header');
            $this->load->view('reset_password', $data);
            $this->load->view('template/footer');
        }


    }

    public function generate_captcha(){
        $this->load->helper('captcha');

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

        return $cap['image'];
    }
}

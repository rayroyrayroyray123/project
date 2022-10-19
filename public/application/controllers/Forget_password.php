<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class forget_password extends CI_Controller {

	public function index()
	{
        $data['error'] ="";
		$this->load->view('template/header');
        $this->load->view('forget_password', $data);

        $this->load->view('template/footer');
	}

    public function send_email(){

        $this->load->helper("form");
        $username = $this->input->post("username");
        $email = $this->input->post("email");
        $reset_password_page = base_url()."reset_password";

        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'mailhub.eait.uq.edu.au',
            'smtp_port' => 25,
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE, 
            'mailtype' => 'html',
            'starttls' => true, 
            'newline' => "\r\n"
        );
        $this->email->initialize($config);

        // From my UQ email to the input email.
        $this->email->from('pingjui.lee@uq.edu.au', "Ray");
        $this->email->to($email);
        $this->email->subject('Reset email from INFS3202 demo');
        $this->email->message($reset_password_page);

        // echo $email;
        // echo $this->user_model->get_email($username);
        if($this->user_model->check_username_exist($username)){
            if($email == $this->user_model->get_email($username)){
                // Check the email is successfully sent or not.
                if($this->email->send()){
                    $data['error'] = "Please check your email to reset the password";
                    $data['captcha'] = $this->generate_captcha();
                    set_cookie("username", $username, '300');
                    $this->load->view('template/header');
                    $this->load->view('login', $data);
                }else{
                    $data['error'] ="Fail to send the mail";
                    $data['captcha'] = $this->generate_captcha();
                    $this->load->view('template/header');
                    $this->load->view('forget_password', $data);
                }
            }else{
                $data['error'] ="Please enter the email address you entered when registering";
                $data['captcha'] = $this->generate_captcha();
                $this->load->view('template/header');
                $this->load->view('forget_password', $data);
            }
        }else{
            $data['error'] ="Cannot find the user name";
            $data['captcha'] = $this->generate_captcha();
            $this->load->view('template/header');
            $this->load->view('forget_password', $data);
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

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

	public function index()
	{
        $data['error']= "";
        $this->load->view('template/header');
        if (!$this->session->userdata('logged_in')){
            $this->load->view('register', $data);
        }else{
            $this->load->view('welcome_message');
        }

		$this->load->view('template/footer');        
	}

    public function do_register(){
        $this->load->model('user_model');

        $username = $this->input->post('username');
		$password = $this->input->post('password');
        $email = $this->input->post("email");
        // $captcha_response = $this->input->post('g-recaptcha-response');

        $random_number = md5(time());
        $verify_code = md5($username);
        $encry_password = md5($password);

        if (!$this->check_passwordStrength($password)) {
            $data['error']= "Your password should exceed eight words";
            $this->load->view('template/header');
            $this->load->view('register', $data);
    
            $this->load->view('template/footer');   
        } else if ($this->user_model->check_username_exist($username)){
            $data['error']= "This username has been used";
            $this->load->view('template/header');
            $this->load->view('register', $data);
    
            $this->load->view('template/footer'); 
        } else if ($this->user_model->check_email_exist($email))
        {
            $data['error']= "This email has been used";
            $this->load->view('template/header');
            $this->load->view('register', $data);
    
            $this->load->view('template/footer'); 
        }
        // else if ($captcha_response == '')
        // {
        //     $data['error']= "Please do the recaptcha";
        //     $this->load->view('template/header');
        //     $this->load->view('register', $data);
    
        //     $this->load->view('template/footer');      
        // } 
        else
        {
            // Store some information
            // $data['verify_code'] = $verify_code;
            // $data['active'] = false;
            // $data['username'] = $username;
            // $data['random_number'] = $random_number;
            // $this->session->set_userdata($data);
    
            // $register_message = base_url()."Register/email_vertification/".$verify_code."/".$random_number;
    
            // $config = Array(
            //     'protocol' => 'smtp',
            //     'smtp_host' => 'mailhub.eait.uq.edu.au',
            //     'smtp_port' => 25,
            //     'mailtype' => 'html',
            //     'charset' => 'iso-8859-1',
            //     'wordwrap' => TRUE, 
            //     'mailtype' => 'html',
            //     'starttls' => true, 
            //     'newline' => "\r\n"
            // );
            // $this->email->initialize($config);
    
            // From my UQ email to the vertification email.
            // $this->email->from('pingjui.lee@uq.edu.au', "Ray");
            // $this->email->to($email);
            // $this->email->subject('Register email from INFS3202 demo');
            // $this->email->message($register_message);
            
            // // register success and doesn't show any error
            $this->user_model->register($username, $encry_password, $email);
            $this->user_model->activate($username);
            // if($this->user_model->register($username, $encry_password, $email))
            // {
            //     if($this->email->send())
            //     {
            //         $data['error']= "Please check your email to complete vertification";
            //         // $data['captcha'] = $this->generate_captcha();
            $this->load->view('template/header');
            $this->load->view('login', $data);
            $this->load->view('template/footer');
            //     }else
            //     {
            //         $data['error']= "send failed";
            //         // $data['captcha'] = $this->generate_captcha();
            //         $this->load->view('template/header');
            //         $this->load->view('login', $data);
            //         $this->load->view('template/footer');
            //     }            
            // }else
            // {
            //     // Failed to register
            //     $data['error']= "Register failed. Please use another name";
            //     $this->load->view('template/header');
            //     $this->load->view('register', $data);
            // }
        }


    }

    public function check_passwordStrength($password){
        if (strlen($password) < 8) {
            return false;
        } else {
            return true;
        }
    }

    // public function email_vertification(){
    //     $verify_code = $this->uri->segment(3);
    //     $random_number = $this->uri->segment(4);
    //     $code = $this->session->userdata('verify_code');
    //     $number = $this->session->userdata('random_number');
    //     $this->load->model('user_model');
    
    //     // echo $verify_code."\n", $random_number."\n" ,$code."\n", $number."\n";
    //     if($verify_code == $code)
    //     {
    //         if($random_number == $number)
    //         {
    //             $query = $this->user_model->activate($this->session->userdata('username'));
    //             if($query){
    //                 $data['error'] = "Email vertification complete!!!";
    //                 $data['captcha'] = $this->generate_captcha();
    //                 $this->load->view('template/header');
    //                 $this->load->view('login', $data);
    //                 $this->load->view('template/footer');
    //             }else{
    //                 $data['error'] = "Query failed";
    //                 $data['captcha'] = $this->generate_captcha();
    //                 $this->load->view('template/header');
    //                 $this->load->view('login', $data);
    //                 $this->load->view('template/footer');
    //             }
    //         }
    //         else
    //         {
    //             $data['error'] = "Failed";
    //             $data['captcha'] =  $this->generate_captcha();
    //             $this->load->view('template/header');
    //             $this->load->view('login', $data);
    //             $this->load->view('template/footer');
    //         }
    //     }else{
    //         $data['error'] = "Failed";
    //         $data['captcha'] = $this->generate_captcha();
    //             $this->load->view('template/header');
    //             $this->load->view('login', $data);
    //             $this->load->view('template/footer');
    //     }
    // }

    // public function generate_captcha(){
    //     $this->load->helper('captcha');

    //     $vals = array(
    //         //'word'        => 'Random word',
    //         'img_path'    => '/var/www/htdocs/book/assets/img/',
    //         'img_url'    => base_url().'/assets/img/',
    //         'font_path'     => '/var/www/htdocs/book/system/fonts/texb.ttf',
    //         'img_width'     => '150',
    //         'img_height'    => 30,
    //         'expiration'    => 7200
    //     );
        
        
    //     $cap = create_captcha($vals);

    //     return $cap['image'];
    // }

}

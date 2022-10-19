<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Image_controller extends CI_Controller {
	public function index()
	{
        $data['watermark_image'] = "";        
        $this->load->library('image_lib');
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
                    $this->load->view('image_view', array('error' => ' ')); //if user already logined show upload page
				}
			}else{
				redirect('login'); //if user already logined direct user to home page
			}
		}else{
			$this->load->view('image_view', $data); //if user already logined show login page
		}
        $this->load->view('down');
		$this->load->view('template/footer');
	}

    public function value(){
        
        if($this->input->post('submit')){
            // echo "submit";
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'jpg|mp4|mkv|png|jpeg';
            $config['max_size'] = 10000;
            $config['max_width'] = 1024;
            $config['max_height'] = 768;
        }

        $this->load->library('upload', $config);
        
        if ($this->upload->do_upload()) {
            //If image upload in folder, set also this value in "$image_data".
            // echo "Worked           ";
            $image_data = $this->upload->data();
        }

        switch($this->input->post("mode")){
            case "watermark":
                $data = $this->water_marking($image_data);
                $this->load->view('template/header');
                $this->load->view('image_view', $data);
                $this->load->view('down');
                // redirect('image_view');
                break;
            case "crop":
                $data = $this->crop($image_data);
                $this->load->view('template/header');
                $this->load->view('image_view', $data);
                $this->load->view('down');
                // redirect('image_view');
                break;
            case "resize":
                $data = $this->resize($image_data);
                $this->load->view('template/header');
                $this->load->view('image_view', $data);
                $this->load->view('down');
                // redirect('image_view');
                break;
            case "rotate":
                $data = $this->rotate($image_data);
                $this->load->view('template/header');
                $this->load->view('image_view', $data);
                $this->load->view('down');
                // redirect('image_view');
                break;
        }
    }

    public function water_marking($image_data){
        $img = substr($image_data['full_path'], 30);
        // echo $img;
        $config['image_library'] = 'gd2';
        $config['source_image'] = $image_data['full_path'];
        $config['wm_text'] = 'ray_ray_wow '.date("h:i:sa");
        $config['wm_type'] = 'text';
        $config['wm_font_size'] = '50';
        $config['wm_font_color'] = '#707A7C';
        $config['wm_hor_alignment'] = 'center';
        $config['new_image'] = "./uploads/watermark_".$img;
        // echo "Setting watermark   ";
        print_r($config['new_image'] );
        $this->load->library('image_lib');
        $this->image_lib->initialize($config);
        $src = $config['new_image'];
        $data['watermark_image'] = substr($src, 2);
        $data['watermark_image'] = base_url(). $data['watermark_image'];

        $this->image_lib->watermark();

        return $data;
    }

    public function resize($image_data){
        $img = substr($image_data['full_path'], 30);

        $config['image_library'] = 'gd2';
        $config['source_image'] = $image_data['full_path'];
        // $config['create_thumb'] = TRUE;
        $config['maintain_ratio'] = TRUE;
        $config['width']     = 75;
        $config['height']   = 50;
        $config['new_image'] = "./uploads/resize_".$img;

        $this->load->library('image_lib', $config);

        $src = $config['new_image'];
        $data['watermark_image'] = substr($src, 2);
        $data['watermark_image'] = base_url(). $data['watermark_image'];

        $this->image_lib->resize();

        return $data;
    }

    public function crop($image_data){
        $img = substr($image_data['full_path'], 30);

        $config['image_library'] = 'gd2';
        $config['source_image'] = $image_data['full_path'];
        // $config['create_thumb'] = TRUE;
        $config['maintain_ratio'] = TRUE;
        $config['width']     = 75;
        $config['height']   = 50;
        $config['new_image'] = "./uploads/crop_".$img;

        $this->load->library('image_lib', $config);

        $src = $config['new_image'];
        $data['watermark_image'] = substr($src, 2);
        $data['watermark_image'] = base_url(). $data['watermark_image'];
        $this->image_lib->crop();

        return $data;
    }

    public function rotate($image_data){
        $img = substr($image_data['full_path'], 30);

        $config['image_library'] = 'gd2';
        $config['source_image'] = $image_data['full_path'];
        $config['maintain_ratio'] = TRUE;
        $config['rotation_angle'] = '90';
        $config['new_image'] = "./uploads/rotate_".$img;

        $this->load->library('image_lib', $config);

        $src = $config['new_image'];
        $data['watermark_image'] = substr($src, 2);
        $data['watermark_image'] = base_url(). $data['watermark_image'];

        $this->image_lib->rotate();

        return $data;
    }
}

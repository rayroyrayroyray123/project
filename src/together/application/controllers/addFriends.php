<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class addFriends extends CI_Controller {
    public function index(){
        $data['title'] = 'Social';
		// $data['user'] = $this->UserModel->get_user($user_id);
		$this->load->view('templates/header');
		$this->load->view('pages/addFriends', $data);
		$this->load->view('templates/footer');
    }
}
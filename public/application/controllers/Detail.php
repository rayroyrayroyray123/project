<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Detail extends CI_Controller {
	public function index($filename)
	{
        $this->find($filename);
	}

    public function find($filename) {
        $data['filename'] = $filename;
        $this->load->view('detail', $data);
    }
}

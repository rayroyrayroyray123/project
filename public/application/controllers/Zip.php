<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Zip extends CI_Controller {
    function __contruct(){
        parent::__construct();
        $this->load->library('zip');
    }

    function download(){
        $this->load->library('zip');
        

        $this->zip->read_dir('./uploads/');

        $this->zip->archive('./uploads/'.'images.zip');

        $this->zip->download('images.zip');
    }
}

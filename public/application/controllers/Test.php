<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {
	public function index()
	{
        $this->load->helper('captcha');
		$vals = array(
            'word'        => 'Random word',
            'img_path'    => '/var/www/htdocs/book/assets/img/',
            'img_url'    => base_url().'/assets/img/',
            'font_path'     => '/var/www/htdocs/book/system/fonts/texb.ttf',
            'img_width'     => '150',
            'img_height'    => 30,
            'expiration'    => 7200
        );
        
        
        $cap = create_captcha($vals);
        echo $cap['image'];
	}
}

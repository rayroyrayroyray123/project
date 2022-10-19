<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 //put your code here 
 class Comment_model extends CI_Model{

    // upload file
    public function save_comment($comment, $username){
        $data['comment'] = $comment;
        $data['username'] = $username;
        $this->db->insert('Comments',$data);
    }

    public function upload($filename, $path, $username){
        $data = array(
            'filename' => $filename,
            'path' => $path,
            'username' => $username
        );
        $query = $this->db->insert('files', $data);

    }

    public function retrieve_comment(){
        return $this->db->get('Comments');
    }
}
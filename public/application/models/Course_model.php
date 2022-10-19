<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 //put your code here 
 class Course_model extends CI_Model{

    function fetch_course() 
    {
        $this->db->select("*");
        $this->db->from("course");
        return $this->db->get();
    }

    public function add_course($courseName, $courseDetail, $courseTeacher){
        $data['course_name'] = $courseName;
        $data['teacher'] = $courseTeacher;
        $data['course_detail'] = $courseDetail;
        $data['likes'] = 0;
        $this->db->insert('course',$data);
        
    }   

    public function course_count(){
        $query = $this->db->query('SELECT * FROM course');
        return $query->num_rows();
    }
}
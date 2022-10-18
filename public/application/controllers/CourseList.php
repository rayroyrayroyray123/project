<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CourseList extends CI_Controller {

	public function index()
	{
        if (get_cookie('page_number') != null) {
            $data['scroll_place'] = get_cookie('page_number');
        } 
        $this->load->model('Course_model');
        $data['query'] = $this->Course_model->fetch_course();
        $data['error'] = "";
        $this->load->view('template/header');
		$this->load->view('courseList', $data);
        $this->load->view('template/footer');
	}

    public function add_Course() {
        $this->load->model('Course_model');
        $courseName = $this->input->post('courseName');
        $courseDetail = $this->input->post('courseDetail');
        $courseTeacher = $this->session->userdata('username');
        $this->Course_model->add_Course($courseName, $courseDetail, $courseTeacher);
        redirect('CourseList');
    }

    public function add_favourite_course(){
        $this->load->model('Favourite_model');
        $this->load->model('Course_model');
        $username = $this->session->userdata('username');
        // echo $username;
        $count = $this->Course_model->course_count();
        for ($i = 1; $i <= $count; $i++) {
            $courseName = $this->input->post($i);
            if (isset($courseName)) {
                $exist = $this->Favourite_model->search_favourite($courseName, $username);
                if ($exist < 1){
                    $this->Favourite_model->add_favorite($courseName, $username);
                    $data['error'] = "Add a course to the favourite list success!!!!";
                    $data['query'] = $this->Course_model->fetch_course();
                    $this->load->view('template/header');
                    $this->load->view('courseList', $data);
                    $this->load->view('template/footer');
                } else {
                    // echo "You have already add this course as favourite";
                    $data['error'] = "Add failed!!!!!!!";
                    $data['query'] = $this->Course_model->fetch_course();
                    $this->load->view('template/header');
                    $this->load->view("courseList", $data);
                    $this->load->view('template/footer');
                }
            }
        }
        // foreach($this->input->$_POST['1'] as $row){
        //     echo $row;
        // }
        // $this->Favourite_model->add_favourite($username, );
    }

}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Calendar extends CI_Controller {
	public function index()
	{
        
        $this->load->view('template/header');
        $this->load->model('Calendar_model');
        $prefs = array(
            'show_next_prev'  => TRUE,
            'next_prev_url'   => 'https://infs3202-7976c100.uqcloud.net/book/Calendar/index/'
        );
        $this->load->library('calendar', $prefs);

        // echo $this->uri->segment(3);
        if (($this->uri->segment(3) != "") ) {
            // echo "Gen";
            // echo $this->uri->segment(4);
            $query = $this->Calendar_model->searchDate($this->uri->segment(3), $this->uri->segment(4));
        } else {
            // echo "Dont";
            $query = $this->Calendar_model->searchDate(date("Y"), date("m"));
        }
        
        foreach( $query->result() as $row )
        {
            $event[$row->day] = "https://infs3202-7976c100.uqcloud.net/book/Calendar/detail/".$row->year."/".$row->month."/".$row->day;
        }
        
        if (isset($event)){
            $data['calendar'] =  $this->calendar->generate($this->uri->segment(3), $this->uri->segment(4),  $event);
        }else{
            $data['calendar'] =  $this->calendar->generate($this->uri->segment(3), $this->uri->segment(4));
        }

        $data['error'] = "";
        $this->load->view('calendar', $data);
        $this->load->view('template/footer');
	}

    public function add_event(){
        $this->load->model('Calendar_model');

        $date =  $this->input->post('date');
        $event = mb_split("-", $date);
        $description = $this->input->post('detail');

        $this->Calendar_model->addEvent($event[0],$event[1], $event[2], $description );
        
        // $this->load->view('Alert');
        // $this->index();
       redirect('Calendar');
    }

    public function detail($year, $month, $day){
        $this->load->view('template/header');
        $this->load->model('Calendar_model');
        $query = $this->Calendar_model->find_description($year, $month, $day);
        $detail = $query->result();
        // echo $detail->description;
        foreach( $query->result() as $row )
        {
            $data['description'] = $row->description;
        }
        // $data = array(
        //     'date' => $year.$month.$day,
        //     'description' => $detail->description
        // );
        $data['date'] = $year."/".$month."/".$day;
        
        $this->load->view('calendar_detail', $data);
        // echo "Hi";
    }

    public function delete(){
        $this->load->model('Calendar_model');
        $event_day =  $this->input->post('calendar_detail');
        $event = mb_split("/", $event_day);
        $this->Calendar_model->delete_event($event[0], $event[1], $event[2]);
        redirect('Calendar');
    }

}

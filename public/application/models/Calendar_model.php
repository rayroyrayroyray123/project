<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 //put your code here 
 class Calendar_model extends CI_Model{

    public function addEvent($year, $month, $day, $description){
        $query = $this->db->where('year', $year)
            ->where('month', $month)
            ->where('day', $day)
            ->get('Calendar');
        $data['year'] = $year;
        $data['month'] = $month;
        $data['day']= $day;
        $data['description'] = $description;
        if ($query->num_rows() == 0){
            $this->db->insert('Calendar', $data);
        }
        
    }

    public function searchDate($year, $month){
        $query = $this->db->where('year', $year)->where('month', $month)->get('Calendar');
        // $this->db->where('month', $month);
        return $query;
    }

    public function find_description($year, $month, $day)
    {
        $query = $this->db->where('year', $year)->where('month', $month)->where('day', $day)->get('Calendar');
        return $query;
    }

    public function delete_event($year, $month, $day)
    {
        $query = $this->db->where('year', $year)
            ->where('month', $month)
            ->where('day', $day)
            ->delete('Calendar');
    }
}
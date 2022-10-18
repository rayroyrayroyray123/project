<?php
    class Post_model extends CI_Model{
        public function __construct(){
            $this->load->database();
        }

        public function get_events($id = FALSE, $sortby = 'events.id', $user_id = FALSE){
            if ($user_id){
                $this->db->order_by($sortby, 'DESC');
                $this->db->select('events.*, users.img AS img, users.username AS username');
                $this->db->from('events', 'users');
                $this->db->where('events.auth_id', $user_id);
                $this->db->join('users', 'users.id=events.auth_id');
                $query = $this->db->get();
                return $query->result_array();
            }

            if ($id === FALSE){
                $query = $this->db->query('
                    SELECT e.*, u.img AS img, u.username AS username 
                    FROM `events` e, `users` u
                    WHERE u.id=e.auth_id
                    and e.event_date > current_date 
                    order by e.event_date ASC;');
                return $query->result_array();
            }

            $query = $this->db->query('
                SELECT e.*, u.img AS img, u.username AS username 
                FROM `events` e, `users` u 
                WHERE u.id=e.auth_id and e.id = '.$id.';
            ');
            return $query->row_array();
        }

        public function get_attended_events($user_id){
            $query = $this->db->query('
                SELECT DISTINCT e.*, u.img AS img, u.username AS username 
                FROM `events` e, `users` u, `joins` j 
                WHERE u.id=e.auth_id and ((j.event_id = e.id and j.user_id = '.$user_id.') or e.auth_id = '.$user_id.') 
                and e.event_date < current_date 
                order by e.event_date DESC;');
            return $query->result_array();
        }

        public function get_scheduled_events($user_id){
            $query = $this->db->query('
                SELECT DISTINCT e.*, u.img AS img, u.username AS username 
                FROM `events` e, `users` u, `joins` j 
                WHERE u.id=e.auth_id and ((j.event_id = e.id and j.user_id = '.$user_id.') or e.auth_id = '.$user_id.') 
                and e.event_date > current_date 
                order by e.event_date ASC;');
            return $query->result_array();
        }

        public function insert_event($mode){
            if($mode === 'online'){
                $data = array(
                    'auth_id' => $this->input->post('user_id'),
                    'title' => $this->input->post('eventTitle'),
                    'body' => $this->input->post('description'),
                    'category' => $this->input->post('category'),
                    'event_date' => $this->input->post('eventDate'),
                    'event_time' => $this->input->post('eventTime'),
                    'event_duration' => $this->input->post('eventDuration'),
                    'zoomlink' => $this->input->post('zoomlink'),
                    'event_people' => $this->input->post('eventPeople'),
                    'event_type' => $this->input->post('eventType'),
                    'event_img' => implode(',', $_POST['eventImg'])
                );
            }else{
                $data = array(
                    'auth_id' => $this->input->post('user_id'),
                    'title' => $this->input->post('eventTitle'),
                    'body' => $this->input->post('description'),
                    'category' => $this->input->post('category'),
                    'event_date' => $this->input->post('eventDate'),
                    'event_time' => $this->input->post('eventTime'),
                    'event_duration' => $this->input->post('eventDuration'),
                    'event_location' => $this->input->post('choosen_address'),
                    'google_map' => implode(',', $_POST['location']),
                    'event_people' => $this->input->post('eventPeople'),
                    'event_type' => $this->input->post('eventType'),
                    'event_img' => implode(',', $_POST['eventImg'])
                );
            }
            
    
            //Insert event
            return $this->db->insert('events', $data);
        }

        public function insert_attend(){
            $data = array(
                'user_id'=> $this->input->post('user_id'), 
                'event_id'=> $this->input->post('event_id'),
            );
            $this->db->insert('joins', $data);
            return 'attend';
        }

        public function delete_attend(){
            $data = array(
                'user_id'=> $this->input->post('user_id'), 
                'event_id'=> $this->input->post('event_id'),
            );
            $this->db->delete('joins', $data);
            return 'cancel';
        }

        public function get_attend_list(){
            $event_id = $this->input->post('event_id');
            $this->db->select('*');
            $this->db->from('joins');
            $this->db->where('event_id', $event_id);
            $query = $this->db->get();
            return $query->result_array();
        }

        public function search_events(){
            $keywords = explode(" ", $this->input->post('keyword'));
            
            foreach($keywords as $key){
                $this->db->like("title", $key);
            }
            
            return $this->db->get('events')->result_array();
        }

        public function get_events_by($keyword = FALSE, $post_id = FALSE){
            $keywords = explode(" ", $keyword);
            $this->db->select('*');
            
            if(!$keyword){
                $keyword = $this->get_events($post_id)['title'];
                $this->db->from('events');
                $this->db->like("title", $keyword);
                $this->db->join('users', 'users.id=events.auth_id');
                return $this->db->get()->result_array();
            }
            $this->db->from('events');
            foreach($keywords as $key){
                $this->db->like("title", $key);
            }
            $this->db->join('users', 'users.id=events.auth_id');
            $this->db->order_by('events.id', 'DESC');
            return $this->db->get()->result_array();
        }

        public function get_filtered_events(){
            $mode = $this->input->post('mode');
            $type = $this->input->post('type');
            $preferences = explode(",",$this->input->post('preferences'));
            $mode_sql = '';
            $type_sql = '';
            $preferences_sql = '';
            if($mode == 'both' && $type == 'both' && count($preferences) == 1){
                return 'No condition applied';
            }else{
                $sql = 'SELECT e.*, u.img AS img, u.username AS username FROM `events` e, `users` u 
                        WHERE u.id=e.auth_id and e.event_date > current_date and ';
            }

            if($mode !== 'both' && ($type !== 'both'|| count($preferences) !== 1)){
                $sql .= ('e.event_mode = "'.$mode.'" and ');
            }else if($mode == 'both'){
                $sql .= '';
            }else{
                $sql .= ('e.event_mode = "'.$mode.'"');
            }
            if($type !== 'both' && count($preferences) !== 1){
                $sql .= ('e.event_type = "'.$type.'" and ');
            }else if($type == 'both'){
                $sql .= '';
            }else{
                $sql .= ('e.event_type = "'.$type.'"');
            }
            if(count($preferences) > 1){
                foreach($preferences as $preference){
                    if(array_search($preference, $preferences) == 0){
                        $sql .= '(e.category like '.$preference;
                    }else if($preference !== ''){
                        $sql .= ' or e.category like '.$preference;
                    }
                }
                $sql .= ')';
            }
            
            $query = $this->db->query($sql);
            return $query->result_array();
            
        }

        public function upcoming_events($user_id){
            $query = $this->db->query('
                SELECT DISTINCT e.*, u.img AS img, u.username AS username 
                FROM `events` e, `users` u, `joins` j 
                WHERE u.id=e.auth_id and ((j.event_id = e.id and j.user_id = '.$user_id.') or e.auth_id = '.$user_id.') 
                AND DATEDIFF(e.event_date, current_date) < 30
                AND DATEDIFF(e.event_date, current_date) > 0
                order by e.event_date ASC;');
            return $query->result_array();
        }

    }
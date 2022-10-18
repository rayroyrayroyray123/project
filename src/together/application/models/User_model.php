<?php
    class User_model extends CI_Model{
        public function __construct(){
            $this->load->database();
    
        }
    
        public function register(){
            $data = array(
                'email' => $this->input->post('email'),
                'username' => $this->input->post('username'),
                'password' => $this->input->post('password'),
                'gender' => $this->input->post('gender-option'),
                'birthdate' => $this->input->post('birthdate'),
                'location' => $this->input->post('form-country'),
                'preferences' => implode(',', $_POST['preferences'])
            );
    
            //Insert user
            return $this->db->insert('users', $data);
        }

        public function login($username=FALSE, $password=FALSE, $email=FALSE){
            if($username){
                $this->db->where('username', $username);
            }
            if($password){
                $this->db->where('password', $password);
            }
            if($email){
                $this->db->where('email', $email);
            }
           
            $query = $this->db->get('users');
    
            if($query->num_rows() == 1){
                return $query->row(0)->id;
            }else{
                return false;
            }
        }

        public function check_username_exists($username){
            $query = $this->db->get_where('users', array('username'=> $username));
    
            if(empty($query->row_array())){
                return true;
            }else{
                return false;
            }
        }
    
        public function check_email_exists($email){
            $query = $this->db->get_where('users', array('email'=> $email));
    
            if(empty($query->row_array())){
                return true;
            }else{
                return false;
            }
        }

        public function get_user($user_id){
            $query = $this->db->get_where('users', array('id' => $user_id));
            return $query->row_array();
        }

        public function update_preferences(){
            $data = array(
                'preferences' => implode(',', $_POST['preferences'])
            );
            $this->db->where('id', $this->input->post('user_id'));
            $this->db->update('users', $data);
        }

        public function update_user($edit_items){
            if($edit_items == 'profile'){
                $data = array(
                    'email' => $this->input->post('email'),
                    'event_location' => $this->input->post('event_location'),
                    'zoom_link' => $this->input->post('zoom_link'),
                );
            };
            $this->db->where('id', $this->input->post('user_id'));
            $this->db->update('users', $data);
        }

        public function update_user_img($user_id, $image){
            $data = array(
                'img' => $image
            );
            $this->db->where('id', $user_id);
            $this->db->update('users', $data);
        }

        public function get_friend_list($user_id){
            $query = $this->db->get_where('friends', array('user_id'=> $user_id));
            return $query -> row_array();
        }

        function get_lists($user_id, $action=FALSE){
            if($this->input->post('action')){
                $action = $this->input->post('action');
            }
            if($action == 'requests_list'){
                $this->db->order_by('friendships.request_create_at', 'DESC');
                $this->db->select('friendships.receiver_id AS user_id, 
                    friendships.sender_id AS friend_id, users.username AS friend_name, users.img AS friend_img');
                $this->db->from('friendships', 'users');
                $this->db->where('friendships.receiver_id', $user_id);
                $this->db->where('friendships.friend_request_status', 'pending');
                $this->db->join('users', 'users.id=friendships.sender_id');
                $query = $this->db->get();
                return $query->result_array();
                
            }
            if($action == 'friends_list'){
                // $this->db->order_by('users.username', 'ASC');
                $this->db->select('friendships.receiver_id AS user_id,
                    friendships.sender_id AS friend_id, users.username AS friend_name, users.img AS friend_img');
                $this->db->from('friendships', 'users');
                $this->db->where('friendships.receiver_id', $user_id);
                $this->db->where('friendships.friend_request_status', 'accept');
                $this->db->join('users', 'users.id=friendships.sender_id');
                $query1 = $this->db->get()->result_array();

                $this->db->select('friendships.sender_id AS user_id,
                    friendships.receiver_id AS friend_id, users.username AS friend_name, users.img AS friend_img');
                $this->db->from('friendships', 'users');
                $this->db->where('friendships.sender_id', $user_id);
                $this->db->where('friendships.friend_request_status', 'accept');
                $this->db->join('users', 'users.id=friendships.receiver_id');
                $query2 = $this->db->get()->result_array();
                
                return array_merge($query1, $query2);
                // return 'success';
            }
            if($action == 'chats_list'){
                $query = $this->db->query('
                    SELECT max(mess_id) as mess_id, z.friend_id, max(chat_time) as chat_time, sum(case when z.mess_status = "unread" THEN 1 ELSE NULL END) as unread_count from 
                    (SELECT c1.chat_message_id AS mess_id, c1.sender_id AS friend_id, c1.chat_message_time as chat_time, c1.chat_message_status as mess_status
                    FROM `chats` c1, `users` u1
                    WHERE c1.receiver_id = '.$user_id.' and u1.id=c1.sender_id 
                    UNION ALL
                    SELECT c2.chat_message_id AS mess_id, c2.receiver_id AS friend_id, c2.chat_message_time as chat_time, c2.chat_message_status as mess_status 
                    FROM `chats` c2, `users` u2  
                    WHERE c2.sender_id = '.$user_id.' and u2.id=c2.receiver_id and c2.chat_message_status ="read") AS z
                    group by z.friend_id 
                    ORDER BY unread_count DESC, mess_id DESC;
                ');

                return $query->result_array();
            }
        }

        public function update_request_status($status, $receiver_id, $sender_id){
            $chatable = 'no';
            if($status == 'accept'){$chatable = 'yes';}
            $data = array(
                'friend_request_status' => $status,
                'chatable' => $chatable
            );
            $this->db->where('sender_id', $sender_id);
            $this->db->where('receiver_id', $receiver_id);
            $this->db->update('friendships', $data);
        }

        public function update_message_status($status, $receiver_id, $sender_id){
            $data = array(
                'chat_message_status' => $status
            );
            $this->update_chat_status($data, $sender_id, $receiver_id);
        }
        
        public function update_chat_status($data, $id1, $id2){
            $this->db->where('sender_id', $id1);
            $this->db->where('receiver_id', $id2);
            $this->db->update('chats', $data);
        }

        public function load_chat_data($receiver_id, $sender_id){
            
            $query = $this->db->query('SELECT receiver_id, sender_id, chat_message_text, chat_message_time 
            FROM chats WHERE sender_id = '.$sender_id.' AND receiver_id = '.$receiver_id.' UNION SELECT receiver_id, 
            sender_id, chat_message_text, chat_message_time FROM chats WHERE sender_id = '.$receiver_id.' AND receiver_id = 
            '.$sender_id.' ORDER BY chat_message_time ASC');
            
            return $query->result_array();
            
        }

        public function insert_new_message(){
            $data = array(
                'sender_id' => $this->input->post('sender_id'),
                'receiver_id' => $this->input->post('receiver_id'),
                'chat_message_text' => $this->input->post('message'),
            );

            $this->db->insert('chats', $data);
        }

        public function search_users(){
            $keywords = explode(" ", $this->input->post('keyword'));
            $user_id = $this->input->post('user_id');
            foreach($keywords as $key){
                $this->db->like("username", $key);
            }
            $this->db->where('id !=', $user_id);
            return $this->db->get('users')->result_array();
        }

        public function check_relationship($user_id, $friend_id){
            $query = $this->db->query('
                SELECT * FROM `friendships` WHERE sender_id = '.$user_id.' and receiver_id = '.$friend_id.'
                UNION
                SELECT * FROM `friendships` WHERE sender_id = '.$friend_id.' and receiver_id = '.$user_id.'
            ');
            $result=$query->row_array();
            if(!empty($result)){
                return $result;
            }else{
                return false;
            };
        }

        public function change_relationship(){
            $user_id = $this->input->post('user_id');
            $friend_id = $this->input->post('friend_id');
            $mode = $this->input->post('mode');

            if($mode == 'add'){
                $this->add_friendship($user_id, $friend_id);
            }
            if($mode == 'unfriend'){
                $this->delete_friendship($user_id, $friend_id);
            }
            if($mode == 'accept'){
                $this->update_request_status($mode, $user_id, $friend_id);
            }
        }

        function delete_friendship($id1, $id2){
            if($this->check_relationship($id1, $id2)){
                $this->db->delete('friendships', array('sender_id' => $id1, 'receiver_id' => $id2));
            }
            if($this->check_relationship($id2, $id1)){
                $this->db->delete('friendships', array('sender_id' => $id2, 'receiver_id' => $id1));
            };
        }
        function add_friendship($sender_id, $receiver_id){
            $data = array(
                'sender_id' => $sender_id,
                'receiver_id' => $receiver_id,
                'friend_request_status' => 'pending',
                'chatable' => 'no'
            );
            $this->db->insert('friendships', $data);
        }

        function attend_friends(){
            $event_id = $this->input->post('event_id');
            $user_id = $this->input->post('user_id');
            $query = $this->db->query('
                SELECT f1.receiver_id AS user_id, f1.sender_id AS friend_id, u1.username AS friend_name, u1.img AS friend_img FROM friendships f1, users u1, joins j1 WHERE f1.receiver_id = '.$user_id.' AND f1.friend_request_status = "accept" AND u1.id = f1.sender_id AND j1.event_id = '.$event_id.' AND j1.user_id = f1.sender_id
                UNION ALL
                SELECT f2.sender_id AS user_id, f2.receiver_id AS friend_id, u2.username AS friend_name, u2.img AS friend_img FROM friendships f2, users u2, joins j2 WHERE f2.sender_id = '.$user_id.' AND f2.friend_request_status = "accept" AND u2.id = f2.receiver_id AND j2.event_id = '.$event_id.' AND j2.user_id = f2.receiver_id
            ');
            return $query->result_array();
        }
    }
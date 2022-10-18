<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Social extends CI_Controller {
    public function index(){
        $data['title'] = 'Social';
		// $data['user'] = $this->UserModel->get_user($user_id);
		$this->load->view('templates/header');
		$this->load->view('social/index', $data);
		$this->load->view('templates/footer');
    }

	public function get_lists($user_id){
		$results = $this->User->get_lists($user_id);
		$action = $this->input->post('action');

		$message_link_start = '';
		$message_link_end = '';
		$person_link_start = '';
		$person_link_end = '';
		$friend_link_start = '';
		$friend_link_end = '';
		
		$output='';
		if(sizeOf($results) > 0){
			foreach($results as $result){
				// $user_id = $result['user_id'];
				$friend_id = $result['friend_id'];
				if(!empty($result['friend_img']) && $result['friend_img'] != ''){
					$friend_img = $result['friend_img'];
				}else{
					$friend_img = 'user.png';
				}
				$base_url = base_url();
				if($action == 'requests_list'){
					$social_btn = '
						<div class="d-flex two-btns container">
							<div><a href="'.$base_url.'social/respond_accept/'.$user_id.'/'.$friend_id.'" class="btn btn-warning btn-lg"><h1>accept</h1></a></div>
							<div><a href="'.$base_url.'social/respond_reject/'.$user_id.'/'.$friend_id.'" class="btn btn-dark btn-lg"><h1>reject</h1></a></div>
						</div>
					';
					$person_link_start = '<a href="'.$base_url.'user/user_info/'.$friend_id.'">';
					$person_link_end = '</a>';
					$friend_name = $result['friend_name'];
				}
				if($action == 'friends_list'){
					$social_btn = '';
					$friend_link_start = '<a href="'.$base_url.'user/user_info/'.$friend_id.'">';
					$friend_link_end = '</a>';
					$friend_name = $result['friend_name'];
				}
				if($action == 'chats_list'){
					$time_data = $this->transform_time($result['chat_time']);
					$social_btn = '';
					if($result['unread_count'] != 0){
						$social_btn .= '<div class="mess_alert"><h3>'.$result['unread_count'].'</h3></div>';
					}
					$social_btn .= '<div><h3>'.$time_data['month'].' '.$time_data['date'].'</h3></div>';
					$message_link_start = '<a href="'.$base_url.'social/message_board/'.$user_id.'/'.$friend_id.'">';
					$message_link_end = '</a>';
					$friend_info = $this->User->get_user($friend_id);
					if(!empty($friend_info['img']) && $friend_info['img'] != ''){
						$friend_img = $friend_info['img'];
					}else{
						$friend_img = 'user.png';
					}
					$friend_name = $friend_info['username'];
				}
				$output .= 
				'
					'.$message_link_start.$friend_link_start.'
					<div class="d-flex person-info">
						<div class="d-flex col-7">
							<div class="person-head">
								'.$person_link_start.'
								<img src="'.$base_url.'assets/img/users/'.$friend_img.'" id="uploaded_image" class="img-responsive img-circle" />
								'.$person_link_end.'
							</div>
							<div><h3>'.$friend_name.'</h3></div>
						</div>
						<div class="d-flex justify-content-end col-5" style="justify-content: flex-end;-webkit-justify-content:flex-end;">
							'.$social_btn.'
						</div>
					</div>'.$message_link_end.$friend_link_end.'
					<hr>
				';
			}
		}
		echo $output;
	}

	public function respond_accept(){
		$receiver_id = $this->uri->segment(3);
		$sender_id = $this->uri->segment(4);
		$this->User->update_request_status('accept', $receiver_id, $sender_id);
		redirect('social/index');
	}

	public function respond_reject(){
		$receiver_id = $this->uri->segment(3);
		$sender_id = $this->uri->segment(4);
		$this->User->update_request_status('reject', $receiver_id, $sender_id);
		redirect('social/index');
	}

	public function message_board(){
		$data['receiver_id'] = $this->uri->segment(3);
		$data['sender_id'] = $this->uri->segment(4);
		$data['sender'] = $this->User->get_user($data['sender_id']);
		$this->User->update_message_status('read', $data['receiver_id'], $data['sender_id']);
		$this->load->view('templates/header2');
        $this->load->view('social/message_board', $data);
        $this->load->view('templates/footer');
	}

	public function add_friends(){
		$data['title'] = 'Add Friends';
		
		$this->load->view('templates/header');
		$this->load->view('social/add_friends', $data);
		$this->load->view('templates/footer');
	}

	public function search_users(){
		$results = $this->User->search_users();

		$person_link_start = '';
		$person_link_end = '';
		$base_url = base_url();
		$output = '';
		
		
		if(sizeOf($results) > 0){
			foreach($results as $result){
				if(!empty($result['img']) && $result['img'] != ''){
					$user_img = $result['img'];
				}else{
					$user_img = 'user.png';
				}
				$user_id = $result['id'];
				$username = $result['username'];
				$person_link_start = '<a href="'.$base_url.'user/user_info/'.$user_id.'" class="d-flex person-info">';
				$person_link_end = '</a>';
				$output .= '
					'.$person_link_start.'
						<div class="d-flex col-7">
							<div class="person-head">
								<img src="'.$base_url.'assets/img/users/'.$user_img.'" id="uploaded_image" class="img-responsive img-circle" />
							</div>
							<div><h3>'.$username.'</h3></div>
						</div>
						<div class="d-flex justify-content-end col-5" style="justify-content: flex-end;-webkit-justify-content:flex-end;">
						</div>
					'.$person_link_end.'
					<hr>
				';
			}
		}
		echo $output;
	}

	public function load_chat_data(){
		$sender_id = $this->input->post('sender_id');
		$user_id = $this->input->post('receiver_id');
		$results = $this->User->load_chat_data($user_id, $sender_id);

		$output='';
		$sender_info = $this->User->get_user($sender_id);
		$user_info = $this->User->get_user($user_id);
		$base_url = base_url();
		if(!empty($user_info['img']) && $user_info['img'] != ''){
			$user_img = $user_info['img'];
		}else{
			$user_img = 'user.png';
		};
		if(!empty($sender_info['img']) && $sender_info['img'] != ''){
			$sender_img = $sender_info['img'];
		}else{
			$sender_img = 'user.png';
		};

		if(sizeOf($results) > 0){
			foreach($results as $result){
				// $output .= $result['chat_message_text'];
				$sender=$result['sender_id'];
				$receiver=$result['receiver_id'];
				$message = $result['chat_message_text'];
				$time = $result['chat_message_time'];
				$time_data = $this->transform_time($time);
				if($sender == $user_id){
					$output .='
						<div class="d-flex receiver-message-box flex-row-reverse">
							<div class="chat-person">
								<img src="'.$base_url.'assets/img/users/'.$user_img.'" id="uploaded_image" class="img-responsive img-circle" />
							</div>
							<div class="message receiver-message"><p>'.$message.'</p></div>
							<div class="mess-time"><h5>'.$time_data['clock'].':'.$time_data['mins'].'</h5></div>
						</div>
					';
				}
				if($sender == $sender_id){
					$output .='
						<div class="d-flex sender-message-box">
							<div class="chat-person">
								<img src="'.$base_url.'assets/img/users/'.$sender_img.'" id="uploaded_image" class="img-responsive img-circle" />
							</div>
							<div class="message sender-message"><p>'.$message.'</p></div>
							<div class="mess-time"><h5>'.$time_data['clock'].':'.$time_data['mins'].'</h5></div>
						</div>
					';
				}
			}
		}
		echo $output;
	}

	public function check_relationship(){
		$user_id = $this->input->post('user_id');
        $friend_id = $this->input->post('friend_id');
		$result = $this->User->check_relationship($user_id, $friend_id);
		$output = '';
		if($result != false){$output .= $result['sender_id'].','.$result['friend_request_status'];};

		echo $output;
	}

	public function change_relationship(){
		echo $this->User->change_relationship();
	}

	public function insert_new_message(){
		$this->User->insert_new_message();
	}
	public function update_read(){
		$sender_id = $this->input->post('sender_id');
		$user_id = $this->input->post('receiver_id');
		$this->User->update_message_status('read', $user_id, $sender_id);;
	}
	function transform_time($time){
		$mess_time = explode("-", $time);
		$month_name = DateTime::createFromFormat('!m', (int)$mess_time[1])->format('F');
		$month_short = substr($month_name, 0, 3);
		$clock_date = explode(":", $mess_time[2]);
		$mins = explode(":", $mess_time[2])[1];
		$date = explode(" ", $clock_date[0])[0];
		$clock = explode(" ", $clock_date[0])[1];
		$data = array(
			'month' => $month_short,
			'clock' => $clock,
			'date' => $date,
			'mins' => $mins
		);
		return $data;
	}
}
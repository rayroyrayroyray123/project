<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	public function profile($title=FALSE){
		$data['title'] = 'Profile';
		$data['from'] = $title;
		$data['user'] = $this->User->get_user($this->session->userdata('user_id'));

		$this->load->view('templates/header');
		$this->load->view('user/profile', $data);
		$this->load->view('templates/footer');
	}

	public function user_info($user_id){
		$data['title'] = 'user infomation';
		$data['user'] = $this->User->get_user($user_id);
		$this->load->view('templates/header');
		$this->load->view('user/user_info', $data);
		$this->load->view('templates/footer');
	}

	public function login(){
		$data['title']= "Sign In";

		$this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

		if($this->form_validation->run() === FALSE){
			$this->load->view('templates/header2');
        	$this->load->view('user/login', $data);
        	$this->load->view('templates/footer');
		}else{
			$username = $this->input->post('username');
            $password = $this->input->post('password');
			$remember = $this->input->post('remember');
			$cookie_time = (60*60*24*30);
			
			$user_id = $this->User->login($username, $password);
			
			if($user_id){
				$user = $this->User->get_user($user_id);

				if($remember == 1){
					$cookie_time_onset = time() + $cookie_time;
					setcookie('username', $username, $cookie_time_onset, '/');
					setcookie('password', $password, $cookie_time_onset, '/');
					
				}else{
					$cookie_time_offset = time() - $cookie_time;
					setcookie('username', '', $cookie_time_offset, '/');
					setcookie('password', '', $cookie_time_offset, '/');
				}

				$image = $user['img'];
				$location = $user['location'];
				$user_data = array(
					'user_id' => $user_id,
					'username' => $username,
					'image' => $image,
					'location' => $location,
					'logged_in' => true,
					'logged_in_time' => time(),
				);

				$this->session->set_userdata($user_data);
				redirect(base_url());

			} else{
				$this->session->set_flashdata('login_failed', 'Invalid username or password');
				redirect('user/login');
			}
		}
		
	}

    public function register(){
		$data['title'] = 'Register';
		$data['categories'] = $this->Category->get_categories();
		
		$this->form_validation->set_rules('username', 'Username', 'required|callback_check_username_exists');
		$this->form_validation->set_rules('email', 'Email', 'required|callback_check_email_exists');
		$this->form_validation->set_rules('password', 'Password', 'required');
		
		if($this->form_validation->run() === FALSE){
			$this->load->view('templates/header2');
			$this->load->view('user/register', $data);
			$this->load->view('templates/footer');
		}else{
			
			$this->User->register();

			// login once registered
			$username = $this->input->post('username');
            $password = $this->input->post('password');
			$remember = 1;
			$cookie_time = (60*60*24*30);

			$cookie_time_onset = time() + $cookie_time;
			setcookie('username', $username, $cookie_time_onset, '/');
			setcookie('password', $password, $cookie_time_onset, '/');
			
			$user_id = $this->User->login($username, $password);
			$user = $this->User->get_user($user_id);
			$image = $user['img'];
			$location = $user['location'];
			$user_data = array(
				'user_id' => $user_id,
				'username' => $username,
				'image' => $image,
				'location' => $location,
				'logged_in' => true,
				'logged_in_time' => time(),
			);
			
			$this->session->set_userdata($user_data);
			$this->session->set_flashdata('user_registered', 'You are now registered!');
			redirect('user/guide');
		}
    }

	public function guide(){
		$data['title'] = 'guide';
		$this->load->view('templates/header2');
		$this->load->view('user/guide', $data);
		$this->load->view('templates/footer');
	}

	public function logout(){
		//unset user data
		$this->session->unset_userdata('logged_in');
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('user_id');

    	redirect('user/login');
	}

	public function schedule($user_id){
        $data['title'] = 'Schedule';
		$data['events'] = $this->Post->get_scheduled_events($user_id);
		$this->load->view('templates/header');
		$this->load->view('user/schedule', $data);
		$this->load->view('templates/footer');
    }

	public function preference($user_id){
        $data['title'] = 'Preference';
		$data['user'] = $this->User->get_user($user_id);
		$data['categories'] = $this->Category->get_categories();

		$this->load->view('templates/header');
		$this->load->view('user/preference', $data);
		$this->load->view('templates/footer');
    }

	public function set_preferences(){
		$this->User->update_preferences();
		redirect('user/profile');
	}

	public function edit_profile($user_id){
		$data['title'] = 'Edit Profile';
		$data['user'] = $this->User->get_user($user_id);

		$this->load->view('templates/header');
		$this->load->view('user/edit_profile', $data);
		$this->load->view('templates/footer');
	}

	public function set_profile(){
		$this->User->update_user('profile');
		redirect('user/profile');
	}

	public function my_events($user_id){
		$data['title'] = 'My Events';
		$data['events'] = $this->Post->get_events(FALSE,'events.id', $user_id);

		$this->load->view('templates/header');
		$this->load->view('user/my_events', $data);
		$this->load->view('templates/footer');
	}

	public function memories($user_id){
		$data['title'] = 'My Memory';
		$data['events'] = $this->Post->get_attended_events($user_id);

		$this->load->view('templates/header');
		$this->load->view('user/memories', $data);
		$this->load->view('templates/footer');
	}
	
	public function upload_img($user_id){
		if($this->input->post('image')){
			
			$data = $this->input->post('image');
			$image_array_1 = explode(";", $data);
			$image_array_2 = explode(",", $image_array_1[1]);
			$data = base64_decode($image_array_2[1]);
			$image_name = './assets/img/users/' . time() . '.png';
			file_put_contents($image_name, $data);
			$image = explode("/", $image_name)[4];
			$this->User->update_user_img($user_id, $image);
			$this->session->set_userdata(array('image' => $image));
			
			echo $image;
		}
		// echo $this->input->post('image');
	}

	public function view($page){
		$data['title'] = ucfirst($page);

        $this->load->view('templates/header');
        $this->load->view('user/'.$page, $data);
        $this->load->view('templates/footer');
	}


	//check if username exists
	function check_username_exists($username){
		$this->form_validation->set_message('check_username_exists', 'That username is taken. Please choose another one');

		if($this->User->check_username_exists($username)){
			return true;
		} else{
			return false;
		}
	}

	//check if email exists
	function check_email_exists($email){
		$this->form_validation->set_message('check_email_exists', 'That email is taken. Please choose another one');

		if($this->User->check_email_exists($email)){
			return true;
		} else{
			return false;
		}
	}

	//get notification items
	function get_notifications($user_id){
		$events = $this->Post->upcoming_events($user_id);
		$messages = $this->User->get_lists($user_id, 'chats_list');
		$requests = $this->User->get_lists($user_id, 'requests_list');

		$output = '';
		$mess_events = 'No upcoming events';
		$mess_messages = 'No new message';
		$mess_requests = 'No new friend request';
		$event_style = '';$mess_style = '';$request_style = '';$count=0;
		$base_url = base_url();
		$unread_mess = false;

		if(sizeOf($messages)>0){
			foreach($messages as $message){
				if($message['unread_count'] != 0){
					$unread_mess = true;
				}
			}
		}
		if($unread_mess){
			$mess_messages = 'You got new messages';
			$mess_style = 'color:#F37022;';
			$count += 1;
		}
		if(sizeOf($events)>0){
			$mess_events = 'Check your upcoming events';
			$event_style = 'color:#F37022;';
			$count += 1;
		}

		if(sizeOf($requests)>0){
			$mess_requests = 'You got new requests';
			$request_style = 'color:#F37022;';
			$count += 1;
		}

		$output .= '
			<input type="hidden" id="total_notify" value="'.$count.'">
			<a href="'.$base_url.'user/schedule/'.$user_id.'">
			<div><i class="material-icons" id="range-icon" style="font-size:200px !important;'.$event_style.'">date_range</i></div>
			</a>
			<div><h1 style="'.$event_style.'">'.$mess_events.'</h1></div>
			<br><br><br>
			<a href="'.$base_url.'social">
			<div><i class="material-icons" id="message-icon" style="font-size:200px !important;'.$mess_style.'">mark_chat_unread</i></div>
			</a>
			<div><h1 style="'.$mess_style.'">'.$mess_messages.'</h1></div>
			<br><br><br>
			<a href="'.$base_url.'social">
			<div><i class="material-icons" id="friend-icon" style="font-size:200px !important;'.$request_style.'">person_add</i></div>
			</a>
			<div><h1 style="'.$request_style.'">'.$mess_requests.'</h1></div>
		';

		echo $output;
	}

}
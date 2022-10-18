<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Post extends CI_Controller {
    public function index(){
        $data['title'] = 'Events';
		// $data['user'] = $this->UserModel->get_user($user_id);
		$data['events'] = $this->Post->get_events();
		$data['categories'] = $this->Category->get_categories();
	
		$this->load->view('templates/header');
		$this->load->view('post/index', $data);
		$this->load->view('templates/footer');
    }

    public function create(){
        $data['title'] = 'Create';
		// $data['user'] = $this->UserModel->get_user($user_id);
		$this->load->view('templates/header');
		$this->load->view('post/create', $data);
		$this->load->view('templates/footer');
    }

	public function create_form($mode){
		$data['title'] = 'Create';
		$data['mode'] = $mode;
		$data['categories'] = $this->Category->get_categories();

		$this->load->view('templates/header');
		$this->load->view('post/create_form', $data);
		$this->load->view('templates/footer');
	}

	public function create_event($mode){
		$this->Post->insert_event($mode);

		redirect(base_url());
	}

	public function upload_img(){
		if($this->input->post('image')){
			
			$data = $this->input->post('image');
			$image_array_1 = explode(";", $data);
			$image_array_2 = explode(",", $image_array_1[1]);
			$data = base64_decode($image_array_2[1]);
			$image_name = './assets/img/events/' . time() . '.png';
			file_put_contents($image_name, $data);
			$image = explode("/", $image_name)[4];
			
			echo $image;
		}
	}

	public function delete_img(){
		if($this->input->post('image')){
			$data = $this->input->post('image');
			$filename = './assets/img/events/'.$data;
			unlink($filename);
		}
	}

	public function view($id){
		$data['title'] = 'Events';
		$data['event'] = $this->Post->get_events($id);
		$data['categories'] = $this->Category->get_categories();
		$data['event_date'] = $this->transform_date($data['event']['event_date']);
		
		// $data['attend_list'] = $this->attend_list($id);
		if(empty($data['event'])){
            show_404();
        }

		$this->load->view('templates/header');
        $this->load->view('post/view', $data);
        $this->load->view('templates/footer');
	}

	public function change_attend(){
		if ($this->input->post('mode') == 'attend'){
			$result = $this->Post->insert_attend();
			echo $result;
		}
		if ($this->input->post('mode') == 'cancel'){
			$result = $this->Post->delete_attend();
			echo $result;
		}
	}

	function attend_count(){
		$results = $this->Post->get_attend_list();
		echo sizeOf($results);
	}

	function attend_list(){
		$results = $this->Post->get_attend_list();
		$output = '';
		if(sizeOf($results) > 0){
			foreach($results as $result){
				$output .= $result['user_id'];
				$output .= ',';
			}
		}
		echo $output;
	}

	function attend_friends(){
		$results = $this->User->attend_friends();

		$output="";
		$base_url = base_url();
		if(sizeOf($results) > 0){
			foreach($results as $result){
				if($result['friend_img']){
					$friend_img = $result['friend_img'];
				}else{
					$friend_img = 'user.png';
				}
				$friend_name = $result['friend_name'];
				
				$result['friend_name'];
				$output .= '
					<div class="part-friend">
						<div class="event-participants">
							<a href="#">
								<img src="'.$base_url.'assets/img/users/'.$friend_img.'" id="uploaded_image" class="img-responsive img-circle" />
							</a>
						</div>
						<h2>'.$friend_name.'</h2>
					</div>
				';
				
			}
		}else{
			$output='No friend attend this event, you could become the first!';
		}
		
		echo $output;
	}

	public function search_events(){
		$output = '';
        $results = $this->Post->search_events();
        $output = '<ul class="list-unstyled txtpost">';
        if(sizeOf($results) > 0){
            foreach($results as $result){
                $output .= '<li class="dropdown-item search_li" id="'.$result['id'].'">'.$result['title'].'</li><hr>';
            }
        }else{
            $output .= '<li class="dropdown-item search_li">Event Not Found</li>';
        }
        $output .= '</ul>';
        echo $output;
	}

	public function search($post_keyword){
        $data['title'] = 'search';
        if(is_numeric($post_keyword)){
            $data['events'] = $this->Post->get_events_by(FALSE, $post_keyword);
            $data['keyword'] = $this->Post->get_events($post_keyword)['title'];
        }else{
            $post_keyword = str_replace("%20", " ", $post_keyword);
            $data['events'] = $this->Post->get_events_by($post_keyword, FALSE);
            $data['keyword'] = $post_keyword;
        }
        
        $this->load->view('templates/header');
        $this->load->view('post/search', $data);
        $this->load->view('templates/footer');
    }

	public function get_filtered_events(){
		$results = $this->Post->get_filtered_events();
		$output = '';
		if($results == 'No condition applied'){
			$results = $this->Post->get_events();
		}

		if(sizeOf($results) > 0){
			foreach($results as $event){
				$event_id = $event['id'];
				if($event['event_img']){$event_img = explode(",", $event['event_img'])[0];}else{$event_img = 'jogging.jpg';};
				$title = $event['title'];
				if($event['img']){$founder_img = $event['img'];}else{$founder_img = 'user.png';};
				$founder_name = $event['username'];
				$date = str_replace("-", "/", $event['event_date']);
				$url = base_url();
				$output .='
					<div id="item'.$event_id.'">
						<div class="event-box" id="'.$event_id.'" onClick="moreDetail(this.id)">
							<div class="event-photo">
								<div class="event-title">
									<h3 class="col col-9 event-title">'.$title.'</h3>
								</div>
								<img class="event-thumb" width="100%" src="'.$url.'assets/img/events/'.$event_img.'">
							</div>
							<div class="d-flex event-info">
								<div class="d-flex col-8">
									<div class="event-founder">
										<a href="#">
											<img src="'.$url.'assets/img/users/'.$founder_img.'" id="uploaded_image" class="img-responsive img-circle" />
										</a>
									</div>
									<div><h3>'.$founder_name.'</h3></div>
								</div>
								<div class="col col-4"><p>'.$date.'</p></div>
							</div>
						</div>
						<br>
					</div>
				';
			}
		}
		
		echo $output;
	}

	function transform_date($date){
		$event_time = explode("-", $date);
		$month_name = DateTime::createFromFormat('!m', (int)$event_time[1])->format('F');
		$month_short = substr($month_name, 0, 3);
		$year = $event_time[0];
		$date = $event_time[2];
		
		$data = array(
			'month' => $month_short,
			'date' => $date,
			'year' => $year
		);
		return $data;
	}
}


    <?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 //put your code here 
 class Favourite_model extends CI_Model{

    public function add_favorite($courseName, $username){
        $data['course_name'] = $courseName;
        $data['username'] = $username;
        echo $courseName;
        echo $data['course_name'];
        echo $data['username'];
        $this->db->insert('Favourite',$data);
        
    }

    public function search_favourite($courseName, $username)
    {
        $this->db->where('course_name', $courseName);
        $this->db->where('username', $username);
        $query = $this->db->get('Favourite');
        return $query->num_rows();
    }

    public function search_UserFavourite($username)
    {
        $this->db->where('username', $username);
        $query = $this->db->get('Favourite');
        return $query;
    }
    
}
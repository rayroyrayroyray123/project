<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//put your code here
class User_model extends CI_Model{ 
    public function login($username, $password){
        // construct sql query
        $this->db->where('username', $username);
        $this->db->where('password', $password); 
        $this->db->where('verify', 1); // Check if user have done email vertification
        // making query
        $result = $this->db->get('users');

        if($result->num_rows() == 1){
            // echo "Find";
            return true;
        } 
        else 
        {
            // echo "Dont fund";
            return false;
        }
    }

    public function register($username, $password, $email){
        
        // Input new username and new password
        // Return True: if there is no duplicate user name
        //              Otherwise return false

        $this->db->where('username', $username); 
        $this->db->where('email', $email);
        // making query
        $result = $this->db->get('users');
        // echo $username;
        // echo $password;
        if($result->num_rows() == 0){
            $data = array(
                'username' => $username,
                'password' => $password,
                'email' => $email,
                'verify' => 0
            );
            $this->db->insert('users', $data);
            return True;
        } 
        else{
            return false;
        }

        
    }

    public function activate($username){
        $this->db->where('username', $username);
        // echo $username;
        $builder = $this->db->get('users');
        // echo $builder;
        // echo $builder->num_rows();
        // We find the user
        if($builder->num_rows() == 1){
            // echo "actvate success";
            $data = array(
                'username' => $builder->row()->username,
                'password' => $builder->row()->password,
                'email' => $builder->row()->email,
                'verify' => 1
            );

            if( $this->db->replace('users', $data)){
                // echo "replace success";
                return True;
            }else{
                // echo "replace failed";
                return False;
            }
        }else{
            // echo "activate failed";
        }
    }

    public function get_email($username){
        $this->db->where('username', $username);
        // echo $username;
        $builder = $this->db->get('users');
        return $builder->row()->email;
    }

    public function check_username_exist($username){
        $this->db->where('username', $username);
        $result = $this->db->get('users');
        if($result->num_rows() == 0){
            return false;
        }else{
            return true;
        }
    }

    public function check_email_exist($email){
        $this->db->where('email', $email);
        $result = $this->db->get('users');
        if($result->num_rows() == 0){
            return false;
        }else{
            return true;
        }
    }

    public function get_password($username){
        $this->db->where('username', $username);
        // echo $username;
        $builder = $this->db->get('users');
        return $builder->row()->password;
    }

    public function reset_password($username, $password){

        $this->db->where('username', $username);
        $builder = $this->db->get('users');
        // We find the user
        if($builder->num_rows() == 1){
            $data = array(
                'username' => $username,
                'password' => $password,
                'email' => $builder->row()->email,
                'verify' => 1
            );

            if( $this->db->replace('users', $data)){
                return True;
            }else{
                return False;
            }
        }
    }

    public function alter_information($username, $new_password, $new_email){
        $this->db->where('email', $new_email);
        $builder = $this->db->get('users');
        if($builder->num_rows() != 0){
            return False;
        }

        $this->db->where('username', $username);
        $builder = $this->db->get('users');
        // echo "Do_alter", $username, $new_password, $new_email;
        // $this->db->where('username', $username);
        // $check = $this->db->get('users');
        if($builder->num_rows() == 1){
            // if($check ->num_rows() == 0){
            $data = array(
                'password' => $new_password,
                'email' =>$new_email,
                'verify' => 1
            );
            // echo $builder->row()->username;
            if( $this->db->update('users', $data, array('username' => $username))){
                return True;
            }else{
                return False;
            }
            // }
        }

        return False;
    }

}
?>

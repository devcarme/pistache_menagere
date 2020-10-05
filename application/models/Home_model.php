<?php
class Home_model extends CI_Model{
    
    function get_user_home($user){
        $this->db->join('distribution_home','distribution_home.home = home.home');
        $this->db->where('user_login',$user);
        $this->db->where('ban',NULL);
        return $this->db->get('home')->result_array();
    }
    
    function add_home($home, $user, $password){
        $password = password_hash($password, PASSWORD_BCRYPT);
        $this->db->insert('home', array('home'=>$home, 'admin'=>$user, 'password'=>$password));
        $this->Home_model->add_user_home($user, $home);
    }
    
    function get_home($home){
        $this->db->where('home',$home);
        return $this->db->get('home')->row_array();
    }
    
    function add_user_home($user, $home){
        $this->db->insert('distribution_home',array('home'=>$home, 'user_login'=>$user));
        $this->db->insert('task_sort', array('user_login' => $user,'home'=>$home));
    }
    
    function verification_home($home, $password){
        $query = $this->db->get_where('home', array('home'=>$home));
        foreach($query->result() as $row){
            $password_hash = $row->password;
        }
        return password_verify($password,$password_hash);
    }
    
    function leave_home($user, $home){
        $this->db->where(array('user_login'=>$user,'home'=>$home));
        $this->db->update('distribution_home', array('ban'=>0));
    }
    
    function is_banned($user,$home){
        $this->db->where(array('user_login'=>$user, 'home'=>$home, 'ban'=>1));
        $query = $this->db->get('distribution_home');
        $result = $query->result_array();
        return (sizeof($result)==1);
    }
    
    function is_present($user,$home){
        $this->db->where(array('user_login'=>$user, 'home'=>$home));
        $query = $this->db->get('distribution_home');
        $result = $query->result_array();
        return (sizeof($result)==1);
    }
    
    function get_blacklist($home){
        $this->db->join('distribution_home','distribution_home.user_login = user.login');
        $this->db->where('home',$home);
        $this->db->where('ban',1);
        return $this->db->get('user')->result_array();
    }
    
    function has_left($user,$home){
        $this->db->where(array('user_login'=>$user, 'home'=>$home,'ban'=>0));
        $query = $this->db->get('distribution_home');
        $result = $query->result_array();
        return (sizeof($result)==1);
    }
    
    function rejoin($user,$home){
        $this->db->where(array('user_login'=>$user, 'home'=>$home));
        $this->db->update('distribution_home', array('ban'=>NULL));
    }
    
    function exist_home($home){
        $this->db->where('home', $home);
        $query = $this->db->get('home');
        $result = $query->result_array();
        return (sizeof($result)===1);
    }
    
    function edit_home($home, $password){
        $password = password_hash($password, PASSWORD_BCRYPT);
        $this->db->update('home',array('password'=>$password));
    }
    
    function delete_home($home){
        $this->db->where('home',$home);
        $this->db->delete('distribution');
        
        $this->db->where('home',$home);
        $this->db->delete('distribution_home');
        
        $this->db->where('home',$home);
        $this->db->delete('home');
        
        $this->db->where('home',$home);
        $this->db->delete('task');
        
        $this->db->where('home',$home);
        $this->db->delete('task_sort');
    }
    
    function edit_reset_points($home,$reset_points){
        $this->db->where('home',$home);
        $this->db->update('home',array('reset_points'=>$reset_points));
    }
    
    function reset_points($home){
        $this->db->where('home',$home);
        $this->db->update('distribution_home', array('points'=> 0));
    }
    
}
    





?>




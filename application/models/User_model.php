<?php
class User_model extends CI_Model{
    
    function get_users($home){
        $this->db->join('distribution_home','distribution_home.user_login = user.login');
        $this->db->where('home', $home);
        $this->db->where('ban', NULL);
        return $this->db->get('user')->result_array();
    }
    
    function is_register($login,$password){
        $query = $this->db->get_where('user', array('login'=>$login));
        foreach($query->result() as $row){
            $password_hash = $row->password;
        }
        return password_verify($password,$password_hash);
    }
    
    
    function is_present($login){
        $this->db->where(array('login' => $login));
        $query = $this->db->get('user');
        $result = $query->result_array();
        return (sizeof($result)===1);
    }
    
    
    function add_user($login,$password){
        $this->db->insert('user',array('login'=> $login ,'password'=> password_hash($password, PASSWORD_BCRYPT)));
    }
    
    function get_userlist($home){
        $this->db->select('login, distribution_home.points');
        $this->db->order_by('points','DESC');
        $this->db->join('distribution_home','distribution_home.user_login = user.login');
        $this->db->where('home', $home);
        $this->db->where('ban', NULL);
        return $this->db->get('user')->result_array();
    }
    
    function ban($user, $home){
        $this->db->where(array('user_login'=>$user, 'home'=>$home));
        $this->db->update('distribution_home', array('ban'=>1));
    }
    
    function deban($user, $home){
        $this->db->where(array('user_login'=>$user, 'home'=>$home));
        $this->db->update('distribution_home', array('ban'=>NULL));
    }
    
    
    
    function is_admin($login, $home){
        $this->db->where(array('admin' => $login,'home' => $home));
        $query = $this->db->get('home');
        $result = $query->result_array();
        return (sizeof($result)==1);
    }
    
    function is_simple_admin($login){
        $this->db->where(array('admin' => $login));
        $query = $this->db->get('home');
        $result = $query->result_array();
        return (sizeof($result)>=0);
    }
    
    
    function add_points($data, $points){
        $this->db->set('points', 'points+'.$points, FALSE);
        $this->db->where($data);
        $this->db->update('distribution_home');
     }
    
    function get_user_home($user){
        $this->db->join('distribution_home','distribution_home.home = home.home');
        $this->db->where('user_login',$user);
        return $this->db->get('home')->result_array();
    }
    
    function get_admin_home($home){
        return $this->db->get_where('home', array('home'=>$home))->row()->admin;
    }
    
    function edit_profile($user, $login, $password){
        $password = password_hash($password, PASSWORD_BCRYPT);
        $this->db->set(array('login'=>$login,'password'=>$password));
        $this->db->where('login',$user);
        $this->db->update('user');
        
        $this->db->set('user_login',$login);
        $this->db->where('user_login',$user);
        $this->db->update('distribution_home');
        
        $this->db->set('user_login',$login);
        $this->db->where('user_login',$user);
        $this->db->update('distribution');
        
        if($this->is_simple_admin($user)){
            $this->db->set('admin',$login);
            $this->db->where('admin',$user);
            $this->db->update('home');
        }
        
        $this->db->set('user_login',$login);
        $this->db->where('user_login',$user);
        $this->db->update('distribution_home');
    }
    
    function edit_profile_login($user,$login){
        $this->db->set('login',$login);
        $this->db->where('login',$user);
        $this->db->update('user');
        
        $this->db->set('user_login',$login);
        $this->db->where('user_login',$user);
        $this->db->update('distribution_home');
        
        if($this->is_simple_admin($user)){
            $this->db->set('admin',$login);
            $this->db->where('admin',$user);
            $this->db->update('home');
        }
        
        $this->db->set('user_login',$login);
        $this->db->where('user_login',$user);
        $this->db->update('distribution_home'); 
    }
   
}
    





?>
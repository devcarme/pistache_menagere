<?php

class Task_model extends CI_Model{
    function get_usertask($user, $home){
        $this->db->select('id, name, type, DATE_FORMAT(jour, "%d/%m/20%y") as jour, TIME_FORMAT(heure, "%H h %i") as heure, user.login, valid');
        $this->db->join('distribution','task.id = distribution.task_id');
        $this->db->join('user','user.login = distribution.user_login');
        $this->db->where('distribution.user_login',$user);
        $this->db->where('distribution.home',$home);
        $this->db->where('valid',0);
        $this->db->order_by('jour,heure','DESC');
        return $this->db->get('task')->result_array();
    }  
    
    function add_usertask($data){
        $this->db->insert('task',$data);
    }
    
    function add_usertask_distribution($membres, $home){
        $task_id = $this->get_last_task();
        foreach($membres as $membre){
            $this->db->insert('distribution',array('task_id'=>$task_id,'user_login'=>$membre, 'home' => $home));
        }
    }
    
    function add_task_distribution($home, $user, $task_id){
        $this->db->insert('distribution',array('task_id'=>$task_id,'user_login'=>$user, 'home' => $home));
    }
    
    function clear_distribution($task_id){
        $this->db->where('task_id',$task_id);
        $this->db->delete('distribution');
    }
    
    function edit_task($data, $task_id, $attribution, $home){
        $this->db->update('task',$data,'id = '.$task_id);
        
        $this->clear_distribution($task_id);
        foreach($attribution as $user){
            $this->add_task_distribution($home, $user, $task_id);
        }
    }
    
    function delete_task($task){
        $this->db->delete('task',array('id'=>$task));
        $this->db->delete('distribution',array('task_id'=>$task));
    }
    
    function get_task_user($task){
        $query = $this->db->query("select * from distribution inner join task on task.id = distribution.task_id where distribution.task_id ='".$task."'");
        return $query->result();
    }
    
    function get_all_task($home){
        $this->db->select('id, name, type, TIME_FORMAT(heure, "%H h %i") as heure, valid, points, DATE_FORMAT(jour, "%d/%m/20%y") as jour');
        $this->db->from('task');
        $this->db->where('home',$home);
        $this->db->where('valid',0);
        $this->db->order_by('jour,heure','DESC');
        return $this->db->get()->result_array();
    }
    
    function get_distribution($home){
        $this->db->where('distribution_home.home',$home);
        $this->db->where('distribution_home.ban',NULL);
        $this->db->join('distribution_home', 'distribution_home.user_login = distribution.user_login');
        return $this->db->get('distribution')->result_array(); 
    }
    
    function get_last_task(){
        $this->db->select_max('id');
        $query = $this->db->get('task');
        return $query->result()[0]->id;
    }
    
    
    function get_sort_task($user, $home){
        $this->db->where('home',$home);
        $this->db->where('user_login',$user);
        return $this->db->get('task_sort')->result_array();
    }
    
    function add_sort_task($user, $sort, $home){
        $this->db->set($sort, 1);
        $this->db->where('user_login',$user);
        $this->db->where('home',$home);
        $this->db->update('task_sort');
    }
    
    function is_sorted_task($user, $sort, $home){
        $this->db->select($sort);
        $this->db->where('home',$home);
        $this->db->where('user_login',$user);
        return $this->db->get('task_sort')->result()[0]->$sort;
    }
    
    function reset_sort_task($user, $home){
        $this->db->set('my_missions', 0);
        $this->db->set('today', 0);
        $this->db->set('week', 0);
        $this->db->where('user_login',$user);
        $this->db->where('home',$home);
        $this->db->update('task_sort');
    }
    
    function get_all_task_today($home){
        $current_date = date("20y-m-d");
        $this->db->select("id, name, type, valid, points, DATE_FORMAT(jour, '%d/%m/20%y') as jour, TIME_FORMAT(heure, '%H h %i') as heure");
        $this->db->where('jour',$current_date);
        $this->db->where('task.home',$home);
        $this->db->where('valid',0);
        $this->db->order_by('heure','DESC');
        return $this->db->get('task')->result_array();
    }
    
    function get_user_task_today($user, $home){
        $current_date = date("20y-m-d");
        $this->db->select('id, name, type, TIME_FORMAT(heure, "%H h %i") as heure, valid, points, DATE_FORMAT(jour, "%d/%m/20%y") as jour');
        $this->db->join('distribution', 'distribution.task_id = task.id');
        $this->db->where('distribution.user_login',$user);
        $this->db->where('jour',$current_date);
        $this->db->where('task.home',$home);
        $this->db->where('valid',0);
        $this->db->order_by('heure','DESC');
        return $this->db->get('task')->result_array();
    }
    
    function get_all_task_week ($home){
        $monday = date( '20y-m-d', strtotime("monday this week"));
        $tuesday = date( '20y-m-d', strtotime("tuesday this week"));
        $wednesday = date( '20y-m-d', strtotime("wednesday this week"));
        $thursday = date( '20y-m-d', strtotime("thursday this week"));
        $friday = date( '20y-m-d', strtotime("friday this week"));
        $saturday = date( '20y-m-d', strtotime("saturday this week"));
        $sunday = date( '20y-m-d', strtotime("sunday this week"));
        
        $query = $this->db->query('select id, name, type, TIME_FORMAT(heure, "%H h %i") as heure, valid, points, DATE_FORMAT(jour, "%d/%m/20%y") as jour from task where home = "'.$home.'" and valid = 0 and (jour = "'.$monday.'" OR jour = "'.$tuesday.'" OR jour = "'.$wednesday.'" OR jour = "'.$thursday.'" OR jour = "'.$friday.'" OR jour = "'.$saturday.'" OR jour = "'.$sunday.'") order by jour,heure DESC');
        
        return $query->result_array();
    }
    
    function get_user_task_week ($user, $home){
        $monday = date( '20y-m-d', strtotime("monday this week"));
        $tuesday = date( '20y-m-d', strtotime("tuesday this week"));
        $wednesday = date( '20y-m-d', strtotime("wednesday this week"));
        $thursday = date( '20y-m-d', strtotime("thursday this week"));
        $friday = date( '20y-m-d', strtotime("friday this week"));
        $saturday = date( '20y-m-d', strtotime("saturday this week"));
        $sunday = date( '20y-m-d', strtotime("sunday this week"));
        
        $query = $this->db->query('select id, name, type, TIME_FORMAT(heure, "%H h %i") as heure, valid, points, DATE_FORMAT(jour, "%d/%m/20%y") as jour from task join distribution on distribution.task_id = task.id where distribution.user_login = "'.$user.'" and task.home = "'.$home.'" and valid = 0 and (jour = "'.$monday.'" OR jour = "'.$tuesday.'" OR jour = "'.$wednesday.'" OR jour = "'.$thursday.'" OR jour = "'.$friday.'" OR jour = "'.$saturday.'" OR jour = "'.$sunday.'") order by jour,heure DESC');
        
        return $query->result_array();
    }
    
    function confirm_task($task_id, $points){
        $this->db->where('id',$task_id);
        $this->db->update('task',array('points'=>$points,'valid'=>1));
    }
    
    function get_old_tasks($home){
        $query = $this->db->query('select id, name, type, TIME_FORMAT(heure, "%H h %i") as heure, valid, points, DATE_FORMAT(jour, "%d/%m/20%y") as jour from task where valid = 1 and home = "'.$home.'" order by jour,heure DESC');
        return $query->result_array();
    }
    
    function get_old_tasks_distribution($home){
        $this->db->where('distribution_home.home',$home);
        $this->db->join('distribution_home', 'distribution_home.user_login = distribution.user_login');
        return $this->db->get('distribution')->result_array();
    }
}

?>
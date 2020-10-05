<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Controller extends CI_Controller {
    
    
    public function __construct(){
        parent::__construct();
        
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('User_model');
        $this->load->model('Task_model');
        $this->load->model('Home_model');
    }
    
    
	public function index($message = '')
	{
        if ($this->session->userdata('login')){
            redirect('Controller/home');
        } else{
            $data['error'] = '';
            $data['message'] = $message;
            $this->load->vars($data);
            $this->load->view('small_header');
            if ($message !== ''){
              $this->load->view('alert_view');  
            }
            
            $this->load->view('login_view');
        }
        
    }
    
    public function home($message = ''){
        $user = $this->session->userdata('login');
        $data['user'] = $user;
        $data['user_home'] = $this->Home_model->get_user_home($user);
        $data['current'] = 'home';
        
        $array_message = array('' =>  "Bienvenue $user ! Vous pouvez accéder au planning d'une maison en cliquant dessus, rejoindre ou créer une maison.",
                              'exist_home' => "Ce nom de maison est déjà utlisé ! ", 
                              'banned' => "Vous êtes banni de cette maison ! Vous ne pouvez plus la rejoindre !",
                              'already_in' => "Vous faîtes déjà parti de cette maison.",
                              'password_error' => "Mauvais mot de passe de maison.",
                              'doesnt_exist' => "Cette maison n'existe pas.",
                              'join_home' => "Une nouvelle maison a été ajouté à votre liste de maisons. Cliquez dessus pour accéder au planning !",
                              'delete_home' => "La maison a été détruite avec succès, il n'en reste pas une miette...",'add_home' => "La maison a été créée avec succès ! Cliquez dessus pour accéder au planning de cette dernière.");
        
        
        $data['message'] = $array_message[$message];
        
        $data['current'] = 'home';
        $this->load->vars($data);
        $this->load->view('alert_view');
        $this->load->view('home_view');
        
    }
    
    public function login(){
            $login = $this->input->post('login');
            $password = $this->input->post('password');
            if ($this->User_model->is_present($login)){
                if($this->User_model->is_register($login,$password)){
                    $this->session->set_userdata('login',$login);
                    redirect('Controller/index');
                } else{
                    $data['error']= 'password';
                    $this->load->view('small_header');
                    $this->load->view('login_view',$data);
                }
            }else{
                $data['error']= 'login';
                $this->load->view('small_header');
                $this->load->view('login_view',$data);
            }
    }
    
    public function register(){
            $login = $this->input->post('login');
            $password = $this->input->post('password');
            $confirmation = $this->input->post('confirmation');
            if($this->User_model->is_present($login)){
                $data['error'] ='login';
                $this->load->view('small_header');
                $this->load->view('register_view',$data);
            } else if($password !== $confirmation){
                $data['error'] ='password';
                $this->load->view('small_header');
                $this->load->view('register_view', $data);
            } else{
                $this->User_model->add_user($login,$password);
                $data['error'] = '';
                $data['message'] = 'Compté créé ! Connectez-vous !';
                $this->load->vars($data);
                $this->load->view('small_header');
                $this->load->view('small_alert_view');
                $this->load->view('login_view');
            }
   }
    
    public function load_register(){
        $data['error'] = '';
        $this->load->view('small_header');
        $this->load->view('register_view', $data);
    }
    
    public function user_space($message = ''){
        $user = $this->session->userdata('login');
        $home = $this->session->userdata('home');
        
        $data['user_home'] = $this->Home_model->get_user_home($user);
        $data['home'] = $this->Home_model->get_home($home);
        $data['user'] = $user;
        $data['current'] = $home;
        $data['current_bis'] = 'planning';
        $data['users'] = $this->User_model->get_users($home);
        $data['distributions'] = $this->Task_model->get_distribution($home);
        $data['admin'] = $this->User_model->is_admin($user,$home);
        
        if($this->Task_model->is_sorted_task($user, 'my_missions', $home)){
            $data['tasks'] = $this->Task_model->get_usertask($user,$home);
            if($this->Task_model->is_sorted_task($user, 'today', $home)){
                 $data['tasks'] = $this->Task_model->get_user_task_today($user, $home);
            } else if($this->Task_model->is_sorted_task($user, 'week', $home)){
                 $data['tasks'] = $this->Task_model->get_user_task_week($user, $home);
            }
        } else if($this->Task_model->is_sorted_task($user, 'today', $home)){
               $data['tasks'] = $this->Task_model->get_all_task_today($home);
        } else if($this->Task_model->is_sorted_task($user, 'week', $home)){
               $data['tasks'] = $this->Task_model->get_all_task_week($home);
       }
        else{
               $data['tasks'] = $this->Task_model->get_all_task($home);
        }
        $data['sorts'] = $this->Task_model->get_sort_task($user, $home);
        $data['sorts_name'] = array("Mes missions","Aujourd'hui","Cette semaine");
        
        $array_message = array('' => '',
                              'edit_task' => "La mission a été modifiée avec succès !", 
                              'delete_task' => "La mission a été supprimée avec succès !",
                              'confirm_task' => "La mission a été validée avec succès ! Tous les membres attribués à cette mission ont vu leurs points augmenter !",
                              'reset_points' => "Tous les points des membres pour cet habitacle on été remis à 0 !",
        );
        
        
        $data['message'] = $array_message[$message];  
    
        
        $this->load->vars($data);
        $this->load->view('planning_view');
        
    }
    
    public function logout(){
        $this->session->unset_userdata('login');
        $this->session->sess_destroy();
        redirect('Controller/index');
    }
    
    public function userlist($message = ''){
        $user = $this->session->userdata('login');
        $home = $this->session->userdata('home');
        $data['user_home'] = $this->Home_model->get_user_home($user);
        $data['admin'] = $this->User_model->is_admin($user,$home);
        $data['userlist'] = $this->User_model->get_userlist($home);
        $data['current'] = $home;
        $data['current_bis'] = 'members';
        $data['admin_home'] = $this->User_model->get_admin_home($home);
        if ($message !== ''){
            $data['message'] = $message." a été banni ! Vous pouvez le débannir en consultant la blacklist";    
        } else{
            $data['message'] = '';
        }
        
        $this->load->vars($data);
        $this->load->view('userlist_view');
            
    }
    
    public function ban_user(){
        $user = $this->input->post('user_login');
        $home = $this->session->userdata('home');
        $this->User_model->ban($user, $home);
        
        redirect('Controller/userlist/'.$user);
    }
    
    public function add_task(){
        $membres = $this->input->post('membres');
        $home = $this->session->userdata('home');
        $data = array(
                'name' => $this->input->post('name'),
                'type' => $this->input->post('type'),
                'jour' => $this->input->post('jour'),
                'heure' => $this->input->post('heure'),
                'home' => $home
        );
        $this->Task_model->add_usertask($data);
        $this->Task_model->add_usertask_distribution($membres, $home);
        
        redirect('Controller/user_space');
        
    }
    
    public function edit_task(){
        $data = array(
                'name' => $this->input->post('name'),
                'type' => $this->input->post('type'),
                'jour' => $this->input->post('jour'),
                'heure' => $this->input->post('heure')
        );
        $attribution = $this->input->post('attribution');
        $home = $this->session->userdata('home');
        $task_id = $this->input->post('task_id'); 
        $attribution = $this->input->post('attribution'); 
        $this->Task_model->edit_task($data, $task_id, $attribution, $home);
        
        redirect('Controller/user_space/edit_task');
    }
    
    public function delete_task(){
        $task = $this->input->post('task_id');
        $login = $this->session->userdata('login');
        $this->task_model->delete_task($task);
        
        redirect('Controller/user_space/delete_task');
    }
    
    public function confirm_task(){
        $task_id = $this->input->post('task_id');
        $users = $this->Task_model->get_task_user($task_id);
        $points = $this->input->post('points');
        $data['home'] = $this->session->userdata('home');
        foreach($users as $user){
            $data['user_login'] = $user->user_login;
            $this->User_model->add_points($data, $points);    
        }
        $this->Task_model->confirm_task($task_id, $points);
        
        redirect('Controller/user_space/confirm_task');
   }
    
    
    public function sort_task(){
        $user = $this->session->userdata('login');
        $home = $this->session->userdata('home');
        $this->Task_model->reset_sort_task($user, $home);
        $tab_sort = $this->input->post('tri');
        $sort_name = array("Mes missions" => 'my_missions',"Aujourd'hui" => "today","Cette semaine" => "week");
        
        if($tab_sort !== null){
            foreach($tab_sort as $sort){
                $sort = $sort_name[$sort];
                $this->Task_model->add_sort_task($user,$sort,$home);
             }
        }
        redirect('Controller/user_space');
    }
    
    public function select_home($home = ''){
        if ($home === ''){
          $home = $this->input->post('home');  
        }
        
        $this->session->set_userdata('home',$home);
        redirect('Controller/user_space');
    }
    
    public function add_home(){
        $home = $this->input->post('nom');
        $user = $this->session->userdata('login');
        $password = $this->input->post('password');
        
        if (!$this->Home_model->exist_home($home)){
            $this->Home_model->add_home($home,$user,$password);
            redirect('Controller/home/add_home');
        } else{
            redirect('Controller/home/exist_home');
        }
    }
    
    public function join_home(){
        $home = $this->input->post('nom');
        $user = $this->session->userdata('login');
        $password = $this->input->post('password');
        
        if ($this->Home_model->exist_home($home)){
            if ($this->Home_model->verification_home($home,$password)){
                if($this->Home_model->is_present($user,$home)){
                    if($this->Home_model->is_banned($user,$home)){
                        redirect('Controller/home/banned');
                    } else if($this->Home_model->has_left($user,$home)){
                        $this->Home_model->rejoin($user,$home);
                        $this->session->set_userdata('home',$home);
                        redirect('Controller/home/join_home');
                    } else{
                        redirect('Controller/home/already_in');
                    }
                } else{
                    $this->Home_model->add_user_home($user, $home);
                    $this->session->set_userdata('home',$home);
                    redirect('Controller/user_space');
                } 
            } else{
                redirect('Controller/home/password_error');
            }
        } else {
            redirect('Controller/home/doesnt_exist');
        }
    }
    
    public function profile(){
        $user = $this->session->userdata('login');
        $data['user'] = $user;
        $data['current'] = 'user';
        $data['home'] = $this->Home_model->get_user_home($user);
        $data['user_home'] = $this->Home_model->get_user_home($user);
        
        $this->load->vars($data);
        $this->load->view('header');
        $this->load->view('profile_view');
        
    }
    
    public function edit_profile(){
        $user = $this->session->userdata('login');
        $data['user'] = $user;
        $data['current'] = 'user';
        $data['error'] = '';
        $data['user_home'] = $this->Home_model->get_user_home($user);
        
        $this->load->vars($data);
        $this->load->view('header');
        $this->load->view('edit_profile_view');
        
    }
    
    public function edit_user(){
        $user = $this->session->userdata('login');
        $data['user'] = $user;
        $data['current'] = 'user';
        $login = $this->input->post('login');
        $old_password = $this->input->post('old_password');
        $password = $this->input->post('password');
        $confirmation = $this->input->post('confirmation');
        $data['user_home'] = $this->Home_model->get_user_home($user);
        
        
        if (!$this->User_model->is_present($login) && $user !== $login || $this->User_model->is_present($login) ){
            if($this->User_model->is_register($user, $old_password)){
                if ($password !== ''){
                    if ($password === $confirmation){
                        $this->User_model->edit_profile($user, $login, $password);
                        $this->session->set_userdata('login',$login);
                        redirect('Controller/profile');
                    } else{
                        $data['error'] = 'confirmation';
                        $this->load->vars($data);
                        $this->load->view('header');
                        $this->load->view('edit_profile_view',$data);
                    }
                } else{
                    $this->User_model->edit_profile_login($user,$login);
                    $this->session->set_userdata('login',$login);
                    redirect('Controller/profile');
                }
            } else{
                $data['error'] = 'old_password';
                $this->load->vars($data);
                $this->load->view('header');
                $this->load->view('edit_profile_view',$data);
            }
        } else{
            $this->load->vars($data);
            $this->load->view('header');
            $data['error'] = 'present';
            $this->load->view('edit_profile_view',$data);
        }
        
    }
    
    public function edit_home_access(){
        $user = $this->session->userdata('login');
        $home = $this->session->userdata('home');
        $data['user'] = $user;
        $data['current'] = $home;
        $data['current_bis'] = '';
        $data['home'] = $home;
        $data['admin'] = $this->User_model->is_admin($user,$home);
        $data['error'] = '';
        $data['user_home'] = $this->Home_model->get_user_home($user);
        
        $this->load->vars($data);
        $this->load->view('edit_home_view');
        
    }
    
    public function edit_home(){
        $user = $this->session->userdata('login');
        $home = $this->session->userdata('home');
        $data['current'] = $home;
        $data['current_bis'] = '';
        $data['user_home'] = $this->Home_model->get_user_home($user);
        $data['home'] = $home;
        $old_password = $this->input->post('old_password');
        $old_password_home = $this->input->post('old_password_home');
        $password = $this->input->post('password');
        $confirmation = $this->input->post('confirmation');
        $data['admin'] = $this->User_model->is_admin($user,$home);
        $reset_points = $this->input->post('reset_points');
        
        if ($this->User_model->is_register($user,$old_password)){
            if($this->Home_model->verification_home($home, $old_password_home)){
                if ($password !== ''){
                    if ($password === $confirmation){
                        $this->Home_model->edit_home($home,$password);
                        redirect('Controller/user_space');
                    } else{
                        $data['error'] = 'confirmation';
                        $this->load->vars($data);
                        $this->load->view('edit_home_view');
                    }
                }
                if ($reset_points !== ''){
                    $this->Home_model->edit_reset_points($home,$reset_points);
                    redirect('Controller/user_space');
                }
            } else{
                $data['error'] = 'old_password_home';
                $this->load->vars($data);
                $this->load->view('edit_home_view');
            }
        } else{
                $data['error'] = 'old_password';
                $this->load->vars($data);
                $this->load->view('edit_home_view');
        }
    }
    
    public function leave_home(){
        $home = $this->session->userdata('home');
        $user = $this->session->userdata('login');
        
        $this->Home_model->leave_home($user,$home);
        redirect('Controller/home');
    }
    
    public function blacklist($message = ''){
        $home = $this->session->userdata('home');
        $user = $this->session->userdata('login');
        $data['blacklist'] = $this->Home_model->get_blacklist($home);
        $data['current'] = $home;
        $data['current_bis'] = 'blacklist';
        $data['admin'] = $this->User_model->is_admin($user,$home);
        if ($message !== ''){
          $data['message'] = $message." a été débanni ! Le voilà de retour.";  
        } else{
            $data['message'] = '';
        }
        
        $data['user_home'] = $this->Home_model->get_user_home($user);
        
        $this->load->vars($data);
        $this->load->view('blacklist_view');
    }
    
    public function deban_user(){
        $user = $this->input->post('user_login');
        $home = $this->session->userdata('home');
        $this->User_model->deban($user, $home);
        
        redirect('Controller/blacklist/'.$user);
    }
    
    public function historic(){
        $user = $this->session->userdata('login');
        $home = $this->session->userdata('home');
        
        $data['tasks'] = $this->Task_model->get_old_tasks($home);
        $data['distributions'] = $this->Task_model->get_old_tasks_distribution($home);
        $data['home'] = $home;
        $data['current'] = $home;
        $data['current_bis'] = 'historic';
        $data['admin'] = $this->User_model->is_admin($user,$home);
        $data['user_home'] = $this->Home_model->get_user_home($user);
        
        $this->load->vars($data);
        $this->load->view('historic_task_view');
        
    }
    
    public function delete_home(){
        $user = $this->session->userdata('login');
        $home = $this->session->userdata('home');
        
        if ($this->User_model->is_admin($user,$home)){
            $this->Home_model->delete_home($home);
            redirect('Controller/home/delete_home');
        }
    }
    
    public function reset_points(){
        $user = $this->session->userdata('login');
        $home = $this->session->userdata('home');
        
        if ($this->User_model->is_admin($user,$home)){
            $this->Home_model->reset_points($home);
            redirect('Controller/user_space/reset_points');
        }
    }
}

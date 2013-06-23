<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->model('users_model');
    }
    
    public function index(){
        $data['page'] = 'users';
        $search = $this->input->get('s');
        
        $data['users'] = $this->users_model->get_users($search);
        $data['search'] = $search;
        
        $this->load->view('parts/header',$data);
        $this->load->view('pages/users/manage',$data);
        $this->load->view('parts/footer');
    }
    
    public function edit($slug){
        $data['page'] = 'users';
        
        $data['user'] = $this->users_model->get_user($slug);
        $data['user_items'] = $this->users_model->get_user_items($slug);
        $this->load->view('parts/header',$data);
        $this->load->view('pages/users/edit',$data);
        $this->load->view('parts/footer');
    }
    
    public function process(){
        $data['page'] = 'users';
        $post = $this->input->post();
        $data['post'] = $post;
        echo $post['specitemadd'];
        if (isset($post['specitemadd'])) {
            $this->users_model->add_button_item($post);
        }
        if (isset($post['action'])) {
            if($post['action'] == 'edit'){
            $this->users_model->edit_user($post);
            }elseif(preg_match('/^-\d+$/', $post['action'])){
                $this->users_model->take_button_credits($post);
            }elseif(preg_match('/^\d+$/', $post['action'])){
                $this->users_model->add_button_credits($post);
            }elseif($post['action'] == 'add_item'){
                $this->users_model->add_item($post);
            }elseif($post['action'] == 'remove_item'){
                $this->users_model->remove_useritem($post);
            }elseif ($post['action'] == "remove_user") {
                $this->users_model->remove_user($post);
            }  
        }

       redirect('/users/edit/'.$post['id'].'', 'refresh');
    }
}

/* End of file users.php */
/* Location: ./application/controllers/users.php */
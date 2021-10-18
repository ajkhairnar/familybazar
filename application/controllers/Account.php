<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller {

	public function __construct(){

        parent::__construct();
		date_default_timezone_set('Asia/Kolkata');
		$this->load->model('Login_m');
        
    }
    
    public function index()
    {
        $data['title']="My Profile";
        
        $user_id = $this->session->userdata('admin_login')['id'];
        
        $data['user']=$this->Login_m->get_userdata($user_id);
        
        $this->load->view('my_account',$data);
    }
    
    public function editprofile($id)
    {
        $user_id = $this->session->userdata('admin_login')['id'];
        $data['user']=$this->Login_m->get_userdata($user_id);
        
         $this->form_validation->set_rules('admin_username','username','trim|required');
         $this->form_validation->set_rules('admin_pass','password','trim|required');
        $this->form_validation->set_rules('admin_phone','phone','trim|required|regex_match[/^[0-9]{10}$/]');
        $this->form_validation->set_rules('admin_email','email','trim|required');
        $this->form_validation->set_rules('admin_name','name','trim|required');
        
         if($this->form_validation->run()==false) {
            $this->load->view('my_account',$data);
        } else{
            
            unset($_POST['btnsubmit']);
            
            $isUpdate = $this->Login_m->profile_update_m($_POST,$id);
            
            if($isUpdate){
                $this->session->set_flashdata('success_msg', 'Profile Updated successfully !');
                redirect('Account');
            }
            
            
            
        }
    }
}

?>
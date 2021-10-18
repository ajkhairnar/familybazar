<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct(){

		parent::__construct();
		
		if($this->session->userdata('admin_login'))
	    {
	    	redirect('dashboard');
		}
		
        $this->load->model('Login_m');
     }

    


    public function index()
	{
        if($this->session->userdata('userdata'))
		{
			return redirect('Profile');
		}

		
        $data['Title']="Login";
        
		$this->form_validation->set_rules('admin_username','Username','trim|required');
		$this->form_validation->set_rules('admin_pass','Password','trim|required');

		if($this->form_validation->run()==false)
		{
            $this->load->view('login',$data);
		}
		else
		{
			$admin_username=$this->security->xss_clean($this->input->post('admin_username'));
            $admin_pass=$this->security->xss_clean($this->input->post('admin_pass'));
          

            $admin=$this->Login_m->user_login($admin_username,$admin_pass);
            
			if($admin)
			{
				$admindata=array(
                                'id'              => $admin->id,
                                'admin_username'  =>$admin->admin_username,
								'admin_email'     =>$admin->admin_email,
                                'admin_name'      =>$admin->admin_name,
                                'admin_phone'     =>$admin->admin_phone,
                                'authenticated'   => TRUE
								);
				$this->session->set_userdata('admin_login',$admindata);

                return redirect('dashboard');
                
			}
			else
			{
				$this->session->set_flashdata('login_fail','Plase Enter Valid Username & Password.');
				redirect('Login');
			}
		}
    }
}
    ?>
	
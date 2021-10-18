<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct(){
        parent::__construct();
        if(!$this->session->userdata('admin_login'))
	    {
	    	redirect('login');
        }
        $this->load->model('Login_m');
     }

     public function index()
     {
        //$data['gettotal']=$this->Landmark_m->get_landmark();
       // $this->load->view('dashboard',$data);
       $this->load->view('dashboard');
     }

}
    ?>
	
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller {

    public function __construct(){

        parent::__construct();
        if(!$this->session->userdata('admin_login'))
	    {
	    	redirect('Login');
        }
        

     }

     public function index()
     {
        $this->session->sess_destroy();
		return redirect('Login');
     }


}
    ?>
	
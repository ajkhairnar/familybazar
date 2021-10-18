<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agents extends CI_Controller {

    public function __construct(){

        parent::__construct();
        if(!$this->session->userdata('admin_login'))
	    {
	    	redirect('Login');
        }
        $this->load->model('Agent_m');
        // $this->load->model('Landmark_m');
        $this->load->model('Shop_m');



     }

 
     public function agent_manage($edit=0) {

		$isEdit=$edit;

		$data['isEdit'] =true;   // show update button

		if($isEdit !=0) {


            $data['result']= $result =$this->Agent_m->get_single_agent($isEdit);
            $data['statelist']=$this->Shop_m->get_statelist();
            // $data['landmarks']=$this->Landmark_m->get_landmark1();
           
			$data['id']=$result->agent_id;
			$data['agent_fullname']=$result->agent_fullname;
			$data['agent_username']=$result->agent_username;
			$data['agent_phone']=$result->agent_phone;
            $data['agent_email']=$result->agent_email;
            
			$this->load->view('add_agent',$data);
		}

		if($isEdit==0) {

			$data['agents']=$this->Agent_m->get_agent();
			$this->load->view('agent_list',$data);
		}
    }
    
    
     public function add_agent($id=0) {

        $data['statelist']=$this->Shop_m->get_statelist();
        // $data['landmarks']=$this->Landmark_m->get_landmark1();

        if($id !=0) {

            $data['isEdit']= $isEdit=true;	// show update button
        } else {

            $data['isEdit']= $isEdit=false;	// hide update button
        }

        $data['id']=$id;

        //form validation
        $this->form_validation->set_rules('agent_fullname','fullname','trim|required');
        $this->form_validation->set_rules('agent_username','username','trim|required');

        if(!$isEdit)
        {
            $this->form_validation->set_rules('agent_pass','password','trim|required');
        }
    
        $this->form_validation->set_rules('agent_phone','phone','trim|required|regex_match[/^[0-9]{10}$/]');
        $this->form_validation->set_rules('agent_email','email','trim|required');
        // $this->form_validation->set_rules('agent_aadhar','aadhar','trim|required|regex_match[/^[0-9]{12}$/]');

        $this->form_validation->set_rules('agent_state','State','trim|required');
        $this->form_validation->set_rules('agent_city','City','trim|required');

        $this->form_validation->set_rules('agent_landmarkarea','landmark','trim|required');
        $this->form_validation->set_rules('agent_address','address','trim|required');

        if($this->form_validation->run()==false) {
            $this->load->view('add_agent',$data);
        } 
        
        else {

            $image_pan = '';
            $image_profile='';

            // btn submit
            if($this->input->post('btnsubmit')) {

                $config = [
                    'upload_path' =>'./uploads/agents/',
                    'allowed_types' => 'gif|jpg|jpeg|png|svg',
                    'file_name' => $_POST['agent_fullname'].'_aadhar',
                ];

                $this->load->library('upload',$config);
                $this->upload->initialize($config);

                if($this->upload->do_upload('aadharcard'))
                {
                    unset($_POST['btnsubmit']);	
                    
                    $data =$this->upload->data();
                    // echo "<pre>";
                    // print_r($data);
                    // $image_path=base_url("upload/".$data['raw_name'].$data['file_ext']);

                    $image_aadhar=$data['file_name'];

                    $_POST['agent_aadhar'] = $image_aadhar;


                    //pancard
                    if (isset($_FILES['pancard']) && $_FILES['pancard']['name'] != ''){
                        unset($config);

                        $path="agents/";
                        $img_name=$_POST['agent_fullname'].'_pancard';
                        $pan = $this->ddoo_upload('pancard',$path,$img_name);

                        if($pan)
                        {
                           
                            // echo $pan['upload_data']['raw_name'];
                            // $image_pan=$pan['file_name'].$pan['upload_data']['file_ext'];   
                            $image_pan=$pan['upload_data']['file_name'];   
                        }else{
                            $image_pan='';
                        }

                    }


                    $_POST['agent_pancard'] =  $image_pan;


                    //profile
                    if (isset($_FILES['profile']) && $_FILES['profile']['name'] != ''){
                        unset($config);

                        $path="agents/";
                         $img_name=$_POST['agent_fullname'].'_profile';
                        $profile = $this->ddoo_upload('profile',$path,$img_name);

                        if($profile)
                        {
                            
                            // echo $pan['upload_data']['raw_name'];
                            $image_profile=$profile['upload_data']['file_name'];   
                        }else{
                            $image_profile='';
                        }

                    }


                    $_POST['agent_profile'] =  $image_profile;
                        

                    $password = password_hash($_POST['agent_pass'], PASSWORD_DEFAULT);

                    $update = array(
                        "agent_pass" => $password,
                        "agent_status" => 'approved',
                        "agent_active" => 'active',
                       
                    );
                    $final=array_merge($_POST,$update);


                    
                    $isPost=$this->Agent_m->post_agent($final);
                    if($isPost){
                        $this->session->set_flashdata('success_msg', 'Agent Added successfully !');
                        redirect('agents/agent_manage');
                    }
                }else {
                    $data['upload_error'] = $this->upload->display_errors();
                    $this->load->view('add_agent',$data);
                }    
            }

            //btn update
            else {
               
                
                unset($_POST['btnupdate']);	
                
                $isPut=$this->Agent_m->put_agent($id,$_POST);
                if($isPut){
                    $this->session->set_flashdata('success_msg', 'Agent Updated successfully !');
                    redirect('agents/agent_manage');
                }

            }
        }
    }




    public function ddoo_upload($filename,$path,$username_file){
        
        $config = [
            'upload_path' =>'./uploads/'.$path,
            'allowed_types' => 'gif|jpg|jpeg|png|svg',
            'file_name' => $username_file,
        ];

        $this->load->library('upload',$config);
        $this->upload->initialize($config);

        if ( ! $this->upload->do_upload($filename)) {
            // $error = array('error' => $this->upload->display_errors());
           
            return false;

        // $this->load->view('upload_form', $error);
        } else {

         $data = array('upload_data' => $this->upload->data());
         return $data;
        //$this->load->view('upload_success', $data);
        }
    }



    public function view_agent($id){
        $data['result']= $result =$this->Agent_m->get_single_agent($id);
        $this->load->view('view_agent',$data);  
    }

    //delete agent
	public function agent_delete($id) {

		$isDelete=$this->Agent_m->delete_agent($id);

		if($isDelete) {
			 $this->session->set_flashdata('success_msg', 'Agent has been removed successfully !');
        }else{
            $this->session->set_flashdata('error_msg', 'Some problems occurred, please try again.');
        }

        redirect('agents/agent_manage');
        
    }
    



    //agent pending list
    public function agent_pending_list()
    {
        $data['pendingagents']=$this->Agent_m->get_pending_agent();
        $this->load->view('agent_pending_list',$data);
    }


    public function view_agent_pending($id)
    {
        $data['result']=$this->Agent_m->get_single_pending_agent($id);
        $this->load->view('view_agent_pending',$data);
    }


    public function agent_approve($id)
    {

        $data = array(
            "agent_status" => 'approved',
            "agent_active" => 'active',
        );

      
        $isUpdate=$this->Agent_m->post_agent_approved($id,$data);
        if($isUpdate){
            $this->session->set_flashdata('success_msg', 'Approved successfully !');
             redirect('agents/agent_pending_list');
        }


        // $data['result']=$this->Agent_m->get_single_pending_agent($id);
        // $this->load->view('view_agent_pending',$data);
    }
    
    
    public function agent_decline($id)
    {

        $data = array(
            "agent_status" => 'decline',
            "agent_active" => 'inactive',
        );

      
        $isUpdate=$this->Agent_m->post_agent_approved($id,$data);
        if($isUpdate){
            $this->session->set_flashdata('success_msg', 'Declined successfully !');
             redirect('agents/agent_pending_list');
        }


        // $data['result']=$this->Agent_m->get_single_pending_agent($id);
        // $this->load->view('view_agent_pending',$data);
    }
    
    public function getallagent()
    {
       // POST data
     $postData = $this->input->post();

     // Get data
     $data = $this->Agent_m->getallagent($postData);

     echo json_encode($data);
    }
    
     public function getallpendingagent()
    {
       // POST data
     $postData = $this->input->post();

     // Get data
     $data = $this->Agent_m->getallpendingagent($postData);

     echo json_encode($data);
    }
    


}
    ?>
	
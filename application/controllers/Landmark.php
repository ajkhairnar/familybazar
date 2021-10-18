<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Landmark extends CI_Controller {

    public function __construct(){

        parent::__construct();
        if(!$this->session->userdata('admin_login'))
	    {
	    	redirect('Login');
        }
        $this->load->model('Landmark_m');
        $this->load->model('Shop_m');

        

     }

    //  public function index()
    //  {
	// 	$this->load->view('add_landmark');
    //  }


     


     public function landmark_manage($edit=0) {

		$isEdit=$edit;

		$data['isEdit'] =true;   // show update button

		if($isEdit !=0) {

			$data['result']= $result =$this->Landmark_m->get_single_landmark($isEdit);
            $data['statelist']=$this->Shop_m->get_statelist();
			$data['id']=$result->landmark_id;
			$data['landmark_name']=$result->landmark_name;
			$data['shop_city']=$result->shop_city;
			$data['shop_state']=$result->shop_state;
            
			$this->load->view('add_landmark',$data);
		}

		if($isEdit==0) {

			$data['landmarks']=$this->Landmark_m->get_landmark();
			$this->load->view('landmark_list',$data);
		}
    }
    
    

     public function add_landmark($id=0) {

        $data['statelist']=$this->Shop_m->get_statelist();

        // print_r($data);
        if($id !=0) {

            $data['isEdit']= $isEdit=true;	// show update button
        } else {

            $data['isEdit']= $isEdit=false;	// hide update button
        }

        $data['id']=$id;

        //form validation
        $this->form_validation->set_rules('shop_state','State','trim|required');
        $this->form_validation->set_rules('shop_city','City','trim|required');
        $this->form_validation->set_rules('landmark_name','Landmark','trim|required');


        if($this->form_validation->run()==false) {
            $this->load->view('add_landmark',$data);
        } 
        
        else {

            // btn submit
            if($this->input->post('btnsubmit')) {
                
                unset($_POST['btnsubmit']);	
               

                $isPost=$this->Landmark_m->post_landmark($_POST);
                if($isPost){
                    $this->session->set_flashdata('success_msg', 'Landmark Added successfully !');
                     redirect('landmark/landmark_manage');
                }
            }

            //btn update
            else {
               
                unset($_POST['btnupdate']);	
                
                $isPut=$this->Landmark_m->put_landmark($id,$_POST);
                if($isPut){
                    $this->session->set_flashdata('success_msg', 'Landmark Updated successfully !');
                    redirect('landmark/landmark_manage');
                }

            }
        }
    }





    //delete agent
	public function landmark_delete($id) {

		$isDelete=$this->Landmark_m->delete_landmark($id);

		if($isDelete) {
			 $this->session->set_flashdata('success_msg', 'Landmark has been removed successfully !');
        }else{
            $this->session->set_flashdata('error_msg', 'Some problems occurred, please try again.');
        }

        redirect('landmark/landmark_manage');
        
    }
    


    


}
    ?>
	
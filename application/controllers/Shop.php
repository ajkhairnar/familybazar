<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Shop extends CI_Controller {

    public function __construct(){

        parent::__construct();

        if(!$this->session->userdata('admin_login'))
	    {
	    	redirect('Login');
        }
        
        $this->load->model('Shop_m');

     }

    //  public function index()
    //  {
    //         $data['agents']=$this->Agent_m->get_agent();
	// 		$this->load->view('agent_list',$data);
    //  }



     


     public function shop_manage($edit=0) {

		$isEdit=$edit;

		$data['isEdit'] =true;   // show update button

		if($isEdit !=0) {

            $data['result']= $result =$this->Shop_m->get_single_shop($isEdit);
            
            $data['statelist']=$this->Shop_m->get_statelist();

			$data['id']=$result->shop_id;
			$data['shop_owner']=$result->shop_owner;
			$data['shop_phone']=$result->shop_phone;
            $data['shop_email']=$result->shop_email;

            $data['shop_landmarkarea']=$result->shop_landmarkarea;
            $data['shop_city']=$result->shop_city;
            $data['shop_state']=$result->shop_state;
            $data['shop_address']=$result->shop_address;
            $data['shop_email']=$result->shop_zipcode;

			$this->load->view('add_shop',$data);
		}

		if($isEdit==0) {

			$data['shops']=$this->Shop_m->get_shop();
			$this->load->view('shop_list',$data);
		}
    }
    
    
     public function add_shop($id=0) {
        $data['statelist']=$this->Shop_m->get_statelist();
        if($id !=0) {

            $data['isEdit']= $isEdit=true;	// show update button
        } else {

            $data['isEdit']= $isEdit=false;	// hide update button
        }

        $data['id']=$id;

        //form validation
      
        $this->form_validation->set_rules('shop_owner','owner name','trim|required');
        $this->form_validation->set_rules('shop_phone','phone','trim|required|regex_match[/^[0-9]{10}$/]');

        $this->form_validation->set_rules('shop_email','email','trim|required');
        $this->form_validation->set_rules('shop_landmarkarea','landmark area','trim|required');


        $this->form_validation->set_rules('shop_city','city','trim|required');
        $this->form_validation->set_rules('shop_state','state','trim|required');

        $this->form_validation->set_rules('shop_address','address','trim|required');

        $this->form_validation->set_rules('shop_zipcode','zip code','trim|required|regex_match[/^[0-9]{6}$/]');
   


        if($this->form_validation->run()==false) {
            $this->load->view('add_shop',$data);
        } 
        else {

            // btn submit
            if($this->input->post('btnsubmit')) {
                
                unset($_POST['btnsubmit']);	
 
              
                $isPost=$this->Shop_m->post_shop($_POST);
                if($isPost){
                    $this->session->set_flashdata('success_msg', 'Shop Added successfully !');
                     redirect('shop/add_shop');
                }
            }

            //btn update
            else {
               
                unset($_POST['btnupdate']);	
                
                $isPut=$this->Shop_m->put_shop($id,$_POST);
                if($isPut){
                    $this->session->set_flashdata('success_msg', 'Shop Updated successfully !');
                    redirect('shop/shop_manage');
                }

            }
        }
    }


    public function view_shop($id){
        $data['result']= $result =$this->Shop_m->get_single_shop($id);
        $this->load->view('view_shop',$data);  
    }




    //delete agent
	public function shop_delete($id) {

		$isDelete=$this->Shop_m->delete_shop($id);

		if($isDelete) {
			 $this->session->set_flashdata('success_msg', 'Shop has been removed successfully !');
        }else{
            $this->session->set_flashdata('error_msg', 'Some problems occurred, please try again.');
        }

        redirect('shop/shop_manage');
        
	}
	
	 function shoplist()
    {
       // POST data
     $postData = $this->input->post();

     // Get data
     $data = $this->Shop_m->getallshop($postData);

     echo json_encode($data);
    }


}
    ?>
	
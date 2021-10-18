<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {

    public function __construct(){

        parent::__construct();

        if(!$this->session->userdata('admin_login'))
	    {
	    	redirect('Login');
        }
        
        $this->load->model('Category_m');

     }

    //  public function index()
    //  {
    //         $data['agents']=$this->Agent_m->get_agent();
	// 		$this->load->view('agent_list',$data);
    //  }



     


     public function category_manage($edit=0) {

		$isEdit=$edit;

		$data['isEdit'] =true;   // show update button

		if($isEdit !=0) {

			$data['result']= $result =$this->Category_m->get_single_category($isEdit);

			$data['id']=$result->cat_id;
			$data['cat_name']=$result->cat_name;
			
			$this->load->view('add_category',$data);
		}

		if($isEdit==0) {

			$data['categories']=$this->Category_m->get_category();
			$this->load->view('category_list',$data);
		}
    }
    


    
     public function add_category($id=0) {

        if($id !=0) {

            $data['isEdit']= $isEdit=true;	// show update button
        } else {

            $data['isEdit']= $isEdit=false;	// hide update button
        }

        $data['id']=$id;

        //form validation
        $this->form_validation->set_rules('cat_name','Category name','trim|required');


        if($this->form_validation->run()==false) {

            $this->load->view('add_category',$data);

        } 
        else {

            // btn submit
            if($this->input->post('btnsubmit')) {

                $config = [
                    'upload_path' =>'./uploads/category/',
                    'allowed_types' => 'svg|jpg|jpeg|png'
                ];
                
                
                $name1 = str_replace([' ','/','&'],['_','','_'],$_POST['cat_name']);
                $_POST['cat_slug'] = strtolower(str_replace('__','_',$name1));
                

              
                $this->load->library('upload',$config);
               
                if($this->upload->do_upload('cat_image'))
                {
                    
                    unset($_POST['btnsubmit']);	

                    
                    $data =$this->upload->data();

                    $image_path=base_url("upload/".$data['raw_name'].$data['file_ext']);

                    $image=$data['raw_name'].$data['file_ext'];

                    $_POST['cat_img'] = $image;


                    $isPost=$this->Category_m->post_category($_POST);
                    if($isPost){
                        $this->session->set_flashdata('success_msg', 'Category Added successfully !');
                        redirect('category/category_manage');
                    }
                }else{
                    
                    $data['upload_error'] = $this->upload->display_errors();
                    $this->load->view('add_category',$data);
                }    
            }

            //btn update
            else {
               
                unset($_POST['btnupdate']);

                $old_image_cat = $_POST['old_image_cat'];
                
                $config = [
                    'upload_path' =>'./uploads/category/',
                    'allowed_types' => 'svg|jpg|jpeg|png'
                ];

                $this->load->library('upload',$config);
                
                if($this->upload->do_upload('cat_image'))
                {
                   
                    unlink( FCPATH."uploads/category/".$old_image_cat);

                    
                    $data =$this->upload->data();

                    $image_path=base_url("upload/".$data['raw_name'].$data['file_ext']);

                    $new_photo =$data['raw_name'].$data['file_ext'];

                    // $_POST['product_img'] = $image;
                   
                    // $update = array();


                }else{

                    $new_photo = $old_image_cat;
                    
                }    
                $name1 = str_replace([' ','/','&'],['_','','_'],$_POST['cat_name']);
                $_POST['cat_slug'] = strtolower(str_replace('__','_',$name1));

                unset($_POST['old_image_cat']);
                $_POST['cat_img'] =  $new_photo;
                
                $isPut=$this->Category_m->put_category($id,$_POST);
                if($isPut){
                    $this->session->set_flashdata('success_msg', 'Category Updated successfully !');
                    redirect('category/category_manage');
                }

            }
        }
    }


    // public function view_shop($id){
    //     $data['result']= $result =$this->Shop_m->get_single_shop($id);
    //     $this->load->view('view_shop',$data);  
    // }




    //delete agent
	public function category_delete($id,$img_path) {

        // echo $id."<br>";
        // echo $img_path;
        // exit;
        $isDelete=$this->Category_m->delete_category($id);
        
        unlink( FCPATH."uploads/category/".$img_path);

		if($isDelete) {
			 $this->session->set_flashdata('success_msg', 'Category has been removed successfully !');
        }else{
            $this->session->set_flashdata('error_msg', 'Some problems occurred, please try again.');
        }

        redirect('category/category_manage');
        
	}
	
	
	 function categorylist()
    {
       // POST data
     $postData = $this->input->post();

     // Get data
     $data = $this->Category_m->getallcategory($postData);

     echo json_encode($data);
    }

}
    ?>
	
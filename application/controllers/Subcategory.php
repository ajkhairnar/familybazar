<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Subcategory extends CI_Controller {

    public function __construct(){

        parent::__construct();

        if(!$this->session->userdata('admin_login'))
	    {
	    	redirect('Login');
        }
        
        $this->load->model('Subcategory_m');
        $this->load->model('Category_m');

        

     }

    //  public function index()
    //  {
    //         $data['agents']=$this->Agent_m->get_agent();
	// 		$this->load->view('agent_list',$data);
    //  }



     


     public function subcategory_manage($edit=0) {

		$isEdit=$edit;

		$data['isEdit'] =true;   // show update button

		if($isEdit !=0) {

			$data['result']= $result =$this->Subcategory_m->get_single_subcategory($isEdit);
            $data['resultcategory']=$this->Category_m->get_category1();
            
			$data['id']=$result->sub_cat_id;
            $data['cat_name']=$result->cat_name;
			$this->load->view('add_subcategory',$data);
		}

		if($isEdit==0) {
            $data['resultcategory']=$this->Category_m->get_category1();
			$data['subcategories']=$this->Subcategory_m->get_subcategory();
			$this->load->view('subcategory_list',$data);
		}
    }
    


    
     public function add_subcategory($id=0) {

        $data['resultcategory']=$this->Category_m->get_category1();
        //  $data['category'] = $resultcategory->cat_name;
        

        if($id !=0) {

            $data['isEdit']= $isEdit=true;	// show update button
        } else {

            $data['isEdit']= $isEdit=false;	// hide update button
        }

        $data['id']=$id;

        //form validation
        $this->form_validation->set_rules('cat_name','Category name','trim|required');
        $this->form_validation->set_rules('sub_cat_name','Subcategory name','trim|required');


        if($this->form_validation->run()==false) {

            $this->load->view('add_subcategory',$data);

        } 
        else {

            // btn submit
            if($this->input->post('btnsubmit')) {
                
                $config = [
                    'upload_path' =>'./uploads/subcategory/',
                    'allowed_types' => 'gif|jpg|jpeg|png|svg'
                ];
                $this->load->library('upload',$config);
               

                if($this->upload->do_upload('sub_cat_image'))
                {
                    unset($_POST['btnsubmit']);	
                    

                    $category_row = $this->Category_m->get_single_category($_POST['cat_name']);
                    

                    $data =$this->upload->data();

                    $image_path=base_url("upload/".$data['raw_name'].$data['file_ext']);

                    $image=$data['raw_name'].$data['file_ext'];

                    $_POST['sub_cat_img'] = $image;
                    
                    $cat_name = str_replace([' ','/','&'],['_','','_'],$category_row->cat_name);
                    $_POST['cat_slug'] = strtolower(str_replace('__','_',$cat_name));
                    
                    $sub_cat_name = str_replace([' ','/','&'],['_','','_'],$_POST['sub_cat_name']);
                    $_POST['sub_cat_slug'] = strtolower(str_replace('__','_',$sub_cat_name));


                    $array = array(
                        'sub_cat_name' =>$_POST['sub_cat_name'],
                        'cat_id' =>$category_row->cat_id,
                        'sub_cat_slug' => $_POST['sub_cat_slug'],
                        'cat_name' =>$category_row->cat_name,
                        'cat_slug' =>$_POST['cat_slug'],
                        'sub_cat_img' => $_POST['sub_cat_img']
                        
                    );

                
                    $isPost=$this->Subcategory_m->post_subcategory($array);
                    if($isPost){
                        $this->session->set_flashdata('success_msg', 'Subcategory Added successfully !');
                        redirect('subcategory/subcategory_manage');
                    }
                }else{

                    $data['upload_error'] = $this->upload->display_errors();
                    $this->load->view('add_subcategory',$data);

                }    
                    
            }

            //btn update
            else {
               
                unset($_POST['btnupdate']);

                $old_image_sub_cat = $_POST['old_image_sub_cat'];
                
                $config = [
                    'upload_path' =>'./uploads/subcategory/',
                    'allowed_types' => 'gif|jpg|jpeg|png|svg'
                ];

                $this->load->library('upload',$config);

                $category_row=$this->Category_m->get_single_category($_POST['cat_name']);

                if($this->upload->do_upload('sub_cat_image'))
                {
                   
                    unlink( FCPATH."uploads/subcategory/".$old_image_sub_cat);

                    
                    $data =$this->upload->data();

                    $image_path=base_url("upload/".$data['raw_name'].$data['file_ext']);

                    $new_photo =$data['raw_name'].$data['file_ext'];

                    // $_POST['product_img'] = $image;
                   
                    // $update = array();


                }else{

                    $new_photo = $old_image_sub_cat;

                }  

                unset($_POST['old_image_sub_cat']);

                $_POST['sub_cat_img'] =  $new_photo;
                
                
                $cat_name = str_replace([' ','/','&'],['_','','_'],$category_row->cat_name);
                    $_POST['cat_slug'] = strtolower(str_replace('__','_',$cat_name));
                    
                    $sub_cat_name = str_replace([' ','/','&'],['_','','_'],$_POST['sub_cat_name']);
                    $_POST['sub_cat_slug'] = strtolower(str_replace('__','_',$sub_cat_name));


                    $array = array(
                        'sub_cat_name' =>$_POST['sub_cat_name'],
                        'cat_id' =>$category_row->cat_id,
                        'sub_cat_slug' => $_POST['sub_cat_slug'],
                        'cat_name' =>$category_row->cat_name,
                        'cat_slug' =>$_POST['cat_slug'],
                        'sub_cat_img' => $_POST['sub_cat_img']
                        
                    );

               
                $isPut=$this->Subcategory_m->put_subcategory($id,$array);
                if($isPut){
                    $this->session->set_flashdata('success_msg', 'Subcategory Updated successfully !');
                    redirect('subcategory/subcategory_manage');
                }

            }
        }
    }


    // public function view_shop($id){
    //     $data['result']= $result =$this->Shop_m->get_single_shop($id);
    //     $this->load->view('view_shop',$data);  
    // }




    //delete subcategory
	public function subcategory_delete($id) {
        
        $img = $this->Subcategory_m->get_single_subcategory($id);
        
        $img_path = $img->sub_cat_img;
        // print_r($img);
        // echo "sdf";
        
        // exit;
        unlink( FCPATH."uploads/subcategory/".$img_path);
        
        $isDelete=$this->Subcategory_m->delete_subcategory($id);
    
		if($isDelete) {
			 $this->session->set_flashdata('success_msg', 'Subcategory has been removed successfully !');
        }else{
            $this->session->set_flashdata('error_msg', 'Some problems occurred, please try again.');
        }

        redirect('subcategory/subcategory_manage');
        
	}
	
	//update multiple subcategory of category
    public function update_subcat()
    {
        if(isset($_POST['submit'])){

            $subcate_id = $_POST['check'];

            $getcat_id_name= explode(",",$_POST['product_cat']);
            $arr = array(
                'cat_id'  =>$getcat_id_name[0],
                'cat_name' =>$getcat_id_name[1],
                'cat_slug' =>$getcat_id_name[2]
            );

            $updated=$this->Subcategory_m->update_cat_m($subcate_id,$arr);

            if($updated)
            {
                $this->session->set_flashdata('success_msg', 'Subcategory Update Successfully !');
                redirect('subcategory/subcategory_manage');

            }

        }
    }
    
    
  function getsubcategory()
    {
       // POST data
     $postData = $this->input->post();

     // Get data
     $data = $this->Subcategory_m->getallsubcategory($postData);

     echo json_encode($data);
    }

}
    ?>
	
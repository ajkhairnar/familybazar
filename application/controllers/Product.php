<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

    public function __construct(){

        parent::__construct();

        if(!$this->session->userdata('admin_login'))
	    {
	    	redirect('Login');
        }
        
        $this->load->model('Product_m');
        $this->load->model('Category_m');
        $this->load->model('Subcategory_m');


        

        

     }

    //  public function index()
    //  {
    //         $data['agents']=$this->Agent_m->get_agent();
	// 		$this->load->view('agent_list',$data);
    //  }



     


     public function product_manage($edit=0) {

		$isEdit=$edit;

		$data['isEdit'] =true;   // show update button

		if($isEdit !=0) {

            $data['resultcategory']=$this->Category_m->get_category1();
            $data['resultsubcategory']=$this->Subcategory_m->get_subcategory1();

			$data['result']= $result =$this->Product_m->get_single_product($isEdit);
			$data['product_id']=$result->product_id;
			$data['product_cat']=$result->product_cat;
			$data['product_subcat']=$result->product_cat;
			$data['product_company']=$result->product_company;
            $data['product_name']=$result->product_name;
            $data['product_variation']=$result->product_variation;
            $data['product_dprice']=$result->product_dprice;
            $data['product_mrp']=$result->product_mrp;
            

			$this->load->view('add_product',$data);
		}

		if($isEdit==0) {
             $data['resultcategory']=$this->Category_m->get_category1();
            $data['resultsubcategory']=$this->Subcategory_m->get_subcategory1();
			$data['products']=$this->Product_m->get_product();
			$this->load->view('product_list',$data);
		}
    }
    
    
    function productlist()
    {
       // POST data
     $postData = $this->input->post();

     // Get data
     $data = $this->Product_m->getallproducts($postData);

     echo json_encode($data);
    }
    
    
    
    function show_products()
    {
        $data = $this->Product_m->get_result();
        $finaldata = '';
        
        
        foreach ($data as $product) {
        
        $finaldata .= '
                    <tr>
                        <td scope="row">'.$product->product_id.'</td>
                        <td scope="row"><img src="'.base_url()?>uploads/product/<?=$product->product_img.'"></td>
                        <td scope="row">'.$product->product_company.'</td>
                        <td scope="row">'.$product->product_name.'</td>
                        <td scope="row">'.$product->product_cat.'</td>
                        <td scope="row">'.$product->product_subcat.'</td>
                        <td scope="row">';
                        
                        
                        
                        
                        $product_variation1=json_decode($product->product_variation );
                        if(is_array($product_variation1))
                        {
                        $product_variation=$product_variation1[0]; 
                        foreach($product_variation as $key => $value) {
                          $finaldata .= $product_variation[$key]."<br>";
                        }
                        }
                        else
                        {
                            $finaldata .= $product_variation1;
                        }
                        
                        
                        
                        
                        $finaldata .= '</td>
                        
                        <td scope="row">';
                        
                        
                        
                        

                        $product_dprice1=json_decode( $product->product_dprice );
                        if(is_array($product_dprice1))
                        {
                        $product_dprice=$product_dprice1[0]; 
                        foreach($product_dprice as $key => $value) {
                          $finaldata .= $product_dprice[$key]."<br>";
                        }
                        }
                        else
                        {
                            $finaldata .= $product_dprice1;
                        }
                        
                        
                        $finaldata .= '</td>

                        <td scope="row">';
                        
                        $product_mrp1=json_decode( $product->product_mrp);
                        if(is_array($product_mrp1))
                        {
                        $product_mrp=$product_mrp1[0]; 
                        foreach($product_mrp as $key => $value) {
                          $finaldata .= $product_mrp[$key]."<br>";
                        }
                        }
                        else
                        {
                            $finaldata .= $product_mrp1;
                        }
                        
                        
                        
                       $finaldata .= '</td>

                        
                        <td>
                           
                        </td>
                      
                    </tr>';

        echo $finaldata;
    }
    
    
    }
    
    
     public function add_product($id=0) {

        $data['resultcategory']=$this->Category_m->get_category1();

        $data['resultsubcategory']=$this->Subcategory_m->get_subcategory1();


        if($id !=0) {

            $data['isEdit']= $isEdit=true;	// show update button
        } else {

            $data['isEdit']= $isEdit=false;	// hide update button
        }

        $data['product_id']=$id;

        //form validation
        $this->form_validation->set_rules('product_cat','product category','trim|required');
        $this->form_validation->set_rules('product_subcat','product subcategory','trim|required');
        $this->form_validation->set_rules('product_company','product company','trim|required');
        $this->form_validation->set_rules('product_name','product name','trim|required');
        // $this->form_validation->set_rules('product_variation','product variation','trim|required');
        // $this->form_validation->set_rules('product_dprice','product distributor price','trim|required');
        // $this->form_validation->set_rules('product_mrp','product mrp','trim|required');

      

        if($this->form_validation->run()==false ) {
            $this->load->view('add_product',$data);
        } 
        else {

             // btn submit
            if($this->input->post('btnsubmit')) {

                $config = [
                    'upload_path' =>'./uploads/product/',
                    'allowed_types' => 'gif|jpg|jpeg|png|svg',
                    'file_name' => 'PRODUCT'.date('dmY').time().rand(10000,99999),
                ];

                
                // start product_variation  -------
                $product_variation = $this->input->post('product_variation');
                $product_dprice = $this->input->post('product_dprice');
                $product_mrp = $this->input->post('product_mrp');

                //  foreach($product_variation as $variation=>$key) {

                //     $a = array($product_variation[$key], $product_dprice[$key],$product_mrp[$key]);

                //     $newa = $a;
                //  }

                for($i=0;$i<count($product_variation); $i++)
                {
                    $new_variation_arr[] = array($product_variation[$i], $product_dprice[$i],$product_mrp[$i]);
                }
                //  print_r($product_variation);


                // echo "<pre>";

                $_POST['new_variation_arr'] = $new_variation_arr;
                // print_r($_POST['new_variation_arr']);
                // exit;


                // foreach($product_variation as $variation) {

                //     $final_variation[] = filter_var($variation,FILTER_SANITIZE_STRING);

                // }

                // $Pvariation[] = $final_variation;
                // end product_variation  -------
                

                // start product_dprice  -------
               
                // foreach($product_dprice as $dprice) {

                //     $final_dprice[] = filter_var($dprice,FILTER_SANITIZE_STRING);

                // }

                // $Pdprice[] = $final_dprice;
                // end product_dprice  -------


                // start product_mrp  -------
                 




                //  foreach($product_mrp as $mrp) {
 
                //      $final_mrp[] = filter_var($mrp,FILTER_SANITIZE_STRING);
 
                //  }
                //  $Pmrp[] = $final_mrp;
                // end product_mrp  -------
              
                // $_POST['product_variation']=json_encode($Pvariation);

                // $_POST['product_dprice']=json_encode($Pdprice);

                // $_POST['product_mrp']=json_encode($Pmrp);

                $_POST['product_uniqid'] = 'PRODUCT'.date('dmY').time().rand(100,999);

                $this->load->library('upload',$config);

                if($this->upload->do_upload('product_image'))
                {
                    unset($_POST['btnsubmit']);	
                    
                    $data =$this->upload->data();

                    // $image_path=base_url("upload/".$data['raw_name'].$data['file_ext']);

                    $image=$data['file_name'];

                    $_POST['product_img'] = $image;
                   
                    $update = array();
    
                    $final=array_merge($_POST,$update);
                    $isPost=$this->Product_m->post_product($final);
                    if($isPost){
                        $this->session->set_flashdata('success_msg', 'Product Added successfully !');
                         redirect('product/product_manage');
                    }

            }else{
                $data['upload_error'] = $this->upload->display_errors();
                $this->load->view('add_product',$data);
            }
            
           
            }

            
            else {

                //btn update
                unset($_POST['btnupdate']);
                
                $old_image = $_POST['old_image'];
                
                $config = [
                    'upload_path' =>'./uploads/product/',
                    'allowed_types' => 'gif|jpg|jpeg|png|svg',
                    'file_name' => 'PRODUCT'.date('dmY').time().rand(10000,99999),
                ];

                // // start product_variation  -------
                // $product_variation = $this->input->post('product_variation');
                // foreach($product_variation as $variation) {

                //     $final_variation[] = filter_var($variation,FILTER_SANITIZE_STRING);

                // }
                // $Pvariation[] = $final_variation;
                // // end product_variation  -------
                

                // // start product_dprice  -------
                // $product_dprice = $this->input->post('product_dprice');
                // foreach($product_dprice as $dprice) {

                //     $final_dprice[] = filter_var($dprice,FILTER_SANITIZE_STRING);

                // }
                // $Pdprice[] = $final_dprice;
                // // end product_dprice  -------


                // // start product_mrp  -------
                //  $product_mrp = $this->input->post('product_mrp');
                //  foreach($product_mrp as $mrp) {
 
                //      $final_mrp[] = filter_var($mrp,FILTER_SANITIZE_STRING);
 
                //  }
                //  $Pmrp[] = $final_mrp;
                // // end product_mrp  -------
              
                $_POST['product_variation']=$this->input->post('product_variation');

                $_POST['product_dprice']=$this->input->post('product_dprice');

                $_POST['product_mrp']=$this->input->post('product_mrp');
        


                $this->load->library('upload',$config);
                
                if($this->upload->do_upload('product_image'))
                {
                   
                    unlink( FCPATH."uploads/product/".$old_image);

                //   echo;
                //   exit;
                    
                    $data =$this->upload->data();

                    // $image_path=base_url("upload/".$data['raw_name'].$data['file_ext']);

                    $new_photo =$data['file_name'];

                    // $_POST['product_img'] = $image;
                   
                    // $update = array();


                }else{

                    $new_photo = $old_image;

                }    
                
                unset($_POST['old_image']);
                $_POST['product_img'] =  $new_photo;

                	
                
                $isPut=$this->Product_m->put_product($id,$_POST);
                if($isPut){
                    $this->session->set_flashdata('success_msg', 'Product Updated successfully !');
                    redirect('product/product_manage');
                }

            }
        }
    }


    public function view_product($id){
        $data['result']= $result =$this->Product_m->get_single_product($id);

        $this->load->view('view_product',$data);  
    }




    //delete agent
	public function product_delete($id,$img_path) {

        unlink( FCPATH."uploads/product/".$img_path);

		$isDelete=$this->Product_m->delete_product($id);

		if($isDelete) {
			 $this->session->set_flashdata('success_msg', 'Product has been removed successfully !');
        }else{
            $this->session->set_flashdata('error_msg', 'Some problems occurred, please try again.');
        }

        redirect('product/product_manage');
        
	}
	
	
	//update multiple product category and subcatery
    public function update_cat_subcat()
    {
        if(isset($_POST['submit'])){

            $product_id = $_POST['check'];

            $arr = array(
                'product_cat' => $_POST['product_cat'],
                'product_subcat' => $_POST['product_subcat'],
            );

            $updated=$this->Product_m->update_cat_subcat_m($product_id,$arr);

            if($updated)
            {
                $this->session->set_flashdata('success_msg', 'Product Update Successfully !');
                redirect('product/product_manage'); 
            }

        }
        
        if(isset($_POST['p_status'])){

            $product_id = $_POST['check'];

            $arr = array(
                'product_status' => $_POST['product_status'],
            );

            $updated=$this->Product_m->update_cat_subcat_m($product_id,$arr);

            if($updated)
            {
                $this->session->set_flashdata('success_msg', 'Product Update Successfully !');
                redirect('product/product_manage'); 
            }

        }
    }
    

}
    ?>
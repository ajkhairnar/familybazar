<?php

error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');

class Sales extends CI_Controller {

    public function __construct(){

        parent::__construct();

        if(!$this->session->userdata('admin_login'))
	    {

            redirect('Login');
            
        }
        $this->load->model('Sales_m');
        

    
     }


     //sales list
     public function sales_list()
     {


        $data['agents'] = $this->Sales_m->get_agent_list(); 
       
        $data['sales'] = $this->Sales_m->get_sales();
        $this->load->view('sales_list',$data);

     }


     //sales filter
     public function sales_filter()
     {

        if(isset($_POST["username"])) {

            $username = $_POST['username'];
            $from_date = date_format($_POST['from_date'],"d-m-Y");
            $to_date =  date_format($_POST['to_date'],"d-m-Y");
           

            $query = "SELECT * FROM shop_sales WHERE sales_agentname = '".$username."'";

            $result = $this->Sales_m->sales_filter($query);

            $new_array=[];

            for($i=0; $i<count($result); $i++)
            {
                
                    $arr=json_encode($result[$i]->sales_date);
                    
                    $get=explode(" ",$arr);

                    

                    // date_format($date,"Y/m/d H:i:s")
                    // echo $arr[0][0];
                    if(strtotime($get[0]) >= strtotime($from_date) && strtotime($arr[0]) <= strtotime($to_date) ){
                        
                        array_push($new_array,$result[$i]);
                    }

            }

            $data = $new_array;


            echo json_encode($data);


        }
     }



     public function get_details($id)
     {
        $data['s_details'] = $this->Sales_m->get_single_sale($id);
        $this->load->view('sales_details',$data);
     }
     
     
     public function order_print()
    {
        if(isset($_POST['submit'])){
            
            if($_POST['sales_id'] != '')
            {
                $data['get_orders']=$this->Sales_m->multiple_orders_print($_POST['sales_id']);
                $this->load->view('sales_details_print',$data);
            }else{
                $this->session->set_flashdata('error_msg', 'Please Select order !');
                redirect('sales/sales_list'); 
            }
        }


    }
    
    
    
    // ----------------------------- new changes sales list 11-01-21 --------------------------------


    //new sales list
    public function sales_new_list() 
    {
        
      $qry = 'SELECT * from shop_sales';
       $one1 = $this->Sales_m->get_new_sales($qry);

       foreach($one1 as $value)
       {
           $qry1 = 'SELECT sales_id,SUM(p_dpcalc) AS offer_total,SUM(p_mrpcalc) AS total FROM shop_subsales WHERE sales_id = '.$value->sales_id.' GROUP BY sales_id';
           $data1[] = $this->Sales_m->get_new_sales($qry1);
       }
       

       foreach ($one1 as $element=>$value){
           
            $n[] = (object) array_merge((array)$one1[$element],(array)$data1[$element][0]);

        }

      $data['new_sales'] =$n;
     
       $this->load->view('sales_new_list',$data);

    }


    public function new_order_print()
    {
         $from = date("Y-m-d", strtotime($_POST['from']));
         $to = date("Y-m-d", strtotime($_POST['to']));
         
        // $qry = 'SELECT p_id,p_name,p_var,p_mrp,sales_date, SUM(p_qty) AS Totalquantity FROM shop_sales WHERE sales_date BETWEEN "'.$form.'" AND "'.$to.'"  GROUP BY  p_id ';
        
        
        
        $qry = 'SELECT p_name,p_var,p_mrp,SUM(p_qty) AS totalquantity,SUM(p_mrpcalc) AS total FROM shop_subsales WHERE sales_date BETWEEN "'.$from.'" AND "'.$to.'"  GROUP BY  p_id ';
        

        $data['order_list'] = $this->Sales_m->new_order_print_m($qry);
        $data['from'] = $from;
        $data['to'] = $to;
        $this->load->view('sales_details_new_print',$data);
        // echo "<pre>";
        // print_r($data['order_list'] );
        
    }

    public function new_order_view()
    {
        $sub_id = "2021131131";
        $qry = 'SELECT p_name,p_var,p_mrp,SUM(p_qty) AS totalquantity, SUM(p_mrpcalc) AS total FROM shop_sales WHERE sub_id = "'.$sub_id.'" GROUP BY  p_id ';
        $data['order_view'] = $this->Sales_m->new_order_view($qry);
        echo "<pre>";
    
        print_r($data['order_view']);
    }



    public function new_order_list()
    {
        if(isset($_POST['submit'])){
            
            if($_POST['sub_id'] != '')
            {
                $data['get_onebyone_orders']=$this->Sales_m->multiple_orders_print_onebyone($_POST['sub_id']);
                
                // echo "<pre>";
                // print_r( $data['get_onebyone_orders']);
                $this->load->view('sales_order_details_print',$data);
            }else{
                $this->session->set_flashdata('error_msg', 'Please Select order !');
                redirect('sales/sales_list'); 
            }
        }
        
        if(isset($_POST['print_summary'])){
            
            if($_POST['sub_id'] != '')
            {
                
               
                
                $arr = $_POST['sub_id'];
                
                $default = $arr;
                sort($arr);
                
                $flag = true;
                foreach($arr as $key=>$value)
                    if($value!=$default[$key])
                        $flag = false;  
                
                if($flag)
                   {
                    $first = reset($arr);
                    $last = end($arr);
                    $from = $first;
                    $to = $last;
                       
                   }
                else
                   {
                       $arr=array_reverse($_POST['sub_id']);
                        $first = reset($arr);
                        $last = end($arr);
                        $from = $first;
                        $to = $last;
                       
                   }
               
        $qry = 'SELECT p_name,p_var,p_mrp,SUM(p_qty) AS totalquantity,SUM(p_mrpcalc) AS total FROM shop_subsales WHERE sales_id BETWEEN "'.$from.'" AND "'.$to.'"  GROUP BY  p_id ';
        
        
        $data['order_list'] = $this->Sales_m->new_order_print_m($qry);
       
        $data['from'] = $from;
        $data['to'] = $to;
        
        $this->load->view('sales_check_summary',$data);
            
            } 
            
        }
        
        
        // ----- changes -------------------------------------
        
        if(isset($_POST['print_bill'])){
                
        $from = date("Y-m-d", strtotime($_POST['from']));
         $to = date("Y-m-d", strtotime($_POST['to']));
         
        $data['get_onebyone_orders']=$this->Sales_m->multipleordersprint($from,$to);
                
               
        
        $this->load->view('date_sales_print',$data);
        
            
        }

        // print_r($_POST['sub_id']);

    }
    
    public function new_order_view_details($id)
    {
        
        
        $data['sales']=$n=$this->Sales_m->new_order_view_details_m($id);
        
        $data['subsales'] = $this->Sales_m->new_order_get_subsales($n->sales_id);
        
        $this->load->view('particular_order_view',$data);
       
        
    }



    }
    
    

    ?>




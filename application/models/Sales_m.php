<?php

class Sales_m extends CI_model{

    public $table='shop_sales';

    //get sales
    public function get_sales() {

      return $this->db->get($this->table)->result();
      
    }

    //get agents
    public function get_agent_list() {

      return $this->db->get('shop_agent')->result();
    }

    //sales filter
    function sales_filter($query)
    {
        $query=$this->db->query($query);
        return $query->result();
       
    }


    function get_single_sale($id)
    {
		return $this->db->get_where($this->table, ['sales_id' => $id])->row();
    }
    
     //orders prints
	public function multiple_orders_print($sales_id) {
    
        for($i=0;$i<count($sales_id); $i++)
        {
         
            $g[] = $this->db->get_where($this->table, ['sales_id' => $sales_id[$i]])->row();
            
        }
      return $g;
     
 
  }
  
  // new sale changes--------

  //get new sales
  public function get_new_sales($query) {


    $query=$this->db->query($query);
    return $query->result();
    // return $this->db->get('shop_sales')->result();

    
  }

  function new_order_print_m($query)
  {
    $query=$this->db->query($query);
    return $query->result();
     
  }
  
  function new_order_view($query)
  {
    $query=$this->db->query($query);
    return $query->result();
     
  }

  public function multiple_orders_print_onebyone($sales_id) {
    
    for($i=0;$i<count($sales_id); $i++)
    {
        $g[]= $this->db->get_where('shop_subsales', ['sales_id' => $sales_id[$i]])->result();
        // $new[] = array_push($g,array("ss"=>"sdfds")) ;
    }


    foreach($g as $n)
    {
       
        $sales_id = $n[0]->sales_id;
        $new = $this->db->get_where($this->table, ['sales_id' => $sales_id])->row();
        $n[]=$new;
        $s = $n;
        $a[] = $s;
        // print_r(array($n,"sdfsd"));
    }

    return $a;
  }
  
  
  
   public function multipleordersprint($from,$to) {
        $new;
        $from1 = date('Y-m-d', strtotime($from));
        $to1 = date('Y-m-d', strtotime($to));
        
        $qry= "SELECT * FROM shop_sales WHERE sales_date >= '".$from1."' AND sales_date <= '".$to."'";
        $query=$this->db->query($qry);
        $g=$query->result();
        
        
        foreach($g as $s)
        {
             $sales_id = $s->sales_id;
            
             $new = $this->db->get_where('shop_subsales', ['sales_id' => $sales_id])->result();
          
            $new[] = $s;
            
            $myArray[] = $new;
        }
        
      
      return $myArray;
         
       
   }
  
//     public function multipleordersprint($from,$to) {
    
//     $g[] =  $this->db->select('*')
//             ->from('shop_subsales')
//             ->where('sales_date >=', date('Y-m-d', strtotime($from)))
//             ->where('sales_date <=', date('Y-m-d', strtotime($to)))
//             ->get()->result();
            
//     $n = $g;
    
//     for($i=0;$i<count($g[0]);$i++)
//     {
//         $sales_id = $g[0][$i]->sales_id;
//         $new = $this->db->get_where($this->table, ['sales_id' => $sales_id])->row();
//         $g[]=$new;
//         $s = $g;
//         $a[] = $s;
//     }
//     return $a;
//   }
  
  
  
  
  public function new_order_view_details_m($id)
  {
     $new = $this->db->get_where($this->table, ['sales_id' => $id])->row();
     return $new;
  }
  
  public function new_order_get_subsales($sales_id)
  {
     return $this->db->get_where('shop_subsales', ['sales_id' => $sales_id])->result(); 
  }



  }
  
  


  ?>
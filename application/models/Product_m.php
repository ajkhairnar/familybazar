<?php

class Product_m extends CI_model{

    public $table='shop_product';

    //get agent
	public function get_product() {
		return $this->db->get($this->table)->result();
    }
    
    
    public function get_result() {
		$this->db->select('product_id,product_img,product_company,product_name,product_cat,product_variation,product_dprice,product_mrp');
        return $this->db->get($this->table)->result();
    }
    
    
    // delete agent
	public function delete_product($id) {
		
        $this->db->where('product_id', $id)->delete($this->table);
        if($this->db->affected_rows() > 0)
        {
            return true;
        }else{
            return false;
        }
        
    }
    
    // post
	public function post_product($post) {
        // echo "<pre>";
        // print_r($post);
        $n = $post['new_variation_arr'];

        $keys = array_keys($n);

        foreach($n as $key => $value) {

            $array = array(
                "product_uniqid" => $post['product_uniqid'],
                "product_cat" => $post['product_cat'],
                "product_subcat" => $post['product_subcat'],
                "product_company" => $post['product_company'],
                "product_name" => $post['product_name'],
                "product_img" => $post['product_img'],
                "product_variation" => $value[0],
                "product_dprice" => $value[1],
                "product_mrp" => $value[2]
            );
           $this->db->insert($this->table,$array);  
     
           
        }



        return true;

       
    }
    
	//get single record
	public function get_single_product($id) {
		return $this->db->get_where($this->table, ['product_id' => $id])->row();
    }
    
    //put
	public function put_product($id,$data) {
		return $this->db->where('product_id', $id)->update($this->table, $data);
	}
	
	
	//update multiple category and product
	public function  update_cat_subcat_m($product_ids,$data)
    {
        for($i=0;$i<count($product_ids); $i++)
        {
            $this->db->where('product_id', $product_ids[$i])->update($this->table, $data);
        }

        return true;
    }
    
    
    
    
    function getallproducts($postData=null){

     $response = array();

     ## Read value
     $draw = $postData['draw'];
     $start = $postData['start'];
     $rowperpage = $postData['length']; // Rows display per page
     $columnIndex = $postData['order'][0]['column']; // Column index
     $columnName = $postData['columns'][$columnIndex]['data']; // Column name
     $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
     $searchValue = $postData['search']['value']; // Search value

     ## Search 
     $searchQuery = "";
     if($searchValue != ''){
        $searchQuery = " (product_name like '%".$searchValue."%' or product_company like '%".$searchValue."%' or product_cat like'%".$searchValue."%' or product_subcat like'%".$searchValue."%' ) ";
     }

     ## Total number of records without filtering
     $this->db->select('count(*) as allcount');
     $records = $this->db->get('shop_product')->result();
     $totalRecords = $records[0]->allcount;

     ## Total number of record with filtering
     $this->db->select('count(*) as allcount');
     if($searchQuery != '')
        $this->db->where($searchQuery);
     $records = $this->db->get('shop_product')->result();
     $totalRecordwithFilter = $records[0]->allcount;

     ## Fetch records
     $this->db->select('*');
     if($searchQuery != '')
        $this->db->where($searchQuery);
     $this->db->order_by($columnName, $columnSortOrder);
     $this->db->limit($rowperpage, $start);
     $records = $this->db->get('shop_product')->result();

     $data = array();

     foreach($records as $record ){

        $data[] = array( 
           "product_id"=>$record->product_id,
           "product_status"=>$record->product_status,
           "product_img"=>$record->product_img,
           "product_name"=>$record->product_name,
           "product_company"=>$record->product_company,
           "product_cat"=>$record->product_cat,
           "product_subcat"=>$record->product_subcat,
           "product_variation"=>$record->product_variation,
           "product_dprice"=>$record->product_dprice,
           "product_mrp"=>$record->product_mrp,
        ); 
     }

     ## Response
     $response = array(
        "draw" => intval($draw),
        "iTotalRecords" => $totalRecords,
        "iTotalDisplayRecords" => $totalRecordwithFilter,
        "aaData" => $data
     );

     return $response; 
   }
    

   

  

}


?>
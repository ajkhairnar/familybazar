<?php

class Category_m extends CI_model{

    public $table='shop_product_cat';

    //get agent
	public function get_category() {
		return $this->db->get($this->table)->result();
    }
    
    // delete agent
	public function delete_category($id) {
		
        $this->db->where('cat_id', $id)->delete($this->table);
        if($this->db->affected_rows() > 0)
        {
            return true;
        }else{
            return false;
        }
        
    }
    
    // post
	public function post_category($post) {

		return $this->db->insert($this->table,$post);  
    }
    

    
	//get single record
	public function get_single_category($id) {

		return $this->db->get_where($this->table, ['cat_id' => $id])->row();
		
    }
    
    //put
	public function put_category($id,$data) {

		return $this->db->where('cat_id', $id)->update($this->table, $data);
	}


    public function get_category1() {
		return $this->db->get($this->table)->result_array();
    }
   
   
    function getallcategory($postData=null){

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
        $searchQuery = " (cat_name like '%".$searchValue."%' or cat_img like'%".$searchValue."%') ";
     }

     ## Total number of records without filtering
     $this->db->select('count(*) as allcount');
     $records = $this->db->get('shop_product_cat')->result();
     $totalRecords = $records[0]->allcount;

     ## Total number of record with filtering
     $this->db->select('count(*) as allcount');
     if($searchQuery != '')
        $this->db->where($searchQuery);
     $records = $this->db->get('shop_product_cat')->result();
     $totalRecordwithFilter = $records[0]->allcount;

     ## Fetch records
     $this->db->select('*');
     if($searchQuery != '')
        $this->db->where($searchQuery);
     $this->db->order_by($columnName, $columnSortOrder);
     $this->db->limit($rowperpage, $start);
     $records = $this->db->get('shop_product_cat')->result();

     $data = array();

     foreach($records as $record ){

        $data[] = array( 
           "cat_id"=>$record->cat_id,
           "cat_name"=>$record->cat_name,
           "cat_img"=>$record->cat_img,
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
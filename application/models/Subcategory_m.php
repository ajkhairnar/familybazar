<?php

class Subcategory_m extends CI_model{

    public $table='shop_product_sub';

    //get agent
	public function get_subcategory() {
		return $this->db->get($this->table)->result();
    }
    
    // delete agent
	public function delete_subcategory($id) {
		
        $this->db->where('sub_cat_id', $id)->delete($this->table);
        if($this->db->affected_rows() > 0)
        {
            return true;
        }else{
            return false;
        } 
    }
    
    // post
	public function post_subcategory($post) {

		return $this->db->insert($this->table,$post);  
    }
    

    
	//get single record
	public function get_single_subcategory($id) {

		return $this->db->get_where($this->table, ['sub_cat_id' => $id])->row();
		
    }
    
    //put
	public function put_subcategory($id,$data) {

		return $this->db->where('sub_cat_id', $id)->update($this->table, $data);
    }
    
    //get
    public function get_subcategory1() {
		return $this->db->get($this->table)->result_array();
    }

 //update multiple category of Subcategory
	public function  update_cat_m($subcat_ids,$data)
  {
      for($i=0;$i<count($subcat_ids); $i++)
      {
          $this->db->where('sub_cat_id', $subcat_ids[$i])->update($this->table, $data);
      }

      return true;
  }
  
   function getallsubcategory($postData=null){

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
        $searchQuery = "(sub_cat_name like '%".$searchValue."%' or cat_name like'%".$searchValue."%') ";
     }

     ## Total number of records without filtering
     $this->db->select('count(*) as allcount');
     $records = $this->db->get('shop_product_sub')->result();
     $totalRecords = $records[0]->allcount;

     ## Total number of record with filtering
     $this->db->select('count(*) as allcount');
     if($searchQuery != '')
        $this->db->where($searchQuery);
     $records = $this->db->get('shop_product_sub')->result();
     $totalRecordwithFilter = $records[0]->allcount;

     ## Fetch records
     $this->db->select('*');
     if($searchQuery != '')
        $this->db->where($searchQuery);
     $this->db->order_by($columnName, $columnSortOrder);
     $this->db->limit($rowperpage, $start);
     $records = $this->db->get('shop_product_sub')->result();

     $data = array();

     foreach($records as $record ){

        $data[] = array( 
           "sub_cat_id"=>$record->sub_cat_id,
           "sub_cat_name"=>$record->sub_cat_name,
           "cat_name"=>$record->cat_name,
           "sub_cat_img"=>$record->sub_cat_img,
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
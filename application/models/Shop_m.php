<?php

class Shop_m extends CI_model{

    public $table='shop_list';

    //get agent
	public function get_shop() {
		return $this->db->get($this->table)->result();
    }
    
    // delete agent
	public function delete_shop($id) {
		
        $this->db->where('shop_id', $id)->delete($this->table);
        if($this->db->affected_rows() > 0)
        {
            return true;
        }else{
            return false;
        }
        
    }
    
    // post
	public function post_shop($post) {
		return $this->db->insert($this->table,$post);  
    }
    
	//get single record
	public function get_single_shop($id) {
		return $this->db->get_where($this->table, ['shop_id' => $id])->row();
    }
    
    //put
	public function put_shop($id,$data) {
		return $this->db->where('shop_id', $id)->update($this->table, $data);
	}


    //get state
    public function get_statelist()
    {
        return $this->db->get('shop_statelist')->result_array();
    }
    
    
    
    public function getallshop($postData=null){

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
        $searchQuery = "(shop_owner like '%".$searchValue."%' or shop_phone like'%".$searchValue."%' or shop_landmarkarea like'%".$searchValue."%' or shop_city like'%".$searchValue."%') ";
     }

     ## Total number of records without filtering
     $this->db->select('count(*) as allcount');
     $records = $this->db->get('shop_list')->result();
     $totalRecords = $records[0]->allcount;

     ## Total number of record with filtering
     $this->db->select('count(*) as allcount');
     if($searchQuery != '')
        $this->db->where($searchQuery);
     $records = $this->db->get('shop_list')->result();
     $totalRecordwithFilter = $records[0]->allcount;

     ## Fetch records
     $this->db->select('*');
     if($searchQuery != '')
        $this->db->where($searchQuery);
     $this->db->order_by($columnName, $columnSortOrder);
     $this->db->limit($rowperpage, $start);
     $records = $this->db->get('shop_list')->result();

     $data = array();

     foreach($records as $record ){

        $data[] = array( 
           "shop_id"=>$record->shop_id,
           "shop_owner"=>$record->shop_owner,
           "shop_phone"=>$record->shop_phone,
           "shop_landmarkarea"=>$record->shop_landmarkarea,
           "shop_city"=>$record->shop_city,
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
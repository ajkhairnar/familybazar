<?php

class Agent_m extends CI_model{

    public $table='shop_agent';
    public $pending = 'inactive';
    public $approved = 'active';


    //get agent
	public function get_agent() {

        $this->db->where('agent_active', $this->approved);
		return $this->db->get($this->table)->result();
    }
    
    
    // delete agent
	public function delete_agent($id) {
		
        $this->db->where('agent_id', $id)->delete($this->table);
        if($this->db->affected_rows() > 0)
        {
            return true;
        }else{
            return false;
        }
        
    }
    
    // post
	public function post_agent($post) {
    
		return $this->db->insert($this->table,$post);  
    }
    

    
	//get single record
	public function get_single_agent($id) {

		return $this->db->get_where($this->table, ['agent_id' => $id])->row();
		
    }
    
    //put
	public function put_agent($id,$data) {

		return $this->db->where('agent_id', $id)->update($this->table, $data);
	}

   
    
    //get pending agent list 
	public function get_pending_agent() {

        $this->db->where('agent_active', $this->pending);
		return $this->db->get($this->table)->result();
    }

    //get single pending agent list
    public function get_single_pending_agent($id)
    {
        return $this->db->get_where($this->table, ['agent_id' => $id])->row();
    }



    //agent_approved
    public function post_agent_approved($id,$data)
    {
        return $this->db->where('agent_id', $id)->update($this->table, $data);
    }
    
    
    public function getallagent($postData=null){

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
        $searchQuery = "(agent_username like '%".$searchValue."%' or agent_fullname like'%".$searchValue."%' or agent_email like'%".$searchValue."%' or agent_phone like'%".$searchValue."%' or agent_landmarkarea like'%".$searchValue."%') ";
     }

     ## Total number of records without filtering
     $this->db->select('count(*) as allcount');
     $records = $this->db->get('shop_agent')->result();
     $totalRecords = $records[0]->allcount;

     ## Total number of record with filtering
     $this->db->select('count(*) as allcount');
     if($searchQuery != '')
        $this->db->where($searchQuery);
     $records = $this->db->get('shop_agent')->result();
     $totalRecordwithFilter = $records[0]->allcount;

     ## Fetch records
     $this->db->select('*');
     if($searchQuery != '')
     $this->db->where($searchQuery);
     $this->db->where('agent_active', $this->approved);
     $this->db->order_by($columnName, $columnSortOrder);
     $this->db->limit($rowperpage, $start);
     $records = $this->db->get('shop_agent')->result();

     $data = array();

     foreach($records as $record ){

        $data[] = array( 
           "agent_id"=>$record->agent_id,
           "agent_username"=>$record->agent_username,
           "agent_fullname"=>$record->agent_fullname,
           "agent_email"=>$record->agent_email,
           "agent_phone"=>$record->agent_phone,
           "agent_landmarkarea"=>$record->agent_landmarkarea,
           "agent_status"=>$record->agent_status,
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
   
   
   
   public function getallpendingagent($postData=null){

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
        $searchQuery = "(agent_username like '%".$searchValue."%' or agent_fullname like'%".$searchValue."%' or agent_email like'%".$searchValue."%' or agent_phone like'%".$searchValue."%' or agent_status like'%".$searchValue."%') ";
     }

     ## Total number of records without filtering
     $this->db->select('count(*) as allcount');
     $records = $this->db->get('shop_agent')->result();
     $totalRecords = $records[0]->allcount;

     ## Total number of record with filtering
     $this->db->select('count(*) as allcount');
     if($searchQuery != '')
        $this->db->where($searchQuery);
     $records = $this->db->get('shop_agent')->result();
     $totalRecordwithFilter = $records[0]->allcount;

     ## Fetch records
     $this->db->select('*');
     if($searchQuery != '')
     $this->db->where($searchQuery);
       $this->db->where('agent_active', $this->pending);
     $this->db->order_by($columnName, $columnSortOrder);
     $this->db->limit($rowperpage, $start);
     $records = $this->db->get('shop_agent')->result();

     $data = array();

     foreach($records as $record ){

        $data[] = array( 
           "agent_id"=>$record->agent_id,
           "agent_username"=>$record->agent_username,
           "agent_fullname"=>$record->agent_fullname,
           "agent_email"=>$record->agent_email,
           "agent_phone"=>$record->agent_phone,
           "agent_status"=>$record->agent_status,
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
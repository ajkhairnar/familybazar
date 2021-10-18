<?php

class Landmark_m extends CI_model{

    public $table='shop_landmark';
    

    //get agent
	public function get_landmark() {

		return $this->db->get($this->table)->result();
    }
    
    // // delete agent
	public function delete_landmark($id) {
		
        $this->db->where('landmark_id', $id)->delete($this->table);
        if($this->db->affected_rows() > 0)
        {
            return true;
        }else{
            return false;
        }
        
    }
    
    // post
	public function post_landmark($post) {

		return $this->db->insert($this->table,$post);  
    }
    

	//get single record
    public function get_single_landmark($id)
    {
        return $this->db->get_where($this->table, ['landmark_id' => $id])->row();
    }


	// //get single record
	// public function get_single_agent($id) {

	// 	return $this->db->get_where($this->table, ['agent_id' => $id])->row();
		
    // }
    
    //put
	public function put_landmark($id,$data) {

		return $this->db->where('landmark_id', $id)->update($this->table, $data);
	}

   
    public function get_landmark1() {
		return $this->db->get($this->table)->result_array();
    }

}


?>
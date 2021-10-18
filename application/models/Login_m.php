<?php

class Login_m extends CI_model{

    function user_login($admin_username,$admin_pass)
    {
 
        $this->db->where('admin_username', $admin_username);
        $this->db->where('admin_pass',$admin_pass);

        $query = $this->db->get('shop_admin');

        if($query->num_rows() == 1) {
            return $query->row();
        }

        return false;
       
    }

    function user_reg($data)
    {
        $this->db->insert('user', $data);
        if ($this->db->affected_rows() == '1')
        {
           return true;
        }
        return false;
    }
    
    function get_userdata($id)
    {
       
        $this->db->where('id',$id);

        $query = $this->db->get('shop_admin');

        if($query->num_rows() == 1) {
            return $query->row();
        }

        return false;
    }
    
    function profile_update_m($data,$id){
        	
		return $this->db->where('id', $id)->update('shop_admin', $data);
	

    }

  

}


?>
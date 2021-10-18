class View_data extends CI_Model
{

    function getServiceCount($s_name)
	{
		return $this->db->select('COUNT(*) as serCount')
                    ->from('orders')
					//->where('service', $s_name)					
                    ->get()->row();
					
	}
	
		function getSerDesc($cityName)
	{
		return $this->db->select('cityname, service, problem, pincode, datetime')
                    ->from('orders')
					->where('cityname', $cityName)
					->order_by('id', 'DESC')
					->limit('10')
                    ->get()->result();
	}
	
		public function select_order_total($where_id, $id, $table)
	{
		$this->db->where($where_id, $id);
		$this->db->where('o_status', '1');
		$query = $this->db->get($table);
		return $query->num_rows();
	}
}
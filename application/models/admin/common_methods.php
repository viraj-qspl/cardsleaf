<?php 
if (! defined('BASEPATH')) exit('No direct script access');

class Common_methods extends CI_Model {

	//php 5 constructor
	function __construct() {
		parent::__construct();
	}
	
	
	function countrylist()
	{
		$this->db->select('*');
		$this->db->from('country');
		$this->db->order_by("country_name", "ASC");

		$query = $this->db->get();
		//echo $this->db->last_query();
		
		$data = $query->result_array();
		$count = $query->num_rows();
		
		if($count>0)
			return $data;
		else
			return 0;
	}
}
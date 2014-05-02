<?php
if (! defined('BASEPATH')) exit('No direct script access');

class Membershipmodel extends CI_Model 
{
	function __construct()
	{
        parent::__construct();
		$this->load->database();
	}
	
	function addmembershipplan()
	{
		$data = array(
			'name' => $this->input->post('membership_name'),
			'amt' => $this->input->post('amount'),
			'expduration' => $this->input->post('exp_time'),
			'lifetime' => $this->input->post('life_time'),
			'shrt_des' => $this->input->post('shrtdes'),
			'best_plan' => $this->input->post('bestplan'),
			'recur' => $this->input->post('recurring'),
			'post_date' => date("Y-m-d H:i:s")
		);
		
		$this->db->insert('membership', $data);
		//echo $this->db->last_query();//exit;
		$this->db->insert_id();
	}
	
	function listmembershipplan()
	{
		$this->db->select('*');
		$this->db->from('membership');
		$query = $this->db->get();
		//echo $this->db->last_query();//exit;
		$data = $query->result_array();
		$count = $query->num_rows();
			$query->free_result();
			
		return ($count>0) ? $data : 0;
	}
	
	function getMembershipPlanById($mpid)
	{
		$this->db->select('*');
		$this->db->from('membership');
		$this->db->where('mpid',$mpid);

		$query = $this->db->get();
		
		//echo $this->db->last_query();exit;
		$data = $query->row_array();
		$count = $query->num_rows();
			$query->free_result();
			
		return ($count>0) ? $data : 0;
	}
	
	function deleteMembershipPlan($mpid)
	{
		$this->db->delete('membership', array('mpid' => $mpid)); 
	}
	
	function editmembershipplan($mpid)
	{
		$data = array(
			'name' => $this->input->post('membership_name'),
			'amt' => $this->input->post('amount'),
			'expduration' => $this->input->post('exp_time'),
			'lifetime' => $this->input->post('life_time'),
			'shrt_des' => $this->input->post('shrtdes'),
			'best_plan' => $this->input->post('bestplan'),
			'recur' => $this->input->post('recurring'),
			'post_date' => date("Y-m-d H:i:s")
		);
		
		$this->db->where('mpid', $mpid);
		$this->db->update('membership', $data);
		
	}
	
	
	
	
}
?>
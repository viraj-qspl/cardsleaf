<?php
if (! defined('BASEPATH')) exit('No direct script access');

class MState extends CI_Model 
{
	function __construct()
	{
        parent::__construct();
		$this->load->database();
	}
	
	function addState()
	{
		$data = array(
				'country_id' => mysql_escape_string($this->input->post('country_id')),
				'name' => mysql_escape_string($this->input->post('name')),
		); 
		
		$this->db->insert('state', $data);
		$state_id = $this->db->insert_id();
		return $state_id;
	}
	
	function getStateByCountry($country_id)
	{
		$query = $this->db->get_where('state', array('country_id' => $country_id ));
		$data = $query->result_array();
		//echo $this->db->last_query();
		//exit;
		for($i=0; $i<count($data); $i++)
		{
			$count = $this->getCityCount($data[$i]["id"]);
			$data[$i]["country_name"] = $this->getCountryNameById($data[$i]["country_id"]);
			$data[$i]["city_count"] = $count;
		}
		
		$count = $query->num_rows();
		
		if($count>0)
		return $data;
	}
	
	function getAllState()
	{
		$query = $this->db->get('state');
		$data = $query->result_array();
		
		for($i=0; $i<count($data); $i++)
		{
			$count = $this->getCityCount($data[$i]["id"]);
			$data[$i]["country_name"] = $this->getCountryNameById($data[$i]["country_id"]);
			
			$data[$i]["city_count"] = $count;
		}
		
		
		$count = $query->num_rows();
		
		if($count>0)
		return $data;
	}
	
	function getCountryNameById($country_id)
	{
		$query = $this->db->get_where('country', array('id' => $country_id ));
		$data = $query->row_array();
		return $data["name"];
	}
	
	function getCityCount($state_id)
	{
		$query = $this->db->get_where('city', array('state_id' => $state_id ));
		$count = $query->num_rows();
		return $count;
	}
	
	function getCityByState($state_id)
	{
		$query = $this->db->get_where('city', array('state_id' => $state_id ));
		$data = $query->result_array();
		//echo $this->db->last_query();
		//exit;
		for($i=0; $i<count($data); $i++)
		{
			$count = $this->getCityCount($data[$i]["id"]);
			$data[$i]["state_name"] = $this->getCountryNameById($data[$i]["state_id"]);
			$data[$i]["city_count"] = $count;
		}
		
		$count = $query->num_rows();
		
		if($count>0)
		return $data;
	}
	
	function editState($id)
	{
		$data = array(
			'name' => mysql_escape_string($this->input->post('name')),
			'country_id' => mysql_escape_string($this->input->post('country_id'))
		); 
				
		$this->db->where('id', $id);
		$this->db->update('state', $data); 
	}
	
	function getStateById($id)
	{
		$query = $this->db->get_where('state', array('id' => $id));
		$data = $query->row_array();
		return $data;
	}
	
	function trashState($id)
	{	
		$this->db->where('state_id', $id);
		$this->db->delete('city'); 
					
		$this->db->where('id', $id);
		$this->db->delete('state'); 
	}
}
?>
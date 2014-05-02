<?php
if (! defined('BASEPATH')) exit('No direct script access');

class MCity extends CI_Model 
{
	function __construct()
	{
        parent::__construct();
		$this->load->database();
	}
	
	function addCity()
	{
		$data = array(
				'country_id' => mysql_escape_string($this->input->post('country_id')),
				'state_id' => mysql_escape_string($this->input->post('state_id')),
				'name' => mysql_escape_string($this->input->post('name')),
		); 
		
		$this->db->insert('city', $data);
		$city_id = $this->db->insert_id();
		return $city_id;
	}	
	
	function getCityByState($state_id)
	{
		$query = $this->db->get_where('city', array('state_id' => $state_id ));
		$data = $query->result_array();
		
		for($i=0; $i<count($data); $i++)
		{
			$country_name = $this->getCountryNameById($data[$i]["country_id"]);
			$state_name = $this->getStateNameById($data[$i]["state_id"]);
			
			
			$data[$i]["country_name"] = $country_name;
			$data[$i]["state_name"] = $state_name;
		}

		$count = $query->num_rows();
		
		if($count>0)
		return $data;
	}	
	
	function getAllCity()
	{
		$query = $this->db->get('city');
		$data = $query->result_array();
		
		
		for($i=0; $i<count($data); $i++)
		{
			$country_name = $this->getCountryNameById($data[$i]["country_id"]);
			$state_name = $this->getStateNameById($data[$i]["state_id"]);
			
			
			$data[$i]["country_name"] = $country_name;
			$data[$i]["state_name"] = $state_name;
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
	
	function getStateNameById($state_id)
	{
		$query = $this->db->get_where('state', array('id' => $state_id ));
		$data = $query->row_array();
		return $data["name"];
	}
	
	function editCity($id)
	{
		$data = array(
			'name' => mysql_escape_string($this->input->post('name')),
			'country_id' => mysql_escape_string($this->input->post('country_id')),
			'state_id' => mysql_escape_string($this->input->post('state_id'))
		); 
				
		$this->db->where('id', $id);
		$this->db->update('city', $data); 
	}
	
	function getCityById($id)
	{
		$query = $this->db->get_where('city', array('id' => $id));
		$data = $query->row_array();
		return $data;
	}
	
	function trashCity($id)
	{					
		$this->db->where('id', $id);
		$this->db->delete('city'); 
	}

}
?>
<?php
if (! defined('BASEPATH')) exit('No direct script access');

class MCountry extends CI_Model 
{
	function __construct()
	{
        parent::__construct();
		$this->load->database();
	}
	
	function addCountry()
	{
		$data = array(
			'name' => mysql_escape_string($this->input->post('name')),
		); 
		
		$this->db->insert('country', $data);
		$country_id = $this->db->insert_id();
		return $country_id;
	}
	
	function editCountry($id)
	{
		$data = array(
			'name' => mysql_escape_string($this->input->post('name'))			
		); 
				
		$this->db->where('id', $id);
		$this->db->update('country', $data); 
	}
	
	function getCountry()
	{
		$this->db->select('C.*');
		$this->db->from('country as C');
		$this->db->order_by('C.country_name','asc');
		
		$query = $this->db->get();
		
		//echo $this->db->last_query();	
		
		$data = $query->result_array();
		$count = $query->num_rows();
		if($count>0) return $data; else	return 0;
	}
	
	function getCountryPage_count()
	{
		$this->db->select('count(C.country_id) as countrycount');
		$this->db->from('country as C');
		$query = $this->db->get();
		//echo $this->db->last_query();exit;
		$data = $query->row_array();
		
		return $data['countrycount']; 
	}
	
	function getCountryPage($limit,$start)
	{
		$this->db->select('C.*');
		$this->db->from('country as C');
		$this->db->order_by('C.country_name','asc');
		$this->db->limit($limit, $start);
		$query = $this->db->get();
		//echo $this->db->last_query();	
		
		$data = $query->result_array();
		$count = $query->num_rows();
		if($count>0) return $data; else return 0;
	}
	
	function getAllCountry()
	{
		$query = $this->db->get('country');
		$data = $query->result_array();
		
		for($i=0; $i<count($data); $i++)
		{
			$count = $this->getStateCount($data[$i]["id"]);
			$data[$i]["state_count"] = $count;
		}
		
		//echo '<pre>'.print_r($data,true).'</pre>';
		//exit;
		$count = $query->num_rows();
		
		if($count>0)
		return $data;
	}
	
	function getStateCount($country_id)
	{
		$query = $this->db->get_where('state', array('country_id' => $country_id ));
		$count = $query->num_rows();
		return $count;
	}
        function getStateInd($country_id)
	{
		$query = $this->db->get_where('state', array('country_id' => $country_id ));
		$data = $query->result_array();
		return $data;
	}
	
	function getCountryById($id)
	{
		$query = $this->db->get_where('country', array('id' => $id));
		$data = $query->row_array();
		return $data;
	}	
	function countryList()
	{
		$query = $this->db->get_where('country');
		$data = $query->result_array();
		return $data;
	}	
	
	function trashCountry($id)
	{
		$this->db->where('country_id', $id);
		$this->db->delete('city');  
		
		$this->db->where('country_id', $id);
		$this->db->delete('state');  
						
		$this->db->where('id', $id);
		$this->db->delete('country'); 
	}
	
	function getProvincePage_count($country_id)
	{
		$this->db->select('count(P.province_id) as procount');
		$this->db->from('province as P');
		$this->db->where('P.country_id', $country_id);
		$query = $this->db->get();
		//echo $this->db->last_query();exit;
		$data = $query->row_array();
		
		return $data['procount'];
	}
	
	function getProvincePage($limit,$start,$country_id)
	{
		$this->db->select('P.*');
		$this->db->from('province as P');
		$this->db->where('P.country_id', $country_id);
		$this->db->order_by('P.province','asc');
		$this->db->limit($limit, $start);
		$query = $this->db->get();
		//echo $this->db->last_query();	
		
		$data = $query->result_array();
		$count = $query->num_rows();
		if($count>0) return $data; else return 0;
	}
	
	function getprovinceBycountry($country='')
	{
		if($country!=''){
		$query = $this->db->get_where('state', array('country_id' => $country));

			if($query->num_rows()>0) {
				$data = $query->result_array();
				return $data;
			}
		}
		else return 0;
	}
	
	function addprovince($country_id,$province)
	{
		$data = array(
			'country_id' => $country_id,
			'province' => $province
		); 
		$addprostat = $this->db->insert('province', $data);
		
		return $addprostat;
	}
	
	function getProvinceById($country_id,$province_id)
	{
		$this->db->select('*');
		$this->db->from('province');
		$this->db->where('country_id',$country_id);
		$this->db->where('province_id',$province_id);
		
		$query = $this->db->get();
		//echo $this->db->last_query();	
		
		$data = $query->row_array();
		$count = $query->num_rows();
		if($count>0) return $data; else return 0;
	}
	
	function editprovince($province,$province_id)
	{
		$data = array(
			'province' => $province
		);
		$this->db->where('province_id', $province_id);
		$editprostat = $this->db->update('province', $data);
		
		return $editprostat;
	}
	
	function deleteProvince($province_id)
	{
		$this->db->where('province_id', $province_id);
		$deleteprostat = $this->db->delete('province');
		
		return $deleteprostat;
	}
	
	function getCityPage_count($country_id,$province_id)
	{
		$this->db->select('count(C.city_id) as citycount');
		$this->db->from('city as C');
		$this->db->where('C.country_id', $country_id);
		$this->db->where('C.province_id', $province_id);
		$this->db->order_by('C.city','asc');
		$query = $this->db->get();
		//echo $this->db->last_query();exit;
		$data = $query->row_array();
		
		return $data['citycount'];
		
	}
	
	function getCityPage($limit,$start,$country_id,$province_id)
	{
		$this->db->select('C.*');
		$this->db->from('city as C');
		$this->db->where('C.country_id', $country_id);
		$this->db->where('C.province_id', $province_id);
		$this->db->order_by('C.city','asc');
		$this->db->limit($limit, $start);
		$query = $this->db->get();
		//echo $this->db->last_query();	
		
		$data = $query->result_array();
		$count = $query->num_rows();
		if($count>0) return $data; else return 0;
	}
	function addCity($country_id,$province_id,$city)
	{
		$data = array(
			'country_id' => $country_id,
			'province_id' => $province_id,
			'city' => $city
		); 
		$addprostat = $this->db->insert('city', $data);
		
		return $addprostat;
	}
	function getCityById($country_id,$province_id,$city_id)
	{
			$this->db->select('*');
			$this->db->from('city');
			$this->db->where('country_id',$country_id);
			$this->db->where('province_id',$province_id);
			$this->db->where('city_id',$city_id); 
			$query = $this->db->get();
			//echo $this->db->last_query(); exit;
			
			$count = $query->num_rows();
			
			if($count>0) 
			{
				$data = $query->row_array();
				return $data;
			}
			else 
				return 0;
		
	}
	function editCity($city,$city_id)
	{
		$data = array(
			'city' => $city
		);
		$this->db->where('city_id', $city_id);
		$editcitystat = $this->db->update('city', $data);
		//echo $this->db->last_query(); exit;
		return $editcitystat;
	}
	
	function getCityByprovience($country_id='',$provience='')
	{
		if($country_id!='' && $provience!='')
		{
			$this->db->select('*');
			$this->db->from('city');
			$this->db->where('country_id',$country_id);
			$this->db->where('province_id',$provience);
			$this->db->order_by("city", "asc"); 
			$query = $this->db->get();
			$count = $query->num_rows();
			//echo $this->db->last_query(); exit;
						
			if($count>0) {
			$data = $query->result_array();
			 return $data; 
			}
		}
		else 
		    return 0;
	}
	
	function deleteCity($city_id,$country_id,$province_id)
	{
		$this->db->where('country_id', $country_id);
		$this->db->where('province_id', $province_id);
		$this->db->where('city_id', $city_id);
		$deletecitystat = $this->db->delete('city');
		//echo $this->db->last_query(); exit;
		return $deletecitystat;
	}
	
	function getSchoolPage_count($country_id,$province_id,$city_id)
	{
		$this->db->select('count(sc.school_id) as schoolcount');
		$this->db->from('school_creation as sc');
		$this->db->where('sc.country_id', $country_id);
		$this->db->where('sc.province', $province_id);
		$this->db->where('sc.city', $city_id);
		$this->db->order_by('sc.school_id','asc');
		$query = $this->db->get();
		//echo $this->db->last_query();exit;
		$data = $query->row_array();
		
		return $data['schoolcount'];
		
	}
	function getSchoolPage($limit,$start,$country_id,$province_id,$city_id)
	{
			$this->db->select('sc.*');
			$this->db->from('school_creation as sc');
			$this->db->where('sc.country_id',$country_id);
			$this->db->where('sc.province',$province_id);
			$this->db->where('sc.city',$city_id);
			$this->db->order_by('sc.city','asc');
			
			$this->db->limit($limit, $start);
			$query = $this->db->get();
			//echo $this->db->last_query();	
			$data = $query->result_array();
			$count = $query->num_rows();
					 $query->free_result();
			
			if($count>0) return $data; else return 0;

	}
	
	function getSchoolByCity($country_id='',$provience='',$city='')
	{
		if($country_id!='' && $provience!='' && $city!='')
		{
			$this->db->select('*');
			$this->db->from('school_creation');
			$this->db->where('country_id',$country_id);
			$this->db->where('province',$provience);
			$this->db->where('city',$city);
			$query = $this->db->get();
			$count = $query->num_rows();
			//echo $this->db->last_query(); exit;
						
			if($count>0) {
			$data = $query->result_array();
			 return $data; 
			}
		}
		else 
		    return 0;

	}
	
	function getprovince($province='')
	{
		/*if($this->input->post('countryid'))
		$query = $this->db->get_where('province', array('country_id' => $this->input->post('countryid') ));*/
		
		if($province!=''){
		$query = $this->db->get_where('province', array('province_id' => $province));

			if($query->num_rows()>0) {
				$data = $query->result_array();
				return $data;
			}
		}
		else return 0;
	}
	
	
	function getAllProvince()
	{
		$query = $this->db->get('province');

			if($query->num_rows()>0) {
				$data = $query->result_array();
				return $data;
				}
	}
	
	function getcity($city='')
	{
		/*if($this->input->post('countryid'))
		$query = $this->db->get_where('province', array('country_id' => $this->input->post('countryid') ));*/
		
		if($city!=''){
		$query = $this->db->get_where('city', array('city_id' => $city));

			if($query->num_rows()>0) {
				$data = $query->result_array();
				return $data;
			}
		}
		else return 0;
	}
	
	function getSchoolType()
	{
		$this->db->distinct();
		$this->db->select('sc.Phase_DoE');
		$this->db->from('school_creation as sc');
		$this->db->order_by('sc.Phase_DoE','asc');
		$query = $this->db->get();
		$count = $query->num_rows();
		//echo $this->db->last_query(); exit;
		$data = $query->result_array();
					$query->free_result();
		if($count>0) return $data; else return 0;
	}
}
?>
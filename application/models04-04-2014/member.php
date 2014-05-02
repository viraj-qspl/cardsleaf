<?php
if (! defined('BASEPATH')) exit('No direct script access');

class Member extends CI_Model 
{
	function __construct()
	{
        parent::__construct();
		$this->load->database();
	}
	
	function checkAdminExist($username, $password)
	{		
		$query = $this->db->get_where('admin', array('username' => mysql_escape_string($username), 'password' => mysql_escape_string(md5($password))));
		
		$data = $query->row_array();
		$count = $query->num_rows();
		
		if($count>0)
			return $data;
		else
			return false;
	}
	
	function editUser($user_id)
	{
		$birthday = $this->input->post('u_b_yr')."-".$this->input->post('u_b_mon')."-".$this->input->post('u_b_day');	
		$data = array(
			'fname' => $this->input->post('fname'),
			'lname' => $this->input->post('lname'),
			'username' => addslashes($this->input->post('username')),
			'birthday' => $birthday,
			'height_cm' => $this->input->post('height_cm'),
			'sex' => $this->input->post('sex'),
			'seeking' => $this->input->post('seeking'),
			'prev_marriage' => $this->input->post('prev_marriage'),
			'children' => $this->input->post('children'),
			'ethnicity' => $this->input->post('ethnicity'),
			'education' => $this->input->post('education'),
			'religion' => $this->input->post('religion'),
			'smoking' => $this->input->post('smoking'),
			'drinking' => $this->input->post('drinking'),
			'body_type' => $this->input->post('body_type')
		); 

		
		$this->db->where('user_id', $user_id);
		$this->db->update('user', $data);
	}
	function editUserLocation($user_id)
	{
		$data = array(
			'country_id' => $this->input->post('country_id'),
			'state_id' => $this->input->post('state_id'),
			'city' => addslashes($this->input->post('city')),
			'address' => addslashes($this->input->post('address')),
			'zip' => $this->input->post('zip')
		); 

		
		$this->db->where('user_id', $user_id);
		$this->db->update('user', $data);
	}
	
	function editUserAbout($user_id)
	{
		$data = array(
			'your_story' => $this->input->post('your_story'),
			'perfect_match' => addslashes($this->input->post('perfect_match')),
			'ideal_first_date' => addslashes($this->input->post('ideal_first_date'))
		); 

		
		$this->db->where('user_id', $user_id);
		$this->db->update('user', $data);
	}
	
	function checkPrimary($user_id)
	{
		$query = $this->db->get_where('user_images', array('user_id' => $user_id ));
		$data = $query->row_array();
		$count = $query->num_rows();
		if($count>0)
			return 0;
		else
			return 1;
	}
	
	function addUserImage($user_id,$image_name,$primary)
	{
		$data = array(
			'user_id' => $user_id,
			'image_name' => $image_name,
			'primary' => $primary
		); 
				
		$this->db->insert('user_images', $data);
	}
	
	function makePrimary($user_image_id)
	{
		$data = array(
			'primary' => 1
		); 
		
		$this->db->where('user_image_id', $user_image_id);
		$this->db->update('user_images', $data); 
	}
	
	function makeSecondary($user_id)
	{
		$data = array(
			'primary' => '0'
		); 
		
		$this->db->where('user_id', $user_id);
		$this->db->update('user_images', $data); 
	}
	
	function getUserImgByImgid($user_image_id)
	{
		$query = $this->db->get_where('user_images', array('user_image_id' => $user_image_id ));
		$data = $query->row_array();
		$count = $query->num_rows();
		if($count>0)
			return $data;
		else
			return 0;
	}
	
	function deletePhoto($user_image_id)
	{
		$this->db->where('user_image_id', $user_image_id);
		$this->db->delete('user_images');
	}
	
	function editNextprimary($user_id)
	{
		$this->db->select('user_image_id as id');    
		$this->db->from('user_images');
		$this->db->where('user_id', $user_id);
		$this->db->order_by('user_image_id','asc');
		$this->db->limit(1);
		
		$query = $this->db->get();
		//echo $this->db->last_query();
		$data = $query->row_array();
		$count = $query->num_rows();
		
		//print_r( $data);
		
		if($count)
		{
			$dataarr = array(
				'primary' => 1
			); 
			
			$this->db->where('user_image_id',$data['id']);
			$this->db->update('user_images', $dataarr); 
		}
		
	}
	
}

?>
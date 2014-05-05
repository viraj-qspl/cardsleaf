<?php
if (! defined('BASEPATH')) exit('No direct script access');

class Membermodel extends CI_Model 
{
	function __construct()
	{
        parent::__construct();
		$this->load->database();
	}
	
	
	function allmemberinfo_count()
	{
		//$searchfield = $this->input->post('searchfield');
		
		$this->db->select('u.*, c.country_name, s.name as state_name, i.img_id, i.dispatch_to, i.image0, i.delivery_dt, i.post_date as order_dt, 1 as pic_type');
		$this->db->from('img as i');
		$this->db->join('user as u','i.user_id = u.user_id','left');
		$this->db->join('country as c','c.country_id = u.country_id', 'left');
		$this->db->join('state as s','s.state_id = u.state_id AND s.country_id = u.country_id', 'left');
		$this->db->where('i.active_status', 1);
		$this->db->where('i.dispatch', 0);
		//$this->db->order_by("i.delivery_dt,i.img_id");
		$query1 = $this->db->_compile_select();
		$this->db->_reset_select();

		
		$this->db->select('u.*,c.country_name, s.name as state_name, pic.pic_id as img_ig, pic.dispatch_to, pic.dispatch_to as image0, pic.delivery_dt, pic.post_date as order_dt, 0 as pic_type');
		$this->db->from('pic');
		$this->db->join('picimg','pic.pic_id = picimg.pic_id');	
		$this->db->join('user as u','pic.user_id = u.user_id','left');
		$this->db->join('country as c','c.country_id = u.country_id', 'left');
		$this->db->join('state as s','s.state_id = u.state_id AND s.country_id = u.country_id', 'left');
		$this->db->where('pic.active_status', 1);		
		$this->db->where('pic.dispatch',0);			
		$this->db->order_by("delivery_dt");
		$query2 = $this->db->_compile_select();	
		$this->db->_reset_select();
		
		
		
		$query1 = str_replace(array(1=>'(',2=>')',3=>'`1`'),array(1=>'',2=>'',3=>'1'),$query1);
		$query2 = str_replace(array(1=>'(',2=>')',3=>'`0`'),array(1=>'',2=>'',3=>'0'),$query2);
			
		$query = $this->db->query("$query1 UNION $query2 ");

		$data = $query->result_array();

		$count = $query->num_rows();
		
		return ($count>0) ? $count : 0;
	}

	
	function allmemberinfo($limit=false, $start=false)
	{
		//$searchfield = $this->input->post('searchfield');
		
		$this->db->select('u.*, c.country_name, s.name as state_name, i.img_id, i.dispatch_to, i.image0, i.delivery_dt, i.post_date as order_dt, 1 as pic_type');
		$this->db->from('img as i');
		$this->db->join('user as u','i.user_id = u.user_id','left');
		$this->db->join('country as c','c.country_id = u.country_id', 'left');
		$this->db->join('state as s','s.state_id = u.state_id AND s.country_id = u.country_id', 'left');
		$this->db->where('i.active_status', 1);
		$this->db->where('i.dispatch', 0);
		//$this->db->order_by("i.delivery_dt,i.img_id");
		$query1 = $this->db->_compile_select();
		$this->db->_reset_select();

		
		
		
		$this->db->select('u.*,c.country_name, s.name as state_name, pic.pic_id as img_ig, pic.dispatch_to, pic.dispatch_to as image0, pic.delivery_dt, pic.post_date as order_dt, 0 as pic_type');
		$this->db->from('pic');
		$this->db->join('picimg','pic.pic_id = picimg.pic_id');	
		$this->db->join('user as u','pic.user_id = u.user_id','left');
		$this->db->join('country as c','c.country_id = u.country_id', 'left');
		$this->db->join('state as s','s.state_id = u.state_id AND s.country_id = u.country_id', 'left');
		$this->db->where('pic.active_status', 1);		
		$this->db->where('pic.dispatch',0);			
		$this->db->order_by("delivery_dt");
		$query2 = $this->db->_compile_select();	
		$this->db->_reset_select();
			
		
		//if($limit != '')
		//$this->db->limit($limit, $start);		
		//$query = $this->db->get();	
		//echo $this->db->last_query();
		
		$query1 = str_replace(array(1=>'(',2=>')',3=>'`1`'),array(1=>'',2=>'',3=>'1'),$query1);
		$query2 = str_replace(array(1=>'(',2=>')',3=>'`0`'),array(1=>'',2=>'',3=>'0'),$query2);
		
		if($limit != '')
		$limit = " LIMIT $start,$limit ";	
		
		
		$query = $this->db->query("$query1 UNION $query2 $limit");

		$data = $query->result_array();

		$count = $query->num_rows();

		
		return ($count>0) ? $data : 0;
	}
	
	function change_status($id,$stat)
	{
		$stat = ($stat==0) ? 1 : 0;
	 
		 $data = array(
		   'status' => $stat,
		   );
		   
		$this->db->where('user_id', $id);
		$this->db->update('user', $data); 
	}
	
	function getMemberById($id)
	{
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where('user_id',$id);

		$query = $this->db->get();
		
		//echo $this->db->last_query();exit;
		$data = $query->result_array();
		return $data;
	}
	
	function dispatchCardByMemberId($memberid,$cardid)
	{
		 $data = array(
		   'dispatch' => 1,
		   );
		 
		$this->db->where('user_id',$memberid);
		$this->db->where('img_id',$cardid);
		$query = $this->db->update('img', $data); 
		
		
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	 
	 
	function travellerlist()
	{
		$this->db->select('*');
		$this->db->from('traveller_type');
		$this->db->order_by("traveller_type_id", "ASC");

		$query = $this->db->get();
		//echo $this->db->last_query();
		
		$data = $query->result_array();
		$count = $query->num_rows();
		
		if($count>0)
			return $data;
		else
			return 0;
	}
	
	
	function programlist()
	{
		$this->db->select('*');
		$this->db->from('programs');
		$this->db->order_by("program_id", "ASC");
		$query = $this->db->get();
		
		$data = $query->result_array();
		$count = $query->num_rows();
		
		if($count>0)
			return $data;
		else
			return 0;
	}
	
	
	function addmember($user_profile_photo)
	{
		$address = urlencode($this->input->post('user_country')).'+'.urlencode($this->input->post('user_city'));
		$url = "http://maps.google.com/maps/api/geocode/json?address=$address&sensor=false&region=India";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		$response = curl_exec($ch);
		curl_close($ch);
		$response_a = json_decode($response);
		$lat = $response_a->results[0]->geometry->location->lat;
		$long = $response_a->results[0]->geometry->location->lng;
		
		$data = array(
			'user_fname' => $this->input->post('user_fname'),
			'user_lname' => $this->input->post('user_lname'),
			'user_email' => $this->input->post('user_email'),
			'user_password' => md5($this->input->post('user_password')),
			'user_original_password' => $this->input->post('user_password'),
			'user_address' => $this->input->post('user_address'),
			'user_country' => $this->input->post('user_country'),
			'user_state' => $this->input->post('user_state'),
			'user_city' => $this->input->post('user_city'),
			'user_zip' => $this->input->post('user_zip'),
			'user_dob_date' => $this->input->post('user_dob_date'),
			'user_dob_month' => $this->input->post('user_dob_month'),
			'user_dob_year' => $this->input->post('user_dob_year'),
			'user_latitude' =>$lat,
			'user_longitude' =>$long,
			'user_traveller_type' => $this->input->post('user_traveller_type'),
			'user_programs_done' => $this->input->post('program_done'),
			'user_profile_photo' => $user_profile_photo,
			'user_travel_resume' => $this->input->post('user_travel_resume'),
			'user_registration_date' => time()
		); 
				
		$this->db->insert('users', $data);
		//$student_id = $this->db->insert_id();
		//return $student_id;
	}
	
	
	
	
	
	function editmember($user_profile_photo)
	{
		$address = urlencode($this->input->post('user_country')).'+'.urlencode($this->input->post('user_city'));
		$url = "http://maps.google.com/maps/api/geocode/json?address=$address&sensor=false&region=India";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		$response = curl_exec($ch);
		curl_close($ch);
		$response_a = json_decode($response);
		$lat = $response_a->results[0]->geometry->location->lat;
		$long = $response_a->results[0]->geometry->location->lng;
		
		$data = array(
			'user_fname' => $this->input->post('user_fname'),
			'user_lname' => $this->input->post('user_lname'),
			'user_email' => $this->input->post('user_email'),
			'user_password' => md5($this->input->post('user_password')),
			'user_original_password' => $this->input->post('user_password'),
			'user_address' => $this->input->post('user_address'),
			'user_country' => $this->input->post('user_country'),
			'user_state' => $this->input->post('user_state'),
			'user_city' => $this->input->post('user_city'),
			'user_zip' => $this->input->post('user_zip'),
			'user_dob_date' => $this->input->post('user_dob_date'),
			'user_dob_month' => $this->input->post('user_dob_month'),
			'user_dob_year' => $this->input->post('user_dob_year'),
			'user_latitude' =>$lat,
			'user_longitude' =>$long,
			'user_traveller_type' => $this->input->post('user_traveller_type'),
			'user_programs_done' => $this->input->post('program_done'),
			'user_profile_photo' => $user_profile_photo,
		    'user_travel_resume' => $this->input->post('user_travel_resume')
		); 
				
		$this->db->where('user_id', $this->input->post('user_id'));
		$this->db->update('users', $data);
	}
	
	
	 function deletemember($id)
	 {
		$this->db->delete('users', array('user_id' => $id)); 
	 }
	 
	 
	 function deletememberphotos($id)
	 {
		$this->db->delete('user_photos', array('user_id' => $id)); 
	 }
	 
	 
	 function deletememberstatus($id)
	 {
		$this->db->delete('user_status', array('user_id' => $id)); 
	 }
	 
	 
	 function deletemembereventjoinpeople($id)
	 {
		$this->db->delete('user_event_join_people', array('user_id' => $id)); 
	 }
	 
	 function deletememberdiscuss($id)
	 {
		$this->db->delete('user_discuss', array('user_id' => $id)); 
	 }
	 
	 function deletememberprivacysettings($id)
	 {
		$this->db->delete('user_privacy_settings', array('blocked_user_id' => $id)); 
	 }
	 
	
	
	 
}
?>
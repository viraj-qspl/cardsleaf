<?php
if (! defined('BASEPATH')) exit('No direct script access');

class Adminmodel extends CI_Model 
{
	function __construct()
	{
        parent::__construct();
		$this->load->database();
	}
	
	
	function checkAdminExist($username, $password)
	{		
		$query = $this->db->get_where('administrator', array('admin_username' => mysql_real_escape_string($username), 'admin_password' => md5(mysql_real_escape_string($password))));
		
		$data = $query->row_array();
		$count = $query->num_rows();
		if($count>0)
			return $data;
		else
			return false;
	}
	
	
	function admininfo()
	{
		$this->db->select('*');
		$this->db->from('admin');
		$this->db->where('admin_id', 1);
		$query = $this->db->get();
		
		$data = $query->row_array();
		$count = $query->num_rows();
		
		if($count>0)
			return $data;
		else
			return 0;
	}
	
	
	function changeGeneralSettings()
	{
		$data = array(
			'username' => $this->input->post('admin_username'),
			'fname' => $this->input->post('fname'),
			'lname' => $this->input->post('lname'),
			'email' => $this->input->post('admin_email'),
			'api_un' => $this->input->post('apiun'),
			'api_pass' => $this->input->post('apipas'),
			'api_sign' => $this->input->post('apisig'),
			'paypal_pro_type' => $this->input->post('paypal_pt'),
			'paypal_busi_id' => $this->input->post('paypalbid'),
			'paypal_sta_type' => $this->input->post('paypalst'),
			'active_female_sub' => $this->input->post('afs'),
			'no_coin_reg' => $this->input->post('nocoinreg'),
			'ad1' => $this->input->post('adsence1'),
			'ad2' => $this->input->post('adsence2')
		);		
		
		$this->db->where('admin_id', '1');
		$this->db->update('admin', $data);
		
		return true;		
	}
	
	
	
	function checkPasswordExist()
	{		
		$this->db->select('*');
		$this->db->from('admin');
		$this->db->where('password', md5($this->input->post('old_password')));

		$query = $this->db->get();
		
		//echo $this->db->last_query();exit;
		$count = $query->num_rows();
		return $count;
	}
	
	
	function changepassword()
	{
		$data = array(
			'password' => md5($this->input->post('new_password')),
			'rem_password' => $this->input->post('new_password')
		);		
		
		$this->db->where('admin_id', '1');
		$this->db->update('admin', $data);
		
		return true;		
	}
	
	
	function getPageById($page)
	{
		$this->db->select('*');
		$this->db->from('pages');
		$this->db->where("page_link", $page);

		$query = $this->db->get();
		
		$data = $query->row_array();
		return $data;
	}
	
	
	function updatepages($page)
	{ 
		$data = array('page_name' => $this->input->post('pagetitle'),'page_content' => htmlentities( $this->input->post('content'))
					  );
		$this->db->where('page_link', mysql_real_escape_string($page));
		$this->db->update('pages',$data);
	}
	
}
?>
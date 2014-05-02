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
		$admin_type = $this->session->userdata('admin_type');
		$this->db->select('*');
		$this->db->from('admin');
		$this->db->where('admin_id', $this->session->userdata('admin_id'));
		$this->db->where('account_type', $admin_type);
		
		$query = $this->db->get();
		
		$data = $query->row_array();
		$count = $query->num_rows();
		
		if($count>0) return $data; else return 0;
	}
	
	
	function changeGeneralSettings()
	{
		$this->db->select('*');
		$this->db->from('admin');
		$this->db->where("username", mysql_real_escape_string(trim($this->input->post('admin_username'))));
		//$this->db->where("admin_id <>", $this->session->userdata('admin_id'));
		
		$query = $this->db->get();
		
		$data = $query->row_array();
		$count = $query->num_rows();
		if($count==1)
		{
			if(isset($data['admin_id']) && $data['admin_id'] == $this->session->userdata('admin_id'))
			$flag = 'I';
			else
			$flag ='O';
		}
		else
		$flag ='N';
		
		//echo ($flag == 'I' || $flag != 'O' || $flag == 'N'); exit;
		
		if($flag == 'I' || $flag != 'O' || $flag == 'N') {
		$data = array(
			'username' => $this->input->post('admin_username'),
			'fname' => $this->input->post('fname'),
			'lname' => $this->input->post('lname'),
			
			//'api_un' => $this->input->post('apiun'),
			//'api_pass' => $this->input->post('apipas'),
			//'api_sign' => $this->input->post('apisig'),
			//'paypal_pro_type' => $this->input->post('paypal_pt'),
			//'paypal_busi_id' => $this->input->post('paypalbid'),
			//'paypal_sta_type' => $this->input->post('paypalst'),
			//'active_female_sub' => $this->input->post('afs'),
			//'no_coin_reg' => $this->input->post('nocoinreg'),
			//'ad1' => $this->input->post('adsence1'),
			//'ad2' => $this->input->post('adsence2')
		);
		
		if($this->session->userdata('admin_type')==1)
		$data['email'] = $this->input->post('admin_email');
		
		if($this->session->userdata('admin_type')==2)
		$data['accountno'] = $this->input->post('accno');
		
		$this->db->where('admin_id', $this->session->userdata('admin_type'));
		$this->db->update('admin', $data);
		}
		else
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
		
		$this->db->where('admin_id', $this->session->userdata('admin_id'));
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
		$data = array(
			      'page_name' => $this->input->post('pagetitle'),
			      'page_content' => htmlentities( $this->input->post('content'))
				);
		$this->db->where('page_link', mysql_real_escape_string($page));
		$this->db->update('pages',$data);
	}
	
	function add_vendor()
	{
		$this->db->select('*');
		$this->db->from('admin');
		$this->db->where("username", mysql_real_escape_string(trim($this->input->post('vendor_email'))));
		$query = $this->db->get();
		
		$data = $query->row_array();
		$count = $query->num_rows(); //exit;
		
		if($count<=0) 
		{ //print_r($this->input->post());exit;
		
		
			switch($this->input->post('zone'))
			{
				case 'N':$zone='N';
				break;
				
				case 'S':$zone='S';
				break;
				
				case 'E':$zone='E';
				break;
				
				case 'W':$zone='W';
				break;
				
				default: $zone='S';
						
			}
		
		
		$data = array(
			'username' => mysql_real_escape_string(trim($this->input->post('vendor_email'))),
			'password' => md5($this->input->post('pass')),
			'rem_password' => $this->input->post('pass'),
			'zone' => $zone,
			'account_type' => 2
		);		
		
		$this->db->insert('admin', $data);
		
		return true;
		}
		else
		return false;
	}
	
	function del_vendor($vendorid)
	{	
		$this->db->where("account_type", 2);
		$this->db->where("admin_id", $vendorid);
		$this->db->delete('admin'); 
		
	}
	function getVendors_count()
	{
		$this->db->select('*');
		$this->db->from('admin');
		$this->db->where("account_type", 2);

		$query = $this->db->get();
		
		//$data = $query->result_array();
		$count = $query->num_rows();
		$query->free_result();
		
		return ($count>0) ? $count : 0;		
	}
	
	function getVendors($limit, $start)
	{
		$this->db->select('*');
		$this->db->from('admin');
		$this->db->where("account_type", 2);
		
		if($limit != '')
		$this->db->limit($limit, $start);

		$query = $this->db->get();
		
		$data = $query->result_array();
		$count = $query->num_rows();
		$query->free_result();
		
		return ($count>0) ? $data : 0;		
	}
	
	function getVendorsByid($vendor)
	{
		$this->db->select('*');
		$this->db->from('admin');
		$this->db->where("admin_id", $vendor);
		$this->db->where("account_type", 2);

		$query = $this->db->get();
		
		$data = $query->row_array();
		$count = $query->num_rows();
		$query->free_result();
		
		return ($count>0) ? $data : 0;		
	}
	
	function add_package()
	{
		$data = array(
			'pack_title' => $this->input->post('pack_title'),
			'pack_price' => $this->input->post('pack_price'),
			'pack_brief' => htmlentities($this->input->post('pack_b')),
			'pack_duration' => htmlentities($this->input->post('pack_d')),
			'pack_quantity' => htmlentities($this->input->post('pack_q')),
			'pack_desc' => htmlentities($this->input->post('pack_desc')),
		);
		
		$this->db->insert('package', $data);
		
		return true;		
	}
	
	function edit_package($pack_id)
	{
		$data = array(
			'pack_title' => $this->input->post('pack_title'),
			'pack_price' => $this->input->post('pack_price'),
			'pack_brief' => htmlentities($this->input->post('pack_b')),
			'pack_duration' => htmlentities($this->input->post('pack_d')),
			'pack_quantity' => htmlentities($this->input->post('pack_q')),
			'pack_desc' => htmlentities($this->input->post('pack_desc')),
		);		
		$this->db->where('pid', $pack_id);
		$this->db->update('package', $data);
	}
	
	function allpackage_count()
	{
		$this->db->select('*');
		$this->db->from('package');

		$query = $this->db->get();
		
		//$data = $query->result_array();
		$count = $query->num_rows();
		$query->free_result();
		
		return ($count>0) ? $count : 0;		
	}
	
	function allpackage($limit, $start)
	{
		$this->db->select('*');
		$this->db->from('package');
		
		if($limit != '')
		$this->db->limit($limit, $start);

		$query = $this->db->get();
		
		$data = $query->result_array();
		$count = $query->num_rows();
		$query->free_result();
		
		return ($count>0) ? $data : 0;		
	}
	
	function getPackageById($pack_id)
	{
		$this->db->select('*');
		$this->db->from('package');
		$this->db->where('pid',$pack_id);
		
		$query = $this->db->get();
		
		$data = $query->row_array();
		$count = $query->num_rows();
		$query->free_result();
		
		return ($count>0) ? $data : 0;		
	}
	
	function deletePackageById($pack_id)
	{
		$this->db->where("pid", $pack_id);
		$this->db->delete('package'); 
	}
}
?>
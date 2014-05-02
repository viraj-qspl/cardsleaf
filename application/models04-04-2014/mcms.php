<?php
if (! defined('BASEPATH')) exit('No direct script access');

class mcms extends CI_Model 
{
	function __construct()
	{
        parent::__construct();
		$this->load->database();
	}
	
	function getCMSPage($id)
	{
		$query = $this->db->get_where('pages', array('page_link' => $id));
		$data = $query->row_array();
		
		$count = $query->num_rows();
		if($count>0)
			return $data;
		else
			return 0;
	}
	
	function getAllCMSPage()
	{
		$query = $this->db->get('cms');
		$data = $query->result_array();	

		return $data;
	}
	
	function editcms($id)
	{
		$data = array(
			'cms_title' => addslashes($this->input->post('cms_title')),
			'cms_content' => addslashes($this->input->post('cms_content')),
			'cms_date' => date('Y-m-d H:i:s')	
		);		
		
		$this->db->where('cms_id', $id);
		$this->db->update('cms', $data);
		
		return true;		
	}
	
	function changeStatus($cms_id)
	{		
		$data = array(
			'cms_status' => $this->input->post('status')
		); 
		
		$this->db->where('cms_id', $cms_id);
		$this->db->update('cms', $data); 		
	}
	
	function changeStatusByLevel($data)
	{		
		for($i=0; $i<count($data); $i++)
		{
			$this->changeStatus($data[$i]);									
		}
	}
	
	function getVideo()
	{
		$query = $this->db->get_where('video', array('vd_status' => '1'));
		$data = $query->result_array();	

		return $data;
	}
}
?>
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class State extends CI_Controller 
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('mstate');
		$this->load->model('mcountry');
		$this->load->theme('admintheme');
		$this->load->helper('auth');
	}
	
	public function index()
	{
		if(!isAdminLoggedIn())
		{
			redirect("admin/home/login");
		}
		
		
		$country_id = $this->uri->segment(4);
		if($country_id!='')
		{
			$data["state"] = $this->mstate->getStateByCountry($country_id);
		}
		else
		{
			$data["state"] = $this->mstate->getAllState();
		}
		
		
		$data["site_title"] = 'State manager';
		$data["menu_title"] = 'State Manager: Add state';
		
		$this->load->view('state', $data);
	}
	
	
	public function add()
	{
		if(!isAdminLoggedIn())
		{
			redirect("admin/home/login");
		}
		
		
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{
			$country_id = $this->mstate->addState();
			$this->session->set_userdata('success_msg', 'State added successfully.');
			
			if($this->input->post('action')=='save')
			redirect("admin/state/add");
			
			if($this->input->post('action')=='save_new')
			redirect("admin/state/index");
		}
		
		
		$data["country"] = $this->mcountry->getAllCountry();
		$data["menu_title"] = 'State Manager: Add state';
		$data["site_title"] = 'Add state';
		$this->load->view('state_add', $data);
	}
	
	public function edit($id)
	{
		if(!isAdminLoggedIn())
		{
			redirect("admin/home/login");
		}
		
		$data["state"] = $this->mstate->getStateById($id);
		$data["country"] = $this->mcountry->getAllCountry();

		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{
			$state_id = $this->mstate->editState($id);
			$this->session->set_userdata('success_msg', 'State updated successfully.');
			
			if($this->input->post('action')=='save')
				redirect("admin/state/edit/".$id);
			
			if($this->input->post('action')=='save_new')
				redirect("admin/state/index");
		}
		
		$data["menu_title"] = 'State Manager: Edit State';
		$data["site_title"] = 'Edit State';
		$this->load->view('state_edit', $data);
	}
	
	public function trash($id)
	{
		if(!isAdminLoggedIn())
		{
			redirect("admin/home/login");
		}
		
		$this->mstate->trashState($id);
		$this->session->set_userdata('success_msg', 'State deleted successfully.');
									
		redirect("admin/state/index");	
		
		//$data["site_title"] = 'Edit Color';
		//$this->load->view('color', $data);
	}
}

?>
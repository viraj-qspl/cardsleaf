<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class City extends CI_Controller 
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('mstate');
		$this->load->model('mcountry');
		$this->load->model('mcity');
		$this->load->theme('admintheme');
		$this->load->helper('auth');
	}
	
	public function index()
	{
		if(!isAdminLoggedIn())
		{
			redirect("admin/home/login");
		}
		
		
		$state_id = $this->uri->segment(4);
		if($state_id!='')
		{
			$data["city"] = $this->mcity->getCityByState($state_id);
		}
		else
		{
			$data["city"] = $this->mcity->getAllCity();
		}
		
		
		$data["site_title"] = 'City manager';
		$data["menu_title"] = 'City Manager: Add city';
		
		$this->load->view('city', $data);
	}
	
	
	public function add()
	{
		if(!isAdminLoggedIn())
		{
			redirect("admin/home/login");
		}
		
		
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{
			$city_id = $this->mcity->addCity();
			
			$this->session->set_userdata('success_msg', 'City added successfully.');
			
			if($this->input->post('action')=='save')
			redirect("admin/city/add");
			
			if($this->input->post('action')=='save_new')
			redirect("admin/city/index");
		}
		
		
		$data["country"] = $this->mcountry->getAllCountry();
		$data["menu_title"] = 'City Manager: Add city';
		$data["site_title"] = 'Add city';
		$this->load->view('city_add', $data);
	}
	
	public function edit($id)
	{
		if(!isAdminLoggedIn())
		{
			redirect("admin/home/login");
		}
		
		$data["city"] = $this->mcity->getCityById($id);
		$data["country"] = $this->mcountry->getAllCountry();
		$data["state"] = $this->mstate->getAllState();

		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{
			$city_id = $this->mcity->editCity($id);
			$this->session->set_userdata('success_msg', 'City updated successfully.');
			
			if($this->input->post('action')=='save')
				redirect("admin/city/edit/".$id);
			
			if($this->input->post('action')=='save_new')
				redirect("admin/city/index");
		}
		
		$data["menu_title"] = 'City Manager: Edit City';
		$data["site_title"] = 'Edit City';
		$this->load->view('city_edit', $data);
	}
	
	public function trash($id)
	{
		if(!isAdminLoggedIn())
		{
			redirect("admin/home/login");
		}
		
		$this->mcity->trashCity($id);
		$this->session->set_userdata('success_msg', 'City deleted successfully.');
									
		redirect("admin/city/index");	
		
		//$data["site_title"] = 'Edit Color';
		//$this->load->view('color', $data);
	}
}

?>
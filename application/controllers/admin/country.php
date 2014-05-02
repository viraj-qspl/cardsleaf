<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Country extends CI_Controller 
{
	
	public function __construct()
	{
		parent::__construct();
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
		
		$data["country"] = $this->mcountry->getAllCountry();
		$data["site_title"] = 'Country manager';
		$data["menu_title"] = 'Country Manager: Add country';
		
		$this->load->view('country', $data);
	}
	
	
	public function add()
	{
		if(!isAdminLoggedIn())
		{
			redirect("admin/home/login");
		}
				
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{
			$country_id = $this->mcountry->addCountry();
			$this->session->set_userdata('success_msg', 'Country added successfully.');
			
			if($this->input->post('action')=='save')
			redirect("admin/country/add");
			
			if($this->input->post('action')=='save_new')
			redirect("admin/country/index");
		}
		
		$data["site_title"] = 'Add country';
		$this->load->view('country_add', $data);
	}
	
	public function edit($id)
	{
		if(!isAdminLoggedIn())
		{
			redirect("admin/home/login");
		}
		
		$data["country"] = $this->mcountry->getCountryById($id);

		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{
			$country_id = $this->mcountry->editCountry($id);
			$this->session->set_userdata('success_msg', 'Country updated successfully.');
			
			if($this->input->post('action')=='save')
				redirect("admin/country/edit/".$id);
			
			if($this->input->post('action')=='save_new')
				redirect("admin/country/index");
		}
		
		$data["site_title"] = 'Edit Country';
		$this->load->view('country_edit', $data);
	}
	
	public function trash($id)
	{
		if(!isAdminLoggedIn())
		{
			redirect("admin/home/login");
		}
		
		$this->mcountry->trashCountry($id);
		$this->session->set_userdata('success_msg', 'Country deleted successfully.');
									
		redirect("admin/country/index");	
		
		//$data["site_title"] = 'Edit Color';
		//$this->load->view('color', $data);
	}
}

?>
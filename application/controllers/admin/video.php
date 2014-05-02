<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class video extends CI_Controller 
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->theme('admintheme');
		$this->load->helper('auth');
		$this->load->model('mvideo');
	}
	
	public function index()
	{
		if(!isAdminLoggedIn())
		{
			redirect("admin/home/login");
		}
		
		$data["video"] = $this->mvideo->getAllVideo();
			

		$data["site_title"] = 'Video Manager';
		$data["menu_title"] = 'Video Manager: Add Video';
		$this->load->view('video', $data);
	}
	
	# Add product #
	public function add()
	{
		if(!isAdminLoggedIn())
		{
			redirect("admin/home/login");
		}
		
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{						
			$video_id = $this->mvideo->addVideo();
									
			$this->session->set_userdata('success_msg', 'Video added successfully.');
			
			if($this->input->post('action')=='save')
				redirect("admin/video/add");
			
			if($this->input->post('action')=='save_new')
				redirect("admin/video/index");
		}
		
		$data["site_title"] = 'Add Video';
		$this->load->view('video_add', $data);
	}		
	
	public function edit($id)
	{		
		if(!isAdminLoggedIn())
		{
			redirect("admin/home/login");
		}
		
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{
			$this->mvideo->editVideo($id);
		
			$this->session->set_userdata('success_msg', 'Video updated successfully.');
			
			if($this->input->post('action')=='save')
				redirect("admin/video/edit");
			
			if($this->input->post('action')=='save_new')
				redirect("admin/video/index");					
		}
				
		$data["video"] = $this->mvideo->getVideoById($id);
		$data["site_title"] = 'Edit Video';			
		$this->load->view('video_edit', $data);								
	}
	
	public function trash($id)
	{
		if(!isAdminLoggedIn())
		{
			redirect("admin/home/login");
		}
		
		$this->mvideo->trashVideo($id);
		$this->session->set_userdata('success_msg', 'Video deleted successfully.');
									
		redirect("admin/video/index");	
	}
}

?>
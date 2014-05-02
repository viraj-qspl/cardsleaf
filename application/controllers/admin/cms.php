<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class cms extends CI_Controller 
{
	
	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('admin/adminmodel');
		
		$this->load->helper('auth');
		
		$this->load->theme('admintheme');
	}
	
	public function pages()
	{
		if(!isAdminLoggedIn())
		{
			redirect("admin/home/login");
		}

		$page = $this->uri->segment(4);
		$data["pagecontent"] = $this->adminmodel->getPageById($page);
		//echo '<pre>';print_r($data["pagecontent"]);exit;
		
		if($this->input->server('REQUEST_METHOD') === 'POST')
		{
			//echo $data["pagecontent"]['page_sef_url'];exit;
			
			$this->adminmodel->updatepages($page);
			$this->session->set_userdata('success_msg', 'Page content updated Successfully.');
			redirect("admin/cms/pages/".$page);
		}

		$data['site_title'] = 'Admin Page List';
		$this->load->view('page_editor', $data);
	}
	
	
	
	
	
}

?>
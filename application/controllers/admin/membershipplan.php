<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class membershipplan extends CI_Controller 
{
	
	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('admin/adminmodel');
		$this->load->model('admin/membershipmodel');
		
		$this->load->helper('auth');
		
		$this->load->theme('admintheme');
	}
	
	public function index()
	{
		if(!isAdminLoggedIn())
		{
			redirect("admin/home/login");
		}

		$data["memshipDtls"] = $this->membershipmodel->listmembershipplan();
		//print_r($data["memshipDtls"]);
		
		$data['site_title'] = 'List of Membership Plan';
		$this->load->view('list_membership', $data);
	}
	
	public function addmemshipplan()
	{
		if(!isAdminLoggedIn())
		{
			redirect("admin/home/login");
		}
		//$data["pagecontent"] = $this->adminmodel->getPageById($page);
		
		if($this->input->server('REQUEST_METHOD') === 'POST')
		{
			//print_r($this->input->post());exit;
			
			$this->membershipmodel->addmembershipplan();
			$this->session->set_userdata('success_msg', 'MemberShip Plan successfully.');
			redirect("admin/membershipplan/");
		}

		$data['site_title'] = 'Add Membership Plan';
		$this->load->view('add_membership', $data);
	}
	
	public function editmemshipplan($mpid)
	{
		if(!isAdminLoggedIn())
		{
			redirect("admin/home/login");
		}
		// $mpid means Membership Plan id		
		$data["thememship"] = $this->membershipmodel->getMembershipPlanById($mpid);
		//print_r($data["thememship"]);
		
		if($this->input->server('REQUEST_METHOD') === 'POST')
		{
			//print_r($this->input->post());exit;
			
			$this->membershipmodel->editmembershipplan($mpid);
			$this->session->set_userdata('success_msg', 'MemberShip Plan successfully edited.');
			redirect("admin/membershipplan/");
		}

		$data['site_title'] = 'Add Membership Plan';
		$this->load->view('edit_membership', $data);
	}
	
	public function deletememshipplan($mpid)
	{
		if(!isAdminLoggedIn())
		{
			redirect("admin/home/login");
		}
		// $mpid means Membership Plan id		
		$this->membershipmodel->deleteMembershipPlan($mpid);
		//print_r($data["thememship"]);
		
		$this->session->set_userdata('success_msg', 'MemberShip Plan successfully deleted.');
		redirect("admin/membershipplan/");

		$data['site_title'] = 'Add Membership Plan';
	}
	
	
}

?>
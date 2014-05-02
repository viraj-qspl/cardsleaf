<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller 
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('member');
		$this->load->model('mcountry');
		$this->load->model('mstate');
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
		
		$data["users"] = $this->member->getAllUsers();
		
		
		$data["site_title"] = 'Manage user';
		$data["menu_title"] = 'Manage user';
		//echo '<pre>'.print_r($data["country"],true).'</pre>';
		//exit;
		$this->load->view('user', $data);
	}
	
	public function add()
	{
		if(!isAdminLoggedIn())
		{
			redirect("admin/home/login");
		}
		
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{
			$this->session->set_userdata('username', $this->input->post('username'));
			$this->session->set_userdata('first_name', $this->input->post('first_name'));
			$this->session->set_userdata('last_name', $this->input->post('last_name'));
			$this->session->set_userdata('email', $this->input->post('email'));
			$this->session->set_userdata('country_id', $this->input->post('country_id'));
			$this->session->set_userdata('state_id', $this->input->post('state_id'));
			$this->session->set_userdata('city_id', $this->input->post('city_id'));
			$this->session->set_userdata('zipcode', $this->input->post('zipcode'));
			
			$chkuser_duplicate=$this->member->chkUsernameDuplicate($this->input->post('username'));			
			$chkemail_duplicate=$this->member->chkEmailDuplicate($this->input->post('email'));			
			
			if($this->input->post('username') == '')
			{
				$this->session->set_userdata('error_msg', 'Please enter username!');
				redirect("admin/user/add");
			}
			if($this->input->post('password') == '')
			{
				$this->session->set_userdata('error_msg', 'Please enter password!');
				redirect("admin/user/add");
			}
			if($this->input->post('first_name') == '')
			{
				$this->session->set_userdata('error_msg', 'Please enter first name!');
				redirect("admin/user/add");
			}
			if($this->input->post('last_name') == '')
			{
				$this->session->set_userdata('error_msg', 'Please enter last name!');
				redirect("admin/user/add");
			}
			if($this->input->post('email') == '')
			{
				$this->session->set_userdata('error_msg', 'Please enter email!');
				redirect("admin/user/add");
			}
			if($this->input->post('country_id') == '')
			{
				$this->session->set_userdata('error_msg', 'Please select country!');
				redirect("admin/user/add");
			}
			if($this->input->post('state_id') == '')
			{
				$this->session->set_userdata('error_msg', 'Please select state!');
				redirect("admin/user/add");
			}
			if($this->input->post('city_id') == '')
			{
				$this->session->set_userdata('error_msg', 'Please select city!');
				redirect("admin/user/add");
			}
			if($this->input->post('zipcode') == '')
			{
				$this->session->set_userdata('error_msg', 'Please enter zipcode!');
				redirect("admin/user/add");
			}
			if($chkuser_duplicate == '1')
			{
				$this->session->set_userdata('error_msg', 'Username already exists!');
				redirect("admin/user/add");
			}
			if($chkemail_duplicate == '1')
			{
				$this->session->set_userdata('error_msg', 'Email id already exists!');
				redirect("admin/user/add");
			}
			
			$user_id = $this->member->addMember('user');
			$this->session->set_userdata('success_msg', 'User added successfully.');
			
			$this->session->unset_userdata('username');
			$this->session->unset_userdata('first_name');
			$this->session->unset_userdata('last_name');
			$this->session->unset_userdata('email');
			$this->session->unset_userdata('country_id');
			$this->session->unset_userdata('state_id');
			$this->session->unset_userdata('city_id');
			$this->session->unset_userdata('zipcode');
			
			if($this->input->post('action')=='save')
				redirect("admin/user/add");
			
			if($this->input->post('action')=='save_new')
				redirect("admin/user/index");
		}
		
		$data["country"] = $this->mcountry->getAllCountry();
		if($this->session->userdata('country_id') != '')
			$data["state"] = $this->mstate->getStateByCountry($this->session->userdata('country_id'));

		if($this->session->userdata('state_id') != '')			
			$data["city"] = $this->mcity->getCityByState($this->session->userdata('state_id'));
						
		$data["site_title"] = 'Add user';
		$this->load->view('user_add', $data);
	}
	
	public function edit($id)
	{
		if(!isAdminLoggedIn())
		{
			redirect("admin/home/login");
		}
		
		$data["user"] = $this->member->getUserById($id);

		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{
			$this->session->set_userdata('first_name', $this->input->post('first_name'));
			$this->session->set_userdata('last_name', $this->input->post('last_name'));
			$this->session->set_userdata('email', $this->input->post('email'));
			$this->session->set_userdata('country_id', $this->input->post('country_id'));
			$this->session->set_userdata('state_id', $this->input->post('state_id'));
			$this->session->set_userdata('city_id', $this->input->post('city_id'));
			$this->session->set_userdata('zipcode', $this->input->post('zipcode'));						
			
			$chkemail_duplicate=$this->member->chkEmailDuplicate1($this->input->post('email'), $id);	
					
			if($this->input->post('first_name') == '')
			{
				$this->session->set_userdata('error_msg', 'Please enter first name!');
				redirect("admin/user/edit/".$id);
			}
			if($this->input->post('last_name') == '')
			{
				$this->session->set_userdata('error_msg', 'Please enter last name!');
				redirect("admin/user/edit/".$id);
			}
			if($this->input->post('email') == '')
			{
				$this->session->set_userdata('error_msg', 'Please enter email!');
				redirect("admin/user/edit/".$id);
			}
			if($this->input->post('country_id') == '')
			{
				$this->session->set_userdata('error_msg', 'Please select country!');
				redirect("admin/user/edit/".$id);
			}
			if($this->input->post('state_id') == '')
			{
				$this->session->set_userdata('error_msg', 'Please select state!');
				redirect("admin/user/edit/".$id);
			}
			if($this->input->post('city_id') == '')
			{
				$this->session->set_userdata('error_msg', 'Please select city!');
				redirect("admin/user/edit/".$id);
			}
			if($this->input->post('zipcode') == '')
			{
				$this->session->set_userdata('error_msg', 'Please enter zipcode!');
				redirect("admin/user/edit/".$id);
			}
			if($chkemail_duplicate == '1')
			{
				$this->session->set_userdata('error_msg', 'Email id already exists!');
				redirect("admin/user/edit/".$id);
			}
			
			$user_id = $this->member->editMemberAdmin($id);
			$this->session->set_userdata('success_msg', 'User updated successfully.');
			
			$this->session->unset_userdata('first_name');
			$this->session->unset_userdata('last_name');
			$this->session->unset_userdata('email');
			$this->session->unset_userdata('country_id');
			$this->session->unset_userdata('state_id');
			$this->session->unset_userdata('city_id');
			$this->session->unset_userdata('zipcode');
			
			if($this->input->post('action')=='save')
				redirect("admin/user/edit/".$id);
			
			if($this->input->post('action')=='save_new')
				redirect("admin/user/index");
		}
		
		$data["country"] = $this->mcountry->getAllCountry();
		$data["state"] = $this->mstate->getStateByCountry($data["user"]['country_id']);
		$data["city"] = $this->mcity->getCityByState($data["user"]['state_id']);
		
		$data["site_title"] = 'Edit User';
		$this->load->view('user_edit', $data);
	}
	
	/*public function trash($id)
	{
		if(!isAdminLoggedIn())
		{
			redirect("admin/home/login");
		}
		
		$this->member->trashSize($id);
		$this->session->set_userdata('success_msg', 'Size deleted successfully.');
									
		redirect("admin/size/index");	
		
		//$data["site_title"] = 'Edit Size';
		//$this->load->view('size', $data);
	}*/

}
?>
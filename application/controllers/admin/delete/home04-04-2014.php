<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller 
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('member');
		$this->load->model('admin/adminmodel');
		
		$this->load->theme('admintheme');
		
		$this->load->helper('auth');
		
		$this->load->helper('cookie');
		$this->load->library('pagination');
		$this->load->library('image_lib');
	}
	
	public function index()
	{
		if(!isAdminLoggedIn())
		{
			redirect("admin/home/login");
		}
		
		if($this->session->userdata('admin_id')!=1){
			redirect("admin/member/index");
		}
		
		$data["site_title"] = 'Admin dashboard';
		$this->load->view('index', $data);
	}
	
	public function login()
	{
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			if($this->member->checkAdminExist($username,$password))
			{
				$data = $this->member->checkAdminExist($username,$password);
				$this->session->set_userdata('admin_id', $data["admin_id"]);
				$this->session->set_userdata('admin_name', $data["username"]);
				$this->session->set_userdata('admin_type', $data["account_type"]);
				redirect("admin/home/index");
			}
			else
			{
				$this->session->set_userdata('error_msg', 'Incorrect username or password!');
				redirect("admin/home/login");
			}
		}
		
		$data['site_title'] = 'Admin Login';
		$this->load->view('login', $data);
	}
	
	public function logout()
	{
		$this->session->unset_userdata('admin_id');
		$this->session->unset_userdata('admin_name');
		$this->session->set_userdata('success_msg', 'You have logged out!');
		redirect("admin/home/login");
	}
	
	public function change_pass()
	{
		if(!isAdminLoggedIn())
		{
			redirect("admin/home/login");
		}
		
		$data['site_title'] = 'Admin Change Password';
		$this->load->view('change_password', $data);
	}
	
	public function editpass()
	{		
		if(!isAdminLoggedIn())
		{
			redirect("admin/home/login");
		}
		
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{
			$count = $this->adminmodel->checkPasswordExist();
			if($count==0)
			{
				$this->session->set_userdata('error_msg', 'Old password not found in database.');
				redirect("admin/home/change_pass");				
			}
			else
			{
				$this->adminmodel->changePassword();
				$this->session->set_userdata('success_msg', 'Password changed successfully.');
				redirect("admin/home/change_pass");					
			}
	    }
	}
	
	public function admin_setting()
	{
		if(!isAdminLoggedIn())
		{
			redirect("admin/home/login");
		}
		
		$data["admin_info"] = $this->adminmodel->admininfo();
		
		$data['site_title'] = 'Admin Change Settings';
		$this->load->view('change_settings', $data);
	}
	
	
	public function vendor()
	{
		if(!isAdminLoggedIn())
		{
			redirect("admin/home/login");
		}
		
		//$data["admin_info"] = $this->adminmodel->admininfo();
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{
			//print_r($this->input->post());exit;
			$addedflag = $this->adminmodel->add_vendor();
			
			if($addedflag)
			$this->session->set_userdata('success_msg', 'Vendor added successfully.');
			else
			$this->session->set_userdata('error_msg', 'Email Already register.');
			
			redirect("admin/home/vendor");					
		}
		
		
		$data['site_title'] = 'Vendor Registration';
		$this->load->view('vendor', $data);
	}
	
	public function vendorlist()
	{
		if(!isAdminLoggedIn())
		{
			redirect("admin/home/login");
		}
		
		
		$config = array();
		$config["base_url"] = base_url()."admin/home/vendorlist/";
		$config["per_page"] = 30;
		$config["uri_segment"] = 4;
		
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		$config["total_rows"] = $this->adminmodel->getVendors_count();
		
		$this->pagination->initialize($config);
		
		$data["total_rows"] = $config["total_rows"];
		$data['vendorDtls'] =  $this->adminmodel->getVendors($config["per_page"], $page);
		$data["links"] = $this->pagination->create_links();
	
		$data['site_title'] = 'Vendor Registration';
		$this->load->view('vendorlist', $data);
	}
	
	public function vendordelete()
	{
		if(!isAdminLoggedIn())
		{
			redirect("admin/home/login");
		}
		$vendorid = $this->uri->segment(4);
		
		//print_r($this->uri->segments);exit;
		$this->adminmodel->del_vendor($vendorid);
		redirect("admin/home/vendorlist");	
		
	}
	
	public function admin_setting_edit()
	{		
		if(!isAdminLoggedIn())
		{
			redirect("admin/home/login");
		}
		
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{
			$this->adminmodel->changeGeneralSettings();
			
			$this->session->set_userdata('success_msg', 'Settings changed successfully.');
			redirect("admin/home/admin_setting");					
		}
	}
	
	//public function addpackage()
	//{
	//	if(!isAdminLoggedIn())
	//	{
	//		redirect("admin/home/login");
	//	}
	//	
	//	//$data["admin_info"] = $this->adminmodel->admininfo();
	//	if ($this->input->server('REQUEST_METHOD') === 'POST')
	//	{
	//		$this->adminmodel->add_package();
	//		
	//		$this->session->set_userdata('success_msg', 'Package added successfully.');
	//		redirect("admin/home/listpackage");					
	//	}
	//	
	//	
	//	$data['site_title'] = 'Add Package';
	//	$this->load->view('addpackage', $data);
	//}
	
	public function listpackage()
	{
		if(!isAdminLoggedIn())
		{
			redirect("admin/home/login");
		}

                $config["base_url"] = base_url()."admin/home/listpackage";
                $config["per_page"] = 10;
                $config["uri_segment"] = 4;
		$config['num_links'] = 10;

                $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
                $config["total_rows"] = $this->adminmodel->allpackage_count();
		$config["total_rows"] = 0;
		
                $this->pagination->initialize($config);
		
		$data["total_rows"] = $config["total_rows"];
		$data["allPackage"] = $this->adminmodel->allpackage($config["per_page"], $page);
		$data["allmemberinfo"] = 0;
                $data["links"] = $this->pagination->create_links();		

		//$data['searchitem'] = $this->input->post('searchfield');

		$data['site_title'] = 'Package List';
		$this->load->view('package_list', $data);
	}
	
	public function editpackage()
	{
		if(!isAdminLoggedIn())
		{
			redirect("admin/home/login");
		}
		
		$pack_id = $this->uri->segment(4);
		
		$data['thePackDtls'] = $this->adminmodel->getPackageById($pack_id);
		
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{
			$this->adminmodel->edit_package($pack_id);
			
			$this->session->set_userdata('success_msg', 'Package edited successfully.');
			redirect("admin/home/listpackage");					
		}
		
		$data['site_title'] = 'Package Edit';
		$this->load->view('editpackage', $data);
	}
	
	public function deletepackage()
	{
		if(!isAdminLoggedIn())
		{
			redirect("admin/home/login");
		}
		
		$pack_id = $this->uri->segment(4);
		
		$this->adminmodel->deletePackageById($pack_id);
		
		$this->session->set_userdata('success_msg', 'Package deleted successfully.');
		redirect("admin/home/listpackage");
	}
	
	
	public function sendinfo()
	{
	    if(!isMemberLoggedIn())
	    {
		redirect("admin/home/login");
	    }
		
		$vendorid=$this->uri->segment(4);
		
		$data['vendorDtls'] =  $this->adminmodel->getVendorsByid($vendorid);
		//print_r($data['vendorDtls']);exit;
		$email = $data['vendorDtls']['username'];
		
		if($email!='')
		{
		    $this->session->set_userdata('success_msg', 'Vendor Information is send.');
		    // +++++++++++++++++++++++++ Mail Section +++++++++++++++++++++++++++++++++++++
		    $admin_mail = ADMIN_MAIL;
		    $admin_name = 'Cardsleaf';
		    $subject = 'Vendor Information Details.';
		    
		    $user_message = '<div style="width: 596px; margin: 0 auto; overflow: hidden; border: 2px solid #00d8ff; font-family: Arial;">
	<div style="width: 100%; height: 28px;  padding: 10px 0;
	background: url('.$this->config->item('theme_url').'images/header_bg.png) center bottom repeat-x;">
    	<div style=" width: 134px; margin: 0 auto; display: block;"><a href="#"><img src="'.$this->config->item('theme_url').'images/logo3.png" width="134" height="19" style="display: block;"/></a></div>
    </div>
    <div style="height: 0; line-height: 0; clear: both;"></div>
    
    
    <div style="width: 93.5%; padding: 15px 20px; margin: 0; font-family: Arial;">
    
    	<!--mail content here start-->
        
        <p>Vendor Information Details</p>
	<br>    
	<p>Username :'.$data['vendorDtls']['username'].'</p>
	<br>
	<p>Password :'.$data['vendorDtls']['rem_password'].'</p>
	<br>
	<p>Vendor URL :'.base_url().'admin/home/login/'.'<br><br>
	
	
	
	<!--mail content here end-->
    </div>
   
 
    <div style="height: 0; line-height: 0; clear: both;"></div>
    <div style="width: 100%; height: 114px; margin: 0; font-family: Arial;">
    	<div style="width: 100%; height: 20px; background: #34363a; color: #989BA2; font-size: 12px; padding: 15px 0; font-family: Arial;">
        	<ul style="padding: 0; margin: 0 auto; display: table;">
            	<li style="padding: 0; margin: 0; list-style-type: none; float: left;"><a href="'.site_url('home/page/aboutus').'" style="color: #989BA2;">About</a></li>
                <li style="padding: 0; margin: 0 5px; list-style-type: none; float: left; color: #989BA2;"> | </li>
                <li style="padding: 0; margin: 0; list-style-type: none; float: left;"><a href="'.site_url('home/page/privacy').'" style="color: #989BA2;">Privacy</a></li>
                <li style="padding: 0; margin: 0 5px; list-style-type: none; float: left; color: #989BA2;"> | </li>
                <li style="padding: 0; margin: 0; list-style-type: none; float: left;"><a href="'.site_url('home/page/terms_condition').'" style="color: #989BA2;">Terms and Condition</a></li>
                <li style="padding: 0; margin: 0 5px; list-style-type: none; float: left; color: #989BA2;"> | </li>
                <li style="padding: 0; margin: 0; list-style-type: none; float: left;"><a href="'.site_url('home/page/support').'" style="color: #989BA2;">Support</a></li>
                <li style="padding: 0; margin: 0 5px; list-style-type: none; float: left; color: #989BA2;"> | </li>
                <li style="padding: 0; margin: 0; list-style-type: none; float: left;"><a href="'.site_url('home/page/contactus').'" style="color: #989BA2;">Contact Us</a></li>
            </ul>
        </div>
    	<div style="width: 100%; height: 64px; background: #1c1d1f; color: #989BA2;font-family: Arial; font-size: 12px; line-height: 64px; text-align: center;"> &copy;2014 Cardsleaf. All rights reserved </div>
    </div>
</div>
';
		    
		    $config['mailtype'] = "html";
		    $this->email->initialize($config);
		    
		    //To send the mail with CI mail lib:
		    $this->email->from($admin_mail, $admin_name);
		    $this->email->to($email); 
		    $this->email->subject($subject);
		    $this->email->message($user_message);	
		    $this->email->send();
		// +++++++++++++++++++++++++++++ Mail Section ++++++++++++++++++++++++++++++++++++++++++++++++++++
		}
		else{
		    $this->session->set_userdata('forgot_msg', 'Email is not found in Database. Please check your email.');
		}
	    redirect("admin/home/vendorlist");
	    
	}
		
}
?>
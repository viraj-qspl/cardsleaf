<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account extends CI_Controller 
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('musers');
		$this->load->model('member');
		$this->load->model('mcountry');
		
		$this->load->theme('frontend');	
		//$this->output->enable_profiler(TRUE);
		
		$this->load->helper('auth');
		$this->load->helper('cookie');
		$this->load->library('pagination');
		$this->load->library('image_lib');
		
		//$this->gallery_path = realpath(APPPATH . '../media/user_profile');
	}
	
	public function activate()
	{
		$user_id = base64_decode($this->uri->segment(3));
		
		$this->musers->activateStatus($user_id);
		
		if(!isMemberLoggedIn())
		{
			redirect("home/signin");
		}
		else
		{
			redirect("cards/upload_picture");
		}
		
		$data['userData'] = $this->musers->getUserDtls($user_id);
		$data['userImgData'] = $this->musers->getUserImgDtls($user_id);
		$data['userPrimaryImg'] = $this->musers->getUserPrimaryImg($user_id);
		
		$this->session->set_userdata('user_id', $user_id);
		$this->session->set_userdata('username', $data['userData']["username"]);
				
		$data["site_title"] = 'Profile';
		$this->load->view('profile', $data);
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	public function edit_pro()
	{
		if(!isMemberLoggedIn())
		{
			redirect("home/index");
		}
		$data['userData'] = $this->musers->getUserDtls($this->session->userdata('user_id'));
		
		if($this->input->server('REQUEST_METHOD')=== 'POST'){
			$this->session->set_userdata('username', $this->input->post('username'));
			$this->session->set_userdata('location_msg', 'You successfully updated your Basic Info.');
			
			$this->member->editUser($this->session->userdata('user_id'));
			redirect("account/location");
		}
		
		
		$data["site_title"] = 'Edit Profile';
		$this->load->view('profile_edit', $data);
		
	}
	
	public function location()
	{
		if(!isMemberLoggedIn())
		{
			redirect("home/index");
		}
		$data['userData'] = $this->musers->getUserDtls($this->session->userdata('user_id'));
		$data["allCountry"] = $this->mcountry->getCountry();
		$data["state_country"] = $this->mcountry->getprovinceBycountry($data['userData']['country_id']);
		
		
		if($this->input->server('REQUEST_METHOD')==='POST')
		{
			$this->session->set_userdata('location_msg', 'You successfully updated Your Location.');
			$this->member->editUserLocation($this->session->userdata('user_id'));
			redirect("account/about");
		}
		
			
		$data["site_title"] = 'Edit Location';
		$this->load->view('profile_location_edit', $data);
	}
	
	public function about()
	{
		if(!isMemberLoggedIn())
		{
			redirect("home/index");
		}
		$data['userData'] = $this->musers->getUserDtls($this->session->userdata('user_id'));
				
		if($this->input->server('REQUEST_METHOD')==='POST')
		{
			$this->session->set_userdata('about_msg', 'You successfully updated your About You section.');
			$this->member->editUserAbout($this->session->userdata('user_id'));
			redirect("account/gallery");
		}
		
			
		$data["site_title"] = 'Edit Location';
		$this->load->view('profile_about_edit', $data);
	}
	
	public function gallery()
	{
		if(!isMemberLoggedIn())
		{
			redirect("home/index");
		}
		$data['userData'] = $this->musers->getUserDtls($this->session->userdata('user_id'));
		$data['allImages'] = $this->musers->getUserImgDtls($this->session->userdata('user_id'));
		
				
		if($this->input->server('REQUEST_METHOD')==='POST')
		{
			$ques_image = '';
			if($_FILES['imgfile']['name']!="")
			{
				$ques_image = $this->do_upload('imgfile','user_profile','180','180');
				
				if($ques_image=="error")
				{
					redirect("account/gallery");
				}
			}
			
			$primary = $this->member->checkPrimary($this->session->userdata('user_id'));
			$this->member->addUserImage($this->session->userdata('user_id'),$ques_image,$primary);			
			$this->session->set_userdata('location_msg', 'You successfully updated your photo.');
			
			redirect("account/gallery");
		}
			
		$data["site_title"] = 'Photo Gallery';
		$this->load->view('profile_photo_edit', $data);
	}
	
	function do_upload($field_name,$folder,$width,$height)
	{
		$_FILES['image']['name']	= $_FILES[$field_name]['name'];
		$_FILES['image']['type']    	= $_FILES[$field_name]['type'];
		$_FILES['image']['tmp_name'] 	= $_FILES[$field_name]['tmp_name'];
		$_FILES['image']['error']       = $_FILES[$field_name]['error'];
		$_FILES['image']['size']    	= $_FILES[$field_name]['size'];   			
		
		$config['upload_path'] = './media/'.$folder.'/large/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_size']	= '1000000';
		$config['max_width']  = '2048';
		$config['max_height']  = '2000';
		
		
		$this->load->library('upload', $config);
		
		if ( ! $this->upload->do_upload('image'))
		{
			$error = array('error' => $this->upload->display_errors());
			$this->session->set_userdata('location_msg',  $this->upload->display_errors());
			
			$product_image = 'error';
			return $product_image;		
		}
		
		else
		{
			$data = array('upload_data' => $this->upload->data('image'));
			$unique_file_name = uniqid();
			$new_imgname = $unique_file_name.'-'.$_FILES['image']['name'];
			$new_imgpath = $data["upload_data"]['file_path'].$new_imgname;
			rename($data["upload_data"]['full_path'], $new_imgpath);
			$product_image = $new_imgname;				
			
			$config['width'] = $width;
			$config['height'] = $height;
			
			$config['maintain_ratio'] = TRUE;
			$config['source_image'] = './media/'.$folder.'/large/'.$unique_file_name.'-'.$_FILES['image']['name'];
			$config['new_image'] = './media/'.$folder.'/thumb180/thumb_'.$unique_file_name.'-'.$_FILES['image']['name'];
			
			$this->image_lib->initialize($config); 
			$this->image_lib->resize();
			
			if ( ! $this->image_lib->resize())
			{
				$this->session->set_userdata('location_msg',  $this->image_lib->display_errors());
				
			}
			
			
			$this->image_lib->clear();
			
			$config['width'] = 124;
			$config['height'] = 107;
			
			$config['maintain_ratio'] = TRUE;
			$config['source_image'] = './media/'.$folder.'/large/'.$unique_file_name.'-'.$_FILES['image']['name'];
			$config['new_image'] = './media/'.$folder.'/thumb/thumb_'.$unique_file_name.'-'.$_FILES['image']['name'];
			
			$this->image_lib->initialize($config); 
			$this->image_lib->resize();
			
			if ( ! $this->image_lib->resize())
			{
				$this->session->set_userdata('location_msg',  $this->image_lib->display_errors());
				
			}
			
			
			
			
		}			
		return $product_image;		
	}
		
	public function makePrimary()
	{
		if(!isMemberLoggedIn())
		{
			redirect("home/index");
		}
		$user_image_id = $this->uri->segment(3);
		
		$this->member->makeSecondary($this->session->userdata('user_id'));
		$this->member->makePrimary($user_image_id);
		
		
		$this->session->set_userdata('location_msg', 'You successfully Change your primary photo.');
		redirect("account/gallery");
	}
	
	public function delPhoto()
	{
		if(!isMemberLoggedIn())
		{
			redirect("home/index");
		}
		$user_image_id = $this->uri->segment(3);
		
		$imageDtls = $this->member->getUserImgByImgid($user_image_id);
		if($imageDtls)
		{
			@unlink("./media/user_profile/large/".$imageDtls['image_name']);
			@unlink("./media/user_profile/thumb180/thumb_".$imageDtls['image_name']);
			@unlink("./media/user_profile/thumb/thumb_".$imageDtls['image_name']);
		}
		
		$this->member->deletePhoto($user_image_id);
		$primary = $this->uri->segment(4);
		if($primary){
			$this->member->editNextprimary($this->session->userdata('user_id'));
		}
		
		$this->session->set_userdata('location_msg', 'You successfully delete photo sucessfully.');
		redirect("account/gallery");
	}
	
	
}

?>
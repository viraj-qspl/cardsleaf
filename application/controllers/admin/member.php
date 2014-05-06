<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class member extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/membermodel');
		$this->load->model('admin/common_methods');
		$this->load->model('musers');
		$this->load->theme('admintheme');
		$this->load->helper('auth');
		$this->load->library('pagination');
		$this->load->library('image_lib');
		$this->load->helper('download');
		
	}
	

	public function index()
	{
		if(!isAdminLoggedIn())
		{
			redirect("admin/home/login");
		}
		
                $config["base_url"] = base_url()."admin/member/index";
                $config["per_page"] = 20;
                $config["uri_segment"] = 4;
				$config['num_links'] = 10;
		
                $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
                $config["total_rows"] = $this->membermodel->allmemberinfo_count();
		
                $this->pagination->initialize($config);
		
		$data["total_rows"] = $config["total_rows"];
		$data["allmemberinfo"] = $this->membermodel->allmemberinfo($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();		

		$data['site_title'] = 'Member Order List';
		$this->load->view('member', $data);
	}
	
	function change_status()
	{
		$id = $this->uri->segment(4); 
		$status = $this->uri->segment(5); 
		
		$this->membermodel->change_status($id,$status);
		$this->session->set_userdata('success_msg', 'Register Member status changed successfully.');
		redirect('admin/member/index');
	}
	
	public function dnimg()
	{
		$img = $this->uri->segment(4);
		$ext = '.'.end(explode(".",$img));
		
		$data = file_get_contents(base_url()."media/cards_image/large/".$img); // Read the file's contents
		$name = time().$ext;
		
		force_download($name, $data); 	
	}
	
	public function dnpdf()
	{
		$pdffile = $this->uri->segment(4);
		//$ext = '.'.end(explode(".",$pdffile));
		
		$data = file_get_contents(base_url()."media/cards_image/pdf/".$pdffile); // Read the file's contents
		//$name = time().$ext;
		
		force_download($pdffile, $data); 	
	}
	
	public function dnzip()
	{
		
		$time = time();
		
		$zip = new ZipArchive();
		
		$imageId = explode('.',$this->uri->segment(4));
		$imageId = $imageId[0];
		$receiverDetails = $this->musers->receiverInfo($imageId);
		
		$imageName = explode('.',$receiverDetails['image0']);

		$fileName = $this->config->item('base_path').'media/temp'.$time.'.zip';
		
		if ($zip->open($fileName, ZipArchive::CREATE)!==TRUE) {
				exit("cannot open <$filename>\n");
		}	
		
		$details = 'Name:'.$receiverDetails['name'].' '.$receiverDetails['lname'].PHP_EOL
						   .'Delivery Date:'.$receiverDetails['delivery_dt'].PHP_EOL
						   .'Country:'.$receiverDetails['cname'].PHP_EOL
						   .'Address:'.$receiverDetails['reciver_add1'].' '.$receiverDetails['reciver_add2'].PHP_EOL
						   .'State:'.$receiverDetails['sname'].PHP_EOL
						   .'City:'.$receiverDetails['city'].PHP_EOL
						   .'Zip:'.$receiverDetails['zipcode'].PHP_EOL
						   .'Contact Number:'.$receiverDetails['contactno'].PHP_EOL;
						
						
				$zip->addFromString("ReceiverDetails.txt",$details);
				$zip->addFile($this->config->item('base_path').'media/cards_image/large/'.$receiverDetails['image0'],"image.".end($imageName));
				$zip->addFile($this->config->item('base_path').'media/cards_image/pdf/'.$imageId.'_card.pdf',"layout.pdf");
				$zip->close();
		
				$data = file_get_contents(base_url()."media/temp".$time.".zip");
				
				
				unlink($this->config->item('base_path').'media/temp'.$time.'.zip');
				force_download($this->uri->segment(4),$data);	
		
		
		/*
		$zipfile = $this->uri->segment(4);
		//$ext = '.'.end(explode(".",$img));
		
		$data = file_get_contents(base_url()."media/cards_image/zip/".$zipfile); // Read the file's contents
		//$name = time().$ext;		
		
		force_download($fileName, $data); 
		*/
		
	}
	
	 public function dnimg1()
	{
		/* $img = $this->uri->segment(4);
		$ext = '.'.end(explode(".",$img));
		
		$data = file_get_contents(base_url()."media/cards_image/large/".$img); // Read the file's contents
		$name = time().$ext;
		
		force_download($name, $data); */ 	
	} 
	
	public function dnpdf1()
	{
		$pdffile = $this->uri->segment(4);
		//$ext = '.'.end(explode(".",$pdffile));
		
		$pdffile = explode('_',$pdffile);
		
		$pdffile = $pdffile[0].'.pdf';

		$data = file_get_contents(base_url()."media/pics/pdf/".$pdffile); // Read the file's contents
		//$name = time().$ext;
		
		force_download($pdffile, $data); 	
	}
	
	public function dnzip1()
	{
		
		$time = time();
		
		$zip = new ZipArchive();
		
		$imageId = explode('.',$this->uri->segment(4));
		$imageId = $imageId[0];
		$receiverDetails = $this->musers->finishedPictureInfo($imageId);
		
		
		

		$fileName = $this->config->item('base_path').'media/temp/temp'.$time.'.zip';

		
		if ($zip->open($fileName, ZipArchive::CREATE)!==TRUE) {
				exit("cannot open <$filename>\n");
		}	
		
	
		
		$details = 'Name:'.$receiverDetails[0]['name'].' '.$receiverDetails[0]['lname'].PHP_EOL
						   .'Delivery Date:'.$receiverDetails[0]['delivery_dt'].PHP_EOL
						   .'Country:'.$receiverDetails[0]['cname'].PHP_EOL
						   .'Address:'.$receiverDetails[0]['reciver_add1'].' '.$receiverDetails[0]['reciver_add2'].PHP_EOL
						   .'State:'.$receiverDetails[0]['sname'].PHP_EOL
						   .'City:'.$receiverDetails[0]['city'].PHP_EOL
						   .'Zip:'.$receiverDetails[0]['zipcode'].PHP_EOL
						   .'Contact Number:'.$receiverDetails[0]['contactno'].PHP_EOL;
						
						
				$zip->addFromString("ReceiverDetails.txt",$details);
				
				foreach($receiverDetails as $key=>$value)
				{
					$imageName = explode('.',$value['image_name']);
					$zip->addFile($this->config->item('base_path').'media/pics/'.$value['image_name'],"image".$key.".".end($imageName));
				}
				
				$zip->addFile($this->config->item('base_path').'media/pics/pdf/'.$imageId.'.pdf',"layout.pdf");
				
				$zip->close();
		
				$data = file_get_contents(base_url()."media/temp/temp".$time.".zip");
				
				
				unlink($this->config->item('base_path').'media/temp/temp'.$time.'.zip');
				force_download($this->uri->segment(4),$data);	
		
		
		/*
		$zipfile = $this->uri->segment(4);
		//$ext = '.'.end(explode(".",$img));
		
		$data = file_get_contents(base_url()."media/cards_image/zip/".$zipfile); // Read the file's contents
		//$name = time().$ext;		
		
		force_download($fileName, $data); 
		*/
		
	}
		
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	function carddispatch()
	{
		
		if(!isAdminLoggedIn())
		{
			redirect("admin/member/index/");
		}
		
		//print_r($this->uri->segments);
		
		$memberid = $this->uri->segment(4); 
		$cardid = $this->uri->segment(5);
		
		$this->membermodel->dispatchCardByMemberId($memberid,$cardid);
		
		redirect('admin/member/index');
		
	}
	
	


	
	
	
	public function edit()
	{		
		if(!isAdminLoggedIn())
		{
			redirect("admin/home/login");
		}
		
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{
		    $user_profile_photo = '';
			if($_FILES['user_profile_photo']['name']!="")
			{
				unlink('./uploads/member_photo/large/'.$this->input->post('hid_user_profile_photo'));
				unlink('./uploads/member_photo/thumb/'.$this->input->post('hid_user_profile_photo'));
				$user_profile_photo = $this->do_upload('user_profile_photo','member_photo');
			}
			else
			{
				$user_profile_photo = $this->input->post('hid_user_profile_photo');
			}
			$this->membermodel->editmember($user_profile_photo);
			$this->session->set_userdata('success_msg', 'Register Member updated successfully.');
		}
		
		//$data['country_list'] = $this->common_methods->countrylist();
		//$data['traveller_type_list'] = $this->membermodel->travellerlist();
		//$data['program_list'] = $this->membermodel->programlist();
		
		$id = $this->uri->segment(4); 
		if($id) $data['user_info']=$this->membermodel->getMemberById($id);
		
		$data['site_title'] = 'Cardsleaf | Admin Edit Register Member';
		$this->load->view('edit_member', $data);
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	function add()
	{
		if(!isAdminLoggedIn())
		{
			redirect("admin/home/login");
		}
		
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{
		    $user_profile_photo = '';
			if($_FILES['user_profile_photo']['name']!="")
			{
				$user_profile_photo = $this->do_upload('user_profile_photo','member_photo');
			}
			$this->membermodel->addmember($user_profile_photo);
			$this->session->set_userdata('success_msg', 'Member added successfully.');
		}
		
		$data['country_list'] = $this->common_methods->countrylist();
		$data['traveller_type_list'] = $this->membermodel->travellerlist();
		$data['program_list'] = $this->membermodel->programlist();

		$data['site_title'] = 'HoneyMoneyMingle | Admin Add Member';
		$this->load->view('add_member', $data);
	 }
	 
	 
	function do_upload($field_name,$folder)
	{
		$_FILES['image']['name']		= $_FILES[$field_name]['name'];
		$_FILES['image']['type']    	= $_FILES[$field_name]['type'];
		$_FILES['image']['tmp_name'] 	= $_FILES[$field_name]['tmp_name'];
		$_FILES['image']['error']       = $_FILES[$field_name]['error'];
		$_FILES['image']['size']    	= $_FILES[$field_name]['size'];   			
		
		$config['upload_path'] = './uploads/'.$folder.'/large/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '1000000';
		$config['max_width']  = '4000';
		$config['max_height']  = '4000';
		
		$this->load->library('upload', $config);
		
		if ( ! $this->upload->do_upload('image'))
		{
			$error = array('error' => $this->upload->display_errors());
			$this->session->set_userdata('error_msg',  $this->upload->display_errors());
			$user_profile_photo = 'error';
		}
		else
		{
			$data = array('upload_data' => $this->upload->data('image'));
			$unique_file_name = uniqid();
			$new_imgname = $unique_file_name.'-'.$_FILES['image']['name'];
			$new_imgpath = $data["upload_data"]['file_path'].$new_imgname;
			rename($data["upload_data"]['full_path'], $new_imgpath);
			$user_profile_photo = $new_imgname;				
			
			$config['width'] = 220;
			$config['height'] = 220;
			$config['maintain_ratio'] = TRUE;
			$config['source_image'] = './uploads/'.$folder.'/large/'.$unique_file_name.'-'.$_FILES['image']['name'];
			$config['new_image'] = './uploads/'.$folder.'/thumb/'.$unique_file_name.'-'.$_FILES['image']['name'];
			
			$this->image_lib->initialize($config); 
			$this->image_lib->resize();

			if ( ! $this->image_lib->resize())
			{
				echo $this->image_lib->display_errors();
			}
		}			
		return $user_profile_photo;		
	}
	
	
	
	
	
	
	
}
?>
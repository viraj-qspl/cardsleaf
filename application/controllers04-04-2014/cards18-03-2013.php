<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cards extends CI_Controller 
{
	
public function __construct()
	{
		parent::__construct();
		$this->load->model('musers');
		$this->load->model('mcountry');
		
		$this->load->helper('auth');
		$this->load->library('image_lib');
		$this->load->library('Paypal_Lib');
		$this->load->library('pagination');
		
		$this->load->theme('frontend');
		//$this->load->library('ckeditor_helper');
	}
	
	public function layout()
	{
		/*if(!(isMemberLoggedIn()))
		{
		redirect("home/signin");
		}*/
		$this->session->unset_userdata('img_id');
		$this->session->unset_userdata('layout');
		$data["site_title"] = 'Cardsleaf :: Card Layout';
		$this->load->view('card_layout', $data);
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
			
			print_r($error);
			
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

	
	public function create_cards()
	{
	    /*if(!(isMemberLoggedIn()))
	    {
		redirect("home/signin");
	    }*/
	    
	    $imgid = $this->session->userdata('img_id');
	    $userid = $this->session->userdata('user_id');
	    
	    if($imgid != NULL)
		{
			$data['recentImgDtls'] = $this->musers->getrecentImage($imgid,$userid);
		}
	   
	   //print_r($data['recentImgDtls']);
	    $data["site_title"] = 'Cardsleaf :: Create card';
	    $this->load->view('create_cards', $data);
	}
	
	public function setmsg()
	{
		if(!(isMemberLoggedIn()))
		{
			redirect("home/signin");
		}
		
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{
			$card_msg = $this->input->post('cardmsg');
			$imgid = $this->session->userdata('img_id');
			$userid = $this->session->userdata('user_id');
			
			if($card_msg != '' && $imgid != NULL)
			{
			$this->musers->setCardMsg($card_msg,$imgid,$userid);
			
			redirect("cards/save_cards");
			}
			else
			{
				redirect("cards/create_cards");
			}
		}
	    
	}
	
	public function save_cards()
	{
		if(!(isMemberLoggedIn()))
		{
		redirect("home/signin/".$this->uri->segment(3));
		}
		$data['countryList'] = $this->musers->AllCountry();
		//print_r($data['countryList']);
		
		$userid = $this->session->userdata('user_id');
		$imgid = $this->session->userdata('img_id');
		
		$data['receiver_addDtls'] = $this->musers->getAllAdd($userid);
		
		//print_r($data['receiver_addDtls']);
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{
		     //print_r($this->input->post());die;
			if($this->input->post('keepadd'))
			$this->musers->updateAdd($imgid,$userid);
			
			redirect("subscribe/paypal_pro");
			exit;
			
		}
		
		$data["site_title"] = 'Cardsleaf :: Create card';
                $data['all_state_ind']=$this->mcountry->getStateInd(99);
                
		$this->load->view('save_cards', $data);
	}
	
	public function upload_pictures()
	{
		/*if(!(isMemberLoggedIn()))
		{
		redirect("home/signin");
		}*/
		
		//$userid = $this->session->userdata('user_id');
		$data['size'] = $size = $this->uri->segment(3);
		
		$this->session->set_userdata('layout',$size);
		
		if($this->session->userdata('img_id') != '' ||
		   $this->session->userdata('img_id') != null ||
		   $this->session->userdata('img_id') != 0)
		$card_id = $this->session->userdata('img_id');
		
		if(isset($card_id))
		{
			$data['recentCardDetails'] = $this->musers->getRecentCardImages($card_id);
			
			$data['rquiredWidth'] = $rquiredWidth = 200;
			
			if($data['recentCardDetails']['image0'] != '')
			{
			$img_0 = getimagesize(base_url().'media/cards_image/large/'.$data['recentCardDetails']['image0']);
			
			$data['width_0'] = $width_0 = $img_0[0];
			$data['height_0'] = $height_0 = $img_0[1];
			
			$data['newHeight_0'] = $newHeight_0 = floor($height_0 * ($rquiredWidth / $width_0));
			}
			
			if($data['recentCardDetails']['image2'] != '')
			{
			$img_2 = getimagesize(base_url().'media/cards_image/large/'.$data['recentCardDetails']['image2']);
			
			$data['width_2'] = $width_2 = $img_2[0];
			$data['height_2'] = $height_2 = $img_2[1]; 
			
			$data['newHeight_2'] = $newHeight_2 = floor($height_2 * ($rquiredWidth / $width_2));
			}
			
		}
		
		switch ($size)
		{
			case 57 : $viewpage = 'upload_pictures'; break;
			case 75 : $viewpage = 'upload_picturesl'; break;
			default : redirect("cards/layout/".$size); break;
		}
		
		$data["site_title"] = 'Cardsleaf :: Create card';
		$this->load->view($viewpage, $data);
	}
	
	
	
	
}
?>
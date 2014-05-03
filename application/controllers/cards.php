<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cards extends CI_Controller 
{
	
public function __construct()
	{
		parent::__construct();
		$this->load->model('musers');
		$this->load->model('mcountry');
		$this->load->model('paymentmodel');
		
		$this->load->helper('auth');
		$this->load->library('image_lib');
		$this->load->library('Paypal_Lib');
		$this->load->library('pagination');
		
		$this->load->theme('frontend');
		//$this->load->library('ckeditor_helper');
	}
	
	
	public function selectType()
	{
		
		
		
		if(trim($this->uri->segment(4))!='')
		{
			if($this->uri->segment(4)=='CARD')
				redirect($this->config->item('base_url').'cards/layout');
			elseif($this->uri->segment(4)=='PICTURE')
			{
				$this->session->unset_userdata('pic_id');
				$this->session->unset_userdata('pic_receiver');
				$this->session->unset_userdata('rec_added');
				$this->session->unset_userdata('pic_paid');
				redirect($this->config->item('base_url').'cards/createPicture');
			}	
		}		
		else		
			$this->load->view('selectType');		
				
	
	}
	
	
	public function createPicture()
	{
		
		if($this->session->userdata('pic_id') == '')
			$this->session->set_userdata('pic_id',$this->musers->initPicture());
		else
			$data['picInfo'] = $this->musers->getPicInfo($this->session->userdata('pic_id'));
		
		$data['pic_id'] = $this->session->userdata('pic_id');
		$this->load->view('createPicture',$data);
	
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
		$data['all_state_ind']=$this->mcountry->getStateInd(99);
		
		$userid = $this->session->userdata('user_id');
		$imgid = $this->session->userdata('img_id');
		
		$data['receiver_addDtls'] = $this->musers->getAllAdd($userid);
		
		$data['senderInfo'] = $this->musers->getUserById($userid);
		
		//print_r($data['receiver_addDtls']);
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{
			
			if($data['senderInfo']['packagechoose']!=0 || $data['senderInfo']['packagechoose']!=1 )
			{
				$this->musers->updateAdd($imgid,$userid);
				
				$data['thePackDtls'] = $this->musers->getPackById($data['senderInfo']['packagechoose']);
				$buying_date = $data['senderInfo']['buying_dt'];
				$todaydate = date('Y-m-d');
				$daydiff = (strtotime($todaydate) - strtotime($buying_date)) / (60 * 60 * 24);
				
				if($daydiff > $data['thePackDtls']['pack_duration'] * 30 || $data['senderInfo']['cardsend'] == 0)
				{
					$this->session->set_userdata('pack_exp_msg', 'Your package validity or card limit is over. Please subscribe a package.');
					redirect('package/');
				}
				else
				{
					$this->paymentmodel->update_cards_img_tbl($this->session->userdata('img_id'));
					redirect("subscribe/thankyou");
				}
			}
			else
			{
				redirect("subscribe/paypal_pro");
			}

		}
		
		$data["site_title"] = 'Cardsleaf :: Create card';
                
		$this->load->view('save_cards', $data);
	}
	
	public function savePicture()
	{
			if($this->session->userdata('pic_paid')==1 && $this->session->userdata('rec_added')=='1')
			{
					redirect('/cards/finishedPicture');
			}
			elseif($this->session->userdata('pic_paid')=='' && $this->session->userdata('rec_added')=='1')
			{
				redirect('/subscribe/paypal_pro2');
			}
			elseif($this->session->userdata('pic_paid')=='' && $this->session->userdata('rec_added')=='')
			{
				
				$data['countryList'] = $this->musers->AllCountry();		
				$data['all_state_ind']=$this->mcountry->getStateInd(99);
				$this->load->view('add_receiver',$data);
			}
	
	
	}
	
	public function saveReceiver()
	{
		$data = array();	
		foreach($_POST as $key=>$value)
		{
			
			if($key=='r_state' || $key=='or_state')
				continue;			
			
			if($key=='r_country')
			{
				if($this->input->post('r_country')=='99')
					$state = $this->input->post('r_state');
				else
					$state = $this->input->post('or_state');
					
				$data['state'] = $state;	
			}
			
			$data[$key] = $this->input->post($key);	
		}

		$this->session->set_userdata('rec_added',1);
		$this->session->set_userdata('pic_receiver',$data);
		
		redirect($this->config->item('base_url').'cards/savePicture');

	}
	
	
	public function finishedPicture()
	{
	
		$data['picInfo'] = $this->musers->finishedPictureInfo($this->session->userdata('finpic_id'));
			
		$this->load->view('finalPicture',$data);
	
	
	
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

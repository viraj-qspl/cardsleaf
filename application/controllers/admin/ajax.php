<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax extends CI_Controller 
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('musers');
		$this->load->model('mcountry');
		$this->load->model('mcountry');
		$this->load->model('admin/adminmodel');
		
		$this->load->helper('auth');
		$this->load->helper('cookie');
		$this->load->library('pagination');
		$this->load->library('image_lib');
		$this->load->library('email');
	}	
	
	
	public function gettheadd()
	{
		$imgid = $this->input->post('img');
		$pick_add = $this->musers->gettheaddress($imgid);
		//print_r($pick_add);
		echo json_encode($pick_add, true);
	}
	
	public function setposition()
	{
		$cardid = $this->session->userdata('img_id');;
		$userid = $this->session->userdata('user_id');;
		
		$top = $this->input->post('t');
		$left = $this->input->post('l');
		$forpage = $this->input->post('forpage');
		
		$set_pos = $this->musers->setposition($forpage,$top,$left,$cardid,$userid);
		//print_r($pick_add);
		echo $set_pos;
	}
	
	public function setsize()
	{
		$cardid = $this->session->userdata('img_id');;
		$userid = $this->session->userdata('user_id');;
		
		$width = $this->input->post('w');
		$height = $this->input->post('h');
		$forpage = $this->input->post('forpage');
		
		$set_size = $this->musers->setsize($forpage,$width,$height,$cardid,$userid);
		//print_r($pick_add);
		echo $set_size;
	}
	
	public function set_text()
	{
		$cardid = $this->session->userdata('img_id');
		$userid = $this->session->userdata('user_id');
		
		
		
		if($cardid=='')
		{
			$newId = $this->musers->initCard($userid);
			$this->session->set_userdata('img_id',$newId);
			$cardid = $newId;
		}	
		
		
		$txt = $this->input->post('txt');
		
		$forpage = $this->input->post('forpage');
                
		$set_txt = $this->musers->settxt($forpage,$txt,$cardid,$userid);
		
		$data['recentCardDetails'] = $this->musers->getRecentCardImages($cardid);
		//print_r($pick_add);
		echo json_encode($data, true);
	}
	
        public function set_text_top_left(){
            $cardid = $this->session->userdata('img_id');
            $userid = $this->session->userdata('user_id');
	    $txt_top  = $this->input->post('txt_top');
            $txt_left  = $this->input->post('txt_left');
            $forpage = $this->input->post('forpage');
            //print_r($this->input->post());exit;
	    
            $this->musers->settxtTopLeft($forpage,$cardid,$userid,$txt_top,$txt_left);
	    
            
        }
        
	public function setpositiontext()
	{
		$cardid = $this->session->userdata('img_id');;
		$userid = $this->session->userdata('user_id');;
		
		$top = $this->input->post('t');
		$left = $this->input->post('l');
		$forpage = $this->input->post('forpage');
		
		$set_pos_txt = $this->musers->setpositiontext($forpage,$top,$left,$cardid,$userid);
		//print_r($pick_add);
		echo $set_pos_txt;
	}
	
	public function setsizetext()
	{
		$cardid = $this->session->userdata('img_id');;
		$userid = $this->session->userdata('user_id');;
		
		$width = $this->input->post('w');
		$height = $this->input->post('h');
		$forpage = $this->input->post('forpage');
		
		$set_size = $this->musers->setsizetext($forpage,$width,$height,$cardid,$userid);
		//print_r($pick_add);
		echo $set_size;
	}
	
	public function setfontsize()
	{
		$cardid = $this->session->userdata('img_id');;
		$userid = $this->session->userdata('user_id');;
		
		$fontvalue = $this->input->post('fontvalue');
		$forpage = $this->input->post('forpage');
		
		$set_font_size = $this->musers->setfontsize($forpage,$fontvalue,$cardid,$userid);
		//print_r($pick_add);
		echo $set_font_size;
	}
	
	public function deleteimg()
	{
		$cardid = $this->session->userdata('img_id');
		
		$forpage = $this->input->post('forpage');
		
		$delimg = $this->musers->deleteimg($forpage,$cardid);
		//print_r($pick_add);
		
		$data['recentCardDetails'] = $this->musers->getRecentCardImages($cardid);
		
		echo json_encode($data, true);
	}
	
	public function uploadimg()
	{
		$userid = $this->session->userdata('user_id');
		
		$pageselector = $this->input->post('pageselector');
		$pagesize = $this->input->post('pagesize');
		
		$path = "media/cards_image/large/";
		
		$card_id = $this->session->userdata('img_id');
		if(!empty($card_id) && isset($card_id))
		$oldcard['cardDtls'] = $this->musers->getRecentCardImages($card_id);
		//print_r($oldcard['cardDtls']['image'.$pageselector]); //exit;

		//print_r($_FILES);
		if($this->input->server('REQUEST_METHOD') == "POST") {
			$valid_formats = array("jpg", "jpeg", "png", "gif", "bmp");
			
			$name = $_FILES['image_file']['name'];
			$size = $_FILES['image_file']['size'];
			
			
			
			if(strlen($name)) {
				list($txt, $ext) = explode(".", $name);
				if(in_array(strtolower($ext),$valid_formats)) {
					$size_mb = 4; //allow upto 4MB
					if($size<(1024*1024*$size_mb)) {
						$time = time();
						$actual_image_name = $time.substr(str_replace(" ", "_", $txt), 5).".".$ext;
						$thumb_file_name = $time.substr(str_replace(" ", "_", $txt), 5)."_thumb.".$ext; 
						$tmp = $_FILES['image_file']['tmp_name'];
						
						//delete old image
						if(!empty($cardid)  && isset($cardid))
						{
							@unlink($path.$oldcard['cardDtls']['image'.$pageselector]);
						}
						
						if(move_uploaded_file($tmp, $path.$actual_image_name)) {
						//echo "<img src='".base_url().$path.$actual_image_name."'  class='previewbox'>";
                                                    
                                                    //ratan : 11-03-2014
                                                    list($width, $height, $type, $attr) = getimagesize($path.$actual_image_name);
                                                    
                                                        if($this->session->userdata('layout')==57){
                                                           
                                                            $img_top = intval((504-floor($height*(200 / $width)))/2)."px";
                                                           // $img_top =  floor($height*(200 / $width))."px";
                                                            $img_left= "80px";
                                                        }
                                                        
                                                        if($this->session->userdata('layout')==75){
                                                            //$img_top = intval((360-$height)/2)."px";
                                                            // $img_top =  floor($height*(200 / $width))."px";
                                                             $img_top = intval((360-floor($height*(200 / $width)))/2)."px";
                                                            $img_left= "152px";
                                                        }
                                                        
                                                
							if(trim($card_id)=='')
								$card_id = $this->musers->imgInsert($pageselector,$actual_image_name,$userid,$img_top,$img_left);
							else
								$this->musers->imgUpdate($pageselector,$actual_image_name,$userid,$img_top,$img_left);
						
						//$card_id = $this->musers->imgadd($pageselector,$actual_image_name,$userid);
						
					//	$this->session->set_userdata('error_msg', 'Image successfully uploaded.'); //  User never sees message, so pointless !!
						
						$this->session->set_userdata('img_id', $card_id);
						//echo $card_id;
						//redirect("cards/upload_pictures/".$pagesize);
						//echo $this->session->userdata('img_id'); exit;
						
						/** REZISE code by viraj **/
					
						if($this->session->userdata('layout')==75)
						{
							$thumbWidth = 300 ;
							$thumbHeight = 200;
						}
						else
						{
							$thumbWidth = 300 ;
							$thumbHeight = 400;							
						}
							
						
						$this->generate_image_thumbnail($path.$actual_image_name,'media/cards_image/thumb/'.$thumb_file_name,$thumbWidth,$thumbHeight);

						
						}
						else
						$err = "upload failed";
					}
					else
						$err = "Image file size max 1 MB";
				}
			else
				$err = "Invalid file format. Please select jpg, jpeg, png, gif, bmp";	
				}
				
			else
				echo "Please select image..!";
				
			//echo $actual_image_name;
			$data['recentCardDetails'] = $this->musers->getRecentCardImages($card_id);
			
			$data['rquiredWidth'] = $rquiredWidth = 200;
			
			if($data['recentCardDetails']['image0'] != '')
			{
			$img_0 = getimagesize(base_url().'media/cards_image/large/'.$data['recentCardDetails']['image'.$pageselector]);
			
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
			
			if(isset($err))
			{
			$error['err'] = $err;
			echo json_encode($error, true);
			}
			else
			echo json_encode($data, true);
			exit;
		}
	}
	
	public function generate_image_thumbnail($source_image_path, $thumbnail_image_path,$width,$height)
	{
	
		define('THUMBNAIL_IMAGE_MAX_WIDTH', $width);
		define('THUMBNAIL_IMAGE_MAX_HEIGHT', $height);
		
		
		list($source_image_width, $source_image_height, $source_image_type) = getimagesize($source_image_path);
		switch ($source_image_type) {
			case IMAGETYPE_GIF:
				$source_gd_image = imagecreatefromgif($source_image_path);
				break;
			case IMAGETYPE_JPEG:
				$source_gd_image = imagecreatefromjpeg($source_image_path);
				break;
			case IMAGETYPE_PNG:
				$source_gd_image = imagecreatefrompng($source_image_path);
				break;
		}
		if ($source_gd_image === false) {
			return false;
		}
		$source_aspect_ratio = $source_image_width / $source_image_height;
		$thumbnail_aspect_ratio = THUMBNAIL_IMAGE_MAX_WIDTH / THUMBNAIL_IMAGE_MAX_HEIGHT;
		if ($source_image_width <= THUMBNAIL_IMAGE_MAX_WIDTH && $source_image_height <= THUMBNAIL_IMAGE_MAX_HEIGHT) {
			$thumbnail_image_width = $source_image_width;
			$thumbnail_image_height = $source_image_height;
		} elseif ($thumbnail_aspect_ratio > $source_aspect_ratio) {
			$thumbnail_image_width = (int) (THUMBNAIL_IMAGE_MAX_HEIGHT * $source_aspect_ratio);
			$thumbnail_image_height = THUMBNAIL_IMAGE_MAX_HEIGHT;
		} else {
			$thumbnail_image_width = THUMBNAIL_IMAGE_MAX_WIDTH;
			$thumbnail_image_height = (int) (THUMBNAIL_IMAGE_MAX_WIDTH / $source_aspect_ratio);
		}
		$thumbnail_gd_image = imagecreatetruecolor($thumbnail_image_width, $thumbnail_image_height);
		imagecopyresampled($thumbnail_gd_image, $source_gd_image, 0, 0, 0, 0, $thumbnail_image_width, $thumbnail_image_height, $source_image_width, $source_image_height);
		imagejpeg($thumbnail_gd_image, $thumbnail_image_path, 90);
		
		//imagedestroy($source_gd_image);
		//imagedestroy($thumbnail_gd_image);
		
		return true;
} 
	
	
	
	
	
	
	
	
	
	
	
	public function getreceiverdetails($cardid=false,$echo=true)
	{
		
		if($cardid == false)
			$cardid = $this->input->post('img');
		
		$data['thecardDtls']=$this->musers->receiverInfo($cardid);
	
		if($echo)	
			echo json_encode($data['thecardDtls']);
		else
			return $data['thecardDtls'];
	}
	
	
	public function getVendorbyZone()
	{
		$zone = $this->input->post('zone');
		$data = $this->musers->getVendorbyZone($zone);
		
		echo json_encode($data);
	
	
	}
	
	
	public function dispatchtoVendor()
	{
		$vendorId = $this->input->post('vendorId'); 
		$imageId = $this->input->post('imageId');

		$success = ($this->musers->dispatch($vendorId,$imageId)==0)?false:true;
		
		$vendorInfo = $this->adminmodel->getVendorsByid($vendorId);
		
		$receiverDetails = $this->getreceiverdetails($imageId,false); 
		


		
		if($success) 
		{		
			$message = "<html><head><title></title></head><body>Hello ".$vendorInfo['fname']."<br\>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Please find the attached document to be printed and mailed. The recipient details are as follows:<br\><br\><br\>"	
			
			."<b style='font-size:13px'>First Name</b>: ".$receiverDetails['name']."<br\>" 
			."<b style='font-size:13px'>Last Name</b>: ".$receiverDetails['lname']."<br\>"
			."<b style='font-size:13px'>Delivery Date</b>: ".$receiverDetails['delivery_dt']."<br\>"
			."<b style='font-size:13px'>Country</b>: ".$receiverDetails['cname']."<br\>"
			."<b style='font-size:13px'>Address</b>: ".$receiverDetails['reciver_add1']."<br\>"
			."<b style='font-size:13px'>State</b>: ".$receiverDetails['sname']."<br\>"
			."<b style='font-size:13px'>City</b>: ".$receiverDetails['city']."<br\>"
			."<b style='font-size:13px'>Zip</b>: ".$receiverDetails['zipcode']."<br\>"
			."<b style='font-size:13px'>Contact Number</b>: ".$receiverDetails['contactno']."<br\><br/>Regards<br/>CardsLeaf.com</body></html>";
			
			
			

			$this->email->initialize(array('mailtype'=>'html'));
			$this->email->from('admin@cardsleaf.com', 'Cards Leaf Administrator');
			$this->email->to($vendorInfo['email']); 
			$this->email->subject('Print Order for Card Number:'.$imageId);
			$this->email->message($message);			
			$this->email->attach($this->config->item('base_path').'media/cards_image/zip/'.$imageId.'.zip');
			$this->email->send();
			

		}
		
		
		
		echo json_encode(array('success'=>$success));
		
	
		
	
	
	}
	
	
	public function print_d()
	{
		$cardid = $this->input->post('img');
		
		$data['thecardDtls']=$this->musers->receiverInfo($cardid);
		
		$this->load->view('details', $data);
		
		//redirect('admin/member/index');
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	public function showState()
	{
		$county_id = $this->input->post('county_id');
		$data["state_country"] = $this->mcountry->getprovinceBycountry($county_id);
		
		$this->load->view('frontend/stateShowdp',$data);
	}
	
	
	
	public function checkuser()
	{
		$username = $this->input->post('username');
		$val = $this->musers->checkUser($username);
		echo $val;
	}
	public function checkemail()
	{
		$email = $this->input->post('email');
		$val = $this->musers->checkEmail($email);
		echo $val;
	}
	
	//public function add_friends()
	//{
	//	$from_id = $this->input->post('from_id');
	//	$to_id = $this->input->post('to_id');
	//	$val = $this->msearch->checkAddFriend($from_id,$to_id);
	//	if($val){
	//		echo 0;
	//	}
	//	else{
	//		$this->msearch->addFriend($from_id,$to_id);
	//		echo 1;
	//	}
	//}
	
	public function add_favorite()
	{
		$from_id = $this->input->post('from_id');
		$to_id = $this->input->post('to_id');
		$this->msearch->addFavorite($from_id,$to_id);
	}
	function showregion(){
		$county_id = $this->input->post('id');
		$data["state_country"] = $this->mcountry->getprovinceBycountry($county_id);
		$this->load->view('frontend/region',$data);
	}
	function usersearch(){
		//if(!isMemberLoggedIn()){
			//redirect("home/signin");
			//exit;
		//}
		$this->session->set_userdata('search_sex', $_POST["sex"]);
		$this->session->set_userdata('search_seek', $_POST["seeking"]);
		$this->session->set_userdata('search_age_from', $_POST["age_from"]);
		$this->session->set_userdata('search_age_to', $_POST["age_to"]);
		$this->session->set_userdata('search_country', $_POST["country"]);
		$this->session->set_userdata('search_state', $_POST["state"]);
		exit;
	}
	
	public function print_($cardid)
	{
		$data['thecardDtls']=$this->musers->receiverInfo($cardid);
		
		header("Content-type: application/vnd.ms-word");
		header("Content-Disposition: attachment;Filename=newsletter.doc");
		
		echo $this->load->view('frontend/details', $data,true); 	
	}
	
}

?>
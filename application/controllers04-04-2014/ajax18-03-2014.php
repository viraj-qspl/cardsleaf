<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax extends CI_Controller 
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('musers');
		$this->load->model('mcountry');
		
		
		$this->load->helper('auth');
		$this->load->helper('cookie');
		$this->load->library('pagination');
		$this->load->library('image_lib');
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
		
		$txt = $this->input->post('txt');
		
		$forpage = $this->input->post('forpage');
                
		$set_txt = $this->musers->settxt($forpage,$txt,$cardid,$userid);
		
		$data['recentCardDetails'] = $this->musers->getRecentCardImages($cardid);
		//print_r($pick_add);
		echo json_encode($data, true);
	}
	
         // ratan:11-03-2014
        public function set_text_top_left(){
            $cardid = $this->session->userdata('img_id');
            $userid = $this->session->userdata('user_id');
	    $txt_top  = $this->input->post('txt_top');
            $txt_left  = $this->input->post('txt_left');
           
           
		
               $this->musers->settxtTopLeft($cardid,$userid,$txt_top,$txt_left);
            
            
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
				if(in_array($ext,$valid_formats)) {
					if($size<(1024*1024)) {
						$actual_image_name = time().substr(str_replace(" ", "_", $txt), 5).".".$ext;
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
                                                        
                                                        

						$card_id = $this->musers->imgInsert($pageselector,$actual_image_name,$userid,$img_top,$img_left);
						//$card_id = $this->musers->imgadd($pageselector,$actual_image_name,$userid);
						
						$this->session->set_userdata('error_msg', 'Image successfully uploaded.');
						$this->session->set_userdata('img_id', $card_id);
						//echo $card_id;
						//redirect("cards/upload_pictures/".$pagesize);
						//echo $this->session->userdata('img_id'); exit;
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
}

?>
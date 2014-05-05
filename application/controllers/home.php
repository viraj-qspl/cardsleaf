<?php ini_set('memory_limit', '2560M');
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller 
{	
	public function __construct()
	{
	    parent::__construct();
	    $this->load->model('musers');
	    $this->load->model('mcountry');
	    $this->load->theme('frontend');	
	    //$this->output->enable_profiler(TRUE);
	    $this->load->helper('auth');
	    $this->load->helper('cookie');
	    $this->load->library('pagination');
	    $this->load->library('image_lib');
	    $this->load->library('facebook');
	}
	
	public function index()
	{
	    if(isMemberLoggedIn()) 
	    {

		/*if($this->session->userdata('pic_id')!='')
			redirect($this->config->item('base_url').'cards/createPicture');
		 else */
			redirect("cards/selectType");
		
		
	    }
	    $data["allCountry"] = $this->mcountry->getCountry();
	    $data["site_title"] = 'Cardsleaf';
	    $this->load->view('index', $data);
	}
	
	public function signup()
	{
	    if(isMemberLoggedIn())
	    {
	       redirect("cards/selectType");
	    }
		$data["site_title"] = 'Sign Up';
		//$data["allCountry"] = $this->mcountry->getCountry();
	    if($this->input->server('REQUEST_METHOD') === 'POST')
	    {
		$email = trim($this->input->post('email'));
		$password = trim($this->input->post('password'));
		
		$val_email = $this->musers->checkEmail($email);
		
		$size = $this->session->userdata('layout');
		if($size) {
			if($size == $this->uri->segment(3))
				$getsize = $this->session->userdata('layout');
		}
		else
			$getsize = '';
		
		if($val_email==1)
		{
		    $this->session->set_userdata('success_msg', 'Email id already exists. Please enter another email.');
		    redirect("home/signup/".$getsize);
		}
		else{
			// Register user database
			$user_id = $this->musers->adduser($email,$password); //exit;
			
			$data = $this->musers->checklogin($email,$password);
			$this->session->set_userdata('user_id', $data["user_id"]);
			$this->session->set_userdata('username', $data["email"]);
			$this->session->set_userdata('login_mode', 'site');
			
    
			if($user_id != '')
			{
				$this->session->set_userdata('success_msg', 'User register sucessfully.');
				redirect("home/signin/".$getsize);
			}
		}
		
	    }
		
		$data["site_title"] = 'Cardsleaf :: SignUP';
		$this->load->view('signup', $data);
	}
	
	public function signin()
	{
	   $data['size'] = $this->uri->segment(3) ? $this->uri->segment(3) : '';
	   
	   
	  
	   
	   if(isMemberLoggedIn())
	    {		
			//redirect("cards/upload_pictures/".$data['size']);
			redirect("cards/selectType/");
	    }
	    
	    $data["site_title"] = 'Cardsleaf :: SignIn';
	    $this->load->view('signin', $data);
	}
	
	public function login()
	{
		$gdata['size'] = $this->uri->segment(3) ? $this->uri->segment(3) : '';
		//echo ($this->session->userdata('img_id') && $this->session->userdata('img_id')!='');exit;
	   
	   if(isMemberLoggedIn())
	    {
			if($this->session->userdata('img_id') && $this->session->userdata('img_id')!='')
				redirect("cards/upload_pictures/".$gdata['size']);
			elseif($this->session->userdata('pic_id') && $this->session->userdata('pic_id')!='')
			{
				redirect("cards/createPicture/");
			}
			else
				redirect("cards/selectType"); //redirect("cards/layout/".$gdata['size']);		
	    }
	   
	   if ($this->input->server('REQUEST_METHOD') === 'POST')
	    { 
		    $email = $this->input->post('username');
		    $password = $this->input->post('password');
		    if($this->musers->checklogin($email,$password))
		    {
			$data = $this->musers->checklogin($email,$password);
			if($data == 1)
			{
				$this->session->set_userdata('error_msg_login', 'Password incorrect.');
			}
			else
			{
			$this->session->set_userdata('user_id', $data["user_id"]);
			$this->session->set_userdata('username', $data["email"]);
			$this->session->set_userdata('packitem', $data["packagechoose"]);
			$this->session->set_userdata('login_mode', 'site');
			$img_id = $this->session->userdata('img_id');
                        
                        if(!empty($img_id) && $img_id>0)
                        {
                            $this->musers->updateImgUser($img_id);
                        }
			}
			
			
			
			if($this->session->userdata('packageback'))
			{
			
			$url = html_entity_decode($this->session->userdata('packageback'));
			$this->session->unset_userdata('packageback');
			redirect($url);
			}
			else
			{
				redirect("home/signin/".$gdata['size']);
			}
			
		    }
		    else
		    {
			$this->session->set_userdata('error_msg_login', 'Email does not exist.');
			redirect("home/signin/".$gdata['size']);
		    }
	    }
	}
	
	public function forgot_pass()
	{
	    if(isMemberLoggedIn())
	    {
		redirect("cards/upload_picture");
	    }
	    if($this->input->server('REQUEST_METHOD') === 'POST')
	    {
		$email = trim($this->input->post('email'));
		$usr_dtls = $this->musers->checkEmailExists($email);
		if($usr_dtls!=0)
		{
		    $this->session->set_userdata('forgot_msg', 'Please check your email to change your password.');
		    // +++++++++++++++++++++++++ Mail Section +++++++++++++++++++++++++++++++++++++
		    $admin_mail = ADMIN_MAIL;
		    $admin_name = 'Cardsleaf';
		    $subject = 'Reset your password.';
		    
		    $user_message = '<div style="width: 596px; margin: 0 auto; overflow: hidden; border: 2px solid #00d8ff; font-family: Arial;">
	<div style="width: 100%; height: 28px;  padding: 10px 0;
	background: url('.$this->config->item('theme_url').'images/header_bg.png) center bottom repeat-x;">
    	<div style=" width: 134px; margin: 0 auto; display: block;"><a href="#"><img src="'.$this->config->item('theme_url').'images/logo3.png" width="134" height="19" style="display: block;"/></a></div>
    </div>
    <div style="height: 0; line-height: 0; clear: both;"></div>
    
    
    <div style="width: 93.5%; padding: 15px 20px; margin: 0; font-family: Arial;">
    
    	<!--mail content here start-->
        
        <p>Thank you for retrive your password!</p>
	<br>    
	<p><a href="'.base_url().'home/change_pass_edit/'.base64_encode($usr_dtls['user_id']).'">Change Password.</a></p>
	<br>  	    
	If you are unable to open the hyperlink above, copy and paste the following URL into your internet browser (if the link is split into two lines, be sure to copy both lines): <br><br>'.base_url().'home/change_pass_edit/'.base64_encode($usr_dtls['user_id']).'
	
	
	
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
		    $this->email->to($usr_dtls['email']); 
		    $this->email->subject($subject);
		    $this->email->message($user_message);	
		    $this->email->send();
		// +++++++++++++++++++++++++++++ Mail Section ++++++++++++++++++++++++++++++++++++++++++++++++++++
		}
		else{
		    $this->session->set_userdata('forgot_msg', 'Email is not found in Database. Please check your email.');
		}
	    redirect("home/forgot_pass");
	    }
	    $data['site_title'] = 'Forgot Password';
	    $this->load->view('forgot_password', $data);
	}
	
	public function change_pass_edit()
	{
	    if(isMemberLoggedIn())
	    {
		redirect("cards/upload_picture");
	    }
	    $user_id = base64_decode($this->uri->segment(3));
	    
	    if($this->input->server('REQUEST_METHOD') === 'POST')
	    {
		$this->musers->changePassword($user_id);
		$this->session->set_userdata('error_msg_login', 'Password changed successfully.');
		redirect("home/signin");					
	    }
	    $data['site_title'] = 'Forgot Password';
	    
	    $this->load->view('new_forgot_password', $data);
	}
	
	
	function facebook_login()
	{  	
		$gdata['size'] = $this->uri->segment(3) ? $this->uri->segment(3) : '';
		
		$user=$this->facebook->getUser();
		//echo '<pre>';print_r($user);exit;
		if ($user) 
		{ 	            
			try{ 
		 		$user_profile = $this->facebook->api('/'.$user);   
		  	} 
			catch (FacebookApiException $e) { echo 'exception'; }			
			//echo '<pre>';
			//print_r($user_profile);exit;
			if(isset($user_profile))
			{	
				
			    $fid=$user_profile['id'];
			    $username=$user_profile['username'];
			    $mail=$user_profile['email'];
			    $first_name=$user_profile['first_name'];
			    $last_name=$user_profile['last_name'];
			    if($user_profile['gender']=="male")
			    {
				$gender  ='M';
			    }
			    else{
				$gender  ='F';
			    }
			   if(isset($user_profile['birthday'])){
				    $birthday_format=explode("/",$user_profile['birthday']);
				    $birthday = $birthday_format[2]."-".$birthday_format[1]."-".$birthday_format[0];
			    }
			    else
				    $birthday='';
				    
			    $this->session->set_userdata(array("access_token"=>$this->facebook->getAccessToken()));
			    $num=$this->musers->check_facebookduplicate($mail,$fid);
				
			    if($num==0)
			    {                          						  				   
				$this->musers->add_facebookduplicate($mail,$fid);
				$user_id = $this->musers->addUserByFb($mail,$first_name,$last_name,$gender,$birthday);
				$this->session->set_userdata('user_id', $user_id);
				$this->session->set_userdata('username', $mail);
				$this->session->set_userdata('login_mode', 'facebook');
				//redirect("home/index");
				redirect("home/signin/".$gdata['size']);
				exit;
			    }
			    else
			    {
				// Get Login info
				$fbuser = $this->musers->getFbUser($mail);
				$this->session->set_userdata('user_id', $fbuser['user_id']);
				$this->session->set_userdata('username', $fbuser['email']);
				$this->session->set_userdata('login_mode', 'facebook');
				//redirect("home/index");
				redirect("home/signin/".$gdata['size']);
				exit;
	    							   
			    }   				
			    $data['login_in'] =$this->facebook->getLogoutUrl();
		 	}
		}
		else 
		{ 				
			//Extended Permissions requested from the API at time of login
			
			//  $auth_config['req_perms'] = 'email,user_birthday,status_update,publish_stream,user_photos,user_videos';
			$auth_config['scope'] = 'email,read_stream,publish_stream,user_birthday,user_location,user_work_history,user_hometown,user_photos'; 
			//'email,user_birthday,status_update,publish_stream,user_photos,user_videos,create_event,rsvp_event,friends_events,profile_picture';
			
			
			//Dialog Form Factors used to display login page
			
			$auth_config['display'] = 'popup';
			
			//Callback URL once user is authenticated
			
			$auth_config['next'] = base_url();
			
			//Get the login URL using the parameters in $auth_config array
			$data['login_url'] = $this->facebook->getLoginUrl($auth_config);            
			//redirect("home/index");
			redirect("home/signin/".$gdata['size']);
			exit;			

		}
	}
	
	
	function logout()
	{		
		if($this->session->userdata('login_mode')=="facebook")
		{
			$facebook = new Facebook(array(
				'appId' => '452380914883929',
				'secret' => 'aeb3aab7180f27f7027e1f9f49266975',
			));
	    
			//$token = $facebook->getAccessToken();
			$url = 'https://www.facebook.com/logout.php?next=http://www.cardsleaf.com/&access_token='.$this->session->userdata('access_token');
					
			
			$this->session->unset_userdata('user_id');
			$this->session->unset_userdata('img_id');
			$this->session->unset_userdata('username');
			$this->session->unset_userdata('login_mode');
			$this->session->unset_userdata('layout');
			$this->session->unset_userdata('packitem');
			$this->session->unset_userdata('packageback');
			
			$this->session->sess_destroy();
			redirect($url);
		}
		else
		{
			$this->session->unset_userdata('user_id');
			$this->session->unset_userdata('img_id');
			$this->session->unset_userdata('username');
			$this->session->unset_userdata('login_mode');
			$this->session->set_userdata('success_msg', 'Log in again!');
			$this->session->unset_userdata('layout');
			$this->session->unset_userdata('packitem');
			$this->session->unset_userdata('packageback');
			
			redirect("home/signin");
		}
		
	}
	
	function pdf()
        {
			
	     require_once(realpath(APPPATH."helpers/dompdf")."/dompdf_config.inc.php");
             //chmod("./media/cards_image/pdf/32_3.pdf",0777);
	     
	     $data['size'] = $size = $this->session->userdata('layout');
	     
	     switch ($size)
		{
			case 57 : $viewpage = 'create_pdf_v'; break;
			case 75 : $viewpage = 'create_pdf_h'; break;
		}
		
		
	     
	    //$pdf_html = '';
	    $receiveremail = base64_decode($this->uri->segment(3));
		
		
		 $userid = $this->session->userdata('user_id');
	       
	       $data['theUserDtls'] = $this->musers->getUserById($userid);
		
	       $imgid = $this->session->userdata('img_id');
		   
		   
	    /*  
		  $sendingcard = $this->musers->downloadcount($userid,$imgid);       //Code moved to subscribe/thankyou() - Reduce count after 'Buy' 
	     
	      if($sendingcard)
	      {
			$restcard = $data['theUserDtls']['cardsend'] - $sendingcard ;
		
			$restcard = ($restcard < 0) ? 0 : $restcard;
		
			$this->musers->cardsell($userid,$restcard);
		
	      }
	    */
		
		
		

		

	    if($this->input->server('REQUEST_METHOD') === 'POST')
	    { 
			
			
			
	       $pdf_html = $this->input->post('pdf_html'); //exit;
	       $pdf_html1 = $this->input->post('pdf_html1');
	       $pdf_html2 = $this->input->post('pdf_html2');
		   
		   
		   
		  preg_match_all("/<img .*?(?=src)src=\"([^\"]+)\"/si", $pdf_html, $m);		  
		  $imageName = str_replace($this->config->item('base_url').'/media/cards_image/large/','',$m[1][0]);		  
		  $imageExp = explode(".",$imageName);		  
		  $ext = end($imageExp);		  
		  unset($imageExp[count($imageExp)-1]);		  
		  $imageName = implode('.',$imageExp).'_thumb.'.$ext;		  
		  
		  
		  
		  $newImage = $this->config->item('base_url').'/media/cards_image/thumb/'.$imageName;

		   
		  
		   
		   /** PDF CREATION CODE START **/
		   
			if($viewpage == 'create_pdf_v')
			{
				
				$pdf_html = str_replace($m[1][0],$newImage,$pdf_html);
				
				$pdf_html = str_replace('<div style="border: 1px solid #979797; left: 8px;top: 34px;display: block;height: 504px;overflow: hidden;position: relative;width: 360px; margin:0; position: relative;">','<div style="border: 1px solid #979797; left: 8px;top: 34px;display: block;height: 504px;overflow: hidden;position: relative;width: 360px; margin:auto; position: relative;">',$pdf_html);
				
				
				
				$pdf_html1 = str_replace('<div style="border: 1px solid #979797; left: 8px;top: 34px;display: block;height: 504px;overflow: hidden;position: relative;width: 360px; margin:0; position: relative;">','<div style="border: 1px solid #979797; left: 8px;top: 34px;display: block;height: 504px;overflow: hidden;position: relative;width: 360px; margin:auto; position: relative;">',$pdf_html1);
				
				
				$pdf_html1 = preg_replace('/<div id="txt2"(.*)>/','<div style="position:relative;top:242px;">',$pdf_html1);
				$pdf_html1 = preg_replace('/<div id="img_txt2"(.*)>/','<div style="height:auto;text-align:center;font-size:16px;">',$pdf_html1);

				
				$pdf_html2 = preg_replace('/<div style="border: 1px solid #979797; left: 3px;top: 30px;display: block;height: 504px;overflow: hidden;position: relative;width: 360px; margin:0; position: relative;">/','<div style="border: 1px solid #979797; left: 8px;top: 34px;display: block;height: 504px;overflow: hidden;position: relative;width: 360px; margin:auto; position: relative;">',$pdf_html2);
				
				$pdf_html2 = str_replace('<div id="marker" style="background: none repeat scroll 0 0 #FFFFFF; display: block; height: auto; margin: 365px auto 0; text-align: center; width: 135px;">','<div id="marker" style="background: none repeat scroll 0 0 #FFFFFF; display: block; height: auto; margin: auto ; text-align: center; width:98%;position:relative;top:40%;">',$pdf_html2);
			}
			elseif($viewpage == 'create_pdf_h')
			{
				
				
				$imageDetails = getimagesize($newImage);
				$paddingTop = ((360-$imageDetails[1])/2) - 25;
				$paddingLeft =((504-$imageDetails[0])/2) - 35;
				
				
				
				$temp = strstr($pdf_html,'<img');				
				if($temp)
				{
					$pdf_html = strstr($temp,'>',true);
					$pdf_html = $pdf_html.'/>';
					$pdf_html = str_replace('img','img style="position:relative;display:block;top:'.$paddingTop .';left:'.$paddingLeft .'"',$pdf_html);
					
					
				}
				

				
				
				$pdf_html = str_replace($m[1][0],$newImage,$pdf_html);
				
			
				
				$pdf_html1 = strip_tags($pdf_html1);
	
				$temp = strstr($pdf_html2,'<div id="marker"');				
				if($temp)
					$pdf_html2 = strstr($temp,'>',true);
					
					$pdf_html2 = $pdf_html2.'><div id="logo" style="margin:auto;"><a><img src="'.$this->config->item('theme_url').'images/logo.png" border="0" alt="" /></a></div>
                     <div id="link" style="margin:auto;" ><a>www.cardsleaf.com</a></div></div>'	;
	
					$pdf_html = '<div id="wrapper" style="width:504px;height:360px;border:1px solid black;margin:auto;"><div style="position:relative;top:0px;left:0px;width:504px;height:360px">'.$pdf_html.'</div><div style="clear:both"></div></div>'; 
					
					$pdf_html1 = '<div id="wrapper" style="width:504px;height:360px;border:1px solid black;margin:auto;position:relative;top:50px;"><div style="top:180px;position:relative;text-align:center;">'.$pdf_html1.'</div></div>'; 
					
					$pdf_html2 = '<div id="wrapper" style="width:504px;height:360px;border:1px solid black;margin:auto;position:relative;">'.$pdf_html2.'</div>'; 
					
					$pdf_html2 = str_replace('<div id="marker" style="background: none repeat scroll 0 0 #FFFFFF; display: block; height: auto; margin: 270px auto 0; text-align: center; width: 135px;">','<div id="marker" style="margin:auto;text-align:center;position:relative;top:28%;">',$pdf_html2);

				
					
			
			}
			

			
			$pdf_content = $pdf_html.$pdf_html1.$pdf_html2;
			
			

				   		   
		   /** PDF CREATION CODE END **/
	       
	       $img_id = $this->session->userdata('img_id');
	       
	       $this->load->helper(array('dompdf', 'file'));
	       
	       /*
	       //write pdf file for page1
	       $html = $pdf_html;
	       
	       $data = pdf_create($html, '', false);
	       write_file('./media/cards_image/pdf/'.$img_id.'_1.pdf', $data);
	       
	       //write pdf file for page2
	       $html1 = $pdf_html1;
	       
	       $data1 = pdf_create($html1, '', false);
	       write_file('./media/cards_image/pdf/'.$img_id.'_2.pdf', $data1);
	       
	       //write pdf file for page3
	       $html2 = $pdf_html2;
	       
	       $data2 = pdf_create($html2, '', false);
	       write_file('./media/cards_image/pdf/'.$img_id.'_3.pdf', $data2);*/
	       
	       
	       //write one pdf file
			$pdf_content = $pdf_html.$pdf_html1.$pdf_html2;
		 
		//  exit;
		   
		   //echo $pdf_content;exit;
		   
	       $data_allpage = pdf_create($pdf_content, '', false);
	       write_file('./media/cards_image/pdf/'.$img_id.'_card.pdf', $data_allpage);
	       
		   $path = "media/cards_image/pdf/";
	       $zippath = "media/cards_image/zip/";
	       //$file_names = array(''.$img_id.'_1.pdf',''.$img_id.'_2.pdf',''.$img_id.'_3.pdf');
	       
	     //  $file_names = array(''.$img_id.'_card.pdf','10_card.pdf');
			 $file_names = array(''.$img_id.'_card.pdf');
		 
	       $archive_file_name = $zippath.$img_id.".zip";
	       $this->zipFilesAndDownload($file_names,$archive_file_name,$path);
	       
	       $admin_mail = $this->config->item('admin_email');
	       $admin_name = 'Cardsleaf';
	       $subject = 'Card PDF Download';
	       
	       
	       /*
	        $user_message = 'Download : <br><br>
	       <a href="'.base_url().'media/cards_image/pdf/'.$img_id.'_1.pdf">'.base_url().'media/cards_image/pdf/'.$img_id.'_1.pdf</a><br>
	       <a href="'.base_url().'media/cards_image/pdf/'.$img_id.'_2.pdf">'.base_url().'media/cards_image/pdf/'.$img_id.'_2.pdf</a><br>
	       <a href="'.base_url().'media/cards_image/pdf/'.$img_id.'_3.pdf">'.base_url().'media/cards_image/pdf/'.$img_id.'_3.pdf</a><br>
	       ';
	       */
	       
	       $user_message = 'Download Card: <br><br>
	       <a href="'.base_url().'media/cards_image/pdf/'.$img_id.'_card.pdf">'.base_url().'media/cards_image/pdf/'.$img_id.'_card.pdf</a><br>
	       ';
	       
	       $config['mailtype'] = "html";
	       $this->email->initialize($config);
	       
	       //To send the mail with CI mail lib:
	       $this->email->from($admin_mail, $admin_name);
	       $this->email->to($this->session->userdata('username'));
	       //$this->email->to('unified.subhrajyoti@gmail.com');
	       $this->email->subject($subject);
	       $this->email->message($user_message);	
	       $this->email->send();
	       
	      
	      if($receiveremail)
	      {
	       $this->email->from($admin_mail, $admin_name);
	       $this->email->to($receiveremail); 
	       //$this->email->to('unified.subhrajyoti@gmail.com');
	       $this->email->subject($subject);
	       $this->email->message($user_message);	
	       $this->email->send();
	      }
	      
	      
	     
	      
	      
	      
	      
	      //$data["ctrl"] = $this->input->post('ctrl');
	      //$this->session->set_userdata('ctrl', $this->input->post('ctrl'));
	      //$data["site_title"] = 'Cardsleaf :: Create card';
	      //redirect("home/pdf/57");
	    }
	     
	     $data['size'] = $size = $this->uri->segment(3);
		
		if($this->session->userdata('img_id') != '' ||
		   $this->session->userdata('img_id') != null ||
		   $this->session->userdata('img_id') != 0)
		$card_id = $this->session->userdata('img_id');
	     
	     if(isset($card_id))
		{
			$data['recentCardDetails'] = $this->musers->getRecentCardImages($card_id);
			
			//echo "<pre>";
			//print_r($data['recentCardDetails']);
			
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
	
	     $data["site_title"] = 'Cardsleaf :: Create card';
		 
		
	     
	     if(isset($viewpage))
	     $this->load->view($viewpage, $data);
	     else
	     redirect("cards/layout/");
	}
	
	function page()
	{
		
		$page = $this->uri->segment(3);
		
		
		$data['cms'] = $this->musers->getcms($page);
		
		$data["site_title"] = 'Cardsleaf :: '.$data['cms']['page_name'];
		$this->load->view('cms_details', $data);
	}
	
	
	function zipFilesAndDownload($file_names,$archive_file_name,$file_path)
	{
	    $zip = new ZipArchive();
	    //create the file and throw the error if unsuccessful
	    if ($zip->open($archive_file_name, ZIPARCHIVE::CREATE )!==TRUE) {
		exit("cannot open <$archive_file_name>\n");
	    }
	    //add each files of $file_name array to archive
	    foreach($file_names as $files)
	    {
		  $zip->addFile($file_path.$files,$files);
		//echo $file_path.$files,$files."<br>";
	    }
	    $zip->close();
	    
		$file_name = $archive_file_name;
		$file_path = "".$file_name;

		header("Pragma: public");
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header("Cache-Control: public");
		header("Content-Description: File Transfer");
		header("Content-Type: application/zip");
		$content_disposition = "Content-disposition: attachement; filename=\"".$file_name."\"";
		header($content_disposition);
		header("Content-Transfer-Encoding: binary");
		header("Content-Length: ".filesize($file_path));
		$f = @fopen($file_path,"rb");
		while(!feof($f)){
		    print(fread($f, 1024*8));
		    flush();
		}
		@fclose($f);	
	    
	    //exit;
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	function do_upload($field_name,$folder,$width,$height)
	{
		$_FILES['image']['name']	= $_FILES[$field_name]['name'];
		$_FILES['image']['type']    	= $_FILES[$field_name]['type'];
		$_FILES['image']['tmp_name'] 	= $_FILES[$field_name]['tmp_name'];
		$_FILES['image']['error']       = $_FILES[$field_name]['error'];
		$_FILES['image']['size']    	= $_FILES[$field_name]['size'];   			
		
		$config['upload_path'] = './media/'.$folder.'/large/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '1000000';
		$config['max_width']  = '2048';
		$config['max_height']  = '2000';
		
		$this->load->library('upload', $config);
		
		//print_r($_FILES['imgfile']);
		//echo $_FILES['image']['name'];
		if ( ! $this->upload->do_upload('image'))
		{
			$error = array('error' => $this->upload->display_errors());
			$this->session->set_userdata('error_msg',  $this->upload->display_errors());
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
			
			$config['maintain_ratio'] = FALSE;
			$config['source_image'] = './media/'.$folder.'/large/'.$unique_file_name.'-'.$_FILES['image']['name'];
			$config['new_image'] = './media/'.$folder.'/thumb/thumb_'.$unique_file_name.'-'.$_FILES['image']['name'];
		
			$this->image_lib->initialize($config); 
			$this->image_lib->resize();

			if ( ! $this->image_lib->resize())
			{
				echo $this->image_lib->display_errors();
			}
		}			
		
		
		return $product_image;		
	}
	
}

/* end of file home.php*/
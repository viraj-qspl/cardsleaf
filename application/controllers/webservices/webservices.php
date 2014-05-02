<?php ini_set('memory_limit', '2560M');
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Webservices extends CI_Controller 
{	
	public function __construct()
	{
	    parent::__construct();
	    $this->load->model('musers');
	    $this->load->model('mcountry');
	    $this->load->theme('frontend');	
	    $this->load->helper('auth');
	    $this->load->helper('cookie');
	    $this->load->library('pagination');
	    $this->load->library('image_lib');
	    $this->load->library('facebook');
		$this->load->library('services_json');	
		$this->load->library('simple_image');
		$this->load->model('paymentmodel');
		$this->load->library('common_obj'); //user defined class	
	}
	
	public function index()
	{
	    if(isMemberLoggedIn()) 
	    {
		 redirect("cards/layout");
	    }
	    $data["allCountry"] = $this->mcountry->getCountry();
	    $data["site_title"] = 'Cardsleaf';
	    $this->load->view('index', $data);
	}

	/*
	* function login to handle user login request
	* @param: email password
	* @return: array of userdata
	* @since: 11th April 2014 	
	*/
 	public function login()
	{	
		//instantiate JSON obj
		$json = new $this->services_json;
		$commonObj = new $this->common_obj;
		
		//retrive headers sent from iphone device
		$headers = $commonObj->getFormattedHeaders();
				
		if(!isset($headers['email_id']) || (isset($headers['email_id']) && $headers['email_id'] == '')){
			echo base64_encode(json_encode(array("response" =>array("errorCode"=>'1','errorMsg'=>"Please enter valid email id"))));
			exit;
		}else{
			$email = $headers['email_id'];
		}

		if(!isset($headers['password']) || (isset($headers['password']) && ($headers['password'] == '' || $headers['password'] == "(null)" ))){
			echo base64_encode(json_encode(array("response" =>array("errorCode"=>'2','errorMsg'=>"Please enter password")))); 
			exit;
		}else{
			$password = $headers['password'];			
		}
		
 		if($this->musers->validateUserLogin($email,$password))
			{ 
				$data = $this->musers->validateUserLogin($email,$password);
				//Send UserDetails array to iphone device
				echo base64_encode(str_replace('\\/', '/',$json->encode(array("response" =>array("errorCode"=>'0','errorMsg' => "",'respCount' => '1','respData' => $data,'cardPayment'=>'1.2')))));
				exit;			
			}else{					 
				echo base64_encode(json_encode(array("response" =>array("errorCode"=>'4','errorMsg'=>"Invalid login details")))); 
				exit;			
		}
	}
	
	/*
	* 
	*/
	public function signUp(){
		
		//instantiate JSON obj
		$json = new $this->services_json;
		$commonObj = new $this->common_obj;
		//retrive headers sent from iphone device
		$headers = $commonObj->getFormattedHeaders();
		
		if(!isset($headers['email_id']) || (isset($headers['email_id']) && $headers['email_id'] == '')){
			echo base64_encode(json_encode(array("response" =>array("errorCode"=>'1','errorMsg'=>"Empty Email address field"))));
			exit;
		}else{
			$email = $headers['email_id'];
		}

		if(!isset($headers['password']) || (isset($headers['password']) && ($headers['password'] == '' || $headers['password'] == "(null)" ))){
			echo base64_encode(json_encode(array("response" =>array("errorCode"=>'2','errorMsg'=>"Empty Password field")))); 
			exit;
		}else{
			$password = $headers['password'];			
		}
		
		$val_email = $this->musers->checkEmail($email);
		
		if($val_email){
			echo base64_encode(json_encode(array("response" =>array("errorCode"=>'3','errorMsg'=>"Email id already exists. Please enter another email.")))); 
			exit;	
		}else{
			$user_id = $this->musers->adduser($email,$password);
			
			if($user_id != ''){
				echo base64_encode(json_encode(array("response" =>array("errorCode"=>'0','errorMsg'=>"User registered sucessfully.")))); 
				exit;
			}else{
				echo base64_encode(json_encode(array("response" =>array("errorCode"=>'5','errorMsg'=>"Error in registering user.")))); 
				exit;
			}			
		}
	}
	
	/*
	*
	*/
	public function imageUpload(){
		//instantiate JSON obj
		$json = new $this->services_json;
		$commonObj = new $this->common_obj;
		//retrive headers sent from iphone device
		$headers = $commonObj->getFormattedHeaders();
				
		define('LARGE_PICTURE_PATH','media/pictures_image/large/');
		define('THUMB_PICTURE_PATH','media/pictures_image/thumb/');	

		if(isset($headers['picture_text'])){
			$picture_text = $headers['picture_text'];
		}else{
			$picture_text = '';
		}
		$user_id = '';
		if(!isset($headers['user_id']) || (isset($headers['user_id']) && ($headers['user_id'] == ''))){
			echo base64_encode(json_encode(array("response" =>array("errorCode"=>'2','errorMsg'=>"Please enter user id")))); 
			exit;
		}else{
			$user_id = $headers['user_id'];
		}
	
		$image = $_FILES['image_pic']['name'];
				
		if(isset($_FILES['image_pic']['name']) && $_FILES['image_pic']['name'] != null) 
		{	
				
		$up = move_uploaded_file($_FILES['image_pic']['tmp_name'], LARGE_PICTURE_PATH.$image);
		if($up) {				
				$imagephoto = new simple_image();
				$imagephoto->load(LARGE_PICTURE_PATH.$image);
				$imagephoto->resizeToWidth(80);
				$imagephoto->resizeToHeight(80);
				$filename = stripslashes($image);				
				list($txt, $ext) = explode(".", $filename);
				$filename = time().substr(str_replace(" ", "_", $txt), 5).".".$ext;				
				
				@unlink(THUMB_PICTURE_PATH.$filename);
				$imagephoto->save(THUMB_PICTURE_PATH.$filename);
								
				$resultUpload = $this->musers->imgPictureInsert($filename,$user_id,$picture_text);
				
				if($resultUpload){
					$uploadError = "Image ".$image." uploaded successfully"; 				
					echo base64_encode(json_encode(array ('response' => array('errorCode' =>'0', 'respMsg'=> $uploadError,'respCount' => 1))));
					exit;			
				}else{			
					$uploadError = "Error is Inserting image "; 
					echo base64_encode(json_encode(array ('response' => array('errorCode' =>'4', 'respMsg'=> $uploadError,'respCount' => 1))));
					exit;
				}
		}else{
				echo base64_encode(json_encode(array ('response' => array('errorCode' =>'5', 'respMsg'=> 'Image cannot be uploaded','respCount' => 1))));
				exit;
		}
	}else{
		echo base64_encode(json_encode(array ('response' => array('errorCode' =>'6', 'respMsg'=> 'No Image found','respCount' => 1))));
		exit;
	}	
	}
	
	/*
	*
	*/
	function checkSubscription(){
		//instantiate JSON obj
		$json = new $this->services_json;
		$commonObj = new $this->common_obj;
		//retrive headers sent from iphone device
		$headers = $commonObj->getFormattedHeaders();

		if(!isset($headers['user_id']) || (isset($headers['user_id']) && ($headers['user_id'] == '' || $headers['user_id'] == "(null)" ))){
			echo base64_encode(json_encode(array("response" =>array("errorCode"=>'1','errorMsg'=>"User id cannot be blank")))); 
			exit;
		}else{
			$user_id = $headers['user_id'];			
		}
		
		$data['senderInfo'] = $this->musers->getUserById($user_id);
		
		if(!$data['senderInfo']){
			echo base64_encode(json_encode(array("response" =>array("errorCode"=>'2','errorMsg'=>"User does not exist")))); 
			exit;
		}
		
		if($data['senderInfo']['packagechoose']!=0 || $data['senderInfo']['packagechoose']!=1 ){
			$data['thePackDtls'] = $this->musers->getPackById($data['senderInfo']['packagechoose']);
			
			$buying_date = $data['senderInfo']['buying_dt'];
			$todaydate = date('Y-m-d');
			$daydiff = (strtotime($todaydate) - strtotime($buying_date)) / (60 * 60 * 24);
			
			if($daydiff > $data['thePackDtls']['pack_duration'] * 30 || $data['senderInfo']['cardsend'] == 0){
				echo base64_encode(json_encode(array("response" =>array("errorCode"=>'4','errorMsg'=>"Your package validity or card limit is over. Please subscribe a package.")))); 
				exit;
			}else{
				echo base64_encode(json_encode(array("response" =>array("errorCode"=>'0','errorMsg'=>"Valid subcription")))); 
				exit;
			}
		}else{
			echo base64_encode(json_encode(array("response" =>array("errorCode"=>'4','errorMsg'=>"User is not subcribed to any package")))); 
			exit;
		}		
	}
	
	function PPHttpPost($methodName_, $nvpStr_) {
        $environment = 'sandbox';

        // Set up your API credentials, PayPal end point, and API version.
        $API_UserName = urlencode('rajkumar.unified_api1.gmail.com');
        $API_Password = urlencode('1390894151');
        $API_Signature = urlencode('An5ns1Kso7MWUdW4ErQKJJJ4qi4-Adiv9IMir4Z0B8hNCRO7x5s7K.TV');
        $API_Endpoint = "https://api-3t.paypal.com/nvp";
        if ("sandbox" === $environment || "beta-sandbox" === $environment) {
            $API_Endpoint = "https://api-3t.$environment.paypal.com/nvp";
        }
        $version = urlencode('51.0');

        // Set the API operation, version, and API signature in the request.
        $nvpreq = "METHOD=$methodName_&VERSION=$version&PWD=$API_Password&USER=$API_UserName&SIGNATURE=$API_Signature$nvpStr_";
        // Set the curl parameters.
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $API_Endpoint);
        curl_setopt($ch, CURLOPT_VERBOSE, 1);
        // Turn off the server and peer verification (TrustManager Concept).
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);

        // Set the request as a POST FIELD for curl.
        curl_setopt($ch, CURLOPT_POSTFIELDS, $nvpreq);

        // Get response from the server.
        $httpResponse = curl_exec($ch);
        //echo "<pre>";
        //print_r($httpResponse);exit;
        if (!$httpResponse) {
            exit("$methodName_ failed: " . curl_error($ch) . '(' . curl_errno($ch) . ')');
        }
        // Extract the response details.
        $httpResponseAr = explode("&", $httpResponse);
        $httpParsedResponseAr = array();
        foreach ($httpResponseAr as $i => $value) {
            $tmpAr = explode("=", $value);
            if (sizeof($tmpAr) > 1) {
                $httpParsedResponseAr[$tmpAr[0]] = $tmpAr[1];
            }
        }
        if ((0 == sizeof($httpParsedResponseAr)) || !array_key_exists('ACK', $httpParsedResponseAr)) {
            exit("Invalid HTTP Response for POST request($nvpreq) to $API_Endpoint.");
        }
        return $httpParsedResponseAr;
    }
	
	function makePayment() {
		
		//instantiate JSON obj
		$json = new $this->services_json;
		$commonObj = new $this->common_obj;
		//retrive headers sent from iphone device
		$headers = $commonObj->getFormattedHeaders();
		
		if(!isset($headers['card_type']) || (isset($headers['card_type']) && ($headers['card_type'] == '' || $headers['card_type'] == "(null)" ))){
			echo base64_encode(json_encode(array("response" =>array("errorCode"=>'1','errorMsg'=>"Please enter card type")))); 
			exit;
		}else{
			$card_type = $headers['card_type'];			
		}
		
		if(!isset($headers['card_number']) || (isset($headers['card_number']) && ($headers['card_number'] == '' || $headers['card_number'] == "(null)" ))){
			echo base64_encode(json_encode(array("response" =>array("errorCode"=>'2','errorMsg'=>"Please enter card number")))); 
			exit;
		}else{
			$card_number = $headers['card_number'];			
		}
				
		if(!isset($headers['expiry_month']) || (isset($headers['expiry_month']) && ($headers['expiry_month'] == '' || $headers['expiry_month'] == "(null)" ))){
			echo base64_encode(json_encode(array("response" =>array("errorCode"=>'3','errorMsg'=>"Please enter expiry month")))); 
			exit;
		}else{
			$expiry_month = $headers['expiry_month'];			
		}
		
		if(!isset($headers['expiry_year']) || (isset($headers['expiry_year']) && ($headers['expiry_year'] == '' || $headers['expiry_year'] == "(null)" ))){
			echo base64_encode(json_encode(array("response" =>array("errorCode"=>'4','errorMsg'=>"Please enter expiry year")))); 
			exit;
		}else{
			$expiry_year = $headers['expiry_year'];			
		}
		
		if(!isset($headers['ccv_number']) || (isset($headers['ccv_number']) && ($headers['ccv_number'] == '' || $headers['ccv_number'] == "(null)" ))){
			echo base64_encode(json_encode(array("response" =>array("errorCode"=>'5','errorMsg'=>"Please enter CCV number")))); 
			exit;
		}else{
			$ccv_number = $headers['ccv_number'];			
		}
		
		$firstName = '';
        $lastName = '';	
		$environment = 'sandbox'; // or 'beta-sandbox' or 'live'
        $creditCardType = urlencode($card_type);
        $creditCardNumber = urlencode($card_number);
        $expDateMonth = urlencode($expiry_month);

        //Month must be padded with leading zero
        $padDateMonth = str_pad($expDateMonth, 2, '0', STR_PAD_LEFT);
        $expDateYear = urlencode($expiry_year);
        $cvv2Number = urlencode($ccv_number);
        $address1 = urlencode('');
        $address2 = urlencode('');
        $city = urlencode('');

        $zip = urlencode('');
        $amount = urlencode('5');
        $country = urlencode('');
        $state = '';
        
        $currencyCode = "USD";
        $paymentType = 'Sale';

        /* Construct the request string that will be sent to PayPal.
          The variable $nvpstr contains all the variables and is a
          name value pair string with & as a delimiter */
        $nvpStr = "&PAYMENTACTION=$paymentType&AMT=$amount&CREDITCARDTYPE=$creditCardType&ACCT=$creditCardNumber" .
                "&EXPDATE=$padDateMonth$expDateYear&CVV2=$cvv2Number&CURRENCYCODE=$currencyCode";
        // Execute the API operation; see the PPHttpPost function above.
        //echo $nvpStr;exit;
        $httpParsedResponseAr = $this->PPHttpPost('DoDirectPayment', $nvpStr);

        $ack = strtoupper($httpParsedResponseAr["ACK"]);
        if ($ack == "SUCCESS") {
			$this->paymentmodel->update_db($this->session->userdata('user_id'), $this->session->userdata('img_id'), $firstName, $lastName, $address1, $address2, $city, $state, $zip, $amount, $country, $httpParsedResponseAr);
		
			echo base64_encode(json_encode(array("response" =>array("errorCode"=>'0','errorMsg'=>"Payment process completed successfully",'transaction_id'=> $httpParsedResponseAr['TRANSACTIONID'])))); 
			exit;
        }else if ($ack != "SUCCESS") {			
			echo base64_encode(json_encode(array("response" =>array("errorCode"=>'6','errorMsg'=> urldecode($httpParsedResponseAr['L_LONGMESSAGE0']))))); 
			exit;
        }
    }
	
	
	/* Card upload function
	*
	*/
	public function cardUpload(){
		//instantiate JSON obj
		$json = new $this->services_json;
		$commonObj = new $this->common_obj;
		//retrive headers sent from iphone device
		$headers = $commonObj->getFormattedHeaders();
				
		define('LARGE_CARD_PATH','media/cards_image/large/');	
		
		if(isset($headers['picture_text'])){
			$card_text = $headers['picture_text'];
		}else{
			$card_text = '';
		}
		$userid = '';
		if(!isset($headers['user_id']) || (isset($headers['user_id']) && ($headers['user_id'] == ''))){
			echo base64_encode(json_encode(array("response" =>array("errorCode"=>'2','errorMsg'=>"Please enter user id")))); 
			exit;
		}else{
			$user_id = $headers['user_id'];
		}		
	
		$size_mb = 4;
		
		if(isset($_FILES['image_pic']['name']) && $_FILES['image_pic']['name'] != null) {
			$name = $_FILES['image_pic']['name'];
			$size = $_FILES['image_pic']['size'];	
			$pageselector = 0;
			if($size<(1024*1024*$size_mb)){
				list($txt, $ext) = explode(".", $name);
				$actual_image_name = time().substr(str_replace(" ", "_", $txt), 5).".".$ext;
				$tmp = $_FILES['image_pic']['tmp_name'];
												
				if(move_uploaded_file($tmp, LARGE_CARD_PATH.$actual_image_name)) {
					list($width, $height, $type, $attr) = getimagesize(LARGE_CARD_PATH.$actual_image_name);
                	$img_top = intval((360-floor($height*(200 / $width)))/2)."px";
                    $img_left= "152px";	
					
					$card_id = $this->musers->imgInsert($pageselector,$actual_image_name,$user_id,$img_top,$img_left);		
							
					$respData['card_id'] = $card_id;					
					$uploadError = "Image ".$name." uploaded successfully"; 				
					
					echo base64_encode(json_encode(array ('response' => array('errorCode' =>'0', 'respMsg'=> $uploadError,'respData' => $respData))));	
					exit;
				}else{
					echo base64_encode(json_encode(array ('response' => array('errorCode' =>'6', 'respMsg'=> 'Image upload failed','respCount' => 1))));
					exit;
				}				
			}else{
				
			}
		}else{
			echo base64_encode(json_encode(array ('response' => array('errorCode' =>'6', 'respMsg'=> 'No Image found','respCount' => 1))));
			exit;
		}		
	} 
	
	/* forgot password webservice
	*
	*
	*/
	public function forgotPassword(){
		//instantiate JSON obj
		$json = new $this->services_json;
		$commonObj = new $this->common_obj;
		//retrive headers sent from iphone device
		$headers = $commonObj->getFormattedHeaders();
		$email = '';
		if(!isset($headers['email_id']) || (isset($headers['email_id']) && ($headers['email_id'] == '' || $headers['email_id'] == "(null)" ))){
			echo base64_encode(json_encode(array("response" =>array("errorCode"=>'1','errorMsg'=>"Please enter email id")))); 
			exit;
		}else{
			$email = $headers['email_id'];			
		}
		
		$usr_dtls = $this->musers->checkEmailExists($email);
		if($usr_dtls!=0)
			{
				$admin_mail = 'Cardsleaf';
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
        
        <p>Thank you for your enquiry!</p>
		<p>Your credential details are as given below!</p>
		<p>Email: '.$usr_dtls['email'].'</p>
		<p>Password: '.$usr_dtls['rem_pass'].'</p>   
	<br>    	 	    
	Also you may change your password by copy and pasting the following URL into your internet browser (if the link is split into two lines, be sure to copy both lines): <br><br>'.base_url().'home/change_pass_edit/'.base64_encode($usr_dtls['user_id']).'
	
	
	
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
		    $result = $this->email->send();	
			if($result){
				echo base64_encode(json_encode(array("response" =>array("errorCode"=>'0','errorMsg'=>"Please check your email for your password information.")))); 
				exit;			
			}			
		}else{
			echo base64_encode(json_encode(array("response" =>array("errorCode"=>'1','errorMsg'=>"Email is not found in Database.")))); 
			exit;		
		}	
		
	}
	
	/*	Delivery details
	*
	*
	*/
	function deliveryDetails(){
		//instantiate JSON obj
		$json = new $this->services_json;
		$commonObj = new $this->common_obj;
		//retrive headers sent from iphone device
		$headers = $commonObj->getFormattedHeaders();
		
		$data = array();
		$flag = '';
		if(!isset($headers['status']) || (isset($headers['status']) && ($headers['status'] == ''))){
			echo base64_encode(json_encode(array("response" =>array("errorCode"=>'13','errorMsg'=>"Please enter flag")))); 
			exit;
		}else{
			$flag = $headers['status'];			
		}
		$name = '';
		if(!isset($headers['name']) || (isset($headers['name']) && ($headers['name'] == '' || $headers['name'] == "(null)" ))){
			echo base64_encode(json_encode(array("response" =>array("errorCode"=>'2','errorMsg'=>"Please enter name")))); 
			exit;
		}else{
			$data['name'] = $headers['name'];
			$name = $headers['name'];
		}
		
		if($flag == '0'){
			$checkDeliveryDetail = $this->musers->checkIfDeliveryDetailExist($name);	

			if($checkDeliveryDetail){
				echo base64_encode(json_encode(array("response" =>array("errorCode"=>'0','errorMsg'=>"Details already stored on server",'respData'=>$checkDeliveryDetail)))); 
				exit;
			}else{
				echo base64_encode(json_encode(array("response" =>array("errorCode"=>'12','errorMsg'=>"Record not found")))); 
				exit;
			}	
		}		
		
		if(!isset($headers['card_id']) || (isset($headers['card_id']) && ($headers['card_id'] == '' || $headers['card_id'] == "(null)" ))){
			echo base64_encode(json_encode(array("response" =>array("errorCode"=>'1','errorMsg'=>"Please enter card id")))); 
			exit;
		}else{
			$data['card_id'] = $headers['card_id'];			
		}
		
		if(!isset($headers['user_id']) || (isset($headers['user_id']) && ($headers['user_id'] == '' || $headers['user_id'] == "(null)" ))){
			echo base64_encode(json_encode(array("response" =>array("errorCode"=>'2','errorMsg'=>"Please enter user id")))); 
			exit;
		}else{
			$data['user_id'] = $headers['user_id'];			
		}
				
		if(!isset($headers['delivery_date']) || (isset($headers['delivery_date']) && ($headers['delivery_date'] == '' || $headers['delivery_date'] == "(null)" ))){
			echo base64_encode(json_encode(array("response" =>array("errorCode"=>'3','errorMsg'=>"Delivery date cannot be blank")))); 
			exit;
		}else{
			$data['delivery_date'] = $headers['delivery_date'];			
		}
		
		if(!isset($headers['country']) || (isset($headers['country']) && ($headers['country'] == '' || $headers['country'] == "(null)" ))){
			echo base64_encode(json_encode(array("response" =>array("errorCode"=>'4','errorMsg'=>"Please enter country")))); 
			exit;
		}else{
			$data['country'] = $headers['country'];			
		}
		
		if(!isset($headers['street_address']) || (isset($headers['street_address']) && ($headers['street_address'] == '' || $headers['street_address'] == "(null)" ))){
			echo base64_encode(json_encode(array("response" =>array("errorCode"=>'5','errorMsg'=>"Please enter street address")))); 
			exit;
		}else{
			$data['street_address'] = $headers['street_address'];			
		}
		
		if(!isset($headers['state']) || (isset($headers['state']) && ($headers['state'] == '' || $headers['state'] == "(null)" ))){
			echo base64_encode(json_encode(array("response" =>array("errorCode"=>'6','errorMsg'=>"Please enter state")))); 
			exit;
		}else{
			$data['state'] = $headers['state'];			
		}
		
		if(!isset($headers['city']) || (isset($headers['city']) && ($headers['city'] == '' || $headers['city'] == "(null)" ))){
			echo base64_encode(json_encode(array("response" =>array("errorCode"=>'7','errorMsg'=>"Please enter city info")))); 
			exit;
		}else{
			$data['city'] = $headers['city'];			
		}
		
		if(!isset($headers['zipcode']) || (isset($headers['zipcode']) && ($headers['zipcode'] == '' || $headers['zipcode'] == "(null)" ))){
			echo base64_encode(json_encode(array("response" =>array("errorCode"=>'8','errorMsg'=>"Please enter zipcode")))); 
			exit;
		}else{
			$data['zipcode'] = $headers['zipcode'];			
		}
		
		if(!isset($headers['contact']) || (isset($headers['contact']) && ($headers['contact'] == '' || $headers['contact'] == "(null)" ))){
			echo base64_encode(json_encode(array("response" =>array("errorCode"=>'9','errorMsg'=>"Delivery date cannot be blank")))); 
			exit;
		}else{
			$data['contact_no'] = $headers['contact'];			
		}
		
		// store this info with respect to card image.
		if($data == ''){
			echo base64_encode(json_encode(array("response" =>array("errorCode"=>'10','errorMsg'=>"Error in submitting details")))); 
			exit;
		}
		$result = $this->musers->updateDeliveryDetails($data);
		
		if($result){
			echo base64_encode(json_encode(array("response" =>array("errorCode"=>'0','errorMsg'=>"Delivery details submitted successfully")))); 
			exit;
		}else{
			echo base64_encode(json_encode(array("response" =>array("errorCode"=>'11','errorMsg'=>"Error in submitting details")))); 
			exit;
		}	
	}
	
	/* Webservice to update user password info
	*
	*
	*/
	function changePassword(){
		//instantiate JSON obj
		$json = new $this->services_json;
		$commonObj = new $this->common_obj;
		//retrive headers sent from iphone device
		$headers = $commonObj->getFormattedHeaders();
		
		if(!isset($headers['user_id']) || (isset($headers['user_id']) && $headers['user_id'] == '')){
			echo base64_encode(json_encode(array("response" =>array("errorCode"=>'1','errorMsg'=>"User id cannot be blank"))));
			exit;
		}else{
			$userid = $headers['user_id'];
		}

		if(!isset($headers['password']) || (isset($headers['password']) && ($headers['password'] == '' || $headers['password'] == "(null)" ))){
			echo base64_encode(json_encode(array("response" =>array("errorCode"=>'2','errorMsg'=>"Empty password field")))); 
			exit;
		}else{
			$password = $headers['password'];			
		}
		
		$resultInfo = $this->musers->getUserById($userid);
		
		if($resultInfo){
			$result = $this->musers->updateUserPassword($userid,$password);
			if($result){
				echo base64_encode(json_encode(array("response" =>array("errorCode"=>'0','errorMsg'=>"Password updated successfully")))); 
				exit;
			}else{
				echo base64_encode(json_encode(array("response" =>array("errorCode"=>'3','errorMsg'=>"Error in updating password")))); 
				exit;
			}
		}else{
			echo base64_encode(json_encode(array("response" =>array("errorCode"=>'4','errorMsg'=>"Invalid user id")))); 
			exit;
		}	
	}
	
	
}
/* end of file webservice.php*/
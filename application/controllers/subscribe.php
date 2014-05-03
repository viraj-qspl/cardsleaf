<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Subscribe extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('musers');
        $this->load->model('mcountry');
        $this->load->model('paymentmodel');

        $this->load->theme('frontend');

        $this->load->helper('auth');
        $this->load->helper('cookie');
        $this->load->library('pagination');
        $this->load->library('image_lib');
		$this->load->library('session');
		
    }

    function paypal_pro() {
        if (!isMemberLoggedIn()) {
            redirect("home/index");
        }
		
	
	
	$data['all_country'] = $this->mcountry->getCountry();
	
	$userid = $this->session->userdata('user_id');
	$data['theUserDtls'] = $this->musers->getUserById($userid);
	
	//echo "<pre>";print_r($data['theUserDtls']); echo "</pre>";
	
	$data['pack'] = $packid = base64_decode($this->uri->segment(3));
	
	
	
	$data['thePackDtls'] = $this->musers->getPackById($packid);
	$data['price'] = $data['thePackDtls']['pack_price'];
	$data['month'] = $data['thePackDtls']['pack_duration'];
	
	$this->session->set_userdata('buyPrice',$data['price']); 	
	
	
	
	
	//echo "<pre>";print_r($data['thePackDtls']); echo "</pre>";
	
	//print_r($this->session->userdata);
	
	//exit;
	
	if($packid==1)
		{
			$totbuyingcard = $data['thePackDtls']['pack_duration'] * $data['thePackDtls']['pack_quantity'];
			
			$this->musers->buypack($packid,$totbuyingcard,$userid);
			
			$this->session->set_userdata('success_msg', 'Package Subscribe Successfully.');
			
			if($this->session->userdata('img_id') == '')
			redirect("cards/layout");
			else
			redirect("cards/save_cards/".$this->session->userdata('layout'));
			
		}
		
        
        $data["site_title"] = 'Pay';

        //$this->session->set_userdata('img_id', 2);

        $data['all_state_us'] = $this->mcountry->getStateInd(223);

        $this->load->view('pay_credit', $data);
    }

    function payment_receipt() {  
	
		$paypalSubmit = $_POST;
		
		$environment = 'sandbox'; // or 'beta-sandbox' or 'live'

        $firstName = urlencode($_POST['firstname']);
        $lastName = urlencode($_POST['lastname']);
        $creditCardType = urlencode($_POST['cardtype']);
        $creditCardNumber = urlencode($_POST['cardnumber']);
        $expDateMonth = urlencode($_POST['cardmonth']);

        // Month must be padded with leading zero
        $padDateMonth = str_pad($expDateMonth, 2, '0', STR_PAD_LEFT);
        $expDateYear = urlencode($_POST['cardyear']);
        $cvv2Number = urlencode($_POST['cardcvv']);
        $address1 = urlencode($_POST['address1']);
        $address2 = urlencode($_POST['address2']);
        $city = urlencode($_POST['city']);

        $zip = urlencode($_POST['zip']);
		
        //$amount = urlencode($_POST['amount']);
		
		$amount = $_POST['crimea']/(800*400); 
		
        $country = urlencode($_POST['select2']);
        if ($country == 'US') {
            $state = $this->input->post('r_state');
        } else {
            $state = $this->input->post('or_state');
        }

        $currencyCode = "USD";
        $paymentType = 'Sale';

        /* Construct the request string that will be sent to PayPal.
          The variable $nvpstr contains all the variables and is a
          name value pair string with & as a delimiter */
        $nvpStr = "&PAYMENTACTION=$paymentType&AMT=$amount&CREDITCARDTYPE=$creditCardType&ACCT=$creditCardNumber" .
                "&EXPDATE=$padDateMonth$expDateYear&CVV2=$cvv2Number&FIRSTNAME=$firstName&LASTNAME=$lastName" .
                "&STREET=$address1&CITY=$city&STATE=$state&ZIP=$zip&COUNTRYCODE=$country&CURRENCYCODE=$currencyCode";
        // Execute the API operation; see the PPHttpPost function above.
        //echo $nvpStr;exit;
        $httpParsedResponseAr = $this->PPHttpPost('DoDirectPayment', $nvpStr);

        //echo "<pre>";print_r($httpParsedResponseAr); exit;

        $ack = strtoupper($httpParsedResponseAr["ACK"]);
		
		
        if ($ack == "SUCCESS") {

			//$this->session->unset_userdata('buyPrice');
            //update status DB
            //echo $this->session->userdata('img_id'); exit;

            $this->paymentmodel->update_db($this->session->userdata('user_id'), $this->session->userdata('img_id'), $firstName, $lastName, $address1, $address2, $city, $state, $zip, $amount, $country, $httpParsedResponseAr);

            $this->paymentmodel->update_cards_img_tbl($this->session->userdata('img_id'));
	    
	    
	    
	    $packid = $_POST['pack'];
	    $data['thePackDtls'] = $this->musers->getPackById($packid);
	    
	    $totbuyingcard = $data['thePackDtls']['pack_duration'] * $data['thePackDtls']['pack_quantity'];
	   
        $userid = $this->session->userdata('user_id');
	    $data['senderInfo'] = $this->musers->getUserById($userid);
	    $totcard = $data['senderInfo']['cardsend'] + $totbuyingcard;
	    
	    $this->musers->buypack($packid,$totcard,$userid);
	    $this->session->set_userdata('success_msg', 'Package Subscribe Successfully.');
	    
	    
			
            redirect("subscribe/thankyou");
        }
        if ($ack != "SUCCESS") {
		
			$this->session->set_userdata('paypalSubmit',$paypalSubmit);
            $this->session->set_userdata('error_msg1', $httpParsedResponseAr);
            redirect("subscribe/paypal_pro");
        }
    }
	
   function paypal_pro2() {
        if (!isMemberLoggedIn()) {
            redirect("home/index");
        }

	$data['all_country'] = $this->mcountry->getCountry();
	
	$userid = $this->session->userdata('user_id');
	$data['theUserDtls'] = $this->musers->getUserById($userid);
	
	
	$data['pic_info'] = $this->musers->getPicInfo($this->session->userdata('pic_id'));
	
	$data['price'] = count($data['pic_info'])*.60;

	$this->session->set_userdata('buyPrice',$data['price']); 	
	
    
        $data["site_title"] = 'Pay';

        $data['all_state_us'] = $this->mcountry->getStateInd(223);

        $this->load->view('pay_credit2', $data);
	
    }
	function payment_receipt2() {  

	$paypalSubmit = $_POST;
	
	$environment = 'sandbox'; // or 'beta-sandbox' or 'live'

	$firstName = urlencode($_POST['firstname']);
	$lastName = urlencode($_POST['lastname']);
	$creditCardType = urlencode($_POST['cardtype']);
	$creditCardNumber = urlencode($_POST['cardnumber']);
	$expDateMonth = urlencode($_POST['cardmonth']);

	// Month must be padded with leading zero
	$padDateMonth = str_pad($expDateMonth, 2, '0', STR_PAD_LEFT);
	$expDateYear = urlencode($_POST['cardyear']);
	$cvv2Number = urlencode($_POST['cardcvv']);
	$address1 = urlencode($_POST['address1']);
	$address2 = urlencode($_POST['address2']);
	$city = urlencode($_POST['city']);

	$zip = urlencode($_POST['zip']);
	
	//$amount = urlencode($_POST['amount']);
	
	$amount = $_POST['crimea']/(800*400); 
	
	$country = urlencode($_POST['select2']);
	if ($country == 'US') {
		$state = $this->input->post('r_state');
	} else {
		$state = $this->input->post('or_state');
	}

	$currencyCode = "USD";
	$paymentType = 'Sale';

	/* Construct the request string that will be sent to PayPal.
	  The variable $nvpstr contains all the variables and is a
	  name value pair string with & as a delimiter */
	$nvpStr = "&PAYMENTACTION=$paymentType&AMT=$amount&CREDITCARDTYPE=$creditCardType&ACCT=$creditCardNumber" .
			"&EXPDATE=$padDateMonth$expDateYear&CVV2=$cvv2Number&FIRSTNAME=$firstName&LASTNAME=$lastName" .
			"&STREET=$address1&CITY=$city&STATE=$state&ZIP=$zip&COUNTRYCODE=$country&CURRENCYCODE=$currencyCode";
	// Execute the API operation; see the PPHttpPost function above.
	//echo $nvpStr;exit;
	$httpParsedResponseAr = $this->PPHttpPost('DoDirectPayment', $nvpStr);

	//echo "<pre>";print_r($httpParsedResponseAr); exit;

	$ack = strtoupper($httpParsedResponseAr["ACK"]);
	
	
	if ($ack == "SUCCESS") {

		/** CODE TO UPDATE IMAGE TABLE WILL GO OVER HERE **/
		
		
		$picInfo = $this->musers->getPicInfo($this->session->userdata('pic_id'));
		
		$finPicInfo = $this->musers->updateFinalPic($picInfo);
		
		$userid = $this->session->userdata('user_id');
	
		$this->session->set_userdata('pic_paid',1);
		
		redirect("cards/savePicture");
	}
	if ($ack != "SUCCESS") {
	
		$this->session->set_userdata('paypalSubmit',$paypalSubmit);
		$this->session->set_userdata('error_msg1', $httpParsedResponseAr);
		redirect("subscribe/paypal_pro2");
	}
}	
	
	


    function PPHttpPost($methodName_, $nvpStr_) {
        $environment = 'sandbox';

        // Set up your API credentials, PayPal end point, and API version.
        $API_UserName = urlencode('rajkumar.unified_api1.gmail.com');
        $API_Password = urlencode('1390894151');
		
       // $API_UserName = urlencode('qsplusers_api1.gmail.com');
       // $API_Password = urlencode('DSWB5ESKTUZKEKTL');		
		
		
		
        $API_Signature = urlencode('An5ns1Kso7MWUdW4ErQKJJJ4qi4-Adiv9IMir4Z0B8hNCRO7x5s7K.TV');
	   // $API_Signature = urlencode('AFcWxV21C7fd0v3bYYYRCpSSRl31Ap.SS4tBQuVvxbeAk7JzFXGvVE2P');

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

    function thankyou() {
        if (!isMemberLoggedIn()) {
            redirect("home/index");
        }
	
	$userid = $this->session->userdata('user_id');
	$data['senderInfo'] = $this->musers->getUserById($userid);
	
	$buying_date = $data['senderInfo']['buying_dt'];
	
	$todaydate = date('Y-m-d');
	
	$packid = $data['senderInfo']['packagechoose'];
	if($packid !=1)
	{
		$data['thePackDtls'] = $this->musers->getPackById($packid);
		 $daydiff = (strtotime($todaydate) - strtotime($buying_date)) / (60 * 60 * 24);
		
		if($daydiff > $data['thePackDtls']['pack_duration'] * 30 || $data['senderInfo']['cardsend'] == 0)
		{
			$this->session->set_userdata('pack_exp_msg', 'Your package validity or card limit is over. Please subscribe a package.');
			redirect('package/');
		}
		
		if($this->session->userdata('img_id') == '')
			redirect('cards/layout');
		else
		{
		
		   $userid = $this->session->userdata('user_id');
	       
	       $data['theUserDtls'] = $this->musers->getUserById($userid);
		
	       $imgid = $this->session->userdata('img_id');	
		   
		   $sendingcard = $this->musers->downloadcount($userid,$imgid); 
		
	      if($sendingcard)
	      {
			$restcard = $data['theUserDtls']['cardsend'] - $sendingcard ;
		
			$restcard = ($restcard < 0) ? 0 : $restcard;
		
			$this->musers->cardsell($userid,$restcard);
		
	      }		
		
		
		
		
		}
		
	}

	   // $this->session->set_userdata('success_msg', 'Package Subscribe Successfully.');
	    
	    
	
	$data['recivermail']=$this->input->post('remail');
        $data["site_title"] = 'Sucess';

        $this->load->view('thankyou', $data);
    }

}

?>
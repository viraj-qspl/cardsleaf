<?php
/**
 * PayPal_Lib Controller Class (Paypal IPN Class)
 *
 * Paypal controller that provides functionality to the creation for PayPal forms, 
 * submissions, success and cancel requests, as well as IPN responses.
 *
 * The class requires the use of the PayPal_Lib library and config files.
 *
 * @package     CodeIgniter
 * @subpackage  Libraries
 * @category    Commerce
 * @author      Ran Aroussi <ran@aroussi.com>
 * @copyright   Copyright (c) 2006, http://aroussi.com/ci/
 *
 */

class Paypal extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('Paypal_Lib');
		$this->load->model('member');
		$this->load->theme('frontend');
		//$this->load->model('mproduct');
		//$this->load->model('payment_model');
	}
	
	function index()
	{
		$this->form();
		//$this->view('welcome_message');
	}
	
	function form()
	{
		$amount= $this->input->post('amount');
		
		$fname= $this->input->post('firstName');
		$lname= $this->input->post('lastName');
		$email= $this->input->post('email');
		$company_name= $this->input->post('company_name');
		$username= $this->input->post('username');
		$password= $this->input->post('password');
		$activation_code= $this->input->post('activation_code');
		$category_id= $this->input->post('category_id');
		$phone= $this->input->post('phone');
		$membership_plan= $this->input->post('membership_plan');
		$profilestartdate= $this->input->post('profilestartdate');
		$billingperiod = 'M';
		
		
		//if($_POST['billingperiod']=='Month')
		//{
		//	$billingperiod='M';
		//}
		//if($_POST['billingperiod']=='Year')
		//{
		//	$billingperiod='Y';
		//}
		$address1= $this->input->post('address1');
		$address2= $this->input->post('address2');
		$city= $this->input->post('city');
		$state= $this->input->post('state');
		$zip= $this->input->post('zip');
		$countrycode= $this->input->post('countrycode');
		
		$custom=$fname."|".$lname."|".$email."|".$company_name."|".$username."|".$password."|".$activation_code."|".$category_id."|".$phone."|".$membership_plan."|".$profilestartdate."|".$billingperiod."|".$address1."|".$address2."|".$city."|".$state."|".$zip."|".$countrycode."|".$amount;
		
		
		$this->paypal_lib->add_field('business', 'payments@premierhandbags.com');
	    $this->paypal_lib->add_field('return', site_url('paypal/success'));
	    $this->paypal_lib->add_field('cancel_return', site_url('paypal/cancel'));
	    $this->paypal_lib->add_field('notify_url', site_url('paypal/ipn')); // <-- IPN url
	    $this->paypal_lib->add_field('custom', $custom); // <-- Verify return

	    $this->paypal_lib->add_field('item_name', 'Payment for Account Activation');
	    $this->paypal_lib->add_field('item_number', '6941');
	    $this->paypal_lib->add_field('amount', $amount);

	   // $this->paypal_lib->paypal_auto_form();
		
		
		$this->paypal_lib->add_field('business', 's.m.bo_1197104901_biz@gmail.com');
	    $this->paypal_lib->add_field('return', site_url('paypal/success'));
	    $this->paypal_lib->add_field('cancel_return', site_url('paypal/cancel'));
	    $this->paypal_lib->add_field('notify_url', site_url('paypal/ipn')); // <-- IPN url
	    //$this->paypal_lib->add_field('custom', $memberid); // <-- Verify return
	     $this->paypal_lib->add_field('custom', 1); // <-- Verify return

	    $this->paypal_lib->add_field('item_name', 'Paypal Test Transaction');
	    $this->paypal_lib->add_field('item_number', '6941');
	    $this->paypal_lib->add_field('amount', $amount);
	    $data['paypal_form'] = $this->paypal_lib->paypal_form();
	    
	    print_r($data['paypal_form']);exit;
	    $this->load->view('form', $data); 
}
		// if you want an image button use this:
		/*$this->paypal_lib->image('button_03.gif');*/
		
		// otherwise, don't write anything or (if you want to 
		// change the default button text), write this:
		// $this->paypal_lib->button('Click to Pay!');
		
	   /* 
		
		
	

	function auto_form()
	{
		$this->paypal_lib->add_field('business', 'payments@premierhandbags.com');
	    $this->paypal_lib->add_field('return', site_url('paypal/success'));
	    $this->paypal_lib->add_field('cancel_return', site_url('paypal/cancel'));
	    $this->paypal_lib->add_field('notify_url', site_url('paypal/ipn')); // <-- IPN url
	    $this->paypal_lib->add_field('custom', '1234567890'); // <-- Verify return

	    $this->paypal_lib->add_field('item_name', 'Payment for Account Activation');
	    $this->paypal_lib->add_field('item_number', '6941');
	    $this->paypal_lib->add_field('amount', '197');

	    $this->paypal_lib->paypal_auto_form();
	}
	
	function recurring_payment()
	{
		$amount= $this->input->post('amount');
		$fname= $this->input->post('firstName');
		$lname= $this->input->post('lastName');
		$email= $this->input->post('email');
		$company_name= $this->input->post('company_name');
		$username= $this->input->post('username');
		$password= $this->input->post('password');
		$activation_code= $this->input->post('activation_code');
		$category_id= $this->input->post('category_id');
		$phone= $this->input->post('phone');
		$membership_plan= $this->input->post('membership_plan');
		$profilestartdate= $this->input->post('profilestartdate');
		
		
		if($_POST['billingperiod']=='Month')
		{
			$billingperiod='M';
		}
		if($_POST['billingperiod']=='Year')
		{
			$billingperiod='Y';
		}
		$address1= $this->input->post('address1');
		$address2= $this->input->post('address2');
		$city= $this->input->post('city');
		$state= $this->input->post('state');
		$zip= $this->input->post('zip');
		$countrycode= $this->input->post('countrycode');
		
		$custom=$fname."|".$lname."|".$email."|".$company_name."|".$username."|".$password."|".$activation_code."|".$category_id."|".$phone."|".$membership_plan."|".$profilestartdate."|".$billingperiod."|".$address1."|".$address2."|".$city."|".$state."|".$zip."|".$countrycode."|".$amount;
		
		$this->paypal_lib->add_field('business', 'payments@premierhandbags.com');
	    $this->paypal_lib->add_field('return', site_url('paypal/success'));
	    $this->paypal_lib->add_field('cancel_return', site_url('paypal/cancel'));
	    $this->paypal_lib->add_field('notify_url', site_url('paypal/ipn')); // <-- IPN url
	    $this->paypal_lib->add_field('custom', $custom); // <-- Verify return
		 $this->paypal_lib->add_field('cmd', '_xclick-subscriptions');
		//$this->paypal_lib->add_field('cmd', '_s-xclick');
		
		//$this->paypal_lib->add_field('hosted_button_id','7A6JMYJP4F3WY');
		//$this->paypal_lib->add_field('os0',$_POST['os0']);
	    $this->paypal_lib->add_field('item_name', 'Freelance Account Subscription');
	    $this->paypal_lib->add_field('item_number', '6941');
	    $this->paypal_lib->add_field('a3', $amount);
		$this->paypal_lib->add_field('p3', 1);
		$this->paypal_lib->add_field('t3', $billingperiod);
		$this->paypal_lib->add_field('src', '1');
		$this->paypal_lib->add_field('sra', '1');

	    $this->paypal_lib->paypal_auto_form();
		
		
	
		
        
	}
	
	function cancel()
	{
		//$id=$_REQUEST['cm'];
		//$this->musers->membership_delete($id);
		//print_r($_REQUEST);
		//exit;
		// you can use the where clause
		//$this->db->where('field1', 'string');
		$query = $this->db->get('premierhandbags_member');
		// Returns the "last" row
		$last = $query->last_row('array');
		// retrieve last inserted id from table
		$last_id = $last['member_id'];
		$this->musers->membership_delete($last_id);
		$this->load->view('cancel');
	}
	*/
	function success()
	{
		// This is where you would probably want to thank the user for their order
		// or what have you.  The order information at this point is in POST 
		// variables.  However, you don't want to "process" the order until you
		// get validation from the IPN.  That's where you would have the code to
		// email an admin, update the database with payment status, activate a
		// membership, etc.
	
		// You could also simply re-direct them to another page, or your own 
		// order status page which presents the user with the status of their
		// order based on a database (which can be modified with the IPN code 
		// below).

		//$data['pp_info'] = $this->input->post();
		//print_r($_POST);
		
		if(isset($_REQUEST['amount3']))
		{
			$custom= $_REQUEST['custom'];
		}
		else
		{
			$custom= $_REQUEST['custom'];
		}
		/*if(isset($_REQUEST['amt']))
		{
			$custom= $_REQUEST['cm'];
		
		}	
		
		/*print_r($custom);
		exit;*/
		$this->load->model('musers');
		$this->musers->providersignup1($custom);
		$id=$this->db->insert_id();
		
		$data['pp_info'] = $_POST; 
		$data['user']=$this->musers->getuser($id);
		
		
		$admin_mail="darshan.more@quagnitia.com";
		$admin_name="Premier Hand Bags";
		$firstname=$data['user']['first_name'];
		
		$lastname=$data['user']['last_name'];
		$email=$data['user']['email_id'];
		$activation_code=$data['user']['activation_code'];
		$subject="Your account has been created successfully!";
		
		$user_message = "Dear " .$firstname." ". $lastname . "<br>";
		$user_message .= "You have successfully registered to premierhandbags.<br>";
		$user_message .= "Please click the following link to activate the account or copy the link below into your browser to activate your account. <br>";
		$user_message .= "http://www.premierhandbags.com/signin/activation/" . $activation_code ."<br>";
		//$user_message .= "Password : " . $this->input->post('password') ."<br>";
		$user_message .="Thanks for registering with premierhandbags.<br>Regards,<br>premierhandbags";
		//exit('sdfsdfsdfsd');
		$this->load->library('email');
		$config['mailtype'] = "html";
		$this->email->initialize($config);
				
		//To send the mail with CI mail lib:
		$this->email->from($admin_mail, $admin_name);
		$this->email->to($email); 

		$this->email->subject($subject);
		$this->email->message($user_message);	
		//echo $this->email->print_debugger();
		$this->email->send();
		
		$this->load->view('success', $data);
	}
	
	function ipn()
	{
		// Payment has been received and IPN is verified.  This is where you
		// update your database to activate or process the order, or setup
		// the database with the user's order details, email an administrator,
		// etc. You can access a slew of information via the ipn_data() array.
 
		// Check the paypal documentation for specifics on what information
		// is available in the IPN POST variables.  Basically, all the POST vars
		// which paypal sends, which we send back for validation, are now stored
		// in the ipn_data() array.
 
		// For this example, we'll just email ourselves ALL the data.
		$to    = 'pritam.uss@gmail.com';    //  your email
		/*$client_id=$this->input->post('client_id');
		$contractor_id=$this->input->post('contractor_id');
		$milestone_id=$this->input->('milestone_id');
		$job_id=$this->input->post('job_id');
		$amount= $this->input->post('amount');*/
		//mail('soumendu.uss@gmail.com','test','test');

		if ($this->paypal_lib->validate_ipn()) 
		{
			
			
			$body  = 'An instant payment notification was successfully received from ';
			$body .= $this->paypal_lib->ipn_data['payer_email'] . ' on '.date('m/d/Y') . ' at ' . date('g:i A') . "\n\n";
			$body .= " Details:\n";

			foreach ($this->paypal_lib->ipn_data as $key=>$value)
				$body .= "\n$key: $value";
	
			// load email lib and email results
			
			$this->email->to($to);
			$this->email->from($this->paypal_lib->ipn_data['payer_email'], $this->paypal_lib->ipn_data['payer_name']);
			$this->email->subject('CI paypal_lib IPN (Received Payment)');
			$this->email->message($body);	
			//$this->email->send();
		}
	}
	
	

	
	function fund_escrow()
	{
		$memberid=$this->input->post('client_id');
		$contractor_id=$this->input->post('contractor_id');
		$milestone_id=$this->input->post('milestone_id');
		$job_id=$this->input->post('job_id');
		$custom=$memberid."-".$contractor_id."-".$milestone_id."-".$job_id;
		$amount= $this->input->post('amount');
		
		$this->paypal_lib->add_field('business', 'payments@premierhandbags.com');
	    $this->paypal_lib->add_field('return', site_url('payment/projectInvoice/'.$job_id));
	    $this->paypal_lib->add_field('cancel_return', site_url('paypal/cancel'));
	    $this->paypal_lib->add_field('notify_url', site_url('paypal/add_fund_ipn')); // <-- IPN url
	    $this->paypal_lib->add_field('custom', $custom); // <-- Verify return

	    $this->paypal_lib->add_field('item_name', 'premierhandbags Escrow');
	    $this->paypal_lib->add_field('item_number', '6941');
	    $this->paypal_lib->add_field('amount', $amount);

	    $this->paypal_lib->paypal_auto_form();

	}
	
	function fund_deposit_project()
	{
		$memberid=$this->input->post('client_id');
		$contractor_id=$this->input->post('contractor_id');
		$milestone_id=$this->input->post('milestone_id');
		$job_id=$this->input->post('job_id');
		$bid_id=$this->input->post('bid_id');
		$custom=$memberid."-".$contractor_id."-".$milestone_id."-".$job_id."-".$bid_id;
		$amount= $this->input->post('amount');
		
		$this->paypal_lib->add_field('business', 'seller_1354097533_biz@yahoo.co.in');
	    /*$this->paypal_lib->add_field('return', site_url('job/projectDetails/'.$job_id.'/paypal'));*/
		$this->paypal_lib->add_field('return', site_url('job/award_proposal/'.$job_id.'/'.$bid_id.'/'.$contractor_id.'/paypal'));
		//$this->paypal_lib->add_field('return', site_url('job/award_proposal/'));
	    $this->paypal_lib->add_field('cancel_return', site_url('paypal/cancel'));
	    $this->paypal_lib->add_field('notify_url', site_url('paypal/add_fund_ipn')); // <-- IPN url
	    $this->paypal_lib->add_field('custom', $custom); // <-- Verify return

	    $this->paypal_lib->add_field('item_name', 'premierhandbags Escrow');
	    $this->paypal_lib->add_field('item_number', '6941');
	    $this->paypal_lib->add_field('amount', $amount);
		$this->paypal_lib->add_field('job_id', $job_id);
		
	    $this->paypal_lib->paypal_auto_form();
	
	}
//======================================================================================================================	
	function add_fund_ipn()
	{
		// Payment has been received and IPN is verified.  This is where you
		// update your database to activate or process the order, or setup
		// the database with the user's order details, email an administrator,
		// etc. You can access a slew of information via the ipn_data() array.
 
		// Check the paypal documentation for specifics on what information
		// is available in the IPN POST variables.  Basically, all the POST vars
		// which paypal sends, which we send back for validation, are now stored
		// in the ipn_data() array.
 
		// For this example, we'll just email ourselves ALL the data.
		
		//mysql_query("insert into premierhandbags_transaction(`job_id`,`milestone_id`,`client_id`,`contractor_id`,`amount`,`transaction_date`) values('1' ,'1','1','1','100','')");
		
		if ($this->paypal_lib->validate_ipn()) 
		{
			/*$to    = 'sankar.uss@gmail.com';    
			$body  = 'An instant payment notification was successfully received from ';
			$body .= $this->paypal_lib->ipn_data['payer_email'] . ' on '.date('m/d/Y') . ' at ' . date('g:i A') . "\n\n";
			$body .= " Details:\n";

			foreach ($this->paypal_lib->ipn_data as $key=>$value)
				$body .= "\n$key: $value";
	
			// load email lib and email results
			
			$this->email->to($to);
			$this->email->from($this->paypal_lib->ipn_data['payer_email'], $this->paypal_lib->ipn_data['payer_name']);
			$this->email->subject('CI paypal_lib IPN (Received Payment)');
			$this->email->message($body);	
			$this->email->send();*/
			
			
			$body  = 'An instant payment notification was successfully received from ';
			$body .= $this->paypal_lib->ipn_data['payer_email'] . ' on '.date('m/d/Y') . ' at ' . date('g:i A') . "\n\n";
			$body .= " Details:\n";
			
			$amount= $this->paypal_lib->ipn_data['payment_gross'];
			$custom= $this->paypal_lib->ipn_data['custom'];
			
			$custom1=explode("-",$this->paypal_lib->ipn_data['custom']);
			$client_id=$custom1['0'];
			$contractor_id=$custom1['1'];
			$milestone_id=$custom1['2'];
			$job_id=$custom1['3'];
			$bid_id=$custom1['4'];
			
			
			$this->load->model('musers');
			$this->load->model('payment_model');
			$this->load->model('mjob');
			
			$data['contractor']=$this->musers->getuser($contractor_id);
			$data['client']=$this->musers->getuser($client_id);
			$data['job']=$this->mjob->jobDetails($job_id);
			$data['milestone_details']=$this->mjob->getmilestone($milestone_id);
			
		
			
			$this->payment_model->add_fund($custom,$amount);
		//	mysql_query("insert into premierhandbags_transaction(`job_id`,`milestone_id`,`client_id`,`contractor_id`,`amount`,`transaction_date`) values('$job_id' ,'$milestone_id','$client_id','$contractor_id','$amount','$date')");
			
			$admin_mail="info@premierhandbags.com";
			$admin_name="Premier Hand Bags";
			$contractoe_firstname=$data['contractor']['first_name'];
			$contractoe_lastname=$data['contractor']['last_name'];
			$client_companyname=$data['client']['company_name'];
			$client_firstname=$data['client']['first_name'];
			$client_lastname=$data['client']['last_name'];
			
			$to=$data['contractor']['email_id'];
			
			////////////////////////////////////////////////////////////////
								$sqlET="select * from premierhandbags_emailtemplate where id=16";
								$resET=mysql_query($sqlET);
								$rowET=mysql_fetch_array($resET);										
								
								$subject=$rowET['subject'];
								$data['user']=$this->musers->getuser($this->input->post('member_id'));
								$user_message = str_replace('[seller]',ucwords($contractoe_firstname." ". $contractoe_lastname),$rowET['content']);				
								$user_message = str_replace('Buyer',ucwords($client_firstname),$user_message);
								$user_message = str_replace('[jobtitle]',ucwords($data['job']['job_title']),$user_message);
								$user_message = str_replace('[link]','http://www.premierhandbags.com/job/my_won_jobs',$user_message);
							
								$this->load->library('email');
								$config['mailtype'] = "html";
								$this->email->initialize($config);
								$this->email->from($admin_mail, $admin_name);
								$this->email->to($to); 									
								$this->email->subject($subject);
								$this->email->message($user_message);												
								$this->email->send();
			
			
			/*$subject=$client_companyname." submitted fund!";
			
			$user_message = "Dear " .$contractoe_firstname." ". $contractoe_lastname . "<br><br>";
			$user_message .= $client_companyname." have submitted the fund for <b>".$contractoe_firstname." ".$contractoe_lastname."</b> of <b>".$data['job']['job_title']."</b> .<br>";
			
			$user_message .="<br>Regards,<br>premierhandbags<br>http://www.premierhandbags.com";
			//exit('sdfsdfsdfsd');
			$this->load->library('email');
			$config['mailtype'] = "html";
			$this->email->initialize($config);
				
			//To send the mail with CI mail lib:
			$this->email->from($admin_mail, $admin_name);
			$this->email->to($to); 
	
			$this->email->subject($subject);
			$this->email->message($user_message);	
			$this->email->send();*/
		
			$to=$data['client']['email_id'];
			
			/*$subject=$client_companyname." submitted fund!";
			
			$user_message = "Dear " .$client_firstname." ". $client_lastname . "<br><br>";
			$user_message .="You have submitted the fund to <b>".$data['milestone_details']['milestone']."</b> of <b>".$data['job']['job_title']."</b> .<br>";
			
			$user_message .="<br>Regards,<br>premierhandbags<br>http://www.premierhandbags.com";
			//exit('sdfsdfsdfsd');
			$this->load->library('email');
			$config['mailtype'] = "html";
			$this->email->initialize($config);
				
			//To send the mail with CI mail lib:
			$this->email->from($admin_mail, $admin_name);
			$this->email->to($to); 
	
			$this->email->subject($subject);
			$this->email->message($user_message);	
			$this->email->send();*/
			
			////////////////////////////////////////////////////////////////
			$sqlET="select * from premierhandbags_emailtemplate where id=20";
			$resET=mysql_query($sqlET);
			$rowET=mysql_fetch_array($resET);										
			
			$subject=str_replace('[jobtitle]',ucwords($data['job']['job_title']),$rowET['subject']);
			//$data['user']=$this->musers->getuser($this->input->post('member_id'));
			$user_message = str_replace('[buyer]',ucwords($client_firstname." ". $client_lastname),$rowET['content']);				

			$user_message = str_replace('[jobtitle]',ucwords($data['job']['job_title']),$user_message);
		
			$this->load->library('email');
			$config['mailtype'] = "html";
			$this->email->initialize($config);
			$this->email->from($admin_mail, $admin_name);
			$this->email->to($data['client']['email_id']); 									
			$this->email->subject($subject);
			$this->email->message($user_message);												
			$this->email->send();
			
//===============================================================================================================	
			
			
	
			
		}
	}
	
	function product_paid()
	{
	    $memberid=$this->input->post('memberid');		
		//$data['available_balancedetails']=$this->mproduct->get_available_balance($memberid);

		$amount= $this->input->post('total');
		$shipping_amount= $this->input->post('shippingamount');
		
		$this->paypal_lib->add_field('cmd', '_cart');
		/*$this->paypal_lib->add_field('add', 1);
		$this->paypal_lib->add_field('display', 1);*/
		$this->paypal_lib->add_field('upload', '1');
		$this->paypal_lib->add_field('business', 'seller_1328526941_biz@unifiedwebdevelopment.com'); //Money going to admin first time through paypal
	    $this->paypal_lib->add_field('return', site_url('product/success/'));
	    $this->paypal_lib->add_field('cancel_return', site_url('product/cancel'));
	    $this->paypal_lib->add_field('notify_url', site_url('paypal/add_product_order')); // <-- IPN url // <-- Verify return
		$this->paypal_lib->add_field('custom', $memberid);
		
			
		$totcart=count($_SESSION['items']);					
		
		for($i=0;$i<$totcart;$i++)
		{				
			$c=$i+1;
			$pro_id=$_SESSION['items'][$i][0];
			$or_proname=$_SESSION['items'][$i][1];
			$or_qty=$_SESSION['items'][$i][3];		
			$or_price=$_SESSION['items'][$i][2];
			$or_shipping=$_SESSION['items'][$i][5];
			//$this->paypal_lib->add_field('item_number_1', 12);
			
			$this->paypal_lib->add_field("item_name_$c", $or_proname);
			$this->paypal_lib->add_field("quantity_$c", $or_qty);
			$this->paypal_lib->add_field("amount_$c", $or_price);
			$this->paypal_lib->add_field("shipping_$c", $or_shipping);
			
			//$or_proname.=$or_proname.',';
//			$or_qty+=$or_qty;
//			$or_price+=$or_price;
		}
		
	//	$this->paypal_lib->add_field("item_name", $or_proname);
//		$this->paypal_lib->add_field("quantity", $or_qty);
//		$this->paypal_lib->add_field("amount", $or_price);
		

		//$this->paypal_lib->add_field("shipping2", $shipping_amount);
	
	    /*$this->paypal_lib->add_field('item_name', 'item_name');
	    $this->paypal_lib->add_field('amount', $amount);*/
		
	    $this->paypal_lib->paypal_auto_form();
	
	}
	
	function add_product_order()
	{	
		if ($this->paypal_lib->validate_ipn()) 
		{
			$to    = 'unified.somsubhra@gmail.com';    
			$body  = 'An instant payment notification was successfully received from ';
			$body .= $this->paypal_lib->ipn_data['payer_email'] . ' on '.date('m/d/Y') . ' at ' . date('g:i A') . "\n\n";
			$body .= " Details:\n";

			foreach ($this->paypal_lib->ipn_data as $key=>$value)
				$body .= "\n$key: $value";
	
			// load email lib and email results
			
			$this->email->to($to);
			$this->email->from($this->paypal_lib->ipn_data['payer_email'], $this->paypal_lib->ipn_data['payer_name']);
			$this->email->subject('CI paypal_lib IPN (Received Payment)');
			$this->email->message($body);	
			$this->email->send();
			
			
			$body  = 'An instant payment notification was successfully received from ';
			$body .= $this->paypal_lib->ipn_data['payer_email'] . ' on '.date('m/d/Y') . ' at ' . date('g:i A') . "\n\n";
			$body .= " Details:\n";
			
			$session_id= $this->paypal_lib->ipn_data['custom'];
			
			$this->load->model('musers');
			$this->load->model('payment_model');
			$this->load->model('mjob');
			$this->load->model('mproduct');
			
			//$this->mproduct->setproductorder();
			
			$data['contractor']=$this->musers->getuser($session_id);
			$data['client']=$this->musers->getuser($session_id);
			/*$data['job']=$this->mjob->jobDetails($job_id);
			$data['milestone_details']=$this->mjob->getmilestone($milestone_id);*/		
			$data['message']=$this->mproduct->getemailmessage();
			
			$admin_mail=$data['contractor']['email_id'];
			$admin_name="Premier Hand Bags";
			$contractoe_firstname=$data['contractor']['first_name'];
			$contractoe_lastname=$data['contractor']['last_name'];
			$client_companyname=$data['client']['company_name'];
			
			$to=$data['contractor']['email_id'];
			//$to='sankar.uss@gmail.com';
			$pro_id=$_SESSION['items'][$i][0];
			$this->db->where('pro_id',$pro_id);
		    $querypro=$this->db->get('premierhandbags_product');
		    $datapro = $querypro->row_array();
			
			
			$subject=$client_companyname." product purchased!";
			
			$user_message = "Dear " .$contractoe_firstname." ". $contractoe_lastname . "<br><br>";
			$user_message .= "<b> You have successfully purchased </b><font color='#2782E6'>".$datapro['pro_name']."</font> <br>";
			$user_message .=stripslashes($data['message']['content']);
			$user_message .="<br>Regards,<br>premierhandbags<br>http://www.premierhandbags.com";
			//exit('sdfsdfsdfsd');
			$this->load->library('email');
			$config['mailtype'] = "html";
			$this->email->initialize($config);
				
			//To send the mail with CI mail lib:
			$this->email->from($admin_mail, $admin_name);
			$this->email->to($admin_mail); 
	
			$this->email->subject($subject);
			$this->email->message($user_message);	
			//$this->email->send();
			
//===============================================================================================================	
			
		}
	}
}
?>
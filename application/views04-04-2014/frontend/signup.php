<?php
//error_reporting(0);
?>
<script>
$(document).ready(function() {  
  // validate signup form on keyup and submit
	$("#signupForm").validate({
		rules: {
			password: {
				required: true,
				minlength: 5
			},
			cpassword: {
				required: true,
				minlength: 5,
				equalTo: "#password"
				 
			},
			email: {
				required: true,
				email: true,
			},
			agree: "required"
		},
		messages: {
			password: {
				required: "Please provide a password",
				minlength: "Your password must be at least 5 characters long"
			},
			cpassword: {
				required: "Please provide confirm password",
				minlength: "Your password must be at least 5 characters long"
			},
			email: "Please enter a valid email address",
			agree: "Please accept our policy"
		}
	});
  
});

function checkEmail()
{ 
	if ($('#email').val()!="") {
		$('#email_check').html('');
		data = "email="+$('#email').val();
		$.ajax({ 
		  url: "<?php echo base_url(); ?>ajax/checkemail",
		  cache: false,
		  type: "POST",
		  data: data,   
		  success: function(data){
			if (data==1) {
				$('#email').val('');
				$('#email_check').html("Email already exists.");
				
			}
		  }
		});		
	}
}

</script>
<div id="fb-root"></div>
<script type="text/javascript">
  window.fbAsyncInit = function() {
	//alert(document.URL);
	FB.init({
	  appId: '269525376542585',
          cookie: true,
          xfbml: true,
          oauth: true
        });
  };

  (function() {

    var e = document.createElement('script'); e.async = true;
    e.src = document.location.protocol + '//connect.facebook.net/en_US/all.js';
    document.getElementById('fb-root').appendChild(e);
  }());

  function myfunc(type) {
	//var cururl = document.URL;	
	  FB.login(function(response) {

		location.href='<?php echo base_url()."home/facebook_login"?>';

		if (response.session) {

			//alert(response.session);

		  if (response.perms) {

			// user is logged in and granted some permissions.

			// perms is a comma separated list of granted permissions

			//alert("test");

		  } else {

			// user is logged in, but did not grant any permissions

			//alert("test1");

		  }

		} else {

		  // user is not logged in

		}

	  }, {scope:'user_location,user_hometown,email,read_stream,publish_stream,user_birthday,offline_access,create_event,rsvp_event,friends_events'});

    }
	
</script>

<style type="text/css">
#signupForm label.error {
	display: inline;
	color: #F00;
	float: left;
	width: 100%;
	text-align: left;
	margin: 0 auto;
	font: normal 12px/17px Arial, Helvetica, sans-serif;
	text-transform: none;
}
.searchtable2 label{
	width: 100%;
	float: left;
	margin: 0;
	
}
</style>
<title><?php echo $site_title;?></title>
<section id="body">

    <div class="login_body">
<?php if($this->session->userdata('error_msg_login')) { ?>
<div class="msg_box"><?php echo $this->session->userdata('error_msg_login'); ?></div>
<div class="clear"></div>
<?php 
$this->session->unset_userdata('error_msg_login');
} 
?>
<?php if($this->session->userdata('success_msg')) { ?>
	<div class="msg_box"><?php echo $this->session->userdata('success_msg'); ?></div>
	<div class="clear"></div>
<?php 
$this->session->unset_userdata('success_msg');
} 
?>
	<div class="login_holderbox">
    	<div class="login_hrader">
        	<!--<a href="<?php echo base_url();?>"><img src="<?php echo $this->config->item('theme_url')?>images/logo2.png" width="134" class="logo2" alt="Cardsleaf"/></a>-->
            <div class="thanktxt">Sign Up</div>
        </div>
        <div class="login_form">
        	<form method="post" action="" enctype="multipart/form-data" name="signupForm" id="signupForm" autocompete="off">
                <label>EmailID :</label>
		<span><input type="text" class="textbox2" name="email" id="email" onblur="checkEmail()"/></span>
		<span style="display: inline;color: #F00;float: right; font: normal 12px/17px Arial, Helvetica, sans-serif;text-transform: none;" id="email_check"></span>
                <div class="divider"></div>
                <label>Password:</label>
		<span><input  class="textbox2" type="password" name="password" id="password" /></span>
                <div class="divider"></div>
                <label>Confirm password:</label>
		<span><input class="textbox2" type="password" name="cpassword" id="cpassword"/></span>
                <div class="divider"></div>                            
              <div class="note" style="margin-top:-2px;"><input type="checkbox" name="agree" value="agree"/>I agree to the <a href="<?php echo site_url('home/page/terms_condition')?>">Terms and Condition</a> and <a href="<?php echo site_url('home/page/privacy')?>">Privacy Policy</a>.</div><br/><!--Terms of Service-->
                     <div class="divider"></div>  
                <div class="button_holder">
                	<input name="reg_btn" type="submit" value="Sign up" class="button"/>
                </div>
            </form>
	
	        <div class="button_holder">
                <div class="centerbox">
                    <div class="ortxt">or </div>
                    <div class="orimg"><a href="javascript:myfunc('fblogin')"><img src="<?php echo $this->config->item('theme_url')?>images/Loginwithfacebook.png" border="0" alt="facebooklogin"></a></div>
                </div>
            </div>

        </div>
        <div class="clear"/>
    </div>
	</div>

    </div>
    <div class="clear"></div>

</section>
<div class="clear"></div>

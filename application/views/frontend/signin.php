<?php
error_reporting(0);
?>
<title><?php echo $site_title;?></title>
<style type="text/css">
#signin_form label.error{
	display: inline;
	color: #F00;
	float: left;
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
#body {
	min-height: 522px;
}
</style>
<script>
 
$(document).ready(function() {  
  // validate signup form on keyup and submit
	$("#signin_form").validate({
		rules: {
			username: {
				required: true
			},
			password: {
				required: true
			}
		},
		messages: {
			username: {
				required: "Please enter email."
			},
			password: {
				required: "Please provide password."
			}
		}
	});
  
});
</script>


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
        	<!--<a href="<?php echo base_url();?>"><img src="<?php echo $this->config->item('theme_url')?>images/logo2.jpg" width="134" class="logo2" alt="Cardsleaf"/></a>-->
            <div class="thanktxt">Sign In</div>
        </div>
        <div class="login_form">
        	<form method="post" action="<?php echo base_url();?>home/login/<?php echo $size;?>" enctype="multipart/form-data" name="signin_form" id="signin_form" autocompete="off">
            	<label>Email:</label>
		<span><input type="text"  name="username" id="username" class="textbox2" /></span>
                <div class="divider"></div>
		
                <label>Password:</label>
		<span><input type="password" name="password" id="password" class="textbox2" /></span>
                <!--<div class="note"><input type="checkbox"/>Keep me signed in</div>-->
                <div class="note"><a href="<?php echo base_url();?>home/forgot_pass">Forgot pasword</a></div>
		<div class="button_holder">
                	<input class="button"  style=" margin-left: 72px;" type="submit" value="Sign in"  />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|
			<?php if($this->session->userdata('user_id')=="") { ?>
			<?php if($this->session->userdata('layout') == 57 || $this->session->userdata('layout') == 75) $p=$this->session->userdata('layout'); else $p='';?>
			<a href="<?php echo base_url();?>home/signup/<?php echo $p;?>" style="padding-left: 8px;">New User?</a>
			<?php } else { ?>
			<a href="<?php echo base_url();?>home/signup" style="padding-left: 8px;">New User?</a>
			<?php } ?>
                </div>
            </form>
        
        <div class="button_holder">
                <div class="centerbox">
                    <div class="ortxt">or </div>
                    <div class="orimg"><a href="javascript:myfunc('fblogin')"><img src="<?php echo $this->config->item('theme_url')?>images/Loginwithfacebook.png" border="0" alt="facebooklogin"></a></div>
                </div>
            </div>
	</div>
        <div class="clear"></div>
</div>
</div>

<div id="fb-root"></div>
<script type="text/javascript">
  window.fbAsyncInit = function() {
	//alert(document.URL);
	FB.init({
	  appId: '259857357490625',
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

		location.href='<?php echo base_url()."home/facebook_login/".$size; ?>';

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

<div class="clear"></div>


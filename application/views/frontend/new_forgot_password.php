<script type="text/javascript">
 
$(document).ready(function() {
	
  // validate signup form on keyup and submit
	$("#restpass_form").validate({
		rules: {
			pass: {
				required: true,
				minlength: 5
			},
			con_password: {
				required: true,
				minlength: 5,
				equalTo: "#pass"
			}
		},
		messages: {
			pass: {
				required: "Please enter password.",
				minlength: "Your password must be at least 5 characters long."
			},
			con_password: {
				required: "Please enter confirm password.",
				minlength: "Your password must be at least 5 characters long.",
				equalTo: "Please enter the same password as above."
			    }
		}
	});
  
});


</script>
<style type="text/css">
#forgotpass_form label.error{
	display: inline;
	color: #F00;
	float: left;
	width: 100%;
	text-align: left;
	margin: 0 auto;
	font: normal 12px/17px Arial, Helvetica, sans-serif;
	text-transform: none;
}
}
.searchtable2 label{
	width: 100%;
	float: left;
	margin: 0;
	
}
#maincontainer{
	/*min-height: 423px;*/
	min-height: 365px;
}
</style>
<title><?php echo $site_title;?></title>


<div class="login_body">

<?php if($this->session->userdata('forgot_msg')) { ?>
<div class="msg_box"><?php echo $this->session->userdata('forgot_msg'); ?></div>
<div class="clear"></div>
<?php 
$this->session->unset_userdata('forgot_msg');
} 
?>
	
<div class="login_holderbox">
    	<div class="login_hrader">
        	<!--<a href="<?php echo base_url();?>"><img src="<?php echo $this->config->item('theme_url')?>images/logo2.jpg" width="134" class="logo2" alt="Cardsleaf"/></a>-->
            <div class="thanktxt">Change Password</div>
        </div>
        <div class="login_form">
        	<form method="post" action="" enctype="multipart/form-data" name="restpass_form" id="restpass_form" autocompete="off">
		
                <label>New Password:</label>
		<span><input type="password" name="pass" id="pass" class="textbox2" /></span>
                <div class="divider"></div>
		<label>Confirm Password:</label>
		<span><input type="password" name="con_password" id="con_password" class="textbox2" /></span>
                <div class="divider"></div>
		<div class="button_holder">
                	<input class="button"  style=" margin-left: 72px;" type="submit" value="CHANGE PASSWORD"  />
                </div>
            </form>
        
	</div>
        <div class="clear"></div>
</div>
</div>




					
<div class="clear"></div>



<script type="text/javascript">
 
$(document).ready(function() {  
  // validate signup form on keyup and submit
	$("#forgotpass_form").validate({
		rules: {
			email: {
				required: true,
				email: true
			}
		},
		messages: {
			email: {
				required: "Please enter email",
				email:"Please enter a valid email address"
			}
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
<style type="text/css">
#forgotpass_form label.error {
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


	<?php //OLD CODE - PROBABLY SETS ERROR MESSAGE & SITE TITLE ?>
		<title><?php echo $site_title;?></title>
		<div class="login_body">
			<?php if($this->session->userdata('forgot_msg')) { ?>
			<div class="msg_box"><?php echo $this->session->userdata('forgot_msg'); ?></div>
			<div class="clear"></div>
			<?php 
			$this->session->unset_userdata('forgot_msg');
			} 
			?>
		</div>


	<?php /** NEW LAYOUT STARTS HERE**/ ?>	
		
			<div class="container">
			<div class="content distance">
			<h2>Reset Your Password</h2>
			<div class="line top">Forgot? Don't Worry, it happens</div>

			<div class="left">
			<div class="sign_form clearfix">
				<form method="post" action="" enctype="multipart/form-data" name="forgotpass_form" id="forgotpass_form" autocompete="off">
					<div class="in"><input type="text" class="sign_input" placeholder="Your Email Address" name="email" id="email"/></div>
					<p>
					<div class="signup"><a href="#"><input name="recoverpass" type="submit" value="Submit" class="signup_btn"  /></a></div>
					</p>
				 </form>	
			</div><!--sign_form-->
			</div><!--left-->
			</div><!--content-->
			<div class="clear"></div>
			</div><!--container--> 
		
	<?php /** NEW LAYOUT ENDS HERE**/ ?>

		
		
		
		
		
		
		
		
		

		<?php /** OLD LAYOUT STARTS HERE  
	
			<div class="login_holderbox">
					<div class="login_hrader">
						<!--<a href="<?php echo base_url();?>"><img src="<?php echo $this->config->item('theme_url')?>images/logo2.jpg" width="134" class="logo2" alt="Cardsleaf"/></a>-->
						<div class="thanktxt">Forgot Password</div>
					</div>
					<div class="login_form">
						<form method="post" action="" enctype="multipart/form-data" name="forgotpass_form" id="forgotpass_form" autocompete="off">
							<label>Email:</label>
					<span><input type="text"  name="email" id="email" class="textbox2" /></span>
							<div class="divider"></div>
					
					<div class="button_holder">
								<input name="recoverpass" class="button"  style=" margin-left: 72px;" type="submit" value="RECOVER PASSWORD"  />
							</div>
						</form>
					
				</div>
					<div class="clear"></div>
			</div>

	OLD LAYOUT ENDS HERE **/ ?>
				
				

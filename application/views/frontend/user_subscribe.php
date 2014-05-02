<style type="text/css">
	.message_inner3{
		cursor: pointer;
	}
	.message_inner2{
		cursor: pointer;
	}
	
.actionbgbox16{
	width: 94%;
	height: 24px;
	background: url(../images/actionbgbox1.gif) center bottom repeat-x;
	padding: 8px 20px;
	margin: 0;
}
.actionbgbox16 ul {
	padding: 0;
	margin: 0;
}
.actionbgbox16 ul li{
	padding: 0;
	margin: 0 15px 0 0;
	list-style-type: none;
	float: left;
}
.actionbgbox16 ul li i{
	height: auto;
	display: inline-block;
	padding: 0;
	border: 0;
	float: left;
}
.actionbgbox16 ul li a {
	font: bold 14px/24px Arial, Helvetica, sans-serif;
	color: #000;
	text-align: left;
	padding: 0 3px;
	background: #FFFFFF;
	border: 1px solid #CCCCCC;
	overflow: hidden;
    behavior:url(js/PIE.htc);
	behavior: url(../js/ie-css3.htc);
	border-radius: 4px;
	-moz-border-radius: 4px;
	-webkit-border-radius: 4px;
	-ms-border-radius: 4px;
 	-o-border-radius: 4px;
	-xv-border-radius: 4px;
	-khtml-border-radius: 4px;
	margin: 0;
	text-decoration: none;
	cursor: pointer;
	vertical-align: middle;
}
.actionbgbox16 ul li a:hover{
	font: bold 14px/24px Arial, Helvetica, sans-serif;
	color: #fff;
	text-align: left;
	padding: 0 3px;
	background: #333;
	border: 1px solid #000;
	overflow: hidden;
    behavior:url(js/PIE.htc);
	behavior: url(../js/ie-css3.htc);
	border-radius: 4px;
	-moz-border-radius: 4px;
	-webkit-border-radius: 4px;
	-ms-border-radius: 4px;
 	-o-border-radius: 4px;
	-xv-border-radius: 4px;
	-khtml-border-radius: 4px;
	margin: 0;
	text-decoration: none;
	cursor: pointer;
	vertical-align: middle;
}

.actionbgbox16 ul li.here{
	font: bold 14px/24px Arial, Helvetica, sans-serif;
	color: #ff0000;
	text-align: left;
	padding: 0 3px;
	overflow: hidden;
    behavior:url(js/PIE.htc);
	behavior: url(../js/ie-css3.htc);
	border-radius: 4px;
	-moz-border-radius: 4px;
	-webkit-border-radius: 4px;
	-ms-border-radius: 4px;
 	-o-border-radius: 4px;
	-xv-border-radius: 4px;
	-khtml-border-radius: 4px;
	margin: 0;
	text-decoration: none;
	cursor: pointer;
	vertical-align: middle;
}

</style>
<script type="text/javascript">
function submit_form(validity,amount,month){
	$('#item_name').val(validity);
	$('#amount').val(amount);
	//document.getElementById("payment_form").submit();
	$('#select'+month).show();
}
function payment_page(via,month){
	var rootpath = '<?php echo $this->config->item('base_url')?>';
	if (via == 'paypal') {
		document.getElementById("payment_form").submit();
	}else{
		document.location = rootpath+'subscribe/paypal_pro/'+month;
	}
}
</script>


<title><?php echo $site_title;?></title>
<section id="body">	
 <div id="maincontainer">		
   <div class="members_basebox">
     <div class="profile__box">
	<div class="member_headingbox">
	      <div class="member_leftpart">&nbsp;</div>
	      <div class="member_midpart">Your Private Message</div>
	      <div class="member_rightpart">&nbsp;</div>
	</div>	
	<div class="clear"></div>		
	<div class="profile_left">
		<?php include("left_panel_all_feature.php");?>
	</div>
	<div class="profile_right">
		<form  action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" name="_xclick" id="payment_form">
		<div class="clear"></div>
		<div class="payment_box">			
			<!--<div class="preview" style="float: right; margin: 0 auto 8px auto;">
				<strong>Payment Method:</strong> Credit Card, <a href="#">Bank Transfer</a>
			</div>-->			
			<div class="clear"></div>
			<div class="payment_heading"><h1><img src="<?php echo $this->config->item('theme_url')?>images/select_icon.png" border="0" alt=""> Select a Plan</h1></div>
			<div class="clear"></div>					
			<div class="payment_heading"><h1>Best Value Plans<br/>Includes all the tools you need to succeed</h1></div>	
			<div class="clear"></div>		
			<div class="payment here">
				<div class="most_saving"></div>	
				<div class="payment_left">
					<div class="payment_text">Save 50%</div>
					<div class="clear"></div>
					<div class="payment_name">
						<span>6 months</span> Minimum
					</div>
					<div class="clear"></div>  
					<!--<div class="member_headingbox">
						<div class="member_leftpart">&nbsp;</div>
						<div class="member_midpart">Become a Subscriber</div>
						<div class="member_rightpart">&nbsp;</div>
					</div>-->
					<div class="payment_age">
						<ul>
							<li><strong>Includes:</strong></li>
							<li>Email Read Notification</li>
							<li>First Impressions</li>
							<li>Highlighted Profile</li>
						</ul>
					</div>
				</div>
				<div class="payment_right">
					<h1>$5.49</h1> per month <br/>Approximately Rs347.16
					<div class="clear"></div>
					<div class="continue_btn"><a href="javascript:void(0);" onclick="return submit_form('Half Yearly','5.49','6');">Continue</a></div>
					<!--<input type="submit" name="submit1" value="Submit" class="continue_btn" />-->
					<div class="clear"></div>
					<div id="select6" style="display: none; border: 1px solid #CCCCCC; background: #f5f5f5; text-align: center; width: 242px; float: left; margin: 0 auto; overflow: hidden; padding: 10px; height: 30px;">
						<div class="continue_btn29"  style="margin: 0 7px 0 0;">
							<a href="javascript:void(0);" onclick="return payment_page('paypal','6');">Paypal</a>
						</div>
						<div class="continue_btn29" style="margin: 0 7px 0 0;">
							<a href="javascript:void(0);" onclick="return payment_page('card','6');">Credit Card</a>
						</div>
					</div>
				</div>
			</div>
			
			<div class="payment">
				<div class="payment_left">
					<div class="payment_text">Save 50%</div>
					<div class="clear"></div>
					<div class="payment_name">
						<span>3 months</span> Minimum
					</div>
					<div class="clear"></div>  
					<div class="payment_age">
						<ul>
							<li><strong>Includes:</strong></li>
							<li>Email Read Notification</li>
							<li>First Impressions</li>
							<li>Highlighted Profile</li>
						</ul>
					</div>
				</div>
				<div class="payment_right">
					<h1>$3.49</h1> per month <br/>Approximately Rs220.69
					<div class="clear"></div>
					<div class="continue_btn"><a href="javascript:void(0);" onclick="return submit_form('Quaterly','3.49','3');">Continue</a></div>
					<!--<input type="submit" name="submit1" value="Submit" class="continue_btn" />-->
					<div class="clear"></div>
					<div id="select3" style="display: none; border: 1px solid #ccc; background: #e3dddd; text-align: center; width: 242px; float: left; margin: 0 auto; overflow: hidden; padding: 10px; height: 30px;">
						<div class="continue_btn29" style="margin: 0 7px 0 0;">
							<a href="javascript:void(0);" onclick="return payment_page('paypal','3');">Paypal</a>
						</div>
						<div class="continue_btn29" style="margin: 0 7px 0 0;">
							<a href="javascript:void(0);" onclick="return payment_page('card','3');">Credit Card</a>
						</div>
					</div>
				</div>
			</div>
			<input type="hidden" name="cmd" value="_xclick">
			<input type="hidden" name="rm" value="2">
			<input type="hidden" name="business" value="amit.unified-facilitator@gmail.com">
			<input type="hidden" name="return" value="<?php echo base_url()?>subscribe/index">
			<input type="hidden" name="cancel_return" value="<?php echo base_url()?>home/index">
			<input type="hidden" name="notify_url" value="<?php echo base_url()?>/subscribe/ipn">
			<input type="hidden" name="currency_code" value="USD" />
			<input type="hidden" name="item_name" id="item_name" value="">
			<input type="hidden" name="amount" id="amount" value="">
			<input type="hidden" name="custom" value="<?php echo $this->session->userdata('user_id'); ?>" >
			<!--<div class="payment">
				<div class="payment_left">
					<div class="payment_text">Save 50%</div>
					<div class="clear"></div>
					<div class="payment_name">
						<input name="radiobutton" type="radio" value="radiobutton"> <span>6 months</span> Minimum
					</div>
					<div class="clear"></div>  
					<div class="payment_age">
						<ul>
							<li><strong>Includes:</strong></li>
							<li>Email Read Notification</li>
							<li>First Impressions</li>
							<li>Highlighted Profile</li>
						</ul>
					</div>
				</div>
				<div class="payment_right">
					<h1>$5.49</h1> per month <br/>Approximately Rs344.39
					<div class="clear"></div>
					<div class="continue_btn"><a href="#">Continue</a></div>
				</div>
			</div>
			<div class="payment">
				<div class="payment_left">
					<div class="payment_text">Save 50%</div>
					<div class="clear"></div>
					<div class="payment_name">
						<input name="radiobutton" type="radio" value="radiobutton"> <span>6 months</span> Minimum
					</div>
					<div class="clear"></div>  
					<div class="payment_age">
						<ul>
							<li><strong>Includes:</strong></li>
							<li>Email Read Notification</li>
							<li>First Impressions</li>
							<li>Highlighted Profile</li>
						</ul>
					</div>
				</div>
				<div class="payment_right">
					<h1>$5.49</h1> per month <br/>Approximately Rs344.39
					<div class="clear"></div>
					<div class="continue_btn"><a href="#">Continue</a></div>
				</div>
			</div>-->
		</div>
		</form>
	</div>
	
	
   </div>
   <div class="clear"></div>
 </div>				
<div class="clear"></div>
</section>
<div class="clear"></div>


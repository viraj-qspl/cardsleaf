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
function submit_form(validity,amount){
	$('#item_name').val(validity);
	$('#amount').val(amount);
	document.getElementById("payment_form").submit();
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
		<div style="text-align:center; color:#06F; font-size:18px;font-weight:bold;width:200px;margin:0 auto;margin-top:100px">
			Thank you for submitting payment.
		</div>
	</div>
   </div>
   <div class="clear"></div>
 </div>				
<div class="clear"></div>
</section>
<div class="clear"></div>


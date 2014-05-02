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
function checkAll()
{
	var checkbox = document.getElementsByName('career_check');
	var ln = checkbox.length;
	
	for(var k=1;k<=ln;k++)
	{
		ID = "career_check_"+k;
		document.getElementById(ID).checked = true;
	}
		
}
function uncheckAll()
{
	var checkbox = document.getElementsByName('career_check');
	var ln = checkbox.length;
	
	for(var k=1;k<=ln;k++)
	{
		ID = "career_check_"+k;
		document.getElementById(ID).checked = false;
	}
		
}
function deactivate_message()
{
	var allIDs = '';
	var checkbox = document.getElementsByName('career_check');
	var ln = checkbox.length;
	// alert(ln);
	 for(var k=1;k<=ln;k++)
	 {
		 ID = "career_check_"+k;
		 if(document.getElementById(ID).checked)
		 {
			allIDs += document.getElementById(ID).value+',';
		 }
	 }
	 if(allIDs =="")
	 {
		 alert("Please Select atleast one checkbox.");
	 }
	 else
	 {
		var strLen = allIDs.length;
		allIDs = allIDs.slice(0,strLen-1);
		window.location = '<?php echo base_url(); ?>/message/deactivateMsg/'+allIDs;
		
	 }
}
	
function showContent(message_id)
{
	window.location = '<?php echo base_url()?>message/message_display/'+message_id;
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
		<?php if($this->session->userdata('inbox_msg')) { ?>
		<div class="msg_box"><?php echo $this->session->userdata('inbox_msg'); ?></div>
		<div class="clear"></div>
		<?php 
		$this->session->unset_userdata('inbox_msg');
		} 
	?>
	
	 <div class="messagebasebox">
	 <div class="actionbgbox1">
	  <ul>
	    <li><a href="<?php echo base_url()?>message/index" class="here"><i style="margin: 2px 5px 0 0"><img src="<?php echo $this->config->item('theme_url')?>images/action_icon01.png" border="0" alt=""></i> Inbox</a></li>
	    <li><a href="<?php echo base_url()?>message/send"><i style="margin: 2px 8px 0 0"><img src="<?php echo $this->config->item('theme_url')?>images/action_icon02.png" border="0" alt=""></i> Sent Message</a></li>
	    <li><a href="<?php echo base_url()?>message/compose"><i style="margin: 2px 5px 0 0"><img src="<?php echo $this->config->item('theme_url')?>images/action_icon03.png" border="0" alt=""></i> Compose</a></li>
	  </ul>
	 </div>
	 <div class="actionbgbox2">
	  <ul>
	    <li><div class="actionbtn2"><a href="javascript:checkAll()">Select all</a></div></li>
	    <li><div class="actionbtn2"><a href="javascript:uncheckAll()">None</a></div></li>
	    <li><div class="actionbtn2"><a href="javascript:deactivate_message()">Delete</a></div></li>
	  </ul>
	 </div>
	
	<?php
	if($messageData){
		$sl_no = 1;
		foreach($messageData as $eachMessage)
		{
			if($eachMessage['already_seen']==0)
				$class_var = 'message_inner3';
			else
				$class_var = 'message_inner2';
	?>
		<div class="<?php echo $class_var;?>">
		  <div class="messin_left3"><input type="checkbox" name="career_check" id="career_check_<?php echo $sl_no; ?>" value="<?php echo $eachMessage['message_id']; ?>" /></div>
		 <div class="messin_img3" onclick="showContent('<?php echo $eachMessage['message_id'];?>')" style="overflow: hidden;">
			<p><span>
			<?php
				if($eachMessage['fname']!="" || $eachMessage['lname']!="")
					echo $eachMessage['fname']." ".$eachMessage['lname'];
				else
					echo $eachMessage['email'];
					
			?>
			</span></p>			
		  </div>
		  <div class="messin_text3" onclick="showContent('<?php echo $eachMessage['message_id'];?>')">
			<p><?php echo $eachMessage['subject'];?></p>
		  </div>
		  <div class="messin_right3"><p><?php echo date("d-m-Y",strtotime($eachMessage['post_date']));?></p></div>
		</div>
	<?php
		$sl_no++;
		}
	}
	else
	{
	?>
		<p style="color: #F00; font-style: italic; margin-left:20px;">No records found.</p>
	<?php
	}
	?>
	<div><?php echo $links;?></div>
	
      </div>		
     </div>
	
    </div>
   </div>
   <div class="clear"></div>
 </div>				
<div class="clear"></div>
</section>
<div class="clear"></div>


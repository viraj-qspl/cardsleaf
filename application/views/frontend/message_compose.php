<style type="text/css">
.message_inner3{
	cursor: pointer;
}
.message_inner2{
	cursor: pointer;
}
#compose label.error{	
display: inline;
color: #F00;
clear: both;
float: left;
}
</style>
<script type="text/javascript">
   
   $(document).ready(function() {  
  // validate signup form on keyup and submit	
	$("#compose").validate({
		rules: {
			msg_subject: {
				required: true
			    },
			email: {
				required: true,
				email:true
			    },
	    		message_body: {
				required: true
			    }
		}
	});
  
});
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
		<?php if($this->session->userdata('compose_msg')) { ?>
		<div class="msg_box" style="width: 652px; margin: 10px auto;"><?php echo $this->session->userdata('compose_msg'); ?></div>
		<div class="clear"></div>
	<?php 
		$this->session->unset_userdata('compose_msg');
		} 
	?>
	
	 <div class="messagebasebox">
	 <div class="actionbgbox1">
	  <ul>
	    <li><a href="<?php echo base_url()?>message/index"><i style="margin: 2px 5px 0 0"><img src="<?php echo $this->config->item('theme_url')?>images/action_icon01.png" border="0" alt=""></i> Inbox</a></li>
	    <li><a href="<?php echo base_url()?>message/send"><i style="margin: 2px 5px 0 0"><img src="<?php echo $this->config->item('theme_url')?>images/action_icon02.png" border="0" alt=""></i> Sent Message</a></li>
	    <li><a href="<?php echo base_url()?>message/compose"  class="here"><i style="margin: 2px 5px 0 0"><img src="<?php echo $this->config->item('theme_url')?>images/action_icon03.png" border="0" alt=""></i> Compose</a></li>
	  </ul>
	 </div>
	 
	<form method="post" enctype="multipart/form-data" action="" id="compose" name="compose">
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="searchtable3">
	  <tr>
	    <td width="30%"><div class="leftboldtxt">Email:</div></td>
	    <td>
		<input type="text" name="email" id="email" class="textfield">
	    </td>
	  </tr>
	  <tr>
	    <td width="30%"><div class="leftboldtxt">Subject:</div></td>
	    <td>
		<input type="text" name="msg_subject" id="msg_subject" class="textfield">
	    </td>
	  </tr>
	  <tr>
	      <td><div class="leftboldtxt">Message:</div></td>
	      <td>
		<textarea name="message_body" id="message_body" class="bg_textarea"></textarea>
	      </td>
	  </tr>

	 
	 <tr>
		  <td>&nbsp;</td>
		  <td><input name="" type="submit" value="Submit" class="search_btn"></td>
	 </tr>
	</table>
      </form>
	
      </div>		
     </div>
	
    </div>
   </div>
   <div class="clear"></div>
 </div>				
<div class="clear"></div>
</section>
<div class="clear"></div>


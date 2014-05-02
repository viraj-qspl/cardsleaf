<script type="text/javascript">
   
$(document).ready(function() {  
  // validate signup form on keyup and submit	
	$("#edit_pro").validate({
		rules: {
			your_story: {
				required: true,
				minlength: 150
			    },
	    		perfect_match: {
				required: true
			    },
			ideal_first_date: {
				required: true
			}
		},
		messages: {
			your_story:{
				required:  "Please enter your story",
				minlength: "Your story must consist of at least 150 characters"
			}
		}
	});
  
});

  

</script>

<title><?php echo $site_title;?></title>
<style type="text/css">
#edit_pro label.error {
	
	display: inline;
	color: #F00;
}
.searchtable3 label{
	width: 100%;
	float: left;
	margin: 0;
	
}
</style>
<section id="body">	
<div id="maincontainer">
<div class="members_basebox">
<div class="profile__box">
<div class="member_headingbox">
      <div class="member_leftpart">&nbsp;</div>
      <div class="member_midpart">Edit Your Profile</div>
      <div class="member_rightpart">&nbsp;</div>
</div>
<span style="margin: -5px 0 0 853px; position: absolute;"><a href="<?php echo base_url();?>home/user_dashboard"><strong>Back to your Profile</strong></a></span>
<div class="clear"></div>
<div class="profile_left">
<?php include("left_panel_profile.php");?>
</div>

<div class="profile_right">
   <?php if($this->session->userdata('location_msg')) { ?>
<div class="msg_box"><?php echo $this->session->userdata('location_msg'); ?></div>
<div class="clear"></div>
<?php 
$this->session->unset_userdata('location_msg');
} 
?>
<h1>About You</h1>
<p style="padding-bottom:20px; font-size: 14px;">Your Story makes a strong first impression! Tell others about yourself and you will receive more Messages and Flirts.</p>
<form method="post" enctype="multipart/form-data" action="" id="edit_pro" name="edit_pro">
  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="searchtable3">
    <tr>
      <td width="30%"><div class="leftboldtxt">Your story:</div></td>
      <td>
	  <textarea name="your_story" id="your_story" style="width:400px; height: 100px; padding: 6px;"><?php if($userData['your_story']) echo $userData['your_story'];?></textarea>
      </td>
    </tr>
    <tr>
	<td><div class="leftboldtxt">Your Perfect Match:</div></td>
        <td>
	  <textarea name="perfect_match" id="perfect_match" style="width:400px; height: 100px; padding: 6px;"><?php if($userData['your_story']) echo $userData['perfect_match'];?></textarea>
	</td
   ></tr>
    <tr>
	<td><div class="leftboldtxt">Your Ideal First Date:</div></td>
        <td>
	  <textarea name="ideal_first_date" id="ideal_first_date" style="width:400px; height: 100px; padding: 6px;"><?php if($userData['your_story']) echo $userData['ideal_first_date'];?></textarea>
	</td
   ></tr>
   
   <tr>
	    <td>&nbsp;</td>
	    <td><input name="" type="submit" value="Save & Continue" class="search_btn"></td>
   </tr>
  </table>
</form>
</div>
</div>
</div>
</div>					
<div class="clear"></div>
</section>
<div class="clear"></div>


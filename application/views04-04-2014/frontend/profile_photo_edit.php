<script type="text/javascript">
   
$(document).ready(function() {  
  // validate signup form on keyup and submit	
	$("#edit_pro").validate({
		rules: {
			imgfile: {
				required: true,
			    }
		},
		messages: {
			imgfile:{
				required:  "Please select image"
			}
		}
	});
  
});

 function delpho(user_image_id,primaryval)
 {
	var res = confirm("Do you want to delete this photo?");
	if (res==true) {
		window.location = '<?php echo base_url()?>account/delPhoto/'+user_image_id+'/'+primaryval;
	}
 }

</script>
<script>
     $(document).ready(function(){
	    
	     $(".group4").colorbox({rel:'group4',transition:"none", slideshow:true,width:"75%", height:"100%"});
     });
</script>
<title><?php echo $site_title;?></title>
<style type="text/css">
#edit_pro label.error{	
	display: inline;
	color: #F00;
}
.searchtable3 label{
	width: 100%;
	float: left;
	margin: 0;	
}
.img_bg {
	margin: 0;
}
.photo_box {
	width: 520px;
	float: right;
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
<div>
<h1>Your photo</h1>
<?php
	//echo count($allImages);
	if(count($allImages)<6){
?><p style="padding-bottom:8px; font-size: 14px;"><strong>Add a Photo</strong> (Choose a jpg, png, or gif file)</p>
<p>Your primary photo must be a clear photo of you - and only you. Your face should be clearly visible in your primary photo.</p>
</div>
<div class="clear"></div>

<form method="post" enctype="multipart/form-data" action="" id="edit_pro" name="edit_pro">
  <table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin: 10px 0;">
    <tr>
      <td colspan="3"><div class="leftboldtxt"><strong> Upload Image: </strong>
        <input type="file" name="imgfile" id="imgfile" class="textfield" style="float: none !important;" />
      </div></td>
      </tr>
     <tr>	    
	 <td colspan="2"><input name="" type="submit" value="Save" class="search_btn"></td>
     </tr>
  </table>
</form>
 
<?php
	}
	else{
?>
<div class="msg_box2"><p><strong>To add more Photo upgrade your account</strong> <span  id="pink_btn"><a href="#">Upgrade Account</a></span></p></div>
<?php
	}
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="uploadtable">
   <tr>
	<td colspan="2"><div class="leftboldtxt" style="text-align: left;"><strong>Uploaded Image(s):</strong></div></td>
   </tr>
   <?php
	if($allImages){
		foreach($allImages as $eachImage){
    ?>
    <tr>
      <td><div class="img_bg">
	<a href="<?php echo base_url()?>media/user_profile/large/<?php echo $eachImage['image_name'];?>" class="group4"><img src="<?php echo base_url()?>media/user_profile/thumb/<?php echo "thumb_".$eachImage['image_name'];?>"  border="0" width="" height=""/></a></div>
      </td>
      <td>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="photo_box">
	<tr>
		<td>&nbsp;</td>
		<td><div style="width: 330px; margin: 0 auto; float:none; height: 95px;">
		<div class="add_photo2" style="float: left;">
			<?php if($eachImage['primary']==1){
			?>
			<a href="javascript:void()" style="margin: 28px 25px 0 27px; padding: 8px 22px; background: #ccc; color: #fff;"> <img src="<?php echo $this->config->item('theme_url')?>images/star.png" alt="" width="15" height="13" border="0">&nbsp;&nbsp;Primary</a>
			
			<?php
			}
			else{
			?>
			<a href="<?php echo base_url()?>account/makePrimary/<?php echo $eachImage['user_image_id'];?>" style="background: #B35196; color: #fff; margin: 28px 25px 0 27px;"> &nbsp;Make Primary</a>
			
			<?php	
			}
			?>
			
		</div>
		
		    <div class="add_photo2"><a href="javascript:delpho('<?php echo $eachImage['user_image_id'];?>','<?php echo $eachImage['primary'];?>')" style="margin: 28px 0; padding: 8px; background: #B35196; color: #fff;">Delete Photo</a></div></div></td>
      </tr>
    </table>

      </td>
    </tr>
     
    <?php
		}
	}
   ?>
   
  </table>
</div>
</div>
</div>
</div>					
<div class="clear"></div>
</section>
<div class="clear"></div>


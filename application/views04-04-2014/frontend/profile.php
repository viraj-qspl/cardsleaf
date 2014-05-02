<title>Dating Profile</title>

<?php

//print_r($userData);
$years = '';
if($userData['birthday']!="0000-00-00"){
   $date1 = $userData['birthday'];
   $date2 = date("Y-m-d");
   
   $diff = abs(strtotime($date2) - strtotime($date1));
   
   $years = floor($diff / (365*60*60*24));
}

?>
<style>
.framebase {
   width:  auto;
   height:  auto;
   background: #fff;
   border:  3px solid #ccc;
   padding: 0;
   margin: 5px 10px 5px 0;
   display:  block;
   overflow:  hidden;
   float: left;
   border-radius: 5px;
}
/*.framebase img {
   margin:  0 auto;
   display:  block;
   border:  0;
   width:  180px;
   height:  180px;
}*/
.add_photo img.wrap {
	padding: 0;
	margin: 0;
}
.img_framebox {
    background: none repeat scroll 0 0 #FFFFFF;
    border: 1px solid #CCCCCC;
    float: left;
    height: 107px;
    margin: 0 10px 0 0;
    overflow: hidden;
    padding: 4px;
    text-align: center;
    width: 124px;
}
.img_framebox a {
	padding: 0;
	margin: 0;
	text-decoration: none;
	cursor: pointer;
	border: 0;
	behavior:url(js/PIE.htc);
	behavior: url(../js/ie-css3.htc); 
	border-radius: 0;
	-moz-border-radius: 0;
	-webkit-border-radius: 0;
	-ms-border-radius: 0;
 	-o-border-radius: 0;
	-xv-border-radius: 0;
	-khtml-border-radius: 0;
}
.img_framebox a:hover {
	padding: 0;
	margin: 0;
	text-decoration: none;
	cursor: pointer;
	border: 0;
	behavior:url(js/PIE.htc);
	behavior: url(../js/ie-css3.htc); 
	border-radius: 0;
	-moz-border-radius: 0;
	-webkit-border-radius: 0;
	-ms-border-radius: 0;
 	-o-border-radius: 0;
	-xv-border-radius: 0;
	-khtml-border-radius: 0;
}
.add_photo a {
	padding: 0;
	margin: 0;
	text-decoration: none;
	cursor: pointer;
	border: 0;
	behavior:url(js/PIE.htc);
	behavior: url(../js/ie-css3.htc); 
	border-radius: 0;
	-moz-border-radius: 0;
	-webkit-border-radius: 0;
	-ms-border-radius: 0;
 	-o-border-radius: 0;
	-xv-border-radius: 0;
	-khtml-border-radius: 0;
}
</style>
<script>
     $(document).ready(function(){
	    
	     $(".group4").colorbox({rel:'group4',transition:"none", slideshow:true,width:"75%", height:"100%"});
     });
</script>  

<section id="body">	
<div id="maincontainer">
<div class="members_basebox">
<div class="profile__box">
<div class="member_headingbox">
      <div class="member_leftpart">&nbsp;</div>
      <div class="member_midpart">Edit Your Profile</div>
      <div class="member_rightpart">&nbsp;</div>	  
</div>
<div class="clear"></div>
<div class="profile_left">
<?php include("left_panel_all_feature.php");?>
</div>
<div class="profile_right">
<h1>Your Dating Profile <span style="float: right;"><a href="<?php echo base_url()?>account/edit_pro">Edit Profile</a></span></h1>
<div>
   <?php if($userPrimaryImg){?>
   <a href="<?php echo base_url()?>media/user_profile/large/<?php echo $userPrimaryImg['image_name'];?>" class="group4">
   <div class="framebase"><img  src="<?php echo base_url()?>media/user_profile/thumb180/<?php echo "thumb_".$userPrimaryImg['image_name'];?>" alt=""  border="0" class=""></div>
   </a>
   <?php } else{ ?>
   <img src="<?php echo $this->config->item('theme_url')?>images/no_img.jpg" alt="" width="180" height="180" border="0" class="wrap">
   <?php } ?>
   <ul style="border-bottom: 1px solid #CCCCCC; overflow: hidden;">
      <li style="width:170px;"><strong><?php echo $years;?></strong><br/>Years Old</li>
      <li style="width:200px;">
	 <strong>
	 <?php if($userData['address']!="") echo $userData['address'].' </br>';if($userData['state']!="") echo $userData['state'].',';if($userData['country_name']!="") echo $userData['country_name'];?>
	 </strong></li>
      <li><strong><?php echo $userData['username'];?></strong></li>
   </ul>
<ul style="float: right;">
<li><a href="<?php echo base_url()?>account/edit_pro" style="background: #B35196; color: #fff;">Edit Profile</a></li>
<li><a href="<?php echo base_url()?>account/gallery" style="background: #B35196; color: #fff;">Edit Photos</a></li>
<li><a href="<?php echo base_url()?>account/location" style="background: #B35196; color: #fff;">Edit Location</a></li>
</ul>
</div>
<div class="clear"></div>
<div class="add_photo">
<div>
<?php

   if($userImgData){
      foreach($userImgData as $eachImg){
?>

<div class="img_framebox"><a href="<?php echo base_url()?>media/user_profile/large/<?php echo $eachImg['image_name'];?>" class="group4">
<img src="<?php echo base_url()?>media/user_profile/thumb/<?php echo "thumb_".$eachImg['image_name'];?>" alt="" border="0"></a></div>

<?php
      }
?>

<?php
} 
if(count($userImgData)<6){
?>
<div class="add_photobtn"><a href="<?php echo base_url()?>account/gallery">Add Photo</a></div>
<?php
}
?>
</div>
</div>
<div class="clear"></div>
<div class="basic_story">
<div class="basic_storyL">
<h1>Your Dating Profile <span style="float: right;"><a href="<?php echo base_url()?>account/edit_pro">Edit Profile</a></span></h1>
<div class="clear"></div>
<div>
<p class="texdt_box"><span class="texdt_left">Height:</span><span class="texdt_right"><?php if($userData['height_feet']!="") echo $userData['height_feet']."'";if($userData['height_inches']!="") echo $userData['height_inches']."'";if($userData['height_cm']!=0) echo $userData['height_cm']." cm";?></span></p>
<p class="texdt_box"><span class="texdt_left">Sex:</span><span class="texdt_right"><?php if($userData['sex']=="M") echo "Male"; else if($userData['sex']=="F") echo "Female";?></p>
<p class="texdt_box"><span class="texdt_left">Ethnicity:</span><span class="texdt_right"><?php echo $userData['ethnicity']; ?></span></p>
<p class="texdt_box"><span class="texdt_left">Body Type:</span><span class="texdt_right"><?php echo $userData['body_type']; ?></span></p>
<p class="texdt_box"><span class="texdt_left">Previous Marriage:</span><span class="texdt_right"><?php echo $userData['prev_marriage']; ?></span></p>
<p class="texdt_box"><span class="texdt_left">Children:</span><span class="texdt_right"><?php echo $userData['children']; ?></span></p>
<p class="texdt_box"><span class="texdt_left">Education:</span><span class="texdt_right"><?php echo $userData['education']; ?></span></p>
<p class="texdt_box"><span class="texdt_left">Religion:</span><span class="texdt_right"><?php echo $userData['religion']; ?></span></p>
<p class="texdt_box"><span class="texdt_left">Lifestyle:</span><span class="texdt_right"><?php echo $userData['smoking'].' '.$userData['drinking']; ?></span></p> 
</div>
</div>
<div class="basic_storyR">
<h1>Story<span style="float: right;"><a href="<?php echo base_url()?>account/about">Edit</a></span></h1>
   <div class="clear"></div>
   <p>
   <?php
     if($userData['your_story']!=""){
      if(strlen($userData['your_story'])>600)
      {
	 echo stripslashes(substr($userData['your_story'],0,600))." ...";
	 echo '<br> <a href="'.base_url().'/account/about" style="float:right;color:#0012ff;">read more</a>';
      }
      else{
	 echo stripslashes($userData['your_story']);
      }
      
     }
      else{
   ?>
   <div class="add_photo2"><a href="<?php echo base_url()?>account/about" style="background: #B35196; color: #fff;">Add Your Story</a></div>
   <?php
      }
   ?>
 </p>   
</div>
</div>
<div class="clear"></div>
<div class="basic_story">
<h1><img src="<?php echo $this->config->item('theme_url')?>images/heart.png" alt="" width="15" height="13" border="0" class="wraps">Romance</h1>
</div>
<div class="clear"></div>
<div class="basic_story">
<div class="basic_storyL">
<h1>Perfect Match <span style="float: right;"><a href="<?php echo base_url()?>account/about">Edit</a></span></h1>
<div class="clear"></div>
<div>
<p class="texdt_box">
<?php
     if($userData['perfect_match']!=""){
      if(strlen($userData['perfect_match'])>600)
      {
	 echo stripslashes(substr($userData['perfect_match'],0,600))." ...";
	 echo '<br> <a href="'.base_url().'/account/about" style="float:right;color:#0012ff;">read more</a>';
      }
      else{
	 echo stripslashes($userData['perfect_match']);
      }
      
     }
      else{
   ?>
   <div class="add_photo2"><a href="<?php echo base_url()?>account/about" style="background: #B35196; color: #fff;">Add Your Perfect Match</a></div>
   <?php
      }
   ?>
   </p>
</p> 
</div>
</div>
<div class="basic_storyR">
<h1>Ideal Date<span style="float: right;"><a href="<?php echo base_url()?>account/about">Edit</a></span></h1>
<div class="clear"></div>
   <p>
   <?php
     if($userData['ideal_first_date']!=""){
      if(strlen($userData['ideal_first_date'])>600)
      {
	 echo stripslashes(substr($userData['ideal_first_date'],0,600))." ...";
	 echo '<br> <a href="'.base_url().'/account/about" style="float:right;color:#0012ff;">read more</a>';
      }
      else{
	 echo stripslashes($userData['ideal_first_date']);
      }
      
     }
      else{
   ?>
   <div class="add_photo2"><a href="<?php echo base_url()?>account/about" style="background: #B35196; color: #fff;">Add Your Idea Date</a></div>
   <?php
      }
   ?>
   </p>
</div>
</div>
</div>
</div>
</div>
</div>					
<div class="clear"></div>
</section>


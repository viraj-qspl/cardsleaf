<title><?php echo $site_title;?></title>
<style>
.search_base {
	margin: 0;
}
</style>
<section id="body">	
<div id="maincontainer">
<div class="members_basebox">
<div class="profile__box">
   <div class="member_headingbox">
      <div class="member_leftpart">&nbsp;</div>
      <div class="member_midpart">Your Search Result</div>
      <div class="member_rightpart">&nbsp;</div>
   </div>
   <div class="clear"></div>
   <div class="profile_left">
      <?php include("left_panel_all_feature.php");?>
   </div> 
    <div class="search2">
   <div class="search">
   <h2>Your Fevorites results</h2>
   </div>
   <div class="search_inner">
   <?php if($this->session->userdata('fav_msg')) { ?>
      <div class="msg_box" style="width:642px;margin: 10px auto;"><?php echo $this->session->userdata('fav_msg'); ?></div>
      <div class="clear"></div>
      <?php 
      $this->session->unset_userdata('fav_msg');
      } 
   ?>
      <?php
	 $newObj = new common_methods();   
         if($favData){
	    foreach($favData as $eachFav){
	       $primaryData = $newObj->getPrimaryImg($eachFav['to_id']);
	      
      ?>
      <div class="favoritebox29">
	 <div class="search_base">
	    <div class="searchresultimg">
	       <a href="<?php echo base_url()?>search/userprofile/<?php echo base64_encode($eachFav['to_id']);?>">
	      <?php  if($primaryData['image_name']){ ?>
	       <img src="<?php echo base_url()?>media/user_profile/thumb/<?php echo "thumb_".$primaryData['image_name'];?>" alt="" >
	       <?php } else { ?>
	        <img src="<?php echo $this->config->item('theme_url')?>images/noimage0.jpg" alt="" >
		<?php } ?>
	       </a>
	    </div>
	    <div class="searchresultimgname"><a href="<?php echo base_url()?>search/userprofile/<?php echo base64_encode($eachFav['to_id']);?>"><?php  if($eachFav['fname']!="") echo $eachFav['fname']." ".$eachFav['lname']; else echo $eachFav['username'];?></a></div>
	    <div class="searchresultlocation"><?php if($eachFav['address']) echo $eachFav['address'].',';?></div>
	    <div class="searchstate"><?php echo $eachFav['city'];?></div>
	 </div>
	 <div class="clear"></div>
	 <div class="action_delete"><a href="<?php echo base_url()?>favorite/delFav/<?php echo $eachFav['fav_id'];?>">Delete</a></div>
     </div>
	<?php
	    }	    
	 }
	 else{
      ?>
      <div style="color: #F00; font-style:italic;">No record found.</div>
      <?php
	 }
	 
      ?>
	  </div>
      <div class="clear"></div>
      <div><?php echo $links;?></div>   
   </div>  
</div>
</div>
</div>					
<div class="clear"></div>
</section>
<div class="clear"></div>
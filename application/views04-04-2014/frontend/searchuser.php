<title><?php echo $site_title;?></title>

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
   <div class="profile_left"><?php include("left_panel_all_feature.php");?></div>    
  <div class="search2">
   <div class="search">
      <h2>Your search results</h2>
      <div>
	 <ul>
	    <li>
	       <?php if($userData['sex']=='M' && $userData['seeking']=='F') {?>
	       <strong>Men</strong> interested in <strong>Women</strong>
	       <?php } else{ ?>
	       <strong>Women</strong> interested in <strong>Men</strong>
	       <?php } ?>
	    </li>
	    <li><?php if($age_from!="" && $age_to!=""){ echo ' Ages <strong>'.$age_from.'</strong> to <strong>'.$age_to.'</strong>'; } else { echo '&nbsp'; }?></li>
	    <li style="width: 108px; border-right:0;"><?php if($height_from!="" && $height_to!=""){ echo ' Heights <strong>'.$height_from.'</strong> to <strong>'.$height_to.'</strong>'; } else { echo '&nbsp'; }?></li>
	    <li style="width: 108px;">&nbsp;</li>
	    <li style="cursor: pointer; color: #FFFFFF; float: right; height: auto; margin: 7px 4px; border-radius: 5px; background: #2e0c24; border: 1px solid #333; font-size: 16px; padding: 5px 16px;"><a href="<?php echo base_url() ?>search/editsearch" style="color: #FFFFFF; text-decoration: none;">Edit Search</a></li>
	 </ul>
      </div>
   </div>
<div><?php echo $links;?></div>
   <div class="search_inner">
      <?php
	 $newObj = new common_methods();   
         if($userSearchData){
	    foreach($userSearchData as $eachSearchUser){
	       //print_r($eachSearchUser);
	       
	       $primaryData = $newObj->getPrimaryImg($eachSearchUser['user_id']);
	      
	?>
	 <div class="search_base">
	    <div class="searchresultimg">
	       <a href="<?php echo base_url()?>search/userprofile/<?php echo base64_encode($eachSearchUser['user_id']);?>">
	      <?php  if($primaryData['image_name']){ ?>
	       <img src="<?php echo base_url()?>media/user_profile/thumb/<?php echo "thumb_".$primaryData['image_name'];?>" alt="" >
	       <?php } else { ?>
	        <img src="<?php echo $this->config->item('theme_url')?>images/noimage0.jpg" alt="" >
		<?php } ?>
	       </a>
	    </div>
	    <div class="searchresultimgname"><a href="#"><?php  if($eachSearchUser['fname']!="") echo $eachSearchUser['fname']." ".$eachSearchUser['lname']; else echo $eachSearchUser['username'];?></a></div>
	    <div class="searchresultlocation"><?php if($eachSearchUser['address']) echo $eachSearchUser['address'].',';?></div>
	    <div class="searchstate"><?php echo $eachSearchUser['state'];?></div>
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
      <div class="clear"></div>
      <div><?php echo $links;?></div>
   
   </div>
</div>




</div>
</div>
</div>					
<div class="clear"></div>
</section>
<div class="clear"></div>
<title><?php echo $site_title;?></title>
<section id="body">	
<div id="maincontainer">
   <div class="members_basebox">
      <div class="profile__box">
	 <div class="member_headingbox">
	    <div class="member_leftpart">&nbsp;</div>
	    <div class="member_midpart">Connection</div>
	    <div class="member_rightpart">&nbsp;</div>
	 </div>
	 <div class="clear"></div>
	 <div class="profile_left">
	    <?php include("left_panel_all_feature.php");?>
	 </div>
	 <div class="profile_right17">
	    <?php if($this->session->userdata('frnd_res_mgs')) { ?>
	       <div class="msg_box" style="width:642px;margin: 10px auto;"><?php echo $this->session->userdata('frnd_res_mgs'); ?></div>
	       <div class="clear"></div>
	       <?php 
	       $this->session->unset_userdata('frnd_res_mgs');
	       } 
	    ?>
	    <div><h1>Connection</h1></div>
	    <div class="clear"></div>
	    <div class="messagebasebox">		  
	       <div class="actionbgbox2" style="border-bottom: 1px solid #CCCCCC; overflow:hidden;">  
		  <ul>
		     <li class="conntionbtn"><a href="<?php echo base_url()?>connection/index">Request</a></li>
		     <li class="conntionbtn"><a href="<?php echo base_url()?>connection/friends" class="here">Request Accepted</a></li>
		 </ul>   
	       </div>
	       <div class="clear"></div>
	       <?php
		  if($connectionData){
		     foreach($connectionData as $eachConData)
		     {
			//print_r($eachConData);
			
			$conObj = new musers();
			$pri_img_data = $conObj->getUserPrimaryImg($eachConData['from_id']);
	       ?>
		  <div class="message_list">
		     <div class="list_img3">
			<?php if($pri_img_data['image_name']){?>
			<a href="<?php echo base_url() ?>search/userprofile/<?php echo base64_encode($eachConData['from_id']);?>"><img src="<?php echo base_url()?>media/user_profile/thumb/<?php echo "thumb_".$pri_img_data['image_name'];?>" alt="" border="0"></a>
			<?php } else { ?>
			<a href="<?php echo base_url() ?>search/userprofile/<?php echo base64_encode($eachConData['from_id']);?>"><img src="<?php echo $this->config->item('theme_url')?>images/noimage0.jpg" alt="" border="0"></a>
			<?php } ?>
		     </div>
		     <div class="list_text3">
			<p class="namesudip">
			<?php
			   if($eachConData['fname']!="")
			      echo $eachConData['fname']." ".$eachConData['lname'];
			   else
			      echo $eachConData['email_id'];
			?></p><br />
			<?php echo date("d-m-Y",strtotime($eachConData['post_date']));?>
            <br />
			<p class="vill"><?php if($eachConData['address']!="") echo $eachConData['address'].","; else echo '&nbsp';?></p>
			<p class="city"><?php echo $eachConData['city'];?></p>
		     </div>
		     <div class="basebtnboxright">  		  
			<p class="conntionbtn17"><a href="<?php echo base_url()?>connection/response/2/<?php echo $eachConData['friend_id'];?>">Reject</a></p>		    
		     </div>
		  </div>
	       <?php
		     }
		  }
		  else
		  {
		?>
		  <div class="message_list"><p style="color: #F00; font-style: italic;">No record Found.</p></div>
		<?php
		  }
	       ?>
	       	<div><?php echo $links;?></div>		
	       
	       
	    </div>
	 </div>
      </div>
   </div>
</div>					
<div class="clear"></div>
</section>

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
		window.location = '<?php echo base_url(); ?>/views_pro/deleteView/'+allIDs;
		
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
	       <div class="member_midpart">Profile View</div>
	       <div class="member_rightpart">&nbsp;</div>
	 </div>
	 <div class="clear"></div>
	 <div class="profile_left">
	    <?php include("left_panel_all_feature.php");?>
	 </div>
	 <div class="profile_right">
	 <?php if($this->session->userdata('del_view_pr')) { ?>
	     <div class="msg_box"><?php echo $this->session->userdata('del_view_pr'); ?></div>
	     <div class="clear"></div>
	 <?php 
	     $this->session->unset_userdata('del_view_pr');
	 } 
	 ?>
	 <div class="profile_right">
	    <div class="messagebasebox">		  
	       <div class="actionbgbox2" style="border-bottom: 1px solid #CCCCCC; overflow:hidden;">
		  <ul>
		    <li><div class="actionbtn2"><a href="javascript:checkAll()">Select all</a></div></li>
		    <li><div class="actionbtn2"><a href="javascript:uncheckAll()">None</a></div></li>
		    <li><div class="actionbtn2"><a href="javascript:deactivate_message()">Delete</a></div></li>
		  </ul>
	       </div>
	       <div class="clear"></div>
	       <?php
	       if($viewProData){
		  $sl_no = 1;
		  foreach($viewProData as $eachViewPro)
		  {
		     $conObj = new musers();
		     $pri_img_data = $conObj->getUserPrimaryImg($eachViewPro['from_id']);
	       ?>
		  <div class="message_list">
		     <div class="list_left3"><input name="career_check" id="career_check_<?php echo $sl_no; ?>" type="checkbox" value="<?php echo $eachViewPro['profile_view_id']; ?>" ></div>	
		     <div class="list_img3">
			<?php if($pri_img_data['image_name']){?>
			<img src="<?php echo base_url()?>media/user_profile/thumb/<?php echo "thumb_".$pri_img_data['image_name'];?>" alt="" border="0">
			<?php } else { ?>
			<img src="<?php echo $this->config->item('theme_url')?>images/noimage0.jpg" alt="" border="0">
			<?php } ?>
		     </div>
		     <div class="list_text3" style="width: 278px;">
			<p class="namesudip">
			<?php
			   if($eachViewPro['fname']!="")
			      echo $eachViewPro['fname']." ".$eachViewPro['lname'];
			   else
			      echo $eachViewPro['email_id'];
			?></p>
			<p class="vill"><?php echo date("d-m-Y",strtotime($eachViewPro['post_date']));?> </p>
			<p class="vill"><?php if($eachViewPro['address']!="") echo $eachViewPro['address'].","; else echo '&nbsp';?></p>
			<p class="city"><?php echo $eachViewPro['city'];?></p>
		     </div>
		     <div class="search_btn17"><a href="<?php echo base_url()?>/search/userprofile/<?php echo base64_encode($eachViewPro['from_id']);?>">View Dating Profile</a></div>	
		  </div>
	       <?php
		  $sl_no++;
		  }
	       }
	       else{
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

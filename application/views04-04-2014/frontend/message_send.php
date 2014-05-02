<style type="text/css">
	.message_inner3{
		cursor: pointer;
	}
	.message_inner2{
		cursor: pointer;
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
	function deactivate_send_message()
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
			window.location = '<?php echo base_url(); ?>/message/deactivatesendMsg/'+allIDs;
			
		 }
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
		<?php if($this->session->userdata('send_msg_sh')) { ?>
		<div class="msg_box"><?php echo $this->session->userdata('send_msg_sh'); ?></div>
		<div class="clear"></div>
	<?php 
		$this->session->unset_userdata('send_msg_sh');
		} 
	?>
	
	 <div class="messagebasebox">
	 <div class="actionbgbox1">
	  <ul>
	    <li><a href="<?php echo base_url()?>message/index"><i style="margin: 2px 5px 0 0"><img src="<?php echo $this->config->item('theme_url')?>images/action_icon01.png" border="0" alt=""></i> Inbox</a></li>
	    <li><a href="<?php echo base_url()?>message/send"  class="here"><i style="margin: 2px 5px 0 0"><img src="<?php echo $this->config->item('theme_url')?>images/action_icon02.png" border="0" alt=""></i> Sent Message</a></li>
	    <li><a href="<?php echo base_url()?>message/compose"><i style="margin: 2px 5px 0 0"><img src="<?php echo $this->config->item('theme_url')?>images/action_icon03.png" border="0" alt=""></i> Compose</a></li>
	  </ul>
	 </div>
	 <div class="actionbgbox2">
	  <ul>
	    <li><div class="actionbtn2"><a href="javascript:checkAll()">Select all</a></div></li>
	    <li><div class="actionbtn2"><a href="javascript:uncheckAll()">None</a></div></li>
	    <li><div class="actionbtn2"><a href="javascript:deactivate_send_message()">Delete</a></div></li>
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
		  <div class="messin_img3">
			<p><span>
			<?php
				if($eachMessage['fname']!="" || $eachMessage['lname']!="")
					echo $eachMessage['fname']." ".$eachMessage['lname'];
				else
					echo $eachMessage['email'];
					
			?>
			</span></p>			
		  </div>
		  <div class="messin_text3">
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


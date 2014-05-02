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
	<div class="search2">
  
   <div><?php //echo $links;?></div>
   <div class="profile_right">
	<div><h1>See Who is Online Now</h1></div>
	<?php if($this->session->userdata('fav_msg')) { ?>
	<div class="msg_box" style="width:642px;margin: 10px auto;"><?php echo $this->session->userdata('fav_msg'); ?></div>
	<div class="clear"></div>
	<?php 
		$this->session->unset_userdata('fav_msg');
	} 
	?>
	<?php
		//$newObj = new common_methods();   
		if($useronline){
		foreach($useronline as $online){
			//$primaryData = $newObj->getPrimaryImg($eachFav['to_id']);
	      
	?>
	<div class="favoritebox01">
		<div class="search_base">
			<div class="searchresultimg">
				<a href="<?php echo base_url()?>search/userprofile/<?php //echo base64_encode($eachFav['to_id']);?>">
				<?php  if($online['image_name']){ ?>
					<img src="<?php echo base_url()?>media/user_profile/thumb/<?php echo "thumb_".$online['image_name'];?>" alt="" >
				<?php } else { ?>
					<img src="<?php echo $this->config->item('theme_url')?>images/noimage0.jpg" alt="" >
				<?php } ?>
				</a>
			</div>
			<div class="searchresultimgname"><a href="<?php echo base_url()?>search/userprofile/<?php //echo base64_encode($online['to_id']);?>"><?php  if($online['fname']!="") echo $online['fname']." ".$online['lname']; else echo $online['username'];?></a></div>
			<div class="searchresultlocation"><?php if($online['address']) echo $online['address'].',';?></div>
			<div class="searchstate"><?php echo $online['city'];?></div>
		</div>
		<div class="clear"></div>
		<!--<div class="action_delete"><a href="<?php echo base_url()?>favorite/delFav/<?php //echo $eachFav['fav_id'];?>">Delete</a></div>-->
	</div>
		<?php
		}	    
		}
		else{
		?>
		<div class="message_list">
			<p style="color: #F00; font-style:italic; text-align: center;">No record found.</p>
		</div>
		<?php
		}
		?>
		<div class="clear"></div>
	</div>
	</div>
   </div>
   <div class="clear"></div>
 </div>				
<div class="clear"></div>
</section>
<div class="clear"></div>


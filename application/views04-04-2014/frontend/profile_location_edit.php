<?php
   
?>
<script type="text/javascript">
  
   
$(document).ready(function() {  
  // validate signup form on keyup and submit	
	$("#edit_pro").validate({
		rules: {
			country_id: {
				required: true,
			    },
	    		city: {
				required: true,
			    },
			address: {
				required: true,
			},
			zip: {
				required: true,
			    }
		},
		messages: {
			country_id: "Please select country.",
			city: "Please enter your city.",
			address: "Please enter address",
			zip: "Please enter zip code"
		}
	});
  
});

  
function getStateCountryWise()
{
	//alert($('#country_id').val());
	$('#country_spinner').show();
	if ($('#country_id').val()!="") {
		data = "county_id="+$('#country_id').val();
		$.ajax({ 
		  url: "<?php echo base_url(); ?>ajax/showState",
		  cache: false,
		  type: "POST",
		  data: data,   
		  success: function(data){
			$('#country_spinner').hide();
			$("#state_id").html(data);
		  }
		});
		
	}
	else{
		$('#country_spinner').hide();
		$("#state_id").html('<select name="state_id" id="state_id" class="dropdown2" style="background: #fff;padding: 5px 2px 5px 0;"><option value="">Choose State</option></select>');
	}
} 
   
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
<h1>Your location</h1>
<form method="post" enctype="multipart/form-data" action="" id="edit_pro" name="edit_pro">
  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="searchtable3">
    <tr>
      <td width="25%"><strong>Country:</strong></td>
      <td>
	  <div class="dropdown2">
	       <select name="country_id" id="country_id" onchange="getStateCountryWise()">
		       <option value="">Choose Country</option>
		       <?php
			       for($i=1;$i<=count($allCountry);$i++){
				       if($allCountry[$i]['country_name']!=""){
		       ?>
		       <option value="<?php echo $allCountry[$i]['country_id']; ?>" <?php if($userData['country_id']==$allCountry[$i]['country_id']){?> selected<?php } ?>><?php echo trim($allCountry[$i]['country_name']);?></option>
		       <?php
				       }
			       }
		       ?>
	       </select>
	    </div>
	    <div style="position: absolute; margin: 0 0 0 317px;"><span style="margin: -11px 0 0 8px; float: left;display: none; " id="country_spinner"> <img src="<?php echo $this->config->item('theme_url')?>images/spinner.gif" alt="" width="50" height="50" border="0"></span> </div>
      </td>
    </tr>
    <tr>
	 <td><strong>Your State:</strong></td>
	 <td><div class="dropdown2">
	   <select name="state_id" id="state_id">
	    <?php
		     for($i=1;$i<=count($state_country);$i++){
			     if($state_country[$i]['name']!=""){
	     ?>
	       <option value="<?php echo $state_country[$i]['state_id']; ?>" <?php if($userData['state_id']==$state_country[$i]['state_id']){?> selected<?php } ?>><?php echo $state_country[$i]['name']; ?></option>
	       <?php
			     }
		     }
	       ?>
	   </select>
	    </div>
	 </td>
   </tr>
   <tr>
	    <td><strong>City:</strong></td>
	    <td><input type="text" name="city" id="city" value="<?php echo $userData['city'];?>" class="textfield"></td>
   </tr>
   <tr>
	    <td><strong>Address:</strong></td>
	    <td><input type="text" name="address" id="address" value="<?php echo $userData['address'];?>" class="textfield"></td>
   </tr>
   <tr>
	    <td><strong>Zip:</strong></td>
	    <td><input type="text" name="zip" id="zip" value="<?php echo $userData['zip'];?>" class="textfield"></td>
   </tr>
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


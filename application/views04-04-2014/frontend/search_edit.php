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

$(document).ready(function(){
	$('.advance_srch').hide();
	
	//alert('<?php echo $this->session->userdata('ses_children'); ?>')
	
	<?php
	if($this->session->userdata('ses_prev_marriage') || $this->session->userdata('ses_children') || $this->session->userdata('ses_ethnicity') || $this->session->userdata('ses_religion') || $this->session->userdata('ses_education') || $this->session->userdata('ses_smoking') || $this->session->userdata('ses_drinking')){
	?>
		$('.advance_srch').show();
	<?php
	}
	?>
	
	
})
  
function showAdvance()
{
	$('.advance_srch').toggle();
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
.dropdown2 select{
	width: 155px;
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
<div class="clear"></div>
<div class="profile_left">
<?php include("left_panel_all_feature.php");?>
</div>

<div class="profile_right">
  
<h1>Your Search</h1>
<form method="post" enctype="multipart/form-data" action="<?php echo base_url()?>/search/showSearchRes" id="edit_pro" name="edit_pro">
  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="searchtable3">
    <tr>
      <td colspan="2" style="text-align: center; height: 30px; font-size: 16px;">
	<?php if($userData['sex']=='M' && $userData['seeking']=='F') {?>
	<strong>Men</strong> interested in <strong>Women</strong>
	<?php } else{ ?>
	<strong>Women</strong> interested in <strong>Men</strong>
	<?php } ?>
      </td>
    </tr>
    <tr>
	 <td width="25%"><strong>Age:</strong></td>
	 <td>
	   <div class="dropdown2" style="width: 128px;">
	   <select name="age_from" id="age_from">
		<option value="">Choose Age</option>
	    <?php
		     for($i=15;$i<=70;$i++){
	     ?>
	       <option value="<?php echo $i; ?>" <?php if($i==$this->session->userdata('ses_age_from')){?> selected<?php } ?>><?php echo $i; ?></option>
	       <?php
		     }
	       ?>
	   </select>
	   </div>
	   <div style="float: left; padding-left: 15px; padding-right: 15px;">to</div>
	   <div class="dropdown2" style="width: 128px;">
	   <select name="age_to" id="age_to">
		<option value="">Choose Age</option>
	    <?php
		     for($i=15;$i<=70;$i++){
	     ?>
	       <option value="<?php echo $i; ?>" <?php if($i==$this->session->userdata('ses_age_to')){?> selected<?php } ?>><?php echo $i; ?></option>
	       <?php
		     }
	       ?>
	   </select>
	   </div>
	   
	 </td>
   </tr>
     <tr>
	 <td width="25%"><strong>Height:</strong></td>
	 <td>
	   <div class="dropdown2" style="width: 128px;">
		<select name="height_from" id="height_from">
		     <option value="">Choose Height</option>
		 <?php
			  for($i=91;$i<=241;$i++){
		  ?>
		    <option value="<?php echo $i; ?>" <?php if($i==$this->session->userdata('ses_height_from')){?> selected<?php } ?>><?php echo $i; ?></option>
		    <?php
			  }
		    ?>
		</select>
	   </div>
	   <div style="float: left; padding-left: 15px; padding-right: 15px;">to</div>
	   <div class="dropdown2" style="width: 128px;">
		<select name="height_to" id="height_to">
		     <option value="">Choose Height</option>
		 <?php
			  for($i=91;$i<=241;$i++){
		  ?>
		    <option value="<?php echo $i; ?>" <?php if($i==$this->session->userdata('ses_height_to')){?> selected<?php } ?>><?php echo $i; ?></option>
		    <?php
			  }
		    ?>
		</select>
	   </div>
	   
	 </td>
   </tr>   
   <tr>
   <td>&nbsp;</td>
   <td style="padding: 15px 0 9px 0;"><strong style="cursor: pointer; color: #FFFFFF; height: 30px; margin: 7px 4px; border-radius: 5px; line-height: 30px; background: #2e0c24; border: 1px solid #333; font-size: 16px; padding: 10px 16px;" onclick="showAdvance()">Advance Search</strong></td>
   </tr>
    <tr class="advance_srch">
	    <td><strong>Relationship</strong></td>
	    <td>
		<div class="dropdown" style="width: 218px;">
		<select name="prev_marriage" id="prev_marriage" style="width: 246px;">	
		 <option value="">----</option>
		 <option <?php if($this->session->userdata('ses_prev_marriage')=="never married"){?> selected="selected" <?php } ?> value="never married">never married</option>
		 <option <?php if($this->session->userdata('ses_prev_marriage')=="separated"){?> selected="selected" <?php } ?>  value="separated">separated</option>
		 <option <?php if($this->session->userdata('ses_prev_marriage')=="divorced"){?> selected="selected" <?php } ?>  value="divorced">divorced</option>
		 <option <?php if($this->session->userdata('ses_prev_marriage')=="widowed"){?> selected="selected" <?php } ?>  value="widowed">widowed</option>
		 <option <?php if($this->session->userdata('ses_prev_marriage')=="tell you later"){?> selected="selected" <?php } ?>  value="tell you later">tell you later</option>
		</select>
		</div>
	  </td>	
   </tr>
     <tr class="advance_srch">
	    <td><strong>Children</strong></td>
	   <td>
	   <div class="dropdown" style="width: 218px;">
	    <select name="children" id="children" class="dropselect" style="width:246px;">
		<option value="">----</option>
		<option <?php if($this->session->userdata('ses_children')=="no"){?> selected="selected" <?php } ?> value="no">no</option>
		<option <?php if($this->session->userdata('ses_children')=="yes at home"){?> selected="selected" <?php } ?>  value="yes at home">yes, at home with me</option>
		<option <?php if($this->session->userdata('ses_children')=="yes didnot live"){?> selected="selected" <?php } ?>  value="yes didnot live">yes, but they don't live with me</option>	
	    </select>
		</div>
	   </td>	
	</tr>
      <tr class="advance_srch">
	    <td><strong>Ethnicity</strong></td>
	    <td>
		<div class="dropdown" style="width: 218px;">
	     <select name="ethnicity" id="ethnicity" class="dropselect" style="width: 246px;">
		<option value="">----</option>
		<option <?php if($this->session->userdata('ses_ethnicity')=="White/Caucasian"){?> selected="selected" <?php } ?> value="White/Caucasian">White/Caucasian</option>
		<option <?php if($this->session->userdata('ses_ethnicity')=="Black/African"){?> selected="selected" <?php } ?> value="Black/African">Black/African</option>
		<option <?php if($this->session->userdata('ses_ethnicity')=="Latino/Hispanic"){?> selected="selected" <?php } ?> value="Latino/Hispanic">Latino/Hispanic</option>
		<option <?php if($this->session->userdata('ses_ethnicity')=="Asian"){?> selected="selected" <?php } ?> value="Asian">Asian</option>
		<option <?php if($this->session->userdata('ses_ethnicity')=="Indian"){?> selected="selected" <?php } ?> value="Indian">Indian</option>
		<option <?php if($this->session->userdata('ses_ethnicity')=="Middle Eastern"){?> selected="selected" <?php } ?> value="Middle Eastern">Middle Eastern</option>
		<option <?php if($this->session->userdata('ses_ethnicity')=="Mixed/Other"){?> selected="selected" <?php } ?> value="Mixed/Other">Mixed/Other</option>			
	  </select>
	  </div>
	  </td>	
	</tr>
	<tr class="advance_srch">
	    <td><strong>Religion</strong></td>
	    <td>
		<div class="dropdown" style="width: 218px;">
		<select name="religion" id="religion" class="dropselect" style="width: 246px;">	  
		<option value="">----</option>
		<option <?php if($this->session->userdata('ses_religion')=="Agnostic"){?> selected="selected" <?php } ?> value="Agnostic">Agnostic</option>
		<option <?php if($this->session->userdata('ses_religion')=="Atheist"){?> selected="selected" <?php } ?>  value="Atheist">Atheist</option>
		<option <?php if($this->session->userdata('ses_religion')=="Buddhist"){?> selected="selected" <?php } ?>  value="Buddhist">Buddhist</option>
		<option <?php if($this->session->userdata('ses_religion')=="Christian"){?> selected="selected" <?php } ?>  value="Christian">Christian</option>
		<option <?php if($this->session->userdata('ses_religion')=="Christian - Catholic"){?> selected="selected" <?php } ?>  value="Christian - Catholic">Christian - Catholic</option>
		<option <?php if($this->session->userdata('ses_religion')=="Jewish"){?> selected="selected" <?php } ?>  value="Jewish">Jewish</option>
		<option <?php if($this->session->userdata('ses_religion')=="Hindu"){?> selected="selected" <?php } ?>  value="Hindu">Hindu</option>
		<option <?php if($this->session->userdata('ses_religion')=="Muslim"){?> selected="selected" <?php } ?>  value="Muslim">Muslim</option>
		<option <?php if($this->session->userdata('ses_religion')=="Spiritual"){?> selected="selected" <?php } ?> value="Spiritual">Spiritual</option>
		<option <?php if($this->session->userdata('ses_religion')=="Other"){?> selected="selected" <?php } ?> value="Other">Other</option>
	     </select>
		 </div>
	  </td>	
	</tr>
	<tr class="advance_srch">
	    <td><strong>Education</strong></td>
	    <td>
		<div class="dropdown" style="width: 218px;">
		<select name="education" id="education" class="dropselect" style="width: 246px;">
		<option value="">----</option>
		<option <?php if($this->session->userdata('ses_education')=="No Degree"){?> selected="selected" <?php } ?> value="No Degree">No Degree</option>
		<option <?php if($this->session->userdata('ses_education')=="High School"){?> selected="selected" <?php } ?> value="High School">High School</option>
		<option <?php if($this->session->userdata('ses_education')=="Some College"){?> selected="selected" <?php } ?> value="Some College">Some College</option>
		<option <?php if($this->session->userdata('ses_education')=="Bachelors Degree"){?> selected="selected" <?php } ?> value="Bachelors Degree">Bachelor's Degree</option>
		<option <?php if($this->session->userdata('ses_education')=="Masters/Doctorate"){?> selected="selected" <?php } ?> value="Masters/Doctorate">Master's/Doctorate</option>
		</select>
		</div>
	  </td>	
	</tr>
	<tr class="advance_srch">
	    <td><strong>Smoking</strong></td>
	    <td>
		<div class="dropdown" style="width: 218px;">
		<select name="smoking" id="smoking" class="dropselect" style="width: 246px;">	
		<option value="">----</option>
		<option <?php if($this->session->userdata('ses_smoking')=="no"){?> selected="selected" <?php } ?> value="no">no</option>
		<option <?php if($this->session->userdata('ses_smoking')=="yes, socially"){?> selected="selected" <?php } ?> value="yes, socially">yes, socially</option>
		<option <?php if($this->session->userdata('ses_smoking')=="yes, regularly"){?> selected="selected" <?php } ?> value="yes, regularly">yes, regularly</option>
		</select>
		</div>
	  </td>	
	</tr>
	<tr class="advance_srch">
	    <td><strong>Drinking</strong></td>
	    <td>
		<div class="dropdown" style="width: 218px;">
		<select name="drinking" id="drinking" class="dropselect" style="width: 246px;">
			<option value="">----</option>
			<option <?php if($this->session->userdata('ses_drinking')=="no"){?> selected="selected" <?php } ?> value="no">no</option>
			<option <?php if($this->session->userdata('ses_drinking')=="yes, socially"){?> selected="selected" <?php } ?> value="yes, socially">yes, socially</option>
			<option <?php if($this->session->userdata('ses_drinking')=="yes, regularly"){?> selected="selected" <?php } ?> value="yes, regularly">yes, regularly</option>
		</select>
		</div>
		</td>
	  </td>	
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


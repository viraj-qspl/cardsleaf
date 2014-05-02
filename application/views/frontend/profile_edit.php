<?php
   //print_r($userData);
   $b_yr = '';
   $b_mon = '';
   $b_day = '';
   
   if($userData['birthday']!="0000-00-00")
      list($b_yr,$b_mon,$b_day) = explode("-",$userData['birthday']);
   
   
?>
<script type="text/javascript">
   function changefeet() {
      
      $('#height_inch').show();
      $('#showmsgcm').show();
      $('#height_cm').hide();
      $('#showmsgft').hide();
      
   }
   function changecenti() {
      
      $('#height_inch').hide();
      $('#showmsgcm').hde();
      $('#height_cm').show();
      $('#showmsgft').show();
      
      
      
   }
   
   
$(document).ready(function() {  
  // validate signup form on keyup and submit	
	$("#edit_pro").validate({
		rules: {
			fname: {
				required: true,
			    },
	    		lname: {
				required: true,
			    },
			username: {
				required: true,
				minlength: 4
			},
			height_cm: {
				required: true,
			    },
			prev_marriage: {
				required: true
			},
			children: {
				required: true
			},
			ethnicity: "required",
			education: "required",
			religion: "required",
			smoking: "required",
			drinking: "required",
			body_type: "required"
		},
		messages: {
			fname: "Please enter your first Name",
			lname: "Please enter your Last Name",
			username: {
				required: "Please enter a username",
				minlength: "Your username must consist of at least 4 characters"
			},
			height_cm: "Please enter your height",
			prev_marriage: "Please select your maritial status",
			ethnicity: "Please select ethnicity",
			education: "Please select your education qualification"
		}
	});
  
});

   
   
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
<h1>The Basics</h1>
<form method="post" enctype="multipart/form-data" action="" id="edit_pro" name="edit_pro">
  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="searchtable3">
    <tr>
      <td width="30%"><strong>First Name</strong></td>
      <td><input type="text" name="fname" id="fname" class="textfield" value="<?php echo $userData['fname'];?>"></td>
    </tr>
    <tr>
      <td><strong>Last Name</strong></td>
      <td><input type="text" name="lname" id="lname" class="textfield" value="<?php echo $userData['lname'];?>"></td>
    </tr>
	<tr>
      <td><strong>Display Name</strong></td>
      <td><input type="text" name="username" id="username" class="textfield" value="<?php echo $userData['username'];?>"></td>
    </tr>
    <tr>
      <td><strong>Birthday</strong></td>
      <td><table width="100" border="0" cellspacing="0" cellpadding="0">
        <tr>
         <td>
	    <select name="u_b_day" id="u_b_day" class="dropselect">
		  <?php
		     for($i=1;$i<=31;$i++){
		  ?>
		     <option value="<?php echo $i;?>" <?php if($b_day==$i){ ?> selected <?php } ?>><?php echo $i;?></option>
		  <?php
		     }
		  ?>
	    </select><p class="greytxt">Days</p>
	 </td>
         <td><select name="u_b_mon" id="u_b_mon" class="dropselect">
		  <option value="1" <?php if($b_mon==1){ ?> selected <?php } ?>>January</option>
		  <option value="2" <?php if($b_mon==2){ ?> selected <?php } ?>>February</option>
		  <option value="3" <?php if($b_mon==3){ ?> selected <?php } ?>>March</option>
		  <option value="4" <?php if($b_mon==4){ ?> selected <?php } ?>>April</option>
		  <option value="5" <?php if($b_mon==5){ ?> selected <?php } ?>>May</option>
		  <option value="6" <?php if($b_mon==6){ ?> selected <?php } ?>>June</option>
		  <option value="7" <?php if($b_mon==7){ ?> selected <?php } ?>>July</option>
		  <option value="8" <?php if($b_mon==8){ ?> selected <?php } ?>>August</option>
		  <option value="9" <?php if($b_mon==9){ ?> selected <?php } ?>>September</option>
		  <option value="10" <?php if($b_mon==10){ ?> selected <?php } ?>>October</option>
		  <option value="11" <?php if($b_mon==11){ ?> selected <?php } ?>>November</option>
		  <option value="12" <?php if($b_mon==12){ ?> selected <?php } ?>>December</option>
              </select><p class="greytxt">Month</p>
	 </td>
         <td><select name="u_b_yr" id="u_b_yr" class="dropselect">
		  <?php
		     for($i=1920;$i<=2020;$i++){
		  ?>
		     <option value="<?php echo $i;?>" <?php if($b_yr==$i){ ?> selected <?php } ?>><?php echo $i;?></option>
		  <?php
		     }
		  ?>
	    </select><p class="greytxt">Year</p></td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td><strong>Height</strong></td>
      <td>
	 <input type="text" name="height_cm" id="height_cm" value="<?php echo $userData['height_cm'];?>" class="textfield" style="width: 95px; height: 24px;">Cm
      </td>
    </tr>
    <tr>
      <td><strong>Sex</strong></td>
      <td>
	  <select name="sex" id="sex" class="dropselect" style="width: 120px;">
	    <option value="M" <?php if($userData['sex']=="M"){?> selected <?php } ?>>male</option>
	    <option value="F" <?php if($userData['sex']=="F"){?> selected <?php } ?>>female</option>	
	  </select>
      </td>
    </tr>
    <tr>
      <td><strong>Interested In</strong></td>
      <td>
	 <select name="seeking" id="seeking" class="dropselect" style="width: 120px;">
	    <option value="M" <?php if($userData['seeking']=="F"){?> selected <?php } ?>>women</option>
	    <option value="F" <?php if($userData['seeking']=="M"){?> selected <?php } ?>>men</option>	
	  </select>
      </td>
    </tr> 
    <tr>
      <td><strong>Previous Marriage</strong></td>
      <td>
	<select name="prev_marriage" id="prev_marriage" class="dropselect" style="width: 180px;">	
	 <option value="">----</option>
	 <option <?php if($userData['prev_marriage']=="never married"){?> selected="selected" <?php } ?> value="never married">never married</option>
	 <option <?php if($userData['prev_marriage']=="separated"){?> selected="selected" <?php } ?>  value="separated">separated</option>
	 <option <?php if($userData['prev_marriage']=="divorced"){?> selected="selected" <?php } ?>  value="divorced">divorced</option>
	 <option <?php if($userData['prev_marriage']=="widowed"){?> selected="selected" <?php } ?>  value="widowed">widowed</option>
	 <option <?php if($userData['prev_marriage']=="tell you later"){?> selected="selected" <?php } ?>  value="tell you later">tell you later</option>
	</select>
  </td>			   
    <tr>
      <td><strong>Children</strong></td>
     <td>
	 <select name="children" id="children" class="dropselect" style="width:180px;">
	 <option value="">----</option>
	<option <?php if($userData['children']=="no"){?> selected="selected" <?php } ?> value="no">no</option>
	<option <?php if($userData['children']=="yes at home"){?> selected="selected" <?php } ?>  value="yes at home">yes, at home with me</option>
	<option <?php if($userData['children']=="yes didnot live"){?> selected="selected" <?php } ?>  value="yes didnot live">yes, but they don't live with me</option>	
     </select></td>
    </tr>
    <tr>
      <td><strong>Ethnicity</strong></td>
      <td>
	  <select name="ethnicity" id="ethnicity" class="dropselect" style="width: 180px;">
		<option value="">----</option>
		<option <?php if($userData['ethnicity']=="White/Caucasian"){?> selected="selected" <?php } ?> value="White/Caucasian">White/Caucasian</option>
		<option <?php if($userData['ethnicity']=="Black/African"){?> selected="selected" <?php } ?> value="Black/African">Black/African</option>
		<option <?php if($userData['ethnicity']=="Latino/Hispanic"){?> selected="selected" <?php } ?> value="Latino/Hispanic">Latino/Hispanic</option>
		<option <?php if($userData['ethnicity']=="Asian"){?> selected="selected" <?php } ?> value="Asian">Asian</option>
		<option <?php if($userData['ethnicity']=="Indian"){?> selected="selected" <?php } ?> value="Indian">Indian</option>
		<option <?php if($userData['ethnicity']=="Middle Eastern"){?> selected="selected" <?php } ?> value="Middle Eastern">Middle Eastern</option>
		<option <?php if($userData['ethnicity']=="Mixed/Other"){?> selected="selected" <?php } ?> value="Mixed/Other">Mixed/Other</option>			
	  </select></td>
    </tr>
    <tr>
      <td><strong>Education</strong></td>
      <td><select name="education" id="education" class="dropselect" style="width: 180px;">
	    <option value="">----</option>
	    <option <?php if($userData['education']=="No Degree"){?> selected="selected" <?php } ?> value="No Degree">No Degree</option>
	    <option <?php if($userData['education']=="High School"){?> selected="selected" <?php } ?> value="High School">High School</option>
	    <option <?php if($userData['education']=="Some College"){?> selected="selected" <?php } ?> value="Some College">Some College</option>
	    <option <?php if($userData['education']=="Bachelors Degree"){?> selected="selected" <?php } ?> value="Bachelors Degree">Bachelor's Degree</option>
	    <option <?php if($userData['education']=="Masters/Doctorate"){?> selected="selected" <?php } ?> value="Masters/Doctorate">Master's/Doctorate</option>
      </select></td>
    </tr>
    <tr>
      <td><strong>Religion</strong></td>
      <td><select name="religion" id="religion" class="dropselect" style="width: 180px;">	  
	    <option value="">----</option>
	    <option <?php if($userData['religion']=="Agnostic"){?> selected="selected" <?php } ?> value="Agnostic">Agnostic</option>
	    <option <?php if($userData['religion']=="Atheist"){?> selected="selected" <?php } ?>  value="Atheist">Atheist</option>
	    <option <?php if($userData['religion']=="Buddhist"){?> selected="selected" <?php } ?>  value="Buddhist">Buddhist</option>
	    <option <?php if($userData['religion']=="Christian"){?> selected="selected" <?php } ?>  value="Christian">Christian</option>
	    <option <?php if($userData['religion']=="Christian - Catholic"){?> selected="selected" <?php } ?>  value="Christian - Catholic">Christian - Catholic</option>
	    <option <?php if($userData['religion']=="Jewish"){?> selected="selected" <?php } ?>  value="Jewish">Jewish</option>
	    <option <?php if($userData['religion']=="Hindu"){?> selected="selected" <?php } ?>  value="Hindu">Hindu</option>
	    <option <?php if($userData['religion']=="Muslim"){?> selected="selected" <?php } ?>  value="Muslim">Muslim</option>
	    <option <?php if($userData['religion']=="Spiritual"){?> selected="selected" <?php } ?> value="Spiritual">Spiritual</option>
	    <option <?php if($userData['religion']=="Other"){?> selected="selected" <?php } ?> value="Other">Other</option>
	 </select></td>
    </tr>
   <tr>
  <td><strong>Smoking</strong></td>
  <td><select name="smoking" id="smoking" class="dropselect" style="width: 180px;">	
	<option value="">----</option>
	 <option <?php if($userData['smoking']=="no"){?> selected="selected" <?php } ?> value="no">no</option>
	 <option <?php if($userData['smoking']=="yes, socially"){?> selected="selected" <?php } ?> value="yes, socially">yes, socially</option>
	 <option <?php if($userData['smoking']=="yes, regularly"){?> selected="selected" <?php } ?> value="yes, regularly">yes, regularly</option>
   </select>
   </td>
</tr>
    <tr>
      <td><strong>Drinking</strong></td>
      <td><select name="drinking" id="drinking" class="dropselect" style="width: 180px;">
	  <option value="">----</option>
	 <option <?php if($userData['drinking']=="no"){?> selected="selected" <?php } ?> value="no">no</option>
	 <option <?php if($userData['drinking']=="yes, socially"){?> selected="selected" <?php } ?> value="yes, socially">yes, socially</option>
	 <option <?php if($userData['drinking']=="yes, regularly"){?> selected="selected" <?php } ?> value="yes, regularly">yes, regularly</option>
    </select></td>
    </tr>
    <tr>
     <td><strong>Body Type</strong></td>
     <td><select name="body_type" id="body_type" class="dropselect" style="width: 180px;">	 
	 <option value="">----</option>
	 <option <?php if($userData['body_type']=="Slim"){?> selected="selected" <?php } ?> value="Slim">Slim</option>
	 <option <?php if($userData['body_type']=="Athletic"){?> selected="selected" <?php } ?> value="Athletic">Athletic</option>
	 <option <?php if($userData['body_type']=="Average"){?> selected="selected" <?php } ?> value="Average">Average</option>
	 <option <?php if($userData['body_type']=="Curvy"){?> selected="selected" <?php } ?> value="Curvy">Curvy</option>
      </select></td>
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


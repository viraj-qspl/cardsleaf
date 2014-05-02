<script language="javascript" type="text/javascript">
function echeck(str) 
{
	var at="@"
	var dot="."
	var lat=str.indexOf(at)
	var lstr=str.length
	var ldot=str.indexOf(dot)

		if (str.indexOf(at)==-1){
		   alert("Invalid Email")
		   return false;
		}

		if (str.indexOf(at)==-1 || str.indexOf(at)==0 || str.indexOf(at)==lstr){
		   alert("Invalid Email;")
		   return false;
		}

		if (str.indexOf(dot)==-1 || str.indexOf(dot)==0 || str.indexOf(dot)==lstr){
		    alert("Invalid Email")
	    	return false;
		}

		 if (str.indexOf(at,(lat+1))!=-1){
		    alert("Invalid Email")
		    return false;
		 }

		 if (str.substring(lat-1,lat)==dot || str.substring(lat+1,lat+2)==dot){
		    alert("Invalid E-mail")
		   return false;
		 }

		 if (str.indexOf(dot,(lat+2))==-1){
		    alert("Invalid Email")
		    return false;
		 }

		 if (str.indexOf(" ")!=-1){
		    alert("Invalid Email")
		    return false;
		 }

 		 return true;					
}

function validation()
{
   if(document.getElementById('admin_username').value.search(/\S/) == "-1")
   {
      alert("Please Enter Username.");
      document.getElementById('admin_username').focus();
	  return false;
   }
   if(document.getElementById('fname').value.search(/\S/) == "-1")
   {
      alert("Please Enter First Name");
      document.getElementById('fname').focus();
	  return false;
   }
   if(document.getElementById('lname').value.search(/\S/) == "-1")
   {
      alert("Please Enter Last Name.");
      document.getElementById('lname').focus();
	  return false;
   }
   
	var emailID = document.getElementById('admin_email')
	if(emailID.value.search(/\S/) == "-1")
	{
		alert("Please Enter Email.")
		emailID.focus();
		return false;
	}

	if (echeck(emailID.value)==false){
		emailID.value="";
		emailID.focus();
		return false;
	}
   
//   if(document.getElementById('apiun').value.search(/\S/) == "-1")
//   {
//      alert("Please Enter Api Username.");
//      document.getElementById('apiun').focus();
//	  return false;
//   }
//   
//   if(document.getElementById('apipas').value.search(/\S/) == "-1")
//   {
//      alert("Please Enter Api Password.");
//      document.getElementById('apipas').focus();
//	  return false;
//   }
//   
//   if(document.getElementById('apisig').value.search(/\S/) == "-1")
//   {
//      alert("Please Enter Api Signature.");
//      document.getElementById('apisig').focus();
//	  return false;
//   }
//   
//   if(document.getElementById('paypal_pt').value.search(/\S/) == "-1")
//   {
//      alert("Please Enter Paypal Pro Type.");
//      document.getElementById('paypal_pt').focus();
//	  return false;
//   }
//   
//   if(document.getElementById('paypalbid').value.search(/\S/) == "-1")
//   {
//      alert("Please Enter Paypal Business id.");
//      document.getElementById('paypalbid').focus();
//	  return false;
//   }
//  
//   if(document.getElementById('paypalst').value.search(/\S/) == "-1")
//   {
//      alert("Please Enter Paypal Standard Type.");
//      document.getElementById('paypalsta').focus();
//	  return false;
//   }
//   
//   if(document.getElementById('nocoinreg').value.search(/\S/) == "-1")
//   {
//      alert("Please Enter Number Coin Register.");
//      document.getElementById('nocoinreg').focus();
//	  return false;
//   }
//   if(document.getElementById('adsence1').value.search(/\S/) == "-1")
//   {
//      alert("Please Enter Ad Sence1.");
//      document.getElementById('adsence1').focus();
//	  return false;
//   }
//   if(document.getElementById('adsence2').value.search(/\S/) == "-1")
//   {
//      alert("Please Enter Number Ad Sence2.");
//      document.getElementById('adsence2').focus();
//	  return false;
//   }

}
</script>

<div class="clear"></div>
<?php if($this->session->userdata('success_msg')) { ?>
<div id="success" class="info_div" style="margin-left:8px;margin-right:8px;margin-bottom:5px;">
	<span class="ico_success"><?php echo $this->session->userdata('success_msg'); ?></span> 
</div>
<?php 
$this->session->unset_userdata('success_msg');
} 
?>
<form name="frmUser" id="frmUser" method="post" onsubmit="return validation();" action="<?php echo base_url()?>admin/home/admin_setting_edit/">
<div class="box_bg">
<div class="clear"></div>
<div style="margin: 27px 5px;">
<div class="clear"></div>
<div class="arti">Change Admin Settings</div>
<div class="clear"></div>
<div class="white_box2" style="width:97%;">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="level">
<tr>
    <td width="18%">Username <span style="color: #eb8207;">* </span> </td>
    <td width="82%"><input name="admin_username" id="admin_username" type="text" value="<?php echo $admin_info["username"]; ?>" class="textfield2" style="width:300px;" /></td>
</tr>

<tr>
    <td>First Name <span style="color: #eb8207;">* </span> </td>
    <td><input name="fname" id="fname" type="text" value="<?php echo $admin_info["fname"]; ?>" class="textfield2" style="width:300px;" /></td>
</tr>
<tr>
    <td>Last Name <span style="color: #eb8207;">* </span> </td>
    <td><input name="lname" id="lname" type="text" value="<?php echo $admin_info["lname"]; ?>" class="textfield2" style="width:300px;" /></td>
</tr>
<tr>
    <td>Email <span style="color: #eb8207;">* </span> </td>
    <td><input name="admin_email" id="admin_email" type="text" value="<?php echo $admin_info["email"]; ?>" class="textfield2" style="width:300px;" /></td>
</tr>
<tr>
    <td>Api Username <span style="color: #eb8207;">* </span> </td>
    <td><input name="apiun" id="apiun" type="text" value="<?php echo $admin_info["api_un"]; ?>" class="textfield2" style="width:300px;" /></td>
</tr>
<tr>
    <td>Api Password <span style="color: #eb8207;">* </span> </td>
    <td><input name="apipas" id="apipas" type="text" value="<?php echo $admin_info["api_pass"]; ?>" class="textfield2" style="width:300px;" /></td>
</tr>
<tr>
    <td>Api Signature <span style="color: #eb8207;">* </span> </td>
    <td><input name="apisig" id="apisig" type="text" value="<?php echo $admin_info["api_sign"]; ?>" class="textfield2" style="width:300px;" /></td>
</tr>
<tr>
    <td>Paypal Pro Type <span style="color: #eb8207;">* </span> </td>
    <td><input name="paypal_pt" id="paypal_pt" type="text" value="<?php echo $admin_info["paypal_pro_type"]; ?>" class="textfield2" style="width:300px;" /></td>
</tr>
<tr>
    <td>Paypal Business id <span style="color: #eb8207;">* </span> </td>
    <td><input name="paypalbid" id="paypalbid" type="text" value="<?php echo $admin_info["paypal_busi_id"]; ?>" class="textfield2" style="width:300px;" /></td>
</tr>
<tr>
    <td>Paypal Standard Type <span style="color: #eb8207;">* </span> </td>
    <td><input name="paypalst" id="paypalst" type="text" value="<?php echo $admin_info["paypal_sta_type"]; ?>" class="textfield2" style="width:300px;" /></td>
</tr>
<tr>
    <td>Active Female Sub  </td>
    <td>
	<input name="afs" id="afsy" type="radio" value="1" class="textfield2" <?php if($admin_info["active_female_sub"]==1) { ?> checked="checked"<?php }?> style="margin:  0 6px 0 0;" />
	<label for="afsy" style="float: left; margin:  0 30px 0 0;">Yes</label>
	<input name="afs" id="afsn" type="radio" value="0" class="textfield2" <?php if($admin_info["active_female_sub"]==0) { ?> checked="checked"<?php }?> style="margin:  0 6px 0 0;" />
	<label for="afsn" style="float: left; margin:  0;">No</label>
    </td>
</tr>
<tr>
    <td>No. Coin Register <span style="color: #eb8207;">* </span> </td>
    <td><input name="nocoinreg" id="nocoinreg" type="text" value="<?php echo $admin_info["no_coin_reg"]; ?>" class="textfield2" style="width:300px;" /></td>
</tr>
<tr>
    <td>Ad Sence1 <span style="color: #eb8207;">* </span> </td>
    <td><textarea name="adsence1" id="adsence1" class="textfield2" style="width:300px;height: 100px;"><?php echo $admin_info["ad1"];?></textarea></td>
</tr>

<tr>
    <td>Ad Sence2 <span style="color: #eb8207;">* </span> </td>
    <td><textarea name="adsence2" id="adsence2" class="textfield2" style="width:300px;height: 100px;"><?php echo $admin_info["ad2"];?></textarea></td>
</tr>

<tr>
    <td><span style="color: #eb8207;"> </span> </td>
    <td><input type="submit" name="submit" value="submit" class="btn2"></td>
</tr>
</table>
</div>

<div class="clear"></div>
</div>
</div>
</form>

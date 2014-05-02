<script language="javascript" type="text/javascript">
function validation()
{
   if(document.getElementById('old_password').value.search(/\S/) == "-1")
   {
      alert("Please Enter Old Password");
      document.getElementById('old_password').focus();
	  return false;
   }
   
   if(document.getElementById('new_password').value.search(/\S/) == "-1")
   {
      alert("Please Enter New Password");
      document.getElementById('new_password').focus();
	  return false;
   }

   if(document.getElementById('c_new_password').value.search(/\S/) == "-1")
   {
      alert("Please Enter Confirm New Password");
      document.getElementById('c_new_password').focus();
	  return false;
   }
   
   if(document.getElementById('c_new_password').value!=document.getElementById('new_password').value)
   {
      alert("New password and confirm new password both should be same");
      document.getElementById('c_new_password').focus();
	  return false;
   }
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
<?php if($this->session->userdata('error_msg')) { ?>
<div id="fail" class="info_div" style="margin-left:8px;margin-right:8px;margin-bottom:5px;">
	<span class="ico_cancel"><?php echo $this->session->userdata('error_msg'); ?></span>
</div>
<?php 
$this->session->unset_userdata('error_msg');
} 
?>
<div class="box_bg">
<div class="clear"></div>
<div style="margin: 37px 5px;">
<div class="arti">Change Password</div>
<div class="clear"></div>
<div class="white_box2" style="width:97%;">

<form name="frmUser" id="frmUser" method="post" onsubmit="return validation();" action="<?php echo base_url()?>admin/home/editpass/">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="level">
<tr>
    <td>Old Password <span style="color: #eb8207;">* </span> </td>
    <td><input name="old_password" id="old_password" type="password" value="" class="textfield2" style="width:300px;" /></td>
</tr>

<tr>
    <td>New Password <span style="color: #eb8207;">* </span> </td>
    <td><input name="new_password" id="new_password" type="password" value="" class="textfield2" style="width:300px;" /></td>
</tr>

<tr>
    <td>Confirm New Password <span style="color: #eb8207;">* </span> </td>
    <td><input name="c_new_password" id="c_new_password" type="password" value="" class="textfield2" style="width:300px;" /></td>
</tr>

<tr>
    <td><span style="color: #eb8207;"> </span> </td>
    <td><input type="submit" name="submit" value="submit" class="btn2"></td>
</tr>
</table>
</form>
</div>
<div class="clear"></div>
</div>
</div>

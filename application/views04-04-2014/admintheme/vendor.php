<script language="javascript" type="text/javascript">

function validation()
{
   if(document.getElementById('admin_username').value.search(/\S/) == "-1")
   {
      alert("Please Enter Username.");
      document.getElementById('admin_username').focus();
	  return false;
   }
   if(document.getElementById('pass').value.search(/\S/) == "-1")
   {
      alert("Please Enter Password");
      document.getElementById('pass').focus();
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
<form name="frmUser" id="frmUser" method="post" onsubmit="return validation();" action="">
<div class="box_bg">
<div class="clear"></div>
<div style="margin: 27px 5px;">
<div class="clear"></div>
<div class="arti">Vendor Registration</div>
<div class="clear"></div>
<div class="white_box2" style="width:97%;">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="level">
<tr>
    <td width="18%">Username <span style="color: #eb8207;">* </span> </td>
    <td width="82%"><input name="admin_username" id="admin_username" type="text" value="" class="textfield2" style="width:300px;" /></td>
</tr>

<tr>
    <td>Password <span style="color: #eb8207;">* </span> </td>
    <td><input name="pass" id="pass" type="password" value="" class="textfield2" style="width:300px;" /></td>
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

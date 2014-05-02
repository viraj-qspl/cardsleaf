<script language="javascript" type="text/javascript">

function validation()
{
   if(document.getElementById('pack_title').value.search(/\S/) == "-1")
   {
      alert("Please set a Package Title.");
      document.getElementById('pack_title').focus();
	  return false;
   }
   
   if(document.getElementById('pack_price').value.search(/\S/) == "-1")
   {
      alert("Please set a Package Price.");
      document.getElementById('pack_price').focus();
	  return false;
   }
   if(document.getElementById('pack_price').value != "")
   {
      filter =  /^\d*\.?\d*$/;
      if(!filter.test(document.getElementById('pack_price').value))
      {
      alert("Put Only Numbers.");
      document.getElementById('pack_price').value = '';
      document.getElementById('pack_price').focus();
	  return false;
      }
   }
   
   if(document.getElementById('pack_b').value.search(/\S/) == "-1")
   {
      alert("Please type Package Brief.");
      document.getElementById('pack_b').focus();
	  return false;
   }
   
   if(document.getElementById('pack_d').value.search(/\S/) == "-1")
   {
      alert("Please set a Package Duration.");
      document.getElementById('pack_d').focus();
	  return false;
   }
   if(document.getElementById('pack_d').value != "")
   {
      filter =  /^[0-9]{1,10}$/;
      if(!filter.test(document.getElementById('pack_d').value))
      {
      alert("Put Duration In Number Only.");
      document.getElementById('pack_d').value = '';
      document.getElementById('pack_d').focus();
	  return false;
      }
   }
   
   if(document.getElementById('pack_q').value.search(/\S/) == "-1")
   {
      alert("Please set a Package Quantity.");
      document.getElementById('pack_q').focus();
	  return false;
   }
   if(document.getElementById('pack_q').value != "")
   {
      filter =  /^[0-9]{1,10}$/;
      if(!filter.test(document.getElementById('pack_q').value))
      {
      alert("Put Quantity In Number Only.");
      document.getElementById('pack_q').value = '';
      document.getElementById('pack_q').focus();
	  return false;
      }
   }
   
   if(document.getElementById('pack_desc').value.search(/\S/) == "-1")
   {
      alert("Please type Package Description.");
      document.getElementById('pack_desc').focus();
	  return false;
   }
   //return true;
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
<div class="arti">Add Package</div>
<div class="clear"></div>
<div class="white_box2" style="width:97%;">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="level">
<tr>
    <td width="18%">Package Title <span style="color: #eb8207;">* </span> </td>
    <td width="82%"><input name="pack_title" id="pack_title" type="text" value="" class="textfield2" style="width:300px;" /></td>
</tr>
<tr>
    <td width="18%">Package Price <span style="color: #eb8207;">* </span> </td>
    <td width="82%"><span style="float: left; margin-right: 5px;line-height: 27px;color:#999;font-size: 25px;">$</span><input name="pack_price" id="pack_price" type="text" value="" class="textfield2" style="width:282px;" /></td>
</tr>
<tr>
    <td>Package Brief <span style="color: #eb8207;">* </span> </td>
    <td><input name="pack_b" id="pack_b" type="text" value="" class="textfield2" style="width:300px;" /></td>
</tr>
<tr>
    <td>Package Duration <span style="color: #eb8207;">* </span> </td>
    <td><input name="pack_d" id="pack_d" type="text" value="" class="textfield2" style="width:300px;" />&nbsp;/ Month</td>
</tr>
<tr>
    <td>Package Quantity <span style="color: #eb8207;">* </span> </td>
    <td><input name="pack_q" id="pack_q" type="text" value="" class="textfield2" style="width:300px;" />&nbsp;Cards / Month</td>
</tr>
<tr>
    <td>Package Description <span style="color: #eb8207;">* </span> </td>
    <td><textarea name="pack_desc" id="pack_desc" class="ckeditor textarea_bg"></textarea></td>
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

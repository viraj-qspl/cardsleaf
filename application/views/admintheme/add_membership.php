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
   if(document.getElementById('membership_name').value.search(/\S/) == "-1")
   {
      alert("Please Enter Membership Name");
      document.getElementById('membership_name').focus();
	  return false;
   }
   
   if(document.getElementById('amount').value.search(/\S/) == "-1")
   {
      alert("Please Enter Amount");
      document.getElementById('amount').focus();
	  return false;
   }
   
   if (document.getElementById('life_timen').checked == true)
   if(document.getElementById('exp_time').value.search(/\S/) == "-1")
   {
      alert("Please Enter Expire Time");
      document.getElementById('exp_time').focus();
	  return false;
   }
   
   if(document.getElementById('shrtdes').value.search(/\S/) == "-1")
   {
      alert("Please Enter Short Description.");
      document.getElementById('shrtdes').focus();
	  return false;
   }
   

}

function changevalue(eleind)
{
	(eleind.checked == true) ? eleind.value = 1 : eleind.value = 0;
}

function li_enable(ltid)
{
	if (ltid.id == 'life_timey')
	{
		document.getElementById('exp_time').value = '';
		document.getElementById('exp_time').setAttribute("disabled","disabled");
	}
	else 
	{
		if (ltid.id == 'life_timen')
		{
			document.getElementById('exp_time').removeAttribute("disabled");
		}
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
<div class="arti">Add Membership Plan</div>
<div class="clear"></div>
<div class="white_box2" style="width:97%;">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="level">
<tr>
    <td width="18%">Membership Plan Name <span style="color: #eb8207;">* </span> </td>
    <td width="82%"><input name="membership_name" id="membership_name" type="text" value="" class="textfield2" style="width:300px;" /></td>
</tr>

<tr>
    <td>Amount <span style="color: #eb8207;">* </span> </td>
    <td><input name="amount" id="amount" type="text" value="" class="textfield2" style="width:300px;" /></td>
</tr>
<tr>
    <td>Expire-time <span style="color: #eb8207;">* </span> </td>
    <td><input name="exp_time" id="exp_time" type="text" value="" class="textfield2" style="width:300px;" />&nbsp; month(s)</td>
</tr>
<tr>
    <td>Life Time </td>
    <td>
	<input name="life_time" id="life_timey" type="radio" value="1" class="textfield2" style="margin:  0 6px 0 0;" onclick="li_enable(this)" />
	<label for="life_timey" style="float: left; margin:  0 30px 0 0;">Yes</label>
	<input name="life_time" id="life_timen" type="radio" value="0" class="textfield2" checked="checked" style="margin: 0 6px 0 0;" onclick="li_enable(this)" />
	<label for="life_timen" style="float: left; margin:  0;">No</label>
    </td>
</tr>
<tr>
    <td>Short Description <span style="color: #eb8207;">* </span> </td>
    <td><textarea name="shrtdes" id="shrtdes" class="textfield2" style="width:300px; height: 100px;"></textarea></td>
</tr>
<tr>
    <td>Best Plan</td>
    <td><input name="bestplan" id="bestplan" type="checkbox" value="0" onclick="changevalue(this)" class="textfield2" style="width:300px;" /></td>
</tr>
<tr>
    <td>Recurring</td>
    <td><input name="recurring" id="recurring" type="checkbox" value="0" onclick="changevalue(this)" class="textfield2" style="width:300px;" /></td>
</tr>
<tr>
    <td><span style="color: #eb8207;"> </span> </td>
    <td><input type="submit" name="submit" value="Add Membership Plan" class="btn2"></td>
</tr>
</table>
</div>

<div class="clear"></div>
</div>
</div>
</form>

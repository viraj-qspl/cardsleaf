<script type="text/javascript">
function validate()
{	
	var valid=true;
	
	var name=document.getElementById('name');	
	
	if(name.value == '' || name.value == null)
	{
		alert("Please enter country name!");	
		valid=false;
	}	
	
	return valid;
}
function save()
{
	if(validate())
	{
		document.getElementById("action").value = 'save';
		document.getElementById("frmCountry").submit();
	}
}

function save_close()
{
	if(validate())
	{
		document.getElementById("action").value = 'save_new';
		document.getElementById("frmCountry").submit();
	}
}

function cancel()
{
	
}
</script>
<div id="maindiv">
<div>
<div class="box_in2">
<div class="article_left"><span style="vertical-align: top; float: left; margin: 0 10px 0 5px;"><img src="images/article_img.png" border="0" /></span> <h3>Country Manager: Edit Country </h3> </div>
<div class="article_right">
	<ul>
		<li><span><a style="cursor:pointer;" onclick="save();"><img src="<?php echo $this->config->item('admin_theme_url')?>images/save_img.png" border="0" /></a></span><br /> <a style="cursor:pointer;" onclick="save();">Save</a></li>
		<li><span><a style="cursor:pointer;" onclick="save_close();"><img src="<?php echo $this->config->item('admin_theme_url')?>images/Save-&-Close_img.png" border="0" /></a></span><br /> <a style="cursor:pointer;" onclick="save_close();">Save & Close</a></li>
        <li style="border-left: 1px solid #c7c7c7; padding-left: 10px;"><span><a style="cursor:pointer;" href="<?php echo site_url('admin/country/index'); ?>"><img src="<?php echo $this->config->item('admin_theme_url')?>images/Cancle_img.png" border="0" /></a></span><br /> <a style="cursor:pointer;" href="<?php echo site_url('admin/country/index'); ?>">Cancel</a></li>
    </ul>
</div>
<div class="clear"></div>
</div>

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


<div class="box_in2">
<div class="white_box2" style="width:1090px;">
<div class="arti">Edit Country </div>
<div class="clear"></div>


<form name="frmCountry" id="frmCountry" method="post" action="">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="level">
<input type="hidden" name="action" id="action" value="" />
<tr>
    <td>Country Name <span style="color: #eb8207;">* </span> </td>
    <td><input name="name" id="name" type="text" value="<?php echo $country['name']; ?>" class="textfield2" style="width: 235px;"/></td>
</tr>
</table>
</form>




</div>

<div class="clear"></div>
</div>
<div class="clear"></div>
</div>

</div>
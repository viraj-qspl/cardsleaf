<script type="text/javascript">
function validate()
{
	//alert('hi')
	var valid=true;
	
	var cat_name=document.getElementById('cat_name');	
	
	if(cat_name.value == '' || cat_name.value == null)
	{
		alert("Please enter category name!");	
		valid=false;
	}	
	
	return valid;
}

function save()
{
	if(validate())
	{
		document.getElementById("action").value = 'save';
		document.getElementById("frmCategory").submit();
	}
}

function save_close()
{
	if(validate())
	{
		document.getElementById("action").value = 'save_new';
		document.getElementById("frmCategory").submit();
	}
}

function cancel()
{
	
}
</script>
<div id="maindiv">
<div>
<div class="box_in2">
<div class="article_left"><span style="vertical-align: top; float: left; margin: 0 10px 0 5px;"><img src="images/article_img.png" border="0" /></span> <h3>Category Manager: Add Category </h3> </div>
<div class="article_right">
	<ul>
		<a style="cursor:pointer;" onclick="save();"><li><span><img src="<?php echo $this->config->item('admin_theme_url')?>images/save_img.png" border="0" /></span><br /> <a style="cursor:pointer;" onclick="save();">Save</a> </li></a>
		<a style="cursor:pointer;" onclick="save_close();"><li><span><img src="<?php echo $this->config->item('admin_theme_url')?>images/Save-&-Close_img.png" border="0" /></span><br /> <a style="cursor:pointer;" onclick="save_close();">Save & Close </a></li></a>
		
        <?php if($cat_id==0) { ?>
        <li style="border-left: 1px solid #c7c7c7; padding-left: 10px;"><span><a style="cursor:pointer;" href="<?php echo site_url('admin/category/index'); ?>"><img src="<?php echo $this->config->item('admin_theme_url')?>images/Cancle_img.png" border="0" /></a></span><br /> <a style="cursor:pointer;" href="<?php echo site_url('admin/category/index'); ?>">Cancel </a></li>
		<?php } else { ?>
        <li style="border-left: 1px solid #c7c7c7; padding-left: 10px;"><span><a style="cursor:pointer;" href="<?php echo site_url('admin/category'); ?>"><img src="<?php echo $this->config->item('admin_theme_url')?>images/Cancle_img.png" border="0" /></a></span><br /> <a style="cursor:pointer;" href="<?php echo site_url('admin/category/index'.'/'.$cat_id); ?>">Cancel </a></li>
        <?php } ?>
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
<div class="arti">New Category </div>
<div class="clear"></div>


<form name="frmCategory" id="frmCategory" method="post" action="">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="level">
<input type="hidden" name="action" id="action" value="" />
<input type="hidden" name="parent_id" id="parent_id" value="<?php echo $cat_id; ?>" />
<tr>
    <td>Category name <span style="color: #eb8207;">* </span> </td>
    <td><input name="cat_name" id="cat_name" type="text" value="" class="textfield2" style="width: 235px;"/></td>
</tr>
</table>
</form>




</div>

<div class="clear"></div>
</div>
<div class="clear"></div>
</div>

</div>
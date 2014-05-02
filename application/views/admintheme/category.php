<script type="text/javascript">
function active()
{
	document.getElementById("status").value = 'Y';
	document.tblCategory.action = "<?php echo site_url('admin/category/changeStatus'); ?>";
	document.getElementById("tblCategory").submit();
}

function deactive()
{
	document.getElementById("status").value = 'N';
	document.tblCategory.action = "<?php echo site_url('admin/category/changeStatus'); ?>";
	document.getElementById("tblCategory").submit();
}

function edit()
{
	$("input[type=checkbox]:checked").each ( function() {
		var cat_id = $(this).val();
		window.location = "<?php echo site_url('admin/category/edit'); ?>"+"/"+cat_id;
	});
	
}
</script>
<div class="box_in2">
<div class="article_left"><span style="vertical-align: top; float: left; margin: 0 10px 0 5px;"><img src="<?php echo $this->config->item('admin_theme_url')?>images/article_img.png" border="0" /></span><h3><?php echo $menu_title; ?></h3> </div>
<div class="article_right_alt">
	<ul>
		
        <?php if($cat_id==0) { ?>
        <li><span><a href="<?php echo site_url('admin/category/add'); ?>"><img src="<?php echo $this->config->item('admin_theme_url')?>images/icon-32-new.png" border="0" /></a></span><br /> <a href="<?php echo site_url('admin/category/add'); ?>">New</a></li>
		<?php } else { ?>
        <li><span><a href="<?php echo site_url('admin/category/add'.'/'.$cat_id); ?>"><img src="<?php echo $this->config->item('admin_theme_url')?>images/icon-32-new.png" border="0" /></a></span><br /> <a href="<?php echo site_url('admin/category/add'.'/'.$cat_id); ?>">New</a></li>
        <?php } ?>
        
        <li><span><a style="cursor:pointer;" onclick="edit();"><img src="<?php echo $this->config->item('admin_theme_url')?>images/icon-48-edit.png" border="0" /></a></span><br /> <a style="cursor:pointer;" onclick="edit();">Edit</a></li>
		<li><span><a style="cursor:pointer;" href="<?php echo site_url('admin/category/index'); ?>"><img src="<?php echo $this->config->item('admin_theme_url')?>images/icon-32-trash.png" border="0" /></a></span><br /> <a style="cursor:pointer;" href="<?php echo site_url('admin/category/index'); ?>">Trash </li>
		
        <li><span><a style="cursor:pointer;" onclick="active();"><img src="<?php echo $this->config->item('admin_theme_url')?>images/icon-32-unblock.png" border="0" /></a></span><br /> <a style="cursor:pointer;" onclick="active();">Active</a></li>
        
        <li><span><a style="cursor:pointer;" onclick="deactive();"><img src="<?php echo $this->config->item('admin_theme_url')?>images/icon-32-unpublish.png" border="0" /></a></span><br /> <a style="cursor:pointer;" onclick="deactive();">Inactive</a></li>
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



<div class="admin_cont">
<div class="clear"></div>
<div class="box_bg">
<div class="clear"></div>
<!--<div style="margin: 14px 10px;">
    <ul>
    
        <li>Filtter</li>
        <li><input type="text" name="textfield" style="background: #FFFFFF; width: 190px; border: 1px solid #CCCCCC;"/></li>
        <li><input type="submit" name="Submit" value="Search" class="adminbtn"/></li>
        <li><input type="submit" name="Submit" value="Clear" class="adminbtn"/></li>
        
        <li><img src="<?php echo $this->config->item('admin_theme_url')?>images/spacer.gif" width="365" height="1" border="0" /></li>
        
        <li>
        <select name="select" style="background: #FFFFFF; width: 150px; border: 1px solid #CCCCCC;">
        <option value="">select status</option>
        <option value="Y">active</option>
        <option value="N">inactive</option>
        </select>
        </li>
        
    </ul>
</div>-->
<div class="clear"></div>
<div class="box_in">
<!--<form action="<?php echo site_url('admin/category/action'); ?>" name="tblCategory" id="tblCategory" method="post">-->
<form action="" name="tblCategory" id="tblCategory" method="post">
<input type="hidden" name="status" id="status" value="" />
<input type="hidden" name="cat_id" id="cat_id" value="<?php echo $cat_id; ?>" />
<!--<input type="hidden" name="func" id="func" value="" />-->
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="list_box1">
    <tr>
      <td width="5%" style="padding: 0 0 0 15px;"><strong>#</strong></td>
      <th width="50%"><strong>Category name</strong></th>
      <td width="25%"><strong>Status</strong></td>
      <td width="20%"><strong>Subcategory</strong></td>
    </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="list_box">

<?php
if(count($category)>0)
{
$i=1;
?>
	<?php foreach($category as $cat) 
	{ 
		if($i%2!=0)
		{
			?>
			<tr>
				<td width="5%"><input name="category[]" type="checkbox" value="<?php echo $cat["id"]; ?>" /></td>
				<td width="50%" style="text-align: left;"><a href="<?php echo site_url('admin/category/index').'/'.$cat["id"]; ?>"> <?php echo $cat["cat_name"]; ?> </a></td> 
                <?php if($cat["status"]=='Y') { ?>
				<td width="25%"><img src="<?php echo $this->config->item('admin_theme_url')?>images/right.png" border="0" /></td>
                <?php } else { ?>
                <td width="25%"><img src="<?php echo $this->config->item('admin_theme_url')?>images/inactive.png" border="0" /></td>
                <?php } ?>
                
				<td width="20%"><input name="" type="text" value="<?php echo $cat["sub_count"]; ?>" class="textfield1" disabled="disabled" /></td>
			</tr>
			<?php
		} 
		else
		{
		?>
		
		<tr class="color_01">
				<td width="5%"><input name="category[]" type="checkbox" value="<?php echo $cat["id"]; ?>" /></td>
				<td width="50%" style="text-align: left;"><a href="<?php echo site_url('admin/category/index').'/'.$cat["id"]; ?>"> <?php echo $cat["cat_name"]; ?> </a></td> 
                <?php if($cat["status"]=='Y') { ?>
				<td width="25%"><img src="<?php echo $this->config->item('admin_theme_url')?>images/right.png" border="0" /></td>
                <?php } else { ?>
                <td width="25%"><img src="<?php echo $this->config->item('admin_theme_url')?>images/inactive.png" border="0" /></td>
                <?php } ?>
                
				<td width="20%"><input name="" type="text" value="<?php echo $cat["sub_count"]; ?>" class="textfield1" disabled="disabled" /></td>
		</tr>
		
		<?php 
		}
		$i++;
	} 
	?>
<?php
}
else
{
	
	?>
    <tr class="color_01">
        <td width="5%">&nbsp;</td>
        <td width="50%" style="text-align: right;color:#C00;">No data available</td> 
        <td width="25%">&nbsp;</td>
        <td width="25%">&nbsp;</td>
        <td width="20%">&nbsp;</td>
    </tr>
	<?php

}

?>
  
</table>
</form>

</div>



<div class="clear"></div>
</div>
</div>


<script type="text/javascript">
function active()
{
	document.getElementById("status").value = '1';
	document.tblProduct.action = "<?php echo site_url('admin/cms/changeStatus'); ?>";
	document.getElementById("tblProduct").submit();
}

function deactive()
{
	document.getElementById("status").value = '0';
	document.tblProduct.action = "<?php echo site_url('admin/cms/changeStatus'); ?>";
	document.getElementById("tblProduct").submit();
}

function edit()
{
	$("input[type=checkbox]:checked").each ( function() {
		var cms_id = $(this).val();		
		window.location = "<?php echo site_url('admin/cms/edit'); ?>"+"/"+cms_id;
	});
	
}
</script>
<div class="box_in2">
<div class="article_left"><span style="vertical-align: top; float: left; margin: 0 10px 0 5px;"><img src="<?php echo $this->config->item('admin_theme_url')?>images/article_img.png" border="0" /></span><h3><?php echo $menu_title; ?></h3> </div>
<div class="article_right_alt">
	<ul>	
    	<li>&nbsp;</li>	
        <li>&nbsp;</li>
        <?php /*?><a href="<?php echo site_url('admin/cms/add'); ?>"><li><span><img src="<?php echo $this->config->item('admin_theme_url')?>images/icon-32-new.png" border="0" /></span><br /> <a href="<?php echo site_url('admin/cms/add'); ?>">New</li></a> </a><?php */?>
        <a style="cursor:pointer;" onclick="edit();"><li><span><img src="<?php echo $this->config->item('admin_theme_url')?>images/icon-48-edit.png" border="0" /></span><br /> <a style="cursor:pointer;" onclick="edit();">Edit</a></li></a>
		<?php /*?><a style="cursor:pointer;" href="<?php echo site_url('admin/cms/index'); ?>"><li><span><img src="<?php echo $this->config->item('admin_theme_url')?>images/icon-32-trash.png" border="0" /></span><br /> <a style="cursor:pointer;" href="<?php echo site_url('admin/cms/index'); ?>">Trash </li></a></a><?php */?>
		
        <a style="cursor:pointer;" onclick="active();"><li><span><img src="<?php echo $this->config->item('admin_theme_url')?>images/icon-32-unblock.png" border="0" /></span><br /> <a style="cursor:pointer;" onclick="active();">Active</a></li></a>
        
        <a style="cursor:pointer;" onclick="deactive();"><li><span><img src="<?php echo $this->config->item('admin_theme_url')?>images/icon-32-unpublish.png" border="0" /></span><br /> <a style="cursor:pointer;" onclick="deactive();">Inactive</a></li></a>
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
        
        <li><img src="<?php echo $this->config->item('admin_theme_url')?>images/spacer.gif" width="715" height="1" border="0" /></li>
        
        <li>
        <select name="select" style="background: #FFFFFF; width: 80px; border: 1px solid #CCCCCC;">
        <option value="">status</option>
        <option value="Y">active</option>
        <option value="N">inactive</option>
        </select>
        </li>
        
    </ul>
</div>-->
<div class="clear"></div>
<div class="box_in">
<!--<form action="<?php echo site_url('admin/cms/action'); ?>" name="tblCategory" id="tblCategory" method="post">-->
<form action="" name="tblProduct" id="tblProduct" method="post">
<input type="hidden" name="status" id="status" value="" />
<!--<input type="hidden" name="func" id="func" value="" />-->
<input type="hidden" name="cms_id" id="cms_id" value="<?php echo $cms_id; ?>" />
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="list_box1">
    <tr>
      <td width="5%" style="padding: 0 0 0 15px;"><strong>#</strong></td>
      <th width="15%" style="text-align: left;"><strong>Page Name</strong></th>
      <th width="15%" style="text-align: left;"><strong>Page Title</strong></th>
      <th width="55%" style="text-align: left;"><strong>Content</strong></th>
      <td width="10%"><strong>Status</strong></td>
    </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="list_box">

<?php

if(count($cmspage)>0)
{
$i=1;
?>
	<?php foreach($cmspage as $cmspage) 
	{ 
		if($i%2!=0)
		{
			?>
			<tr>
				<td width="5%" style="vertical-align:top;"><input name="cms_id[]" id="cms_id" type="checkbox" value="<?php echo $cmspage["cms_id"]; ?>" /></td>
                <td width="15%" style="text-align: left; vertical-align:top;"><?php echo $cmspage["cms_pagename"]; ?></td> 
                <td width="15%" style="text-align: left; vertical-align:top;"><?php echo stripslashes($cmspage["cms_title"]); ?></td> 
				<td width="55%" style="text-align: left;"><?php echo stripslashes($cmspage["cms_content"]); ?></td> 
                <?php if($cmspage["cms_status"]=='1') { ?>
				<td width="10%" style="vertical-align:top;"><img src="<?php echo $this->config->item('admin_theme_url')?>images/right.png" border="0" /></td>
                <?php } else { ?>
                <td width="10%" style="vertical-align:top;"><img src="<?php echo $this->config->item('admin_theme_url')?>images/inactive.png" border="0" /></td>
                <?php } ?>
			</tr>
			<?php
		} 
		else
		{
		?>
		
		<tr class="color_01">
				<td width="5%" style="vertical-align:top;"><input name="cms_id[]" id="cms_id" type="checkbox" value="<?php echo $cmspage["cms_id"]; ?>" /></td>
                <td width="15%" style="text-align: left; vertical-align:top;"><?php echo $cmspage["cms_pagename"]; ?></td> 
                <td width="15%" style="text-align: left; vertical-align:top;"><?php echo stripslashes($cmspage["cms_title"]); ?></td> 
				<td width="55%" style="text-align: left;"><?php echo stripslashes($cmspage["cms_content"]); ?></td>                             
                <?php if($cmspage["cms_status"]=='1') { ?>
				<td width="10%" style="vertical-align:top;"><img src="<?php echo $this->config->item('admin_theme_url')?>images/right.png" border="0" /></td>
                <?php } else { ?>
                <td width="10%" style="vertical-align:top;"><img src="<?php echo $this->config->item('admin_theme_url')?>images/inactive.png" border="0" /></td>
                <?php } ?>
                
                
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
      <td width="100%" style="text-align: right;color:#C00;" colspan="5">No data available</td> 
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

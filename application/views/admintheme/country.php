<script type="text/javascript">
function edit()
{
	$("input[type=checkbox]:checked").each ( function() {
		var country_id = $(this).val();
		window.location = "<?php echo site_url('admin/country/edit'); ?>"+"/"+country_id;
	});
	
}

function trash()
{
	$("input[type=checkbox]:checked").each ( function() {
		var country_id = $(this).val();
		window.location = "<?php echo site_url('admin/country/trash'); ?>"+"/"+country_id;
	});
	
}
</script>
<div class="box_in2">
<div class="article_left"><span style="vertical-align: top; float: left; margin: 0 10px 0 5px;"><img src="<?php echo $this->config->item('admin_theme_url')?>images/article_img.png" border="0" /></span><h3><?php echo $menu_title; ?></h3> </div>
<div class="article_right_alt" style="width:162px;">
	<ul>
		
        <li><span><a href="<?php echo site_url('admin/country/add'); ?>"><img src="<?php echo $this->config->item('admin_theme_url')?>images/icon-32-new.png" border="0" /></a></span><br /> <a href="<?php echo site_url('admin/country/add'); ?>">New</a></li>
        <li><span><a style="cursor:pointer;" onclick="edit();"><img src="<?php echo $this->config->item('admin_theme_url')?>images/icon-48-edit.png" border="0" /></a></span><br /> <a style="cursor:pointer;" onclick="edit();">Edit</a></li>
		<li><span><a style="cursor:pointer;" onclick="trash();"><img src="<?php echo $this->config->item('admin_theme_url')?>images/icon-32-trash.png" border="0" /></a></span><br /> <a style="cursor:pointer;" onclick="trash();">Trash </a></li>
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
        
        
    </ul>
</div>-->
<div class="clear"></div>
<div class="box_in">
<form action="" name="tblCountry" id="tblCountry" method="post">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="list_box1">
    <tr>
      <td width="5%" style="padding: 0 0 0 15px;"><strong>#</strong></td>
      <th width="50%"><strong>Category name</strong></th>
      <td width="45%"><strong>State count</strong></td>
    </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="list_box">

<?php
if(count($country)>0)
{
$i=1;
?>
	<?php foreach($country as $cont) 
	{ 
		if($i%2!=0)
		{
			?>
			<tr>
				<td width="5%"><input name="country[]" type="checkbox" value="<?php echo $cont["id"]; ?>" /></td>
				<td width="50%" style="text-align: left;"><a href="<?php echo site_url('admin/state/index').'/'.$cont["id"]; ?>"> <?php echo $cont["name"]; ?> </a></td>                 
				<td width="45%"><input name="" type="text" value="<?php echo $cont["state_count"]; ?>" class="textfield1" disabled="disabled" /></td>
			</tr>
			<?php
		} 
		else
		{
			?>
			<tr class="color_01">
				<td width="5%"><input name="country[]" type="checkbox" value="<?php echo $cont["id"]; ?>" /></td>
				<td width="50%" style="text-align: left;"><a href="<?php echo site_url('admin/state/index').'/'.$cont["id"]; ?>"> <?php echo $cont["name"]; ?> </a></td>                 
				<td width="45%"><input name="" type="text" value="<?php echo $cont["state_count"]; ?>" class="textfield1" disabled="disabled" /></td>
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
        <td width="45%">&nbsp;</td>
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

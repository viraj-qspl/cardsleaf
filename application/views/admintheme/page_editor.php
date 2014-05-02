<div class="clear"></div>
<?php if($this->session->userdata('success_msg')) { ?>
<div id="success" class="info_div" style="margin-left:8px;margin-right:8px;margin-bottom:5px;">
	<span class="ico_success"><?php echo $this->session->userdata('success_msg'); ?></span> 
</div>
<?php 
$this->session->unset_userdata('success_msg');
} 
?>
<div class="box_bg">
<div class="clear"></div>
<div style="margin: 37px 5px;">
<div class="clear"></div>
<div class="arti">Page Content</div>
<div class="clear"></div>
<div class="white_box2" style="width:97%;">

<form method="post" name="pagefrm" id="pagefrm" action="<?php $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="level">
<tr>
    <td>Page Title</td>
    <td><input type="text" name="pagetitle" id="pagetitle" class="textfield2" style="width:300px;" value="<?php if(isset($pagecontent['page_name'])) echo $pagecontent['page_name'];?>" /></td>
</tr>

<tr>
    <td valign="top" style="vertical-align:text-top;">Page Content</td>
    <td><textarea name="content" id="content" class="ckeditor textarea_bg"><?php echo html_entity_decode($pagecontent['page_content']); ?></textarea></td>
</tr>

<tr>
    <td><span style="color: #eb8207;"> </span> </td>
    <td><input type="submit" name="pagesubmit" value="Submit" class="btn2"></td>
</tr>
</table>
</form>
</div>
<div class="clear"></div>
</div>
</div>

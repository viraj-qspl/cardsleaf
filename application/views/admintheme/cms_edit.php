<style type="text/css">
.styled_select2 {
	width: 245px; 
	margin: 0;
}
.space {
	height:25px;	
}
</style>
<script type="text/javascript">
function save()
{
	document.getElementById("action").value = 'save';
	document.getElementById("frmCMS").submit();
}

function save_close()
{
	document.getElementById("action").value = 'save_new';
	document.getElementById("frmCMS").submit();
}

</script>

<div id="maindiv">
<div>
<div class="box_in2">
<div class="article_left"><span style="vertical-align: top; float: left; margin: 0 10px 0 5px;"><img src="images/article_img.png" border="0" /></span> <h3>CMS Page Manager: Edit Page </h3> </div>
<div class="article_right">
	<ul>
		<a style="cursor:pointer;" onclick="save();"><li><span><img src="<?php echo $this->config->item('admin_theme_url')?>images/save_img.png" border="0" /></span><br /> <a style="cursor:pointer;" onclick="save();">Save</a> </li></a>
		<a style="cursor:pointer;" onclick="save_close();"><li><span><img src="<?php echo $this->config->item('admin_theme_url')?>images/Save-&-Close_img.png" border="0" /></span><br /> <a style="cursor:pointer;" onclick="save_close();">Save & Close </a></li></a>
        <a style="cursor:pointer;" href="<?php echo site_url('admin/cms/index'); ?>"><li style="border-left: 1px solid #c7c7c7; padding-left: 10px;"><span><img src="<?php echo $this->config->item('admin_theme_url')?>images/Cancle_img.png" border="0" /></span><br /> <a style="cursor:pointer;" href="<?php echo site_url('admin/cms/index'); ?>">Cancel </li></a></a>
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
    <div class="arti">Edit CMS Page</div>
    <div class="clear"></div>



    <form name="frmCMS" id="frmCMS" method="post" action="" enctype="multipart/form-data">
        <input type="hidden" name="action" id="action" value="" />
        <input type="hidden" name="parent_id" id="parent_id" value="<?php echo $cmscontent['cms_id']; ?>" />
        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="level">
            
            <tr>
                <td width="10%">Page Title <span style="color: #eb8207;">* </span> </td>
                <td width="90%"><input name="cms_title" id="cms_title" type="text" value="<?php echo stripslashes($cmscontent['cms_title']); ?>" class="textfield2" style="width: 705px;"/></td>
            </tr>
        	
            <tr>
                <td style="vertical-align:top;">Page Content <span style="color: #eb8207;">* </span></td>
                <td style="width:500px;"><textarea id="cms_content" name="cms_content" class="ckeditor"><?php echo stripslashes($cmscontent['cms_content']); ?></textarea></td>
            </tr>
        </table>
    </form>
</div>

<div class="clear"></div>
</div>
<div class="clear"></div>
</div>

</div>
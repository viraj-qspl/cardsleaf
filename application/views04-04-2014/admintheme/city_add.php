<script type="text/javascript">
function validate()
{
	var valid=true;
	
	var name=document.getElementById('name');	
	
	if(name.value == '' || name.value == null)
	{
		alert("Please enter city name!");	
		valid=false;
	}
	
	return valid;
}
function save()
{
	if(validate())
	{
		document.getElementById("action").value = 'save';
		document.getElementById("frmCity").submit();
	}
}

function save_close()
{
	if(validate())
	{
		document.getElementById("action").value = 'save_new';
		document.getElementById("frmCity").submit();
	}
}

function getStateList(country_id)
{
		$.ajax
		({
			type: "POST",
			url: "<?php echo site_url('admin/ajax/getStateList'); ?>/"+country_id,
			/*data: "cat_id="+catid,*/
			success: function(msg)
			{ 
				var oBox = document.getElementById("state_id");
				oBox.options.length = 0;
				
				
				var arr = msg.split('|');
				oBox.options[0] = new Option('Select state', "");
				if(msg!='')
				{
					for(i = 0; i < arr.length; i++)
					{
						var subcat = arr[i].split('#');
						oBox.options[i+1] = new Option(subcat[1], subcat[0]);
					}
				}
				
			}
		});
}
</script>
<div id="maindiv">
<div>
<div class="box_in2">
<div class="article_left"><span style="vertical-align: top; float: left; margin: 0 10px 0 5px;"><img src="images/article_img.png" border="0" /></span> <h3><?php echo $menu_title; ?></h3> </div>
<div class="article_right">
	<ul>
		<a style="cursor:pointer;" onclick="save();"><li><span><img src="<?php echo $this->config->item('admin_theme_url')?>images/save_img.png" border="0" /></span><br /> <a style="cursor:pointer;" onclick="save();">Save</a> </li></a>
		<a style="cursor:pointer;" onclick="save_close();"><li><span><img src="<?php echo $this->config->item('admin_theme_url')?>images/Save-&-Close_img.png" border="0" /></span><br /> <a style="cursor:pointer;" onclick="save_close();">Save & Close </a></li></a>
        <a style="cursor:pointer;" href="<?php echo site_url('admin/city/index'); ?>"><li style="border-left: 1px solid #c7c7c7; padding-left: 10px;"><span><img src="<?php echo $this->config->item('admin_theme_url')?>images/Cancle_img.png" border="0" /></span><br /> <a style="cursor:pointer;" href="<?php echo site_url('admin/city/index'); ?>">Cancel </li></a></a>
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
<div class="arti">New City </div>
<div class="clear"></div>


<form name="frmCity" id="frmCity" method="post" action="">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="level">
<input type="hidden" name="action" id="action" value="" />
<tr>
    <td>City name <span style="color: #eb8207;">* </span> </td>
    <td><input name="name" id="name" type="text" value="" class="textfield2" style="width: 235px;"/></td>
</tr>

<tr>
    <td style="vertical-align:top;">Select country <span style="color: #eb8207;">* </span></td>
    <td>
        <div class="styled_select2" style=" width: 245px; margin: 0;">
            <select name="country_id" id="country_id" class="" style="width: 245px;" onchange="getStateList(this.value)">
                <option style="width:240px;" value="">select country</option>
                <?php foreach($country as $cont) { ?>
                <option style="width:240px;" value="<?php echo $cont["id"]; ?>"><?php echo $cont["name"]; ?></option>
                <?php } ?>
            </select>
        </div>
    </td>
</tr>

<tr>
    <td style="vertical-align:top;">Select state <span style="color: #eb8207;">* </span></td>
    <td>
        <div class="styled_select2" style=" width: 245px; margin: 0;">
            <select name="state_id" id="state_id" class="" style="width: 245px;">
                <option style="width:240px;" value="">select state</option>
            </select>
        </div>
    </td>
</tr>


</table>
</form>




</div>

<div class="clear"></div>
</div>
<div class="clear"></div>
</div>

</div>
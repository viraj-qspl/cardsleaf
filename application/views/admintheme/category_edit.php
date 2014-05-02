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

function showSubCategores(catid, divNum)
{
	var parentsElement = document.getElementsByName('parents[]');
	document.getElementById("catboxIndex").value = divNum;
	
	removeElement(divNum+1, parentsElement.length);
	
	if (catid == "") return;
	
	$.ajax
	({
		type: "POST",
		url: "<?php echo site_url('admin/ajax/getSubCat'); ?>/"+catid,
		/*data: "cat_id="+catid,*/
		success: function(msg)
		{ 
				//$('#cat_edit_box').html(msg);
				//$('#cat_edit_box').append(msg);
				if(msg!='')
				addSubCatBox(msg);
		}
	});	
}

function removeElement(fromDivId, totDiv)
{
	for (i = fromDivId; i <= totDiv; i++)
	{
		var d = document.getElementById("catList");
		var oDiv = document.getElementById("catList" + i);
		var ospaceDiv = document.getElementById("spaceId" + i);
		
		d.removeChild(ospaceDiv);
		d.removeChild(oDiv);
	}
}

function addSubCatBox(strSubCatList)
{
	var ni   = document.getElementById("catList");
	var numi = document.getElementById("catboxIndex");
	var num  = (numi.value -1)+ 2;
	numi.value = num;
	
	var spacediv = document.createElement('div');
	var spacedivId = "spaceId" + num;
	
	spacediv.setAttribute('id', spacedivId);
	var divSpaceClass = "space";
	spacediv.setAttribute('class', divSpaceClass);
	
	
	
	
	var newdiv = document.createElement('div');
	var divId = "catList" + num;
	
	newdiv.setAttribute('id', divId);
	
	
	var divClass = "styled_select2";
	newdiv.setAttribute('class', divClass);

	var oBox = document.createElement("select");
	oBox.name = "parents[]";
	
	var arr = strSubCatList.split('|');
	//alert(arr[4]);
	oBox.options[0] = new Option('Select Sub-Category', "");
	for(i = 0; i < arr.length; i++)
	{
		var subcat = arr[i].split('#');
		oBox.options[i+1] = new Option(subcat[1], subcat[0]);
	}
	oBox.style.width = "240px";
	oBox.onchange = function() { showSubCategores(this.value, num);}
	newdiv.appendChild(oBox);
	
	ni.appendChild(spacediv);
	ni.appendChild(newdiv);
}
</script>
<div id="maindiv">
<div>
<div class="box_in2" id="box">
<div class="article_left"><span style="vertical-align: top; float: left; margin: 0 10px 0 5px;"><img src="images/article_img.png" border="0" /></span> <h3>Category Manager: Edit Category </h3> </div>
<div class="article_right">
	<ul>
		<a style="cursor:pointer;" onclick="save();"><li><span><img src="<?php echo $this->config->item('admin_theme_url')?>images/save_img.png" border="0" /></span><br /> <a style="cursor:pointer;" onclick="save();">Save</a> </li></a>
		<a style="cursor:pointer;" onclick="save_close();"><li><span><img src="<?php echo $this->config->item('admin_theme_url')?>images/Save-&-Close_img.png" border="0" /></span><br /> <a style="cursor:pointer;" onclick="save_close();">Save & Close </a></li></a>
		
        <?php if($cat_id==0) { ?>
        <li style="border-left: 1px solid #c7c7c7; padding-left: 10px;"><span><a style="cursor:pointer;" href="<?php echo site_url('admin/category/index'); ?>"><img src="<?php echo $this->config->item('admin_theme_url')?>images/Cancle_img.png" border="0" /></a></span><br /> <a style="cursor:pointer;" href="<?php echo site_url('admin/category/index'); ?>">Cancel</a></li>
		<?php } else { ?>
        <li style="border-left: 1px solid #c7c7c7; padding-left: 10px;"><span><a style="cursor:pointer;" href="<?php echo site_url('admin/category'); ?>"><img src="<?php echo $this->config->item('admin_theme_url')?>images/Cancle_img.png" border="0" /></a></span><br /> <a style="cursor:pointer;" href="<?php echo site_url('admin/category'); ?>">Cancel</a></li>
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
<input type="hidden" name="cat_id" id="cat_id" value="<?php echo $cat_id; ?>" />
<input type="hidden" name="parent_id" id="parent_id" value="<?php echo $category["parent_id"]; ?>" />


<tr>
    <td>Category name <span style="color: #eb8207;">* </span> </td>
    <td><input name="cat_name" id="cat_name" type="text" value="<?php echo $category["cat_name"]; ?>" class="textfield2" style="width: 235px;"/></td>
</tr>

<tr>
    <td style="vertical-align:top;">Change parent category <span style="color: #eb8207;">* </span></td>
    <td>
    <div id="catList"> 
    <input type="hidden" id="catboxIndex" value="<?php echo count($parent); ?>" />
        
            <div id="catList1" class="styled_select2" style=" width: 245px; margin: 0;">
                <select name="parents[]" style="width: 245px;"  onChange="showSubCategores(this.value, 1);">
                    <option style="width:240px;" value="0">select category</option>
                    <?php foreach($parent as $cat) { ?>
                        <option style="width:240px;" value="<?php echo $cat["id"]; ?>"><?php echo $cat["cat_name"]; ?></option>
                    <?php } ?>
                </select>
            </div>
     </div>
    </td>
</tr>


<tr>
    <td style="vertical-align:top;">Select status <span style="color: #eb8207;">* </span></td>
    <td>
    <div class="styled_select2" style=" width: 245px; margin: 0;">
        <select name="status" style="width: 245px;">
            <option style="width:240px;" value="">select status</option>
                <option style="width:240px;" value="Y" <?php if($category["status"]=='Y') { ?> selected="selected" <?php } ?>>active</option>
                <option style="width:240px;" value="N" <?php if($category["status"]=='N') { ?> selected="selected" <?php } ?>>inactive</option>
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
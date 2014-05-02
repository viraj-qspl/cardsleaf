<!-- add/edit gifts -->
<?php
if($this->session->flashdata('msg'))
{
    echo '<div>'.$this->session->flashdata('msg').'</div>';
}
?>

<script>
function validation()
{
   if(document.getElementById('gift_name').value.search(/\S/) == "-1")
   {
      alert("Please Enter Gift Name");
      document.getElementById('gift_name').focus();
	  return false;
   }
   if(document.getElementById('gift_coins').value.search(/\S/) == "-1")
   {
      alert("Please Enter No Of Coins");
      document.getElementById('gift_coins').focus();
	  return false;
   }
}
</script>

<div class="clear"></div>
<?php
$id = '';
$gift_name = '';
$gift_coins = '';
$img_url = '';
if(isset($gift_info) && !empty($gift_info))
{
    $id = $gift_info['id'];
    $gift_name = $gift_info['gift_title'];
    $gift_coins = $gift_info['gift_coins'];
    $img_url = '<div><img src="'.base_url().'uploads/'.$gift_info['gift_image'].'" width="50px" height="40px" /></div>';
}
?>

<form name="frmUser" id="frmUser" method="post" onsubmit="return validation();" action="<?php site_url('admin/gifts/add_gifts')?>" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $id ?>" />
    <div class="box_bg">
        <div class="clear"></div>
        <div style="margin: 27px 5px;">
            <div class="clear"></div>
            <div class="arti">Add/Edit Gifts</div>
            <div class="clear"></div>
            <div class="white_box2" style="width:97%;">
                <table width="100%" border="0" cellspacing="0" cellpadding="0" class="level">
                    <tr>
                        <td width="18%">Gift Name <span style="color: #eb8207;">* </span> </td>
                        <td width="82%"><input name="gift_name" id="gift_name" type="text" value="<?php echo $gift_name ?>" class="textfield2" style="width:300px;" /></td>
                    </tr>
                    <tr>
                        <td width="18%">Coins <span style="color: #eb8207;">* </span> </td>
                        <td width="82%"><input name="gift_coins" id="gift_coins" type="text" value="<?php echo $gift_coins ?>" class="textfield2" style="width:300px;" /></td>
                    </tr>
                    <tr>
                        <td width="18%">Select Image(min: 124x97) <span style="color: #eb8207;">* </span> </td>
                        <td width="82%">
                            <input name="gift_image" id="gift_image" type="file" class="textfield2" style="width:300px;" />
                            <?php echo $img_url ?>
                        </td>
                    </tr>
                    <tr>
                        <td><span style="color: #eb8207;"> </span> </td>
                        <td><input type="submit" name="submit" value="Save" class="btn2"></td>
                    </tr>
                </table>
            </div>
        <div class="clear"></div>
        </div>
    </div>
</form>

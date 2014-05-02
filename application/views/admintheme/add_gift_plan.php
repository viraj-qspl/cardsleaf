<div class="clear"></div>
<?php
$id = '';
$gift_plan = '';
$no_coins = '';
$rel_price = '';
if(!empty($plan_info))
{
    $id = $plan_info['id'];
    $gift_plan = $plan_info['plan_name'];
    $no_coins = $plan_info['tot_coins'];
    $rel_price = $plan_info['rel_price'];
}
?>
<script>
function validation()
{
   if(document.getElementById('gift_plan_name').value.search(/\S/) == "-1")
   {
        alert("Please Enter Gift Plan Name");
        document.getElementById('gift_plan_name').focus();
        return false;
   }
   if(document.getElementById('tot_coins').value.search(/\S/) == "-1")
   {
        alert("Please Enter No Of Coins");
        document.getElementById('tot_coins').focus();
        return false;
   }
   if(document.getElementById('rel_price').value.search(/\S/) == "-1")
   {
        alert("Please Enter Price");
        document.getElementById('rel_price').focus();
        return false;
   }
   
}
</script>
<form name="frmUser" id="frmUser" method="post" onsubmit="return validation();" action="<?php site_url('admin/gifts/add_gifts_plans')?>" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $id ?>" />
    <div class="box_bg">
        <div class="clear"></div>
        <div style="margin: 27px 5px;">
            <div class="clear"></div>
            <div class="arti">Add/Edit Gifts Plan</div>
            <div class="clear"></div>
            <div class="white_box2" style="width:97%;">
                <table width="100%" border="0" cellspacing="0" cellpadding="0" class="level">
                    <tr>
                        <td width="18%">Gift Plan Name <span style="color: #eb8207;">* </span> </td>
                        <td width="82%"><input name="gift_plan_name" id="gift_plan_name" type="text" value="<?php echo $gift_plan ?>" class="textfield2" style="width:300px;" /></td>
                    </tr> 
                    <tr>
                        <td width="18%">Total Coins Credited <span style="color: #eb8207;">* </span> </td>
                        <td width="82%"><input name="tot_coins" id="tot_coins" type="text" value="<?php echo $no_coins ?>" class="textfield2" style="width:300px;" /></td>
                    </tr> 
                    <tr>
                        <td width="18%">Total Price <span style="color: #eb8207;">* </span> </td>
                        <td width="82%"><input name="rel_price" id="rel_price" type="text" value="<?php echo $rel_price ?>" class="textfield2" style="width:300px;" /></td>
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

                    
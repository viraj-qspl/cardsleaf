<!-- Gift Plans List -->

<div class="admin_cont">
<div class="clear"></div>
<div class="clear"></div>
<div class="box_bg">
<div class="clear"></div>
<div style="margin: 37px 5px;">
<div class="clear"></div>
<div class="arti">List Gifts</div>

<div class="box_in">
  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="list_box1">
    <tr>
        <td width="11%" style="text-align:center;"><strong>Plan ID</strong></td>
        <td width="11%" style="text-align:center;"><strong>Plan Name</strong></td>
        <td width="11%" style="text-align:center;"><strong>Total Coins</strong></td>
        <td width="11%" style="text-align:center;"><strong>Price</strong></td>
        <td width="11%" style="text-align:center;"><strong>Edit</strong></td>
        <td width="11%" style="text-align:center;"><strong>Delete</strong></td>
    </tr>
  </table>
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="list_box">
        <?php
            if(count($gift_plans) > 0)
            {
                $i=1;
                foreach ($gift_plans as $gift)
                {
                    $i++;
                    $class = ($i%2==0) ? 'color_01': "";
          ?>
    <tr class="<?php echo $class?>"> 
        <td width="11%" style="text-align:center;"><?php echo $gift['id']?></td>
        <td width="11%" style="text-align:center;"><?php echo $gift['plan_name']?></td>
        <td width="11%" style="text-align:center;"><?php echo $gift['tot_coins']?></td>
        <td width="11%" style="text-align:center;"><?php echo $gift['rel_price']?></td>
        <td width="11%" style="text-align:center;"><a href="<?php echo site_url('admin/gifts/add_gifts_plan/'.$gift['id']) ?>">Edit</a></td>
        <td width="11%" style="text-align:center;"><a onclick="return confirm('Are you sure to delete this gift?')" href="<?php echo site_url('admin/gifts/delete_plan/'.$gift['id']) ?>">Delete</a></td>

    </tr>
        <?php
                }
            }
            else 
            {
        ?>
    
    <tr><td colspan="9"><font color="#FF0000">No Plans found.</font></td></tr>
            <?php 
            } 
            ?>
    </table>
</div>
<div class="clear"></div>
</div>
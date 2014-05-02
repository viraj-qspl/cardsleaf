<!-- Gifts List -->
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
        <td width="11%" style="text-align:center;"><strong>Gifts ID</strong></td>
        <td width="11%" style="text-align:center;"><strong>Gifts Name</strong></td>
        <td width="11%" style="text-align:center;"><strong>Req. Coins</strong></td>
        <td width="11%" style="text-align:center;"><strong>Gifts Image</strong></td>
        <td width="11%" style="text-align:center;"><strong>Status</strong></td>
        <td width="11%" style="text-align:center;"><strong>Edit</strong></td>
        <td width="11%" style="text-align:center;"><strong>Delete</strong></td>
        
    </tr>
  </table>
  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="list_box">
        <?php
            if(count($gift_info) > 0)
            {
                $i=1;
                foreach ($gift_info as $gift)
                {
                    $i++;
                    $class = ($i%2==0) ? 'color_01': "";
          ?>
    <tr class="<?php echo $class?>">
        <td width="11%" style="text-align:center;"><?php echo $gift['id']?></td>
        <td width="11%" style="text-align:center;"><?php echo $gift['gift_title']?></td>
        <td width="11%" style="text-align:center;"><?php echo $gift['gift_coins']?></td>
        <td width="11%" style="text-align:center;"><img src="<?php echo base_url();?>uploads/<?php echo $gift['gift_image']?>" width="50px" height="60px" /></td>
        <td width="11%" style="text-align:center;">
            <a href="<?php echo site_url('admin/gifts/change_status/'.$gift['id'].'/'.$gift['is_active']) ?>">
                <?php echo ($gift['is_active'] == 1) ? '<span style="color:#006600">Active</span>' : '<span style="color:#ff0000">Inactive</span>'?>
            </a>
        </td>
        <td width="11%" style="text-align:center;"><a href="<?php echo site_url('admin/gifts/add_gifts/'.$gift['id']) ?>">Edit</a></td>
        <td width="11%" style="text-align:center;"><a onclick="return confirm('Are you sure to delete this gift?')" href="<?php echo site_url('admin/gifts/delete/'.$gift['id']) ?>">Delete</a></td>
    </tr>
        <?php
                }
            }
            else 
            {
        ?>
    
    <tr><td colspan="9"><font color="#FF0000">No Gifts found.</font></td></tr>
            <?php 
            } 
            ?>
    </table>
</div>
<div class="clear"></div>
</div>


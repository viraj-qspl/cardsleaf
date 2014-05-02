<script>
function clearing()
{
document.getElementById("searchfield").value="";
document.searchuser.submit();
}

</script>
<?php if($this->session->userdata('success_msg')) { ?>
<div id="success" class="info_div" style="margin-left:8px;margin-right:8px;margin-bottom:5px;">
	<span class="ico_success"><?php echo $this->session->userdata('success_msg'); ?></span> 
</div>
<?php 
$this->session->unset_userdata('success_msg');
} 
?>
<div class="admin_cont">
<div class="clear"></div>
<div class="clear"></div>
<div class="box_bg">
<div class="clear"></div>
<div style="margin: 14px 10px;">
<!--<ul>
<li>Filter</li>
<form name="searchuser" id="searchuser" method="post" action="">
<li><input type="text" name="searchfield"  id="searchfield" style="background: #FFFFFF; width: 190px; border: 1px solid #CCCCCC;" value="<?php echo $searchitem; ?>"/></li>
<li><input type="submit" name="Submit" value="Search" class="adminbtn"/></li>
<li><input type="button" name="clear" value="Clear" class="adminbtn" onclick="clearing()"/></li>
</form>
<li><img src="<?php echo $this->config->item('admin_theme_url')?>images/spacer.gif" width="165" height="1" border="0" /></li>
</ul>-->
</div>
<div class="clear"></div>
<div style="margin: 37px 5px;">
<div class="clear"></div>
<div class="arti">List Membership Plan</div>

<div class="box_in">
  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="list_box1">
    <tr>
    
      <td width="11%" style="text-align:center;"><strong>Membership Plane Name</strong></td>
      <td width="11%" ><strong>Amount</strong></td>
      <td width="7%" ><strong>Expire time<br />(in month)</strong></td>
      <td width="7%" ><strong>Life time</strong></td>
      <td width="18%" ><strong>Short Description</strong></td>
      <td width="7%" ><strong>Best Plan</strong></td>
      <td width="7%" ><strong>Recurring</strong></td>
      <td width="11%" ><strong>Post Date</strong></td>
      <td width="5%" ><strong>Edit</strong></td>
      <td width="5%" ><strong>Delete</strong></td>
    </tr>
  </table>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="list_box">
<?php
//print_r($memshipDtls);
if($memshipDtls)
{
$i=1;
foreach($memshipDtls as $membershipplaninfo)
{ 
	$i++;
	if($i%2==0) $class='color_01'; else $class="";
?>
  <tr class="<?php echo $class ?>">
    <td width="11%"  style="padding: 0 0 0 15px;"><?php echo $membershipplaninfo['name']; ?></td>
    <td width="11%"><?php echo $membershipplaninfo['amt']; ?></td>
    <td width="7%"><?php if($membershipplaninfo['expduration'] != 0) echo $membershipplaninfo['expduration']; else echo '--';?></td>
    <td width="7%"><?php if($membershipplaninfo['lifetime']==1) { ?>Yes<?php } else { ?> No <?php } ?></td>
    <td width="18%"><?php echo $membershipplaninfo['shrt_des']; ?></td>
    <td width="7%"><?php if($membershipplaninfo['best_plan']==1) { ?>Yes<?php } else { ?> -- <?php } ?></td>
    <td width="7%"><?php if($membershipplaninfo['recur']==1) { ?>Yes<?php } else { ?> -- <?php } ?></td>
    <td width="11%"><?php echo $membershipplaninfo['post_date']; ?></td>
    <td width="5%"><a href="<?php echo site_url('admin/membershipplan/editmemshipplan/'.$membershipplaninfo['mpid']); ?>">Edit</a></td>
    <td width="5%"><a href="<?php echo site_url('admin/membershipplan/deletememshipplan/'.$membershipplaninfo['mpid']); ?>" onclick="return confirm('Are you sure want to delete this plan?');">Delete</a></td>
  </tr>
  <?php 
  	$i++;
    } 
  } 
  else 
  {
  ?>
  <tr><td colspan="9"><font color="#FF0000">No Membership Plan found.</font></td></tr>
  <?php 
  } 
  ?>
</table>
</div>
<div class="clear"></div>
</div>

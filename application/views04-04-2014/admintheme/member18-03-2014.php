<script>
function clearing()
{
document.getElementById("searchfield").value="";
document.searchuser.submit();
}

function download_img(pic)
{
	window.location = "<?php echo base_url()?>admin/member/dnimg/"+pic;
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
</div>
<div class="clear"></div>
<div style="margin: 37px 5px;">
<div class="clear"></div>
<div class="arti">Member List</div>

<div class="box_in">
  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="list_box">
    <tr>
       <td><strong>First Name</strong></td>
       <td><strong>Last Name</strong></td>
      <td><strong>Email</strong></td>
      <?php /*?><td><strong>Country</strong></td>
      <td><strong>State</strong></td>
      <td><strong>City</strong></td>
      <td><strong>Zip</strong></td><?php */?>
      <td><strong>First Page Image</strong></td>
      <td><strong>Date</strong></td>
     <!-- <td width="7%" ><strong>Status</strong></td>-->
      <td><strong>Delete</strong></td>
    </tr>
  <!--</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="list_box">-->
<?php
//echo "<pre>";print_r($allmemberinfo);echo "</pre>";
if(count($allmemberinfo)>0)
{
$i=1;
foreach($allmemberinfo as $allmemberinfo)
{ 
	$i++;
	if($i%2==0) $class='color_01'; else $class="";
?>
  <tr class="<?php echo $class ?>">
 
    <td><?php echo $allmemberinfo['fname']; ?></td>
    <td><?php echo $allmemberinfo['lname']; ?></td>
    <td><?php echo $allmemberinfo['email']; ?></td>
    <?php /*?><td><?php echo $allmemberinfo['country_name']; ?></td>
    <td><?php echo $allmemberinfo['state_name']; ?></td>
    <td><?php echo $allmemberinfo['city']; ?></td>
    <td><?php echo $allmemberinfo['zip']; ?></td><?php */?>
    
    <td><a href='javascript:void(0);' onclick='download_img("<?php echo $allmemberinfo['image0']; ?>")'>
    <img alt='img_alt_text' height=75 width=75 src="<?php echo base_url()?>media/cards_image/large/<?php echo $allmemberinfo['image0']; ?>" ></a></td>
    <td><?php echo $allmemberinfo['post_date']; ?></td>
    <!--<td width="7%"><a href="<?php echo base_url()?>admin/member/change_status/<?php echo  $allmemberinfo['user_id']; ?>/<?php echo $allmemberinfo['status']; ?>"><font color="<?php echo $allmemberinfo['status'] == 0 ? '#660000' : '#006600';?>"><?php echo $allmemberinfo['status'] == 0 ? 'Inactive' : 'Active';?></font></a></td>-->
    <td><a href="<?php echo $this->config->item('admin_url')?>member/delete/<?php echo $allmemberinfo['user_id'];?>" onclick="return confirm('Are you sure you want to delete this member?');">Delete</a></td>
  </tr>
  <?php 
  	$i++;
    } 
   ?>
	<?php if($total_rows>10) { ?> 
	<tr>
		<td colspan="9" style="text-align:right; padding-right:30px;"><?php echo $links; ?></td>
	</tr>
    <?php } ?>
  <?php 
  } 
  else 
  {
  ?>
  <tr><td colspan="9"><font color="#FF0000">No member found</font></td></tr>
  <?php 
  } 
  ?>
</table>
</div>
<div class="clear"></div>
</div>

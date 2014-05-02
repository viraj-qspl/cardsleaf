<script>
function clearing()
{
document.getElementById("searchfield").value="";
document.searchuser.submit();
}

function edit_pack(pid)
{
	if(confirm('Are you want to edit this package?'))
	window.location = "<?php echo base_url()?>admin/home/editpackage/"+pid;
}
function delete_pack(pid)
{
	if(confirm('Are you want to delete this package?'))
	window.location = "<?php echo base_url()?>admin/home/deletepackage/"+pid;
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
      <td><strong>Package Title</strong></td>
      <td><strong>Price of Package</strong></td>
      <td><strong>Package Brief</strong></td>
      <td><strong>Package Duration</strong></td>
      <td><strong>Package Quantity</strong></td>
      <td><strong>Package Description (Short)</strong></td>
      <td width="7%" ><strong>Edit</strong></td>
      <?php /*?><td><strong>Delete</strong></td><?php */?>
    </tr>
  <!--</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="list_box">-->
<?php
//echo "<pre>";print_r($allPackage);echo "</pre>";//exit;
if(count($allmemberinfo)>0)
{
$i=1;
foreach($allPackage as $eachallPackage)
{ 
	$i++;
	if($i%2==0) $class='color_01'; else $class="";
?>
  <tr class="<?php echo $class ?>">
 
    <td><?php echo $eachallPackage['pack_title']; ?></td>
    <td><?php echo $eachallPackage['pack_price']; ?></td>
    <td><?php echo $eachallPackage['pack_duration']; ?></td>
    <td><?php echo $eachallPackage['pack_quantity']; ?></td>
    <td><?php echo html_entity_decode($eachallPackage['pack_brief']); ?></td>
    <td><?php echo substr(html_entity_decode($eachallPackage['pack_desc']),0,40); ?></td>
    <td><a style="cursor: pointer;" onclick="edit_pack(<?php echo $eachallPackage['pid']; ?>)">Edit</a></td>
    <?php /*?><td><a style="cursor: pointer;" onclick="delete_pack(<?php echo $eachallPackage['pid']; ?>)">Delete</a></td><?php */?>

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

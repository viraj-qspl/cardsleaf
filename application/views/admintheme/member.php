<script type="text/javascript" src="<?php echo $this->config->item('admin_theme_url');?>fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('admin_theme_url');?>js/handlebars-v1.3.0.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('admin_theme_url');?>fancybox/jquery.fancybox-1.3.4.css" media="screen" />

<script type="text/x-handlebars-template" id="option">
	<option value="{{value}}">{{name}}</option>
</script>

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
function download_pdf(pic)
{
	window.location = "<?php echo base_url()?>admin/member/dnpdf/"+pic;
}
function download_zip(pic)
{
	window.location = "<?php echo base_url()?>admin/member/dnzip/"+pic;
}

$(document).ready(function() {
	
	$("a.receiver").click(function() {
	
		$("#receiver").css('display','block');
		$("#vendor").css('display','none');
		sendData = {"img":$(this).attr('pic')}
		$.ajax({
		url: '<?php echo base_url();?>ajax/getreceiverdetails',
		data: sendData,
		type: 'POST',
		cache: false,
		success: function(response){
					var obj = jQuery.parseJSON(response);
					
					$('#rname').html(obj.name);
					$('#lname').html(obj.lname);
					$('#rddt').html(obj.delivery_dt);
					$('#rcountry').html(obj.cname);
					$('#radd').html(obj.reciver_add1);
					$('#rstate').html(obj.sname);
					$('#rcity').html(obj.city);
					$('#rzip').html(obj.zipcode);
					$('#rcontact').html(obj.contactno);
					
					$('#print_').attr("value",obj.img_id);
					
					$("#popup_"+$(this).attr('pic')).trigger("click");
					}
		})
		
		});
		
	$("a.dispatch").click(function() {
		$("#receiver").css('display','none');
		$("#vendor").css('display','block');
		
		$("input#dispatch").css('display','block');
		$("div#dispatched").css('display','none');
		
		$('input#dispatch').attr('disabled','');		
		
		var id = $(this).attr('pic');

		
		function isEmpty(el){
			return !$.trim(el.html())
		 }	

		if($.trim($("#vendorName").html()) == '')	
		{
		
		var zone = $("#zone").val();	
		$("#modal").css('display','block');$("#modal2").css('display','block');
		$.ajax({
		url: '<?php echo base_url();?>ajax/getVendorbyZone',
		data:{"zone":zone},
		type: 'POST',
		cache: false,
		success: function(response){
		$("#modal").css('display','none');$("#modal2").css('display','none');
		var obj = jQuery.parseJSON(response);
		var template = Handlebars.compile( $("#option").html() );
		
		if(obj.length==0)
			$('input#dispatch').attr('disabled','disabled');
			
			
			
		for(i=0;i<obj.length;i++)
		{		
			
			
			var name = obj[i].fname+" "+obj[i].lname;
		
			if(name.trim()=='')
				name = obj[i].email;
				
			if(name.trim()=='')	
				name = obj[i].username;	
					
			var data = {
			name:name,
			value:obj[i].admin_id
			}
			
			$("#vendorName").append(template(data)).fadeIn();	
		}

	}
	})			 
 }
});	
	
	$('#zone').change(function()
		{
			
		$("#vendorName").html('');
		
		var zone = $("#zone").val();
		$("#modal").css('display','block');$("#modal2").css('display','block');
		$.ajax({
		url: '<?php echo base_url();?>ajax/getVendorbyZone',
		data:{"zone":zone},
		type: 'POST',
		cache: false,
		success: function(response){
		$("#modal").css('display','none');$("#modal2").css('display','none');
		var obj = jQuery.parseJSON(response);
			
		var template = Handlebars.compile( $("#option").html() );
		
		if(obj.length==0)
			$('input#dispatch').attr('disabled','disabled');
		else
			$('input#dispatch').attr('disabled','');

		for(i=0;i<obj.length;i++)
		{
			var name = obj[i].fname+" "+obj[i].lname;
		
			if(name.trim()=='')
				name = obj[i].email;

			if(name.trim()=='')	
				name = obj[i].username;	
				
			
			var data = {
			name:name,
			value:obj[i].admin_id
			}
			
			$("#vendorName").append(template(data)).fadeIn();	
		}




			
			}
		})			
	});	
	
	
	$('a.dispatch').click(function()
	{
		var imageId = ($(this).attr('pic'));
		$("#imageId").val(imageId);

	});
	
$("input#dispatch").click(function(){
	$("#modal2").html('Please Wait...');
	$("#modal").css('display','block');$("#modal2").css('display','block');
	$("#fancybox-close").css('display','none');
	$.ajax({
		url:"<?php echo base_url();?>ajax/dispatchToVendor",
		type:"POST",
		data:{"imageId":$("#imageId").val(),"vendorId":$("#vendorName").children(":selected").val()},
		cache:false,
		success: function(response)
		{
			$("#modal2").html('Loading');
			$("#modal").css('display','none');$("#modal2").css('display','none');
			$("a#dispatch_"+$("#imageId").val()).replaceWith("<span style='color:#000;font-weight:bold;'>Dispatched</span>");
			$("#fancybox-close").css('display','inline');
			
			obj = jQuery.parseJSON(response);

			if(obj.success)
			{
				$("input#dispatch").css('display','none');
				$("div#dispatched").css('display','block');

			}
			
		}
	})
})	
	
	
	
	
});


function print_()
{
	//alert($("#print_").attr('value'));
	var pic = $("#print_").attr('value');
	//sendData = {"img":$("#print_").attr('value')}
	//	$.ajax({
	//	url: '<?php echo base_url();?>ajax/print_d',
	//	data: sendData,
	//	type: 'POST',
	//	cache: false,
	//	success: function(response){}
	//	})
	
	window.location = "<?php echo base_url()?>ajax/print_/"+pic;
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
<div class="arti">Member Order List</div>

<div class="box_in">
  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="list_box">
    <tr>
       <?php /*?><td><strong>First Name</strong></td>
       <td><strong>Last Name</strong></td>
      <td><strong>Sender Email</strong></td><?php */?>
      <td><strong>Designed Image</strong></td>
      <td><strong>Pdf File</strong></td>
      <td><strong>Zip File</strong></td>
      <td><strong>Receiver Mailing details</strong></td>
      <td><strong>Delivery date</strong></td>
      <td><strong>Order Date</strong></td>
      <td><strong>Dispatch</strong></td>
    </tr>
  <!--</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="list_box">-->
<?php
//echo "<pre>";print_r($allmemberinfo);echo "</pre>";
if(!empty($allmemberinfo))
{
$i=1;
foreach($allmemberinfo as $eachallmemberinfo)
{ 
	$i++;
	if($i%2==0) $class='color_01'; else $class="";
?>
  <tr class="<?php echo $class ?>">
 
    <?php /*?><td><?php echo $allmemberinfo['fname']; ?></td>
    <td><?php echo $allmemberinfo['lname']; ?></td>
    <td><?php echo $eachallmemberinfo['email']; ?></td><?php */?>
    <?php /*?><td><?php echo $allmemberinfo['country_name']; ?></td>
    <td><?php echo $allmemberinfo['state_name']; ?></td>
    <td><?php echo $allmemberinfo['city']; ?></td>
    <td><?php echo $allmemberinfo['zip']; ?></td><?php */?>
    
    <td><a href='javascript:void(0);' onclick='download_img("<?php echo $eachallmemberinfo['image0']; ?>")'>
    <img alt='img_alt_text' height=75 width=75 src="<?php echo base_url()?>media/cards_image/large/<?php echo $eachallmemberinfo['image0']; ?>" ></a></td>
    <td><a href='javascript:void(0);' onclick='download_pdf("<?php echo $eachallmemberinfo['img_id'].'_card.pdf'; ?>")'>
    Download the pdf</a></td>
    <td><a href='javascript:void(0);' onclick='download_zip("<?php echo $eachallmemberinfo['img_id'].'.zip'; ?>")'>
    Download the zip</a></td>
    <td><a class="receiver" id="popup_<?php echo $eachallmemberinfo['img_id'];?>" href="#popupdiv" pic="<?php echo $eachallmemberinfo['img_id'];?>">Receiver Details</a>
    <script type="text/javascript">
	$(document).ready(function() {
		$("#popup_<?php echo $eachallmemberinfo['img_id'];?>").fancybox();
	});
    </script>
    </td>
     <td><?php echo $eachallmemberinfo['delivery_dt']; ?></td>
     <td><?php echo $eachallmemberinfo['order_dt']; ?></td>
   
    <!--<td width="7%"><a href="<?php echo base_url()?>admin/member/change_status/<?php echo  $eachallmemberinfo['user_id']; ?>/<?php echo $eachallmemberinfo['status']; ?>"><font color="<?php echo $eachallmemberinfo['status'] == 0 ? '#660000' : '#006600';?>"><?php echo $eachallmemberinfo['status'] == 0 ? 'Inactive' : 'Active';?></font></a></td>-->
	
    <!-- td><a href="<?php echo base_url();?>admin/member/carddispatch/<?php echo $eachallmemberinfo['user_id'];?>/<?php echo $eachallmemberinfo['img_id'];?>" onclick="return confirm('Are you sure you want to delete this member?');">Dispatch</a></td -->
	
	    <!-- td class="dispatch_<?php echo $eachallmemberinfo['img_id']; ?>"><a href="<?php echo base_url();?>admin/member/carddispatch/<?php echo $eachallmemberinfo['user_id'];?>/<?php echo $eachallmemberinfo['img_id'];?>" onclick="return confirm('Are you sure you want to delete this member?');">Dispatch</a></td -->
	
	    <td class="dispatch_<?php echo $eachallmemberinfo['img_id']; ?>">
		<?php
			if($eachallmemberinfo['dispatch_to']==0)
			{ ?>
		<a class="dispatch" pic="<?php echo $eachallmemberinfo['img_id'];?>"  id="dispatch_<?php echo $eachallmemberinfo['img_id']; ?>" href="#popupdiv" >Dispatch</a>
			<?php
			} else {?>
			<span style='color:#000;font-weight:bold;'>Dispatched</span>			
			<?php } ?>
		
		
			<script type="text/javascript">
			$(document).ready(function() {
				$("#dispatch_<?php echo $eachallmemberinfo['img_id'];?>").fancybox();
			});
			</script>			
		</td>



	
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
<div class="clear"></div>
<style type="text/css">
.receiverdetails {
	width:100%;
	float:left;
	color: #000000;
	text-align:center;
	clear:both;
	padding:0 0 10px 0;
    font: bold 16px/20px Arial,Helvetica,sans-serif;
}
.receiver_details {
	width:100%;
	float:left;
	color: #000000;
	clear:both;
	font: normal 14px/20px Arial,Helvetica,sans-serif;
	border-top:1px solid #C1C1C1;
}
.rdl {
	width:30%;
	padding:2px 5px 2px 5px;
	text-align:right;
	color:#666;
	border:1px solid #C1C1C1;
	border-top:none;
}
.rdf {
	width:70%;
	padding:2px 5px 2px 5px;
	text-align:left;
	border:1px solid #C1C1C1;
	border-top:none;
	border-left:none;
}
.rdb {
	font: normal 14px/20px Arial,Helvetica,sans-serif;
	border:1px solid #C1C1C1;
}
.rdb {
	padding:10px 0 0 0;
	border:none;
}
.rdb input {
	float:right;
}
</style>
<div style="display:none;">

<div id="popupdiv" style="width:600px;height:auto;overflow:auto; padding:5px;position:relative">
<div id="modal" style="position:absolute;width:100%;height:100%;background-color:#000;opacity:0.8;display:none;"></div>
<div id="modal2" style="position:absolute;width:100%;height:100%;text-align:center;color:#fff;display:none;">LOADING</div>
	
<div id="receiver" style="padding:10px; width:557px; margin:0 auto;">
	<div style="clear:both; height:10px;"></div>
	<!--<div style="margin-top:15px;" id="rdtls">This is dummy text.</div>-->
	<div style="margin-top:15px;">
		<div class="receiverdetails">Receiver Details</div>
		<div class="receiver_details">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
			  <tr>
				<td class="rdl">First Name:</td>
				<td class="rdf" id="rname"></td>
			  </tr>
		  <tr>
				<td class="rdl">Last Name:</td>
				<td class="rdf" id="lname"></td>
			  </tr>
		  <tr>
				<td class="rdl">Delivery Date:</td>
				<td class="rdf" id="rddt">&nbsp;</td>
			  </tr>
		  <tr>
				<td class="rdl">Country:</td>
				<td class="rdf" id="rcountry">&nbsp;</td>
			  </tr>
			  <tr>
				<td class="rdl">Address:</td>
				<td class="rdf" id="radd">&nbsp;</td>
			  </tr>
		  <tr>
				<td class="rdl">State:</td>
				<td class="rdf" id="rstate">&nbsp;</td>
			  </tr>
		  <tr>
				<td class="rdl">City:</td>
				<td class="rdf" id="rcity">&nbsp;</td>
			  </tr>
			  <tr>
				<td class="rdl">Zip:</td>
				<td class="rdf" id="rzip">&nbsp;</td>
			  </tr>
			  <tr>
				<td class="rdl">Contact Number:</td>
				<td class="rdf" id="rcontact">&nbsp;</td>
			  </tr>
		  
			  <tr>
				<td colspan="2" class="rdb"><a onclick="print_();" id="print_" value=""><input type="button" name="" value="Receiver Details" /></a></td>
			  </tr>
			</table>
		</div>
	</div>
	<div style="clear:both; height:20px;"></div>
</div>

<div id="vendor" style="padding:10px; width:557px; margin:0 auto;">


	<div style="clear:both; height:10px;"></div>
	<!--<div style="margin-top:15px;" id="rdtls">This is dummy text.</div>-->
	<div style="margin-top:15px;">
		<div class="receiverdetails">Select Vendor</div>
		<div class="receiver_details">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
			  <tr>
				<td class="rdl">Select Zone:</td>
				<td class="rdf" >
				<select name="zone" id="zone">
					<option value="N">North</option>
					<option value="S">South</option>
					<option value="E">East</option>
					<option value="W">West</option>
				</select>
				</td>
			  </tr>
			  
				<tr>
				<td class="rdl">Vendor Name:</td>
				<td class="rdf" >
				<select name="vendorName" id="vendorName">
				</select>
				</td>
			  </tr>
			  <tr>
				<td colspan="2" class="rdb"><input type="submit" name="submit" id="dispatch" value="Dispatch"/>
				<div id="dispatched" style="   color: #32CD32;display: block;font-weight: bold;text-align: right;display:none;">Dispatched</div>
				<input type="hidden" name="imageId" value="" id="imageId" />
				</td>
				
			  </tr>
			</table>
		</div>
	</div>
	<div style="clear:both; height:20px;"></div>


</div>
</div>








</div>
</div>
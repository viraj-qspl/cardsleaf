<style type="text/css">
	.message_inner3{
		cursor: pointer;
	}
	.message_inner2{
		cursor: pointer;
	}
	
.actionbgbox16{
	width: 94%;
	height: 24px;
	background: url(../images/actionbgbox1.gif) center bottom repeat-x;
	padding: 8px 20px;
	margin: 0;
}
.actionbgbox16 ul {
	padding: 0;
	margin: 0;
}
.actionbgbox16 ul li{
	padding: 0;
	margin: 0 15px 0 0;
	list-style-type: none;
	float: left;
}
.actionbgbox16 ul li i{
	height: auto;
	display: inline-block;
	padding: 0;
	border: 0;
	float: left;
}
.actionbgbox16 ul li a {
	font: bold 14px/24px Arial, Helvetica, sans-serif;
	color: #000;
	text-align: left;
	padding: 0 3px;
	background: #FFFFFF;
	border: 1px solid #CCCCCC;
	overflow: hidden;
    behavior:url(js/PIE.htc);
	behavior: url(../js/ie-css3.htc);
	border-radius: 4px;
	-moz-border-radius: 4px;
	-webkit-border-radius: 4px;
	-ms-border-radius: 4px;
 	-o-border-radius: 4px;
	-xv-border-radius: 4px;
	-khtml-border-radius: 4px;
	margin: 0;
	text-decoration: none;
	cursor: pointer;
	vertical-align: middle;
}
.actionbgbox16 ul li a:hover{
	font: bold 14px/24px Arial, Helvetica, sans-serif;
	color: #fff;
	text-align: left;
	padding: 0 3px;
	background: #333;
	border: 1px solid #000;
	overflow: hidden;
    behavior:url(js/PIE.htc);
	behavior: url(../js/ie-css3.htc);
	border-radius: 4px;
	-moz-border-radius: 4px;
	-webkit-border-radius: 4px;
	-ms-border-radius: 4px;
 	-o-border-radius: 4px;
	-xv-border-radius: 4px;
	-khtml-border-radius: 4px;
	margin: 0;
	text-decoration: none;
	cursor: pointer;
	vertical-align: middle;
}

.actionbgbox16 ul li.here{
	font: bold 14px/24px Arial, Helvetica, sans-serif;
	color: #ff0000;
	text-align: left;
	padding: 0 3px;
	overflow: hidden;
    behavior:url(js/PIE.htc);
	behavior: url(../js/ie-css3.htc);
	border-radius: 4px;
	-moz-border-radius: 4px;
	-webkit-border-radius: 4px;
	-ms-border-radius: 4px;
 	-o-border-radius: 4px;
	-xv-border-radius: 4px;
	-khtml-border-radius: 4px;
	margin: 0;
	text-decoration: none;
	cursor: pointer;
	vertical-align: middle;
}

</style>
<script type="text/javascript">
function submit_form(validity,amount){
	$('#item_name').val(validity);
	$('#amount').val(amount);
	document.getElementById("payment_form").submit();
}
</script>


<title><?php echo $site_title;?></title>
<section id="body">	
 <div id="maincontainer">		
   <div class="members_basebox">
     <div class="profile__box">
	<div class="member_headingbox">
	      <div class="member_leftpart">&nbsp;</div>
	      <div class="member_midpart">Your Private Message</div>
	      <div class="member_rightpart">&nbsp;</div>
	</div>	
	<div class="clear"></div>		
	<div class="profile_left">
		<?php include("left_panel_all_feature.php");?>
	</div>
        <?php
        $form_submit = 'subscribe/payment_receipt';
        if(isset($submit) && !empty($submit))
        {
            $form_submit = $submit;
        }
        ?>
	<div class="profile_right">
		<form method="POST" action="<?php echo $this->config->item('base_url').$form_submit?>" name="DoDirectPaymentForm">
		<input type="hidden" name="paymentType" value="<?php //echo $paymentType?>" />
		<input type="hidden" name="amount" value="<?php echo $month; ?>" />
		<input type="hidden" name="response_id" value="<?php //echo $response_id; ?>" />
		<input type="hidden" name="mode_name" value="directpayment" />
		<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="credit_box">
			<tr>
				<td colspan="3" align="left" style="padding: 0;"><h5>Credit Card</h5></td>
				<td colspan="2">&nbsp;</td>
			</tr>
			<tr>
				<td>Card Type</td>
				<th>
				<div class="dropdown">
					<select name="cardtype">
					    <option value="visa" selected="selected">Visa</option>
					    <option value="MasterCard">Master Card</option>
					    <option value="AmericanExpress">American Express</option>
					    <option value="Discover">Discover</option>
				       </select>
					   </div>					   </th>
			</tr>
			<tr>
				<td>Amount</td>
				<th style="text-align:left; font-weight:bold" colspan="2">$<?php echo $month; ?></th>
			</tr>
			<tr>
				<td>First Name</td>
				<th><input name="firstname" type="text" value="" class="textfield"  maxlength="32"></th>
			</tr>
			<tr>
				<td>Last Name</td>
				<th><input name="lastname" type="text" value="" class="textfield" maxlength="32" ></th>
			</tr>
			<tr>
				<td>Card Number</td>
				<th colspan="2"><input type="text" class="textfield" name="cardnumber"/></th>
			</tr>
			<tr>
				<td>Expiration Date</td>
				<th colspan="2">
				<div class="dropdown" style="width: 85px; margin-right: 7px;">
					<select name="cardmonth"  style="width: 116px; height:32px;">
						<option value=1>01</option>
						<option value=2>02</option>
						<option value=3>03</option>
						<option value=4>04</option>
						<option value=5>05</option>
						<option value=6>06</option>
						<option value=7>07</option>
						<option value=8>08</option>
						<option value=9>09</option>
						<option value=10>10</option>
						<option value=11>11</option>
						<option value=12>12</option>
					</select>
					</div>
					<div class="dropdown" style="width: 85px;">
					<select name="cardyear"  style="width: 116px; height:32px; float:left;">
						<?php for($i=date("Y");$i<=date("Y")+15;$i++){?>
						<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
						<?php }?>		
					</select>
					</div>
					</th>
			</tr>
			<tr>
				<td>Card Security Code</td>
				<th colspan="2"><input type="password" class="textfield" name="cardcvv" style="width:100px"/></th>
			</tr>
			<tr>
			<td colspan="3" align="left" style="padding: 0;"><h5>Billing Address</h5></td></tr>			
			<tr>
				<td>Address 1</td>
				<th colspan="2"><input type="text" class="textfield" name="address1"/></th>
			</tr>
			<tr>
				<td>Address 2</td>
				<th colspan="2"><input type="text" class="textfield" name="address2"/></th>
			</tr>
			<tr>
				<td>City</td>
				<th colspan="2"><input type="text" class="textfield" name="city"/></th>
			</tr>
			<tr>
				<td>State</td>
				<th colspan="2"><input type="text" class="textfield" name="state"/></th>
			</tr>
			<tr>
				<td>Country</td>
				<th colspan="2">
				<div class="dropdown">
				<select name="select2">
                  <?php foreach($all_country as $country){ ?>
                  <option value="<?php echo $country['iso_code_2'];?>"><?php echo $country['country_name'];?></option>
                  <?php }?>
                </select>
				</div>
				</th>
			</tr>
			<tr>
				<td>Zipcode</td>
				<th colspan="2"><input type="text" class="textfield" name="zip"  style="width:196px;"/></th>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<th colspan="2"><input type="submit" name="Submit52" class="search_btn" value="Submit" style="float:left;"/></th>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td colspan="2">&nbsp;</td>
			</tr>
		</table>
		</form>
	</div>
   </div>
   <div class="clear"></div>
 </div>				
<div class="clear"></div>
</section>
<div class="clear"></div>


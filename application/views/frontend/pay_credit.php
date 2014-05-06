<?php
//error_reporting(0);
//echo $this->session->userdata('img_id');
?>
<script src="js/jquery-1.4.4.min.js"></script>
<script src="js/slides.min.jquery.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        // validate signup form on keyup and submit
		
    $.validator.addMethod("alpha", function(value, element) {
		return this.optional(element) || value == value.match(/^[a-zA-Z]+$/);
	},"Only Characters Allowed.");		
		
		
        $("#address_form").validate({
            rules: {
                firstname:{
				required:true,
				alpha:true
				},
                lastname:{
				required:true,
				alpha:true
				},
                cardnumber: "required",
                cardcvv: "required",
                //r_zip: "required",
                //radd1: "required",
                //radd2:"required",


            },
            messages: {
                firstname: {
				required:"Please enter your first name.",
				alpha: "First Name should contain alphabets only"
				},
                lastname: {
				required:"Please enter your last name.",
				alpha: "Last Name Should contain alphabets only."
				},
                cardnumber: "Please enter your card number.",
                cardcvv: "Please enter your card cvv number.",
                //r_zip: "Please enter a your receiver zip / pincode",
                //radd1: "Please enter your receiver address 1.",
                //radd2: "Please enter your receiver address 2."

            }
        });




       // $('#or_state').css('display', 'none');

        $('#r_country').change(function() {
            var option_id = this.value;
            if (option_id == 'US') {
                $('#r_state').slideDown();
                $('#or_state').slideUp();
            }
            else {
                $('#r_state').slideUp();
                $('#or_state').slideDown();
            }

        })
    });


</script>
<!-- style type="text/css">
    .login_body {
        background: #fff;
    }
    #address_form label.error{
        display: inline;
        color: #F00;
        float: left;
        text-align: left;
        margin: 0 auto;
        font: normal 12px/17px Arial, Helvetica, sans-serif;
        text-transform: none;
        width: 335px;
    }
    .credit_box3 {
        background: none;
        border: 0;
        padding: 0;
        margin: 0 auto;
    }
    .login_form{
        width: 600px;
        /*border: 6px solid #00D8FF;*/
        margin: 0 auto 10px auto;
        /*border-radius: 5px;
        box-shadow: 0 3px 6px 0 #000;*/
    }
    .credit_box3 table.credit_box h1 {
        background: none;
    }
    .cards_basebox {
        width: auto;
        height: 30px;
        margin: 0 auto 20px auto;
        display: table;
    }
    .cards_basebox ul {
        padding: 0;
        margin: 0;
    }
    .cards_basebox ul li {
        padding: 0;
        margin: 0 5px;
        float: left;
        list-style-type: none;
        display: inline-block;
    }
    .credit_box3 table.credit_box td {
        padding: 5px 15px 5px 0;
    }
    .rightsecbox {
        width: 27%;
        float: right;
        margin: 10px 0 0 0;
    }
    .rightsecbox h5 {
        font: bold 14px/20px Arial, Helvetica, sans-serif;
        color: #333;
        text-align: left;
        margin: 0 0 10px 0;
    }
    .rightsecbox p {
        font: normal 12px/18px Arial, Helvetica, sans-serif;
        color: #777;
        text-align: left;
        padding: 0;
        margin: 0;
    }
    table.credit_box .textfield {
        height: 28px;
        line-height: 28px;
    }
    table.credit_box .dropdown select {
        height: 28px;
        line-height: 18px;
        padding: 5px 8px;
    }
</style -->
<?php

	
	$paypalSubmit = $this->session->userdata('paypalSubmit');
	if(count($paypalSubmit)>0)
	{
		$this->session->unset_userdata('paypalSubmit');
	
	}
	



?>

<title><?php echo $site_title; ?></title>

    <div class="login_body">
        <?php if ($this->session->userdata('error_msg_login')) { ?>
            <div class="msg_box"><?php echo $this->session->userdata('error_msg_login'); ?></div>
            <div class="clear"></div>
            <?php
            $this->session->unset_userdata('error_msg_login');
        }
        ?>
        <?php if ($this->session->userdata('success_msg')) { ?>
            <div class="msg_box"><?php echo $this->session->userdata('success_msg'); ?></div>
            <div class="clear"></div>
            <?php
            $this->session->unset_userdata('success_msg');
        }
        ?>
        <?php
        if ($this->session->userdata('error_msg1')) {
            $temp_msg = $this->session->userdata('error_msg1');
            if (isset($temp_msg) && $temp_msg != '') {
                ?>	
                <div class="msg_box"><?php echo urldecode(($temp_msg['L_LONGMESSAGE0'])); ?></div>
                <div class="clear"></div>
            <?php
            }
	    unset($temp_msg);
            $this->session->unset_userdata('error_msg1');
        }
        ?>
</div>



<div class="container">
<div class="content">
<h2>Payment</h2>

<div class="payment clearfix">
<div class="pay_form">

<div class="pay">
<div class="card"><a href="javascript:void(0)" style="cursor:auto"><img src="<?php echo $this->config->item('theme_url') ?>newimages/visa_logo.jpg"></a></div>
<div class="card"><a href="javascript:void(0)" style="cursor:auto"><img src="<?php echo $this->config->item('theme_url') ?>newimages/mastercard.jpg"></a></div>
<div class="card"><a href="javascript:void(0)" style="cursor:auto"><img src="<?php echo $this->config->item('theme_url') ?>newimages/american_express.jpg"></a></div>
<div class="card"><a href="javascript:void(0)" style="cursor:auto"><img src="<?php echo $this->config->item('theme_url') ?>newimages/discover.jpg"></a></div>
<div class="clear"></div>
</div><!--pay-->

	<form method="POST" action="<?php echo base_url(); ?>subscribe/payment_receipt" name="DoDirectPaymentForm" id="address_form" autocomplete="off">
		<input type="hidden" name="amount" value="<?php echo $price = ($price!='')?$price:$paypalSubmit['amount']; ?>" />
		<input name="pack" id="pack" type="hidden" value="<?php echo $pack = ($pack!='')?$pack:$paypalSubmit['pack'];?>" />

<div class="pay">
<div class="lab"><span class="red">*</span>Card Type</div>
<div class="set_input2">
                          
<?php
	if(isset($paypalSubmit['cardtype']))
		$cardtype = $paypalSubmit['cardtype'];
	else
		$cardtype = 'visa';
?>
<select name="cardtype" class="select_input">
	<option value="visa" <?php if($cardtype=='visa') echo "selected='selected'";?> >Visa</option>
	<option value="MasterCard" <?php if($cardtype=='MasterCard') echo "selected='selected'";?>>Master Card</option>
	<option value="AmericanExpress"  <?php if($cardtype=='AmericanExpress') echo "selected='selected'";?>>American Express</option>
	<option value="Discover" <?php if($cardtype=='Discover') echo "selected='selected'";?> >Discover</option>
</select>

</div><!--set_input-->
<div class="clear"></div>
</div><!--pay-->






<div class="pay">
<div class="lab"><span class="red">*</span>Card Number</div>
<div class="set_input1">
<input type="text" id="cardnumber" class="textfield pay_input" name="cardnumber" style="width: 250px;" value="<?php if(isset($paypalSubmit['cardnumber'])) echo $paypalSubmit['cardnumber']; ?>" />
</div><!--set_input-->
<div class="clear"></div>
</div><!--pay-->


<div class="pay">
		<div class="lab"><span class="red">*</span>Expiration Date</div>
			<div class="set_input3">
			
			<select name="cardmonth"  class="select_input">
			<?php
				if(isset($paypalSubmit['cardmonth']))
					$cardmonth = $paypalSubmit['cardmonth'];
				else
					$cardmonth = '1';																				
			?>
				<option <?php if($cardmonth=='1') echo "selected='selected'";?> value=1>01</option>
				<option <?php if($cardmonth=='2') echo "selected='selected'";?> value=2>02</option>
				<option <?php if($cardmonth=='3') echo "selected='selected'";?> value=3>03</option>
				<option <?php if($cardmonth=='4') echo "selected='selected'";?> value=4>04</option>
				<option <?php if($cardmonth=='5') echo "selected='selected'";?> value=5>05</option>
				<option <?php if($cardmonth=='6') echo "selected='selected'";?> value=6>06</option>
				<option <?php if($cardmonth=='7') echo "selected='selected'";?> value=7>07</option>
				<option <?php if($cardmonth=='8') echo "selected='selected'";?> value=8>08</option>
				<option <?php if($cardmonth=='9') echo "selected='selected'";?> value=9>09</option>
				<option <?php if($cardmonth=='10') echo "selected='selected'";?> value=10>10</option>
				<option <?php if($cardmonth=='11') echo "selected='selected'";?> value=11>11</option>
				<option <?php if($cardmonth=='12') echo "selected='selected'";?> value=12>12</option>
			</select>			
			</div><!--set_input3-->

		<div class="set_input4">
		
		
<select name="cardyear"  class="select_input">
<?php
	if(isset($paypalSubmit['cardyear']))
		$cardyear = $paypalSubmit['cardyear'];
	else
		$cardyear = ''
?>
	<?php for ($i = date("Y"); $i <= date("Y") + 15; $i++) { ?>
		<option <?php if($cardyear==$i) echo "selected='selected'";?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
<?php } ?>		
</select>		
		
		</div><!--set_input4-->
		
		<div class="clear"></div>
		</div><!--pay-->
		


		<div class="pay">
		<div class="lab"><span class="red">*</span>Card Security Code</div>
		<div class="set_input5">
			<input type="password" id="cardcvv" class="textfield pay_input" name="cardcvv"  maxlength="4" size="4"/>
		</div><!--set_input-->
		<div class="clear"></div>
		</div><!--pay-->

		<div class="pay">
		<div class="lab">Amount</div>
		<div class="set_input3">
		<?php
			if(isset($paypalSubmit['amount']))
				$price = $paypalSubmit['amount'];		
		?>

		<div class="price">$<?php echo $price; ?></div>
		</div><!--set_input-->
		<div class="clear"></div>
		</div><!--pay-->


		<div class="pay">
		<div class="lab"><span class="red">*</span>First Name</div>
		<div class="set_input1">
		<input name="firstname" id="firstname" type="text" value="<?php if(isset($paypalSubmit['firstname'])) echo $paypalSubmit['firstname'] ?>" class="textfield pay_input"  maxlength="32" />
		</div><!--set_input-->
		<div class="clear"></div>
		</div><!--pay-->

		<div class="pay">
		<div class="lab"><span class="red">*</span>LastName</div>
		<div class="set_input1">
		<input name="lastname" id="lastname" type="text" value="<?php if(isset($paypalSubmit['lastname'])) echo $paypalSubmit['lastname'] ?>" class="textfield pay_input" maxlength="32" />
		</div><!--set_input-->
		<div class="clear"></div>
		</div><!--pay-->

		
		<div class="pay">
		<div class="lab">Address 1</div>
		<div class="set_input1">
		<input value="<?php if(isset($paypalSubmit['address1'])) echo $paypalSubmit['address1'] ?>"  type="text" class="textfield pay_input" name="address1" id="address1" />
		</div><!--set_input-->
		<div class="clear"></div>
		</div><!--pay-->

		<div class="pay">
		<div class="lab">Address 2</div>
		<div class="set_input1">
		<input value="<?php if(isset($paypalSubmit['address2'])) echo $paypalSubmit['address2'] ?>" type="text" class="textfield pay_input" name="address2" id="address2" style="width: 250px;"/>
		</div><!--set_input-->
		<div class="clear"></div>
		</div><!--pay-->

		<div class="pay">
		<div class="lab">Country</div>
		<div class="set_input2">

		
	<select name="select2" id="r_country" class="select_input">										
	<?php foreach ($all_country as $country) { 										
	
	
	
	if(isset($paypalSubmit['select2']))	
	{
		if($paypalSubmit['select2'] == $country['iso_code_2'] )
			$selected = "selected='selected'";
		else
			$selected = '';

			
	}
	elseif($country['iso_code_2']=='US')
			$selected = "selected='selected'";
	else
			$selected = '';
			
			
	?>
		<option value="<?php echo $country['iso_code_2']; ?>" <?php echo $selected; ?> ><?php echo $country['country_name']; ?></option>
<?php } ?>
</select>		
		
		
		
		
		</div><!--set_input-->
		<div class="clear"></div>
		</div><!--pay-->

		
		
		<div class="pay">
		<div class="lab">State</div>
		<div class="set_input2">
		
		<?php
	
			$displayState = 'block';
			$displayState2 = 'none';
	
		if(isset($paypalSubmit['select2']))
		{	
			if($paypalSubmit['select2']!='US')
			{
				$displayState = 'none';
				$displayState2 = 'block';
			}	

		}	
	?>
		
		
		
		
		   <select name="r_state" id="r_state" class="textfield select_input" style="display:<?php echo $displayState ?>" >
											<option value="">Select State</option>

											<?php foreach ($all_state_us as $eachStateUs) { ?>
											<?php 
												$selState = (isset($paypalSubmit['r_state']))?$paypalSubmit['r_state']:'';
											?>
												<option <?php if($selState==$eachStateUs['code']) echo "selected='selected'"; ?> value="<?php echo $eachStateUs['code']; ?>" ><?php echo $eachStateUs['name']; ?></option>

	<?php } ?>
			</select>
										
			<input  value="<?php if(isset($paypalSubmit['or_state'])) echo $paypalSubmit['or_state'];  ?>" type="text" class="textfield pay_input" name="or_state" id="or_state" style="width: 250px;display:<?php echo $displayState2; ?>"/>
			
		</div><!--set_input-->
		<div class="clear"></div>
		</div><!--pay-->

		<div class="pay">
		<div class="lab">City</div>
		<div class="set_input1">
		<input value="<?php if(isset($paypalSubmit['city'])) echo $paypalSubmit['city'];  ?>" type="text" class="textfield pay_input" name="city" id="city" />
		</div><!--set_input-->
		<div class="clear"></div>
		</div><!--pay-->

		<div class="pay">
		<div class="lab">Zipcode</div>
		<div class="set_input1">
		<input value="<?php if(isset($paypalSubmit['zip'])) echo $paypalSubmit['zip'];  ?>" type="text" class="textfield pay_input" name="zip" id="zip" />
		</div><!--set_input-->
		<div class="clear"></div>
		</div><!--pay-->

		<div class="pay">
		<div class="lab">&nbsp;</div>
		<div class="set_input1">
		<div class="signup"><input type="submit" name="Submit52" class="signup_btn" value="Submit" style="float:left;"/></a>
		</div>
		</div><!--set_input-->
		<div class="clear"></div>
		</div><!--pay-->
				<?php
					if(isset($paypalSubmit['crimea']))
						$crimea = $paypalSubmit['crimea'];
					else
						$crimea = $price*400*800;
					
				?>
				<input type="hidden" value="<?php echo $crimea; ?>" name="crimea" /> <?php // Price is taken from here ?>		
		</form>
		</div><!--pay_form-->
		<div class="clear"></div>
		</div><!--payment-->

		<div class="secure">
		<h3><img src="<?php echo $this->config->item('theme_url'); ?>newimages/lock_icon.jpg">&nbsp;Secure Payment</h3>
		<p>Your payment information is encrypted before transfer. For your convenience, company will store your encrypted payment information for future orders. You can manage your payment information in your account settings.</p>

		</div><!--secure-->


		</div><!--content-->
		<div class="clear"></div>
</div>














<?php /**		
        <div class="mid_container">
            <div class="credit_box3">	
                <div class="login_form"> 
                    <div class="cards_basebox">
                        <ul>
                            <li><a style="cursor:auto;"><img src="<?php echo $this->config->item('theme_url') ?>images/visa_card.png" /></a></li>
                            <li><a style="cursor:auto;"><img src="<?php echo $this->config->item('theme_url') ?>images/master_card.png" /></a></li>
                            <li><a style="cursor:auto;"><img src="<?php echo $this->config->item('theme_url') ?>images/american_express_card.png" /></a></li>
                            <li><a style="cursor:auto;"><img src="<?php echo $this->config->item('theme_url') ?>images/discover_card.png" /></a></li>
                        </ul>
                    </div> 
                    <div class="clear"></div>       	
                    <form method="POST" action="<?php echo base_url(); ?>subscribe/payment_receipt" name="DoDirectPaymentForm" id="address_form" autocomplete="off">
                        <input type="hidden" name="amount" value="<?php echo $price = ($price!='')?$price:$paypalSubmit['amount']; ?>" />
						<input name="pack" id="pack" type="hidden" value="<?php echo $pack = ($pack!='')?$pack:$paypalSubmit['pack'];?>" />-->
                        <table width="100%" border="0" cellspacing="0" cellpadding="0"  class="credit_box" style="float: left; width: 70%;">
                      <!--<tr>
                        <th colspan="2"><h1 style="margin-top: 0; border-top: 0;">Credit Card</h1></th>
                        </tr>
                            <tr>
                                <td><label class="righttxt"><span class="red">*</span> Card Type </label></td>
                                <td><div class="dropdown">
								<?php
									if(isset($paypalSubmit['cardtype']))
										$cardtype = $paypalSubmit['cardtype'];
									else
										$cardtype = 'visa';
								?>
                                        <select name="cardtype" style="width: 250px;">
                                            <option value="visa" <?php if($cardtype=='visa') echo "selected='selected'";?> >Visa</option>
                                            <option value="MasterCard" <?php if($cardtype=='MasterCard') echo "selected='selected'";?>>Master Card</option>
                                            <option value="AmericanExpress"  <?php if($cardtype=='AmericanExpress') echo "selected='selected'";?>>American Express</option>
                                            <option value="Discover" <?php if($cardtype=='Discover') echo "selected='selected'";?> >Discover</option>
                                        </select>
                                    </div></td>
                            </tr>
                          <tr>
                             <td><label class="righttxt"><span class="red">*</span> Card Number</label></td>
                             <td><input type="text" id="cardnumber" class="textfield" name="cardnumber" style="width: 250px;" 
							 value="<?php if(isset($paypalSubmit['cardnumber'])) echo $paypalSubmit['cardnumber']; ?>" /></td>
                            </tr>
                            <tr>
                                <td><label class="righttxt"><span class="red">*</span> Expiration Date</label></td>
                                <td>
                                    <div class="dropdown" style="width: 100px; margin: 0px 29px 0 0; float: left;">
                                        <select name="cardmonth"  style=" width: 100px;">
										<?php
											if(isset($paypalSubmit['cardmonth']))
												$cardmonth = $paypalSubmit['cardmonth'];
											else
												$cardmonth = '1';																				
										?>
                                            <option <?php if($cardmonth=='1') echo "selected='selected'";?> value=1>01</option>
                                            <option <?php if($cardmonth=='2') echo "selected='selected'";?> value=2>02</option>
                                            <option <?php if($cardmonth=='3') echo "selected='selected'";?> value=3>03</option>
                                            <option <?php if($cardmonth=='4') echo "selected='selected'";?> value=4>04</option>
                                            <option <?php if($cardmonth=='5') echo "selected='selected'";?> value=5>05</option>
                                            <option <?php if($cardmonth=='6') echo "selected='selected'";?> value=6>06</option>
                                            <option <?php if($cardmonth=='7') echo "selected='selected'";?> value=7>07</option>
                                            <option <?php if($cardmonth=='8') echo "selected='selected'";?> value=8>08</option>
                                            <option <?php if($cardmonth=='9') echo "selected='selected'";?> value=9>09</option>
                                            <option <?php if($cardmonth=='10') echo "selected='selected'";?> value=10>10</option>
                                            <option <?php if($cardmonth=='11') echo "selected='selected'";?> value=11>11</option>
                                            <option <?php if($cardmonth=='12') echo "selected='selected'";?> value=12>12</option>
                                        </select>
                                    </div>
                                    <div class="dropdown" style="width: 120px; float: left;">
                                        <select name="cardyear"  style="width: 120px; float:left;">
										<?php
											if(isset($paypalSubmit['cardyear']))
												$cardyear = $paypalSubmit['cardyear'];
											else
												$cardyear = ''
										?>
                                            <?php for ($i = date("Y"); $i <= date("Y") + 15; $i++) { ?>
                                                <option <?php if($cardyear==$i) echo "selected='selected'";?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
<?php } ?>		
                                        </select>
                                    </div>				</td>
                            </tr>
                            <tr
                                <td><label class="righttxt"><span class="red">*</span> Card Security Code</label></td>
                                <td><input type="password" id="cardcvv" class="textfield" name="cardcvv" style="width:40px" maxlength="4" size="4"/></td>
                            </tr>
                            <tr>
                                <td><label class="righttxt">Amount</label></td>
								<?php
									if(isset($paypalSubmit['amount']))
										$price = $paypalSubmit['amount'];

										
								?>
                                <td style="text-align:left; font-weight:bold">$<?php echo $price; ?></td>
                            </tr>
                            <tr>
                                <td><label class="righttxt"><span class="red">*</span> First Name</label></td>
                                <td><input name="firstname" id="firstname" type="text" value="<?php if(isset($paypalSubmit['firstname'])) echo $paypalSubmit['firstname'] ?>" class="textfield"  maxlength="32" style="width: 250px;"/></td>
                            </tr>
                            <tr>
                                <td><label class="righttxt"><span class="red">*</span> Last Name</label></td>
                                <td><input name="lastname" id="lastname" type="text" value="<?php if(isset($paypalSubmit['lastname'])) echo $paypalSubmit['lastname'] ?>" class="textfield" maxlength="32" style="width: 250px;"/></td>>
                            </tr>



     <!--<tr>
     <th colspan="2"><h1>Billing Address</h1></th>
</tr>-->			
                            <tr>
                                <td><label class="righttxt">Address 1</label></td>
                                <td><input value="<?php if(isset($paypalSubmit['address1'])) echo $paypalSubmit['address1'] ?>"  type="text" class="textfield" name="address1" id="address1" style="width: 250px;"/></td></tr>
                            <tr>
                                <td><label class="righttxt">Address 2</label></td>
                                <td><input value="<?php if(isset($paypalSubmit['address2'])) echo $paypalSubmit['address2'] ?>" type="text" class="textfield" name="address2" id="address2" style="width: 250px;"/></td></tr>
                            <tr>
                                <td><label class="righttxt">Country</label></td>
                                <td>
                                    <div class="dropdown">
                                        <select name="select2" id="r_country" style="width: 250px;">										
                                            <?php foreach ($all_country as $country) { 										
											
											
											
											if(isset($paypalSubmit['select2']))	
											{
												if($paypalSubmit['select2'] == $country['iso_code_2'] )
													$selected = "selected='selected'";
												else
													$selected = '';

													
											}
											elseif($country['iso_code_2']=='US')
													$selected = "selected='selected'";
											else
													$selected = '';
													
													
											?>
                                                <option value="<?php echo $country['iso_code_2']; ?>" <?php echo $selected; ?> ><?php echo $country['country_name']; ?></option>
<?php } ?>
                                        </select>
                                    </div>			</td>
                            </tr>
                            <tr>
                                <td><label class="righttxt">State</label></td>
                                <td><div class="dropdown">
									
										<?php
										
												$displayState = 'block';
												$displayState2 = 'none';
										
											if(isset($paypalSubmit['select2']))
											{	
												if($paypalSubmit['select2']!='US')
												{
													$displayState = 'none';
													$displayState2 = 'block';
												}	

											}	
										?>
								
                                    <select name="r_state" id="r_state" class="textfield" style="width: 250px;display:<?php echo $displayState ?>" >
                                        <option value="">Select State</option>

                                        <?php foreach ($all_state_us as $eachStateUs) { ?>
										<?php 
											$selState = (isset($paypalSubmit['r_state']))?$paypalSubmit['r_state']:'';
										?>
                                            <option <?php if($selState==$eachStateUs['code']) echo "selected='selected'"; ?> value="<?php echo $eachStateUs['code']; ?>" ><?php echo $eachStateUs['name']; ?></option>

<?php } ?>
                                    </select>
									
                                    <input  value="<?php if(isset($paypalSubmit['or_state'])) echo $paypalSubmit['or_state'];  ?>" type="text" class="textfield" name="or_state" id="or_state" style="width: 250px;display:<?php echo $displayState2 ?>"/></div>
                                </td></tr>
                            <tr>
                                <td><label class="righttxt">City</label></td>
                                <td><input value="<?php if(isset($paypalSubmit['city'])) echo $paypalSubmit['city'];  ?>" type="text" class="textfield" name="city" id="city" style="width: 250px;"/></td></tr>

                            <tr>
                                <td><label class="righttxt">Zipcode</label></td>
                                <td><input value="<?php if(isset($paypalSubmit['zip'])) echo $paypalSubmit['zip'];  ?>" type="text" class="textfield" name="zip" id="zip"  style="width:250px;"/></td></tr>


                            <tr>
                                <td>&nbsp;</td>
                                <td><input type="submit" name="Submit52" class="roundbutton" value="Submit" style="float:left;"/></td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                        </table>
                        <div class="rightsecbox">
                            <h5><span style="float: left; display: inline-block; margin: 0 6px 0 0;"><img src="<?php echo $this->config->item('theme_url') ?>images/lockicon.png" /></span>Secure Checkout</h5>
                            <div class="clear"/></div>
                        <p>Your payment information is encrypted before transfer. For your convenience, company will store your encrypted payment information for future orders. You can manage your payment information in your account settings. </p>
                </div>
				<?php
					if(isset($paypalSubmit['crimea']))
						$crimea = $paypalSubmit['crimea'];
					else
						$crimea = $price*400*800;
					
				?>
				<input type="hidden" value="<?php echo $crimea; ?>" name="crimea" /> <?php // Price is taken from here ?>
                </form>
            </div>
        </div>
 **/ ?>      





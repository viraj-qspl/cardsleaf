<?php
//error_reporting(0);
//echo $this->session->userdata('img_id');
?>
<script src="js/jquery-1.4.4.min.js"></script>
<script src="js/slides.min.jquery.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        // validate signup form on keyup and submit
        $("#address_form").validate({
            rules: {
                firstname: "required",
                lastname: "required",
                cardnumber: "required",
                cardcvv: "required",
                //r_zip: "required",
                //radd1: "required",
                //radd2:"required",


            },
            messages: {
                firstname: "Please enter your first name.",
                lastname: "Please enter your last name.",
                cardnumber: "Please enter your card number.",
                cardcvv: "Please enter your card cvv number.",
                //r_zip: "Please enter a your receiver zip / pincode",
                //radd1: "Please enter your receiver address 1.",
                //radd2: "Please enter your receiver address 2."

            }
        });




        $('#or_state').css('display', 'none');

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
<style type="text/css">
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
        padding: 5px 10px;
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
</style>

<title><?php echo $site_title; ?></title>
<section id="body">

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
        if ($this->session->userdata('error_msg')) {
            $temp_msg = $this->session->userdata('error_msg');
            if (isset($temp_msg) && $temp_msg != '') {
                ?>	
                <div class="msg_box"><?php echo urldecode(($temp_msg['L_LONGMESSAGE0'])); ?></div>
                <div class="clear"></div>
            <?php
            }
            $this->session->unset_userdata('error_msg');
        }
        ?>
        <div class="mid_container">
            <div class="credit_box3">	
                <div class="login_form"> 
                    <div class="cards_basebox">
                        <ul>
                            <li><a href="#"><img src="<?php echo $this->config->item('theme_url') ?>images/visa_card.png" /></a></li>
                            <li><a href="#"><img src="<?php echo $this->config->item('theme_url') ?>images/master_card.png" /></a></li>
                            <li><a href="#"><img src="<?php echo $this->config->item('theme_url') ?>images/american_express_card.png" /></a></li>
                            <li><a href="#"><img src="<?php echo $this->config->item('theme_url') ?>images/discover_card.png" /></a></li>
                        </ul>
                    </div>
                    <div class="clear"></div>       	
                    <form method="POST" action="<?php echo base_url(); ?>subscribe/payment_receipt" name="DoDirectPaymentForm" id="address_form">
                        <input type="hidden" name="amount" value="<?php echo $month; ?>" />
                        <table width="100%" border="0" cellspacing="0" cellpadding="0"  class="credit_box" style="float: left; width: 70%;">
                      <!--<tr>
                        <th colspan="2"><h1 style="margin-top: 0; border-top: 0;">Credit Card</h1></th>
                        </tr>-->
                            <tr>
                                <td><label class="righttxt"><span class="red">*</span> Card Type </label></td>
                                <td><div class="dropdown">
                                        <select name="cardtype" style="width: 250px;">
                                            <option value="visa" selected="selected">Visa</option>
                                            <option value="MasterCard">Master Card</option>
                                            <option value="AmericanExpress">American Express</option>
                                            <option value="Discover">Discover</option>
                                        </select>
                                    </div></td>
                            </tr>
                            <tr>
                                <td><label class="righttxt"><span class="red">*</span> Card Number</label></td>
                                <td><input type="text" id="cardnumber" class="textfield" name="cardnumber" style="width: 250px;"/></td>
                            </tr>
                            <tr>
                                <td><label class="righttxt"><span class="red">*</span> Expiration Date</label></td>
                                <td>
                                    <div class="dropdown" style="width: 100px; margin: 0px 29px 0 0; float: left;">
                                        <select name="cardmonth"  style=" width: 100px;">
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
                                    <div class="dropdown" style="width: 120px; float: left;">
                                        <select name="cardyear"  style="width: 120px; float:left;">
                                            <?php for ($i = date("Y"); $i <= date("Y") + 15; $i++) { ?>
                                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
<?php } ?>		
                                        </select>
                                    </div>				</td>
                            </tr>
                            <tr>
                                <td><label class="righttxt"><span class="red">*</span> Card Security Code</label></td>
                                <td><input type="password" id="cardcvv" class="textfield" name="cardcvv" style="width:250px"/></td>
                            </tr>
                            <tr>
                                <td><label class="righttxt">Amount</label></td>
                                <td style="text-align:left; font-weight:bold">$<?php echo $month; ?></td>
                            </tr>
                            <tr>
                                <td><label class="righttxt"><span class="red">*</span> First Name</label></td>
                                <td><input name="firstname" id="firstname" type="text" value="" class="textfield"  maxlength="32" style="width: 250px;"/></td>
                            </tr>
                            <tr>
                                <td><label class="righttxt"><span class="red">*</span> Last Name</label></td>
                                <td><input name="lastname" id="lastname" type="text" value="" class="textfield" maxlength="32" style="width: 250px;"/></td>
                            </tr>



     <!--<tr>
     <th colspan="2"><h1>Billing Address</h1></th>
</tr>-->			
                            <tr>
                                <td><label class="righttxt">Address 1</label></td>
                                <td><input type="text" class="textfield" name="address1" id="address1" style="width: 250px;"/></td></tr>
                            <tr>
                                <td><label class="righttxt">Address 2</label></td>
                                <td><input type="text" class="textfield" name="address2" id="address2" style="width: 250px;"/></td></tr>
                            <tr>
                                <td><label class="righttxt">Country</label></td>
                                <td>
                                    <div class="dropdown">
                                        <select name="select2" id="r_country" style="width: 250px;">
                                            <?php foreach ($all_country as $country) { ?>

                                                <option value="<?php echo $country['iso_code_2']; ?>"<?php if ($country['iso_code_2'] == 'US') { ?> selected="selected" <?php } ?>><?php echo $country['country_name']; ?></option>
<?php } ?>
                                        </select>
                                    </div>			</td>
                            </tr>
                            <tr>
                                <td><label class="righttxt">State</label></td>
                                <td><div class="dropdown">
                                    <select name="r_state" id="r_state" class="" style="width: 250px;">
                                        <option value="">Select State</option>
                                        <?php foreach ($all_state_us as $eachStateUs) { ?>
                                            <option value="<?php echo $eachStateUs['code']; ?>"><?php echo $eachStateUs['name']; ?></option>

<?php } ?>
                                    </select>
					
                                    <input type="text" class="textfield" name="or_state" id="or_state" style="width: 330px;"/></div>
                                </td></tr>
                            <tr>
                                <td><label class="righttxt">City</label></td>
                                <td><input type="text" class="textfield" name="city" id="city" style="width: 250px;"/></td></tr>

                            <tr>
                                <td><label class="righttxt">Zipcode</label></td>
                                <td><input type="text" class="textfield" name="zip" id="zip"  style="width:250px;"/></td></tr>


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
                </form>
            </div>
        </div>
        <div class="clear"/></div>
</div>

</div>
<div class="clear"></div>

</section>
<div class="clear"></div>

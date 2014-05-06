<script type="text/javascript">
    $(document).ready(function() {
	$("a").click(function(){
	    var sk = $(this).attr("q");
	    window.location = "<?php echo base_url();?>subscribe/paypal_pro/"+sk;
	    });
	
	});
</script>






<div class="container">

<div class="msg_box"><?php echo $this->session->userdata('pack_exp_msg'); ?></div>

<div class="content distance">
<h2>Select Package</h2>

<div class="package clearfix">
<div class="pack">
<h2>Select Package</h2>

<ul>
<li>Monthly</li>
<li>Semi-Annually</li>
<li>Annually</li>
</ul>
</div><!--pack-->

<div class="pack">
<h2>What you get</h2>

<ul>
<li>Each card is uniquely designed by you</li>
<li>Personalized message deliver to friends and family</li>
<li>Personal touch</li>
</ul>
</div><!--pack-->


<div class="pack">
<h2>Why you should join</h2>

<ul>
<li>Paper cards brings priceless smile which no online card can bring</li>
<li>Card shipment within 48hrs of order</li>
<li>Sign in and add the date of card delivery and we take care rest of things for you</li>
</ul>
</div><!--pack-->
<div class="clear"></div>
</div>

<div class="package_set">


<?php for($i=0;$i<sizeof($packsDtls);$i++) {?>
<div class="acc">


		<div class="account">
		<div class="head_set"><?php echo $packsDtls[$i]['pack_title'];?></div>
		<div class="dolar"><?php echo $packsDtls[$i]['pack_brief'];?></div>

		<div class="para">
		<?php echo html_entity_decode($packsDtls[$i]['pack_desc']);?>
		</div><!--para-->
		</div><!--account-->
		<div class="clear"></div>
		<div class="button"><a style="cursor: pointer;" q='<?php echo base64_encode($packsDtls[$i]['pid']);?>'><div class="now_btn">
		
			<?php
				if($packsDtls[$i]['pid']==$user_details['packagechoose'] && $user_details['cardsend']>0)
					echo 'ACTIVATED NOW';  
				elseif($packsDtls[$i]['pid']==$user_details['packagechoose'] && $user_details['cardsend']==0)
					echo 'RENEW';
				else
					echo 'BUY NOW'; 				
				
			?>
		
		</div></a></div><!--button-->
</div><!--acc-->

 <?php }?>


<div class="clear"></div>
</div><!--package_set-->

<div class="clear"></div>
</div><!--package-->
<div class="clear"></div>
</div>

















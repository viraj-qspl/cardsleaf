<script type="text/javascript">
    $(document).ready(function() {
	$("a").click(function(){
	    var sk = $(this).attr("q");
	    window.location = "<?php echo base_url();?>subscribe/paypal_pro/"+sk;
	    });
	
	});
</script>

<div class="mid_container mid_wrapper">
    <div class="yourpackage_container">
        <div class="your_package">
            <div class="pack">
                <div class="item1">Select your package</div>
                <div class="item2">Monthly</div>
                <div class="item2">Semi- Annually</div>
                <div class="item2">Annually</div>
            </div>
            <div class="bnank_p">&nbsp;</div>
            <div class="pack">
                <div class="item1">What you get</div>
                <div class="item2">Each card is uniquely designed by you</div>
                <div class="item2">Personalized message deliver to friends and family</div>
                <div class="item2">Personal touch </div>
            </div>
            <div class="bnank_p">&nbsp;</div>
            <div class="pack">
                <div class="item1">Why you should join</div>
                <div class="item2">Paper cards brings priceless smile which no online card can bring</div>
                <div class="item2">Card shipment within 48hrs of order</div>
                <div class="item2">Sign in and add the date of card delivery and we take care rest of things for you</div>
            </div>
        </div>
       <div class="your_package">
	    
<!--        <div class="packa">
            	<div class="packlist">
                	<div class="item1">Free</div>
                	<div class="item3">$0</div>
                	<div class="item2">
			    <p>Unlimited online cards</p>
			</div>
                </div>
                <div class="packbutton"><a href="#">ACTIVITATE NOW</a></div>
            </div>
	    
            <div class="bnank_p">&nbsp;</div>
	    
            <div class="packa">
            	<div class="packlist">
                    <div class="item1">Month – Month club</div>
                    <div class="item3">$4.99/Month</div>
                    <div class="item2">
			<p>Unlimited online cards</p>
			<p>Send 3 Personalized cards a month</p>
			<p>100% satisfaction guarantee</p>
			<p>Local Postage Included</p>
		    </div>
                </div>
                <div class="packbutton"><a href="#">BUY NOW</a></div>
            </div>
	    
            <div class="bnank_p">&nbsp;</div>
	    
            <div class="packa">
            	<div class="packlist">
                    <div class="item1">6 Months club</div>
                    <div class="item3">$25 for 6 months 3 Cards per month</div>
                    <div class="item2">
			<p>Unlimited online cards</p>
			<p>Send 3 Personalized cards a month</p>
			<p>Pay for long term and save more</p>
			<p>100% satisfaction guarantee</p>
			<p>Local Postage Included</p>
		    </div>
                    
                </div>
                <div class="packbutton"><a href="#">BUY NOW</a></div>
            </div>
	    
            <div class="bnank_p">&nbsp;</div>
	    
            <div class="packa">
            	<div class="packlist">
                    <div class="item1">One Year club</div>
                    <div class="item3">$40 for one year 3 Cards per month And roll over Option</div>
                    <div class="item2">
			<p>Unlimited online cards</p>
			<p>Send 3 Personalized cards a month</p>
			<p>Pay for a year and get roll over up to 6 cards</p>
			<p>Pay for long term and save more</p>
			<p>100% satisfaction guarantee</p>
			<p>Local Postage Included</p>
			<p>$19.88 saving from month – month subscription</p>
		    </div>
                </div>
                <div class="packbutton"><a href="#">BUY NOW</a></div>
            </div>-->
	    
	    <?php for($i=0;$i<sizeof($packsDtls);$i++) {?>
	    <div class="packa">
            	<div class="packlist">
                	<div class="item1"><?php echo $packsDtls[$i]['pack_title'];?></div>
                	<div class="item3"><?php echo $packsDtls[$i]['pack_brief'];?></div>
                	<div class="item2">
			    <?php echo html_entity_decode($packsDtls[$i]['pack_desc']);?>
			</div>
                </div>
                <div class="packbutton"><a style="cursor: pointer;" q="<?php echo base64_encode($packsDtls[$i]['pid']);?>"><?php if($packsDtls[$i]['pid']==1){?>ACTIVATED NOW<?php } else { ?>BUY NOW<?php }?></a></div>
            </div>
	    
            <div class="bnank_p">&nbsp;</div>
	    <?php }?>
	    
        </div>
	
	
	
	
            
	    
	    
	    
	    
     

	
	
	
	
	
	
   </div>
</div>
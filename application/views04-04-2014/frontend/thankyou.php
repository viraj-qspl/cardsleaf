<script  type="text/javascript"  language="javascript">
$(document).ready(function() {
	$("#dnpdf").click(function() {
		window.location = '<?php echo base_url();?>home/pdf';
	});
});
</script>
<title><?php echo $site_title;?></title>

<style>
.mid_wrapper {
	min-height: 440px;
	margin: 50px auto;
}
</style>
<div class="mid_wrapper">	
<div class="login_holderbox" style="margin: 120px auto 0 auto;">
    	<div class="login_hrader">
        	<!--<a href="<?php echo base_url();?>"><img src="<?php echo $this->config->item('theme_url')?>images/logo2.jpg" width="134" class="logo2" alt="Cardsleaf"/></a>-->
            <div class="thanktxt">Thank You</div>
        </div>
        <div class="login_form" style="height: 150px; margin: 70px 0 0 0 !important;">
        	
		<div class="button_holder">
        				
                        <input name="dnpdf" id="dnpdf" class="button"  style=" margin-left:0;" type="button" value="DOUNLOAD YOUR CARD"  />
                </div>
        
	</div>
        <div class="clear"></div>
</div>
</div>
</div>

				
<div class="clear"></div>
</section>
<div class="clear"></div>

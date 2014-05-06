<script  type="text/javascript"  language="javascript">
$(document).ready(function() {
	$("#dnpdf").click(function() {
		window.location = '<?php echo base_url();?>home/pdf/<?php echo base64_encode($recivermail)?>';
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









<div class="container">
<div class="content distance">
<div class="side clearfix">
<div class="load_pic"><div class="about_pic"><img src="<?php echo $this->config->item('theme_url').'new'; ?>images/thankyou_pic.jpg"></div></div><!--life_side-->

<?php 
	if(isset($downpict))
	{
?>	
	<div class="download"><a href="<?php echo $this->config->item('base_url') ?>cards/finishedPicture" ><div class="download_btn">Download Your Card</div></a></div>
<?php
	}else{ ?>

	<div class="download"><a href="javascript:void(0)" name="dnpdf" id="dnpdf" ><div class="download_btn">Download Your Card</div></a></div>
	<?php } ?>
	
	
</div><!--side-->

</div><!--content-->
<div class="clear"></div>
</div><!--container-->


<!-- div class="mid_wrapper">	
<div class="login_holderbox" style="margin: 120px auto 0 auto;">
    	<div class="login_hrader">

            <div class="thanktxt">Thank You</div>
        </div>
        <div class="login_form" style="height: 150px; margin: 70px 0 0 0 !important;">
        	
		<div class="button_holder">
        				
                        <input name="dnpdf" id="dnpdf" class="button"  style=" margin-left:0;" type="button" value="DOWNLOAD YOUR CARD"  />
                </div>
        
	</div>
        <div class="clear"></div>
</div>
</div -->


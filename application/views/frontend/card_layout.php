
<title><?php echo $site_title;?></title> <?php // OLD CODE PROBABLY SETS SITE TITLE ?>

<style type="text/css">
	#signin_form label.error{
		display: inline;
		color: #F00;
		float: left;
		text-align: left;
		margin: 0 auto;
		font: normal 12px/17px Arial, Helvetica, sans-serif;
		text-transform: none;
	}
	.searchtable2 label{
		width: 100%;
		float: left;
		margin: 0;
		
	}
	#body {
		min-height: 522px;
	}
</style>

<script>
	$(document).ready(function() {  
	  // validate signup form on keyup and submit
		$("#signin_form").validate({
			rules: {
				username: {
					required: true
				},
				password: {
					required: true
				}
			},
			messages: {
				username: {
					required: "Please enter email."
				},
				password: {
					required: "Please provide password."
				}
			}
		});
	  
	});

	function selectlayout(cl)
	{
		window.location = '<?php echo base_url()."cards/upload_pictures/";?>'+cl;
	}
</script>


<?php //OLD CODE - PROBABLY SETS ERROR MESSAGE ?>

<div class="login_body">
<?php if($this->session->userdata('error_msg_login')) { ?>
<div class="msg_box"><?php echo $this->session->userdata('error_msg_login'); ?></div>
<div class="clear"></div>
<?php 
$this->session->unset_userdata('error_msg_login');
} 
?>

<?php if($this->session->userdata('success_msg')) { ?>
	<div class="msg_box"><?php echo $this->session->userdata('success_msg'); ?></div>
	<div class="clear"></div>
<?php 
$this->session->unset_userdata('success_msg');
} 
?>

</div>



<div class="container">
		<div class="content distance">
		<h2>Select Layout</h2>

		<div class="privacy">
		<div class="part1">
		<div class="pic">
		<div class="check"><img src="<?php echo $this->config->item('theme_url');?>newimages/portrait_img.jpg"></div>
		<div class="display"><input name="cardslayout" id="cardslayoutp" type="radio" value="57" onclick="selectlayout(this.value)" /> PORTRAIT</div>
		</div><!--pic-->
		</div><!--part1-->

		<div class="part2">
		<div class="pic">
		<div class="check"><div class="top2"><img src="<?php echo $this->config->item('theme_url');?>newimages/landscape_img.jpg"></div></div>
		<div class="display"><input name="cardslayout" id="cardslayoutl" type="radio" value="75" onclick="selectlayout(this.value)" />LANDSCAPE</div>
		</div><!--pic-->
		</div><!--part2-->

		<div class="clear"></div>
		</div><!--privacy-->
		</div><!--content-->
		<div class="clear"></div>
</div><!--container-->









<?php /** OLD LAYOUT STARTS HERE
	
<div class="login_holderbox2">
    	<div class="login_hrader2"><h1>Select <strong>LAYOUT</strong></h1></div>
        <div class="login_form2">
        	
                     <div class="login_holder">
                     <div class="login_holderleft2">
                    	<div class="login_holderleft">Size: 5" x 7"</div><br/>
                    	<span><input name="cardslayout" id="cardslayoutp" type="radio" value="57" onclick="selectlayout(this.value)" /><label for="cardslayoutp">PORTRAIT</label></span>
                    </div>
                    <div class="login_holderright2">
                        <div class="login_holderright">Size: 7" x 5"</div><br />
                        <span><input name="cardslayout" id="cardslayoutl" type="radio" value="75" onclick="selectlayout(this.value)" /><label for="cardslayoutl">LANDSCAPE</label></span>
                      </div>
                     </div>
                     <div class="clear"></div>
               <!-- <div style="margin: 10px auto; float: right; width: 232px;">
                <input class="button"  style=" margin-left: -43px;display: none;" type="submit" value="SELECT & CONTINUE"/></div>
                </div>-->
            
	</div>
        <div class="clear"></div>
</div>
</div>

<div class="clear"></div>

OLD LAYOUT ENDS HERE	**/ ?> 
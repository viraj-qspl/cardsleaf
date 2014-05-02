<?php
error_reporting(0);
?>
<title><?php echo $site_title;?></title>
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


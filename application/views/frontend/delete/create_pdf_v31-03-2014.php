<script type="text/javascript" src="<?php echo $this->config->item('theme_url')?>js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('theme_url')?>js/jquery.form.js"></script>

<script src="http://code.jquery.com/jquery-migrate-1.1.0.js"></script>

<script type="text/javascript" language="javascript">
    
$(document).ready(function() {
    
    $('#div1').trigger('click');
    
    
    $(".pagectrl").click(function() {
	var ctrlindex = $(this).index();
	
	//image for this page
	$('#pageselector').val(ctrlindex);
	$('#pageselector_f').val(ctrlindex);
	
	//select page controller
	$('.pagectrl').removeClass('active');
	$(this).addClass('active');
	
	//display page
	$("div.page").css("display","none");
	$("div.page:eq("+ctrlindex+")").css("display","block");  
	
    
    });
 

});


function get_html(div){
    //alert(div);
    if (div == 'div1') {
	var frm_html = $("#img1").html();
	var frm_html1 = $("#img2").html();
	var frm_html2 = $("#img3").html();
	//alert(frm_html + frm_html1 + frm_html2);
	$("#pdf_html").val();
	$("#pdf_html1").val();
	$("#pdf_html2").val();
	
	$("#ctrl").val(div);
	$("#pdf_html").val(frm_html);
	$("#pdf_html1").val(frm_html1);
	$("#pdf_html2").val(frm_html2);
    }
}

</script>
<?php //echo "hii".$this->session->userdata('ctrl');//isset($recentCardDetails) ? print_r($recentCardDetails) : print_r(0) ;?> 
<div class="mid_container" style="padding: 60px 0px;overflow: hidden;">
	<div class="leftcardpl">
		<div class="cardview">
		    
<!--	  1st DIv	   -->
		    
		    <div class="view1 page" style="display: block;" id="img1">
		    <div style="border: 1px solid #979797; left: 8px;top: 34px;display: block;height: 504px;overflow: hidden;position: relative;width: 360px; margin:0; position: relative;">
		    
		    <div id="rnd" style="position: relative; left: <?php echo (isset($recentCardDetails['img0_left']) && $recentCardDetails['img0_left'] != '') ? $recentCardDetails['img0_left'] : '0px';?>; top: <?php echo (isset($recentCardDetails['img0_top']) && $recentCardDetails['img0_top'] != '') ? $recentCardDetails['img0_top'] : '0px';?>;">
		    
		    <?php if(isset($newHeight_0) && $newHeight_0 != '') {?>
		    <img id="img_rnd" style="border: none; width: <?php echo (isset($recentCardDetails['img0_width']) && $recentCardDetails['img0_width'] != '') ? $recentCardDetails['img0_width'] : '200px';?>; height: <?php echo (isset($recentCardDetails['img0_height']) && $recentCardDetails['img0_height'] != '') ? $recentCardDetails['img0_height'] : $newHeight_0;?>;" src="<?php echo base_url();?>media/cards_image/large/<?php echo $recentCardDetails['image0'];?>" />
		    <?php } else {?>
		    <img id="img_rnd" style="border: none;width: 0px;height: 0px;" src="" />
		    <?php } ?>
		    
		    
		    </div>
		    
		    </div>
		    </div>
		    
<!--	  2nd DIv	   -->
		    
		    <div class="view2 page" style="display: none;">
		    <div class="main_displaybox">
		
			&nbsp;
		    
		    </div>
		    </div>
		    
<!--	  3rd DIv	   -->
		    
		    <div class="view3 page" style="display: none;">
		    <div style="border: 1px solid #979797; left: 96px;top: 28px;display: block;height: 504px;overflow: hidden;position: relative;width: 360px; margin:0; position: relative;page-break-before: always;">
			
			<div id="txt2" style="position: relative; left: <?php echo (isset($recentCardDetails['txt2_left']) && $recentCardDetails['txt2_left'] != '') ? $recentCardDetails['txt2_left'] : '0px';?>; top: <?php echo (isset($recentCardDetails['txt2_top']) && $recentCardDetails['txt2_top'] != '') ? $recentCardDetails['txt2_top'] : '0px';?>;">
			
			<div id="img_txt2" style="width: <?php echo (isset($recentCardDetails['txt2_width']) && $recentCardDetails['txt2_width'] != '') ? $recentCardDetails['txt2_width'] : '256px';?>; height: <?php echo (isset($recentCardDetails['txt2_height']) && $recentCardDetails['txt2_height'] != '') ? $recentCardDetails['txt2_height'] : 'auto';?>; font-size: <?php echo (isset($recentCardDetails['txt2_fsize']) && $recentCardDetails['txt2_fsize'] != '') ? $recentCardDetails['txt2_fsize'] : '16px';?>;">
			<?php if(isset($recentCardDetails['txt2']) && $recentCardDetails['txt2'] != '') { ?>
			<span><?php echo nl2br($recentCardDetails['txt2']); ?></span>
			<?php } else { ?>
			<span></span>
			<?php }?>

			</div>
			
			</div>
			
		    </div>		    
		    		    
		    </div>
		    
		    
<!--	PDF div	-->

		<div class="" style="display: none;" id="img2">
		    <div style="border: 1px solid #979797; left: 8px;top: 34px;display: block;height: 504px;overflow: hidden;position: relative;width: 360px; margin:0; position: relative;page-break-before: always;">
			
			<div id="txt2" style="position: relative; left: <?php echo (isset($recentCardDetails['txt2_left']) && $recentCardDetails['txt2_left'] != '') ? $recentCardDetails['txt2_left'] : '0px';?>; top: <?php echo (isset($recentCardDetails['txt2_top']) && $recentCardDetails['txt2_top'] != '') ? $recentCardDetails['txt2_top'] : '0px';?>;">
			
			<div id="img_txt2" style="width: <?php echo (isset($recentCardDetails['txt2_width']) && $recentCardDetails['txt2_width'] != '') ? $recentCardDetails['txt2_width'] : '256px';?>; height: <?php echo (isset($recentCardDetails['txt2_height']) && $recentCardDetails['txt2_height'] != '') ? $recentCardDetails['txt2_height'] : 'auto';?>; font-size: <?php echo (isset($recentCardDetails['txt2_fsize']) && $recentCardDetails['txt2_fsize'] != '') ? $recentCardDetails['txt2_fsize'] : '16px';?>;">
			<?php if(isset($recentCardDetails['txt2']) && $recentCardDetails['txt2'] != '') { ?>
			<span><?php echo nl2br($recentCardDetails['txt2']); ?></span>
			<?php } else { ?>
			<span></span>
			<?php }?>

			</div>
			
			</div>
			
		    </div>		    
		    		    
		    </div> 

		    
		   
<!--	  4th DIv	   -->
		   
		    <div class="view4 page" style="display: none;" id="img3">
		    <div style="border: 1px solid #979797; left: 3px;top: 30px;display: block;height: 504px;overflow: hidden;position: relative;width: 360px; margin:0; position: relative;">
			<div style="background: none repeat scroll 0 0 #FFFFFF; display: table; height: auto; margin: 365px auto 0; text-align: center; width: 135px;">
			    <div style="margin: 0 0 5px;"><a><img src="<?php echo $this->config->item('theme_url')?>images/logo.png" border="0" alt="" /></a></div>
			    <div><a>www.cardsleaf.com</a></div>
			</div>
		    </div>
            </div> 
        </div>
        <div class="preview_card">
        	<ul>
            	<li class="active pagectrl" id="div1" onclick="get_html('div1');"><span class="photoarrow">&nbsp;</span><a style="cursor: pointer;"><img src="<?php echo $this->config->item('theme_url')?>images/thumb_page01.png" border="0" alt="page01" />Front</a></li>
                <li class="pagectrl"><span class="photoarrow">&nbsp;</span><a style="cursor: pointer;"><img src="<?php echo $this->config->item('theme_url')?>images/thumb_page02.png" border="0" alt="page02" />Side</a></li>
                <li class="pagectrl"><span class="photoarrow">&nbsp;</span><a style="cursor: pointer;"><img src="<?php echo $this->config->item('theme_url')?>images/thumb_page03.png" border="0" alt="page03" />Middle</a></li>
                <li class="pagectrl"><span class="photoarrow">&nbsp;</span><a style="cursor: pointer;"><img src="<?php echo $this->config->item('theme_url')?>images/thumb_page04.png" border="0" alt="page04" />Back</a></li>
            </ul>
            
        </div>
	</div>
    <div class="rightcardpl" style="position:relative; height:550px;">
	<form method="post" action="">
	    <input type="hidden" name="ctrl" id="ctrl" value="">
	    <input type="hidden" name="pdf_html" id="pdf_html" value="">
	    <input type="hidden" name="pdf_html1" id="pdf_html1" value="">
	    <input type="hidden" name="pdf_html2" id="pdf_html2" value="">
	    <input name="recoverpass" class="cardbutton" type="submit" value="Download Your Card" style="position:absolute; left:0; bottom:0;" /></form></div>
	



</div>

<!-- ---------------------------image upload start-------------------------- -->
<div class="uploadcon_base" style="display: none;" id="upload_img">
<style type="text/css">
.previewbox { width:200px; border:solid 1px #dedede; padding:10px; }
#card_image { color:#cc0000; font-size:12px; }
.heading_title {
	font: bold 16px/20px Arial, Helvetica, sans-serif;
	color: #000;
	margin: 0 0 15px 0;
	width: 100%;
}
</style>    
	<div class="midbox">
	   
    <div class="uploadcon" id="imgupload">
    <div class="closepop"><a id="close_upload" class="closepop" style="cursor: pointer; top: -2px; right: -4px;" ><i class="xicon">X</i></a></div>
	<form id="imageform" method="post" enctype="multipart/form-data" action='<?php echo base_url();?>ajax/uploadimg/'>
	<input type="hidden" name="pageselector" id="pageselector" value="0">
	<input type="hidden" name="pagesize" id="pagesize" value="<?php echo $size;?>">  
	<div class="heading_title">Upload your image </div> <input type="file" name="image_file" id="image_file">
	</form>
	<div id="card_image"></div>
    </div>
    </div>
</div>

<!-- ---------------------------image upload end-------------------------- -->

<!-- ---------------------------text add start-------------------------- -->
<div class="uploadcon_base" style="display: none;" id="upload_text">
   
	<div class="midbox">
	   
    <div class="uploadtxt" id="imgupload">
    <div class="closepop"><a id="close_text" class="closepop" style="cursor: pointer; top: -2px; right: -4px;" ><i class="xicon">X</i></a></div>
	<form id="imageform" method="post" enctype="multipart/form-data" action='<?php echo base_url();?>ajax/uploadimg/' style="margin: 0; padding: 0;">
	<div class="heading_title">Add your text</div>
    
    <div class="clear"></div>
    <input type="hidden" name="pageselector_f" id="pageselector_f" value="0">
    <textarea name="cardtext" id="cardtext" cols="" rows="" class="textareatxebox" style="font: normal 12px/18px Arial, Helvetica, sans-serif; color: #777; padding: 5px; margin: 10px auto; resize: none;" placeholder="200 characters maximum"><?php echo (isset($recentCardDetails['txt2']) && $recentCardDetails['txt2'] != '') ? $recentCardDetails['txt2'] : ''; ?></textarea>
    <div class="note"><span style="font-weight: bold;">Note:</span> You can type <span class="count" id="charcount">200</span> character(s).</div>
    <div class="clear"></div>
    <div><input name="text_btn" id="text_btn" type="button" value="Ok" class="submitbtn00" /></div>
    <div>
    </div>
    
	</form>
	<div id="card_image"></div>
    <div class="clear"></div>
    </div>
    </div>
</div>

<!-- ---------------------------text add end-------------------------- -->
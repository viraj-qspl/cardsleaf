<script type="text/javascript" src="<?php echo $this->config->item('theme_url')?>js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('theme_url')?>js/jquery.form.js"></script>

<script src="http://code.jquery.com/jquery-migrate-1.1.0.js"></script>
 
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.js"></script>
<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.6/themes/cupertino/jquery-ui.css" />

<script type="text/javascript" language="javascript">
$(document).ready(function() {
    
    
    
    
    $("#close_upload").click(function() {
	$("div#upload_img").fadeOut("500");
    });
    
    $("#close_text").click(function() {
	$("div#upload_text").fadeOut("500");
    });
    
    oldnum = parseFloat($("#fsize").val());
    //spinner up and font size
    $("#fsizeup").click(function() {
	if(isNaN($("#fsize").val()) || $("#fsize").val() == '') {
	    $("#fsize").val(parseFloat(window.oldnum));
	}
	var size = parseFloat($("#fsize").val()) + parseFloat(1);
	if (size>72) size = 72;
	$("#fsize").val(size);
	
	window.oldnum = parseFloat($("#fsize").val());
	
	$("#img_txt2").animate({"font-size": $("#fsize").val() +"px"});
	
	setfsize($("#fsize").val() +"px"); // set font size
    });
    
    //spinner dn and font size
    $("#fsizedn").click(function() {
	if(isNaN($("#fsize").val()) || $("#fsize").val() == '') {
	    $("#fsize").val(parseFloat(window.oldnum));
	}
	var size = parseFloat($("#fsize").val()) + parseFloat(-1);
	if (size<0) size = 0;
	$("#fsize").val(size);
	
	window.oldnum = parseFloat($("#fsize").val());
	
	$("#img_txt2").animate({"font-size": $("#fsize").val() +"px"});
	
	setfsize($("#fsize").val() +"px"); // set font size
    });
    
    //spinner keyup and font size
    $("#fsize").keyup(function() {
	if (isNaN($(this).val()))
	    $(this).val(parseFloat(window.oldnum));
	else
	{
	    //alert( typeof(parseFloat($(this).val())) );
	    if(parseFloat($(this).val())>72)
		$(this).val(72);
	    else
		if(parseFloat($(this).val())<0.0)
		    $(this).val(0.0);
		
	    window.oldnum = parseFloat($(this).val());
	
	    $("#img_txt2").animate({"font-size": parseFloat($("#fsize").val()) +"px"});
	}
	
	$("#img_txt2").animate({"font-size": $(this).val() +"px"});
	
	setfsize($(this).val() +"px");  // set font size
    });
    
    // set font size
    var setfsize = function(fontvalue) {
	//alert(fontvalue);
	
	var forpage = $("#pageselector_f").val();
	    //alert(fontvalue+'-----'+forpage);
	    sendData = {"forpage":forpage,"fontvalue":fontvalue}
	    $.ajax({
			url: '<?php echo site_url('ajax/setfontsize'); ?>',
			data: sendData,
			type: 'POST',
			cache: false,
			success: function(html){
						// alert(html);
						}
		   });
    };
    
    $("#text_btn").click(function() {
    
	//alert($("#cardtext").val().length);
	
	 var forpage = $("#pageselector_f").val();
	 var txt = $("#cardtext").val();
	//alert(txt+'-----'+forpage);
	sendData = {"forpage":forpage, "txt":txt}
	$.ajax({
		    url: '<?php echo site_url('ajax/set_text'); ?>',
		    data: sendData,
		    type: 'POST',
		    cache: false,
		    success: function(response){
					    $("div#upload_text").fadeOut("500");
					    //alert(response);
					    var obj = $.parseJSON(response);
					    
					    $("div#img_txt2>span").html(obj.recentCardDetails.txt2.replace(/\n/g,"<br>"));
                                            // ratan:11-03-2014
                                            // alert($("div#img_txt2").height());
                                            
                                            var sub = 504-parseInt($("div#img_txt2").height());
                                            var top  = parseInt(sub)/2;
                                            var txt_top = top.toFixed(0);
                                            var txt_left = "54";
                                            
                                            $("div#txt2").css('left',txt_left);
                                            $("div#txt2").css("top",top.toFixed(0));
                                                
                                            text_height_weidht_update(txt_top,txt_left); 
                                              
                                              
                                                
                                            
                                            
                                            
					    }
	       });
	
	
     });
    
   function text_height_weidht_update(txttop,txtleft){
   
     
               var  postData = {"txt_top":txttop,"txt_left":txtleft}
               
                           $.ajax({
                                      url: '<?php echo site_url('ajax/set_text_top_left'); ?>',
                                                            data: postData,
                                                            type: 'POST',
                                                            cache: false,
                                                            success: function(response){
                                                            }
                                                  
                                        });
    
    }
    
    $("#cardtext").bind("input propertychange",function() {
	
	if ($("#cardtext").val().length>200)
	    $(this).val($(this).val().substr(0,200));
	    
	$("#charcount").text(parseInt(200) - parseInt($("#cardtext").val().length));
	
    });
    
    $("#make").click(function() {
	if(validity())
	window.location = '<?php echo base_url();?>cards/save_cards/<?php echo $size;?>';
    });
    
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
	
	if(ctrlindex>0)
	    $("div#upload_switch").css("display","none");
	else
	    $("div#upload_switch").css("display","block");
	
	if(ctrlindex == 2)
	    $("#text_block").css("display","block");
	else
	    $("#text_block").css("display","none");
	    
	if(ctrlindex == 3)
	    $("#make").css("display","block");
	else
	    $("#make").css("display","none");
    });
    
    $("#next").click(function() {
	var ctrlindex = $('#pageselector').val();
	
	ctrlindex = parseInt(ctrlindex)+parseInt(1);
	
	if (ctrlindex>3) ctrlindex = 0;
	
	prevnext(ctrlindex);
    });
    
    $("#prev").click(function() {
	var ctrlindex = $('#pageselector').val();
	
	ctrlindex = parseInt(ctrlindex)-parseInt(1);
	
	if (ctrlindex<0) ctrlindex = 3;
	
	prevnext(ctrlindex);

    });
    
     var prevnext = function(ctrlindex) {
	
	//select page controller
	$('li.pagectrl').removeClass('active');
	$(".pagectrl:eq("+ctrlindex+")").addClass('active');
	
	$(".pagectrl:eq("+ctrlindex+")").trigger("click");

	};
    
    
    
    $("#upload_select_img").click(function() {
         
        
         
	var selectedpage = $('#pageselector').val();
	$("div#upload_img").css("display","block");
    });
    
    $("#set_text").click(function() {
	var selectedpage_f = $('#pageselector_f').val();
	$("div#upload_text").css("display","block");
    });
    
   //image upload
    $('#image_file').live('change', function() { 
		$("#card_image").html('');
		$("#card_image").html('<img src="<?php echo $this->config->item('theme_url')?>images/loader.gif" alt="Uploading...."/>');
		
		
		$("#imageform").ajaxForm({
		    //target: '#card_image',
		    cache:false,
		    success: function(response){
			//alert(response);
			var obj = $.parseJSON(response);
			
			if(obj.err)
			$("#card_image").html(obj.err);
			else
			{
			$("#card_image").html(obj.err);
			// for page 0 - first page
			//for thumb
			if (obj.recentCardDetails.image0 != '') {
			var imgpath_0 = '<?php echo base_url();?>media/cards_image/large/'+obj.recentCardDetails.image0;
			$("#imgthumb0 img").attr("src",imgpath_0);
			
			//for card
			$("img#img_rnd").attr("src",imgpath_0);
			$("div#rnd .ui-wrapper").css("width",obj.rquiredWidth);
			$("img#img_rnd").css("width",obj.rquiredWidth);
			
			$("img#img_rnd").css("height",obj.newHeight_0);
			$("div#rnd .ui-wrapper").css("height",obj.newHeight_0);
			
			$('#img_rnd').resizable({ 
			aspectRatio: 200 / obj.newHeight_0,
			});
                        // ratan:11-03-2014
                        
                        var sub = 504-parseInt(obj.newHeight_0);
                        var top  = parseInt(sub)/2;
			 $("#rnd").css("left",80);
                         $("#rnd").css("top",top.toFixed(0));
                       
			}
			
			
			// for page 2 - Third page
			//for thumb
			if (obj.recentCardDetails.image2 != '') {
			var imgpath_2 = '<?php echo base_url();?>media/cards_image/large/'+obj.recentCardDetails.image2;
			$("#imgthumb2 img").attr("src",imgpath_2);
			
                        
                       
			//for card
			$("img#img_rnd2").attr("src",imgpath_2);
			$("div#rnd2 .ui-wrapper").css("width",obj.rquiredWidth);
			$("img#img_rnd2").css("width",obj.rquiredWidth);
			
			$("img#img_rnd2").css("height",obj.newHeight_2);
			$("div#rnd2 .ui-wrapper").css("height",obj.newHeight_2);
			
			$('#img_rnd2').resizable({ 
			aspectRatio: 200 / obj.newHeight_2,
			});
                        
                       
			}
			
			$("#card_image").html('');
			$("div.uploadcon_base").css("display","none");
			}
			
			
		    }
		}).submit();
	    });
    
    $('#del_img').click(function() {
	var forpage = $("#pageselector").val();
	//alert(forpage);
	sendData = {"forpage":forpage}
	$.ajax({
		    url: '<?php echo site_url('ajax/deleteimg'); ?>',
		    data: sendData,
		    type: 'POST',
		    cache: false,
		    success: function(response){
					    //alert(response);
					    var obj = $.parseJSON(response);
					    
				    if (obj.recentCardDetails.image0 == '')
				    {
				    var imgpath_0 = '<?php echo $this->config->item('theme_url')?>images/noimage.jpg';
				    $("#imgthumb0 img").attr("src",imgpath_0);
				    
				    //for card
				    $("img#img_rnd").attr("src",imgpath_0);
				    $("div#rnd .ui-wrapper").css("width","0px");
				    $("img#img_rnd").css("width","0px");
				    
				    $("img#img_rnd").css("height","0px");
				    $("div#rnd .ui-wrapper").css("height","0px");
				    }
					   }
	       });
	});
    

    //image transformatiion for page 0 - firdt page
    $('#img_rnd').resizable({
	    aspectRatio: 200 / <?php echo isset($newHeight_0) ? $newHeight_0 : 1 ;?>,
	    stop: function(event, ui) {
	    
	    var w = $(this).css("width");
	    var h = $(this).css("height");
	    
	    var forpage = $("#pageselector").val();
	    //alert(w+'-----'+h+'-----'+forpage);
	    sendData = {"forpage":forpage,"w":w,"h":h}
	    $.ajax({
			url: '<?php echo site_url('ajax/setsize'); ?>',
			data: sendData,
			type: 'POST',
			cache: false,
			success: function(html){
						$("#img0_width").val(w);
						$("#img0_height").val(h);
						}
		   });
	    
	    }
	});
	
    $('#rnd').draggable({
	appendTo: 'body',
	start: function(event, ui) {
	    isDraggingMedia = true;
	},
	stop: function(event, ui) {
	    isDraggingMedia = false;
	    
	var t = $(this).css("top");
	var l = $(this).css("left");
	
	var forpage = $("#pageselector").val();
	//alert(t+'-----'+l+'-----'+forpage);
	sendData = {"forpage":forpage,"t":t,"l":l}
	$.ajax({
			url: '<?php echo site_url('ajax/setposition'); ?>',
			data: sendData,
			type: 'POST',
			cache: false,
			success: function(html){
						$("#img0_top").val(t);
						$("#img0_left").val(l);
						}
		   });
	}
	
	
    });
    
    
    
     //image transformatiion for page 2 -third page
    $('#img_rnd2').resizable({
	    aspectRatio: 200 / <?php echo isset($newHeight_2) ? $newHeight_2 : 1 ;?>,
	    stop: function(event, ui) {
	    
	    var w = $(this).css("width");
	    var h = $(this).css("height");
	    
	    var forpage = $("#pageselector").val();
	    //alert(w+'-----'+h+'-----'+forpage);
	    sendData = {"forpage":forpage,"w":w,"h":h}
	    $.ajax({
			url: '<?php echo site_url('ajax/setsize'); ?>',
			data: sendData,
			type: 'POST',
			cache: false,
			success: function(html){
						$("#img2_width").val(w);
						$("#img2_height").val(h);
						}
		   });
	    
	    }
	
	
	
	});
	
    $('#rnd2').draggable({
	appendTo: 'body',
	start: function(event, ui) {
	    isDraggingMedia = true;
	},
	stop: function(event, ui) {
	    isDraggingMedia = false;
	    
	var t = $(this).css("top");
	var l = $(this).css("left");
	
	var forpage = $("#pageselector").val();
	//alert(t+'-----'+l+'-----'+forpage);
	sendData = {"forpage":forpage,"t":t,"l":l}
	$.ajax({
			url: '<?php echo site_url('ajax/setposition'); ?>',
			data: sendData,
			type: 'POST',
			cache: false,
			success: function(html){
						$("#img2_top").val(t);
						$("#img2_left").val(l);
						}
		   });
	
	}
	
    });
    
    //text for text page 2 -third page
    $('#img_txt2').resizable({
	stop: function(event, ui) {
	    
	    var w = $(this).css("width");
	    var h = $(this).css("height");
	    
	    var forpage = $("#pageselector_f").val();
	    //alert(t+'-----'+l+'-----'+forpage);
	    sendData = {"forpage":forpage,"w":w,"h":h}
	    $.ajax({
			url: '<?php echo site_url('ajax/setsizetext'); ?>',
			data: sendData,
			type: 'POST',
			cache: false,
			success: function(html){
						//alert(html);
						}
		   });
	    
	    }
    });
    
    $('#txt2').draggable({
	
	start: function(event, ui) {
	    isDraggingMedia = true;
	},
	stop: function(event, ui) {
	    isDraggingMedia = false;
	
	var t = $(this).css("top");
	var l = $(this).css("left");
	
	var forpage = $("#pageselector_f").val();
	//alert(t+'-----'+l+'-----'+forpage);
	sendData = {"forpage":forpage,"t":t,"l":l}
	$.ajax({
			url: '<?php echo site_url('ajax/setpositiontext'); ?>',
			data: sendData,
			type: 'POST',
			cache: false,
			success: function(html){
						//alert(html);
						}
		   });
	}
	
    });
    

});

function validity()
{
    var imgvalue = $("img#img_rnd").attr("src");
    var txtvalue = $("div#img_txt2>span").text();
    
    var msg='';
    
	if (imgvalue == '') msg +='You can not create a card without image\n';
	if (txtvalue == '') msg +='You can not create a card without text\n';
	
	if (msg != '') {
	    alert(msg);
	    return false;
	}
	else {
	    return true;
	}
	
}
</script>
<?php //isset($recentCardDetails) ? print_r($recentCardDetails) : print_r(0) ;?> 

<?php if(isset($recentCardDetails['img0_top']) && isset($recentCardDetails['img0_left']) && isset($recentCardDetails['img0_width']) && isset($recentCardDetails['img0_height']) ) { ?>
<input type="hidden" name="img0_top" id="img0_top" value="<?php echo $recentCardDetails['img0_top'];?>">
<input type="hidden" name="img0_left" id="img0_left" value="<?php echo $recentCardDetails['img0_left'];?>">

<input type="hidden" name="img0_width" id="img0_width" value="<?php echo $recentCardDetails['img0_width'];?>">
<input type="hidden" name="img0_height" id="img0_height" value="<?php echo $recentCardDetails['img0_height'];?>">
<?php } ?>

<?php if(isset($recentCardDetails['img2_top']) && isset($recentCardDetails['img2_left']) && isset($recentCardDetails['img2_width']) && isset($recentCardDetails['img2_height'])) { ?>
<input type="hidden" name="img2_top" id="img2_top" value="<?php echo $recentCardDetails['img2_top'];?>">
<input type="hidden" name="img2_left" id="img2_left" value="<?php echo $recentCardDetails['img2_left'];?>">

<input type="hidden" name="img2_width" id="img2_width" value="<?php echo $recentCardDetails['img2_width'];?>">
<input type="hidden" name="img2_height" id="img2_height" value="<?php echo $recentCardDetails['img2_height'];?>">
<?php } ?>

<div class="mid_container" style="padding: 60px 0px;overflow: hidden;">
	<div class="leftcardpl">
		<div class="cardview">
		    <div class="view1 page" style="display: block;">
		    <div class="main_displaybox" style="display: block;">
		    
		    <div id="rnd" class="test" style="cursor: move; text-align: center; vertical-align: middle; display:table; left: <?php echo (isset($recentCardDetails['img0_left']) && $recentCardDetails['img0_left'] != '') ? $recentCardDetails['img0_left'] : '0px';?>; top: <?php echo (isset($recentCardDetails['img0_top']) && $recentCardDetails['img0_top'] != '') ? $recentCardDetails['img0_top'] : '0px';?>;">
 
		    <?php if(isset($newHeight_0) && $newHeight_0 != '') {?>
		    <img id="img_rnd" style="border: none; width: <?php echo (isset($recentCardDetails['img0_width']) && $recentCardDetails['img0_width'] != '') ? $recentCardDetails['img0_width'] : '200px';?>; height: <?php echo (isset($recentCardDetails['img0_height']) && $recentCardDetails['img0_height'] != '') ? $recentCardDetails['img0_height'] : $newHeight_0;?>;" src="<?php echo base_url();?>media/cards_image/large/<?php echo $recentCardDetails['image0'];?>" />
		    <?php } else {?>
		    <img id="img_rnd" style="border: none;width: 0px;height: 0px;" src="" />
		    <?php } ?>
		    </div>
		    
		    </div>
		    </div>
		    
		    
		    <div class="view2 page" style="display: none;">
		    <div class="main_displaybox">
		
			&nbsp;
		    
		    </div>
		    </div>
		    
		    <div class="view3 page" style="display: none;">
		    <div class="main_displaybox" style="width: 359px; z-index: 999;" >
			
			<div id="txt2" style="cursor: move; text-align: center; vertical-align: middle; display:table; left: <?php echo (isset($recentCardDetails['txt2_left']) && $recentCardDetails['txt2_left'] != '') ? $recentCardDetails['txt2_left'] : '0px';?>; top: <?php echo (isset($recentCardDetails['txt2_top']) && $recentCardDetails['txt2_top'] != '') ? $recentCardDetails['txt2_top'] : '0px';?>;">
			
			<div id="img_txt2" style="text-align: left; word-wrap: break-word; border: none; width: <?php echo (isset($recentCardDetails['txt2_width']) && $recentCardDetails['txt2_width'] != '') ? $recentCardDetails['txt2_width'] : '256px';?>; height: <?php echo (isset($recentCardDetails['txt2_height']) && $recentCardDetails['txt2_height'] != '') ? $recentCardDetails['txt2_height'] : 'auto';?>; font-size: <?php echo (isset($recentCardDetails['txt2_fsize']) && $recentCardDetails['txt2_fsize'] != '') ? $recentCardDetails['txt2_fsize'] : '16px';?>;" ?>
			<?php if(isset($recentCardDetails['txt2']) && $recentCardDetails['txt2'] != '') { ?>
			<span><?php echo nl2br($recentCardDetails['txt2']); ?></span>
			<?php } else { ?>
			<span></span>
			<?php }?>

			</div>
			
			</div>
			
		    </div>
		    
		    
		    <div class="main_displaybox">
		    
		    <div id="rnd2" style="cursor: move; text-align: center; vertical-align: middle; margin: 50% auto; display:table; left: <?php echo (isset($recentCardDetails['img2_left']) && $recentCardDetails['img2_left'] != '') ? $recentCardDetails['img2_left'] : '0px';?>; top: <?php echo (isset($recentCardDetails['img2_top']) && $recentCardDetails['img2_top'] != '') ? $recentCardDetails['img2_top'] : '0px';?>;">

		    <?php if(isset($newHeight_2)) {?>
		    <img id="img_rnd2" style="text-align: left; border: none;width: <?php echo (isset($recentCardDetails['img2_width']) && $recentCardDetails['img2_width'] != '') ? $recentCardDetails['img2_width'] : '200px';?>; height: <?php echo (isset($recentCardDetails['img2_height']) && $recentCardDetails['img2_height'] != '') ? $recentCardDetails['img2_height'] : $newHeight_2;?>;" src="<?php echo base_url();?>media/cards_image/large/<?php echo $recentCardDetails['image2'];?>" />
		    <?php } else {?>
		    <img id="img_rnd2" style="border: none;width: 0px;height: 0px;" src="" />
		    <?php } ?>
		    
		    </div>
		    
		    </div>
		    <!-- ------------------------------------------- -->
		    
		    
		    </div> 
		   
		    <div class="view4 page" style="display: none;">
		    <div class="main_displaybox">
			<div class="lastlogo">
			    <div class="logoview"><a><img src="<?php echo $this->config->item('theme_url')?>images/logo.png" border="0" alt="" /></a></div>
			    <div><a>www.cardsleaf.com</a></div>
			</div>
		    </div>
            </div> 
        </div>
        <div class="preview_card">
        	<ul>
            	<li class="active pagectrl"><span class="photoarrow">&nbsp;</span><a style="cursor: pointer;"><img src="<?php echo $this->config->item('theme_url')?>images/thumb_page01.png" border="0" alt="page01" /></a></li>
                <li class="pagectrl"><span class="photoarrow">&nbsp;</span><a style="cursor: pointer;"><img src="<?php echo $this->config->item('theme_url')?>images/thumb_page02.png" border="0" alt="page02" /></a></li>
                <li class="pagectrl"><span class="photoarrow">&nbsp;</span><a style="cursor: pointer;"><img src="<?php echo $this->config->item('theme_url')?>images/thumb_page03.png" border="0" alt="page03" /></a></li>
                <li class="pagectrl"><span class="photoarrow">&nbsp;</span><a style="cursor: pointer;"><img src="<?php echo $this->config->item('theme_url')?>images/thumb_page04.png" border="0" alt="page04" /></a></li>
            </ul>
        </div>
	</div>
	<div class="rightcardpl">
		<div class="uploadbase">
        		<!--<div class="closepop"><a href="#"><i class="xicon">X</i></a></div>-->
        	<div class="uploadheading">Get Started!</div>
            <p>Creating your own one of a kind product is easy. Get a quick start by filling out the field(s) below. </p>
            <div class="uploadtitle">Add image:</div>
            <!-- thumbnail of 1st page -->
	    <div class="addimagebox1">
	    <a id="imgthumb0">
		<?php if(isset($recentCardDetails['image0']) && $recentCardDetails['image0'] != '') { ?>
	    <img width="80px" height="80px" src="<?php echo base_url();?>media/cards_image/large/<?php echo $recentCardDetails['image0'];?>" border="0" alt="" />
	    <?php } else {?>
	    <img width="80px" height="80px" src="<?php echo $this->config->item('theme_url')?>images/noimage.jpg" border="0" alt="" />
	    <?php } ?>
	    </a>
	    </div>
	    
	    <!-- thumbnail of 2nd page -->
	    <!--<div class="addimagebox1">
	    <a href="#" id="imgthumb2">
		<?php if(isset($recentCardDetails['image2']) && $recentCardDetails['image2'] != '') {?>
	    <img width="80px" height="80px" src="<?php echo base_url();?>media/cards_image/large/<?php echo $recentCardDetails['image2'];?>" border="0" alt="" />
	    <?php } else {?>
	    <img width="80px" height="80px" src="<?php echo $this->config->item('theme_url')?>images/noimage.jpg" border="0" alt="" />
	    <?php } ?>
	    </a>
	    </div>
	    -->
            <div class="uploadoption" style="display: block;" id="upload_switch">
		<ul>
		    <li><a id="upload_select_img" style="cursor: pointer;">Select image</a></li>
		    <li> | </li>
		    <li><a id="del_img" style="cursor: pointer;">Delete</a></li>
		</ul>
	    </div>
            
	    <div class="clear" style="margin: 0 0 25px 0;"></div>
	    
	    <span id="text_block" style="display: none;">
           <!-- <div class="uploadtitle">Text (optional):</div>-->
            <!--<div class="cardtextfield">Text1 </div>-->
	    
            <div class="uploadoption" style="display: block;" id="text_switch">
            <ul>
                <li style="float: none;">
		    <div><input name="set_text" id="set_text" type="button" value="Add Text" class="cardbutton" />
		<!--<input name="" type="button" value="Skip now" class="cardbutton" />-->
	    </div>
		</li>
		
                <li style="float: none;">
		    <div style="position: relative; margin: 20px 0 10px 0;">
			<span class="textleft001" style="width: auto; margin: 0 10px 0 0;">Size:</span>
                   
                    <input name="fsize" id="fsize" type="text" value="<?php echo (isset($recentCardDetails['txt2_fsize']) && $recentCardDetails['txt2_fsize'] != '') ? intVal($recentCardDetails['txt2_fsize']) : '16.0';?>" class="text_drop_field" style="background-color: #ffffff; border: 1px solid #ccc; float: left;" />
                    <div class="spinner" style="float: left;">
                        <span class="spinnerup" id="fsizeup">▲</span>
                        <span class="spinnerdn" id="fsizedn">▼</span>
                    </div>
                    
                    <!--<select name="" class="boxdrop" style="width: auto;">
                    <option>12</option>
                    <option>13</option>
                    <option>14</option>
                    <option>15</option>
                    <option>16</option>
                    <option>17</option>
                    <option>18</option>
                    </select>-->
                    </div>
                </li>
            </ul>
	    </div>
	    </span>
	    
	    
	    <div class="clear" style="margin: 0 0 45px 0;"></div>
            <div><input name="make" id="make" type="button" value="Make it now" class="cardbutton" style="display: none;" />
		<!--<input name="" type="button" value="Skip now" class="cardbutton" />-->
	    </div>
	    
	    <div class="clear" style="margin: 0 0 45px 0;"></div>
	    <div><input name="prev" id="prev" type="button" value="Previous" class="cardbutton" />
		<input name="next" id="next" type="button" value="Next" class="cardbutton" />
	    </div>
	    
        </div>
	</div>



</div>

<!-- ---------------------------image upload start-------------------------- -->
<div class="uploadcon_base" style="display: none;" id="upload_img">
<style type="text/css">
.previewbox { width:200px; border:solid 1px #dedede; padding:10px; }
#card_image { color:#cc0000; font-size:12px; }
.heading_title {
	font: normal 24px/30px Arial, Helvetica, sans-serif;
	color: #555;
	font-style: italic;
	margin: 0 0 20px 0;
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
	<form id="textform" method="post" enctype="multipart/form-data" action='' style="margin: 0; padding: 0;">
	<div class="heading_title">Add your text</div>
    
    <div class="clear"></div>
    <input type="hidden" name="pageselector_f" id="pageselector_f" value="0">
    <textarea name="cardtext" id="cardtext" cols="" rows="" class="textareatxebox" style="font: normal 12px/18px Arial, Helvetica, sans-serif; color: #777; padding: 5px; margin: 10px auto; resize: none;" placeholder="200 characters maximum"><?php echo (isset($recentCardDetails['txt2']) && $recentCardDetails['txt2'] != '') ? $recentCardDetails['txt2'] : ''; ?></textarea>
    <div class="note"><span style="font-weight: bold;">Note:</span>  <span class="count" id="charcount">200</span> character(s) left.</div>
    <div class="clear"></div>
    <div><input name="text_btn" id="text_btn" type="button" value="Ok" class="cardbutton" /></div>
    <div>
    </div>
    
	</form>
	<div id="card_image"></div>
    <div class="clear"></div>
    </div>
    </div>
</div>

<!-- ---------------------------text add end-------------------------- -->
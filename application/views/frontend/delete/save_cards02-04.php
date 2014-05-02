<script src="js/jquery-1.4.4.min.js"></script>
<script src="js/slides.min.jquery.js"></script>


<script src="<?php echo $this->config->item('theme_url') ?>/js/jquery.datepick.js"></script>
<link rel="stylesheet" href="<?php echo $this->config->item('theme_url') ?>css/jquery.datepick.css" type="text/css" media="all">

<script type="text/javascript">
    $(document).ready(function() {
        // validate signup form on keyup and submit
        $("#address_form").validate({
            
            rules: {
                rname: "required",
                d_dt: "required",
                r_country: "required", 
                r_state: "required",
                r_city: "required",
                r_zip: "required",
                radd1: "required",
		
		<?php /*?>remail: {
		    required :false,
		    email:true
		}<?php */?>
            },
            messages: {
                rname: "Please enter your receiver name.",
                d_dt: "Please enter the delivery date.",
                r_country: "Select your receiver country.",
                r_state: "Select your receiver state.",
                or_state: "Type your receiver state.",
                r_city: "Select your receiver city.",
                r_zip: "Please enter a your receiver zip / pincode",
                radd1: "Please enter your receiver address 1.",
		
		<?php /*?>remail:"Please type your valid email."<?php */?>
            },
	    success: "valid"
        });
        
         $('#IndNonState').css('display','none');
        
            $('#r_country').change(function(){
                 var option_id=this.value;
                 if(option_id == 99){
                     $('#r_state').slideDown();
                      $('#IndNonState').slideUp();
                      $("#or_state").rules("remove", "required");
                      $("#r_state").rules("add", "required");
		      $( "label.error" ).remove('label');
		      
                 }
                 else{
                     $('#r_state').slideUp();
                     $('#IndNonState').slideDown();
                     $("#r_state").rules("remove", "required");
                     $("#or_state").rules("add", "required");
		    $( "label.error" ).remove('label');
                 }
                
            });
            
            $('#r_zip').keyup(function(){
                check_int();
            });
            
            
            $('#prev_page').click(function(){
               window.history.back(); 
            });
            
            

    });


</script>

<script type="text/javascript">

    $(document).ready(function() {

        $("#d_dt").datepick({
	    defaultDate: '<?php echo date("m/d/Y"); ?>',
	    yearRange: 'c-1:c+10',
	    dateFormat: 'mm/dd/yyyy',
	    minDate: 'today+4d'});
    });


    $(document).ready(function() {
        var control_switch = 0;
        //alert($('#carousel_ul li').length>3);
        ($('#carousel_ul li').length > 3 == true) ? control_switch = 1 : control_switch = 0;
        //alert($('#carousel_ul li').length>3 == false);

        //options( 1 - ON , 0 - OFF)
        var auto_slide = control_switch;
        var hover_pause = control_switch;
        var key_slide = 1;

        //speed of auto slide(
        var auto_slide_seconds = control_switch == 0 ? -1 : 5000;
        /* IMPORTANT: i know the variable is called ...seconds but it's 
         in milliseconds ( multiplied with 1000) '*/

        /*move he last list item before the first item. The purpose of this is 
         if the user clicks to slide left he will be able to see the last item.*/
        $('#carousel_ul li:first').before($('#carousel_ul li:last'));

        //check if auto sliding is enabled
        if (auto_slide == 1) {
            /*set the interval (loop) to call function slide with option 'right' 
             and set the interval time to the variable we declared previously */
            var timer = setInterval('slide("right")', auto_slide_seconds);

            /*and change the value of our hidden field that hold info about
             the interval, setting it to the number of milliseconds we declared previously*/
            $('#hidden_auto_slide_seconds').val(auto_slide_seconds);
        }

        //check if hover pause is enabled
        if (hover_pause == 1) {
            //when hovered over the list 
            $('#carousel_ul').hover(function() {
                //stop the interval
                clearInterval(timer)
            }, function() {
                //and when mouseout start it again
                timer = setInterval('slide("right")', auto_slide_seconds);
            });

        }

        //check if key sliding is enabled
        if (key_slide == 1) {

            //binding keypress function
            $(document).bind('keypress', function(e) {
                //keyCode for left arrow is 37 and for right it's 39 '
                if (e.keyCode == 37) {
                    //initialize the slide to left function
                    slide('left');
                } else if (e.keyCode == 39) {
                    //initialize the slide to right function
                    slide('right');
                }
            });

        }

    });

//FUNCTIONS BELLOW

//slide function  
    function slide(where) {

        //get the item width
        var item_width = $('#carousel_ul li').outerWidth() + 10;

        /* using a if statement and the where variable check 
         we will check where the user wants to slide (left or right)*/
        if (where == 'left') {
            //...calculating the new left indent of the unordered list (ul) for left sliding
            var left_indent = parseInt($('#carousel_ul').css('left')) + item_width;
        } else {
            //...calculating the new left indent of the unordered list (ul) for right sliding
            var left_indent = parseInt($('#carousel_ul').css('left')) - item_width;

        }


        //make the sliding effect using jQuery's animate function... '
        $('#carousel_ul:not(:animated)').animate({'left': left_indent}, 500, function() {

            /* when the animation finishes use the if statement again, and make an ilussion
             of infinity by changing place of last or first item*/
            if (where == 'left') {
                //...and if it slided to left we put the last item before the first item
                $('#carousel_ul li:first').before($('#carousel_ul li:last'));
            } else {
                //...and if it slided to right we put the first item after the last item
                $('#carousel_ul li:last').after($('#carousel_ul li:first'));
            }

            //...and then just get back the default left indent
            $('#carousel_ul').css({'left': '0px'});
        });





    }

    function pickaddbyimg(img)
    {
	
        var sendData = {"img": img}
        $.ajax({
            url: '<?php echo site_url('ajax/gettheadd'); ?>',
            data: sendData,
            type: 'POST',
            dataType: 'json',
            cache: false,
            success: function(html) {
                //alert(html);
                //html = $.parseJSON(html);
                $("#rname").val(html.name);
		
                $("#r_country").val(html.country);
		
		if(html.country != 99)
		{
		$('#r_state').slideUp();
		$('#IndNonState').slideDown();
		$("#r_state").rules("remove", "required");
		$("#or_state").rules("add", "required");
	        $( "label.error" ).remove('label');
		
		$("#or_state").val(html.state);
		
		}
		else
		{
		$('#r_state').slideDown();
		$('#IndNonState').slideUp();
		$("#or_state").rules("remove", "required");
		$("#r_state").rules("add", "required");
		$( "label.error" ).remove('label');
		
		$("#r_state").val(html.state['state_id']);
		}
		
                $("#r_city").val(html.city);
                $("#r_zip").val(html.zipcode);
                $("#conno").val(html.contactno);
                $("#radd1").val(html.reciver_add1);

                $("#keepadd").removeAttr("checked");
            }
        });
    }

    function check_int() {
        var zip = $("#r_zip").val();
        if (isNaN(zip)) {
            alert("only numbers allowed.");
            $("#r_zip").val('');
            $("#r_zip").focus();
        }
    }

    function check_contact() {
        var zip = $("#conno").val();
        if (isNaN(zip)) {
            alert("only numbers allowed.");
            $("#conno").val('');
            $("#conno").focus();
        }
    }

</script>
<style type="text/css">
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

</style>
<div class="mid_container">
    <?php //echo $this->session->userdata('img_id');?>
    <?php if ($receiver_addDtls) { ?>
        <div id='carousel_container'>
            <div id='left_scroll'><a href='javascript:slide("left");'><img src='<?php echo $this->config->item('theme_url') ?>images/left.png' width="16" height="33" border="0" /></a></div>
            <div id='carousel_inner'>
                <?php //echo print_r($receiver_addDtls);?> 
                <ul id='carousel_ul'>
                    <?php foreach ($receiver_addDtls as $eachAdd) { ?>
                        <li><a onclick="pickaddbyimg(<?php echo $eachAdd['img_id']; ?>)" style="cursor: pointer;">
                                <div class="thumb" style="height:167px;">
                                    <p><strong>Name : </strong><?php echo isset($eachAdd['name']) ? $eachAdd['name'] : ''; ?></p>

                                    <p><strong>Address : </strong><?php echo isset($eachAdd['reciver_add1']) ? substr($eachAdd['reciver_add1'],0,24).'...' : ''; ?></p>

                                    <p><strong>Country : </strong><?php echo isset($eachAdd['country']) ? $eachAdd['country_name'] : ''; ?></p>

                                    <p>
					<strong>State : </strong>
				    <?php if($eachAdd['country']!=99) 
					    echo (isset($eachAdd['state']) )? $eachAdd['state'] : '';
					  else
					    echo (isset($eachAdd['state']['name']) )? $eachAdd['state']['name'] : '';
				    ?>
				    </p>
                                    
                                    <p><strong>City : </strong><?php echo isset($eachAdd['city']) ? $eachAdd['city'] : '' ?></p>

                                    <p><strong>Zip/Postal Code : </strong><?php echo isset($eachAdd['zipcode']) ? $eachAdd['zipcode'] : ''; ?></p>

                                    <p><strong>Contact Number :</strong><?php echo isset($eachAdd['contactno']) ? $eachAdd['contactno'] : ''; ?></p>
                                </div>
                            </a>
                        </li>   
                    <?php } ?>


                </ul>


            </div>
            <div id='right_scroll'><a href='javascript:slide("right");'><img src='<?php echo $this->config->item('theme_url') ?>images/right.png' width="16" height="33" border="0"/></a></div>
            <input type='hidden' id='hidden_auto_slide_seconds' value=0 />
        </div>
    <?php } ?>
    <!--<ul class="thumb_ul">
    
    <li><a href="#">
    <p><strong>Name : </strong>your Name</p>
    
    <p><strong>Address 1 : </strong>your Add</p>
    
    <p><strong>Address 2 : </strong>your Add</p>
    
    <p><strong>City : </strong>your city</p>
    
    <p><strong>Country : </strong>your Country</p>
    
    <p><strong>Zip/Postal Code : </strong> your Zip/Postal Code</p>
    
    <p><strong>Contact Number (optional) :</strong>your  Contact no </p>
    
    </a></li>
    
    <br class="spacer"/>
    
    </ul>-->
    <br class="spacer"/>
    <div class="clear"></div>
    <div style="margin: 0 auto 25px auto; display: table;"><input class="roundbutton" id="prev_page" type="button" value="Back" style=""></div>
    <div class="clear"></div>
    <div class="row_form" style="padding: 20px 0;">

        <form method="post" action="" enctype="multipart/form-data" name="address_form" id="address_form" autocompete="off">
	    <?php /*?><label>Email:</label>

            <span class="rightdivbox"><input type="text" name="remail" id="remail" class="textbox2" /></span><?php */?>
            <div class="thanktxt" style="font-size: 28px;line-height: 40px; padding: 0 0 20px 0; border-bottom: 3px solid #00d8ff;margin: 0 0 20px 0;">Mailing Address</div>
	    <label><span class="red">*</span> Name:</label>

            <span class="rightdivbox"><input type="text" name="rname" id="rname" class="textbox2" /></span>

            <label><span class="red">*</span> Delivery Dt :</label>

            <span class="rightdivbox"><input type="text" name="d_dt" id="d_dt" class="textbox2" /></span>


            <label><span class="red">*</span> Country :</label>

            <span class="rightdivbox" ><select name="r_country" id="r_country" class="dropdown2" style="width: 352px;" >
                    <option value="">Select Country</option>
                    <?php foreach ($countryList as $eachCountry) { ?>
                        <option value="<?php echo $eachCountry['country_id']; ?>" <?php if ($eachCountry['country_id'] == 99) { ?> selected="selected" <?php } ?>>
                            <?php echo $eachCountry['country_name']; ?></option>
                    <?php } ?>
                </select>
                    <!--<input type="text" name="r_country" id="r_country" class="textbox2" />-->
            </span>
            
             <label><span class="red">*</span> Street Address :</label>

            <span class="rightdivbox"><textarea name="radd1" id="radd1" class="textarea2"></textarea></span>
	    
             <label><span class="red">*</span> State :</label>

            <span class="rightdivbox">
                <select name="r_state" id="r_state" class="dropdown2" style="width: 352px;">
                    <option value="">Select State</option>
                    <?php foreach ($all_state_ind as $eachStateInd) { ?>
                        <option value="<?php echo $eachStateInd['state_id']; ?>"><?php echo $eachStateInd['name']; ?></option>
                            
                    <?php } ?>
                </select>
                <span id="IndNonState"><input type="text" name="or_state" id="or_state" class="textbox2" /></span>
            </span>
            
            

            <label><span class="red">*</span> City :</label>

            <span class="rightdivbox"><input type="text" name="r_city" id="r_city" class="textbox2" /></span>

            <label><span class="red">*</span> Zip/Postal Code :</label>

            <span class="rightdivbox"><input type="text" name="r_zip" id="r_zip"  class="textbox2" onblur="check_int();" /></span>

            <label>Contact Number :</label>

            <span class="rightdivbox"><input type="text" name="conno" id="conno"  class="textbox2" onblur="check_contact();" /></span>

            <div class="divider"></div>


            <label>Keep Address :</label>

            <span class="rightdivbox"><input name="keepadd" id="keepadd" type="checkbox" value="1" checked="checked" class="" style="margin: 10px 0px;display: inline-block; float: left;" /></span>

            <div class="button_holder">

                <input class="roundbutton"  style="" type="submit" value="Buy"  />

            </div>

        </form>

        <br class="spacer"/>



    </div>

    <br class="spacer"/>

</div>




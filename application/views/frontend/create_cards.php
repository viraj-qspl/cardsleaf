<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Booklet - jQuery Plugin</title>

    <!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->

    <!-- required files for booklet -->
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" type="text/javascript"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/jquery-ui.min.js" type="text/javascript"></script>-->
    
    <script src="<?php echo $this->config->item('theme_url')?>booklet/jquery.easing.1.3.js" type="text/javascript"></script>
    <script src="<?php echo $this->config->item('theme_url')?>booklet/jquery.booklet.latest.js" type="text/javascript"></script>
    <link href="<?php echo $this->config->item('theme_url')?>booklet/jquery.booklet.latest.css" type="text/css" rel="stylesheet" media="screen, projection, tv" />
<link href='http://fonts.googleapis.com/css?family=Parisienne' rel='stylesheet' type='text/css'>
    <style type="text/css">
        body {background:#ccc; font:normal 12px/1.2 arial, verdana, sans-serif;}
    </style>

<script type="text/javascript">
	    $(function () {		
	        $("#mybook").booklet({
	        closed: true
	    })
	    });
	    

$(document).ready(function() {  
  // validate signup form on keyup and submit
	$("#msg_frm").validate({
		rules: {
			cardmsg: {
				required: true
			}
		},
		messages: {
			cardmsg: {
				required: "Please Type your message."
			}
		}
	});
  
});
</script>

</head>
<style>
#mybook .booklet {
	height: 700px!important;
}


.booklet .b-wrap-right {
	background: url(../themes/frontend/booklet/images/texturebg1.png) center top repeat #fff;
}
.cover_page, .second_page, .third_page, .fourth_page {
	width: 405px;
	height: 580px;
	overflow: hidden;
	position: relative;
}
.cover_page {	
	/*background: url(../themes/frontend/booklet/images/firstpage.jpg) center top no-repeat #fff;*/
	<?php if(isset($recentImgDtls['image'])) { ?>
	background: url('<?php echo base_url()?>media/cards_image/thumb/thumb_<?php echo $recentImgDtls['image']?>') center top no-repeat #fff;
	background-size:405px 580px;
	background-repeat:no-repeat;
	<?php } else {?>
	background: url('') center top no-repeat #fff;
	<?php } ?>
}
.second_page {
	background: #eee;
}
.third_page {
	background: #fff;
	color: #525051;
}
.fourth_page {
	background: url(../themes/frontend/booklet/images/texturebg1.png) center top repeat #fff;
	/*filter: alpha(opacity = 80);
	opacity: 0.8;*/
}
.textarea_holder {
	width:100%;
	margin: 0 0 20px 0
}
.textarea_holder textarea
{
  height: 280px !important;
    width: 363px !important;
	-webkit-border-radius: 4px;
-moz-border-radius: 4px;
padding:10px;
border-radius: 4px;
border:#666666 solid 1px;
box-shadow: 3px 3px 5px #b8b6b6;
}
.submit_mss
{
width:100%;
text-align:center;
}
.over_img {
	background: url(../themes/frontend/booklet/images/over_img.png) left top no-repeat;
	position: absolute;
	top: 0;
	left: 0;
	z-index: 2;
	display: block;
	width: 181px;
	height: 201px;
}
.uploadimgbox {
	/*width: 395px;*/
	width: 312px;
	height: 486px;
	padding: 5px 0;
	margin: 0 auto;
	background: #fff;
	overflow: hidden;
	position: relative;
	background: none;
}
.uploadimgbox img {
	
}
.framing01 {
	width: auto;
	max-width: 312px;
	height: auto;
	max-height: 366px;
	background: #ffd283;
	padding: 0;
	margin: 32px auto 0 auto;
	display: table;
	position: relative;
/*	z-index: 1;
	top: 32px;
	left: 47px;*/
	overflow: hidden;
}
.topfram {
	background: url(../themes/frontend/booklet/images/top_fram_img.png) left top repeat-x;
	position: absolute;
	left: 0;
	top: 0;
	height: 7px;
	width: 100%;
}
.rightfram {
	background: url(../themes/frontend/booklet/images/right_fram_img.png) right top repeat-y;
	position: absolute;
	right: 0;
	top: 0;
	width: 7px;
	height: 100%;
}
.botfram {
	background: url(../themes/frontend/booklet/images/bot_fram_img.png) left bottom repeat-x;
	position: absolute;
	left: 0;
	bottom: 0;
	height: 7px;
	width: 100%;
}
.leftfram {
	background: url(../themes/frontend/booklet/images/left_fram_img.png) left top repeat-y;
	position: absolute;
	left: 0;
	top: 0;
	width: 7px;
	height: 100%;
}
.up_img { float: left; margin: 0; overflow: hidden; max-width: 405px;/*312px*/}
/*.up_img img{ height:188px}*/
.up_img img{ text-align: center; vertical-align: middle; display: block;}
.wish_txt {
	width: 320px;
	height: 42px;
	font-family: "Dancing Script";
	color: #0097d6;
	text-align: center;
	font-size: 34px;
	line-height: 42px;
	font-weight: bold;
	margin: 0 auto;
	padding: 5px;
	text-shadow: 2px 2px #ccc;
	background: #fff;
	border: 2px solid #f7cc64;
}
.blank {
	width: 100%;
	height: 100%;
	background: #fff;
	margin: 0;
	display: block;
}
.maincontent {
	padding: 10px;
	margin: 0;
	overflow: hidden;
	height: 570px;
	position: relative;
}
.maincontent h3 {
	font-family: "Dancing Script";
	color: #0097d6;
	text-align: center;
	font-size: 30px;
	line-height: 30px;
	font-weight: bold;
	padding: 0;
	margin: 25px 0 35px 0;
}
.maincontent p {
	font-family: "Dancing Script";
	color: #777;
	text-align: left;
	font-size: 24px;
	line-height: 26px;
	font-weight: normal;
	padding: 0;
	margin: 0;
	height: 380px;
	border-bottom: 1px solid #ccc;
}
.maincontent .address {
	font: normal 11px/16px Arial, Helvetica, sans-serif;
	color: #999;
	text-align: left;
	padding: 10px 0 20px 0;
	margin: 0;
	position: absolute;
	bottom: 0;
}
.lastpage {

}
.lastpage .sitelogo {
	margin: 440px auto 5px auto;
	display: table;
}
.lastpage .siteaddress {
	font: normal 11px/16px Arial, Helvetica, sans-serif;
	color: #00d8ff;
	text-align: center;
	padding: 0;
	margin: 0;
}
.lastpage .siteaddress a {
	color: #00d8ff;
	text-decoration: none;
	cursor: pointer;
	padding: 0;
	margin: 0;
	cursor: pointer;
}
.submit_mss .sub_btn
{
background:#0097D6; margin-top:20px; color:#FFFFFF; font-size:18px; line-height:30px; width:80px;
-webkit-border-radius: 4px;
-moz-border-radius: 4px;
border-radius: 4px;
border:none;
height:32px;
font-family: "Dancing Script";
font-style:italic;
cursor: pointer;
}
h3.mess{ color:#0097D6; font-family: 'Parisienne', cursive;}
</style>
<body>

	<section>
	    <!--<div id="mybook" style="height:1600px;transform:rotate(90deg); -ms-transform:rotate(90deg); /* IE 9 */ -webkit-transform:rotate(90deg); /* Safari and Chrome */" >-->
	    <div id="mybook" style="height:800px;">
		
		<!-- ----------------------------First Page start---------------------------- -->
		
	        <div title="first page" class="cover_page">
		    
            	<div class="over_img" style="display: none;">&nbsp;</div>
	            <div class="uploadimgbox">
                	<div class="framing01">
                		<div class="topfram">&nbsp;</div>
                        <div class="botfram">&nbsp;</div>
                        <div class="rightfram">&nbsp;</div>
                        <div class="leftfram">&nbsp;</div>
                        
                	<div class="up_img">
			<?php if(isset($recentImgDtls['image'])) { ?>
			<!--<img src="<?php echo base_url()?>media/cards_image/thumb/thumb_<?php echo $recentImgDtls['image']?>">-->
			<?php } ?>
			</div>
                    </div>
                </div>
                <!--<div class="wish_txt">Happy Birth Day Mom</div>-->
	        
		</div>
		<!-- ----------------------------First Page end---------------------------- -->
		
		<!-- -------------------Second and third Page start----------------------- -->
		
	        <div title="second page" class="second_page">
	            <div class="blank"></div>
	        </div>
		
	        <!-- ---------------------------------------------------------------------- -->
		
		<div title="third page" class="third_page">
            	<form name="msg_frm" id="msg_frm" method="post" action="<?php echo base_url().'cards/setmsg'; ?>" enctype="multipart/form-data">
		<div class="maincontent">
	            	<h3 class="mess">Type your message</h3>
                    <div class="clear"></div>
                    <div class="textarea_holder">
                    	<textarea name="cardmsg" id="cardmsg"><?php if(isset($recentImgDtls['text_message'])) echo $recentImgDtls['text_message']?></textarea>
                    </div>
                    <div class="submit_mss">
                    	<input type="submit" value="Submit" class="sub_btn"/>
                    </div>
		</form>
                    <div class="clear"></div>
                   
                </div>
		
		</div>
		<!-- -------------------Second and third Page end---------------------------- -->
		
		<!-- -----------------------forth Page start--------------------------------- -->
	       
	        <div title="fourth page" class="fourth_page">
	            <div class="lastpage">
                	<div class="sitelogo"><img src="../themes/frontend/images/logo.png"></div>
                    <div class="siteaddress"><a href="#">www.cardsleaf.com</a></div>
                </div>
	        </div>
	        
		<!-- -----------------------forth Page end--------------------------------- -->
		
	    </div>
	</section>
	<footer></footer>
</body>
</html>
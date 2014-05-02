<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>welcome</title>
	

<style type="text/css"></style>
</head>

<body>
<div style="width: 596px; margin: 0 auto; overflow: hidden; border: 2px solid #00d8ff; font-family: Arial;">
	<div style="width: 100%; height: 28px;  padding: 10px 0; background: url(<?php echo $this->config->item('theme_url')?>images/header_bg.png) center bottom repeat-x;">
    	<div style=" width: 134px; margin: 0 auto; display: block;"><a href="#"><img src="<?php echo $this->config->item('theme_url')?>images/logo3.png" width="134" height="19" style="display: block;"/></a></div>
    </div>
    <div style="height: 0; line-height: 0; clear: both;"></div>
    
    
    <div style="width: 93.5%; padding: 15px 20px; margin: 0; font-family: Arial;">
    
    	<!--mail content here start-->
        
        <p>Thank you for retrive your password!</p>
	<br>    
	<p><a href="<?php echo base_url().'home/change_pass_edit/'.base64_encode($usr_dtls['user_id']) ?>">Change Password.</a></p>
	<br>  	    
	If you are unable to open the hyperlink above, copy and paste the following URL into your internet browser (if the link is split into two lines, be sure to copy both lines): <br><br><?php echo base_url().'/home/change_pass_edit/'.base64_encode($usr_dtls['user_id']);?>
	
	
	
	<!--mail content here end-->
    </div>
   
 
    <div style="height: 0; line-height: 0; clear: both;"></div>
    <div style="width: 100%; height: 114px; margin: 0; font-family: Arial;">
    	<div style="width: 100%; height: 20px; background: #34363a; color: #989BA2; font-size: 12px; padding: 15px 0; font-family: Arial;">
        	<ul style="padding: 0; margin: 0 auto; display: table;">
            	<li style="padding: 0; margin: 0; list-style-type: none; float: left;"><a href="#" style="color: #989BA2;">About</a></li>
                <li style="padding: 0; margin: 0 5px; list-style-type: none; float: left; color: #989BA2;"> | </li>
            	<li style="padding: 0; margin: 0; list-style-type: none; float: left;"><a href="#" style="color: #989BA2;">Team</a></li>
                <li style="padding: 0; margin: 0 5px; list-style-type: none; float: left; color: #989BA2;"> | </li>
                <li style="padding: 0; margin: 0; list-style-type: none; float: left;"><a href="#" style="color: #989BA2;">Careers</a></li>
                <li style="padding: 0; margin: 0 5px; list-style-type: none; float: left; color: #989BA2;"> | </li>
                <li style="padding: 0; margin: 0; list-style-type: none; float: left;"><a href="#" style="color: #989BA2;">Press & Media</a></li>
                <li style="padding: 0; margin: 0 5px; list-style-type: none; float: left; color: #989BA2;"> | </li>
                <li style="padding: 0; margin: 0; list-style-type: none; float: left;"><a href="#" style="color: #989BA2;">Privacy</a></li>
                <li style="padding: 0; margin: 0 5px; list-style-type: none; float: left; color: #989BA2;"> | </li>
                <li style="padding: 0; margin: 0; list-style-type: none; float: left;"><a href="#" style="color: #989BA2;">Terms and Condition</a></li>
                <li style="padding: 0; margin: 0 5px; list-style-type: none; float: left; color: #989BA2;"> | </li>
                <li style="padding: 0; margin: 0; list-style-type: none; float: left;"><a href="#" style="color: #989BA2;">Support</a></li>
                <li style="padding: 0; margin: 0 5px; list-style-type: none; float: left; color: #989BA2;"> | </li>
                <li style="padding: 0; margin: 0; list-style-type: none; float: left;"><a href="#" style="color: #989BA2;">Contact Us</a></li>
            </ul>
        </div>
    	<div style="width: 100%; height: 64px; background: #1c1d1f; color: #989BA2;font-family: Arial; font-size: 12px; line-height: 64px; text-align: center;"> &copy;2014 Cardsleaf. All rights reserved </div>
    </div>
</div>

</body>
</html>

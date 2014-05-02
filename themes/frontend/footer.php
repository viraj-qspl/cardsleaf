







<div class="footer">
<div class="links">
<ul>
<li><a href="<?php echo site_url('home/page/aboutus')?>">About Us</a>|</li>
<li><a href="<?php echo site_url('package')?>">Package</a>|</li>
<li><a href="<?php echo site_url('cards/layout')?>">Create</a>|</li>
<li><a href="<?php echo site_url('home/signup/')?>">Signup</a>|</li>
<li><a href="<?php echo site_url('home/page/contactus')?>">Contact Us</a>|</li>
<li><a href="<?php echo site_url('home/page/privacy')?>">Privacy Policy</a>|</li>
<li><a href="<?php echo site_url('home/page/terms_condition')?>">Terms Of Use</a>|</li>
<li><a href="http://partyleaf.com/" target="_blank">www.partyleaf.com</a></li>

  <!--li><a target="_blank" href="<?php echo site_url('admin/home/login')?>">Vendor Login</a></li-->
  <!--li><a href="<?php echo site_url('home/page/support')?>">Support </a></li-->


</ul>
</div><!--links-->
<div class="clear"></div>
</div><!--footer-->

<div class="container">
<div class="copyright">©2014 cardsleaf. All rights reserved</div><!--copyright-->
</div><!--container-->




<script defer src="<?php echo $this->config->item('theme_url')?>js/jquery.flexslider.js"></script>

  <script type="text/javascript">
    $(function(){
     // SyntaxHighlighter.all();
    });
    $(window).load(function(){
      $('.flexslider').flexslider({
        animation: "fade",
        start: function(slider){
          $('').removeClass('loading');
        }
      });
    });
  </script>
  
 <?php /**  ?>
 	<script type="text/javascript" src="<?php echo $this->config->item('theme_url')?>newjs/jquery.flexslider.js"></script>
	JQUERY CODE FROM OLD HTML
	
	 <!----------header banner---------->
      <!-- jQuery -->
 

  <!-- FlexSlider -->
  

  <script type="text/javascript">
    //$(function(){
    //  SyntaxHighlighter.all();
    //});
    $(window).load(function(){
      $('.flexslider').flexslider({
        animation: "slide",
        start: function(slider){
          $('body').removeClass('loading');
        }
      });
    });
  </script>
    <!----------end header banner------> 
  
 <?php **/ ?> 
  
  
  
  
  
  
  
  
  
  
</body>
</html>
	
	
	

	


	











 <!-- NEW HTML CODE STARTS HERE -->

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">
<title>Card Leaf</title>

<link href="<?php echo $this->config->item('theme_url')?>css/newcss/stylesheet.css" type="text/css" rel="stylesheet" />

<?php /**
	if( $this->uri->segment(1)=='home' && ($this->uri->segment(2)=='index' || $this->uri->segment(2)=='' )) { ?>
		<link href="<?php echo $this->config->item('theme_url')?>css/newcss/stylesheet.css" type="text/css" rel="stylesheet" />
	<?php } else { ?>
		<link href="<?php echo $this->config->item('theme_url')?>css/style.css" type="text/css" rel="stylesheet" />
		<link href="<?php echo $this->config->item('theme_url')?>css/card.css" type="text/css" rel="stylesheet"/>
	<?php } **/ ?>
	
	<link href="<?php echo $this->config->item('theme_url')?>css/card.css" type="text/css" rel="stylesheet"/>

<script type="text/javascript" src="<?php echo $this->config->item('theme_url')?>js/newjs/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('theme_url')?>js/newjs/navigation.js"></script>

<script type="text/javascript">
 $(document).ready(function(){
  function add() {
    if($(this).val() === ''){
      $(this).val($(this).attr('placeholder')).addClass('placeholder');
    }
  }
  function remove() {
    if($(this).val() === $(this).attr('placeholder')){
      $(this).val('').removeClass('placeholder');
    }
  }

  // Create a dummy element for feature detection
  if (!('placeholder' in $('<input>')[0])) {

    // Select the elements that have a placeholder attribute
    $('input[placeholder], textarea[placeholder]').blur(add).focus(remove).each(add);

    // Remove the placeholder text before the form is submitted
    $('form').submit(function(){
      $(this).find('input[placeholder], textarea[placeholder]').each(remove);
    });
  }
  $('#logout').click(function(){	
		window.location = '<?php echo $this->config->item('base_url').'home/logout/'; ?>';
})

  
  
});




</script>

<script type="text/javascript" >
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
</script>






<!--main banner-->
<link href="<?php echo $this->config->item('theme_url')?>css/newcss/flexslider.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="<?php echo $this->config->item('theme_url')?>js/newjs/modernizr.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('theme_url')?>js/newjs/jquery.min.js"></script>



<?php //Javascript/CSS code from old HTML START ?>

		<!--link href="<?php echo $this->config->item('theme_url')?>css/style.css" type="text/css" rel="stylesheet"/> <?php // Commented by Viraj ?>
		<link href="<?php echo $this->config->item('theme_url')?>css/card.css" type="text/css" rel="stylesheet"/-->

		<!-----------header slider------>
		<!--link href="<?php echo $this->config->item('theme_url')?>css/flexslider.css" type="text/css" rel="stylesheet"/-->  <?php // Commented by Viraj ?>
		<!-----------header slider------->

		<script type="text/javascript" src="<?php echo $this->config->item('theme_url')?>js/jquery-1.9.1.js"></script>

		<!--script type="text/javascript">   <?php // Commented by Viraj ?>
			document.createElement("header");
			document.createElement("nav");
			document.createElement("section");
			document.createElement("aside");
			document.createElement("footer");
		</script-->

		<script type="text/javascript" src="<?php echo $this->config->item('theme_url')?>js/login3.js"></script>

		<script type="text/javascript" src="<?php echo $this->config->item('theme_url')?>js/jquery-ui.js"></script>

		<script type="text/javascript" src="<?php echo $this->config->item('theme_url')?>js/jquery.validate.js"></script>

		<script type="text/javascript" src="<?php echo $this->config->item('theme_url')?>js/login.js"></script>

		 <!--[if lt IE 9]>
			<script type="text/javascript" src="http://info.template-help.com/files/ie6_warning/ie6_script_other.js"></script>
			<script type="text/javascript" src="<?php echo $this->config->item('theme_url')?>js/html5.js"></script>
		<![endif]-->

<?php //Javascript/CSS code from old HTML END ?>


<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-48868640-1', 'cardsleaf.com');

  ga('send', 'pageview');

</script>


</head>

<body>



                	<!--ul>
                        <li><a href="<?php echo site_url('home/page/aboutus')?>">About</a></li>
                        <li><a href="<?php echo site_url('home/page/support')?>">Support</a></li>
                        <li><a href="<?php echo site_url('package')?>">package</a></li>
                        <li><a href="<?php echo site_url('cards/layout')?>">Create</a></li>
					</ul-->	
						


<div class="header">
<div class="container">
<div class="logo"><a href="<?php echo $this->config->item('base_url'); ?>"><img src="<?php echo $this->config->item('theme_url')?>newimages/cardleaf_logo.png"/></a></div><!--logo-->

<div class="header_right">
<div class="login_details">

<?php /** ?>

			<?php if($this->session->userdata('user_id')!="") { ?>
			<?php if($this->uri->segment(3) == 57 || $this->uri->segment(3) == 75) $p=$this->uri->segment(3); else $p='';?>
			<li><a href="<?php echo base_url();?>home/signin/<?php echo $p;?>">LogIn</a></li>
			<?php } else { ?>
			<li><a href="<?php echo base_url();?>home/logout">LogOut</a></li>
			<?php } ?>

<?php **/ ?>

<?php if($this->session->userdata('user_id')=="") { ?>
<form autocompete="off" id="signin_form" name="signin_form" enctype="multipart/form-data" action="<?php echo $this->config->item('base_url') ?>home/login/" method="post" novalidate="novalidate">
	<div class="inset"><input type="text" class="input_style" placeholder="Email" name="username" id="username" /></div>
	<div class="inset"><input class="input_style" placeholder="Password" name="password" id="password" type="password" /></div>
	<div class="inset"><input class="login_btn2" type="submit" value="Login"/></div>

         </form>	
<?php	
	} else
	{ ?>
		<div class="inset" >
				<!-- a href="<?php echo base_url();?>home/logout" -->
					<div id="logout" class="login_btn" style="cursor:pointer">
						Logout
					</div>
				<!-- /a -->
		</div>	
	<?php }
?>	

</div><!--login_details-->				
	
					
				
				

<?php if($this->session->userdata('user_id')=="") { ?>
	<div class="social">
	<div class="create">
	<ul>
	<li><a href="<?php echo $this->config->item('base_url').'home/forgot_pass/'; ?>">Forgot Password?</a>|</li>
	<li><a href="<?php echo $this->config->item('base_url').'home/signup/'; ?>">Create new Account</a></li>
	</ul>
	</div>

	<div class="connect">
	<strong class="or">or</strong>
	connect with &nbsp;
	<a href="javascript:myfunc('fblogin')"><img src="<?php echo $this->config->item('theme_url')?>newimages/fb_connect.jpg" align="absmiddle"/></a>
	</div><!--connect-->
	</div><!--social-->
	
	
<div id="fb-root"></div>
<script type="text/javascript">
  window.fbAsyncInit = function() {
	//alert(document.URL);
	FB.init({
	  appId: '259857357490625',
          cookie: true,
          xfbml: true,
          oauth: true
        });
  };

  (function() {

    var e = document.createElement('script'); e.async = true;
    e.src = document.location.protocol + '//connect.facebook.net/en_US/all.js';
    document.getElementById('fb-root').appendChild(e);
  }());

  function myfunc(type) {
	//var cururl = document.URL;	
	  FB.login(function(response) {

		location.href='<?php echo $this->config->item('base_url'); ?>home/facebook_login/';

		if (response.session) {

			//alert(response.session);

		  if (response.perms) {

			// user is logged in and granted some permissions.

			// perms is a comma separated list of granted permissions

			//alert("test");

		  } else {

			// user is logged in, but did not grant any permissions

			//alert("test1");

		  }

		} else {

		  // user is not logged in

		}

	  }, {scope:'user_location,user_hometown,email,read_stream,publish_stream,user_birthday,offline_access,create_event,rsvp_event,friends_events'});

    }
	
</script>	
	
	
	
	
	
	
	
	
	
<?php } ?>

</div><!--header_right-->
</div><!--container-->
<div class="clear"></div>
</div><!--header--> 
  
  
  
  
  
  
  
  
  

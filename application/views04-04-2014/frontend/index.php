<!--<div class="banner_holder">
    	<div id="main" role="main">
      <section class="slider">
            <div class="flexslider">
              <ul class="slides">
                <li>
                    <img src="<?php echo $this->config->item('theme_url')?>images/banner1.png" />
                    </li>
                    <li>
                    <img src="<?php echo $this->config->item('theme_url')?>images/banner2.png" />
                    </li>
                    <li>
                    <img src="<?php echo $this->config->item('theme_url')?>images/banner3.png" />
                    </li>
              </ul>
            </div>
      </section>
	</div>
    </div>-->
    <div class="banner_holder2">
    	<div class="midwaraper"><div class="caption2">Connect with family and friends by sending beautiful photo cards</div>
	<div class="loginbtn000">
	    <?php if($this->session->userdata('user_id')=="") { ?>
			<?php if($this->session->userdata('layout') == 57 || $this->session->userdata('layout') == 75) $p=$this->session->userdata('layout'); else $p='';?>
			<a href="<?php echo base_url().'home/signin/'.$p;?>">Sign in now</a>
			<?php } else { ?>
			<a href="<?php echo base_url().'home/signin/';?>">Sign in now</a>
			<?php } ?>
	
	</div></div>
    <img src="<?php echo $this->config->item('theme_url')?>images/banner1.png" /></div>
    <div class="clear"></div>
    <div class="gray_boder">
    	<div class="center_text colour01">Wish them today who matters the most on their special occassion</div>
    </div>
     <div class="clear"></div>
    <section class="step3base">
    	<div class="mid_container">
    		<p class="steps_holder">Cardsleaf is the fastest and easiest way to send the perfect card to your family & friends.</p>
            <p class="steps_number">3 Easy Steps</p>
            <div class="allsteps">
            	<ul>
                	<li>
                    	<div class="gol"><a href="#"><img src="<?php echo $this->config->item('theme_url')?>images/rss.png" width="40" style=" margin-top:32px; margin-left:5px;"/></a></div>
                        <h1>Connect</h1>
                        <p style="width: 80%; margin: 0 auto;">Log in with Facebook or by creating your account</p>
                    </li>
                    <li>
                    	<div class="gol"><a href="#"><img src="<?php echo $this->config->item('theme_url')?>images/tik.png" width="47" style=" margin-top:32px; margin-left:5px;"/></a></div>
                        <h1>Select</h1>
                        <p style="width: 80%; margin: 0 auto;">Select a design and personalized just for them</p>
                    </li>
                    <li>
                    	<div class="gol"><a href="#"><img src="<?php echo $this->config->item('theme_url')?>images/mail.png" width="55" style="margin-top:32px; margin-left:5px;"/></a></div>
                        <h1>Send</h1>
                        <p style="width: 80%; margin: 0 auto;">Let us Print and Share your Card! We deliver locally...</p>
                    </li>
                    <div class="clear"></div>
                </ul>
            </div>
        </div>
    </section>
     <div class="clear"></div>
    <div class="gray_boder">
    	<div class="center_text2 colour04">Distance will never a squeeze to wish someone personally </div>
    </div>
    <div class="clear"></div>
    <div class="banner_holder3">
    	<div class="midwaraper"><div class="caption3">Send customized cards full of love and luck straight from the bottom of your heart.. </div></div>
    	<img src="<?php echo $this->config->item('theme_url')?>images/banner2.png" />
    </div>
    <div class="clear"></div>
    <div class="gray_boder">
    	<div class="center_text2 colour03">Imagine never missing any occasion.. </div>
    </div>
    <div class="clear"></div>
    <div class="banner_holder4">
    <div class="midwaraper"><div class="five_sters"><img src="<?php echo $this->config->item('theme_url')?>images/five_sters.png" /></div><div class="caption4">I love this site as it takes away hard work out of sending cards for special occasions. All I had to do was sign up for a free account and personalized my card <div class="clear" style="height: 15px;"></div> <span class="name">Hema Ayyer</span></div></div>
    	<img src="<?php echo $this->config->item('theme_url')?>images/banner3.png" />
    </div>
    <div class="clear"></div>
    <div class="teti_holder">
    	<div class="mid_container">
            	<div class="testimonial">
                	<ul>
                    	<li><span></span>In the age of endless digital messages, it&#39;s nice to have a simple way to send a physical sign of affection.<span class="lastcode"></span>
                        <div class="author">Sohani Arora </div>
                        </li>
                        <li><span></span> I love cards &#45; real cards the postman carries &#45; but I often remember birthdays late and have to send (lame) e-mails or call..No more anymore excuses..<span class="lastcode"></span>
                        <div class="author">Jay Parukh  </div>
                        </li>
                        <li><span></span>  While most birthday wishes come via Facebook nowadays, Cardsleaf conveniently adds a more personal touch with little expense. I love it &#8230;<span class="lastcode"></span>
                        <div class="author">Sohani Arora </div>
                        </li>
                        <div class="clear"></div>
                    </ul>
                </div>
            </div>
    </div>


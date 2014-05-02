<?php

$url_path = explode("/",$_SERVER['REQUEST_URI']);   

//echo $url_path[count($url_path)-3];
$check_var = ($url_path[count($url_path)-1]=="index" && $url_path[count($url_path)-2]=="search") || ($url_path[count($url_path)-2]=="userprofile") ;

$check_msg = ($url_path[count($url_path)-1]=="index" || $url_path[count($url_path)-1]=="send" || $url_path[count($url_path)-1]=="compose" || $url_path[count($url_path)-2]=="message_dispaly") && ($url_path[count($url_path)-2]=="message" || $url_path[count($url_path)-3]=="message");

$check_views = $url_path[count($url_path)-1]=="index" && $url_path[count($url_path)-2]=="views_pro" ;

$check_fav = $url_path[count($url_path)-1]=="index" && $url_path[count($url_path)-2]=="favorite" ;

$check_sub = $url_path[count($url_path)-1]=="index" && $url_path[count($url_path)-2]=="subscribe" ;
$check_on = $url_path[count($url_path)-1]=="online" && $url_path[count($url_path)-2]=="home" ;
$check_connection = ($url_path[count($url_path)-1]=="index" || $url_path[count($url_path)-1]=="friends") && $url_path[count($url_path)-2]=="connection" ;

$check_misc = ($url_path[count($url_path)-1]=="gift_plan" && $url_path[count($url_path)-2]=="search");
$check_misc1 = ($url_path[count($url_path)-1]=="my_gifts" && $url_path[count($url_path)-2]=="search");

// Fetch info of logged in user
$loggeduser = $this->musers->getUserDtls($this->session->userdata('user_id'));
//print_r($userData);

?>
<a href="<?php echo base_url()?>"><h2><img src="<?php echo $this->config->item('theme_url')?>images/se.png" alt="" width="30" height="30" border="0" class="wraps"> <?php echo ucwords($loggeduser['username']);?> <div>  <?php echo ucwords($loggeduser['address']);?></div></h2></a>
<ul>
    <li><a href="<?php echo base_url()?>search/index" <?php if($check_var){?> class="here" <?php } ?>> <img src="<?php echo $this->config->item('theme_url')?>images/search.png" alt="" width="15" height="15" border="0" class="wrap2"> Search</a></li>	
    <li><a href="<?php echo base_url()?>home/online" <?php if($check_on){?> class="here" <?php } ?>" <?php if($url_path[count($url_path)-1]=="location"){?> class="here" <?php } ?>><img src="<?php echo $this->config->item('theme_url')?>images/online.png" alt="" width="15" height="16" border="0" class="wrap2"> Online Now</a></li>		
    <li><a href="<?php echo base_url()?>message/index" <?php if($check_msg){?> class="here" <?php } ?>> <img src="<?php echo $this->config->item('theme_url')?>images/mess.png" alt="" width="15" height="16" border="0" class="wrap2"> Messages</a></li>		
    <li><a href="<?php echo base_url()?>connection/index" <?php if($check_connection){?> class="here" <?php } ?>> <img src="<?php echo $this->config->item('theme_url')?>images/contc.png" alt="" width="15" height="16" border="0" class="wrap2"> Connections</a></li>
    <li><a href="<?php echo base_url()?>views_pro/index" <?php if($check_views){?> class="here" <?php } ?>> <img src="<?php echo $this->config->item('theme_url')?>images/view.png" alt="" width="15" height="16" border="0" class="wrap2"> Views</a></li>
    <li><a href="<?php echo base_url()?>favorite/index" <?php if($check_fav){?> class="here" <?php } ?>> <img src="<?php echo $this->config->item('theme_url')?>images/fevorites.png" alt="" width="15" height="16" border="0" class="wrap2"> Favorite</a></li>	
    <li><a href="<?php echo base_url()?>subscribe/index" <?php if($check_sub){?> class="here" <?php } ?>" <?php //if($url_path[count($url_path)-1]=="gallery"){?> <!--class="here"--> <?php //} ?> <img src="<?php echo $this->config->item('theme_url')?>images/subs.png" alt="" width="15" height="16" border="0" class="wrap2"> Subscribe</a></li>
    <li><a href="<?php echo base_url()?>search/gift_plan" <?php if($check_misc){?> class="here" <?php } ?>> <img src="<?php echo $this->config->item('theme_url')?>images/fevorites.png" alt="" width="15" height="16" border="0" class="wrap2"> Buy Coins</a></li>	
    <li><a href="<?php echo base_url()?>search/my_gifts" <?php if($check_misc1){?> class="here" <?php } ?>> <img src="<?php echo $this->config->item('theme_url')?>images/fevorites.png" alt="" width="15" height="16" border="0" class="wrap2"> Received Gifts</a></li>	

 <li style="width: 256px; float: left; margin: 5px auto;"><img src="<?php echo $this->config->item('theme_url')?>images/banner.jpg" alt="" width="256" height="600" border="0"></li>		
    <!--<li><a href="#">Your Likes</a></li>		
    <li><a href="#">Compatibility</a></li>-->		
</ul>
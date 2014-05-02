<?php

$url_path = explode("/",$_SERVER['REQUEST_URI']);   

//echo $url_path[count($url_path)-1];
?>
<h1>Things To Do</h1>
<ul>
    <li><a href="<?php echo base_url()?>account/edit_pro" <?php if($url_path[count($url_path)-1]=="edit_pro"){?> class="here" <?php } ?>> <img src="<?php echo $this->config->item('theme_url')?>images/basic.png" alt="" width="12" height="16" border="0" class="wrap2"> The Basics</a></li>	
    <li><a href="<?php echo base_url()?>account/location" <?php if($url_path[count($url_path)-1]=="location"){?> class="here" <?php } ?>><img src="<?php echo $this->config->item('theme_url')?>images/location.png" alt="" width="12" height="16" border="0" class="wrap2"> Your Location</a></li>		
    <li><a href="<?php echo base_url()?>account/about" <?php if($url_path[count($url_path)-1]=="about"){?> class="here" <?php } ?>> <img src="<?php echo $this->config->item('theme_url')?>images/about.png" alt="" width="12" height="16" border="0" class="wrap2"> About You</a></li>		
    <li><a href="<?php echo base_url()?>account/gallery" <?php if($url_path[count($url_path)-1]=="gallery"){?> class="here" <?php } ?>> <img src="<?php echo $this->config->item('theme_url')?>images/photo.png" alt="" width="12" height="16" border="0" class="wrap2"> Your Photos</a></li>		
    <!--<li><a href="#">Your Likes</a></li>		
    <li><a href="#">Compatibility</a></li>-->		
</ul>
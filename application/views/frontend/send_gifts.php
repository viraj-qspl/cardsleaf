<title><?php echo $site_title;?></title>
<style>
.search_base {
	margin: 0;
}
</style>
<style>
.framebase {
   width:  auto;
   height:  auto;
   background: #fff;
   border:  3px solid #ccc;
   padding: 0;
   margin: 5px 10px 5px 0;
   display:  block;
   overflow:  hidden;
   float: left;
   border-radius: 5px;
}
/*.framebase img {
   margin:  0 auto;
   display:  block;
   border:  0;
   width:  180px;
   height:  180px;
}*/
.add_photo img.wrap {
	padding: 0;
	margin: 0;
}
.img_framebox {
    background: none repeat scroll 0 0 #FFFFFF;
    border: 1px solid #CCCCCC;
    float: left;
    height: 107px;
    margin: 0 10px 0 0;
    overflow: hidden;
    padding: 4px;
    text-align: center;
    width: 124px;
}
.img_framebox a {
	padding: 0;
	margin: 0;
	text-decoration: none;
	cursor: pointer;
	border: 0;
	behavior:url(js/PIE.htc);
	behavior: url(../js/ie-css3.htc); 
	border-radius: 0;
	-moz-border-radius: 0;
	-webkit-border-radius: 0;
	-ms-border-radius: 0;
 	-o-border-radius: 0;
	-xv-border-radius: 0;
	-khtml-border-radius: 0;
}
.img_framebox a:hover {
	padding: 0;
	margin: 0;
	text-decoration: none;
	cursor: pointer;
	border: 0;
	behavior:url(js/PIE.htc);
	behavior: url(../js/ie-css3.htc); 
	border-radius: 0;
	-moz-border-radius: 0;
	-webkit-border-radius: 0;
	-ms-border-radius: 0;
 	-o-border-radius: 0;
	-xv-border-radius: 0;
	-khtml-border-radius: 0;
}
.add_photo a {
	padding: 0;
	margin: 0;
	text-decoration: none;
	cursor: pointer;
	border: 0;
	behavior:url(js/PIE.htc);
	behavior: url(../js/ie-css3.htc); 
	border-radius: 0;
	-moz-border-radius: 0;
	-webkit-border-radius: 0;
	-ms-border-radius: 0;
 	-o-border-radius: 0;
	-xv-border-radius: 0;
	-khtml-border-radius: 0;
}
</style>
<section id="body">	
<div id="maincontainer">
<div class="members_basebox">
<div class="profile__box">
   <div class="member_headingbox">
      <div class="member_leftpart">&nbsp;</div>
      <div class="member_midpart">Send Gifts</div>
      <div class="member_rightpart">&nbsp;</div>
   </div>
   <div class="clear"></div>
   <div class="profile_left">
      <?php include("left_panel_all_feature.php");?>
   </div> 
   <div class="search2">
   <div class="search">
   <h2>Send Personalized Gifts</h2>
   </div>
        <div class="search_inner">
            <div class="clear"></div>
       <?php
       $str ='<div class="add_photo"><div>';
                foreach ($gift_info as $gift)
                {
                    $str.='<div class="img_framebox">'
                            . '<img border="0" alt="" src="'.  base_url().'uploads/'.$gift['gift_image'].'" />'
                            . '<span>Coins: '.$gift['gift_coins'].'</span>'
                            . '</div>';
                }
                $str.='</div></div>';
                echo $str;
          ?>      
            <?php
            if($type == 1)
            {
                ?>
            
            <form method="post" action="<?php echo site_url('search/save_gifts')?>">
                <input type="hidden" name="gift_ids" value="<?php echo $ids ?>" />
                <input type="hidden" name="to_id" value="<?php echo $to_id?>" />
                <input type="hidden" name="from_id" value="<?php echo $this->session->userdata('user_id')?>" />
                <input type="hidden" name="total_value" value="<?php echo $coin?>" />
                <ul>
                    <li style="width:470px;">Total Coins Needed: <?php echo $coin ?></li><br/>
                    <li style="width:470px;">Type A Personalized Message</li><br/>
                    <li style="width:470px;">
                        <textarea name="message_body" id="message_body" style="width:400px; height: 100px; padding: 6px; color: #999999;" placeholder="Type A Personalized Message"></textarea>
                    </li>
                </ul>
                     <div class="clear"></div>
                     <p style="padding: 0; margin: -6px 0 8px 5px;"><input name="" type="submit" value="Send Gifts" class="search_btn14"></p>
                     
            </form>
            <?php
            }
            else
            {
                echo '<ul>'
                        . '<li style="width:470px;">Total Coins Needed: '. $coin.'</li><br/>'
                    . '</ul>';
                
                echo '<a href="'.base_url().'search/gift_plan">Please Purchase Coins</a>';
            }
            ?>
        </div>
      <div class="clear"></div>
   </div>  
</div>
</div>
</div>					
<div class="clear"></div>
</section>
<div class="clear"></div>
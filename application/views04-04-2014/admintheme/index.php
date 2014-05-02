<div class="admin_cont">
<div class="admin_contl">

     <!--<div class="article_box">
    <p style="margin: 15px 0 0 0;"><img src="<?php echo $this->config->item('admin_theme_url')?>images/icon6.gif" alt="" width="52" height="52" border="0"/></p>
    <p><a href="#">User Manager</a></p>
    </div>
    
  
    <div class="article_box">
    <p style="margin: 15px 0 0 0;"><img src="<?php echo $this->config->item('admin_theme_url')?>images/icon7.gif" alt="" width="52" height="52" border="0"/></p>
    <p><a href="#">Product Manager</a></p>
    </div>
    
    <div class="article_box">
    <p style="margin: 15px 0 0 0;"><img src="<?php echo $this->config->item('admin_theme_url')?>images/icon3.gif" alt="" width="52" height="52" border="0"/></p>
    <p><a href="#">Category Manager</a></p>
    </div>
    
    
    <div class="article_box">
    <p style="margin: 15px 0 0 0;"><img src="<?php echo $this->config->item('admin_theme_url')?>images/icon9.gif" alt="" width="52" height="52" border="0"/></p>
    <p><a href="#">Country Manager</a></p>
    </div>
    
    <div class="article_box">
    <p style="margin: 15px 0 0 0;"><img src="<?php echo $this->config->item('admin_theme_url')?>images/icon9.gif" alt="" width="52" height="52" border="0"/></p>
    <p><a href="#">State Manager</a></p>
    </div>
    
    <div class="article_box">
    <p style="margin: 15px 0 0 0;"><img src="<?php echo $this->config->item('admin_theme_url')?>images/icon9.gif" alt="" width="52" height="52" border="0"/></p>
    <p><a href="#">City Manager</a></p>
    </div>
    
    
    <div class="article_box">
    <p style="margin: 15px 0 0 0;"><img src="<?php echo $this->config->item('admin_theme_url')?>images/icon1.gif" alt="" width="52" height="52" border="0"/></p>
    <p><a href="#">Transaction </a></p>
    </div>-->
    
    
    <div class="article_box">
    <p style="margin: 15px 0 0 0;"><img src="<?php echo $this->config->item('admin_theme_url')?>images/icon12.gif" alt="" width="52" height="52" border="0"/></p>
    <p><a href="<?php echo site_url('admin/home/admin_setting'); ?>">Edit profile</a></p>
    </div>
    
    <div class="article_box">
    <p style="margin: 15px 0 0 0;"><img src="<?php echo $this->config->item('admin_theme_url')?>images/cms_icon.png" alt="" width="52" height="52" border="0"/></p>
    <p><a href="<?php echo site_url('admin/cms/pages/aboutus'); ?>">CMS Pages</a></p>
    </div>
    
    <div class="article_box">
    <p style="margin: 15px 0 0 0;"><img src="<?php echo $this->config->item('admin_theme_url')?>images/cms_icon.png" alt="" width="52" height="52" border="0"/></p>
    <p><a href="<?php echo site_url('admin/member/index'); ?>">Register Member</a></p>
    </div>
    
    <?php if($this->session->userdata('admin_id') == 1) { ?>
    <div class="article_box">
    <p style="margin: 15px 0 0 0;"><img src="<?php echo $this->config->item('admin_theme_url')?>images/cms_icon.png" alt="" width="52" height="52" border="0"/></p>
    <p><a href="<?php echo site_url('admin/home/vendor'); ?>">Create Vendor</a></p>
    </div>
    <?php } ?>

</div>
</div>
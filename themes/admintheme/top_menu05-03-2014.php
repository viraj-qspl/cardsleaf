<div id="admin_nav">
<div id="smoothmenu1" class="ddsmoothmenu">
    <ul>
    
    <li><a href="<?php echo site_url('admin/home/index'); ?>">Dashboard</a>
        <ul style="top: 30px; left: 0px; width: 171px; visibility: visible; display: none; ">
            <li><a href="<?php echo site_url('admin/home/index'); ?>">Home</a></li>
            <li><a href="<?php echo site_url('admin/home/admin_setting'); ?>">Edit Profile</a></li>
	    <li><a href="<?php echo site_url('admin/home/change_pass'); ?>">Change Password</a></li>
            <li><a href="<?php echo site_url('admin/home/logout'); ?>">Logout</a></li>
        </ul>
    </li>
    
    <li style="z-index: 100; "><a href="javascript:void()" style="padding-right: 23px; " class="">CMS Pages</a>
        <ul style="top: 30px; left: 0px; width: 171px; visibility: visible; display: none; ">
            <li><a href="<?php echo site_url('admin/cms/pages/aboutus'); ?>">About Us</a></li>
	    <li><a href="<?php echo site_url('admin/cms/pages/contactus'); ?>">Contact Us</a></li>
	    <li><a href="<?php echo site_url('admin/cms/pages/privacy'); ?>">Privacy</a></li>
	    <li><a href="<?php echo site_url('admin/cms/pages/terms_condition'); ?>">Terms and Condition</a></li>
	</ul>
    </li>
    
    <li style="z-index: 100; "><a href="javascript:void()" style="padding-right: 23px; " class="">Register Member</a>
        <ul style="top: 30px; left: 0px; width: 171px; visibility: visible; display: none; ">
            <li><a href="<?php echo site_url('admin/member/index'); ?>">Register Member List</a></li>
	    <!--<li><a href="<?php echo site_url('admin/cms/pages/contactus'); ?>">Add Member</a></li>-->
	</ul>
    </li>
    
    <?php /*?><li style="z-index: 100; "><a href="javascript:void()" style="padding-right: 23px; " class="">Membership Plan</a>
        <ul style="top: 30px; left: 0px; width: 171px; visibility: visible; display: none; ">
            <li><a href="<?php echo site_url('admin/membershipplan/index'); ?>">List Membership Plan</a></li>
	    <li><a href="<?php echo site_url('admin/membershipplan/addmemshipplan'); ?>">Add Membership Plan</a></li>
	    
	</ul>
    </li>
	    
    <li style="z-index: 100; "><a href="javascript:void()" style="padding-right: 23px; " class="">Gift Settings</a>
        <ul style="top: 30px; left: 0px; width: 171px; visibility: visible; display: none; ">
            <li><a href="<?php echo site_url('admin/gifts/index'); ?>">List Gifts</a></li>
	    <li><a href="<?php echo site_url('admin/gifts/add_gifts'); ?>">Add New Gifts</a></li>
	    <li><a href="<?php echo site_url('admin/gifts/gift_plans'); ?>">Gifts Plan</a></li>
	    <li><a href="<?php echo site_url('admin/gifts/add_gifts_plan'); ?>">Add New Plan</a></li>
	    
	</ul>
    </li>
<?php */?>
    
    </ul>
<br style="clear: left">
</div>




<?php /*?><div class="nav_right">
<ul>
<li><img src="<?php echo $this->config->item('admin_theme_url')?>images/log1.gif" alt="" width="14" height="15" border="0"/><a href="#">Welcome <?php echo $this->session->userdata('admin_name'); ?></a></li>
<!--
<li><img src="<?php echo $this->config->item('admin_theme_url')?>images/log2.gif" alt="" width="14" height="15" border="0"/><a href="#">2 Logged-in backend</a></li>
<li><img src="<?php echo $this->config->item('admin_theme_url')?>images/mess.gif" alt="" width="15" height="15" border="0"/><a href="#">No messages</a></li>
-->
<li><img src="<?php echo $this->config->item('admin_theme_url')?>images/view.gif" alt="" width="15" height="15" border="0"/><a href="#">View Site</a></li>
<li><img src="<?php echo $this->config->item('admin_theme_url')?>images/log_out.gif" alt="" width="15" height="15" border="0"/><a href="<?php echo site_url('admin/home/logout'); ?>">Log out</a></li>
</ul>
</div><?php */?>






</div>
<div class="clear"></div>
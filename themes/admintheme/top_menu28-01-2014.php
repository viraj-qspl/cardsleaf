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
    
    <li style="z-index: 100; "><a href="javascript:void()" style="padding-right: 23px; " class="">Members</a>
        <ul style="top: 30px; left: 0px; width: 171px; visibility: visible; display: none; ">
            <li><a href="<?php echo site_url('admin/member/index'); ?>">Member List</a></li>
	    <li><a href="<?php echo site_url('admin/cms/pages/contactus'); ?>">Add Member</a></li>
	</ul>
    </li>    
    <?php /*?>
    <li style="z-index: 100; "><a href="#" style="padding-right: 23px; " class="">Attributes</a>
        <ul style="top: 30px; left: 0px; width: 171px; visibility: visible; display: none; ">
            <li><a href="#">Color</a>
            	<ul style="top: 0px; left: 171px; width: 171px; visibility: visible; display: none; ">
                	<li><a href="<?php echo site_url('admin/color/index'); ?>">Manage</a></li>
                    <li><a href="<?php echo site_url('admin/color/add'); ?>">Add</a></li>
                </ul>
            </li>                        
            <li><a href="#">Style</a>
            	<ul style="top: 0px; left: 171px; width: 171px; visibility: visible; display: none; ">
                	<li><a href="<?php echo site_url('admin/style/index'); ?>">Manage</a></li>
                    <li><a href="<?php echo site_url('admin/style/add'); ?>">Add</a></li>
                </ul>
            </li>                        
        </ul>
    </li>
    
    <li style="z-index: 100; "><a href="#" style="padding-right: 23px; " class="">Product</a>
		<ul style="top: 30px; left: 0px; width: 171px; visibility: visible; display: none; ">
            <li><a href="#">Category</a>
            	<ul style="top: 0px; left: 171px; width: 171px; visibility: visible; display: none; ">
                	<li><a href="<?php echo site_url('admin/category/index'); ?>">Manage Category</a></li>
            		<li><a href="<?php echo site_url('admin/category/add'); ?>">Add Ccategory</a></li>
                </ul>
            </li>
			
			<li><a href="#">Product</a>
            	<ul style="top: 0px; left: 171px; width: 171px; visibility: visible; display: none; ">
                	<li><a href="<?php echo site_url('admin/product/index'); ?>">Manage Product</a></li>
            		<li><a href="<?php echo site_url('admin/product/add'); ?>">Add Product</a></li>
                </ul>
            </li>
		</ul>
    </li>
            
    <li style="z-index: 100; "><a href="#" style="padding-right: 23px; " class="">Location</a>
        <ul style="top: 30px; left: 0px; width: 171px; visibility: visible; display: none; ">
            <li><a href="#">Country</a>
            	<ul style="top: 0px; left: 171px; width: 171px; visibility: visible; display: none; ">
                	<li><a href="<?php echo site_url('admin/country/index'); ?>">Manage</a></li>
                    <li><a href="<?php echo site_url('admin/country/add'); ?>">Add</a></li>
                </ul>
            </li>
            
            
            <li><a href="#">State</a>
            	<ul style="top: 0px; left: 171px; width: 171px; visibility: visible; display: none; ">
                	<li><a href="<?php echo site_url('admin/state/index'); ?>">Manage</a></li>
                    <li><a href="<?php echo site_url('admin/state/add'); ?>">Add</a></li>
                </ul>
            </li>
            
            
            <li><a href="#">City</a>
            	<ul style="top: 0px; left: 171px; width: 171px; visibility: visible; display: none; ">
                	<li><a href="<?php echo site_url('admin/city/index'); ?>">Manage</a></li>
                    <li><a href="<?php echo site_url('admin/city/add'); ?>">Add</a></li>
                </ul>
            </li>
            
        </ul>
    </li>
    	
    <li style="z-index: 100; "><a href="#" style="padding-right: 23px; " class="">News</a>
        <ul style="top: 30px; left: 0px; width: 171px; visibility: visible; display: none; ">
            <li><a href="<?php echo site_url('admin/news/index'); ?>">Manage News</a></li>
            <li><a href="<?php echo site_url('admin/news/add'); ?>">Add News</a></li>
        </ul>
    </li>
    
    <li style="z-index: 100; "><a href="#" style="padding-right: 23px; " class="">Video</a>
        <ul style="top: 30px; left: 0px; width: 171px; visibility: visible; display: none; ">
            <li><a href="<?php echo site_url('admin/video/index'); ?>">Manage Video</a></li>
            <li><a href="<?php echo site_url('admin/video/add'); ?>">Add Video</a></li>
        </ul>
    </li>
    
    <li style="z-index: 100; "><a href="#" style="padding-right: 23px; " class="">CMS Page</a>
        <ul style="top: 30px; left: 0px; width: 171px; visibility: visible; display: none; ">
            <li><a href="<?php echo site_url('admin/cms/index'); ?>">Manage CMS Page</a></li>
        </ul>
    </li>
    
	<li style="z-index: 100; "><a href="#" style="padding-right: 23px; " class="">Transaction</a>
        <ul style="top: 30px; left: 0px; width: 171px; visibility: visible; display: none; ">
			<li><a href="<?php echo site_url('admin/wantads'); ?>">Manage Want Ads</a></li>
            <li><a href="<?php echo site_url('admin/order'); ?>">Manage Order</a></li>
			<li><a href="<?php echo site_url('admin/order/sellerpayment'); ?>">Manage Seller Payment </a></li>
        </ul>
    </li>
<li style="z-index: 100; "><a href="#" style="padding-right: 23px; " class="">bla Transaction</a>
        <ul style="top: 30px; left: 0px; width: 171px; visibility: visible; display: none; ">
			<li><a href="<?php echo site_url('admin/wantads'); ?>">Manage Want Ads</a></li>
            <li><a href="<?php echo site_url('admin/order'); ?>">Manage Order</a></li>
			<li><a href="<?php echo site_url('admin/order/sellerpayment'); ?>">Manage Seller Payment </a></li>
        </ul>
    </li><?php */?>

    
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
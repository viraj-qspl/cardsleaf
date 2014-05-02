<div id="maincontainer">
<div class="clear"></div>
<div class="mid_bg">
<div class="admin_login">
<div><h1>Administration Login</h1></div>
	
    <?php if($this->session->userdata('success_msg')) { ?>
    <div id="success" class="info_div" style="margin-left:8px;margin-right:8px;margin-bottom:5px;">
        <span class="ico_success"><?php echo $this->session->userdata('success_msg'); ?></span> 
    </div>
	<?php 
    $this->session->unset_userdata('success_msg');
    } 
    ?>
    
    <?php if($this->session->userdata('error_msg')) { ?>
    <div id="fail" class="info_div" style="margin-left:8px;margin-right:8px;margin-bottom:5px;">
        <span class="ico_cancel"><?php echo $this->session->userdata('error_msg'); ?></span>
    </div>
	<?php 
    $this->session->unset_userdata('error_msg');
    } 
    ?>
            
            
    <div class="clear"></div>
    <div class="admin_loginl">
    <div>
        <p>Use a valid username and
        password to gain access to the
        administrator backend.</p>
    </div>
    <div><a href="<?php echo site_url('home/index'); ?>">Go to site home page.</a></div>
    <div><img src="<?php echo $this->config->item('admin_theme_url')?>images/login_icon.png" alt="" width="128" height="128" border="0"/></div>
</div>


        <div class="admin_loginr">
                <form name="loginform" id="loginform" action="" method="post">
                    <table align="center" width="300" border="0" cellspacing="4" cellpadding="4" style="margin: 20px auto;">
                        <tr>
                            <td>User name</td>
                            <td><input type="text" name="username" id="username" class="search_field"/></td>
                        </tr>
                        
                        <tr>
                            <td>Password</td>
                            <td><input type="password" name="password" id="password" class="search_field"/></td>
                        </tr>
                        
                        <tr>
                            <td>&nbsp;</td>
                            <td><input type="submit" name="Submit" value="" class="search_btn" id="save"/></td>
                        </tr>
                    </table>
                </form>
        </div>
</div>
</div>
</div>

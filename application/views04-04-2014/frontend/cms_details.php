<style>
.mid_wrapper {
	min-height: 551px;
}
</style>

<div class="mid_container mid_wrapper">
    <div class="aboutdiv">
        <title><?php echo $site_title;?></title>
		<div class="clear"></div>        
        <div>
            <div class="editdivbox">
                <div class="title"><?php echo $cms['page_name'];?></div>
            <div class="clear"></div>
                <div class="editbox">
            <?php
                echo html_entity_decode($cms['page_content']);
            ?>	
                </div>
            </div>					
            <div class="clear"></div>
        </div>
    </div>
</div>

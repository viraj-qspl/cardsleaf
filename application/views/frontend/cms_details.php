<!-- style>
.mid_wrapper {
	min-height: 551px;
}
</style -->

<?php
	$className = '';
	
?>


<div class="container">
	<div class="content">
	<h2><?php echo $cms['page_name'];?></h2>
	<?php echo html_entity_decode($cms['page_content']);?>
	
	</div>
	<div class="clear"></div>
</div>	

<?php /**
	<div class="login_body">
		<div class="login_holderbox2">
			<div class="login_hrader2"><h1><?php echo $cms['page_name'];?></h1></div>
			<div class="editbox"><?php echo html_entity_decode($cms['page_content']);?></div>
		</div>
	</div>
**/ ?>

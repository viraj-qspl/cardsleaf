<select name="region" id="region">
	<?php foreach($state_country as $state){?>
	<option value="<?php echo $state['state_id']?>"><?php echo $state['name']?></option>
	<?php } ?>
</select>
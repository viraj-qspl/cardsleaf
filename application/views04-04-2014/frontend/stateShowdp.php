<select name="state_id" id="state_id" class="dropdown2" style="background: #fff;padding: 5px 2px 5px 0;">
        <option value="">Choose State</option>
        <?php
        if($state_country){
            foreach($state_country as $eachState){
        ?>
            <option value="<?php echo $eachState['state_id']?>"><?php echo $eachState['name']?></option>
        <?php
            }
        }
        else{
        ?>
        <option value="">No State State</option>    
        <?php
        }
        ?>
</select>
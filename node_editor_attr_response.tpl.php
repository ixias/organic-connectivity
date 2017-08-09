<span class="attributes-by-type">
<?php if(isset($_GET['attributes-by-type'])) $attributes_by_type=snag_sql_query($sql,'response',$_GET['attributes-by-type'],'ref-id',$TYPE_PROTOTYPE_VAR);
else $attributes_by_type=snag_sql_query($sql,'response',$connection['ref-id'],'ref-id',$TYPE_PROTOTYPE_VAR); ?>
<?php if($attributes_by_type): ?>
<select<?php if(isset($x)) echo(' id="attribute_response_'.$x.'" name="attribute_response_'.$x.'"'); ?>>
    <option>---Choose---</option>
<?php foreach($attributes_by_type as $aid=>$response): ?>
    <option value="<?php echo($aid); ?>"<?php if($connection['response']==$aid) echo(' selected="selected"'); ?>><?php echo($response->title); ?></option>
<?php endforeach; ?>
</select>
<?php else: ?>
<input type="text" value="<?php echo($connection['response']); ?>"<?php if(isset($x)) echo(' id="attribute_response_'.$x.'" name="attribute_response_'.$x.'"'); ?>/>
<?php endif; ?>
<?php
if(
    (isset($_GET['attributes-by-type'])&&$_GET['attributes-by-type']==$SUBJECT_PROTOTYPE_VAR)
    ||
    (isset($connection['ref-id'])&&$connection['ref-id']==$SUBJECT_PROTOTYPE_VAR)
    ):?>

<input type="text"<?php if(isset($x)) echo(' id="attribute_response_weight_'.$x.'" name="attribute_response_weight_'.$x.'"'); ?> value="<?php echo($connection['weight']); ?>"/>

<?php endif; ?>
</span>
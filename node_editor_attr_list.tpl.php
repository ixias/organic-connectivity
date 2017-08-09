<fieldset class="draggable attribute">
    <select class="connection_attribute"<?php if(isset($x)) echo(' id="attribute_'.$x.'" name="attribute_'.$x.'"'); ?>>
        <option>---Choose---</option>
<?php foreach($attribs as $nid=>$nd): ?>
        <option value="<?php echo($nid);?>"<?php if($nid==$connection['ref-id']){echo(' selected="selected"');$result_match=$nid;}?>><?php echo($nd->title); ?></option>
<?php endforeach; ?>
    </select>
    <span class="stuff-typed-as-attribute"><?php if($result_match) include('node_editor_attr_response.tpl.php'); ?></span>
</fieldset>

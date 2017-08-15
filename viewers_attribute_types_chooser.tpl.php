
<?php /// This makes sure a list of nodes typed as attribute is loaded ?>
<?php if(function_exists('organic_connectivity_preprocess')): ?>
<?php $glughvars=array(); ?>
<?php organic_connectivity_preprocess($glughvars,'viewer_toolbar_attribute_chooser'); ?>
<?php endif; ?>

<?php global $attribs; ?>
<?php //print_r($attribs); ?>
<div id="attribute-type-filter">
    <label for="connectivity-type-choice"><h3>Attribute Type</h3></label>
    <select id="connectivity-type-choice">

<?php if(!empty($attribs)): ?>
<?php foreach($attribs as $atr): ?>
<option><?php echo($atr->title); ?></option>
<?php endforeach; ?>
<?php endif; ?>

        <!--option selected="selected">Subjects</option>
        <option>Types</option>
        <option>Attributes</option-->

    </select>
</div>
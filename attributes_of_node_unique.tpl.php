<?php global $nd; global $attribs; ?>


<div id="node-attributes">

<?php foreach($nd->connections as $attribute){ ?>


<?php ///// ////// This reduces items down to only free-fill text attributes: ?>

<?php if($attribute['type']==variable_get('organic_connectivity_attribute_prototype','')): ?>



    <div id="attribute-<?php echo($attribute['nid']); ?>" class="node-attribute">

        <h3>
            <a href="/node/<?php echo($attribute['nid']); ?>">
                <span class="title"><?php echo($attribs[$attribute['nid']]->title); ?></span>
            </a>
        </h3>

        <div><?php echo($attribute['response']); ?></div>

    </div>



<?php endif; ?>

<?php } ?>


</div>
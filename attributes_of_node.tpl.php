<?php global $nd; global $attribs; global $subjects; global $types; ?>


<?php if(isset($nd->connections)&&count($nd->connections)): ?>
<table id="node-attributes">

<!--pre--><?php #print_r($nd->connections);?><!--/pre-->
<?php foreach($nd->connections as $attribute){ ?>






    <tr id="attribute-<?php echo($attribute['nid']); ?>" class="node-attribute">

        <td>.
            <a href="/node/<?php echo($attribute['type']); ?>">
                <span class="title"><?php echo($attribs[$attribute['type']]->title); ?></span>
            </a>
        </td>

        <td>(

<?php if($attribute['response']!=''): ?>
<?php echo($attribute['response']); ?>
<?php endif; ?>
<?php //else: ?>
            <a href="/node/<?php echo($attribute['nid']); ?>">
            <?php if(isset($subjects[$attribute['nid']])): ?>
                <span class="title"><?php echo($subjects[$attribute['nid']]->title); ?></span>
            <?php elseif(isset($types[$attribute['nid']])): ?>
                <span class="title"><?php echo($types[$attribute['nid']]->title); ?></span>
            <?php endif; ?>
            </a>

<?php //if it's a subject attribute then there will be a weight ?>
        ,<?php echo($attribute['weight']); ?>
<?php // // // ?>

        )</td>


    </tr>




<?php } ?>


</table>
<?php endif; ?>
<?php global $nd; ?>
<?php global $types; ?>
<?php global $subjects; ?>
<?php if(!empty($nd->contexts_without_context_prototype)){ ?>


<h3 style="display:none;">Subjects</h3>



<ul class="outer-contexts">
<?php foreach($nd->contexts_without_context_prototype as $item_context){ ?>

<li>
    <a href="/<?php echo(drupal_get_path_alias('node/'.$subjects[$item_context['nid']]->nid)); ?>">

<?php if(!empty($subjects[$item_context['nid']]->field_images)): ?>
        <span class="imagery"><img src="<?php echo(image_style_url('thumbnail',$subjects[$item_context['nid']]->field_images[LANGUAGE_NONE][0]['uri'])); ?>" alt=""/></span>
<?php endif; ?>

        <span class="title"><?php echo($subjects[$item_context['nid']]->title); ?></span>

        <span class="weight"><?php echo($item_context['weight']); ?></span>

        <?php if($item_context['response']): ?><span class="note"><?php echo($item_context['response']); ?></span><?php endif; ?>
        <?php if($item_context['notes']): ?><span class="note"><?php echo($item_context['notes']); ?></span><?php endif; ?>




<?php foreach($subjects[$item_context['nid']]->connections as $iccnid=>$item_context_context){ ?>


    <?php ///// shows only subjects that aren't CONTEXT prototype ///// ?>
    <?php if($iccnid!=variable_get('organic_connectivity_context_prototype','')){ ?>

<?php if($item_context_context['response']===0): ?>
<?php if($item_context_context['weight']!=0): ?><span class="sub-contexts">:<?php echo($subjects[$iccnid]->title); ?></span><?php endif; ?>
<?php if($item_context_context['weight']==0): ?><span class="sub-contexts">:<?php echo($types[$iccnid]->title); ?></span><?php endif; ?>
<?php endif; ?>

    <?php } ?>


<?php } ?>





    </a>



<?php

////////////////////////////// Print other children of the connected context...

if($showChildren){
?>
    <div class="outer-context-inner-children-examples">
<?php
    $loopcontrol=0;

    foreach($subjects[$item_context['nid']]->uses as $child){

        if($loopcontrol<$showChildren){

            $child_nd=node_load($child);

            if(!empty($child_nd->field_images)){ ?>

<img src="<?php echo(image_style_url($context_children_image_style,$child_nd->field_images[LANGUAGE_NONE][0]['uri']));?>" alt=""/>

<?php
            }
            $loopcontrol++;

        }

    }
?>
    </div>
<?php
}
?>





</li>

<?php } ?>
</ul>


<?php } ?>
<section id="cloud">



<?php #if($show_displays): ?>
<?php include('viewers_toolbar.tpl.php'); ?>
<?php #endif; ?>





<?php if($break_by_user){ ?>

<?php /////////////////////////////////PRINT CLOUD BROKEN//////////////////////// ?>

<?php  foreach($contexts_user_breaks as $ubid=>$user_breaks){ ?>

<?php $u=user_load($ubid); ?>

<h3><a href="/user/<?php echo($u->uid); ?>"><?php print_r($u->name); ?></a></h3>
    <ul>
<?php foreach($user_breaks as $context) echo($context); ?>
    </ul>
<?php  } ?>
<?php }else{

/////////////////////////////////PRINT CLOUD NORMALLY////////////////////////

?>
<?php global $subjects; ?>
<?php global $types; ?>

<?php if(count($subjects)): ?>


    <ul>

<?php foreach($subjects as $nid=>$context){ ?>


<?php
$uses=count($context->uses);

if($uses<2) $popularityCategory=0;
elseif($uses>=2 && $uses<5) $popularityCategory=1;
elseif($uses>=5 && $uses<15) $popularityCategory=2;
elseif($uses>=15 && $uses<30) $popularityCategory=3;
elseif($uses>=30) $popularityCategory=4;
?>


        <li class="tag-category-<?php echo($popularityCategory); ?>">
            <a href="/<?php echo(drupal_get_path_alias('node/'.$context->nid)); ?>">
                <span class="title"><?php echo($context->title); ?></span>
                <span class="details"><?php echo($uses); ?></span>
                <?php if(isset($types[$context->nid])): ?>
                <span class="type-children-count"><?php echo(count($types[$context->nid]->typeUses)); ?></span>
                <?php endif; ?>
            </a>
        </li>

<?php } ?>
    </ul>

<?php endif; ?>

<?php



} ?>


<?php //                     ./END PRINT CLOUD NORMALLY                            ?>









<?php //                     THE NON-DRUPAL WAY:                            ?>


<?php if(!function_exists('arg')): ?>

<?php global $subjects; ?>
<?php if(count($subjects)): ?>
<ul id="cloud">
<?php foreach($subjects as $nid=>$nd): ?>

<?php $item_uses=snag_sql_query($sql,NULL,NULL,'response',$nid); ?>
<?php
        $uses_class="cloud_uses_few";
        if(count($item_uses)>0) $uses_class="cloud_uses_some";
        if(count($item_uses)>1) $uses_class="cloud_uses_many";
?>
    <li class="<?php echo($uses_class);?>">
        <a href="/<?php echo($nid); ?>" title="<?php echo($nd->description); ?>"><?php echo($nd->title); ?></a>
<?php
        #$full_table[$i]['title']
        #$full_table[$i]['images']
        #$full_table[$i]['connections']
?>
    </li>
<?php endforeach; ?>
</ul>
<?php endif; // end checking if we are in Drupal or not ?>




<?php endif; // end checking for subjects array.... ?>








</section>
<?php if(count($childs)): ?>

<section class="itemlist <?php if(isset($by_type)) echo('prototypical'); elseif(isset($by_context)) echo('contextual'); ?>">

<?php global $item_viewers; ?>
<?php #echo($item_viewers[$viewer]['title']); ?>

<?php if($show_toolbar) echo(theme('items_toolbar',array('item_count'=>$total_item_count,'page'=>$page,'perpage'=>$perpage))); ?>

<?php include('items.php'); ?>
<?php global $item_viewers; ?>
<?php include($item_viewers[$viewer]['template']); ?>

<?php if($show_pagination) echo(theme('pagination',array('item_count'=>$total_item_count,'page'=>$page,'perpage'=>$perpage))); ?>

</section>

<?php endif; ?>
<?php $pages=ceil($item_count/$perpage); ?>
<?php #if($pages>1){ ?>
<section id="items-toolbar" class="toolbar">
    <div><h3>Items</h3><?php echo($item_count); ?></div>
    <div><h3>Per Page</h3><?php echo($perpage); ?></div>
    <!--div><?php echo($pages.' <span>Pages</span>'); ?></div-->
    <div>
        <h3>Page</h3>
        <?php if($page>1): ?><span><a href="?page=<?php echo($page-1); ?>" class="previous">&#8592;</a></span><?php endif; ?>
    <select id="page-choice">
    <?php for($i=1;$i<=$pages;$i++){ ?>
        <option <?php if($page==$i) echo(' selected="selected"'); ?>value="<?php echo($i); ?>"><?php echo($i); ?></option>
    <?php } ?>
    </select>
    <?php if($page<$pages): ?><span><a href="?page=<?php echo($page+1); ?>" class="next">&#8594;</a></span><?php endif; ?>
    </div>
    <div><?php include('items_sorting_options.tpl.php'); ?></div>
    <div><?php include('items_viewer_options.tpl.php'); ?></div>
</section>
<?php #} ?>

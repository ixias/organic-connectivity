<?php include('items_toolbar.tpl.php'); ?>
<?php $full_table=snag_sql_query($sql); ?>

<ul id="grid">

<?php foreach($full_table as $nid=>$node){ ?>

<?php $item_uses=snag_sql_query($sql,'response',$nid); ?>

    <li>
        <a href="/<?php echo($nid); ?>" title="<?php echo($node->description); ?>">
            <?php echo( $nid ); ?>
            <span class="uses">Uses: <?php echo(count($item_uses)); ?></span>
        </a>
<?php #$node->title ?>
<?php #$node->images ?>
<?php #$node->connections ?>

    </li>

<?php } ?>

</ul>

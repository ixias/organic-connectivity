
<section id="viewers-toolbar" class="toolbar">

    <div><h3>Items</h3>$item_count<?php #echo($item_count); ?></div>

    <div>
<?php include('items_sorting_options.tpl.php'); ?>

<!--a href="?sortby=from">Useage [uses]</a>
<a href="?sortby=subject">Alphabetical [title]</a>
<a href="?sortby=received">Random</a-->

    </div>

    <div>
<?php include('viewers_attribute_types_chooser.tpl.php'); ?>
    </div>

    <div>
<?php global $request_tree; ?>
<?php include_once('viewers.php'); ?>
<?php //global $viewers; ?>
    <div class="options-display">
        <label for="display-choice"><h3>Displays</h3></label>
        <select id="display-choice">
            <?php foreach($viewers as $key=>$view): ?>
            <option<?php if($request_tree[2]==$key):?> selected="selected"<?php endif;?> value="/connectivity/contexts/<?php echo($key); ?>"><?php echo($view['title']); ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    </div>

</section>

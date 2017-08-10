<?php global $request_tree; ?>
<?php include_once('items.php'); ?>
<?php global $item_viewers; ?>
    <div class="options-display">
        <label for="display-choice"><h3>Displays</h3></label>
        <select id="display-choice">
            <?php foreach($item_viewers as $key=>$view): ?>
            <option <?php if(isset($request_tree[1])&&$request_tree[1]==$view['arg']) echo('selected="selected" '); ?>value="<?php echo($key); ?>"><?php echo($view['title']); ?></option>
            <?php endforeach; ?>
        </select>
    </div>

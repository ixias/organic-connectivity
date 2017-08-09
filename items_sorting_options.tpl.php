<?php global $sortings; ?>
    <div class="options-sorting">
        <label for="sorting-choice"><h3>Sortings</h3></label>
        <select id="sorting-choice">
        <?php foreach($sortings as $key=>$sort): ?>
                <option <?php if(isset($_GET['sort'])&&$_GET['sort']==$key) echo('selected="selected" '); ?>value="<?php echo($key); ?>"><?php echo($sort['title']); ?></option>
            <?php endforeach; ?>
        </select>
    </div>

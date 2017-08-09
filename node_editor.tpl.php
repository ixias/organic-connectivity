
<form method="POST" action="/?edit=<?php echo($_GET['edit']); ?>" id="node-editor">

    <fieldset><label for="id">ID</label><input type="text" id="id" name="id" value="<?php if($_GET['edit']!='new') echo($_GET['edit']); ?>"/></fieldset>
    <fieldset><label for="title">Title</label><input type="text" id="title" name="title" value="<?php echo($node[$_GET['edit']]->title); ?>"/></fieldset>
    <fieldset><label for="description">Description</label><input type="text" id="description" name="description" value="<?php echo($node[$_GET['edit']]->description); ?>"/></fieldset>



    <!--div id="tree"-->
<?php #printTree($tree,"/",1); ?>
    <!--/div-->


    <div>
        <h3>Attributes</h3>
        <div id="attributes-list">
<?php if(isset($node[$_GET['edit']]->connections)): ?>
<?php $x=0; ?>
<?php foreach($node[$_GET['edit']]->connections as $cid=>$connection): ?>
<?php include('node_editor_attr_list.tpl.php'); ?>
<?php //echo('show weight editor for '.$connection['weight'].'<br/>'); ?>
<?php //echo('show notes editor for '.$connection['notes'].'<br/><br/>'); ?>
<?php $x++; ?>
<?php endforeach; ?>
<?php //$x=NULL; ?>
<?php endif; ?>
        </div>
        <div><a href="/?attributes=" id="add-attribute">Add attribute</a></div>
    </div>

    <!--textarea id="connections" name="connections" rows="6" cols="40"><?php print_r($node[$_GET['edit']]->connections); ?></textarea-->


    <fieldset><label for="body">Body</label><textarea id="body" name="body" rows="10" cols="40"><?php echo($node[$_GET['edit']]->body); ?></textarea></fieldset>

    <div>
        <h3>Images</h3>
        <fieldset><input type="text" id="images" name="images" value="<?php echo($node[$_GET['edit']]->images); ?>"/></fieldset>
        <div><a href="/?add-image=" id="add-image">Add image</a></div>
    </div>


    <input type="hidden" id="edit" name="edit" value="<?php echo($_GET['edit']); ?>"/>

    <div><input type="submit" value="Save"/></div>

</form>

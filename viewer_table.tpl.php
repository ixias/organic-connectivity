<?php include('items_toolbar.tpl.php'); ?>
<?php $full_table=snag_sql_query($sql); ?>
<table>


    <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Description</th>
            <th>Body</th>
            <th>Images</th>
            <th>Connections</th>
            <th>Edit</th>
        </tr>
    </thead>


    <tbody>

<?php foreach($full_table as $nid=>$node){ ?>
<?php if($i%2==0): ?>
<tr class="even">
<?php else: ?>
<tr class="odd">
<?php endif; ?>
      <td class="id"><a href="/<?php echo($nid); ?>"><?php echo($nid); ?></a></td>
      <td><?php echo($node->title); ?></td>
      <td><?php echo($node->description); ?></td>
      <td><?php echo($node->body); ?></td>
      <td><?php echo($node->images); ?></td>
      <td><pre><?php if(isset($node->connections)) //foreach($node->connections as $connection): ?><?php print_r($node->connections); ?><?php //endforeach; ?></pre></td>
      <td class="edit"><a href="?edit=<?php echo($nid);?>">EDIT</a></td>
     </tr>
<?php } ?>

    </tbody>


</table>

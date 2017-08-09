<?php global $contexts; ?>
<?php global $types; ?>
<?php global $attribs; ?>

    <table class="items">
        <thead>
            <tr>
                <th>NID</th>
                <th>Images</th>
                <th>Types</th>
                <th>Title</th>
                <th>Contexts</th>
                <th>Attributes</th>
            </tr>
        </thead>
        <tbody>

<?php $x=0; ?>

<?php foreach($childs as $child){ ?>

<?php if($x%2==0): ?>
            <tr class="even">
<?php else: ?>
            <tr class="odd"><?php endif; ?>
<?php $x++; ?>


                <td><a href="/<?php echo(drupal_get_path_alias('node/'.$child->nid)); ?>"><?php echo($child->nid); ?></a></td>

                <td>
<?php if(!empty($child->field_images)): ?>
<?php foreach($child->field_images[LANGUAGE_NONE] as $key=>$img): ?>
                    <img src="<?php echo(image_style_url('thumbnail',$img['uri'])); ?>" alt=""/>
<?php endforeach; ?>
<?php endif; ?>
                </td>

                <td>
<?php if(!empty($child->connections)): ?>
                    <ul>
<?php foreach($child->connections as $attribute){ ?>
<?php   if($attribute['type']==variable_get('organic_connectivity_prototype_prototype','')){ ?>
                        <li>
                            <a href="/<?php echo(drupal_get_path_alias('node/'.$attribute['nid']));?>">
                                <?php if(isset($contexts[$attribute['nid']]->field_images[LANGUAGE_NONE])){ ?>
                                <img src="<?php echo(image_style_url('small_list_icon',$types[$attribute['nid']]->field_images[LANGUAGE_NONE][0]['uri'])); ?>" alt=""/>
                                <?php } ?>
                                <?php echo($types[ $attribute['nid'] ]->title); ?>
                            </a>
                        </li>
<?php   } ?>
<?php } ?>
                    </ul>
<?php endif; ?>
                </td>

                <td class="title"><a href="/<?php echo(drupal_get_path_alias('node/'.$child->nid)); ?>"><?php echo($child->title); ?></a></td>

                <td>
<?php if(!empty($child->connections)): ?>
                    <ul>
<?php foreach($child->connections as $attribute){ ?>
<?php   if($attribute['type']==variable_get('organic_connectivity_context_prototype','')){ ?>
                    <li>
                        <a href="/<?php echo(drupal_get_path_alias('node/'.$attribute['nid']));?>">
                            <?php if(isset($contexts[$attribute['nid']]->field_images[LANGUAGE_NONE])){ ?>
                            <img src="<?php echo(image_style_url('small_list_icon',$contexts[$attribute['nid']]->field_images[LANGUAGE_NONE][0]['uri'])); ?>" alt=""/>
                            <?php } ?>
                            <?php echo($contexts[$attribute['nid']]->title); ?>
                        </a>
                    </li>
<?php   } ?>
<?php } ?>
                    </ul>
<?php endif; ?>
                </td>

                <td>
<?php if(!empty($child->connections)): ?>
<?php foreach($child->connections as $attribute){ ?>
<?php   if($attribute['type']==variable_get('organic_connectivity_attribute_prototype','')){ ?>
                    <a href="/<?php echo(drupal_get_path_alias('node/'.$attribute['nid']));?>">
                        <?php echo($attribs[ $attribute['nid'] ]->title); ?>
                        <?php echo(':'.$attribute['response']); ?>
                    </a>
<?php   } ?>
<?php } ?>
<?php endif; ?>
                </td>

            </tr>
<?php } ?>

        </tbody>
    </table>

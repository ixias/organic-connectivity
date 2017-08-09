<?php

///// DECIDE ON THE ATTRIBUTES TO SHOW FOR THIS LIST /////

$slots=array();
if(function_exists('node_load')) $node=node_load(arg(1));

if(!empty($node->field_mapped_contexts)){
    foreach($node->field_mapped_contexts[LANGUAGE_NONE] as $context){
        $nd=node_load($context['target_id']);
        $slots[]=array($context['target_id'],$nd->title);
    }
}
else{
    $slots[0][]=36;
    $slots[0][]='Number';
    $slots[1][]=52;
    $slots[1][]='Hebrew';
    $slots[2][]=333;
    $slots[2][]='Gematria';
    $slots[3][]=34;
    $slots[3][]='English';
    $slots[4][]=43;
    $slots[4][]='Descriptives';
    $slots[5][]=66;
    $slots[5][]='Tarot';
}
$slots[]=array(1,'Image');
/*if(!empty($slots)){
    echo('plot to tree in this order:');
    echo('<pre>'.print_r($slots,TRUE).'</pre>');
}*/
#print_r($slots);

?>




<?php

///// MINE LIST /////

$attribute_items=organic_prototype_obtain_entities_by_connection(arg(1),'attributional',TRUE);
#print_r($attribute_items);

?>


<?php if(!empty($attribute_items)): ?>


<?php
#foreach($attribute_items as $iid=>$item){
    #if( !is_object($attribute_items[$iid])  ) echo("NON OBJECT".$iid);
    #echo('--------'.$iid.print_r($item->field_context,TRUE).'-<br/>'."\n");
    //$attribute_items[$iid]->contexts=organic_prototype_extract_connections($item->field_context,NULL,FALSE);
#}
//print_r($attribute_items);
?>





<table id="attributions">
    <thead>
        <tr>
<?php foreach($slots as $slot){ ?>
            <?php if(arg(1)==$slot[0]): ?><th class="active">
            <?php else: ?><th><?php endif; ?>
                <a href="/node/<?php echo($slot[0]); ?>"><?php echo($slot[1]); ?></a>
            </th>
<?php } ?>
        </tr>
    </thead>
    <tbody>











<?php foreach($attribute_items as $iid=>$item): ?>

<?php
$hasSelectedAttribute=0;
if($key=search_for_attribute(variable_get('organic_connectivity_attribute_prototype',''),arg(1),$item->connections)) $hasSelectedAttribute=1;
elseif(arg(1)==36) $hasSelectedAttribute=1;
elseif(arg(1)==52) $hasSelectedAttribute=1;

if($hasSelectedAttribute){

    echo('<tr id="nid-'.$item->nid.'">');

    foreach($slots as $slot){

        if(arg(1)==$slot[0]) echo('<td class="active"><a href="/node/'.$item->nid.'">');
        else echo('<td>');

        if($slot[0]==36) echo($item->nid);
        elseif($slot[0]==52) echo($item->title);
        elseif($slot[0]==1){
            if(!empty($item->field_images))
                echo('<img src="'.image_style_url('thumbnail',$item->field_images[LANGUAGE_NONE][0]['uri']).'" alt=""/>');
        }
        elseif($key=search_for_attribute(variable_get('organic_connectivity_attribute_prototype',''),$slot[0],$item->connections)){
            //if(isset($item->connections[$key]['response']))
                echo($item->connections[$key]['response']);
        }

        if(arg(1)==$slot[0]) echo('</a>');

        echo('</td>');

    }

    echo('</tr>');

}

?>
<?php endforeach; ?>

    </tbody>
</table>



<?php endif; ?>
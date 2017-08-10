<?php
global $types;
#echo('<pre>'.print_r($types,TRUE).'</pre>');
///////////////////////////////////////////////////MOVE THIS CHUNK TO PREPROCESSOR???////////////////////////////
if($type&&!empty($types[$type]->typeChildren)){
    #echo 'group from $type filter, so group is children TYPES of selected TYPE';
    $group=$types[$type]->typeChildren;
}
elseif(!$type){
    #echo '$type filter not set, so group is TYPES master '.$type;
    $group=$types;
}
else{
    #echo 'no group from $type AND $type was set, so return with nothing '.$type;
    return;
}
#echo('<pre>'.print_r($group,TRUE).'</pre>');
?>


<?php if(!empty($group)){ ?>

    <ul>

<?php foreach($group as $tid=>$details){ ?>



<?php if(isset($types[$tid])): ?>

<?php
$classes='';

///////////////////////if(array_key_exists($tid,$types[arg(1)]->typeChildren)) $classes='active';
if( arg(0)=='node'
    &&is_numeric(arg(1))
    &&!empty($types[$tid]->typeChildren)
    &&array_key_exists(arg(1),$types[$tid]->typeChildren)
    &&$types[$tid]->typeChildren[arg(1)][0]==100)
 $classes='active';
elseif($types[$tid]->nid==arg(1)) $classes='active';

?>

<?php
            ##########################################################################################
            ##########################################################################################
            /////////////// use weights to determine the selections............./////////////////////
            ##########################################################################################
            //elseif( $details->nid == $node_contexts[0] ) $return .= '<li class="touch">\n';
            //elseif( in_array( $details->nid, $node_contexts ) ) $return .= '<li class="touch">\n';
            //elseif( in_array( $details->nid, $node_themes ) ) $return .= '<li class="thematique">\n';
            ##########################################################################################
            ##########################################################################################
?>

        <li id="sphere-<?php echo($types[$tid]->nid); ?>" class="<?php echo($classes); ?>">


            <a href="/<?php echo(drupal_get_path_alias('node/'.$types[$tid]->nid)); ?>">


<?php if(!empty($types[$tid]->field_images)): ?>
                <img src="<?php echo(image_style_url($image_style,$types[$tid]->field_images[LANGUAGE_NONE][0]['uri'])); ?>" alt=""/>
<?php endif; ?>


                <?php if($show_nid): ?><span class="numerological"><?php echo($types[$tid]->nid); ?></span><?php endif; ?>


                <?php if(!empty($types[$tid]->field_subtitle)): ?>
                <span class="subtitle"><?php echo($types[$tid]->field_subtitle[LANGUAGE_NONE][0]["value"]); ?></span>
                <?php endif; ?>


                <?php if(!empty($types[$tid]->typeChildren)&&array_key_exists(34,$types[$tid]->typeChildren)): ?>
                <span class="translation"><?php echo($types[$tid]->typeChildren[34][0]); ?></span>
                <?php endif; ?>


<?php if(arg(0)=='node'&&is_numeric(arg(1))&&!empty($types[$tid]->typeChildren)&&array_key_exists(arg(1),$types[$tid]->typeChildren)): ?>
                <span class="selected-attribute"><?php echo($types[$tid]->typeChildren[arg(1)][0]); ?></span>
<?php else: ?>
                <span class="title"><?php echo($types[$tid]->title); ?></span>
<?php endif; ?>


                <span class="uses"><?php //echo($types[$tid]->uses); ?></span>



            </a>


<?php


/* */////////////////////////////// RECURSION /////////////////////////////////* */


if(!empty($types[$tid]->typeChildren)&&!array_search($tid,$types[$tid]->typeChildren)){

    //echo("RECURSION".'<pre>'.print_r($types[$tid]->typeChildren).'</pre>');

    echo(theme('prototypes',array(
        'type'=>$tid,
        'image_style'=>$image_style,
        'mine_children'=>$mine_children,
        'show_random_child'=>$show_random_child,
        'parent'=>$tid,
        'show_nid'=>$show_nid,
    )));
}

?>

        </li>


<?php else: ?>
<?php echo('<li>'.$tid.'~');


/* */////////////////////////////// RECURSION /////////////////////////////////* */


if(!empty($types[$tid]->typeChildren)&&$tid!=$parent&&!array_search(2,$types[$tid]->typeChildren))

    echo(theme('prototypes',array(
        'type'=>$tid,
        'image_style'=>$image_style,
        'mine_children'=>$mine_children,
        'show_random_child'=>$show_random_child,
        'parent'=>$tid,
        'show_nid'=>$show_nid,
    )));


echo('OTHER RECURSION</li>'); ?>
<?php endif; ?>


<?php } ?>
    </ul>



<?php } ?>
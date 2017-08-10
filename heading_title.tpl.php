<?php global $subjects; global $types; global $nd; global $request_tree; ?>
<?php #print_r($request_tree); ?>
<?php #print_r($nd); ?>
<?php
//global $ATTRIBUTE_PROTOTYPE_VAR;
global $TYPE_PROTOTYPE_VAR;
global $SUBJECT_PROTOTYPE_VAR;
?>
<h2>





<?php if(!empty($nd)&&!empty($nd->connections)): ?>
<?php
$item_types_out='';
foreach($nd->connections as $item_context){
    if($item_context['type']==$TYPE_PROTOTYPE_VAR){

        $noshow=0;
        /// Removes TYPE:TYPE
        if(!$show_prototype_prototype&&$item_context['nid']==$TYPE_PROTOTYPE_VAR) $noshow=1;
        /// Removes TYPE:CONTEXT
        if(!$show_context_prototype&&$item_context['nid']==$SUBJECT_PROTOTYPE_VAR) $noshow=1;

        if(!$noshow){

            $item_types_out.='<li id="nodes-types-'.$item_context['nid'].'">';

            if(function_exists('drupal_get_path_alias'))
                $path=drupal_get_path_alias('node/'.$item_context['nid']);
                    else $path=$item_context['nid'];

            $item_types_out.='<a href="/'.$path.'">';

            if(!empty($types[$item_context['nid']]->field_images[LANGUAGE_NONE])){
                $item_types_out.='<span class="imagery">';
                $item_types_out.='<img src="'.image_style_url('thumbnail',$types[$item_context['nid']]->field_images[LANGUAGE_NONE][0]['uri']).'" alt=""/>';
                $item_types_out.='</span>';
            }

            $item_types_out.='<span class="title">'.$types[$item_context['nid']]->title.'</span>';
            #if(!empty($item_context['content']->field_subtitle))
                #$item_types_out.=$item_context['content']->field_subtitle[LANGUAGE_NONE][0]['value'];
            #$item_types_out.='<span class="weight">'.$item_context['weight'].'</span>';

            $item_types_out.='</a>';
            $item_types_out.='</li>';
        }

    }
}
?>
<?php if($item_types_out!=''){ ?>
<ul id="nodes-types">
<?php echo($item_types_out); ?>
</ul>
<?php } ?>
<?php endif; ?>




<?php if(!empty($nd)&&!empty($nd->connections)){ ?>
    <span class="contexts">
<?php #echo('<pre>');print_r($nd->connections);echo('</pre>'); ?>
<?php foreach($nd->connections as $subject): ?>
<?php if($subject['type']==$SUBJECT_PROTOTYPE_VAR){ ?>
<?php #if($subject['weight']>=50){ ?>

<?php $noshow=0; ?>
<?php //Removes CONTEXT:CONTEXT ?>
<?php if(!$show_context_prototype&&$subject['nid']==$SUBJECT_PROTOTYPE_VAR) $noshow=1; ?>
<?php if(!$noshow): ?>
        <a href="/<?php echo(drupal_get_path_alias('node/'.$subjects[$subject['nid']]->nid)); ?>">

            <?php if(!empty($subjects[$subject['nid']]->field_images[LANGUAGE_NONE])): ?>
            <span class="imagery"><img src="<?php echo(image_style_url('thumbnail',$subjects[$subject['nid']]->field_images[LANGUAGE_NONE][0]['uri'])); ?>" alt=""/></span>
            <?php endif; ?>

            <span class="title"><?php echo($subjects[$subject['nid']]->title); ?></span>

            <?php #echo('('.$subject['weight'].')'); ?>

        </a>
<?php endif; ?>

<?php #} ?>
<?php } ?>
<?php endforeach; ?>
    </span>
<?php } ?>












<?php if($request_tree[0]=='node'&&isset($nd)): ?>
<a href="/<?php echo(drupal_get_path_alias('node/'.$nd->nid)); ?>" title="<?php echo($nd->title); ?>">
<?php else: ?>
<a href="<?php echo($_SERVER['REQUEST_URI']); ?>">
<?php endif; ?>

<?php


////////////////// THIS SHOWS THE CONTEXT ICONOGRAPHY IF IT IS A CONTEXT ////////////


if(isset($nd->nid)&&isset($subjects[$nd->nid])&&!empty($nd->field_images)){
    echo('<span class="imagery">');
    //echo('<a href="/sites/'.$_SERVER['HTTP_HOST'].'/files/'.$nd->field_images[LANGUAGE_NONE][0]['filename'].'" class="get_bigger">');
    echo('<img src="'.image_style_url('thumbnail',$nd->field_images[LANGUAGE_NONE][0]['uri']).'" alt=""/>');
    //echo('</a>');
    echo('</span>');
}

?>


<?php if($show_nid): ?>
<span class="numerological"><?php
if(isset($request_tree[1])&&is_numeric($request_tree[1])) echo($request_tree[1]);
elseif($request_tree[2]&&is_numeric($request_tree[2])) echo($request_tree[2]);
?></span>
<?php endif; ?>

<span class="title"><?php
if(isset($nd)) echo($nd->title);
elseif($title=drupal_get_title()) echo($title);
?>

<?php if(!empty($nd->field_subtitle)){
?><span class="subtitle"><?php echo($nd->field_subtitle[LANGUAGE_NONE][0]['value']);?></span><?php
}?>

</span>


    </a>

</h2>




          <?php #if ($title): ?>
              <!--h2--><?php
/*$requests = explode("/",$_SERVER["REQUEST_URI"]);
array_shift($requests);
$path="";
for($i=0; $i<count($requests)-1; $i++){
	$path .= "/".$requests[$i];
	echo( "<a href=\"".$path."\">".$requests[$i] . "</a> &#8250;\n " );
}
print "<a href=\"".$path."/".$requests[count($requests)-1]."\">".$title."</a>";*/
?><!--/h2-->
          <?php #endif; ?>

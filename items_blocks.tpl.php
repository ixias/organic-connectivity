<?
if($show_heading){

    if(isset($by_type))
        echo('<h3>Prototypical Children <span>'.count($childs).'</span></h3>');

    elseif(isset($by_context))
        echo('<h3>Contextual Children <span>'.count($childs).'</span></h3>');

    elseif(isset($by_attribute))
        echo('<h3>Atrributable Children <span>'.count($childs).'</span></h3>');

}
?>



<?php #echo('<pre>'.print_r($childs).'</pre>'); ?>

<?php #foreach($childs as $child) echo($child->nid.') '.$child->title.'<br/>'); ?>



<?php if($break_by_contexts){ ?>
<ul class="context-breaks">
<?php     foreach($items_context_breaks as $cbid=>$context_break){ ?>
<?php         if($cbid!=arg(1)){ //filter out lists of the currently selected node ?>
<li>
<?php             if($cbid==0) echo('<h3>Uncategorized</h3>');
                  else{$nd=node_load($cbid);echo('<h3><a href="/node/'.$nd->nid.'">'.$nd->title.'</a></h3>');} ?>
<?php             //echo('<pre>'.print_r($context_break,TRUE).'</pre>'); ?>
    <ul class="items">
<?php             foreach($context_break as $item){

    foreach($childs as $itemm){
        if($itemm->nid==$item)
            dumpdaitemmang($itemm,$image_size,$show_children,$show_random_child,$by_context,$show_multi_image,$by_type,$show_date,$show_outer_contexts);
    }

} ?>
    </ul>
</li>
<?php         } ?>
<?php     } ?>
</ul>




<?php }else{ ?>

    <ul class="items" id="blocks">

<?php foreach($childs as $item){ ?>
<?php     dumpdaitemmang($item,$image_size,$show_children,$show_random_child,$by_context,$show_multi_image,$by_type,$show_date,$show_outer_contexts); ?>
<?php } ?>

    </ul>


<?php } ?>
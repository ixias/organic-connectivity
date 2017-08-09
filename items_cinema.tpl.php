<?php global $types; ?>
<?php global $subjects; ?>
<?php

###########################################PREPROCESS###################################

// Mine items from database

/*if(isset($by_context))
    $items=organic_context_obtain_entities_by_context($by_context);
else $items=organic_context_obtain_entities_by_type();*/



// Clean items

/*if(count($items)){
    foreach($items as $key=>$item){
        // Remove items exposed as context
        if(!empty($item->field_expose_as_context)&&$item->field_expose_as_context[LANGUAGE_NONE][0]['value']=='1')
            unset($items[$key]);
    }
    // Order by creation date
    usort($items, function($a, $b){ return $b->created - $a->created; });
}*/



// Calculate items

#if (isset($_GET["perpage"])) $perpage = $_GET["perpage"];
//else $perpage = 11;

#$pages = ceil(count($items) / $perpage);

#if( isset($_GET["page"]) && round($_GET["page"]) <= $pages && round($_GET["page"]) > 0 )
#	$page = round($_GET["page"]);
#else $page = 1;

#$startItem=(($page-1)*$perpage);
#$endItem=$startItem+($perpage-1);
#if($endItem>$items) $endItem=$endItem-($endItem%$items);

###########################################PREPROCESS###################################

?>


    <ul class="items" id="creations_rotator">

<?php foreach($childs as $iid=>$item){ ?>


<?php if(isset($item)): ?>








<?php if($iid==0): ?><li class="selected">
<?php else: ?><li><?php endif; ?>


<div class="rotator_tab"><a href="/node/<?php echo($item->nid); ?>">


<?php if(!empty($item->field_images)): ?>
<img src="<?php echo(image_style_url($cinema_size_thumb,$item->field_images[LANGUAGE_NONE][0]['uri'])); ?>" alt=""/>
<?php endif; ?>

<span class="title"><?php echo($item->title); ?></span>

<?php if(!empty($item->field_subtitle)): ?>
<span class="subtitle"><?php echo($item->field_subtitle[LANGUAGE_NONE][0]['value']); ?></span>
<?php endif; ?>
</a></div>


<div class="rotator_full">

    <a href="/node/<?php echo($item->nid); ?>">

<?php if(!empty($item->field_images)): ?>
<span class="images">
    <img src="<?php echo(image_style_url($cinema_size,$item->field_images[LANGUAGE_NONE][0]["uri"])); ?>" alt=""/>
</span>
<?php elseif(!empty($item->body[LANGUAGE_NONE])): ?>
<?php
$test = strip_tags($item->body[LANGUAGE_NONE][0]["value"]);
$test = substr($test,0,1128);
?>
<span class="body"><?php echo($test); ?>...</span>
<?php endif; ?>


<!--h3--><span class="title">


<?php if(!empty($item->field_context)){ ?>

<?php $item->field_context=organic_connectivity_extract_connections($item->field_context,NULL,TRUE); ?>

<?php foreach($item->field_context as $item_type){ ?>
<?php if(!$item_type['weight']&&!$item_type['response']){ ?>
<span><?php echo($types[$item_type['nid']]->title); ?></span>:
<?php } ?>
<?php } ?>

<?php } ?>


<?php echo($item->title); ?>

</span><!--/h3-->


<?php if(!empty($item->field_subtitle)): ?>
<span class="subtitle"><?php echo($item->field_subtitle[LANGUAGE_NONE][0]['value']); ?></span>
<?php endif; ?>


<?php if(!empty($item->field_images) && count($item->field_images[LANGUAGE_NONE])>1){ ?>
<span class="sub_imagery">
<?php for($y=1; $y<count($item->field_images[LANGUAGE_NONE]); $y++){ ?>
<?php if($y<6): ?>
<img src="<?php echo(image_style_url('medium',$item->field_images[LANGUAGE_NONE][$y]['uri'])); ?>" alt=""/>
<?php endif; ?>
<?php } ?>
</span>
<?php } ?>

</a>





<?php if(!empty($item->field_context)){ ?>





<?php foreach($item->field_context as $item_context){ ?>



<?php if($item_context['weight']>=50&&$item_context['response']==0): ?>

<a href="/node/<?php echo($item_context['nid']); ?>" class="further_details">
<span class="connekt_title"><?php echo($subjects[$item_context['nid']]->title); ?></span>

<?php if(!empty($subjects[$item_context['nid']]->field_images)): ?>
<img src="<?php echo(image_style_url('thumbnail',$subjects[$item_context['nid']]->field_images[LANGUAGE_NONE][0]["uri"])); ?>" alt=""/>
<?php endif; ?>

</a>

<?php //break; //////only show the first occuring context ?>

<?php endif; ?>



<?php } ?>


<?php } ?>





<?php if(!empty($item->field_installation_url)): ?>
<a href="<?php echo($item->field_installation_url[LANGUAGE_NONE][0]['value']); ?>" class="morelink view_site">View this Site</a>
<?php endif; ?>


    </div><!-- /end .rotator_full -->
</li>
<?php endif; ?>
<?php } ?>

    </ul>


<!--p>
usually the <a href="/art/concepts" rel="external">concepts</a> for my art are an attempt to transcode <a href="/mind">visions and ideas about the universe</a> for the purposes of sharing with the community in order to awaken spirit
</p>
<p>
to design is to craft creative solutions to problems. through the use of graphics and code i create time-less media products and experiences for myself and my <a href="/clients">clients</a>
</p-->

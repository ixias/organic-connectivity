    <ul class="items">
<?php foreach($childs as $iid=>$item){ ?>
        <li>
<?php $n0de=node_view(node_load($item->nid)); ?>
<?php echo(drupal_render($n0de)); ?>

<?php
////////////////////////////////////////////////////
////////////////////////////////////////////////////
#        $parent_deetz = node_load( $item->field_connection[0]["nid"] );
#        $return .= "<a href=\"".$parent_deetz->path."\" class=\"further_details\">\n";
#        $return .= "<span class=\"connekt_title\"><span class=\"connekt_title_label\">From:</span> " . $parent_deetz->title . "</span>\n";
#        $img_path = explode( "/", $parent_deetz->field_images[0]["filepath"] );
#        $return .= "<img src=\"/sites/default/files/imagecache/art_concept_icon/".$img_path[count($img_path)-2]."/".$img_path[count($img_path)-1]."\" alt=\"".$parent_deetz->field_images[0]["data"]["alt"]."\"/>\n";
#        $return .= "</a>\n"; //end "further_details"
////////////////////////////////////////////////////
////////////////////////////////////////////////////
?>
        </li>
<?php } ?>
    </ul>

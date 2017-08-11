<?php

//// parents:
//// SHOW CONTEXTS ASSOCIATED WITH CURRENT THING

//// shortcode: [contextparents]


function contextparents_func( $atts ){

    wp_reset_query();
    global $post;
    if(get_post_meta($post->ID,'thing_connections',true)){
        $return='<div><strong>Connections</strong>: ';
        $associations=get_post_meta($post->ID,'thing_connections',true);
        foreach($associations as $aid=>$association)
            $return.='<a href="'.get_the_permalink($aid).'">'.get_the_title($aid).'</a> ';
        $return.='</div>';
    }

    return $return;

}


add_shortcode('contextparents','contextparents_func');


//// END ASSOCIATED CONTEXTS

?>
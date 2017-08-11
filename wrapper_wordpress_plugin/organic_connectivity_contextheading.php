<?php

//// heading:
//// SHOW CONTEXTS ASSOCIATED WITH CURRENT THING

//// shortcode: [contextheading]


function contextheading_func( $atts ){

    wp_reset_query();
    global $post;
    //$post->ID

    if(!is_page()){
        $return.='<h2>';

        if(is_category()){
            $cat=get_term_by('name',single_cat_title('',false),'category');
            $return.='<span>category &raquo;</span><a href="/category/'.$cat->slug.'">'.$cat->name.'</a>';
        }

        elseif(is_tag()){
            $tag=get_term_by('name',single_cat_title('',false),'post_tag');
            $return.='<span>tag &raquo;</span><a href="/tag/'.$tag->slug.'">'.$tag->name.'</a>';
        }

        elseif(is_date()){
            $return.='<span>date &raquo;</span>';
            $return.='<a href="/';
            $return.=get_the_time('Y');
            $return.='">';
            $return.=get_the_time('Y');
            $return.='</a>';
            $return.=' &raquo;';
            $return.='<a href="/';
            $return.=get_the_time('Y');
            $return.='/';
            $return.=get_the_time('m');
            $return.='">';
            $return.=get_the_time('m');
            $return.='</a>';
        }

        elseif(is_search()){
            $return.='<span>search &raquo;</span>'.get_search_query();
        }

        else{
            //if(get_post_type()=='thing') $return.='<span>thing &raquo;</span>';
            $return.='<a href="'.get_the_permalink().'">';
            $return.=get_the_title();
            if(is_singular('thing')&&has_post_thumbnail())
                $return.=get_the_post_thumbnail($post->ID,array(100, 100));
            //$return.=wp_title('');
            $return.='</a>';
        }

        $return.='</h2>';

    }


    return $return;

}


add_shortcode('contextheading','contextheading_func');


//// END ASSOCIATED CONTEXTS

?>
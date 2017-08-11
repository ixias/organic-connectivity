<?php

//// children:
//// SHOW THINGS ASSOCIATED WITH CURRENT THING

//// shortcode: [itemlist]


function itemlist_func( $atts ){

    $uri_elems=explode('/',$_SERVER['REQUEST_URI']);
    if(is_numeric($uri_elems[count($uri_elems)-2])) $page=$uri_elems[count($uri_elems)-2]-1;
    else $page=0;

    $range=0;
    $args=array(
        'post_type'=>'thing',
        'orderby'=>'date',
        'order'=>'DESC',
        'posts_per_page'=>$range,
        'page'=>$page,
        'offset'=>($page*$range),
    );

    wp_reset_query();
    global $post;
    $uhmyeeeahhhhh=$post->ID;
    if(is_singular('thing')){
        $args['posts_per_page']=-1;
        $args['meta_query']=array(
            //'relation'=>'AND',
            array(
                'key'=>'thing_connections',
                //'value'=>serialize($uhmyeeeahhhhh),
                'value'=>sprintf(':"%s";',$uhmyeeeahhhhh),
                'compare'=>'LIKE',
            ),
        );
    }

///////////////////////////$meta = get_post_meta( $post->ID, 'key', true );

    $loop=new WP_Query($args);

    if($loop->have_posts()){

        $return='<div><!--h2>Children / Connected Nodes</h2--><ul class="itemlist">';

        while($loop->have_posts()):$loop->the_post();

#$custom=get_post_custom(get_the_ID());
#$thing_connections=$custom['thing_connections'][0];
#$thing_connections=unserialize($thing_connections);
//$return.=get_the_ID().'----'.$uhmyeeeahhhhh.'<pre>';
//$return.=print_r($thing_connections,TRUE).'</pre>';

        #if(is_array($thing_connections)&&array_key_exists($uhmyeeeahhhhh,$thing_connections)):



            $return.='<li>';


            //////////////////////// MINE CONNECTED CHILDREN /////////////////////
            $args_inner=array(
                'post_type'=>'thing',
                'posts_per_page'=>-1,
                'orderby'=>'date',
                'order'=>'DESC',
                'meta_query'=>array(
                    array(
                        'key'=>'thing_connections',
                        'value'=>get_the_ID(),
                        'compare'=>'LIKE',
                    ),
                ),
            );
            $loop_inner=new WP_Query($args_inner);
            ///////////////////////////////////////////////////////////////////////


            $return.='<h3>';
            $return.='<a href="'.get_the_permalink().'">'.get_the_title();
            if($loop_inner->found_posts)
                $return.='<span class="children-count">'.$loop_inner->found_posts.'</span>';
            $return.='</a>';
            $return.='</h3>';

            $return.='<span style="">';
            $return.='<a href="'.get_the_permalink().'">';
            $return.=get_the_post_thumbnail(get_the_ID(),'thumbnail');
            $return.='</a>';
            $return.='</span>';

            $return.='</li>';

            #endif;

        endwhile;
        $return.='</ul></div>';




        $pages=$loop->max_num_pages;

        if(!$pages) $pages=1;


        if(1!=$pages){

            $return.='<div class="pagination">Page: ';
            //$return.="<span>Page ".($page+1)." of ".$pages."</span>";

            for($i=1;$i<=$pages;$i++){
                //$return.="<span class=\"current\">".$i."</span>";
                if($i!=1) $return.=', ';
                $return.="<a href='/gallery/".$i."'";
                if($i-1==$page) $return.=" class='selected'";
                $return.=">".$i."</a>";
            }

            $return.="</div>\n";

        }



        return $return;

    }


}


add_shortcode('itemlist','itemlist_func');


//// END ASSOCIATED THINGS

?>
<?php


// [contexttree]

function contexttree_func( $atts ){

/*
    $uri_elems=explode('/',$_SERVER['REQUEST_URI']);
    if(is_numeric($uri_elems[count($uri_elems)-2])) $page=$uri_elems[count($uri_elems)-2]-1;
    else $page=0;

    $range=12;

    $args=array(
        'post_type'=>'thing',
        'orderby'=>'date',
        'order'=>'DESC',
        'posts_per_page'=>$range,
        'page'=>$page,
        'offset'=>($page*$range),
    );

    $loop=new WP_Query($args);


    while($loop->have_posts()):$loop->the_post();

        $return.='<li>';


        ////////////////////////////////// MINE CONNECTED CHILDREN ///////////////////////////////
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
        ///////////////////////////////////////////////////////////////////////////////////////////


        $return.='<h3>';
        $return.='<a href="'.get_the_permalink().'">'.get_the_title();
        $return.='<span class="children-count">'.$loop_inner->found_posts.'</span>';
        $return.='</a>';
        $return.='</h3>';

        $return.='<span style="">';
        $return.='<a href="'.get_the_permalink().'">';
        the_post_thumbnail('thumbnail');
        $return.='</a>';
        $return.='</span>';

        $return.='</li>';

    endwhile;
    $return.='</ul>';


*/


    //get all contexts
    $args_inner=array(
        'post_type'=>'thing',
        'posts_per_page'=>-1,
        'orderby'=>'date',
        'order'=>'DESC',
        'meta_query'=>array(
          'relation'=>'AND',
            array(
                'key'=>'thing_connections',
                'value'=>17,
                'compare'=>'LIKE',
            ),
        ),
    );


    $loop_inner=new WP_Query($args_inner);
    if($loop_inner->have_posts()){
        $return='<h4>Contexts</h4>';
        $return.='<ul id="main-nav">';
        while($loop_inner->have_posts()):$loop_inner->the_post();
            $return.='<li><a href="'.get_the_permalink().'">';
            $return.='<span class="title">'.get_the_title().'</span>';
            $return.=get_the_post_thumbnail(get_the_ID(),'thumbnail');
            $return.='</a>';
            $return.='</li>';
        endwhile;
        $return.='</ul>';
    }


    return $return;


}


add_shortcode('contexttree','contexttree_func');



?>
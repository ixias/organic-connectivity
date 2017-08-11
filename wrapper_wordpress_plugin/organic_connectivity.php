<?php
/**
 * Plugin Name: organicConnectivity
 * Plugin URI: http://connectivity.orgnsm.org
 * Description: Describes content node connectivity
 * Version: 0.0.5
 * Author: IXIAS OOVVUU NEBULAE
 * Author URI: http://ixias.orgnsm.org
 * Text Domain: 
 * Domain Path: 
 * Network: false
 * License: GPL2
 */

/*  Copyright 2015  IXIAS OOVVUU NEBULAE  (email : ixias@orgnsm.org)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

//////// defines THING custom post type ////////


function create_post_type(){

  register_post_type('thing',
    array(
      'labels'=>array(
          'name'=>__('Things'),
          'singular_name'=>__('Thing'),
      ),
      'taxonomies'=>array('category'),
      'public'=>true,
      'has_archive'=>true,
      'supports'=>array(
          'title',
          'editor',
          'comments',
          'excerpt',
          'custom-fields',
          'thumbnail',
      ),
      'capabilities'=>array(
          'edit_post'=>'edit_thing',
          'edit_posts'=>'edit_things',
          'delete_post'=>'delete_thing',
          'delete_posts'=>'delete_things',
          'delete_others_posts'=>'delete_others_things',
          'publish_posts'=>'publish_thing',
          'read_post'=>'read_thing',
      ),
    )
  );

}

add_action('init','create_post_type');




function add_theme_caps(){

    //$subscribers = get_role('subscriber');

    //$subscribers->add_cap('edit_thing');
    //$subscribers->add_cap('edit_things');
    //$subscribers->add_cap('publish_thing');

    //$subscribers->add_cap('read_thing');

    $admins = get_role('administrator');

    $admins->add_cap('edit_thing');
    $admins->add_cap('edit_things');
    $admins->add_cap('delete_thing');
    $admins->add_cap('delete_things');
    $admins->add_cap('delete_others_things');
    $admins->add_cap('publish_thing');
    $admins->add_cap('read_thing');

}

add_action('init','add_theme_caps');








//////// defines custom fields for THING custom post type ////////

function add_thing_metas(){
    add_meta_box('thing_connections-meta','Connections','thing_connections','thing','normal','low');
    //add_meta_box('thing_date-meta','Date','thing_date','thing','normal','low');
    //add_meta_box('thing_start_time-meta','Start Time','thing_start_time','thing','normal','low');
    //add_meta_box('thing_end_time-meta','End Time','thing_end_time','thing','normal','low');
    //add_meta_box('thing_location-meta','Location','thing_location','thing','normal','low');
    global $post;
    global $post_ID;
    $post_ID=$post->ID;
}

function thing_date(){
    global $post_ID;
    $custom=get_post_custom($post_ID);
    $thing_date=$custom['thing_date'][0];
    $thing_date_break=explode('/',$thing_date);
    //echo('<label for="thing_date">Date (MM/DD/YYYY)</label>');
    //echo('<input value="'.$thing_date.'" type="hidden" name="thing_date" id="thing_date"/>');
    echo('<select id="thing_date_m" name="thing_date_m">');
    echo('<option value="">--</option>');
    for($m=1;$m<=12;$m++){
        echo('<option value="'.$m.'"');
        if($thing_date_break[0]==$m) echo(' selected="selected"');
        echo('>'.$m.'</option>'."\n");
    }
    echo('</select>');
    //echo('<input value="'.substr($thing_date,0,2).'" type="text" name="thing_date_m" id="thing_date_m"/>');
    echo('<select id="thing_date_d" name="thing_date_d">');
    echo('<option value="">--</option>');
    for($d=1;$d<=31;$d++){
        echo('<option value="'.$d.'"');
        if($thing_date_break[1]==$d) echo(' selected="selected"');
        echo('>'.$d.'</option>'."\n");
    }
    echo('</select>');
    //echo('<input value="'.substr($thing_date,3,2).'" type="text" name="thing_date_d" id="thing_date_d"/>');
    echo('<select id="thing_date_y" name="thing_date_y">');
    echo('<option value="">----</option>');
    for($y=date('Y');$y<=date('Y')+4;$y++){
        echo('<option value="'.$y.'"');
        if($thing_date_break[2]==$y) echo(' selected="selected"');
        echo('>'.$y.'</option>'."\n");
    }
    echo('</select>');
    //echo('<input value="'.substr($thing_date,6,4).'" type="text" name="thing_date_y" id="thing_date_y"/>');
}
function thing_start_time(){
    global $post_ID;
    $custom=get_post_custom($post_ID);
    $thing_start_time=$custom['thing_start_time'][0];
    $thing_start_time_break=explode(':',$thing_start_time);
    $thing_start_time_break_ampm=explode(' ',$thing_start_time);
    //echo('<input value="'.$thing_start_time.'" type="text" name="thing_start_time" id="thing_start_time"/>');
    //echo('<label for="thing_start_time">(00:00 pm)</label>'."\n");
    echo('<select id="thing_start_time_h" name="thing_start_time_h">');
    for($h=1;$h<=12;$h++){
        echo('<option value="'.$h.'"');
        if($thing_start_time_break[0]==$h) echo(' selected="selected"');
        echo('>'.$h.'</option>'."\n");
    }
    echo('</select>');
    echo('<select id="thing_start_time_m" name="thing_start_time_m">');
    for($m=0;$m<=60;$m++){
        if($m<10) echo('<option value="0'.$m.'"');
        else echo('<option value="'.$m.'"');
        if($thing_start_time_break[1]==$m) echo(' selected="selected"');
        if($m<10) echo('>0'.$m.'</option>'."\n");
        else echo('>'.$m.'</option>'."\n");
    }
    echo('</select>');
    echo('<select id="thing_start_time_ampm" name="thing_start_time_ampm">');
    if($thing_start_time_break_ampm[1]=='am') echo('<option value="am" selected="selected">am</option>'."\n");
    else echo('<option value="am">am</option>'."\n");
    if($thing_start_time_break_ampm[1]=='pm') echo('<option value="pm" selected="selected">pm</option>'."\n");
    else echo('<option value="pm">pm</option>'."\n");
    echo('</select>');
}
function thing_end_time(){
    global $post_ID;
    $custom=get_post_custom($post_ID);
    $thing_end_time=$custom['thing_end_time'][0];
    $thing_end_time_break=explode(':',$thing_end_time);
    $thing_end_time_break_ampm=explode(' ',$thing_end_time);
    //echo('<input value="'.$thing_end_time.'" type="text" name="thing_end_time" id="thing_end_time"/>');
    //echo('<label for="thing_end_time">(00:00 pm)</label>'."\n");
    echo('<select id="thing_end_time_h" name="thing_end_time_h">');
    for($h=1;$h<=12;$h++){
        echo('<option value="'.$h.'"');
        if($thing_end_time_break[0]==$h) echo(' selected="selected"');
        echo('>'.$h.'</option>'."\n");
    }
    echo('</select>');
    echo('<select id="thing_end_time_m" name="thing_end_time_m">');
    for($m=0;$m<=60;$m++){
        if($m<10) echo('<option value="0'.$m.'"');
        else echo('<option value="'.$m.'"');
        if($thing_end_time_break[1]==$m) echo(' selected="selected"');
        if($m<10) echo('>0'.$m.'</option>'."\n");
        else echo('>'.$m.'</option>'."\n");
    }
    echo('</select>');
    echo('<select id="thing_end_time_ampm" name="thing_end_time_ampm">');
    if($thing_end_time_break_ampm[1]=='am') echo('<option value="am" selected="selected">am</option>'."\n");
    else echo('<option value="am">am</option>'."\n");
    if($thing_end_time_break_ampm[1]=='pm') echo('<option value="pm" selected="selected">pm</option>'."\n");
    else echo('<option value="pm">pm</option>'."\n");
    echo('</select>');
}



function thing_connections(){
    global $post_ID;
    $custom=get_post_custom($post_ID);
    $thing_connections=$custom['thing_connections'][0];
    $thing_connections=unserialize($thing_connections);
    echo('<pre>');print_r($thing_connections);echo('</pre>');
    /// Args to get list of nodes typed as "attribute"; nid:1
    $args=array(
        'post_type'=>'thing',
        'posts_per_page'=>-1,
        'orderby'=>'title',
        'order'=>'ASC',
        'meta_query'=>array(
            array(
                'key'=>'thing_connections',
                'value'=>serialize(1),
                'compare'=>'LIKE',
            ),
        ),
    );
    $loop=new WP_Query($args);
    $thing_connections[99999]=array();
    $i=0;
    foreach($thing_connections as $connection):
        echo('<fieldset class="attribute">');
        echo('<select name="attribute_'.$i.'" id="attribute_'.$i.'">');
        echo('<option value="">:::Choose:::</option>');
        while($loop->have_posts()):$loop->the_post();
            echo('<option value="'.get_the_ID().'"');
            if(get_the_ID()==$connection['type']) echo(' selected="selected"');
            echo('>'.get_the_title(get_the_ID()).'</option>');
        endwhile;
        echo('</select>');

        if(isset($connection['response'])){
            $args2=array(
                'post_type'=>'thing',
                'posts_per_page'=>-1,
                'orderby'=>'title',
                'order'=>'ASC',
                'meta_query'=>array(
                    //'relation'=>'AND',
                    /*0=>array(
                        'key'=>'thing_connections',
                        'value'=>serialize(1),
                        'compare'=>'LIKE',
                    ),*/
                    1=>array(
                        'key'=>'thing_connections',
                        'value' => sprintf(':"%s";',intval($connection['type'])),
                        //'value'=>serialize(intval($connection['type'])),
                        'compare'=>'LIKE',
                    ),
                ),
            );
            $loop2=new WP_Query($args2);
            // SELECT, or:
            echo('<select name="attribute_response_'.$i.'" id="attribute_response_'.$i.'">');
            echo('<option value="">:::Choose:::</option>');
            echo('<option value="17">:::context:::</option>');
            echo('<option value="11">:::type:::</option>');
            echo('<option value="1">:::attr:::</option>');
            while($loop2->have_posts()):$loop2->the_post();
                echo('<option value="'.get_the_ID().'"');
                if(get_the_ID()==$connection['response']) echo(' selected="selected"');
                echo('>'.get_the_title(get_the_ID()).'</option>');
            endwhile;
            echo('</select>');
            // or:
            //echo('<input type="text" id="attribute_response_'.$i.'" name="attribute_response_'.$i.'" value="'.$thing_connections[get_the_ID()]['response'].'" placeholder="response"/>');
            //If attribute response is context:
            //echo('<input type="text" id="attribute_response_weight_'.$i.'" name="attribute_response_weight_'.$i.'" value="'.$thing_connections[get_the_ID()]['weight'].'" placeholder="weight"/>');
        }


        echo('</fieldset>');
        $i++;
    endforeach;

}

add_action('admin_init','add_thing_metas');


function attribute_response_field($data){

    //http://wp.anoml.net/wp-json/organic_connectivity/attribute_response/attribute/(?P<id>\d+)
    //http://v2.wp-api.org/extending/adding/

    //'SHOW NODES TYPED AS: '.$data['nid'];
    $args=array(
        'post_type'=>'thing',
        'posts_per_page'=>-1,
        'orderby'=>'title',
        'order'=>'ASC',
        'meta_query'=>array(
            //'relation'=>'AND',
            /*0=>array(
                'key'=>'thing_connections',
                'value'=>serialize(1),
                'compare'=>'LIKE',
            ),*/
            1=>array(
                'key'=>'thing_connections',
                //'value' => sprintf(':"%s";',intval($data['nid'])),
                'value'=>serialize(intval($data['nid'])),
                'compare'=>'LIKE',
            ),
        ),
    );
    $loop=new WP_Query($args);
    $arr=array();
    while($loop->have_posts()):$loop->the_post();
        $arr[get_the_ID()]=get_the_title(get_the_ID());
    endwhile;
    return json_encode($arr);
}
add_action('rest_api_init',function(){
	register_rest_route('organic_connectivity/attribute_response','/attribute/(?P<nid>\d+)',array(
		'methods'=>'GET',
		'callback'=>'attribute_response_field',
	));
});



//////// Saves all custom fields for THING custom post type ////////


function save_details(){

    global $post;

    //update_post_meta($post->ID,'thing_date',$_POST["thing_date_m"].'/'.$_POST["thing_date_d"].'/'.$_POST["thing_date_y"]);

    //update_post_meta($post->ID,'thing_start_time', $_POST["thing_start_time_h"].':'.$_POST["thing_start_time_m"].' '.$_POST["thing_start_time_ampm"]);

    //update_post_meta($post->ID,'thing_end_time',$_POST["thing_end_time_h"].':'.$_POST["thing_end_time_m"].' '.$_POST["thing_end_time_ampm"]);

    /// Build array of attributes
    foreach($_POST as $val_id=>$val){
        if(strpos($val_id,'attribute')!==FALSE){

            $attr_index=preg_replace("/[^0-9]/","",$val_id);

            if(strpos($val_id,'response_weight')!==FALSE){
                $attributes[$attr_index]['weight']=$val;
            }
            elseif(strpos($val_id,'response')!==FALSE){
                $attributes[$attr_index]['response']=$val;
                $attributes[$attr_index]['weight']='';
                $attributes[$attr_index]['notes']='';
            }
            elseif($val)
                $attributes[$attr_index]['type']=$val;

        }
    }

    // COMPRESS CONNECTIONS
    //if(is_array($_POST["thing_connections"])){
        //$connections=array();
        /*foreach($_POST["thing_connections"] as $c=>$cid){
            $connections[$cid]=array(
                'weight'=>$_POST["weight_".$cid],
                'response'=>$_POST["response_".$cid]);
        }*/
        update_post_meta($post->ID,'thing_connections',$attributes);
    //}

}

add_action('save_post','save_details');














// Add ability to add featured images to pages and posts

add_theme_support('post-thumbnails',array('post','thing'));
#set_post_thumbnail_size(140,140,true);



// Removes the automatic addition of P and BR elements to content

remove_filter('the_content','wpautop');
remove_filter('the_excerpt','wpautop');
remove_filter('term_description','wpautop');


// Add ability to execute shortcodes in text widgets

add_filter('widget_text','do_shortcode');



// Add ability to execute PHP in text widgets

add_filter('widget_text','php_text',99);
function php_text($text){
    if(strpos($text, '<' . '?')!==false){
        ob_start();
        eval('?'.'>'.$text);
        $text=ob_get_contents();
        ob_end_clean();
    }
    return $text;
}



// Define menus

if(function_exists('register_nav_menus')){
    register_nav_menus(
        array(
            'viewers'=>'Viewers Menu',
            'users'=>'Users Menu',
        )
    );
}



// Define widget regions

if( function_exists('register_sidebar') ){
    register_sidebar(array(
        'name'=> 'Footer',
        'id' => 'footer',
        'before_widget'=>'<div>',
        'after_widget'=>'</div>',
        'before_title'=>'<h2>',
        'after_title'=>'</h2>',
    ));
    register_sidebar(array(
        'name'=>'Sidebar Right',
        'id'=>'sidebar_right',
        'before_widget'=>'<div>',
        'after_widget'=>'</div>',
        'before_title'=>'<h2>',
        'after_title'=>'</h2>',
    ));
}





include(plugin_dir_path( __FILE__ ).'organic_connectivity_additem.php');
include(plugin_dir_path( __FILE__ ).'organic_connectivity_contextheading.php');
include(plugin_dir_path( __FILE__ ).'organic_connectivity_contextparents.php');
include(plugin_dir_path( __FILE__ ).'organic_connectivity_contexttree.php');
include(plugin_dir_path( __FILE__ ).'organic_connectivity_itemlist.php');



?>
<?php


// [additem]

function additem_func(){

    if(is_user_logged_in())
        return '<div id="add-thing">+ <a href="/wp-admin/post-new.php?post_type=thing">Add Thing</a></div>';

}


add_shortcode('additem','additem_func');


?>
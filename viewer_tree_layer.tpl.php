<?php


global $subjects;


////////////////////// MOVE THIS CHUNK PREPROC ////////////////////

if($context&&!empty($subjects[$context]->children)){

    #echo('group from $context AND $context was set, so group is children SUBJECTS of selected CONTEXT');
    $group=$subjects[$context]->children;

}
elseif(!isset($context)){

    #echo('no group from $context AND $context not set, so group is SUBJECT master');
    $group=$subjects;

}
else{

    #echo 'no group from $context AND $context was set, so return with nothing';
    return;

}

/////////////////////////////////////////////////////////////////////////////////
?>


<?php


print_context_level($group,$image_style,$mine_children,$show_random_child,$parent,$show_nid);


?>
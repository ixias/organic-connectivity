<?php


//// Perspectives


$viewers=array(
    'tree'=>array(
        'title'=>'Tree/Nestings',
        'preprocess'=>'print_tree($subjects,$SUBJECT_PROTOTYPE_VAR);',
        'template'=>'viewer_tree.tpl.php',
    ),
    'cloud'=>array(
        'title'=>'Cloud',
        'preprocess'=>'printCloud($sql);',
        'template'=>'viewer_cloud.tpl.php',
    ),
    'sunburst'=>array(
        'title'=>'Sunburst',
        'preprocess'=>'printSunburst($sql);',
        'template'=>'viewer_sunburst.tpl.php',
    ),
    'neuron'=>array(
        'title'=>'Neuron',
        'preprocess'=>'printNeuron($sql);',
        'template'=>'viewer_neuron.tpl.php',
    ),
    'serpent'=>array(
        'title'=>'Serpent',
        'preprocess'=>'printSerpent($sql);',
        'template'=>'viewer_serpent.tpl.php',
    ),
    'Types'=>array(
        'title'=>'Types',
        'preprocess'=>'printSerpent($sql);',
        'template'=>'viewer_serpent.tpl.php',
    ),
    'Subjects'=>array(
        'title'=>'Types',
        'preprocess'=>'printSerpent($sql);',
        'template'=>'viewer_serpent.tpl.php',
    ),
);
$item_viewers=array(
    'table'=>array(
        'title'=>'Table',
        'preprocess'=>'printTable($sql);',
        'template'=>'viewer_table.tpl.php',
    ),
    'grid'=>array(
        'title'=>'Grid',
        'preprocess'=>'printGrid($sql);',
        'template'=>'viewer_grid.tpl.php',
    ),
);



function printTable($sql){
}


function printGrid($sql){
}


function print_tree(&$subjects,$key){
    echo('<ul>');
    foreach($subjects as $sid=>$subject){
        foreach($subject->connections as $cid=>$connection){
#echo($connection['ref-id']."=??=".'subject'."&&".$connection['response']."==".$key.'<br/>');
            if($connection['ref-id']=='subject'&&$connection['response']==$key){
                echo('<li><a href="/'.$sid.'">'.$subject->title.'</a>');
                print_tree($subjects,$sid);
                echo('</li>');
            }
        }
    }
    echo('</ul>');
}



/*function printTree($tree, $depth="", $edit=0, $request="", $in_grp=array()){
    echo( "<div id='tree'>\n" );
    echo( "<ul>\n" );
    foreach($tree as $nid=>$node){

        if( $nid==$request ) echo( "<li class=\"active\">" );
        else echo( "<li>" );



        if($edit){
            echo( "<input type=\"checkbox\" id=\"".$nid."\" name=\"".$nid."\" class=\"connection\"/>\n" );
            echo( "<label for=\"".$nid."\">".$node["title"]." (".$node["description"].")</label>\n" );
        }else{
            if(isset($node["path"])) $path = "/".$node["path"];
            else $path = $depth."/".$nid;
            echo( "  <a href=\"".$path."\">".$node["title"]."</a>" );
        }


        if( isset($node["children"]) )
            printTree( $node["children"], $path, $edit, $request, $in_grp );


        //START: PRINT ITEMS IN GROUP
        if( count($in_grp) ){
            echo( "<ul class=\"in-this-group\">\n" );
            for( $x=0; $x<count($in_grp); $x++ ){
                if( $in_grp[$x]["group"] == $nid ){
                    echo( " <li>\n" );
                    echo( "  <a href=\"/node/".$in_grp[$x]["id"]."\">" );
                    echo( "   <span class=\"title\">".$in_grp[$x]["title"]."</span>\n" );
                    echo( "  </a>\n" );
                    echo( " </li>\n" );
                }
            }
            echo( "</ul>\n\n" );
        }
        //END: PRINT ITEMS IN GROUP


        echo( " </li>\n" );
    }
    echo( "</ul>\n" );
    echo( "</div>\n" );
}*/




function printCloud($sql){
    //$cloud=snag_sql_query($sql,'ref-id',$TYPE_PROTOTYPE_VAR,'response',$SUBJECT_PROTOTYPE_VAR);
    global $subjects;
    shuffle($subjects);
}


function printSunburst($sql){
}


function printNeuron($sql){
}


function printSerpent($sql){
}


?>
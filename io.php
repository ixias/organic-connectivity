<?php



function snag_sql_query(&$sql,$search_key=NULL,$search=NULL,$search_key2=NULL,$search2=NULL,$search_key3=NULL,$search3=NULL){


    if(isset($search_key)&&isset($search)){

        //PULL THE CONNECTION ENTRIES ASSOCIATED WITH SEARCH
        if(isset($search_key)&&isset($search)&&isset($search_key2)&&isset($search2))

            $data_search=mysqli_query($sql,"SELECT * FROM `connections` WHERE (`".$search_key."`='".$search."') AND (`".$search_key2."`='".$search2."')");

        elseif(isset($search_key)&&isset($search))
            $data_search=mysqli_query($sql,"SELECT * FROM `connections` WHERE (`".$search_key."`='".$search."')");

        #echo("SELECT * FROM `connections` WHERE (`".$search_key."` = '".$search."') AND (`".$search_key2."`='".$search2."')");
        #echo("<hr/>".$search_key."----".$search."<hr/>");
        #echo("<hr/>".$search_key2."----".$search2."<hr/>");

        if($data_search){
            //PULL THE NODE ENTRIES ASSOCIATED WITH CONNECTION SEARCH
            while($info_search=mysqli_fetch_array($data_search,MYSQLI_ASSOC)){
                if(!isset($x)) $x="'".$info_search['origin-id']."'";
                else $x.=",'".$info_search['origin-id']."'";
            }
            $data=mysqli_query($sql,"SELECT * FROM `nodes` WHERE id IN (".$x.")");
        }

    }
    elseif(isset($search_key3)&&isset($search3)){
        //PULL THE NODE ENTRIES
        $data=mysqli_query($sql,"SELECT * FROM `nodes` WHERE ".$search_key3."='".$search3."'");
    }
    else{
        //PULL THE NODE ENTRIES
        $data=mysqli_query($sql,"SELECT * FROM `nodes`");
    }


        #echo("<hr/>");
        #print_r($data);


    if($data){

        $result=array();

        while($info=mysqli_fetch_array($data,MYSQLI_ASSOC)){

            //$key=array_push($result,array())-1;
            //$result[$key]['id']=$info['id'];
            $result[$info['id']]=new stdClass();
            $result[$info['id']]->title=$info['title'];
            $result[$info['id']]->description=$info['description'];
            $result[$info['id']]->body=$info['body'];
            $result[$info['id']]->images=$info['images'];

            ///// LOAD CONNECTIONS ////
            $connections_arr=explode(',',$info['connections']);
            foreach($connections_arr as $cid){

                $connection_data=mysqli_query($sql,"SELECT * FROM `connections` WHERE `id` LIKE '".$cid."'");

                while($info_connections=mysqli_fetch_array($connection_data,MYSQLI_ASSOC)){

                    $result[$info['id']]->connections[$info_connections['id']]=array(
                        'type'=>$info_connections['ref-id'],
                        'response'=>$info_connections['response'],

                        'nid'=>$info_connections['response'],

                        'weight'=>$info_connections['weight'],
                        'notes'=>$info_connections['notes']
                    );

                }
            }

        }

        return $result;
    }
}




function make_edits(&$sql){

    /// Check if ID is not set
    if($_POST['edit']=='new'){
        if($_POST['id']=='') return 'You must set an ID for the node, please go back and try again.';
    }

    /// Check if ID already exists
    if($_POST['edit']=='new'){
        $info=snag_sql_query($sql,NULL,NULL,NULL,NULL,'id',$_POST['id']);
        if($info) return 'A node with this ID already exists, please go back and try again.';
    }

    /// Build array of attributes
    foreach($_POST as $val_id=>$val){
        if(strpos($val_id,'attribute')!==FALSE){

            $attr_index=preg_replace("/[^0-9]/","",$val_id);

            if(strpos($val_id,'response_weight')!==FALSE){
                $attributes[$attr_index]['weight']=$val;
            }
            elseif(strpos($val_id,'response')!==FALSE){
                $attributes[$attr_index]['response']=$val;
                $attributes[$attr_index]['weight']='DEFAULT';
                $attributes[$attr_index]['notes']='';
            }
            else
                $attributes[$attr_index]['type']=$val;

        }
    }



    /// Update attributes if they are already set
    if($_POST['edit']!=''&&$_POST['edit']!='new'){

        /// Get connections associated with editing node
        $info=snag_sql_query($sql,NULL,NULL,NULL,NULL,'id',$_POST['edit']);

        if($info[$_POST['edit']]->connections){
        foreach($info[$_POST['edit']]->connections as $cid=>$connection){
            //echo('<pre>'.$cid.':');print_r($connection);echo('</pre>');
            if(isset($attributes[0])){

                /// UPDATE 'connections' ('id') ($connection['id']) WITH $attributes[0];
                $edit_connection="UPDATE `connections`
                                  SET `ref-id`='".$attributes[0]['type']."', `response`='".$attributes[0]['response']."', `weight`=".$attributes[0]['weight'].", `notes`='".$attributes[0]['notes']."', `origin-id`='".$_POST['id']."'
                                  WHERE `id`='".$cid."'";
                mysqli_query($sql,$edit_connection);
                array_shift($attributes);
                //echo($edit_connection.'<br/>');

                /// When done add id number to node field for connections
                if(isset($_POST['connections'])) $_POST['connections'].=','.$cid;
                else $_POST['connections']=$cid;

            }
            else{
                /// If there are any connection entries left in the database, delete them
                /// DELTE 'connections' ('id') ($connection['id']);
                echo('<br/>DELETE '.$cid.'<br/>');
            }
        }
        }
    }



    /// after deleting attributes:
    /////$num = SELECT MAX( `id` ) FROM `connections`;
    /////ALTER TABLE `connections` AUTO_INCREMENT = $num+1;





    /// Add attributes
    if($attributes){
    foreach($attributes as $attribute){

        $add_attr="INSERT INTO `connections` (`ref-id`, `response`, `weight`, `notes`, `origin-id`)
                   VALUES ('".$attribute['type']."', '".$attribute['response']."', ".$attribute['weight'].", '', '".$_POST['id']."')";

        //echo($add_attr.'<br/>');
        mysqli_query($sql,$add_attr);

        /// When done add id number to node field for connections
        $last_id=$sql->insert_id;
        if(isset($_POST['connections'])) $_POST['connections'].=','.$last_id;
        else $_POST['connections']=$last_id;

    }
    }


    //return '<pre>'.print_r($attributes,TRUE).'</pre>'.'<pre>'.print_r($_POST,TRUE).'</pre>';


    if($_POST['edit']=='new'){

        $addnd="INSERT INTO `nodes` (id, title, description, body, images, connections)
                VALUES ('".$_POST['id']."', '".$_POST['title']."', '".$_POST['description']."', '".$_POST['body']."', '".$_POST['images']."', '".$_POST['connections']."')";

        mysqli_query($sql,$addnd);

        return '<div class="feedback">Node Added</div>'."\n";

    }
    elseif($_POST["edit"]!=""){

        $editnd="UPDATE `nodes`
                 SET `id`='".$_POST['id']."', `title`='".$_POST['title']."', `description`='".$_POST['description']."', `body`='".$_POST['body']."', `images`='".$_POST['images']."', `connections`='".$_POST['connections']."'
                   WHERE `id`='".$_POST['edit']."'";

        mysqli_query($sql,$editnd);

        return "<div class=\"feedback\"><a href=\"".$_POST['id']."\">Node</a> Edited</div>\n";

    }

}






function organic_context_json_contexts_sunburst_d3_child_adder(&$subjects,$subject){
    $arr=array(
        'name'=>$subjects[$subject]->title
        //'name'=>$subjects[$subject]['title']
    );
    if(isset($subjects[$subject]->children)){
    //if(isset($subjects[$subject]['children'])){
        foreach($subjects[$subject]->children as $child){
        //foreach($subjects[$subject]['children'] as $child){
            if(!isset($subjects[$child]->children)){
            //if(!isset($subjects[$child]['children'])){
                $arr['children'][]=array(
                    'name'=>$subjects[$child]->title,
                    //'name'=>$subjects[$child]['title'],
                    'size'=>(count($subjects[$child]->uses)/10),
                    //'size'=>rand(0,4000),
                    );
            }
            else{
                $arr['children'][]=organic_context_json_contexts_sunburst_d3_child_adder($subjects,$child);
            }
        }
    }
    return $arr;
}

?>
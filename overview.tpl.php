<aside>

            <section id="your-catalog">


                <h3>Setlists</h3>


                <section>
                    <h4>Connectors/ConnectionTypes</h4>
                    <?php echo(theme('prototypes',array('type'=>variable_get('organic_connectivity_connector_prototype',''),))); ?>
                </section>


                <section id="prototype-overview">
                    <h4>ProtoTypes<span>Classes</span></h4>
                    <?php echo(theme('prototypes',array('parent'=>variable_get('organic_connectivity_prototype_prototype','')))); ?>
                </section>


                <section>
                    <h4>Attributes<span>Flavorings</span></h4>
                    <?php #global $attribs;print_r($attribs); ?>
<?php
echo(theme('children',array(

    'by_type'=>variable_get('organic_connectivity_attribute_prototype',''),
    'show_date'=>FALSE,
    'show_multi_image'=>FALSE,
    'mine_children'=>TRUE,
    'show_sorting'=>FALSE,
    'show_displays'=>FALSE,
    'show_heading'=>FALSE,
    'show_outer_contexts'=>FALSE,

)));
?>
                </section>


                <section>
                    <h4>Contexts<span>Categories</span></h4>
                    <?php #echo(theme('prototypes',array('type'=>21,))); ?>
                    <?php #global $contexts;print_r($contexts); ?>
                    <?php #echo(array_values($contexts)[0]->nid); ?>
                    <?php echo(theme('context_layer',array(
                                                           'context'=>NULL,
                                                           'image_style'=>'thumbnail',
                                                           'mine_children'=>TRUE,
                                                           'show_nid'=>TRUE,
                                                          ))); ?>

                </section>

            </section>

            <section id="your-graphs">
                <h3>Infographs</h3>
                <section id="web">
                    <h4>Contexts<span>Categories</span></h4>
                    <svg id="d3_force"></svg>
                    <a href="/connectivity/contexts/web" class="morelink"><span>More</span>Webbing</a>
                </section>
                <section id="sunburst-flat">
                    <!--h4>Prototypes<span>Classes</span></h4-->
                    <svg id="d3_sunburst"></svg>
                    <a href="/connectivity/contexts/sunburst" class="morelink"><span>More</span>Sunburst</a>
                </section>
            </section>

            <section id="your-friends">
                <h3>People</h3>
                <h4>Friends</h4>
                <ul>
<?php
$users=entity_load('user');
foreach($users as $u){
    if($u->uid){
        echo('<li><a href="/user/'.$u->uid.'">');
        if(!empty($u->field_images))
            echo('<img src="'.image_style_url('thumbnail',$u->field_images[LANGUAGE_NONE][0]['uri']).'" alt=""/>');
        echo($u->name.'</a></li>');
    }
}
?>
                </ul>
            </section>

            <section id="your-items">

                <!--h3>Posts</h3-->
                <!--h3>Rotator</h3-->
                <?php #echo(theme('rotator')); ?>

                <!--h3>Similar/Recommended</h3>
                <ul>
                    <li><a href="http://covidien.orgnsm.org">covidien.orgnsm.org</a></li>
                    <li><a href="http://idiosync-hive.anoml.net">idiosync-hive.anoml.net</a></li>
                    <li><a href="http://sndsystm.anoml.net">sndsystm.anoml.net</a></li>
                    <li><a href="http://iom.orgnsm.org">iom.orgnsm.org</a></li>
                    <!- -li><a href="http://birdhughes.orgnsm.org"></a></li- ->
                </ul-->

            </section>

</aside>

<?php

/*                                                                        */
/*                                                                        */
/*                PRINT SPHERE AND PATH DATA WITH SELECTIONS              */
/*                IN SCALABLE VECTOR SPACE                                */
/*                                                                        */
/*                                                                        */

                            global $qabalah_spheres;
                            global $qabalah_paths;

?>
<nav class="tree-of-life">
<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
     viewBox="0 0 766.5 1220" enable-background="new 0 0 766.5 1220" xml:space="preserve">

    <g id="Circulars">
        <circle fill="#FFFFFF" stroke="#231F20" stroke-miterlimit="10" cx="383.2" cy="1010" r="200"/>
        <circle fill="#FFFFFF" stroke="#231F20" stroke-miterlimit="10" cx="383.2" cy="810" r="200"/>
        <circle fill="#FFFFFF" stroke="#231F20" stroke-miterlimit="10" cx="383.2" cy="610" r="200"/>
        <circle fill="#FFFFFF" stroke="#231F20" stroke-miterlimit="10" cx="383.2" cy="410" r="200"/>
        <circle fill="#FFFFFF" stroke="#231F20" stroke-miterlimit="10" cx="383.2" cy="210" r="200"/>
    </g>

    <g id="sideCirculars">
        <circle opacity="0.44" fill="#FFFFFF" stroke="#231F20" stroke-miterlimit="10" cx="556.5" cy="310" r="200"/>
        <circle opacity="0.44" fill="#FFFFFF" stroke="#231F20" stroke-miterlimit="10" cx="210" cy="310" r="200"/>
        <circle opacity="0.44" fill="#FFFFFF" stroke="#231F20" stroke-miterlimit="10" cx="556.5" cy="510" r="200"/>
        <circle opacity="0.44" fill="#FFFFFF" stroke="#231F20" stroke-miterlimit="10" cx="210" cy="510" r="200"/>
        <circle opacity="0.44" fill="#FFFFFF" stroke="#231F20" stroke-miterlimit="10" cx="556.5" cy="710" r="200"/>
        <circle opacity="0.44" fill="#FFFFFF" stroke="#231F20" stroke-miterlimit="10" cx="210" cy="710" r="200"/>
    </g>



<?php if(!empty($qabalah_paths)){ ?>

                <!--ul id="paths"-->
    <g id="Paths2">

    <?php foreach($qabalah_paths as $cid=>$details){ ?>
        <a xlink:href="/<?php echo(drupal_get_path_alias('node/'.$qabalah_paths[$cid]->nid)); ?>">


<?php $path_position_attribute_key=search_for_attribute(variable_get('organic_connectivity_attribute_prototype',''),342,$details->connections); ?>
<?php $path_english_name_key=search_for_attribute(variable_get('organic_connectivity_attribute_prototype',''),34,$details->connections); ?>
<?php $path_description_key=search_for_attribute(variable_get('organic_connectivity_attribute_prototype',''),43,$details->connections); ?>

            <?php if(!empty($details->connections[$path_position_attribute_key])): ?>

            <line fill="none" stroke="#231F20" stroke-width="10" stroke-linecap="round" stroke-miterlimit="10" x1="<?php echo(explode(",",$details->connections[$path_position_attribute_key]['response'])[0]); ?>" y1="<?php echo(explode(",",$details->connections[$path_position_attribute_key]['response'])[1]); ?>" x2="<?php echo(explode(",",$details->connections[$path_position_attribute_key]['response'])[2]); ?>" y2="<?php echo(explode(",",$details->connections[$path_position_attribute_key]['response'])[3]); ?>"/>

            <g><text x="<?php echo(explode(",",$details->connections[$path_position_attribute_key]['response'])[0] + 250); ?>" y="<?php echo(explode(",",$details->connections[$path_position_attribute_key]['response'])[1] - 90); ?>" text-anchor="middle"><tspan class="numerological"><?php echo($details->nid); ?></tspan><?php echo($details->title); ?><!--tspan x="<?php echo(explode(",",$details->connections[$path_position_attribute_key]['response'])[0] + 1); ?>" y="<?php echo(explode(",",$details->connections[$path_position_attribute_key]['response'])[1] + 1); ?>" style="fill:magenta;font-size:25px;" text-anchor="middle"><?php #echo($details->connections[$path_english_name_key]['response']); ?></tspan-->
                <!--tspan x="<?php echo(explode(",",$details->connections[$path_position_attribute_key]['response'])[0] + 100); ?>" y="<?php echo(explode(",",$details->connections[$path_position_attribute_key]['response'])[1] + 200); ?>" style="fill:magenta;font-size:15px;" text-anchor="middle">
                    <?php #echo($details->connections[$path_description_key]['response']); ?>
                </tspan-->

<!--
                            <span class="title"><?php echo($qabalah_paths[$cid]->title); ?></span>
<?php if(!empty($qabalah_paths[$cid]->field_subtitle)): ?>
                            <span class="subtitle"><?php echo($qabalah_paths[$cid]->field_subtitle[LANGUAGE_NONE][0]["value"]); ?></span>
<?php endif; ?>

<?php if(isset($node)&&$node->type=='thing'&&array_key_exists($node->nid,$qabalah_paths[$cid]) ): ?>
                            <span class="selected-attribute"><?php echo($qabalah_paths[$cid][$node->nid]); ?></span>
<?php endif; ?>
-->

            </text></g>



<!--clipPath id="clip1">
  <rect x="200" y="10" width="60" height="100"/>
  ... you can have any shapes you want here ...
</clipPath>

and then apply the clip path like this:

<g clip-path="url(#clip1)">
  ... your text elements here ...
</g-->




            <?php endif; ?>
        </a>
    <?php } ?>

    </g>
<?php } ?>






<?php if(!empty($qabalah_spheres)){ ?>
                <!--ul id="spheres"-->
    <g id="Spheres2">
    <?php foreach($qabalah_spheres as $cid=>$details){ ?>



<?php $sphere_position_attribute_key=search_for_attribute(variable_get('organic_connectivity_attribute_prototype',''),341,$details->connections); ?>
<?php $sphere_english_name_key=search_for_attribute(variable_get('organic_connectivity_attribute_prototype',''),34,$details->connections); ?>
<?php $sphere_description_key=search_for_attribute(variable_get('organic_connectivity_attribute_prototype',''),43,$details->connections); ?>


<?php
$classes='';
///////////////////////if(array_key_exists($cid,$qabalah_spheres[arg(1)]->children)) $classes='active';
if( arg(0)=='node'
    &&is_numeric(arg(1))
    &&!empty($qabalah_spheres[$cid]->children)
    &&array_key_exists(arg(1),$qabalah_spheres[$cid]->children)
    &&$qabalah_spheres[$cid]->children[arg(1)][0]==100)
 $classes='touch';
elseif($qabalah_spheres[$cid]->nid==arg(1)){
//$classes='active';
?>
    <g id="SphereSelector">
        <radialGradient id="SVGID_1_" cx="<?php echo(explode(",",$details->connections[$sphere_position_attribute_key]['response'])[0]); ?>" cy="<?php echo(explode(",",$details->connections[$sphere_position_attribute_key]['response'])[1]); ?>" r="116.972" gradientUnits="userSpaceOnUse">
            <stop  offset="0" style="stop-color:#D40088"/>
            <stop  offset="0.1822" style="stop-color:#D40389"/>
            <stop  offset="0.3149" style="stop-color:#D60C8D"/>
            <stop  offset="0.432" style="stop-color:#D91C94"/>
            <stop  offset="0.54" style="stop-color:#DD339E"/>
            <stop  offset="0.6418" style="stop-color:#E150AA"/>
            <stop  offset="0.7389" style="stop-color:#E773BA"/>
            <stop  offset="0.8325" style="stop-color:#EF9ECC"/>
            <stop  offset="0.9207" style="stop-color:#F7CDE1"/>
            <stop  offset="1" style="stop-color:#FFFFF6"/>
        </radialGradient>
        <circle opacity="0.75" fill="url(#SVGID_1_)" stroke="#FFFFFF" stroke-miterlimit="10" cx="<?php echo(explode(",",$details->connections[$sphere_position_attribute_key]['response'])[0]); ?>" cy="<?php echo(explode(",",$details->connections[$sphere_position_attribute_key]['response'])[1]); ?>" r="117"/>
    </g>
<?php        } ?>





        <a xlink:href="/<?php echo(drupal_get_path_alias('node/'.$qabalah_spheres[$cid]->nid)); ?>" id="sphere-<?php echo($qabalah_spheres[$cid]->nid); ?>">
            <?php if(!empty($details->connections[$sphere_position_attribute_key])): ?>

            <circle opacity="65.000000e-02" fill="#FFFFFF" stroke="#231F20" stroke-width="5" stroke-miterlimit="10" cx="<?php echo(explode(",",$details->connections[$sphere_position_attribute_key]['response'])[0]); ?>" cy="<?php echo(explode(",",$details->connections[$sphere_position_attribute_key]['response'])[1]); ?>" r="69.3"/>

<image xlink:href="<?php echo(image_style_url($image_style,$details->field_images[LANGUAGE_NONE][0]['uri'])); ?>" width="60px" height="60px" x="<?php echo(explode(",",$details->connections[$sphere_position_attribute_key]['response'])[0] - 30); ?>" y="<?php echo(explode(",",$details->connections[$sphere_position_attribute_key]['response'])[1] - 80); ?>" class="icon"/>

            <text x="<?php echo(explode(",",$details->connections[$sphere_position_attribute_key]['response'])[0] + 1); ?>" y="<?php echo(explode(",",$details->connections[$sphere_position_attribute_key]['response'])[1]); ?>" text-anchor="middle"><tspan class="numerological"><?php echo($details->nid); ?></tspan><?php if(arg(0)=='node'&&is_numeric(arg(1))&&array_key_exists(arg(1),$details->connections)&&$details->connections[arg(1)]['response']!=''): ?><?php echo($details->connections[arg(1)]['response']); ?><?php else: ?><?php echo($details->title); ?><?php endif; ?>

<?php if(isset($details->connections[$sphere_english_name_key]['response'])): ?><tspan x="<?php echo(explode(",",$details->connections[$sphere_position_attribute_key]['response'])[0] + 1); ?>" y="<?php echo(explode(",",$details->connections[$sphere_position_attribute_key]['response'])[1] + 23); ?>" text-anchor="middle" class="translation"><?php echo($details->connections[$sphere_english_name_key]['response']); ?></tspan><? endif; ?>

<?php if(isset($details->connections[$sphere_description_key]['response'])): ?><tspan x="<?php echo(explode(",",$details->connections[$sphere_position_attribute_key]['response'])[0] + 1); ?>" y="<?php echo(explode(",",$details->connections[$sphere_position_attribute_key]['response'])[1] + 40); ?>" text-anchor="middle"><?php echo($details->connections[$sphere_description_key]['response']); ?></tspan><?php endif; ?>

<?php #if(!empty($qabalah_spheres[$cid]->field_subtitle)): ?><!--tspan class="subtitle"--><?php #echo($qabalah_spheres[$cid]->field_subtitle[LANGUAGE_NONE][0]["value"]); ?><!--/tspan--><?php #endif; ?><?php if(!empty($details->field_images)): ?><?php endif; ?></text>

            <?php else: ?>
                <text y="30"><?php echo($details->nid);echo($details->title); ?></text>
            <?php endif; ?>
        </a>







    <?php } ?>
    </g>
<?php } ?>



</svg>
</nav>




<?php if(!empty($qabalah_spheres)){ ?>


<?php foreach($qabalah_spheres as $cid=>$details){ ?>

<?php
            ##########################################################################################
            ##########################################################################################
            /////////////// use weights to determine the selections............./////////////////////
            ##########################################################################################
            //elseif( $details->nid == $node_contexts[0] ) $return .= '<li class="touch">\n';
            //elseif( in_array( $details->nid, $node_contexts ) ) $return .= '<li class="touch">\n';
            //elseif( in_array( $details->nid, $node_themes ) ) $return .= '<li class="thematique">\n';
            ##########################################################################################
            ##########################################################################################
?>
                    <!--li class="<?php echo($classes); ?>">
                    </li-->

<?php } ?>






<?php if(!empty($qabalah_paths)){ ?>



<?php foreach($qabalah_paths as $cid=>$details){ ?>


<?php
#if( !empty($node->field_path) )
#	foreach( $node->field_path["und"] as $path )
#		if( $path["nid"] == $i ) $pathSelected = 1;
#if( !empty($paths_via_astro) && array_key_exists($i, $paths_via_astro) ) $pathSelected = 1;
$classes='';
if(is_numeric(arg(1))
   &&!empty($qabalah_paths[arg(1)]->children)
   &&array_key_exists($cid,$qabalah_paths[arg(1)]->children)) $classes='active';
elseif($qabalah_paths[$cid]->nid==arg(1)) $classes='active';
?>

                    <!--li id="path-<?php echo($qabalah_paths[$cid]->nid); ?>" class="<?php echo($classes); ?>">
                    </li-->
<?php } ?>

<?php } ?>



<?php } ?>
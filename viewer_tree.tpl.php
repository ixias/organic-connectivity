<?php include("viewers_toolbar.tpl.php"); ?>
<section id="pamphlet_full">
<?php 
echo(theme(
                'context_layer',array(
                    'context'=>variable_get('organic_connectivity_context_prototype',''),//1//NULL
                    'image_style'=>'thumbnail',
                    'mine_children'=>TRUE,
                )));
?>
</section>
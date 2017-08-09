<?php echo ('<?xml version="1.0" encoding="utf-8"?>'."\n"); ?>
<rss version="2.0" xml:base="http://<?php echo($_SERVER['HTTP_HOST']);  ?>/syndicate">

    <channel>

        <title><?php echo(variable_get('site_name')); ?></title>

        <link>http://<?php echo($_SERVER['HTTP_HOST']);  ?>/syndicate</link>

        <description>Recent <?php echo(variable_get('site_slogan')); ?></description>

        <language>en</language>

        <pubDate><?php echo(date(DATE_RSS,array_values($childs)[0]->created)); //date of most recent post ?></pubDate>

        <!--image>
            <url></url>
            <title></title>
            <link></link>
        </image-->

<?php
if(count($childs)){
    foreach($childs as $item){
        echo("<item>\n");

        echo(" <title>".$item->title."</title>\n");

        echo(" <link>http://".$_SERVER['HTTP_HOST']."/node/".$item->nid."</link>\n");

        echo(" <description><![CDATA[\n");
        if(!empty($item->field_images))
            echo("<img src='".image_style_url($image_size,$item->field_images[LANGUAGE_NONE][0]["uri"])."' alt=''/>\n");
        else
            echo($item->body[LANGUAGE_NONE][0]["value"]);
        echo("  ]]></description>\n");

        echo(" <guid isPermaLink='false'>".$item->nid."</guid>\n");

        echo(" <pubDate>".date(DATE_RSS,$item->created)."</pubDate>\n");

        echo(" <comments>");
        if(!empty($item->field_images[LANGUAGE_NONE]))
            echo(image_style_url("large-landscape-or-portrait",$item->field_images[LANGUAGE_NONE][0]["uri"]));
        echo("</comments>\n");

        echo("</item>\n\n");
    }
}
?>

    </channel>

</rss>
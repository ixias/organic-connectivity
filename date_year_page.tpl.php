<?php if(is_numeric(arg(2))) $year=arg(2); ?>

<section id="calenderical" class="overview-of-year">

<?php #echo(organic_calendar_date_display_months_list($year,$monthCounts[$year])); ?>
<?php
$yearDown=arg(2)-1;
$yearUp=arg(2)+1;
?>
    <div style="text-align:center;font-size:200%;">
        <a href="/items/calendar/<?php echo($yearDown); ?>" class="prev">&#8592;<?php echo($yearDown); ?></a>
        <a href="/items/calendar/<?php echo($year); ?>" style="background-color:magenta;"><?php echo($year); ?></a>
        <a href="/items/calendar/<?php echo($yearUp); ?>" class="next"><?php echo($yearUp); ?>&#8594;</a>
    </div>

<?php
$return = '<ul>';
for($x=1;$x<13;$x++){

    if( $x<10 ) $month_for_url="0".$x;
    else $month_for_url="".$x."";


    if(array_key_exists($month_for_url,$monthCounts[$year]) && $children=$monthCounts[$year][$month_for_url]){

        $return .= '<li>';
        $return .= '<h4><a href="/items/calendar/'.$year.'/'.$month_for_url.'">';
        //$return.=$month_for_url;
        $return .= organic_calendar_month_names($x).'<span class="details">'.count($children).'<span>'.round($monthCounts[$year]['total']/count($children)).'%</span></span>';
        $return .= '</a></h4>';

        $return .= '<ul>';
        foreach($children as $child){
            $nd=node_load($child);
            $return.='<li>';
            $return.='<a href="/node/'.$nd->nid.'">';
            $return.='<span class="title">'.htmlentities($nd->title).'</span>';
            if(!empty($nd->field_images)){
                $return.='<img src="'.image_style_url('thumbnail',$nd->field_images[LANGUAGE_NONE][0]['uri']).'" alt=""/>';
            }
            elseif(!empty($nd->body[LANGUAGE_NONE])){
                $test = strip_tags($nd->body[LANGUAGE_NONE][0]['value']);
                $test = substr($test,0,225);
                $return.='<span class="body">'.$test.'...</span>';
            }
            $return.='</a>';
            $return.='</li>';
        }
        $return.='</ul>';

        $return .= '</li>';

    }

}
$return .= '</ul>';
echo($return);
?>
</section>

<?php
if(is_numeric(arg(2))&&is_numeric(arg(3))){
    $year=arg(2);
    $month=arg(3);
}
?>

<section id="calendar">
<?php

    $results = organic_prototype_obtain_entities_by_connection_3();
    $events = array();

    foreach($results as $event){
        if(date("Ym",$event->created)==$year.$month){

            $show=FALSE;
            if(!empty($event->field_expose_as_context)&&$event->field_expose_as_context[LANGUAGE_NONE][0]['value']=='0')
                $show=TRUE;
            elseif(empty($event->field_expose_as_context))
                $show=TRUE;

            if($show){
                $events[] = array(
                    "date" => date("Y-m-d", $event->created),
                    "title" => $event->title,
                    //"content" => $event->body[LANGUAGE_NONE][0]["value"],
                    "url" => $event->nid,
                    "time" => date("s", $event->created),
                    "img" => (!empty($event->field_images) ? $event->field_images[LANGUAGE_NONE][0]["uri"]:NULL),
                );
            }

        }
    }
    #$return .= "<pre>".print_r( $events, TRUE )."</pre>\n";
?>

<?php
    $today = date("Y")."-".date("m")."-".date("d");

    if(intval($month)+1>12){
        $nextMonth=1;
        $yearUp=intval($year)+1;
    }else{
        $nextMonth=intval($month)+1;
        $yearUp=$year;
    }

    if(intval($month-1)<1){
        $lastMonth=12;
        $yearDown=intval($year)-1;
    }else{
        $lastMonth=intval($month)-1;
        $yearDown=$year;
    }

    if($lastMonth<10) $lastMonthZeroed='0'.$lastMonth; else $lastMonthZeroed=$lastMonth;
    if($nextMonth<10) $nextMonthZeroed='0'.$nextMonth; else $nextMonthZeroed=$nextMonth;

    $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
    $daysInLastMonth = cal_days_in_month(CAL_GREGORIAN, $lastMonth, $year);
?>

    <a href="/items/calendar/<?php echo($yearDown); ?>/<?php echo($lastMonthZeroed); ?>" class="prev">&#8592;<?php echo(organic_calendar_month_names($lastMonth)); ?></a>
    <a href="/items/calendar/<?php echo($yearUp); ?>/<?php echo($nextMonthZeroed); ?>" class="next"><?php echo(organic_calendar_month_names($nextMonth)); ?>&#8594;</a>

    <div id="this-month">

        <h3><a href="/items/calendar/<?php echo($year); ?>/<?php echo($month); ?>"><?php echo(organic_calendar_month_names($month)); ?></a>, <a href="/items/calendar/<?php echo($year); ?>"><?php echo($year); ?></a></h3>

        <table>
            <thead>
                <tr>
                    <th>Monday</th>
                    <th>Tuesday</th>
                    <th>Wednesday</th>
                    <th>Thursday</th>
                    <th>Friday</th>
                    <th>Saturday</th>
                    <th>Sunday</th>
                </tr>
            </thead>
            <tbody>
<?php
$startDay = date("l", mktime(0, 0, 0, $month, 1, $year));
if($startDay == "Monday") $offset = 0;
if($startDay == "Tuesday") $offset = 1;
if($startDay == "Wednesday") $offset = 2;
if($startDay == "Thursday") $offset = 3;
if($startDay == "Friday") $offset = 4;
if($startDay == "Saturday") $offset = 5;
if($startDay == "Sunday") $offset = 6;
?>

<?php for( $i=$daysInLastMonth-$offset+1; $i<=$daysInLastMonth; $i++ ){ ?>
<?php if(($i+$offset)%7 < .2 && ($i+$offset)%7 > 0): ?><tr><?php endif; ?>
                <td class="old"><?php echo($i); ?></td>
<?php } ?>

<?php for( $i=1; $i<=$daysInMonth; $i++ ){ ?>

<?php if(($i+$offset)%7 < .2 && ($i+$offset)%7 > 0): ?><tr><?php endif; ?>

<?php
if($i<10) $presently = $year."-".$month."-0".$i;
else $presently = $year."-".$month."-".$i;
?>

<?php if($today==$presently): ?>
                <td class="today"><div class="day-number"><?php echo($i); ?></div>
<?php else: ?>
                <td><div class="day-number"><?php echo($i); ?></div>
<?php endif; ?>


<?php foreach( $events as $event ){ ?>
<?php if( $presently == $event["date"] ): ?>
                    <div class="event">
                        <a href="/node/<?php echo($event["url"]); ?>">
<?php
$eventTime = substr($event["time"],0,2);
$eventTime = intval($eventTime)-12;
#$return .= "<span class=\"event-time\">".$eventTime."pm</span>\n";
?>
<?php if($event["img"]): ?>
                            <img src="<?php echo(image_style_url("thumbnail",$event["img"])); ?>" alt=""/>
<?php endif; ?>

                            <span><?php echo($event["title"]); ?></span>
                        </a>
<?php
        #if( $event["content"] != "" )
        #    $return .= "<div class=\"event-details\">".$event["content"]."</div>\n";
?>
                    </div>
<?php endif; ?>
<?php } ?>
                </td>

<?php if(($i+$offset)%7==0): ?></tr><?php endif; ?>

<?php } ?>




<?php
$dayTotal = 35;
if( ($daysInMonth+$offset) > $dayTotal ) $dayTotal = 42;
$remainingDays = $dayTotal-($daysInMonth+$offset);
?>

<?php for( $i=1; $i<=$remainingDays; $i++ ){ ?>
<?php if($i%7 < .2 && $i%7 > 0):?>
                <tr>
    <?php endif; ?>
                    <td class="old"><?php echo($i); ?></td>
<?php if($i%7 == 0): ?>
                </tr>
<?php endif; ?>
<?php } ?>




            </tbody>
        </table>
    </div><!--END #this-month-->

</section>
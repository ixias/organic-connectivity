BEGIN:VCALENDAR
VERSION:2.0
PRODID:-//Orgnsm.org//Organic Connectivity Event List//EN
CALSCALE:GREGORIAN
METHOD:PUBLISH
<?php foreach($events as $event): ?>
BEGIN:VEVENT
SUMMARY:<?php echo($event->title."\n"); ?>
UID:<?php echo(date('Y-m-d-u',$event->created)); ?>@orgnsm.org
<?php #SEQUENCE:0 ?>
<?php #STATUS:CONFIRMED ?>
<?php #TRANSP:TRANSPARENT ?>
<?php #RRULE:FREQ=YEARLY;INTERVAL=1;BYMONTH=2;BYMONTHDAY=12 ?>
DTSTART:<?php echo(date('Ymd',$event->created)."\n"); ?>
DTEND:<?php echo(date('Ymd',$event->created)."\n"); ?>
DTSTAMP:<?php echo(date('Ymd',$event->created).'T'.date('u',$event->created)."\n"); ?>
<?php #CATEGORIES:U.S. Presidents,Civil War People ?>
LOCATION:<?php if(isset($event->field_location[LANGUAGE_NONE])){echo($event->field_location[LANGUAGE_NONE][0]['value']);}echo("\n"); ?>
<?php #GEO:37.5739497;-85.7399606 ?>
<?php
$body='';
if(!empty($event->body[LANGUAGE_NONE])){
    $body=strip_tags($event->body[LANGUAGE_NONE][0]['value']);
    $body=preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n",$body);
    $body=substr($body,0,155).'...';
}
?>
DESCRIPTION:<?php echo($body."\n"); ?>
<?php #URL:http://americanhistorycalendar.com/peoplecalendar/1,328-abraham-lincoln ?>
END:VEVENT
<?php endforeach; ?>
END:VCALENDAR
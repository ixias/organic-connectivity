
<div class="options start-date">
<?php if($show_start_year_chooser): ?>
<h3>Start date</h3>
<ul>
    <li class="selected" style="background:magenta;">After Christ (Era Vulgaris)</li>
    <li>New Aeon</li>
</ul>
<?php endif; ?>
</div>

<section id="calenderical">
    <!--div class="subtitle"><span class="subtitle">Calendar</span>Gregorian monthly</div-->

    <ul>
<?php foreach($monthCounts as $year=>$months){ ?>
<?php if($year!='total'): ?>


<?php
$percentage=round(($months['total']/$monthCounts['total'])*100);

#$users_age=32;

if($percentage<2) $popularityCategory=0;
elseif($percentage>=2 && $percentage<4) $popularityCategory=1;
elseif($percentage>=4 && $percentage<7) $popularityCategory=2;
elseif($percentage>=7 && $percentage<10) $popularityCategory=3;
elseif($percentage>=10) $popularityCategory=4;

/*if($months['total']<5) $popularityCategory=0;
elseif($months['total']>=5 && $months['total']<15) $popularityCategory=1;
elseif($months['total']>=15 && $months['total']<35) $popularityCategory=2;
elseif($months['total']>=35 && $months['total']<60) $popularityCategory=3;
elseif($months['total']>=60) $popularityCategory=4;*/

?>

        <li class="tag-category-<?php echo($popularityCategory); ?>">
            <h3>
                <a href="/items/calendar/<?php echo($year); ?>">
                    <?php echo($year); ?>
                    <?php echo('<span>'.$months['total'].'<span>'.$percentage.'%</span></span>'); ?>
                </a>
            </h3>
            <?php if($show_months) echo organic_calendar_date_display_months_list($year,$months); ?>
        </li>
<?php endif; ?>
<?php } ?>

    </ul>
    <div class="subtitle"><?php echo('Total Posts<span class="subtitle">'.$monthCounts['total']); ?></span></div>
</section>

<?php


// code for determining first Monday of the week
//date_default_timezone_set('Europe/London');


date_default_timezone_set('UTC');
$today = time()+86400;
echo $today;
$weekStartDate = date('l, F d, Y',strtotime("last Monday", $today));



//$weekStartDate = date('l, F d, Y',strtotime("last Monday", $today));


/*
$weekdays = array(date('l, d M Y',strtotime("last Monday", $today)),date('l, d M Y', strtotime('+1 days', strtotime($weekStartDate))),date('l, d M Y', strtotime('+2 days', strtotime($weekStartDate))),date('l, d M Y', strtotime('+3 days', strtotime($weekStartDate))),date('l, d M Y', strtotime('+4 days', strtotime($weekStartDate))));
*/


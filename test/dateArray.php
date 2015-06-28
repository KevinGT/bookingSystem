<?php

// code for determining first Monday of the week
//date_default_timezone_set('Europe/London');
date_default_timezone_set('UTC');
$today = time();
$weekStartDate = date('l, F d, Y',strtotime("last Monday", $today));
//$weekStartDate = date('l, F d, Y',strtotime("last Monday", $today));

// array for weekdays with date

$i=0;
$mon=0;
$secondsInWeek=604800;
$weekdays[0] = $weekStartDate;
//echo $weekdays[0]."<br />";

	while($mon<1){
		for($i=0;$i<5;$i++){
			$weekdays = array();
			$weekdays[$i] = date('l, d M Y', strtotime('+'.$i.' days', strtotime($weekStartDate)));
			//$weekdays[$mon] = $weekStartDate;
			echo $weekdays[$i]."<br />";
			}
				$weekStartDate = date('l, F d, Y',strtotime("next Monday", $today));
				$today = time()+$secondsInWeek;
				$secondsInWeek=$secondsInWeek+604800;
				$mon++;
				echo "<hr />";
				//echo $weekStartDate."<br />";
				}

print_r ($weekdays);
//var_dump($weekdays);
?>
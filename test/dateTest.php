<?php
/* create the days of the week */

date_default_timezone_set('Europe/London');
$today = time();

/*
$weekStartDate = date('l, F d, Y',strtotime("last Monday", $today));
$weekTuesDate = date('l, F d, Y', strtotime('+1 days', strtotime($weekStartDate)));
$weekWedDate = date('l, F d, Y', strtotime('+2 days', strtotime($weekStartDate)));
$weekThursDate = date('l, F d, Y', strtotime('+3 days', strtotime($weekStartDate)));
$weekFriDate = date('l, F d, Y', strtotime('+4 days', strtotime($weekStartDate)));
$weekSatDate = date('l, F d, Y', strtotime('+5 days', strtotime($weekStartDate)));
$weekSunDate = date('l, F d, Y', strtotime('+6 days', strtotime($weekStartDate)));


echo $weekStartDate."<br />";
echo $weekTuesDate."<br />";
echo $weekWedDate."<br />";
echo $weekThursDate."<br />";
echo $weekFriDate."<br />";
echo $weekSatDate."<br />";
echo $weekSunDate."<br />";
*/

$secondsInWeek=604800;

$i=0;
	$weekStartDate = date('l, F d, Y',strtotime("last Monday", $today));
while($i<4){

	$weekTuesDate = date('l, F d, Y', strtotime('+1 days', strtotime($weekStartDate)));
	$weekWedDate = date('l, F d, Y', strtotime('+2 days', strtotime($weekStartDate)));
	$weekThursDate = date('l, F d, Y', strtotime('+3 days', strtotime($weekStartDate)));
	$weekFriDate = date('l, F d, Y', strtotime('+4 days', strtotime($weekStartDate)));
	$weekSatDate = date('l, F d, Y', strtotime('+5 days', strtotime($weekStartDate)));
	$weekSunDate = date('l, F d, Y', strtotime('+6 days', strtotime($weekStartDate)));


	echo "<hr />";
	echo $weekStartDate."<br />";
	echo $weekTuesDate."<br />";
	echo $weekWedDate."<br />";
	echo $weekThursDate."<br />";
	echo $weekFriDate."<br />";

	$weekStartDate = date('l, F d, Y',strtotime("next Monday", $today));
	$today = time()+$secondsInWeek;
	$secondsInWeek=$secondsInWeek+604800;

	$i++;
	}



?>
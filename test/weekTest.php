<?php

date_default_timezone_set('UTC');
$today = time()+86400;

$weekStartDate = date('d/m/y', strtotime("last Monday", $today));

/*
if($today=){

}
*/
echo $weekStartDate;






?>
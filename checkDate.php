<?php

// checkdate.php

include_once('php_include/connection.php'); 

$requested_time = $_POST['time'];
//$requested_day = $_POST['day'];
$newDate = $_POST['mydate'];

echo $requested_time."<br />";
//echo $requested_day."<br />";
echo $newDate."<br /><br />";

$userid = rand(1,10000);// this is just into create a user id before login id's are created
echo $userid."<br /><br />";

/*
if($requested_time="" && $newDate=""){
	echo "<p>You did not select a time and date. Please re-enter your selected time and date by clicking <a href='calendarViewCorrect.php'>here</a></p>";
	exit();
}
*/



$check = $db->query('SELECT * FROM bookings WHERE dateOfBooking ="' . $newDate . '" AND timeOfBooking ="' . $requested_time .'"');
$row_count = $check->rowCount();
echo "Row count is: ".$row_count."<br />";

if($row_count>0) {
	echo "<p>Sadly that date has already been booked. Please re-enter your selected time and date by clicking <a href='calendarViewCorrect.php'>here</a></p><br />";
	} else {
			$insert_booking = $db->exec("INSERT INTO `bookings`(`userId`,`dateOfBooking`,`timeOfBooking`) VALUES ($userid,'{$_POST['mydate']}',$requested_time)");
			//"INSERT INTO `bookings`(`bookingId`,`userId`,`dateOfBooking`,`timeOfBooking`,`timeBookingMade`) VALUES ([$userID],[$newDate],[$requested_time],[$time])";
			echo "<p>Your booking has been received</p>";
	}

echo "<p>You will be redirected to the Calendar view page shortly</p>";
echo "<p>If not please click <a href='calendarViewCorrect.php'>here</a> to return to the calendar view</p>";
?>












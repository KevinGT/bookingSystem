<!DOCTYPE html>
<html>

<?php
include_once('php_include/connection.php'); 
//include_once('date_time.php');
?>

<head>
  <meta charset="UTF-8">
  <title></title>
  <link href="css/tableview.css" rel="stylesheet" media="all" />

  <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <script>
  function start_calendar_view(){
      // Create our XMLHttpRequest object
      var hr = new XMLHttpRequest();
      // Create some variables we need to send to our PHP file
      var url = "calendar_start.php";
      var now = new Date().getTime(); // today
      var extraDay = 1000*60*60*24; // number of milliseconds in a day
      var tomorrow = now + extraDay; // date for tomorrow
      weekstart = tomorrow; // this is to make it a global variable
      var vars = "weekstart="+weekstart;

      hr.open("POST", url, true);
      hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

      hr.onreadystatechange = function() {
        if(hr.readyState == 4 && hr.status == 200) {
          var return_data = hr.responseText;
        document.getElementById("calendar_view").innerHTML = return_data;
        }
      }
      hr.send(vars); // Actually execute the request
      document.getElementById("calendar_view").innerHTML = "processing...";
  }
  </script>
  <script>
  function next_week() {
    var hr = new XMLHttpRequest();
    var url = "calendar_start.php";
    var weekinmilliseconds = 1000*60*60*24*7;// a week in milliseconds
    var now = weekstart + weekinmilliseconds;// previous weekstart added to an extra week to provide the next weekstart date :)
    weekstart = now;
    var vars = "weekstart="+weekstart;
    hr.open("POST", url, true);
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    hr.onreadystatechange = function() {
      if(hr.readyState == 4 && hr.status == 200) {
        var return_data = hr.responseText;
          document.getElementById("calendar_view").innerHTML = return_data;
      }
    }
    hr.send(vars); // this function kicks off the request and code above
    //document.getElementById("calendar_view").innerHTML = "processing...";
  }
  </script>
  <script>
  function prev_week() {
    var hr = new XMLHttpRequest();
    var url = "calendar_start.php";
    var weekinmilliseconds = 1000*60*60*24*7;// a week in milliseconds
    var now = weekstart - weekinmilliseconds;// previous weekstart added to an extra week to provide the next weekstart date :)
    weekstart = now;
    var vars = "weekstart="+weekstart;
    hr.open("POST", url, true);
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    hr.onreadystatechange = function() {
      if(hr.readyState == 4 && hr.status == 200) {
        var return_data = hr.responseText;
          document.getElementById("calendar_view").innerHTML = return_data;
      }
    }
    hr.send(vars); // this function kicks off the request and code above
    //document.getElementById("calendar_view").innerHTML = "processing...";
  }
  </script>
  <?php include_once("page_header.php"); ?>
</head>
<!-- THIS IS THE CALENDAR VIEW -->
<!-- <?php /*include ('calendar_start.php');*/ ?> -->
<body onLoad="start_calendar_view();">

<div id="calendar_view"></div> 

<!-- THIS IS THE SELECT BOX SECTION -->
<div id="timeSelection">


  <!-- drop down selectable options begin here -->
	<form name="selectedDate" action="checkDate.php" method="post">
    <!-- WHY DO I NEED THIS LINE BELOW ************************ -->
    <input type="hidden" value="makes_it_work" /> 

  <p>Please select the time of your requested appointment</p>
  <select name="time">
    <?php
    foreach($db->query('SELECT * FROM timelist') as $row) {
      $timelistid = $row['id'];
      $timeslot = $row['timeslot'];
      $elementId = $row['elementid'];
      echo "<option value='" . $elementId ."'>" . $timeslot . "</option>";
    }
    ?>
  </select>
<!--
	<p>Please select the day of your requested appointment</p>
	<select name="day">
    <?php /*
    // How does that loop through the dates and then hit the relevant cell id?
    foreach($weekdays as $day) {
    $dayid=0;
    echo "<option value='" . $day . "'>" . $day . "</option>";
    $i++;
    }
*/
    ?>
	</select>
-->
	<br />
  <p>Date Request</p>
  <input type="date" name="mydate" />
  <br /><br />
	<input type="submit" value="Submit" name="request_booking" />

	<form>
	<br /><br /><hr /><br />

	<a href="#">Please click here to return to the homepage</a>
</div>

<div class="empty"></div>

</body>
</html>
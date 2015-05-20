<?php

include('php_include/connection.php');

date_default_timezone_set('UTC');
$today = round($_POST['weekstart']/1000);
//echo $today."<br />";
//echo date('l, F d, Y',$today)."<br />";

date_default_timezone_set('Europe/London');
//$today = time()+86400;
//echo date('l, d F Y',strtotime('last Monday', $today));

//$today = time()+86400;
$weekStartDate = date('l, F d, Y',strtotime('last Monday', $today));

$weekdays = array(date('D, d M Y',strtotime('last Monday', $today)),date('D, d M Y', strtotime('+1 days', strtotime($weekStartDate))),date('D, d M Y', strtotime('+2 days', strtotime($weekStartDate))),date('D, d M Y', strtotime('+3 days', strtotime($weekStartDate))),date('D, d M Y', strtotime('+4 days', strtotime($weekStartDate))));

$weekdayElementId = array(date('d-m-y',strtotime('last Monday', $today)),date('d-m-y', strtotime('+1 days', strtotime($weekStartDate))),date('d-m-y', strtotime('+2 days', strtotime($weekStartDate))),date('d-m-y', strtotime('+3 days', strtotime($weekStartDate))),date('d-m-y', strtotime('+4 days', strtotime($weekStartDate))));

echo "<!-- head section with buttons and title -->";
echo "<div id='previous'><input class='top_buttons' type='button' name='MyBtn' value='Previous Week' onclick='javascript:prev_week()'/></div>";
echo "<div id='current'><h2>Week commencing - ".date('l, d F Y',strtotime('last Monday', $today))."</h2></div>";
echo "<div id='next'><input class='top_buttons' type='button' name='MyBtn' value='Next Week' onclick='javascript:next_week()'/></div>";
echo "<div class='clear'>&nbsp</div>";

echo "<!-- main div -->";
echo "<div id='main'>";
echo "<p class='today'>Today is - <strong>".date('l, d M Y');
echo "</strong></p>\n";

echo "<p>Please select an open time slot from the drop down box beneath the calendar view.</p>";
echo "<span id='status'></span>";

// +++++++++++++++++++++++ TABLE ++++++++++++++++++++++++++++++++
// table header
echo "<div class='tableMain'>";

  echo "<table>";
  echo "<tr>";
  echo "<th>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</th>";
  $i;
  for($i=0;$i<5;$i++){
    echo "<th>" . $weekdays[$i] . "</th>";
  }
  echo "</tr>";
  echo "</table>";

$timeid=0;

while($timeid<18) {
  foreach($db->query('SELECT * FROM timelist') as $row) {
    $timeid = $row['id'];
    $timeslot = $row['timeslot'];
    $elementId = $row['elementid'];
    //echo "<table class='tabledata'>";
    echo "<table>";
    //echo "<tr>";
    echo "<td>$timeslot</td>";
    //echo "<td id='".$timeid . $dayid."'>$timeid . $dayid</td>";
    //echo "</tr>";

    for($i=0;$i<5;$i++){
      //echo "<tr>";
      echo "<td id='$elementId$weekdayElementId[$i]'></td>";
      /* The line below is left in to show how to exhibit the cell id
      echo "<td id='$elementId$weekdayElementId[$i]'>$elementId$weekdayElementId[$i]</td>"; */
      //echo "</tr>";
      }
      echo "</table>";
      }
    }

    echo "<div class='clear'></div>";

// DO A WHILE LOOP BEFORE THIS SO THAT THE ROWS PRINT OUT WHILE $DAYID = 1 THEN AGAIN WHILE $DAYID = 2 and so on

// The above may work as i should with some thought be able to target the the table cells. its just a case of whether they work like that.

// I WONDER IF JQUERY CAN TARGET THOSE CELLS


?>
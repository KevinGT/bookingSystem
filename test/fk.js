var url = "calendar_start.php";
var now = new Date().getTime(); // today
var extraDay = 1000*60*60*24; // number of milliseconds in a day
var tomorrow = now + extraDay; // date for tomorrow
var tomorrow = tomorrow/1000;

console.log(tomorrow);

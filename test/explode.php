<?php

$sentence = "pizza1 pizza2 pizza3 pizza4";

$explode = explode(" ", $sentence);

echo $explode[0];
echo $explode[1];
echo $explode[2];
echo $explode[3];

?>


<?php
// What is the best way to loop through string and insert into mysql column?


$item_value = 'itemOne,itemTwo,itemThree';
$item_array = explode(",",$item_value);

foreach($item_array as $key => $value){
    // insert into the db here
    $query = "INSERT INTO table_name set item_value = '".mysql_real_escape_string($value)."', ID = '".($key + 1)."'";
    // however you choose to connect and insert into the database goes here :)
}
?>





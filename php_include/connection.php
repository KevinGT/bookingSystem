<?php

$username="root";
$password="";

try {
	$db = new PDO('mysql:host=localhost;dbname=dental;charset=utf8',
	$username,
	$password
);
    $db->query("SET NAMES 'utf8'");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "A connection was made <br />";
}
catch(PDOException $e) {
	echo "An error occured. Could not connect!<br />";
    error_log($e->getMessage());
    die("A database error was encountered -> " . $e->getMessage() );
}

/*

$db_connection = mysqli_connect("localhost","root","","dental");
// confirm connection
if($db_connection) {
	echo "connection was made <br />";
} else {
	if (mysqli_connect_errno()) { // returns the error code from the last connect call
    echo mysqli_connect_error(); // returns a string connection error if there happens to be one
    echo "connection not made <br />";
    exit();
    }
}

*/
// php.net/manual/en/faq.passwords.php
?>

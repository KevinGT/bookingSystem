<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="css/registration.css">

<script>

</script>
</head>

<body>
<?php include_once("page_header.php"); ?>
<div id="main">
	<form>
		<br /><label class="labelwidth" for="email">Email:</label>
		<input type="text">
		<br /><label class="labelwidth" for="password1">Password:</label>
		<input type="text">
		<br /><br /><button id="loginbtn" onclick="login()">Login</button>
	</form>

	<p>Please click <a href="index.php">here</a> to return to the homepage</p>
</div>


</body>
</html>
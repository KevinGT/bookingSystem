
<?php
session_start();
// If user is logged in, header them away
if(isset($_SESSION["username"])){
  header("location: message.php?msg=NO to that weenis");
    exit();
}
?><?php
// Ajax calls this NAME CHECK code to execute
if(isset($_POST["usernamecheck"])){
  include_once("php_include/connection1.php");
  $isset = $_POST["usernamecheck"];
  $username = preg_replace('#[^a-z0-9]#i', '', $_POST['usernamecheck']);
  $sql = "SELECT member_id FROM members WHERE username='$username' LIMIT 1";
    $query = mysqli_query($db_conx, $sql); 
    $uname_check = mysqli_num_rows($query);
    if (strlen($username) < 3 || strlen($username) > 16) {
      echo '<strong style="color:#F00;">3 - 16 characters please</strong>';
      exit();
    }
  if (is_numeric($username[0])) {
      echo '<strong style="color:#F00;">Usernames must begin with a letter</strong>';
      exit();
    }
    if ($uname_check < 1) {
      echo '<strong style="color:#009900;">The username ' . $username . ' is OK</strong>';
      exit();
    } else {
      echo '<strong style="color:#F00;">The username ' . $username . ' is taken</strong>';
      exit();
    }
}
?><?php
// Ajax calls this REGISTRATION code to execute
if(isset($_POST["u"])){
  // CONNECT TO THE DATABASE
  include_once("php_include/connection1.php");
  // GATHER THE POSTED DATA INTO LOCAL VARIABLES
  $fn = preg_replace('#[^a-z0-9]#i', '', $_POST['fn']);
  $ln = preg_replace('#[^a-z0-9]#i', '', $_POST['ln']);
  $u = preg_replace('#[^a-z0-9]#i', '', $_POST['u']);
  $e = mysqli_real_escape_string($db_conx, $_POST['e']);
  $p = $_POST['p'];
  //$g = preg_replace('#[^a-z]#', '', $_POST['g']);
  //$c = preg_replace('#[^a-z ]#i', '', $_POST['c']);
  // GET USER IP ADDRESS
    //$ip = preg_replace('#[^0-9.]#', '', getenv('REMOTE_ADDR'));
  // DUPLICATE DATA CHECKS FOR USERNAME AND EMAIL
  $sql = "SELECT member_id FROM members WHERE username='$u' LIMIT 1";
  $query = mysqli_query($db_conx, $sql); 
  $u_check = mysqli_num_rows($query);
  // -------------------------------------------
  $sql = "SELECT member_id FROM members WHERE email='$e' LIMIT 1";
    $query = mysqli_query($db_conx, $sql); 
  $e_check = mysqli_num_rows($query);
  // FORM DATA ERROR HANDLING
  if($fn == "" || $ln == "" || $u == "" || $e == "" || $p == ""){
    echo "The form submission is missing values.";
        exit();
  } else if ($u_check > 0){ 
        echo "The username you entered is already taken";
        exit();
  } else if ($e_check > 0){ 
        echo "That email address is already in use in the system";
        exit();
  } else if (strlen($u) < 3 || strlen($u) > 16) {
        echo "Username must be between 3 and 16 characters";
        exit(); 
    } else if (is_numeric($u[0])) {
        echo 'Username cannot begin with a number';
        exit();
    } else {
  // END FORM DATA ERROR HANDLING
      // Begin Insertion of data into the database
    // Hash the password and apply your own mysterious unique salt
    $cryptpass = crypt($p);
    //include_once ("php_includes/randStrGen.php");
    $p_hash = $cryptpass;
    // Add user info into the database table for the main site table

    $sql = "INSERT INTO members (firstname, lastname,username, email, password)       
            VALUES('$fn','$ln','$u','$e','$p_hash')";

    //$sql = "INSERT INTO members (username, email, password, gender, country, ip, signup, lastlogin, notescheck) VALUES('$u','$e','$p_hash','$g','$c','$ip',now(),now(),now())";
    $query = mysqli_query($db_conx, $sql); 
    $uid = mysqli_insert_id($db_conx);
    // Establish their row in the useroptions table
    $sql = "INSERT INTO useroptions (id, username, background) VALUES ('$uid','$u','original')";
    $query = mysqli_query($db_conx, $sql);
    // Create directory(folder) to hold each user's files(pics, MP3s, etc.)
    if (!file_exists("user/$u")) {
      mkdir("user/$u", 0755);
    }
    // Email the user their activation link
    $to = "$e";              
    $from = "DO_NOT_REPLY@kgtdev.com";
    $subject = 'Booking System Account Activation';
    $message = '<!DOCTYPE html><html><head><meta charset="UTF-8"><title>yoursitename Message</title></head><body style="margin:0px; font-family:Tahoma, Geneva, sans-serif;"><div style="padding:10px; background:#333; font-size:24px; color:#CCC;"><a href="http://www.kgtdev.com"><img src="http://www.kgtdev.com/dental/images/kgtdevlogoresized.jpg" width="36" height="30" alt="kgtdev.com" style="border:none; float:left;"></a>Booking System Account Activation</div><div style="padding:24px; font-size:17px;">Hello '.$u.',<br /><br />Click the link below to activate your account when ready:<br /><br /><a href="http://www.kgtdev.com/activation.php?id='.$uid.'&u='.$u.'&e='.$e.'&p">Click here to activate your account now</a><br /><br />Login after successful activation using your:<br />* E-mail Address: <b>'.$e.'</b></div></body></html>';
    $headers = "From: $from\n";
        $headers .= "MIME-Version: 1.0\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1\n";
    mail($to, $subject, $message, $headers);
    echo "signup_success";
    exit();
  }
  exit();
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="css/registration.css">
<script src="js/main.js"></script>
<script src="js/ajax.js"></script>

<script>
// Regular Expressions used to check chars going into email & username
function restrict(elem){
  var tf = _(elem);
  var rx = new RegExp;
  if(elem == "email"){
    rx = /[' "]/gi;
  } else if(elem == "username"){
    rx = /[^a-z0-9]/gi;
  } else if(elem == "firstname"){
    rx = /[^a-z0-9]/gi;
  } else if(elem == "lastname"){
    rx = /[^a-z0-9]/gi;
  } 
  tf.value = tf.value.replace(rx, "");
}
// function to empty the didv at the bottomg of the page when the user interacts with the email field
function emptyElement(x){
  _(x).innerHTML = "";
}
// ajax request to check username is available and meet criteria as it's typed in.
function checkusername(){
  var u = _("username").value;
  if(u != ""){
    _("unamestatus").innerHTML = 'checking ...';
    var ajax = ajaxObj("POST", "registration_page.php");
        ajax.onreadystatechange = function() {
          if(ajaxReturn(ajax) == true) {
              _("unamestatus").innerHTML = ajax.responseText;
          }
        }
        ajax.send("usernamecheck="+u);
  }
}
function signup(){
  var fn = _("firstname").value;
  var ln = _("lastname").value;
  var u = _("username").value;
  var e = _("email").value;
  var p1 = _("pass1").value;
  var p2 = _("pass2").value;
  //var c = _("country").value;
  //var g = _("gender").value;
  var status = _("status");
  if(fn == "" || ln == "" || u == "" || e == "" || p1 == "" || p2 == ""){
    status.innerHTML = "Please fill out all of the form data";
  } else if(p1 != p2){
    status.innerHTML = "Your password fields do not match";
  } else {
    _("registerbtn").style.display = "none";
    status.innerHTML = 'please wait ...';
    var ajax = ajaxObj("POST", "registration_page.php");
        ajax.onreadystatechange = function() {
          if(ajaxReturn(ajax) == true) {
              if(ajax.responseText != "signup_success"){
          status.innerHTML = ajax.responseText;
          _("registerbtn").style.display = "block";
        } else {
          window.scrollTo(0,0);
          _("registration_form").innerHTML = "OK "+u+", check your email inbox and junk mail box at <u>"+e+"</u> in a moment to complete the sign up process by activating your account. You will not be able to do anything on the site until you successfully activate your account.";
        }
          }
        }
        ajax.send("fn="+fn+"&ln="+ln+"&u="+u+"&e="+e+"&p="+p1);
  }
}
function openTerms(){
  _("terms").style.display = "block";
  emptyElement("status");
}
/* function addEvents(){
  _("elemID").addEventListener("click", func, false);
}
window.onload = addEvents; */
</script>
</head>

<body>

<?php include_once("page_header.php"); ?>

<!--
  JAVASCRIPT FUNCTIONS in the form below

  onblur() is when the user stops interating with an element and goes to another element on the page
    in this case onblur() calls the checkusername() function
  onkeyup() everytime they release a key it fires off to the restrict('') function to check that the contents of the field are allowed through RegExp - regualar expressions
    check the restrict() function above to see how it calls the the PHP
  onfocus() is when the user interacts with the element, so in this case emptyElement() function 
    which is a bespoke function that clears the element, in this case the status <span> underneath the form fields
-->

<div id="main">
	<h3>Please fill out and submit your data using the empty fields below.</h3>

	<form id="registration_form" name="registration_form" onsubmit="return false;">
		
			<br /><label class="labelwidth" for="firstname">First Name:</label>
			<input type="text" id="firstname" onkeyup="restrict('firstname')" maxlength="16">
      
      <br /><label class="labelwidth" for="lastname">Last Name:</label>
      <input type="text" id="lastname" onkeyup="restrict('lastname')" maxlength="16">

			<br /><label class="labelwidth" for="username">Username:</label>
			<input type="text" id="username" onblur="checkusername()" onkeyup="restrict('username')" maxlength="16">
      <span id="unamestatus"></span>

			<br /><label class="labelwidth" for="email">Email:</label>
			<input type="text" id="email" onfocus="emptyElement('status')" onkeyup="restrict('email')" maxlength="88">
      <span id="emailstatus"></span>

			<br /><label class="labelwidth" for="pass1">Password:</label>
			<input type="password" id="pass1" onfocus="emptyElement('loginissue')" maxlength="16">

			<br /><label class="labelwidth" for="pass2">Re-type password:</label>
			<input type="password" id="pass2" onfocus="emptyElement('loginissue')" maxlength="16">
      <span id="password_match"></span>
			
      <br /><br /><div id="status"></div>

			<br /><button id="registerbtn" onclick="signup()">Register</button>

	</form>
	<br />
	<p>Please click <a href="index.php">here</a> to return to the homepage</p>
</div>

</body>
</html>
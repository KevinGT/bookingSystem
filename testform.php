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
    var ajax = ajaxObj("POST", "usernamecheck.php");
        ajax.onreadystatechange = function() {
          if(ajaxReturn(ajax) == true) {
              _("unamestatus").innerHTML = ajax.responseText;
          }
        }
        ajax.send("usernamecheck="+u);
  }
}
</script>
</head>

<body>

	<form id="registration_form" name="registration_form" onsubmit="return false;">

		<br /><label class="labelwidth" for="username">Username:</label>
		<input type="text" id="username" onblur="checkusername()" onkeyup="restrict('username')" maxlength="16">
		<span id="unamestatus"></span>

		<br /><br /><div id="status"></div>

		<br /><button id="registerbtn" onclick="signup()">Register</button>

	</form>

</body>
</html>
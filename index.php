<?php
session_start();
include_once 'connect.php';

if(isset($_SESSION['user'])!="")
{
 header("Location:home.php");
}
if(isset($_POST['btn-login']))
{
 $uname = mysql_real_escape_string($_POST['uname']);
 $upass = mysql_real_escape_string($_POST['pass']);
 $res=mysql_query("SELECT * FROM users WHERE username='$uname'");
 $row=mysql_fetch_array($res);
 if($row['password']==md5($upass))
 {
  $_SESSION['user'] = $row['userId'];
  header("Location:home.php");
 }
 else
 {
  ?>
        <script>alert('wrong information');</script>
        <?php
 }
 
}
?>
<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Movie Project</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
</head>
<body>
<div class="tt">
	<h1>Movie Project</h3>
</div>

<center>
<div class="login-form">
<form method="post">
<table class="table" width="50%" border="0">
<tr>
<td><input type="text" name="uname" placeholder="Your Username" required /></td>
</tr>
<tr>
<td><input type="password" name="pass" placeholder="Your Password" required /></td>
</tr>
<tr>
<td><button type="submit" name="btn-login">Sign In</button></td>
</tr>
<tr>
<td><a href="register.php">Sign Up Here</a></td>
</tr>
</table>
</form>
</div>
</center>
</body>
</html>
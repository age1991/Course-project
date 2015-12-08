<!DOCTYPE html>
<head>
<title>Registration</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />

</head>
<body>
<center>
<div>
<form method="post">
<table class="table2" width="30%" border="0">
<tr>
<td><input type="text" name="uname" placeholder="User Name" required /></td>
</tr>
<tr>
<td><input type="password" name="pass" placeholder="Your Password" required /></td>
</tr>
<tr>
<td><textarea name="desc" rows="5" cols="40" placeholder="Tell me about yourself ..."></textarea></td>
</tr>
<tr>
<td><button type="submit" name="btn-signup">Sign Me Up</button></td>
</tr>
<tr>
<td><a href="index.php">Sign In Here</a></td>
</tr>
</table>
</form>
</div>
</center>
</body>
</html>

<?php
session_start();
if(isset($_SESSION['user'])!="")
{
	header("Location: home.php");
}
include_once 'connect.php';

if(isset($_POST['btn-signup']))
{
	$uname = mysql_real_escape_string($_POST['uname']);
	$upass = md5(mysql_real_escape_string($_POST['pass']));
	$des = mysql_real_escape_string($_POST['desc']);
	
	if(mysql_query("INSERT INTO users(username,password,description) VALUES('$uname','$upass','$des')"))
	{
		?>
        <script>alert('successfully registered ');</script>
        <?php
	}
	else
	{
		?>
        <script>alert('error while registering you...');</script>
        <?php
	}
}
?>
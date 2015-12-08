<?php
session_start();
include_once 'connect.php';

if(!isset($_SESSION['user']))
{
 header("Location: index.php");
}
$res=mysql_query("SELECT * FROM users WHERE userId=".$_SESSION['user']);
$userRow=mysql_fetch_array($res);
$uid=$_SESSION['user'];
$list=mysql_query("SELECT * FROM lists l,users u WHERE l.ownedBy = u.userId and u.userId=$uid");


?>


<!DOCTYPE html>
<html>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<link href='https://fonts.googleapis.com/css?family=Dancing+Script' rel='stylesheet' type='text/css'>
</head>
<body>
  <div class="search">
  	<a href="search.php"><button class="myButton">Search Movies!</button></a>
  </div>
  <div class="search">
  	<a href="searchlist.php"><button class="myButton">Search Lists!</button></a>
  </div>
  <div class="welcome">
     <p>Welcome <?php echo $userRow['username']; ?>&nbsp;</p><a href="logout.php?logout">Sign Out</a>
  </div>
  <div class="createlist">
  	<form method="post">
		<table width="30%" border="0">
		<tr>
		<td><input type="text" name="lname" placeholder="Name of your list" required /></td>
		</tr>
		<tr>
		<td><textarea name="desc" rows="5" cols="40" placeholder="What is this list about"></textarea></td>
		</tr>
		<tr>
		<td><button type="submit" name="btn-create">Create List!</button></td>
		</tr>
		</table>
		</form>
  </div>
  <div class="list">
  	<h2>Your lists:</h2>
  		<?php	
     		while($listinfo=mysql_fetch_array($list)) {
      ?>
      	<p id="listnamemid"><?php echo $listinfo["listName"]."<br>";?></p>
      	<p id="score"><?php echo "Score:".$listinfo["listScore"]."<br>";?></p>
        <P id="des"><?php echo "Description:".$listinfo["listDescription"]. "<br>";?></P>
        <p><?php echo 'Movie included: ';?></p>
			     <div class="Movieinclude">
					<?php
						$lid = $listinfo['listId'];
						$lisname = $listinfo['listName'];
						$mres = mysql_query("SELECT * FROM movies m,lists l WHERE m.includedBy = $lid and l.listName = '$lisname'");
						while($movieRow=mysql_fetch_array($mres)){
							?>
							<p>Movie Name: <?php echo $movieRow['name']; ?></p>
							<p>Date of Release: <?php echo $movieRow['releasedDate']; ?></p>
							<p>Movie Descirpition: <?php echo $movieRow['mdescription'];?></p>
						  <div class="poster">
						    <img src="http://image.tmdb.org/t/p/w500/<?php echo $movieRow['image']?>">
							</div>
	    <?php
		}

		?>

				</div>
				<p class="bottomb">End of the List.</p>
      <?php

     }

  	?>
  
  </div>
  <div class="delete">
	  <form method="post">
	  	<input type="text" name="dname" placeholder="Name of the list" required />
	  	<button type="submit" name="btn-delete">Delete List!</button>
	  </form>
  </div>
    </div>
  <div class="delete">
	  <form method="post">
	  	<input type="text" name="mvname" placeholder="Name of the movie" required />
	  	<input type="text" name="lsname" placeholder="Name of the list" required />
	  	<button type="submit" name="btn-deletem">Delete Movie from list!</button>
	  </form>
  </div>


</body>
</html>


<?php
if(isset($_POST['btn-create']))
{
	$lname = mysql_real_escape_string($_POST['lname']);
	$des = mysql_real_escape_string($_POST['desc']);
	
	if(mysql_query("INSERT INTO lists(listName,listDescription,ownedBy) VALUES('$lname','$des','$uid')"))
	{
		?>
        <script>alert('successfully Created!');</script>
        <?php
	}
	else
	{
		?>
        <script>alert('failed');</script>
        <?php
	}
}

if(isset($_POST['btn-delete']))
{
	$delt = mysql_real_escape_string($_POST['dname']);
	if(mysql_query("DELETE FROM lists WHERE listName='$delt'")){
		?>
			<script>alert('successfully Delete!');</script>
		<?php
	}
	else{
		?>
			<script>alert('failed')</script>
		<?php
	}
}
if(isset($_POST['btn-deletem']))
{
	$mvname = mysql_real_escape_string($_POST['mvname']);
	$lsname = mysql_real_escape_string($_POST['lsname']);
	if(mysql_query("DELETE m.* FROM movies m,lists l WHERE m.includedBy = l.listId and l.listName='$lsname' and m.name = '$mvname'")){
		?>
			<script>alert('successfully Delete!');</script>
		<?php
	}
	else{
		?>
			<script>alert('failed')</script>
		<?php
	}
}



?>





















<?php 
session_start();
include_once 'connect.php';
if(!isset($_SESSION['user']))
{
 header("Location: index.php");
}
if(isset($_POST['btn-search']))
{
	$lname = mysql_real_escape_string($_POST['lname']);
	$res = mysql_query("SELECT * FROM lists WHERE listName like '%$lname%' or listDescription like '%$lname%' ORDER BY listScore DESC");


}
if(isset($_POST['btn-grade']))
{	
	$uid=$_SESSION['user'];
	$grade = $_POST['grade'];
	$lstid = $_POST['lstid'];
	$graderes = mysql_query("SELECT * FROM lists WHERE listId = $lstid");
	$ori = mysql_fetch_array($graderes);
	$origin = $ori['listScore'];
	if (is_null($origin)) {
		if(mysql_query("UPDATE lists SET listScore = $grade WHERE listId = $lstid"))
		{	
			if (mysql_query("INSERT INTO grading(points,gradeBy,graded) VALUES('$grade','$uid','$lstid')")) {
				?>
		        <script>alert('Graded');</script>
		        <?php
	    	}
	    	else{
	    		?>
			        <script>alert('failed');</script>
			    <?php
	    	}
		}
		else
		{
			?>
	        <script>alert('failed');</script>
	        <?php
		}
		
	}
	
	else{
		
		if (mysql_query("INSERT INTO grading(points,gradeBy,graded) VALUES('$grade','$uid','$lstid')")) 
		{	
			$Gres = mysql_query("SELECT * FROM grading WHERE graded = $lstid");
			$garry = mysql_num_rows($Gres);
			$sum = mysql_query("SELECT SUM(points) AS smvalue  FROM grading WHERE graded = $lstid");
			$sumn = mysql_fetch_array($sum);
			$sumnu = $sumn['smvalue'];
			$gradenew = $sumnu/$garry;
			if(mysql_query("UPDATE lists SET listScore = $gradenew WHERE listId = $lstid"))
			 {
				?>
		        <script>alert('Graded');</script>
		        <?php
	    	}
	    	else{
	    		?>
			        <script>alert('failed');</script>
			    <?php
	    	}
		}
		else
		{
			?>
	        <script>alert('failed');</script>
	        <?php
		}



	}	
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Search lists</title>
	<link rel="stylesheet" href="css/style.css" type="text/css" />
</head>
<body>
<div class="home">
	<a href="home.php"><button class="myButton">Home Page</button></a>
</div>

<div class="searchMovie">
	<form method="post">
		<table width="50%" border="0">
		<tr>
		<td><input type="text" name="lname" placeholder="List name..." required /></td>
		</tr>
		<tr>
		<td><button type="submit" name="btn-search">Search Lists</button></td>
		</tr>
		</table>
	</form>
</div>
<div class="grading">
	<form method="post">
		<table width="30%" border="0">
		<tr>
		<td><input type="number" name="grade" min="1" max="10" placeholder="Grade 1~10" required /></td>
		</tr>
		<tr>
		<td><input type="number" name="lstid" placeholder="List ID" required /></td>
		</tr>
		<tr>
		<td><button type="submit" name="btn-grade">Grade the list</button></td>
		</tr>
		</table>
	</form>
</div>
<div class="listInfo">
<?php	
	if(isset($_POST['btn-search'])){
     while($listRow=mysql_fetch_array($res)) {

?>
	<h3 id="listnamemid"><?php echo $listRow['listName'];  ?></h3>
	<p>List ID: <?php echo $listRow['listId'] ?></p>
	<p><?php echo 'List Description: '.$listRow['listDescription'] ?></p>
	<p><?php echo 'Score: '.$listRow['listScore'] ?></p>
	<p><?php echo 'Movie included: ';?></p>
	<div class="Movieinclude">
		<?php
			$lid = $listRow['listId'];
			$lisname = $listRow['listName'];
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
 }
?>
</div>
</body>
</html>
<?php 
session_start();
include_once 'connect.php';
if(!isset($_SESSION['user']))
{
 header("Location: index.php");
}
if(isset($_POST['btn-search']))
{
	$mname = mysql_real_escape_string($_POST['mname']);
	$json = file_get_contents('https://api.themoviedb.org/3/search/movie?query='.urlencode($mname).'&api_key=31f0fba8d2633338717f73648477f95f'); 
	$json = utf8_encode($json);
	$data = json_decode($json, true); 
	$i = 0;
}


if(isset($_POST['btn-add']))
{
	$mname = mysql_real_escape_string($_POST['mname']);
	$json = file_get_contents('https://api.themoviedb.org/3/search/movie?query='.urlencode($mname).'&api_key=31f0fba8d2633338717f73648477f95f'); 
	$json = utf8_encode($json);
	$data = json_decode($json, true); 
	$i = 0;

	$uid=$_SESSION['user'];
	$mid = $_POST['mid'];
	$lisname = mysql_real_escape_string($_POST['lisname']);
	$nameOfm = mysql_real_escape_string($data['results'][$mid]['title']);
	$relDate = $data['results'][$mid]['release_date'];
	$desOfm = mysql_real_escape_string($data['results'][$mid]['overview']);
	$image = mysql_real_escape_string($data['results'][$mid]['poster_path']);

	$res = mysql_query("SELECT * FROM lists l,users u WHERE l.ownedBy = u.userId and u.userId=$uid and l.listName = '$lisname'");
	$row = mysql_fetch_array($res);
	$lid = $row['listId'];
	if(mysql_query("INSERT INTO movies(name,releasedDate,image,mdescription,includedBy) VALUES('$nameOfm','$relDate','$image','$desOfm','$lid')"))
		{
			?>
	        <script>alert('Added Successfully');</script>
	        <?php
		}
		else
		{
			?>
	        <script>alert('failed');</script>
	        <?php
		}

}




?>
<!DOCTYPE html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Search Movies</title>
	<link rel="stylesheet" href="css/style.css" type="text/css" />
</head>
<body>
<div class="home">
	<a href="home.php"><button class="myButton">Home Page</button></a>
</div>
<div class="addList">
	<form method="post">
	<table width="50%" border="0">
	<tr>
		<td><input type="text" name="mname" placeholder="What you just searched" required /></td>
	</tr>
	<tr>
	<td><input type="number" name="mid" placeholder="Movie Id" required /></td>
	</tr>
	<tr>
	<td><input type="text" name="lisname" placeholder="Your list's name" required /></td>
	</tr>
	<tr>
	<td><button type="submit" name="btn-add">Add Now!</button></td>
	</tr>
	</table>
	</form>
	
</div>
<div class="searchMovie">
	<form method="post">
		<table width="30%" border="0">
		<tr>
		<td><input type="text" name="mname" placeholder="Movie name..." required /></td>
		</tr>
		<tr>
		<td><button type="submit" name="btn-search">Search Movies</button></td>
		</tr>
		</table>
	</form>
</div>
<div class="searchResult">
<?php
if(isset($_POST['btn-add'])){
?>
<p id="remind"><?php echo "Results for '".$mname."':"; ?></p>
<?php
}
?>
<?php	
     	if(isset($_POST['btn-search'])){	
     		while($i < count($data['results']) ) {
      ?>
    <p>Id: <?php echo $i ?></p>
	<p>Movie Name: <?php echo $data['results'][$i]['title']; ?></p>
	<p>Date of Release: <?php echo $data['results'][$i]['release_date']; ?></p>
	<p>Movie Descirpition: <?php echo $data['results'][$i]['overview'];?></p>
    <div class="poster">
    <img src="http://image.tmdb.org/t/p/w500/<?php echo $data['results'][$i]['poster_path']?>">
	</div>
	

	<?php
	$i = $i + 1;
}
}
?>
	
</div>

</body>
</html>


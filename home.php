<?php 
	session_start(); 

	if (!isset($_SESSION['username'])) {
		$_SESSION['msg'] = "You must log in first";
		header('location: login.php');
	}

	if (isset($_GET['logout'])) {
		session_destroy();
		unset($_SESSION['username']);
		header("location: login.php");
	}
	//inserare imagine in baza de date
	if (isset($_POST['upload'])) {
		$target = "images/".basename($_FILES['image']['name']);
		$db = mysqli_connect("localhost","root", "", "db_homework");
		$image = $_FILES['image']['name'];
		$sql = "INSERT INTO images (image) VALUES ('$image')";
		mysqli_query($db,$sql);
	
		
		if(move_uploaded_file($_FILES['image']['tmp_name'],$target)) {
			$msg = "Image uploaded successfully";
		}else{
			$msg = "There was a problem uploading image";
		}
		echo $msg; //mesaj care se afiseaza cand apasam upload
	}



?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<style>
.topnav {
  overflow: hidden;
  background-color: #F8F8F;
}

.topnav a {
  float: left;
  color: #000000;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.topnav a:hover {
  background-color: #b9b7c4;
  color: black;
}

.topnav a.active {
  background-color: #1e85e6;
  color: white;
}
	</style>
</head>
<body>
	<div class="header">
		<h2>Home Page</h2>
	</div>
	<div class="content">

		<!--am sters mesajul de succes conexiune-->
		
		<!-- logged in user information 
		butoane de navigare-->
		
		<?php  if (isset($_SESSION['username'])) : ?>
			<div class="topnav">
			<a> <strong>Hello <?php echo $_SESSION['username']; ?> !</strong> </a>
  <a class="active" href="home.php">Home</a>
  <a href="add_image.php">Add image</a>
  <a href="home.php?logout='1'" style="color: red;">Logout</a>
</div>
		<?php endif ?>
		
		<div class="img">
		<!--afisare imagini-->
		<?php
			$db = mysqli_connect("localhost","root", "", "db_homework");
			$sql = "SELECT * FROM images";
			$result = mysqli_query($db, $sql);
			while($row = mysqli_fetch_array($result)){
				echo "<div id_ph='img_div'>";
					echo "<img src = 'images/".$row['image']."'><br>"; //pauza pt a nu fi pozele lipite
				echo "</div>";
			}
		?>
</div>
	</div>
		
</body>
</html>

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
		

?>
<!DOCTYPE html>
<html>
<head>
	<title>Add Image</title>
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
		<h2>Add Image Page</h2>
	</div>
	<div class="content">

		<!-- logged in user information -->
		<?php  if (isset($_SESSION['username'])) : ?>
			<div class="topnav">
			<a> <strong>Hello <?php echo $_SESSION['username']; ?> !</strong> </a>
  <a  href="home.php">Home</a>
  <a class="active" href="add_image.php">Add image</a>
  <a href="home.php?logout='1'" style="color: red;">Logout</a>
</div>
		<?php endif ?>
		
		<!--cautare imagine-->
		<form method="post" action = "home.php" enctype="multipart/form-data">
			<input type="hidden" name="size" value="1000000">
			<div>
				<input type="file" name="image">
				
			</div>
			<div>
				<input type="submit" name="upload" value="Upload Image">
			</div>
		</form>
	</div>
		
</body>
</html>
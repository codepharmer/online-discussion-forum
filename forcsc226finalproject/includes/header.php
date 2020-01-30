<?php
if(session_status() == "PHP_SESSION_NONE"){
	session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Final Project Website</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link href="css/sticky-footer-navbar.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-default navbar-fixed-top">
	<div class="container">
		<div class="navbar-header"><a class="navbar-brand" href="#">Nosson's Website</a></div>
		<div id="navbar" class="collapse navbar-collapse">
			<ul class="nav navbar-nav">
				<li class=""><a href="index.php">Home</a></li>
				<li><a href="searchBook.php">Search Book-O-Rama Database</a></li>
				<?php
				if(!(isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] == true))
					echo"<li><a href='userLogin.php'>Login</a></li>";
				else
					echo"<li><a href='userLogin.php'>Logout</a></li>";
				?>
				<li><a href="addPost.php">Add Post</a></li>
			</ul>
		</div>
	</div>
</nav>
<div class="container">
<!-- Script 3.2 - header.html -->
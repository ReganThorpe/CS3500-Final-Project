<?php
session_start();

$user = "team14user";
$pass = "This is fine";
$connStr = 'mysql:host=mysql.team14store.xyz;dbname=cs3500_storedb';

if (isset($_GET['logout'])) {
	unset($_SESSION['username']);
  unset($_SESSION['UID']);
}

try{
	$pdo = new PDO($connStr,$user, $pass);
	$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
}
catch(PDOException $e){
  	die($e->getMessage());
}

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Log In</title>
		<link type="text/css" rel="stylesheet" href="https://bootswatch.com/3/united/bootstrap.min.css"/>
		<link type="text/css" rel="stylesheet" href="all.css" />
		<link type="text/css" rel="stylesheet" href="login.css" />
  </head>
  <body>
    <?php include 'header.inc.php'; ?>
		<div class="container">
			<form class="login" action="login.php" method="post">
				<label>Username: </label>
				<input type="text" class="form-control" id="username" /><br />
				<label>Password: </label>
				<input type="password" class="form-control" id="pass1" /><br />
				<label>Verify Password: </label>
				<input type="password" class="form-control" id="pass2" /><br />
				<button type="submit" class="btn btn-primary">Login</button>
			</form><br />
		</div>
		<div class="container">
			<h5>Don't have an account? <a href="register.php">Sign up for free!</h5></p>
		</div>

    <?php include 'footer.inc.php'; ?>
  </body>
</html>

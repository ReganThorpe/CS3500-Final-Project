<?php
session_start();

$user = "team14user";
$password = "This is fine";
$connStr = 'mysql:host=mysql.team14store.xyz;dbname=cs3500_StoreDB';

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php include 'header'; ?>
		<form class="login" action="login.php" method="post">
			<label>Username: </label>
			<input type="text" class="form-control" id="username" />
			<label>Password: </label>
			<input type="password" class="form-control" id="pass1" />
			<label>Verify Password?: </label>
			<input type="password" class="form-control" id="pass2" />
			<button type="submit" class="btn btn-primary">Login</button>
		</form>

    <?php include 'footer.inc.php'; ?>
  </body>
</html>

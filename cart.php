<?php
session_start();

if (!$_SESSION['username']) {
  header('Location:landing.php');
  die();
}

$user = "team14user";
$pass = "This is fine";
$connStr = 'mysql:host=mysql.team14store.xyz;dbname=cs3500_storedb';

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
    <title></title>
    <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css"/>
    <link type="text/css" rel="stylesheet" href="css/all.css" />
    <link type="text/css" rel="stylesheet" href="css/cart.css" />
  </head>
  <body>
    <?php include 'header.inc.php'; ?>

    <?php include 'footer.inc.php'; ?>
  </body>
</html>

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
		<link type="text/css" rel="stylesheet" href="https://bootswatch.com/3/united/bootstrap.min.css"/>
		<link type="text/css" rel="stylesheet" href="all.css" />
		<link type="text/css" rel="stylesheet" href="product.css" />
  </head>
  <body>
    <?php include 'header'; ?>

    <?php include 'footer.inc.php'; ?>
  </body>
</html>

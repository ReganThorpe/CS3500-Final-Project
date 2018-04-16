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
    <title>Our Web Store</title>
    <link type="text/css" rel="stylesheet" href="https://bootswatch.com/3/united/bootstrap.min.css"/>
    <link type="text/css" rel="stylesheet" href="all.css" />
    <link type="text/css" rel="stylesheet" href="index.css" />
  </head>
  <body>
    <?php include 'header.inc.php'; ?>
    <p>
      This is type 3 for our <a href="https://cs3500wmu.000webhostapp.com/final_project_100.php">cs3500</a> project.<br />It is a shop for construction gear
    </p>
    <p>
      *Insert 3 wide grid here*
    </p>
    <?php include 'footer.inc.php'; ?>
  </body>
</html>

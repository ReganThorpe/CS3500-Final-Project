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
    <title>Our Web Store</title>
    <link type="text/css" rel="stylesheet" href="https://bootswatch.com/3/yeti/bootstrap.min.css"/>
    <link type="text/css" rel="stylesheet" href="css/all.css" />
    <link type="text/css" rel="stylesheet" href="css/index.css" />
  </head>
  <body>
    <?php include 'header.inc.php'; ?>
    <?php echo "Welcome ".$_SESSION['name']."!"; ?>
    <p>This is type 3 for our <a href="https://cs3500wmu.000webhostapp.com/final_project_100.php" target="_blank">
      cs3500</a> project.<br /></p>
      <?php
      echo "Here at Dmitri's Gasses, we sell elements, but only elements in a gasseous state";

      ?>
    <?php include 'footer.inc.php'; ?>
  </body>
</html>

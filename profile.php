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

  $sql = "SELECT * FROM User WHERE UID = ? ";

  $statement = $pdo->prepare($sql);
  $statement->bindValue(1, $_SESSION['UID']);
  $statement->execute();

  $profile = $statement->fetch();
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
    <link type="text/css" rel="stylesheet" href="css/index.css" />
  </head>
  <body>
    <?php include 'header.inc.php'; ?>
    <main>
      <div class="container">
        <?php
        echo "<h1>".$_SESSION['name']."'s Profile</h1>";
         ?>
      </div>
    </main>
    <?php include 'footer.inc.php'; ?>
  </body>
</html>

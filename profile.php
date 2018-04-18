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
    <link type="text/css" rel="stylesheet" href="https://bootswatch.com/3/yeti/bootstrap.min.css"/>
    <link type="text/css" rel="stylesheet" href="css/all.css" />
    <link type="text/css" rel="stylesheet" href="css/profile.css" />
  </head>
  <body>
    <?php include 'header.inc.php'; ?>
    <main>
      <div class="container">
        <?php
        echo "<h1>".$_SESSION['name']."'s Profile</h1>";
        echo "<h4>Email: ".$profile['Email']."</h4>";
        echo "<h4>Username: ".$profile['Username']."</h4>";
        echo "<h4>Webcoin Balance: ".$profile['GiftCardBalance']."</h4><br />";
         ?>
         <form class="" action="login.php" method="post">
           <button type="submit" name="delete" id="delete">Delete Account</button>
         </form>
      </div>
    </main>
    <?php include 'footer.inc.php'; ?>
  </body>
</html>

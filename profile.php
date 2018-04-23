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

  $sql = "SELECT * FROM OrderDetails WHERE UID = ? ";

  $statement = $pdo->prepare($sql);
  $statement->bindValue(1, $_SESSION['UID']);
  $statement->execute();

  $order = array();

  while ($row = $statement->fetch()) {
    $order[] = $row;
  }

  $sql = "SELECT * FROM ProductFavorite WHERE UID = ? ";

  $statement = $pdo->prepare($sql);
  $statement->bindValue(1, $_SESSION['UID']);
  $statement->execute();

  $favorite = array();

  while ($row = $statement->fetch()) {
    $favorite[] = $row;
  }

  $sql = "SELECT * FROM UserShoppingCart WHERE UID = ? ";

  $statement = $pdo->prepare($sql);
  $statement->bindValue(1, $_SESSION['UID']);
  $statement->execute();

  $cart = array();

  while ($row = $statement->fetch()) {
    $cart[] = $row;
  }

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
        echo "<h4>Webcoin Balance: ¤".$profile['GiftCardBalance']."</h4>";
         ?>
         <h2>Your Orders</h2>
         <?php
         foreach ($order as $key => $value) {

           $sql = "SELECT * FROM Product WHERE ProductID = ? ";

           $statement = $pdo->prepare($sql);
           $statement->bindValue(1, $value['ProductID']);
           $statement->execute();

           $product = $statement->fetch();

           echo "<div class=\"panel panel-primary\"><div class=\"panel-body\">";
           echo "";
            echo "</div></div>";
         }
         ?>
         <h2>Your Favorites</h2>
         <?php
         foreach ($favorite as $key => $value) {
           $sql = "SELECT * FROM Product WHERE ProductID = ? ";

           $statement = $pdo->prepare($sql);
           $statement->bindValue(1, $value['ProductID']);
           $statement->execute();

           $product = $statement->fetch();

           echo "<div class=\"panel panel-primary\"><div class=\"panel-body\">";
           echo "";
            echo "</div></div>";
         }
         ?>
         <h2>Your Cart</h2>
         <?php
         foreach ($cart as $key => $value) {
           $sql = "SELECT * FROM Product WHERE ProductID = ? ";

           $statement = $pdo->prepare($sql);
           $statement->bindValue(1, $value['ProductID']);
           $statement->execute();

           $product = $statement->fetch();

           echo "<div class=\"panel panel-primary\"><div class=\"panel-body\">";
           echo "";
            echo "</div></div>";
         }
         ?>
         <br />
         <form class="" action="login.php" method="post">
           <label>Type your password and click Delete Account to remove your information from our servers</label><br />
           <input type="password" id="pwd" name="pwd"/>
           <button type="submit" name="delete" id="delete">Delete Account</button>
         </form>
      </div>
    </main>
    <?php include 'footer.inc.php'; ?>
  </body>
</html>

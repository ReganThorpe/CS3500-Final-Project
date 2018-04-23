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
        echo "<h4><em>Email: ".$profile['Email']."</em></h4>";
        echo "<h4><em>Username: ".$profile['Username']."</em></h4>";
        echo "<h4><em>Webcoin Balance: ¤".$profile['GiftCardBalance']."</em></h4>";
         ?>
         <br /><h3>Your Orders</h3><br />
         <?php
         foreach ($order as $key => $value) {

           $sql = "SELECT * FROM Product WHERE ProductID = ? ";

           $statement = $pdo->prepare($sql);
           $statement->bindValue(1, $value['ProductID']);
           $statement->execute();

           $product = $statement->fetch();

           echo "<div class=\"panel panel-primary\"><div class=\"panel-body\">";
           echo "<a href=\"product.php?id=".$product['ProductID']."\">";
           echo "<h4 class='title panel-body'>".$product['Name']."</h4>";
           echo "<h4>Quantity: ".$value['UnitsPurchased']."</h4>";
            echo "</a></div></div>";

         }
         ?>
         <h3>Your Favorites</h3><br />
         <?php
         foreach ($favorite as $key => $value) {
           $sql = "SELECT * FROM Product WHERE ProductID = ? ";

           $statement = $pdo->prepare($sql);
           $statement->bindValue(1, $value['ProductID']);
           $statement->execute();

           $product = $statement->fetch();

           echo "<div class=\"panel panel-primary\"><div class=\"panel-body\">";
           echo "<a href=\"product.php?id=".$product['ProductID']."\">";
           echo "<h4 class='title panel-body'>".$product['Name']."</h4h4>";
            echo "</a></div></div>";
         }
         ?>
         <h3>Your Cart</h3><br />
         <?php
           foreach ($cart as $key => $value) {
             $sql = "SELECT * FROM Product WHERE ProductID = ? ";
             $statement = $pdo->prepare($sql);
             $statement->bindValue(1, $value['ProductID']);
             $statement->execute();
             $product = $statement->fetch();

           echo "<div class=\"panel panel-primary\"><div class=\"panel-body\">";
           echo "<a href=\"product.php?id=".$product['ProductID']."\">";
           echo "<h4>Product Name: ".$product['Name']."</h4>";
           echo "<h4>QTY: ".$value['UnitsInCart']."</h4>";
           echo "<h4>Price Per Unit: ".$product['Price']."</h4>";
           echo "</a></div></div>";
         }
         ?>
         <!-- <br /> -->
         <form class="" action="login.php" method="post">
           <label><h5>Type your password and click Delete Account to remove your information
             from our servers&nbsp&nbsp</h5></label>
           <input type="password" id="pwd" name="pwd"/><span>&nbsp&nbsp</span>
           <button type="submit" name="delete" id="delete" class="btn btn-danger">Delete Account</button>
         </form>
      </div>
    </main>
    <br />
    <?php include 'footer.inc.php'; ?>
  </body>
</html>

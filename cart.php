<?php
session_start();


    // $sql = "INSERT INTO UserShoppingCart(`USCID`, `UID`, `ProductID`, `UnitsInCart`) VALUES (?,?,?,?)";


    // $statement = $pdo->prepare($sql);
    // $statement->bindValue(1, $_SESSION['UID']);
    // $statement->bindValue(2, $_SESSION['UID']);
    // $statement->bindValue(3, $_GET['id']);
    // $statement->bindValue(4, $qty);
    // $statement->execute();
      

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

  $sql = "SELECT * FROM UserShoppingCart WHERE UID = ? ";

  $statement = $pdo->prepare($sql);
  $statement->bindValue(1, $_SESSION['UID']);
  $statement->execute();

  $cart = array();
  while ($row = $statement->fetch()) {
    $cart[] = $row;
  }
  unset($cart[0]);
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
    <link type="text/css" rel="stylesheet" href="css/cart.css" />
    <style media="screen">
      img {
        margin-left: 35%;
        margin-right: auto;
      }
    </style>
  </head>
  <body>
    <?php include 'header.inc.php'; ?>
    <?php
    foreach ($cart as $key => $value) {
      $sql = "SELECT * FROM Product WHERE ProductID = ? ";
      $statement = $pdo->prepare($sql);
      $statement->bindValue(1, $value['ProductID']);
      $statement->execute();
      $product = $statement->fetch();

      $total = $cart['UnitsInCart'] * $product['Price'];

      echo "<div class=\"panel panel-primary\"><div class=\"panel-body\">";
      echo "<h5>Product Name: </h5>".$product['Name'];
      echo "<h4>Quantity: ".$cart['UnitsInCart']."</h4>";
      echo "<h4>Price Per Unit: ".$product['Price']."</h4>";
      echo "<h4>Total Price: ".$total."</h4>";
      echo "</div></div>";
    }
     ?>
     <!-- <img src="images/putmycart.jpg" alt="mediocre meme" title="mediocre meme"/> -->
    <?php include 'footer.inc.php'; ?>
  </body>
</html>

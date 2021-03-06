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
  if (isset($_POST['nope'])) {
    $sql = "DELETE FROM `UserShoppingCart` WHERE `UserShoppingCart`.`UID` = ?";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(1, $_SESSION['UID']);
    $statement->execute();
  }

  $sql = "INSERT INTO UserShoppingCart (`UID`, `ProductID`, `UnitsInCart`) VALUES (?,?,?)";
  if (isset($_GET['id'])) {

    $statement = $pdo->prepare($sql);
    $statement->bindValue(1, $_SESSION['UID']);;
    $statement->bindValue(2, $_GET['id']);
    $statement->bindValue(3, $_GET['qty']);
    $statement->execute();
    echo
    '<script type="text/javascript">
    $url = "cart.php";
    window.location=$url;</script>';

  }

  if (isset($_POST['id'])) {
    echo
    '<script type="text/javascript">
    $url = "cart.php";
    window.location=$url;</script>';
  }

  $sql = "SELECT * FROM `UserShoppingCart` WHERE UID = ?";
  $statement = $pdo->prepare($sql);
  $statement->bindValue(1, $_SESSION['UID']);
  $statement->execute();
  $cart = array();
  while ($row = $statement->fetch()) {
    $cart[] = $row;
  }
  // unset($cart[0]);
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
  <style>
        .center{
          text-align: center;
        }
        .centerbtn{
          display: flex;
          justify-content: center;
        }
      </style>
    </head>
    <body>
      <?php include 'header.inc.php'; ?>
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="col-md-8">
              <?php
              $totalamt=0;
              $totalqty=0;
              foreach ($cart as $key => $value) {
      // echo "<script type='text/javascript'>alert('reeeeee');</script>";
                $sql = "SELECT * FROM Product WHERE ProductID = ?";
                $statement = $pdo->prepare($sql);
                $statement->bindValue(1, $value['ProductID']);
                $statement->execute();
                $product = $statement->fetch();
                $total = $value['UnitsInCart'] * $product['Price'];
                echo "<div class=\"panel panel-primary\"><div class=\"panel-body\">";
                echo "<img src=\"images/".$product['ImagePath']."\"/> ";
                echo "<h5>Product Name: </h5>".$product['Name'];
                echo "<h4>Quantity: ".$value['UnitsInCart']."</h4>";
                echo "<h4>Price Per Unit: &curren;".$product['Price']."</h4>";
                echo "<h4>Total Price: &curren;".$total."</h4>";
                $totalamt=$total + $totalamt;
                $totalqty=$value['UnitsInCart']+$totalqty;
                echo "</div></div>";
              }
              ?>
              <form class="" action="cart.php" method="post">
               <div class="form-group">
                 <input type="hidden" id="nope" name="nope" value="nope" />
                 <button type="submit" class="btn btn-danger">Delete Cart</button>
               </div>
             </form>
           </div>
           <div class="col-md-4">
            <div class="panel panel-primary ">
              <?php echo "<h2 class='center'>Total Items in Order: ".$totalqty."</h2>
              <h2 class='center'> Total Price: &curren;".$totalamt."</h2>
              <button type='submit' class='btn btn-warning centerbtn'>Checkout</button>";?>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- <img src="images/putmycart.jpg" alt="mediocre meme" title="mediocre meme"/> -->
    <?php include 'footer.inc.php'; ?>
  </body>
  </html>

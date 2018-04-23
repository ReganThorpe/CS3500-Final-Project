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

  $sql = "SELECT * FROM Product WHERE ProductID = ? ";

  $statement = $pdo->prepare($sql);
  $statement->bindValue(1, $_GET['id']);
  $statement->execute();

  $product = $statement->fetch();

  // $sql = "SELECT * FROM UserShoppingCart"
  // $statement = $pdo->prepare($sql);
  // $statement->execute();
  // $cart = $statement->fetch();

  // $sql = "SELECT * FROM ProductFavorite WHERE ProductID = ?  & UID = ?";

  // $statement = $pdo->prepare($sql);
  // $statement->bindValue(1, $_GET['id']);
  // $statement->bindValue(2, $_SESSION['UID']);
  // $statement->execute();
  //
  // $favorite = $statement->fetch();

  // if (isset($favorite)) {
  //   # code...
  // }else {
  //   # code...
  // }

  // $sql = "SELECT COUNT(*) FROM ProductRating WHERE ProductID = ?";
  //
  // $voteNum = 0;
  //
  // $statement = $pdo->prepare($sql);
  // $statement->bindValue(1, $_GET['id']);
  // $statement->execute();
  // $temp = $statement->fetch();
  // $voteNum = $temp[0];
  //
  // $RatingAvg = 0;
  //
  // $sql = "SELECT AVG(Rating) FROM ProductRating WHERE ProductID = ?";
  // $statement = $pdo->prepare($sql);
  // $statement->bindValue(1, $_GET['id']);
  // $statement->execute();
  // $temp = $statement->fetch();
  // $RatingAvg = $temp[0];

}
catch(PDOException $e){
 die($e->getMessage());
}

?>
<!DOCTYPE html>
<html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<?php
    $sql = "INSERT INTO UserShoppingCart(`USCID`, `UID`, `ProductID`, `UnitsInCart`) VALUES (?,?,?,?)";


    $statement = $pdo->prepare($sql);
    $statement->bindValue(1, $_SESSION['UID']);
    $statement->bindValue(2, $_SESSION['UID']);
    $statement->bindValue(3, $_GET['id']);
    $statement->bindValue(4, $qty);
    $statement->execute();
      

?>
<script type="text/javascript">
  $(document).ready(function(){
    $("#cart").on('click',function(){
      var qty = $('#qty').val();
      console.log(qty);
      // var ajaxurl= 'ajax.php', data = qty;
      // $.post(ajaxurl, data, function() {
            
      // });
      // $url = window.location.href;
      // window.location = $url+"?qty="+$qty;

      

    })
  })

</script>

<head>
  <meta charset="utf-8">
  <title></title>
  <link type="text/css" rel="stylesheet" href="https://bootswatch.com/3/yeti/bootstrap.min.css"/>
  <link type="text/css" rel="stylesheet" href="css/all.css" />
  <link type="text/css" rel="stylesheet" href="css/product.css" />
</head>
<style type="text/css">
/* .imgdiv{

}
.proimage{
  height: auto;
  width: 21em;
  margin: 10px;
  position: middle;
  vertical-align: middle;
}*/
#qty{
  font-size: 20pt;
}
#cart{
  margin-left: 50px;

}
</style>
<body>
  <?php include 'header.inc.php';?>
  <div class="container">
    <div class="col-md-12 ">
      <div class="col-md-4">
        <div class="panel panel-primary">
          <div class="panel-body">
            <?php echo "<img class='proimage panel-body' src=\"images/".$product['ImagePath']."\" alt=\"".$product['Name'].".png\" title =\"".$product['Name']."\">"; ?>
          </div>
        </div>
      </div>
      <div class="col-md-2"></div>
      <div class="col-md-6 panel-primary">
        <div class="row  panel-heading panel-primary">
          <?php echo "<h1 class='title panel-body'>".$product['Name']."</h1>"?>
        </div>
        <div class="panel-body panel-primary">
          <?php echo "<h2 class='description'>".$product['Description']."</h2>"?>

          <div class="panel panel-body">
            <label for="qty">Quantity</label>
            <input type="number" id='qty' name="qty" min="1" max=<?php echo $product['UnitsInStorage']; ?>>
            <?php echo $product['Price']; ?>
            <button type="button" id="cart" class="btn btn-warning"><span class="glyphicon glyphicon-shopping-cart">  </span>Add To Cart</button>


          </div>
        </div>
      </div>
    </div>
  </div>

  <?php include 'footer.inc.php'; ?>
</body>
</html>
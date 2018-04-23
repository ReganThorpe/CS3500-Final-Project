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

  if ($_GET['id'] && $_GET['points'] && $_GET['buy']) {
    $sql = "INSERT INTO ProductRating (ProductID, Rating, WouldBuyAgain, UID) VALUES (?, ?, ?, ?)";
    $pdo->beginTransaction();
    $statement = $pdo->prepare($sql);
    $statement->bindValue(1, $_GET['id']);
    $statement->bindValue(2, $_GET['points']);
    $statement->bindValue(3, $_GET['buy']);
    $statement->bindValue(4, $_SESSION['UID']);
    $statement->execute();
    $pdo->commit();
  }

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

  $sql = "SELECT * FROM ProductRating WHERE ProductID = ? ";

  $statement = $pdo->prepare($sql);
  $statement->bindValue(1, $_GET['id']);
  $statement->execute();

  $rating = $statement->fetch();

  $sql = "SELECT COUNT(*) FROM ProductRating WHERE ProductID = ?";

  $voteNum = 0;

  $statement = $pdo->prepare($sql);
  $statement->bindValue(1, $_GET['id']);
  $statement->execute();
  $temp = $statement->fetch();
  $voteNum = $temp[0];

  $RatingAvg = 0;

  $sql = "SELECT AVG(Rating) FROM ProductRating WHERE ProductID = ?";
  $statement = $pdo->prepare($sql);
  $statement->bindValue(1, $_GET['id']);
  $statement->execute();
  $temp = $statement->fetch();
  $RatingAvg = $temp[0];

  $true = 0;

  $sql = "SELECT COUNT(*) FROM ProductRating WHERE ProductID = ? & WouldBuyAgain = '1'";
  $statement = $pdo->prepare($sql);
  $statement->bindValue(1, $_GET['id']);
  $statement->execute();
  $temp = $statement->fetch();
  $true = $temp[0];

  $false = 0;

  $sql = "SELECT COUNT(*) FROM ProductRating WHERE ProductID = ? & WouldBuyAgain = '0'";
  $statement = $pdo->prepare($sql);
  $statement->bindValue(1, $_GET['id']);
  $statement->execute();
  $temp = $statement->fetch();
  $false = $temp[0];

}
catch(PDOException $e){
  die($e->getMessage());
}

?>
<!DOCTYPE html>
<html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script type="text/javascript">
$(document).ready(function(){
  $("#cart").on('click',function(){
    $qty = $('#qty').val();
    $id = $('#id').text();
    console.log($qty);
    // var ajaxurl= 'ajax.php', data = qty;
    // $.post(ajaxurl, data, function() {

    // });
    $url = 'cart.php';
    window.location = $url+"?qty="+$qty+"&id="+$id;



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
.imgdiv{

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
        <div class="row">
          <div class="panel-heading panel-primary">
            <?php echo "<h1 class='title panel-body'>".$product['Name']."</h1>"?>
          </div>
          <div class="panel-body panel-primary">
            <?php echo "<h2 class='description'>".$product['Description']."</h2>"?>

            <div class="panel panel-body">
              <label for="qty">Quantity</label>
              <input type="number" id='qty' name="qty" value="1" min="1" max=<?php echo $product['UnitsInStorage']; ?>>
              <?php echo "¤".$product['Price']; ?>
              <button type="sumbit" id="cart" class="btn btn-warning"><span class="glyphicon glyphicon-shopping-cart">  </span>Add To Cart</button>
              <span id='id' hidden><?php echo $_GET['id']; ?></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="panel panel-primary">
            <div class="panel-heading"><h4>Rating</h4></div>
            <ul class="list-group">
                <?php echo "<li class=\"list-group-item\"><strong class=\"text-primary\">".number_format($RatingAvg, 2, '.', '')."/5</strong> [".$voteNum." votes] </li>"; ?>
                <li class="list-group-item">

                  <form action="product.php" method="get" oninput="x.value=' ' + rng.value + ' '">
                    <div class="form-group text-center">
                      <output id="x" for="rng"> 3 </output> <span class="glyphicon glyphicon-thumbs-up"></span> <br>
                      <input type="range" id="rng" name="points" min="1" max="5" step="1">
                      <!-- The value of the hiddem input field is the ImageID -->
                      <?php echo "<input type=\"hidden\" name=\"id\" value=\"".$_GET['id']."\">"; ?>
                    </div>
                    <div class="form-group text-center">
                      <label><h4>Would you buy this product again?</h4></label><br />
                      <?php
                      echo "<input type=\"radio\" name=\"buy\" id=\"buy\"value=\"1\">Yes [".$true."] ";
                      echo "<input type=\"radio\" name=\"buy\" id=\"buy\"value=\"0\">No [".$false."]";
                       ?>
                    </div>
                    <div class="form-group text-center">
                      <button type="submit" class="btn btn-info"><span class="glyphicon glyphicon-ok"></span> Vote!</button>
                    </div>
                  </form>
                </li>
              </ul>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php include 'footer.inc.php'; ?>
</body>
</html>

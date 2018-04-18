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

  $sql = "SELECT * FROM ProductFavorite WHERE ProductID = ?  & UID = ?";

  $statement = $pdo->prepare($sql);
  $statement->bindValue(1, $_GET['id']);
  $statement->bindValue(2, $_SESSION['UID']);
  $statement->execute();

  $favorite = $statement->fetch();

  if ($favorite) {
    # code...
  }else {
    # code...
  }

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
  <link type="text/css" rel="stylesheet" href="css/product.css" />
</head>
<style type="text/css">
/*.imgdiv{
  display: inline-block;
  vertical-align: middle;
}*/
.proimage{
  height: auto;
  width: 100%;
  margin-top: 10px;
  margin-bottom: 10px;
  margin-left: 10px;
  margin-right: 10px;
}
</style>
<body>
  <?php include 'header.inc.php';?>
  <div class="container">
    <div class="col-md-12 ">
      <div class="col-md-4 panel panel-primary">
        <div class="row">
          <?php echo "<img class='proimage' src=\"images/".$product['ImagePath']."\" alt=\"".$product['Name'].".png\" title =\"".$product['Name']."\">"; ?>
        </div>
      </div>
      <div class="col-md-2"></div>
      <div class="col-md-6 panel-primary">
        <div class="row  panel-heading panel-primary">
          <?php echo "<h1 class='title'>".$product['Name']."</h1>"?>
        </div>
        <div class="panel-body panel-primary">
          <?php echo "<h2 class='description'>".$product['Description']."</h2>"?>

        </div>
      </div>
    </div>
  </div>





  <?php include 'footer.inc.php'; ?>
</body>
</html>

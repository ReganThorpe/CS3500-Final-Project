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

  if (isset($_POST['ProductID'])) {
    $sql = "INSERT INTO ProductFavorite (UID, ProductID) VALUES (?, ?)";
    $pdo->beginTransaction();
    $statement = $pdo->prepare($sql);
    $statement->bindValue(1, $_SESSION['UID']);
    $statement->bindValue(2, $_POST['id']);
    $statement->execute();
    $pdo->commit();
  }

  $items[] = array();

  $sql = 'SELECT * FROM Product';

  $result = $pdo->query($sql);

  while ($row = $result->fetch()) {
    $items[] = $row;
  }
  unset($items[0]);
  asort($items);
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
  <link type="text/css" rel="stylesheet" href="css/catalog.css" />
</head>
<style type="text/css">
.bullet{
  list-style-type: none;
}
.dim{
  width: 100%;
}
.center{
  text-align: center;
}
.dark{
  background-color: #008CBA;
}
.butt{
height: 50px;
vertical-align: center;
position: relative;
display: inline-block;
float: right;
}
</style>
<body>
  <?php include 'header.inc.php'; ?>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="col-md-4">
          <div class='panel panel-body panel-primary dark'>
            <img class="dim" src="images/dmitri.png" alt="Dmitri Mendeleev" title="Dmirti Mendeleev">
            <h3 class="center">"These are the best darn elements you have ever seen. I guarantee it."</h3>
            <h3 class="center">-Dmitri Mendeleev</h3>
          </div>
        </div>
        <div class="col-md-6">
          <?php
          foreach ($items as $key => $value) {
            echo "<a href=\"product.php?id=".$value['ProductID']."\" class=\"list-group-item\">";
            echo $value['Name']." <span class=\"label label-primary pull-right\">¤".$value['Price']." </span></a>";
            echo "<form action=\"catalog.php\" method=\"post\">";
            echo "<input type=\"hidden\" id=\"id\"  value=\"".$value['ProductID']."\">";
            echo "In stock: ".$value['UnitsInStorage'];

            echo "<button type=\"submit\" class=\"btn btn-primary butt\"><span class='pull-right glyphicon glyphicon-heart-empty '></span></button>&nbsp;";
            echo "<button type=\"submit\" class=\"btn btn-primary butt\"> Add to Cart</button>&nbsp;";
            echo "</form>";
          } ?>

        </div>
      </div>
    </div>
  </div>

  <?php include 'footer.inc.php'; ?>
</body>
</html>
<!--
  echo "<a href=''><span class='label label-primary pull-right glyphicon glyphicon-heart'></span></a>";
  echo "<span class='glyphicon glyphicon-heart-empty'></span>"; -->

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
  </style>
  <body>
    <?php include 'header.inc.php'; ?>
    <ul>
    <?php
    foreach ($items as $key => $value) {
      echo "<li class='bullet'><a href=\"product.php?id=".$value['ProductID']."\" class=\"list-group-item\"> ";
      echo $value['Name']." <span class=\"label label-primary pull-right\"> ".$value['Price']." </span></a></li>";
    } ?>
    </ul>
    <?php include 'footer.inc.php'; ?>
  </body>
</html>

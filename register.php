<?php
session_start();

$user = "team14user";
$pass = "This is fine";
$connStr = 'mysql:host=mysql.team14store.xyz;dbname=cs3500_storedb';

try{
  $pdo = new PDO($connStr,$user, $pass);
  $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
}
catch(PDOException $e){
  die($e->getMessage());
}

if ($_POST['email'] && $_POST['pwd']) {
    $sql = "INSERT INTO User (Username, Password, Email, FirstName, LastName, DateOfRegistration, GiftCardBalance) VALUES (?, ?, ?, ?, ?, ?, 500)";

    $pdo->beginTransaction();
    $statement = $pdo->prepare($sql);
    $statement->bindValue(1, $_POST['username']);
    $statement->bindValue(2, $_POST['pwd']);
    $statement->bindValue(3, $_POST['email']);
    $statement->bindValue(4, $_POST['firstname']);
    $statement->bindValue(5, $_POST['lastname']);
    $statement->bindValue(6, date("Y-m-d h:i:sa"));
    $statement->execute();
    $pdo->commit();



    $sql = "SELECT * FROM User WHERE Email = ? AND Password = ?";

    $query = $pdo->prepare($sql);
    $query->bindValue(1, $_POST['email']);
    $query->bindValue(2, $_POST['pwd']);
    $query->execute();

    while ($row = $query->fetch()) {
      $_SESSION['UID'] = $row['UID'];
      $_SESSION['name'] = utf8_encode($row['FirstName']." ".$row['LastName']);
      $_SESSION['username'] = $row['Username'];
    }
    header("Location: index.php");
    die();
  }

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title></title>
  <link type="text/css" rel="stylesheet" href="https://bootswatch.com/3/united/bootstrap.min.css"/>
  <link type="text/css" rel="stylesheet" href="all.css" />
  <link type="text/css" rel="stylesheet" href="index.css" />
</head>
<body>
  <?php include 'header.inc.php'; ?>
  <div class="container">
    <form class="" action="register.php" method="post">
      <div class="form-group">
        <label for="username">First Name:</label>
        <input type="text" class="form-control" id="firstname" placeholder="Enter first name" name="firstname" required><br />
        <label for="username">Last Name:</label>
        <input type="text" class="form-control" id="lastname" placeholder="Enter last name" name="lastname" required><br />
        <label for="username">User Name:</label>
        <input type="text" class="form-control" id="username" placeholder="Enter username" name="username" required><br />
        <label for="email">Email:</label>
        <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" required><br />
        <label for="pwd">Password:</label>
        <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pwd" required><br />
      </div>
      <button type="submit" class="btn btn-primary">Sign Up!</button>
    </form>
  </div>
  <?php include 'footer.inc.php'; ?>
</body>
</html>

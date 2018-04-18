<?php
session_start();

if (isset($_GET['logout'])) {
	unset($_SESSION['username']);
  unset($_SESSION['UID']);
	unset($_SESSION['name']);
}

$user = 'team14user';
$pass = 'This is fine';
$connStr = 'mysql:host=mysql.team14store.xyz;dbname=cs3500_storedb';

try{
	$pdo = new PDO($connStr,$user, $pass);
	$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

	if (isset($_POST['delete'])) {
		$sql = "DELETE FROM `User` WHERE `User`.`UID` = ?";

		$statement = $pdo->prepare($sql);
		$statement->bindValue(1, $_SESSION['UID']);
		$statement->execute();
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
    <title>Log In</title>
		<link type="text/css" rel="stylesheet" href="https://bootswatch.com/3/yeti/bootstrap.min.css"/>
		<link type="text/css" rel="stylesheet" href="css/all.css" />
		<link type="text/css" rel="stylesheet" href="css/login.css" />
  </head>
  <body>
    <?php include 'header.inc.php'; ?>
		<div class="container">
		   <div class="row">
		     <div class="col-md-12">
		      <div class="panel panel-danger spaceabove">
		       <div class="panel-heading"><h3>User Login</h3></div>
		       <div class="panel-body">
		        <div class="row">
		          <div class=col-md-12>
		            <?php
		            if (isset($_POST['email']) && isset($_POST['pwd'])) {

		              try{
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
		              catch(PDOException $e){
		                die($e->getMessage());
		              }
		            }
		            ?>
		            <form action="login.php" method="post">
		              <div class="form-group">
		                <label for="email">Email:</label>
		                <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
		              </div>
		              <div class="form-group">
		                <label for="pwd">Password:</label>
		                <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pwd">
		              </div>
		              <button type="submit" class="btn btn-primary">Login</button>
		            </form>

		          </div>
		        </div>
		      </div>
		    </div>
		  </div>


		</div>  <!-- end main content column -->
		</div>  <!-- end main content row -->
		</div>   <!-- end container -->



		<div class="container">
			<h5>Don't have an account? <a href="register.php">Sign up for free</a>!</h5></p>
		</div>

    <?php include 'footer.inc.php'; ?>
  </body>
</html>

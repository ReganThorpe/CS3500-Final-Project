<?php
session_start();

if ($_SESSION['username']) {
  header('Location:index.php');
  die();
}

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Welcome!</title>
    <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css"/>
    <link type="text/css" rel="stylesheet" href="css/all.css" />
    <link type="text/css" rel="stylesheet" href="css/landing.css" />
  </head>
  <body>
    <?php include 'header.inc.php'; ?>
    <main>
      <div class="container">
        <h1>Howdy Stranger!</h1>
        <h2>Welcome to Dmitri's Gasses!</h2>
        <h3>If you wish to no longer be a stranger, click <a href="login.php">here</a>
          to log in or <a href="register.php">here</a> to create a new account</h3>
      </div>
    </main>
    <?php include 'footer.inc.php'; ?>
  </body>
</html>

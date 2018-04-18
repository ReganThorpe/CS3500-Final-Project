<style type="text/css">
.logomain{
height: 150px;
width: auto;
padding: 15px;
}
.right{
  float: right;
  padding-top: 85px;

}
.left{
  float: left;
}
.leftpad{
  float: left;
  padding-top: 60px;
  font-weight: bold;
}
.bump{
}
li{
  font-size: 20px;
}
</style>

<header>
  <div class="navbar navbar-default ">
    <div class="container">
      <div class="col-md-12">
      <nav class="navbar navbar-inverse navbar-wrapper head bump">

      <nav class="navbar navbar-inverse navbar-wrapper head">
        <div class="row" >
        <div class="col-md-6">
          <img src="images/DG.png" class="logomain left" alt="logo.png" title="logo">
        <h1 class="leftpad">Dmitri's Gases</h1>
      </div>

          <div class="col-md-6 ">
          <ul class="nav navbar-nav right">
            <?php if (isset($_SESSION['username'])) {
              echo "<li><a href=\"profile.php\">".$_SESSION['username']."</a></li>";
              echo "<li><a href=\"catalog.php\">Catalog</a></li>";
              echo "<li><a href=\"cart.php\">Cart</a></li>";
              echo "<li><a href=\"login.php?logout=1\">Logout</a></li>";
            } ?>
            <li><a href="index.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
          </ul>
          </div>

        </div>
      </nav>
    </div>
    </div>
  </div>
</header>

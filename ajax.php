<?php

    $sql = "INSERT INTO UserShoppingCart(`USCID`, `UID`, `ProductID`, `UnitsInCart`) VALUES (?,?,?,?)";


    $statement = $pdo->prepare($sql);
    $statement->bindValue(1, $_SESSION['UID']);
    $statement->bindValue(2, $_SESSION['UID']);
    $statement->bindValue(3, $_GET['id']);
    $statement->bindValue(4, $qty);
    $statement->execute();
    echo "<script type='text/javascript'>alert('REEEEEEEEEEEEEE');</script>";
      ?>
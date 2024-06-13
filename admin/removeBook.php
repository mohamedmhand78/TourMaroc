<?php

$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'tours';


$connection = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);



      $insert = $connection->prepare("DELETE FROM book WHERE book_id=:id");
      $insert->bindParam(":id", $_GET["id"]);
      $insert->execute();

      
      header("location: ./reservations.php");
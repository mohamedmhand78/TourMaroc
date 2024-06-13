<?php

$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'tours';


$connection = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

switch ($_SERVER["REQUEST_METHOD"]) {

  case "POST":{

      $insert = $connection->prepare("INSERT INTO book (id, tours_id) VALUES (:id, :tour_id)");
      $insert->bindParam(":id", $_POST["user_id"]);
      $insert->bindParam(":tour_id", $_POST["tour_id"]);
      $insert->execute();
      
      $update = $connection->prepare("UPDATE `users` SET `phone_number` = :phonenumber WHERE `users`.`id` = :id");
      $update->bindParam(":id", $_POST["user_id"]);
      $update->bindParam(":phonenumber", $_POST["phone_number"]);
      $update->execute();


      echo json_encode(["msg"=>"valid"]);
    
  }
}

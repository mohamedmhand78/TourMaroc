<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  include "config.php";


  if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    $email = filter($_POST["email"]);
  } else {
    echo json_encode(["error" => "emailempty"]);
    die();
  }

  if (!empty($_POST["password"])) {
    $password = filter($_POST["password"]);
  } else {
    echo json_encode(["error" => "passempty"]);
    die();
  }

  try {
    $connection = new PDO("mysql:host=$host;dbname=$database", $usrname, $pass);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $select = $connection->query("SELECT email, username, admin_id, password FROM $table WHERE email = '$email'");
    $result = $select->fetch();

    if (!empty($result)) {
      if (password_verify($password, $result["password"])) {
        echo json_encode(["error" => "verified", "username" => $result["username"], "id" => $result["admin_id"]]);
      } else {
        echo json_encode(["error" => "passwrong"]);
      }
    } else {
      echo json_encode(["error" => "usernotexist"]);
    }
  } catch (PDOException $e) {
    echo "error" . $e;
  }
}

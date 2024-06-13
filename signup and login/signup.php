<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  include "config.php";

  if (!empty($_POST["fullname"])) {
    $fullname = filter($_POST["fullname"]);
  } else {
    die("namempty");
  }

  if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    $email = filter($_POST["email"]);
  } else {
    die("emailempty");
  }

  if (!empty($_POST["username"])) {
    $username = filter($_POST["username"]);
  } else {
    die("userempty");
  }

  if (strlen($_POST["password"]) > 7) {
    $password = filter($_POST["password"]);
  } else {
    die("passhort");
  }

  if ($_POST["cpassword"] == $_POST["password"]) {
    $cpassword = filter($_POST["cpassword"]);
  } else {
    die("notmatch");
  }

  $hashedpass = password_hash($password, PASSWORD_DEFAULT);

  try {
    $connection = new PDO("mysql:host=$host;dbname=$database", $usrname, $pass);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $select = $connection->query("SELECT username, email FROM $usertable WHERE username = '$username' or email = '$email'");
    $result = $select->fetch();

    if (empty($result)) {
      $insert = $connection->prepare("INSERT INTO $usertable (fullname, username, email, password) VALUES (:fullname, :username, :email, :password)");
      $insert->bindParam(":fullname", $fullname);
      $insert->bindParam(":username", $username);
      $insert->bindParam(":email", $email);
      $insert->bindParam(":password", $hashedpass);
      $insert->execute();
      echo "verified";
    } else {
      die("userexist");
    }
  } catch (PDOException $e) {
    echo "error" . $e;
  }
}

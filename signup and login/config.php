<?php
function filter($check)
{
  $check =  htmlspecialchars($check);
  $check = trim($check);
  $check = stripslashes($check);
  return $check;
}

$host = "localhost";
$database = "tours";
$table = "admin";
$usertable = "users";
$usrname = "root";
$pass = "";

<?php


// require_once "./db.php";


// $db=new Database();

$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'tours';

$connection = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);



switch($_SERVER["REQUEST_METHOD"]){

    case "GET":{
        // $q="SELECT * FROM tours";
        // $res=$db->query($q,[]);
    $tourCount = "SELECT tours_id,localisation,price,depart,images,arrivage,`description` FROM tours";
    $stm = $connection->prepare($tourCount);
    $stm->execute();

    $tourResult = $stm->fetchAll(PDO::FETCH_ASSOC);
    $i=0;
    foreach ($tourResult as $result) {

        if ($result['images']) {
            $imageData = base64_encode($result['images']);
            $imageSrc = 'data:image/jpeg;base64,' . $imageData;
            $tourResult[$i]['images']=$imageSrc ;

        } else {
            $imageSrc = 'placeholder.jpg';
        }
        $i++;
    }

    
    echo json_encode($tourResult);

    }
}
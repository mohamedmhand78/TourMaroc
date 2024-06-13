<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['submit'])) {
        try {
            $connection = new PDO("mysql:host=localhost;dbname=tours", 'root', '');
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            if (isset($_FILES['tourImage']) && $_FILES['tourImage']['error'] === UPLOAD_ERR_OK) {
                $fileTmpPath = $_FILES['tourImage']['tmp_name'];
                $fileName = $_FILES['tourImage']['name'];
                $fileSize = $_FILES['tourImage']['size'];
                $fileType = $_FILES['tourImage']['type'];
                $fileContent = file_get_contents($fileTmpPath);
            } 
            

            $editTourQuery = "UPDATE tours SET localisation = :tour_location, description = :tour_description, price = :tour_price,
            depart = :tour_departure, arrivage = :tour_arrival, images = :images WHERE tours_id = :edited_id";

            $stmt = $connection->prepare($editTourQuery);
            $stmt->bindParam(':images', $fileContent, PDO::PARAM_LOB)    ;
            $stmt->bindParam(':tour_location', $tour_location);
            $stmt->bindParam(':tour_description', $tour_description);
            $stmt->bindParam(':tour_price', $tour_price);
            $stmt->bindParam(':tour_departure', $tour_departure);
            $stmt->bindParam(':tour_arrival', $tour_arrival);
            $stmt->bindParam(':edited_id', $edited_id, PDO::PARAM_INT);
            $stmt->execute();

            echo "<script>alert('Tour updated successfully');window.location.href = 'tours.php'</script>";

        } catch (PDOException $e) {
            echo "<script>alert('Error: {$e->getMessage()}');</script>";
        }
    }
}

$tour_id = $_GET['id'];
try {
    $connection = new PDO("mysql:host=localhost;dbname=tours", 'root', '');
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $connection->prepare("SELECT * FROM tours WHERE tours_id = :tour_id");
    $stmt->bindParam(':tour_id', $tour_id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    $imageData = base64_encode($result['images']);
    $imageSrc = 'data:image/jpeg;base64,' . $imageData;

} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Tour</title>
    <link rel="icon" href="images/adminIcon.png">
    <style>
        


@font-face {
            font-family: 'Black';
            src: url('../fonts/MPLUSRounded1c-Black.ttf');
        }
        @font-face {
            font-family: 'Medium';
            src: url('../fonts/MPLUSRounded1c-Medium.ttf');
        }
        @font-face {
            font-family: 'ExtraBold';
            src: url('../fonts/MPLUSRounded1c-ExtraBold.ttf');
        }
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            height: 100vh;
            margin: 0;
            background-color: #f4f4f4;
            font-family: 'EXtraBold';
        }
        .form-container {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            box-sizing: border-box;
        }
        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input, .form-group select, .form-group textarea {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .form-group input[type="file"] {
            padding: 3px;
        }
        .form-group img {
            margin-top: 10px;
            max-width: 100%;
            height: auto;
        }
        .submit-btn {
            width: 100%;
            padding: 10px;
            background-color: #3D67FF;
            border: none;
            border-radius: 4px;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }
        .submit-btn:hover {
            background-color: #3958c8;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Edit Tour</h2>
        <form id="tourForm" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="tourLocation">Location</label>
                <input type="text" id="tourLocation" name="tourLocation" value="<?php echo $result['localisation']; ?>" required>
            </div>
            <div class="form-group">
                <label for="tourDescription">Description</label>
                <textarea id="tourDescription" name="tourDescription" rows="4" required><?php echo $result['description']; ?></textarea>
            </div>
            <div class="form-group">
                <label for="tourPrice">Price</label>
                <input type="number" id="tourPrice" name="tourPrice" value="<?php echo $result['price']; ?>" step="0.01" required>
            </div>
            <div class="form-group">
                <label for="tourDeparture">Departure</label>
                <input type="datetime-local" id="tourDeparture" name="tourDeparture" value="<?php echo date('Y-m-d\TH:i', strtotime($result['depart'])); ?>" required>
            </div>
            <div class="form-group">
                <label for="tourArrival">Arrival</label>
                <input type="datetime-local" id="tourArrival" name="tourArrival" value="<?php echo date('Y-m-d\TH:i', strtotime($result['arrivage'])); ?>" required>
            </div>
            <div class="form-group">
                <label for="tourImage">Image</label>
                <input type="file" id="tourImage" name="tourImage">
                <?php if(isset($imageSrc)): ?>
                <img src="<?php echo $imageSrc; ?>" alt="Tour Image" style="max-width: 100%; height: auto;">
                <?php endif; ?>
                </div>
            <button type="submit" class="submit-btn" name="submit">Submit</button>
        </form>
    </div>
</body>
</html>

</body>
</html>





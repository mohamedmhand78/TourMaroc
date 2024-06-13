<?php
if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    if (isset($_POST['submit'])) {
        try {
            $connection = new PDO("mysql:host=localhost;dbname=tours", 'root', '');
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Check if file was uploaded successfully
            if ($_FILES['tourImage']['error'] !== UPLOAD_ERR_OK) {
                throw new RuntimeException('File upload error');
            }

            $tour_location = $_POST['tourLocation'];
            $tour_description = $_POST['tourDescription'];
            $tour_price = $_POST['tourPrice'];
            $tour_departure = $_POST['tourDeparture'];
            $tour_arrival = $_POST['tourArrival'];

            // Access uploaded file via $_FILES
            $fileTmpPath = $_FILES['tourImage']['tmp_name'];
            $fileSize = $_FILES['tourImage']['size'];
            $fileType = $_FILES['tourImage']['type'];

            // Read file content
            $fileContent = file_get_contents($fileTmpPath);

            $addTourQuery = "INSERT INTO tours (localisation, description, price, depart, arrivage, images)
            VALUES (:tour_location, :tour_description, :tour_price, :tour_departure, :tour_arrival, :tour_image)";
            $stmt = $connection->prepare($addTourQuery);

            // Bind parameters
            $stmt->bindParam(':tour_location', $tour_location);
            $stmt->bindParam(':tour_description', $tour_description);
            $stmt->bindParam(':tour_price', $tour_price);
            $stmt->bindParam(':tour_departure', $tour_departure);
            $stmt->bindParam(':tour_arrival', $tour_arrival);
            $stmt->bindParam(':tour_image', $fileContent, PDO::PARAM_LOB);

            $stmt->execute();

            echo "<script>alert('Tour inserted successfully');
            window.location.href = 'tours.php'</script>";
        } catch (PDOException $err) {
            echo "<script>alert('Database Error: " . $err->getMessage() . "');</script>";
        } catch (Exception $e) {
            echo "<script>alert('Error: " . $e->getMessage() . "');</script>";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Tour</title>
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
    <h2>Add Tour</h2>
    <form id="tourForm" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="tourName">Tour Name</label>
            <input type="text" id="tourName" name="tourName" required>
        </div>
        <div class="form-group">
            <label for="tourLocation">Location</label>
            <input type="text" id="tourLocation" name="tourLocation" required>
        </div>
        <div class="form-group">
            <label for="tourDescription">Description</label>
            <textarea id="tourDescription" name="tourDescription" rows="4" required></textarea>
        </div>
        <div class="form-group">
            <label for="tourPrice">Price</label>
            <input type="number" id="tourPrice" name="tourPrice" step="0.01" required>
        </div>
        <div class="form-group">
            <label for="tourDeparture">Departure</label>
            <input type="datetime-local" id="tourDeparture" name="tourDeparture" required>
        </div>
        <div class="form-group">
            <label for="tourArrival">Arrival</label>
            <input type="datetime-local" id="tourArrival" name="tourArrival" required>
        </div>
        <div class="form-group">
            <label for="tourImage">Tour Image</label>
            <input type="file" id="tourImage" name="tourImage" accept="image/*" required>
            <img id="imagePreview" src="" alt="Image Preview" style="display: none;">
        </div>
        <button type="submit" class="submit-btn" name="submit">Submit</button>
    </form>
</div>
<script>
    document.getElementById('tourImage').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            if (!file.type.startsWith('image/')) {
                alert('Please upload a valid image file.');
                event.target.value = '';
                return;
            }
            const reader = new FileReader();
            reader.onload = function(e) {
                const imgElement = document.getElementById('imagePreview');
                imgElement.src = e.target.result;
                imgElement.style.display = 'block';
            };
            reader.readAsDataURL(file);
        }
    });
</script>
</body>
</html>

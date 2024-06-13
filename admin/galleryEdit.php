<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['submit'])) {
        try {
            $connection = new PDO("mysql:host=localhost;dbname=tours", 'root', '');
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            if (isset($_FILES['galleryImage']) && $_FILES['galleryImage']['error'] === UPLOAD_ERR_OK) {
                $fileTmpPath = $_FILES['galleryImage']['tmp_name'];
                $fileName = $_FILES['galleryImage']['name'];
                $fileSize = $_FILES['galleryImage']['size'];
                $fileType = $_FILES['galleryImage']['type'];
                $fileContent = file_get_contents($fileTmpPath);
            } 

            $editGalleryQuery = "UPDATE gallery SET name = :name, description = :description, images = :images WHERE gallery_id = :gallery_id";

            $stmt = $connection->prepare($editGalleryQuery);
            $stmt->bindParam(':images', $fileContent, PDO::PARAM_LOB);
            $stmt->bindParam(':name', $_POST['galleryName']);
            $stmt->bindParam(':description', $_POST['galleryDescription']);
            $stmt->bindParam(':gallery_id', $_POST['galleryId'], PDO::PARAM_INT);
            $stmt->execute();

            echo "<script>alert('Gallery updated successfully');window.location.href = 'gallery.php'</script>";

        } catch (PDOException $e) {
            echo "<script>alert('Error: {$e->getMessage()}');</script>";
        }
    }
}

$gallery_id = $_GET['id'];
try {
    $connection = new PDO("mysql:host=localhost;dbname=tours", 'root', '');
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $connection->prepare("SELECT * FROM gallery WHERE gallery_id = :gallery_id");
    $stmt->bindParam(':gallery_id', $gallery_id, PDO::PARAM_INT);
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
    <title>Edit Gallery</title>
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
            font-family: 'ExtraBold';
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
        <h2>Edit Gallery</h2>
        <form id="galleryForm" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="galleryName">Name</label>
                <input type="text" id="galleryName" name="galleryName" value="<?php echo $result['name']; ?>" required>
            </div>
            <div class="form-group">
                <label for="galleryDescription">Description</label>
                <textarea id="galleryDescription" name="galleryDescription" rows="4" required><?php echo $result['description']; ?></textarea>
            </div>
            <div class="form-group">
                <label for="galleryImage">Image</label>
                <input type="file" id="galleryImage" name="galleryImage">
                <?php if(isset($imageSrc)): ?>
                <img src="<?php echo $imageSrc; ?>" alt="Gallery Image" style="max-width: 100%; height: auto;">
                <?php endif; ?>
            </div>
            <input type="hidden" name="galleryId" value="<?php echo $gallery_id; ?>">
            <button type="submit" class="submit-btn" name="submit">Submit</button>
        </form>
    </div>
</body>
</html>


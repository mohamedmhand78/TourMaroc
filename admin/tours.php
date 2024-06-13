<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders Table</title>
    <link rel="icon" href="images/adminIcon.png">
    <style>
           @font-face {
    font-family:'Black';
    src: url('../fonts/MPLUSRounded1c-Black.ttf');
}

@font-face {
    font-family:'Medium';
    src: url('../fonts/MPLUSRounded1c-Medium.ttf');
}

@font-face {
    font-family:'ExtraBold';
    src: url('../fonts/MPLUSRounded1c-ExtraBold.ttf');
}
body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: white;
            font-family: 'ExtraBold';
        }
        .table-container {
            max-width: 100%;
            overflow-x: auto;
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 0 auto;
            table-layout: auto;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #3D67FF;
        }
        th {
            background-color: #3D67FF;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .table-container img {
            max-width: 50px;
            height: auto;
        }
        .action-btn {
            background-color: #4A90E2;
            color: white;
            padding: 5px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .action-btn:hover {
            background-color: #357ABD;
        }
        button{
            cursor:pointer;            font-family: 'ExtraBold';
        }
        .edit{
            background-color: rgb(115, 232, 166);
            border-color: green ;
        }
        .remove{
            background-color: rgb(225, 116, 116);
            border-color: #800000 ;
        }
        a{
            text-decoration: none;color: black;
        }
        .headd{
            padding: 0.6vw;
        }
        .headd>button{
            background-color: #3D67FF;
            color: white;
            border: none;padding: 0.5vw;border-radius: 0.1vw;
            font-family: 'ExtraBold' ;
        }
        .searchForm {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }
        .searchForm input[type="text"] {
            padding: 5px;
            font-size: 16px;
        }
        .searchForm input[type="submit"] {
            padding: 5px 10px;
            background-color: #3D67FF;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-family: 'ExtraBold';
        }
        .searchForm input[type="submit"]:hover {
            background-color: #357ABD;
        }
        #searchResults {
            margin-top: 20px;
        }
    </style>
</head>
<body>
<div class="headd">
    <button onclick="window.location.href = 'index.php'">Back</button>
</div>

<form name="searchForm" class="searchForm">
    <input type="text" name="searchTour" id="searchTour" placeholder="Search by location or description">
</form>

<div class="table-container">
    <?php
    $servername = 'localhost';
    $username = 'root';
    $pass = "";

    try {
        $connection = new PDO("mysql:host=$servername;dbname=tours", $username, $pass);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT * FROM tours";
        $stmt = $connection->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach($results as $result){
            // Check if image data exists
            if($result['images']) {
                // Encode blob data to base64
                $imageData = base64_encode($result['images']);
                // Format as data URL
                $imageSrc = 'data:image/jpeg;base64,' . $imageData;
            } else {
                // If image data is empty, use a placeholder or display a message
                $imageSrc = 'placeholder.jpg'; // Change this to your placeholder image path
            }
            ?>
            <div class="tour-item">
                <table class="tour-table">
                    <thead>
                        <tr>
                            <th colspan="2">Tour Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td rowspan="6" class="image-cell">
                                <img src="<?php echo $imageSrc; ?>" alt="Tour Image" style="max-width: 100px;">
                            </td>
                            <td><strong>Tour ID:</strong> <?php echo $result['tours_id']; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Location:</strong> <?php echo $result['localisation']; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Description:</strong> <?php echo $result['description']; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Price:</strong> <?php echo $result['price']; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Departure:</strong> <?php echo $result['depart']; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Arrival:</strong> <?php echo $result['arrivage']; ?></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <button class='edit'><a href='editTour.php?id=<?php echo $result['tours_id']; ?>' >Edit</a></button>
                                <button class='remove'><a href='removeTour.php?id=<?php echo $result['tours_id']; ?>'>Remove</a></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        <?php
        }

    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    ?>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    document.getElementById('searchTour').addEventListener('input', function() {
        const query = this.value.trim().toLowerCase();
        const items = document.querySelectorAll('.tour-item');
        
        items.forEach(item => {
            const location = item.querySelector('.details').textContent.trim().toLowerCase();
            if (location.includes(query)) {
                item.style.display = '';
            } else {
                item.style.display = 'none';
            }
        });
    });
</script>
</body>
</html>
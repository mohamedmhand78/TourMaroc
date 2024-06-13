<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>orders</title>

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
    
</body>
</html>
<body>
<div class="headd">
    <button onclick="window.location.href = 'index.php'">Back</button>
</div>

<form name="searchForm" class="searchForm">
    <input type="text" name="searchTour" id="searchTour" placeholder="Search by name or category">
</form>

<div class="table-container">
    <table class="BookTable">
        <thead>
            <tr>
                <th>id</th>
                <th>Tour Name</th>
                <th>User Name</th>
                <th>Phone Number</th>
                <th>User ID</th>
                <th>Date</th>
                <th>Edit</th>
                <th>Remove</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $servername = 'localhost';
            $username = 'root';
            $pass = "";

            try {
                $connection = new PDO("mysql:host=$servername;dbname=tours", $username, $pass);
                $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    // Get tour name based on tour_id
                    $tourQuery = "SELECT tours.tours_id, tours.localisation,tours.depart,users.fullname,users.id,users.phone_number ,book.book_id FROM tours INNER JOIN book ON book.tours_id=tours.tours_id INNER JOIN users ON  book.id=users.id ";
                    $tourStmt = $connection->prepare($tourQuery);
                    // $tourStmt->bindParam(':tour_id', $tour_id);
                    $tourStmt->execute();
                    $tourResult = $tourStmt->fetchAll(PDO::FETCH_ASSOC);

                    foreach($tourResult as $result){
                        $tour_id = $result['tours_id'];
                        $user_id = $result['id'];
                        $tour_name = $result['localisation'];
                        $date=$result["depart"];
                        $user_name=$result["fullname"];
                        $phone_number=$result["phone_number"];
                        // $date = $result['depart'];

                    echo "<tr>
                        <td>{$user_id}</td>
                        <td>{$tour_name}</td>
                        <td>{$user_name}</td>
                        <td>{$phone_number}</td>
                        <td>{$user_id}</td>
                        <td>{$date}</td>
                        <td><button class='edit'><a href='editBook.php?id={$result['book_id']}' >Edit</a></button></td>
                        <td><button class='remove'><a href='removeBook.php?id={$result['book_id']}'>Remove</a></button></td>
                    </tr>";
                }

            } catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
            ?>
        </tbody>
    </table>
</div>

<script>
    document.getElementById('searchTour').addEventListener('input', function() {
        const query = this.value.trim().toLowerCase();
        const rows = document.querySelectorAll('.BookTable tbody tr');
        
        rows.forEach(row => {
            const tourName = row.cells[1].textContent.trim().toLowerCase();
            if (tourName.includes(query)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
</script>

</body>
</html>
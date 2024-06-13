<?php

$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'tours';

try {
    $connection = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT COUNT(*) AS user_count FROM users";
    $tourCount = "SELECT COUNT(*) AS tour_count FROM tours";
    $galleryCount = "SELECT COUNT(*) AS gallery_count FROM gallery";
    $bookCount = "SELECT COUNT(*) AS book_count FROM book";

    $stmt = $connection->prepare($sql);
    $stm = $connection->prepare($tourCount);
    $stmGallery = $connection->prepare($galleryCount);
    $stmBook = $connection->prepare($bookCount);

    $stmt->execute();
    $stm->execute();
    $stmGallery->execute();
    $stmBook->execute();

    $userResult = $stmt->fetch(PDO::FETCH_ASSOC);
    $tourResult = $stm->fetch(PDO::FETCH_ASSOC);
    $galleryResult = $stmGallery->fetch(PDO::FETCH_ASSOC);
    $bookResult = $stmBook->fetch(PDO::FETCH_ASSOC);

} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tours Admin Dashboard</title>
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
            margin: 0;
            display: flex;
            height: 100vh;
            overflow: hidden;
            flex-direction: column;
            font-family: 'ExtraBold';
        }
        .sidebar {
            width: 250px;
            background-color: #3D67FF;
            color: white;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px 0;
            height: 100%;
            position: fixed;
            transition: transform 0.3s ease;
        }
        .sidebar.hidden {
            transform: translateX(-250px);
        }
        .logo {
            margin-bottom: 20px;
        }
        .logo img {
            width: 100px;
        }
        .menu {
            list-style: none;
            padding: 0;
            width: 100%;
        }
        .menu li {
            width: 100%;
        }
        .menu li a {
            display: block;
            padding: 15px;
            color: white;
            text-decoration: none;
            text-align: center;
            width: 100%;
            box-sizing: border-box;
        }
        .menu li a:hover, .menu li a.active {
            background-color: #1649ff;
        }
        .content {
            margin-left: 250px;
            padding: 20px;
            background-color: #F4F4F4;
            flex-grow: 1;
            overflow-y: auto;
            transition: margin-left 0.3s ease;
        }
        .content.shifted {
            margin-left: 0;
        }
        .dashboard-stats {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }
        .dashboard-stats .stat {
            background-color: #3D67FF;
            color: white;
            padding: 20px;
            border-radius: 5px;
            text-align: center;
            flex-grow: 1;
            min-width: 150px;
        }
        .topbar {
            display: none;
            width: 100%;
            background-color: #3D67FF;
            color: white;
            padding: 10px 20px;
            box-sizing: border-box;
            align-items: center;
            justify-content: space-between;
            flex-direction: column;
        }
        .menu-icon {
            font-size: 24px;
            cursor: pointer;
        }
        .topbar .menu {
            display: flex;
            flex-direction: column;
            width: 100%;
            align-items: center;
        }
        @media (max-width: 768px) {
            .sidebar {
                display: none;
            }
            .content {
                margin-left: 0;
            }
            .topbar {
                display: flex;
            }
        }
        #home > h1 {
            color: #3D67FF;
        }
        .AddContainer {
            display: flex;
            flex-direction: column;
            padding: 2vw;
            gap: 2Vw;
        }
        .AddContainer>button {
            padding: 2vw;
            font-size: 2vw;
            background-color: #3D67FF;
            border: none;
            border-radius: 1vw;
            color: white;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="sidebar" id="sidebar">
        <div class="logo">
            <div>TourMaroc</div>
        </div>
        <ul class="menu">
            <li><a href="#" class="active" onclick="showSection(event, 'home')">Home</a></li>
            <li><a href="#" onclick="window.location.href = 'users.php'">Users</a></li>
            <li><a href="#" onclick="window.location.href = 'tours.php'">Tours</a></li>
            <li><a href="#" onclick="window.location.href = 'reservations.php'">Reservations</a></li>
            <li><a href="#" onclick="window.location.href = 'gallery.php'">Gallery</a></li>
            <li><a href="#" onclick="showSection(event, 'settings')">Settings</a></li>
            <li><a href="logout.php">Log out</a></li>
        </ul>
    </div>
    <div class="topbar" id="topbar">
        <div class="logo">
            <img src="../images/index/whiteIcon.png" alt="Tours Logo">
        </div>
        <span class="menu-icon" onclick="toggleMenu()">&#9776;</span>
        <ul class="menu" id="topbarMenu">
            <li><a href="#" class="active" onclick="showSection(event, 'home')">Home</a></li>
            <li><a href="#" onclick="window.location.href = 'users.php'">Users</a></li>
            <li><a href="#" onclick="window.location.href = 'tours.php'">Tours</a></li>
            <li><a href="#" onclick="window.location.href = 'reservations.php'">Reservations</a></li>
            <li><a href="#" onclick="window.location.href = 'gallery.php'">Gallery</a></li>
            <li><a href="#" onclick="showSection(event, 'settings')">Settings</a></li>
            <li><a href="logout.php">Log out</a></li>
        </ul>
    </div>
    <div class="content" id="content">
        <div id="home" class="section">
            <h1>Tours Admin Dashboard</h1>
            <div class="dashboard-stats">
                <div class="stat">
                    <h2>Total Tours</h2>
                    <?php echo "<h1>{$tourResult['tour_count']}</h1>" ?>
                </div>
                <div class="stat">
                    <h2>Total Users</h2>
                    <?php echo "<h1>{$userResult['user_count']}</h1>" ?>
                </div>
                <div class="stat">
                    <h2>Total Gallery Items</h2>
                    <?php echo "<h1>{$galleryResult['gallery_count']}</h1>" ?>
                </div>
            </div>
        </div>
        <div id="users" class="section" style="display:none;">
            <h1>Users</h1>
            <p>Manage your users here.</p>
        </div>
        <div id="tours" class="section" style="display:none;">
            <h1>Tours</h1>
            <p>Manage your tours here.</p>
        </div>
        <div id="gallery" class="section" style="display:none;">
            <h1>Gallery</h1>
            <p>Manage your gallery items here.</p>
        </div>
        <div id="settings" class="section" style="display:none;">
            <h1>Settings</h1>
            <p>Adjust the settings :</p>
            <div class="AddContainer">
                <button class="Add" onclick="window.location.href='addtour.php'">Add Tour</button>
                <button class="Add" onclick="window.location.href='addgallery.php'">Add Gallery Item</button>
            </div>
        </div>
    </div>
    <script>
        function showSection(event, section) {
            const sections = document.querySelectorAll('.section');
            sections.forEach(sec => sec.style.display = 'none');
            document.getElementById(section).style.display = 'block';
            const menuItems = document.querySelectorAll('.menu li a');
            menuItems.forEach(item => item.classList.remove('active'));
            event.target.classList.add('active');
        }
        function toggleMenu() {
            const menu = document.getElementById('topbarMenu');
            menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
        }
    </script>
</body>
</html>

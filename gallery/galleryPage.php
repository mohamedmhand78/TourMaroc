<!-- 
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Gallery</title>
    <link rel="stylesheet" href="gallery.css">
    <link rel="stylesheet" href="../homme.css">
    <style>
        footer {
            position: relative;
            z-index: 3;
            top: 600px;
        }
    </style>
</head>

<body>
    <header>
        <div class="logo1">Xdesign</div>
        <div class="navbar">
            <ul id="navbar">
                <li><a href="../homme.html">Homme</a></li>
                <li><a href="../homme.html#hr">Tour with private guide</a></li>
                <li onclick="scrollToSection('footer')">Contact</li>
                <li onclick="scrollToSection('container')">Gallery</li>
            </ul>
        </div>
        <div></div>
        <i id="burger-menu" class="fa-solid fa-bars"></i>
    </header>
    <div class="container" id="container">


        <div class="slide">
            <?php
            // // Database connection
            // $servername = "localhost";
            // $username = "root";
            // $password = "";
            // $dbname = "tours";

            // $conn = new mysqli($servername, $username, $password, $dbname);
            // if ($conn->connect_error) {
            //     die("Connection failed: " . $conn->connect_error);
            // }

            // // SQL query to fetch data from the database
            // $sql = "SELECT * FROM gallery";
            // $result = $conn->query($sql);

            // if ($result->num_rows > 0) {
            //     while ($row = $result->fetch_assoc()) {
            //         echo "<div class='item' style='background-image: url(data:image/jpeg;base64," . base64_encode($row['images']) . ");'>
            //                 <div class='content'>
            //                     <div class='name'>" . $row['name'] . "</div>
            //                     <div class='des'>" . $row['description'] . "</div>
            //                 </div>
            //             </div>";
            //     }
            // } else {
            //     echo "0 results";
            // }
            // $conn->close();
            // ?>
        </div>

        <div class="button">
            <button class="prev"><i class="fa-solid fa-arrow-left"></i></button>
            <button class="next"><i class="fa-solid fa-arrow-right"></i></button>
        </div>

    </div>


    <footer id="footer">

        <div class="Contact">
            <h2>Contact</h2>
        </div>

        <div class="flexing">
            <div class="div1">
                <div class="logo2">Xdesign</div><br>
                <div class="phonenymber"><i class="fa-solid fa-phone icon"></i>0645445028</div><br>
                <div class="email"><i class="fa-solid fa-envelope icon"></i>exemple@gmail.com</div><br>
            </div>
            <div class="aboutus">
                <p>ABOUT US</p><br>
                <ul>
                    <li><a href="../homme.html">Homme</a></li><br>
                    <li><a href="../homme.html#hr">Tour with private guide</a></li><br>
                    <li onclick="scrollToSection('container')">Gallery</li><br>
                </ul>
            </div>
            <div class="footerdesc">
                <p>Experience the magic of Morocco with our customized tours. Explore vibrant
                    cities, stunning landscapes, and rich culture. Your adventure awaits!</p>
            </div>
        </div>


        <hr style="margin-bottom: 1vw;width: 90vw;">

        <div class="socialmedias">
            <div class="copypara"><i class='bx bx-copyright'></i>Copyright Name 2024</div>
            <div class="socialmedia">
                <div><a href="#"><i class='bx bxl-facebook-square icon'></i></a></div>
                <div><a href="#"><i class='bx bxl-instagram-alt icon'></i></a></div>
                <div><a href="#"><i class='bx bxl-linkedin-square icon'></i></a></div>
                <div><a href="#"><i class='bx bxl-youtube icon'></i></a></div>
            </div>
        </div>
    </footer>

    <script src="gallery.js"></script>
</body>

</html>



 -->










<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Gallery</title>
    <link rel="stylesheet" href="gallery.css">
    <link rel="stylesheet" href="../homme.css">
    <style>
        footer {
            position: relative;
            z-index: 3;
            top: 600px;
        }
    </style>
</head>

<body>
    <header>
        <div class="logo1">Xdesign</div>
        <div class="navbar">
            <ul id="navbar">
                <li><a href="../homme.html">Homme</a></li>
                <li><a href="../homme.html#hr">Tour with private guide</a></li>
                <li onclick="scrollToSection('footer')">Contact</li>
                <li onclick="scrollToSection('container')">Gallery</li>
            </ul>
        </div>
        <div></div>
        <i id="burger-menu" class="fa-solid fa-bars"></i>
    </header>
    <div class="container" id="container">


        <div class="slide">


            <div class="item" id="img" style="background-image: url(https://i.ibb.co/qCkd9jS/img1.jpg);">
                <div class="content">
                    <div class="name" id="name">Switzerland</div>
                    <div class="des" id="des">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ab, eum!</div>
                </div>
            </div>
            <div class="item" style="background-image: url(https://i.ibb.co/jrRb11q/img2.jpg);">
                <div class="content">
                    <div class="name">Finland</div>
                    <div class="des">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ab, eum!</div>
                </div>
            </div>
            <div class="item" style="background-image: url(https://i.ibb.co/NSwVv8D/img3.jpg);">
                <div class="content">
                    <div class="name">Iceland</div>
                    <div class="des">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ab, eum!</div>
                </div>
            </div>
            <div class="item" style="background-image: url(https://i.ibb.co/Bq4Q0M8/img4.jpg);">
                <div class="content">
                    <div class="name">Australia</div>
                    <div class="des">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ab, eum!</div>
                </div>
            </div>
            <div class="item" style="background-image: url(https://i.ibb.co/jTQfmTq/img5.jpg);">
                <div class="content">
                    <div class="name">Netherland</div>
                    <div class="des">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ab, eum!</div>
                </div>
            </div>
            <div class="item" style="background-image: url(https://i.ibb.co/RNkk6L0/img6.jpg);">
                <div class="content">
                    <div class="name">Ireland</div>
                    <div class="des">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ab, eum!</div>
                </div>
            </div>

        </div>

        <div class="button">
            <button class="prev"><i class="fa-solid fa-arrow-left"></i></button>
            <button class="next"><i class="fa-solid fa-arrow-right"></i></button>
        </div>

    </div>


    <footer id="footer">

        <div class="Contact">
            <h2>Contact</h2>
        </div>

        <div class="flexing">
            <div class="div1">
                <div class="logo2">Xdesign</div><br>
                <div class="phonenymber"><i class="fa-solid fa-phone icon"></i>0645445028</div><br>
                <div class="email"><i class="fa-solid fa-envelope icon"></i>exemple@gmail.com</div><br>
            </div>
            <div class="aboutus">
                <p>ABOUT US</p><br>
                <ul>
                    <li><a href="../homme.html">Homme</a></li><br>
                    <li><a href="../homme.html#hr">Tour with private guide</a></li><br>
                    <li onclick="scrollToSection('container')">Gallery</li><br>
                </ul>
            </div>
            <div class="footerdesc">
                <p>Experience the magic of Morocco with our customized tours. Explore vibrant
                    cities, stunning landscapes, and rich culture. Your adventure awaits!</p>
            </div>
        </div>


        <hr style="margin-bottom: 1vw;width: 90vw;">

        <div class="socialmedias">
            <div class="copypara"><i class='bx bx-copyright'></i>Copyright Name 2024</div>
            <div class="socialmedia">
                <div><a href="#"><i class='bx bxl-facebook-square icon'></i></a></div>
                <div><a href="#"><i class='bx bxl-instagram-alt icon'></i></a></div>
                <div><a href="#"><i class='bx bxl-linkedin-square icon'></i></a></div>
                <div><a href="#"><i class='bx bxl-youtube icon'></i></a></div>
            </div>
        </div>
    </footer>

    <script src="gallery.js"></script>
</body>

</html>
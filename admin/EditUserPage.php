<?php
$user_id = $_GET['id'] ?? '';

try {
    $conn = new PDO("mysql:host=localhost;dbname=tours", 'root', '');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT * FROM users WHERE id = :id");
    $stmt->bindParam(':id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
    $results = $stmt->fetch(PDO::FETCH_ASSOC);
    $phone_number = $results['phone_number'] ?? '';
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $phone = $_POST['phone']; // Retrieve phone number from the form

    try {
        $edit = "UPDATE users SET fullname = :fullname, email = :email, username = :username, phone_number = :phone WHERE id = :id"; // Update phone_number field
        $stmt = $conn->prepare($edit);
        $stmt->bindParam(':fullname', $fullname);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':phone', $phone); // Bind phone number parameter
        $stmt->bindParam(':id', $user_id);
        $stmt->execute();

        echo "<script>window.location.href = 'users.php'</script>";
    } catch (PDOException $e) {
        echo "<script>alert('Error: " . $e->getMessage() . "');</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
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
        .form-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .form-container h1 {
            text-align: center;
            margin-bottom: 20px;
            font-family: 'Black';
        }
        .form-container label {
            display: block;
            margin-bottom: 5px;
            font-family: 'Medium';
        }
        .form-container input[type="text"],
        .form-container input[type="email"] {
            width: calc(100% - 22px);
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .form-container button {
            background-color: #3D67FF;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-family: 'ExtraBold';
            width: 100%;
        }
        .form-container button:hover {
            background-color: #357ABD;
        }
        .error {
            color: red;
            margin-bottom: 10px;
            display: block;
        }
        .headd {
            padding: 0.6vw;
        }
        .headd > button {
            float: left;
            background-color: #3D67FF;
            color: white;
            border: none;
            padding: 0.5vw;
            border-radius: 0.1vw;
            font-family: 'ExtraBold';
        }
    </style>
</head>
<body>
<div class="headd">
    <button onclick="window.location.href = 'users.php'">Back</button>
</div>
<div class="form-container">
    <h1>Edit User</h1>
    <form id="editForm" action="" method="POST">
        <input type="hidden" name="id" value="<?php echo $user_id; ?>">
        
        <label for="fullname">Full Name</label>
        <input type="text" name="fullname" id="fullname" value="<?php echo $results['fullname']; ?>">
        <small class="ferror error" id="content"></small>

        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="<?php echo $results['email']; ?>">
        <small class="Eerror error" id="content"></small>

        <label for="username">Username</label>
        <input type="text" name="username" id="username" value="<?php echo $results['username']; ?>">
        <small class="uerror error" id="content"></small>

        <label for="phone">Phone Number</label>
<input type="text" name="phone" id="phone" value="<?php echo $phone_number; ?>">
<small class="pherror error" id="content"></small>


        <button type="submit" name="editButton">Edit</button>
    </form>
</div>

<script>
    const form = document.querySelector('#editForm');
    const fullnameInput = document.getElementById('fullname');
    const emailInput = document.getElementById('email');
    const usernameInput = document.getElementById('username');
    const phoneInput = document.getElementById('phone');

    fullnameInput.addEventListener('input', validateFullName);
    emailInput.addEventListener('input', validateEmail);
    usernameInput.addEventListener('input', validateUsername);
    phoneInput.addEventListener('input', validatePhone);

    function throwerror(inputname, errname, text) {
        inputname.style.backgroundColor = '#f253537a';
        inputname.style.color = 'red';
        document.querySelector('.' + errname).innerText = text;
    }

    function valide(inputname, errdisppear) {
        inputname.style.backgroundColor = '#2db72d1c';
        inputname.style.color = 'var(--main)';
        document.querySelector('.' + errdisppear).innerText = '';
    }


    function validateEmail() {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        const emailValue = emailInput.value.trim();

        if (emailInput.value.trim().length === 0) {
            throwerror(emailInput, 'Eerror', 'Email cannot be empty.');
        } else if (emailInput.value.trim().length < 5) {
            throwerror(emailInput, 'Eerror', 'Email is too short.');
        } else if (!emailRegex.test(emailValue.toLowerCase())) {
            throwerror(emailInput, 'Eerror', 'Invalid email address.');
        } else {
            valide(emailInput, 'Eerror');
        }
    }


    function validatePhone() {
        const phoneRegex = /^\+?[\d]{10,15}$/;
        if (phoneInput.value.trim().length === 0) {
            throwerror(phoneInput, 'pherror', 'Phone number cannot be empty.');
        } else if (!phoneRegex.test(phoneInput.value.trim())) {
            throwerror(phoneInput, 'pherror', 'Invalid phone number. Must contain only digits and can include a leading +.');
        } else {
            valide(phoneInput, 'pherror');
        }
    }

    function validateForm() {
        validateFullName();
        validateEmail();
        validateUsername();
        validatePhone();

        const errorMessages = form.querySelectorAll('.error');
        let isValid = true;
        errorMessages.forEach(message => {
            if (message.textContent !== '') {
                isValid = false;
            }
        });

        return isValid;
    }

    form.addEventListener('submit', function (event) {
        if (!validateForm()) {
            event.preventDefault();
        }
    });
</script>

</body>
</html>

<?php
try {
    $conn = new PDO("mysql:host=localhost;dbname=tours", 'root', '');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_GET['id'])) {
        $user_id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if ($user_id !== false && $user_id !== null) {

            $removeQuerry = "DELETE FROM users WHERE id = :user_id";
            $stmt = $conn->prepare($removeQuerry);
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->execute();

            echo "<script>window.location.href= 'users.php'</script>";
        } else {
            echo "<p class='errMessage'>Invalid user ID</p>";
        }
    } else {
        echo "<p class='errMessage'>User ID not provided</p>";
    }
} catch (PDOException $e) {
    echo "<p class='errMessage'>Error: " . $e->getMessage() . "</p>";
}
?>

<?php
try {
    $conn = new PDO("mysql:host=localhost;dbname=tours", 'root', '');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_GET['id'])) {
        $gallery_id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if ($gallery_id !== false && $gallery_id !== null) {

            $removeQuerry = "DELETE FROM gallery WHERE gallery_id = :gallery_id"; // Adjust the table and column name here
            $stmt = $conn->prepare($removeQuerry);
            $stmt->bindParam(':gallery_id', $gallery_id, PDO::PARAM_INT);
            $stmt->execute();

            echo "<script>window.location.href= 'gallery.php'</script>"; // Redirect to the appropriate page
        } else {
            echo "<p class='errMessage'>Invalid gallery ID</p>";
        }
    } else {
        echo "<p class='errMessage'>Gallery ID not provided</p>";
    }
} catch (PDOException $e) {
    echo "<p class='errMessage'>Error: " . $e->getMessage() . "</p>";
}
?>

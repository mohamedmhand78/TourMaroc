<?php
try {
    $conn = new PDO("mysql:host=localhost;dbname=tours", 'root', '');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $tour_id = $_GET['id'];
    $removeQuery = "DELETE FROM tours WHERE tours_id = :tour_id";

    $stmt = $conn->prepare($removeQuery);
    $stmt->bindParam(':tour_id', $tour_id);
    $stmt->execute();

    echo "<br><p class='errMessage'>Tour removed successfully</p>";
    echo "<script>window.location.href= 'tours.php'</script>";

} catch (PDOException $e) {
    echo "<script>alert('{$e->getMessage()}')</script>";
}
?>

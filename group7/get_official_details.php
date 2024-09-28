<?php
include 'database.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Fetch official details
    $sql = "SELECT * FROM officials WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $official = $result->fetch_assoc();

    echo json_encode($official);

    $stmt->close();
    $conn->close();
}
?>
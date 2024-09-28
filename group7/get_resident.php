<?php
include 'database.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $sql = "SELECT * FROM residents WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $resident = $result->fetch_assoc();
        echo json_encode($resident);
    } else {
        echo json_encode([]);
    }
    
    $stmt->close();
}
$conn->close();
?>

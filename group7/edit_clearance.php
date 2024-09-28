<?php
include 'database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $clearance_type = $_POST['clearance_type'];
    $date_issue = $_POST['date_issue'];
    $status = $_POST['status'];

    $stmt = $conn->prepare("UPDATE clearance SET clearance_type = ?, date_issue = ?, status = ? WHERE id = ?");
    $stmt->bind_param('sssi', $clearance_type, $date_issue, $status, $id);

    if ($stmt->execute()) {
        
        header("Location: view_clearances.php?success=1");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>

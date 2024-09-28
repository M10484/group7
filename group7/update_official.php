<?php
include 'database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $birth_date = $_POST['birth_date'];
    $position = $_POST['position'];
    $term_start = $_POST['term_start'];
    $term_end = $_POST['term_end'];

    $sql = "UPDATE officials SET name = ?, birthday = ?, position = ?, term_start = ?, term_end = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sssssi', $name, $birth_date, $position, $term_start, $term_end, $id);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }

    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}

$conn->close();
?>
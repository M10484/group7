<?php
include 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $birthday = $_POST['birthday'];
    $position = $_POST['position'];
    $term_start = $_POST['term_start'];
    $term_end = $_POST['term_end'];
    $photo = $_FILES['photo']['name'];


    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["photo"]["name"]);
    move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file);

    $sql = "INSERT INTO officials (name, birthday, position, term_start, term_end, photo) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $name, $birthday, $position, $term_start, $term_end, $photo);

    if ($stmt->execute()) {
        echo "<script>alert('Official added successfully!')</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Official</title>
    <style>
        * {font-family: cursive;}
        .body {
            display: flex;
            justify-content: center;
            align-items: center;
            /* background-color: #f4f4f4; */
            padding: 20px;
        }
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 30%;
            
        }
        label {
            display: block;
            margin-bottom: 8px;
        }
        input[type="text"], input[type="date"], input[type="file"] {
            width: 95%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        button {
            padding: 10px 15px;
            background-color: #f3036a;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        
    </style>
</head>
<body>
<a href="manage_official.php">Back</a>
<div class="body">
<form action="add_official.php" method="POST" enctype="multipart/form-data">
<h2 align="center">Add Official</h2>
    <label for="name">Name</label>
    <input type="text" id="name" name="name" required>

    <label for="birthday">Birthday</label>
    <input type="date" id="birthday" name="birthday" required>

    <label for="position">Position</label>
    <input type="text" id="position" name="position" required>

    <label for="term_start">Term Start</label>
    <input type="date" id="term_start" name="term_start" required>

    <label for="term_end">Term End</label>
    <input type="date" id="term_end" name="term_end" required>

    <label for="photo">Photo</label>
    <input type="file" id="photo" name="photo" accept="image/*" required>

    <button type="submit">Add Official</button>
</form>
</div>

</body>
</html>
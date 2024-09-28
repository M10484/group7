
<?php
include 'database.php'; 

$residents_query = "SELECT id, first_name, last_name FROM residents ORDER BY last_name ASC";
$residents_result = $conn->query($residents_query);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $resident_id = $_POST['resident_id'];
    $certificate_type = $_POST['certificate_type'];
    $date_issued = $_POST['date_issued'];
    $valid_until = $_POST['valid_until'];

    $insert_query = "INSERT INTO certificates (resident_id, certificate_type, date_issued, valid_until)
                     VALUES ('$resident_id', '$certificate_type', '$date_issued', '$valid_until')";
    
    if ($conn->query($insert_query)) {
        echo "<script>alert('Certificate created successfully!')</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Certificate</title>
    <style>
        * {
            font-family: cursive;
        }
        body {
      
            background-color: #f4f4f4;
            padding: 20px;
        }
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 450px;
            margin: 0 auto;
        }
        label {
            display: block;
            margin-bottom: 10px;
        }
        input, select {
            width: 97%;
            padding: 8px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        button {
            padding: 10px 15px;
            background-color: palevioletred;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
     
    </style>
</head>
<body>
<a href="certificates.php" style="font-size: 15px; margin-left: 10px; padding: 10px;">Back</a>


<form method="POST" action="">
<h3 align="center">Create Certificate</h3><hr><br>
    <label for="resident_id">Select Resident</label>
    <select name="resident_id" id="resident_id" required>
        <option value="">-- Select Resident --</option>
        <?php
        if ($residents_result->num_rows > 0) {
            while ($resident = $residents_result->fetch_assoc()) {
                echo "<option value='{$resident['id']}'>{$resident['last_name']}, {$resident['first_name']}</option>";
            }
        } else {
            echo "<option value=''>No residents found</option>";
        }
        ?>
    </select>

    <label for="certificate_type">Certificate Type</label>
    <input type="text" name="certificate_type" id="certificate_type" required>

    <label for="date_issued">Date Issued</label>
    <input type="date" name="date_issued" id="date_issued" required>

    <label for="valid_until">Valid Until</label>
    <input type="date" name="valid_until" id="valid_until" required>

    <button type="submit">Submit</button>
</form>

</body>
</html>
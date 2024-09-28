<?php
include 'database.php';


$residents_query = "SELECT id, first_name, last_name FROM residents ORDER BY last_name ASC";
$residents_result = $conn->query($residents_query);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $resident_id = $_POST['resident_id'];
    $clearance_type = $_POST['clearance_type'];
    $date_issue = $_POST['date_issue'];
    $valid_until = $_POST['valid_until'];
    $status = 'Pending'; 

    $resident_name_query = "SELECT CONCAT(first_name, ' ', last_name) AS full_name FROM residents WHERE id = '$resident_id'";
    $resident_name_result = $conn->query($resident_name_query);
    $resident_row = $resident_name_result->fetch_assoc();
    $resident_name = $resident_row['full_name'];


    $sql = "INSERT INTO clearance (resident_name, clearance_type, date_issue, valid_until, status) 
            VALUES ('$resident_name', '$clearance_type', '$date_issue', '$valid_until', '$status')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Clearance created successfully!');</script>";
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
    <title>Create Clearance</title>
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
            max-width: 450px;
            margin: 0 auto;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin-bottom: 10px;
        }
        input[type="text"], select, input[type="date"] {
            width: 97%;
            padding: 8px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
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
<a href="clearance.php" style="font-size: 15px; margin-left: 10px; padding: 10px;">Back</a>


<form method="POST">
<h3 align="center">Create Clearance</h3><hr><br>
    <label for="resident_id">Select Resident:</label>
    <select name="resident_id" id="resident_id" required>
        <option value="" disabled selected>--Select a resident--</option>
        <?php
        if ($residents_result->num_rows > 0) {
            while ($row = $residents_result->fetch_assoc()) {
                echo "<option value='" . $row['id'] . "'>" . $row['last_name'] . ", " . $row['first_name'] . "</option>";
            }
        }
        ?>
    </select>

    <label for="clearance_type">Clearance Type:</label>
    <input type="text" name="clearance_type" id="clearance_type" placeholder="Enter clearance type" required>

    <label for="date_issue">Date Issue:</label>
    <input type="date" name="date_issue" id="date_issue" required>

    <label for="valid_until">Valid Until:</label>
    <input type="date" name="valid_until" id="valid_until" required>

    <button type="submit">Submit Clearance</button>
</form>

</body>
</html>

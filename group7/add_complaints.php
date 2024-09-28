<?php
include 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_complaint'])) {
    $resident_name = $_POST['resident_name'];
    $complaint_type = $_POST['complaint_type'];
    $description = $_POST['description'];
    $date_field = date('Y-m-d'); 
    $status = 'Pending'; 

    $sql_insert = "INSERT INTO complaints (resident_name, complaint_type, description, date_field, status) 
                   VALUES ('$resident_name', '$complaint_type', '$description', '$date_field', '$status')";

    if ($conn->query($sql_insert) === TRUE) {
        echo "<script>alert('Complaint submitted successfully');</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}

$sql_residents = "SELECT id, first_name, last_name FROM residents ORDER BY last_name ASC";
$residents_result = $conn->query($sql_residents);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Complaint</title>
    <style>
        * {
            font-family: cursive;
            
        }
        body {
            background-color: #f0f0f0;
        }
        .body {
            
            background-color: #f0f0f0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        form {
            background-color: #ffffff;
            width: 30%;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            
        }
        label, select, input, textarea {
            display: block;
            margin-bottom: 10px;
            width: 96%;
            padding: 8px;
        }
        button {
            padding: 10px 15px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            /* width: 100%; */
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
<a href="complaints.php" style="font-size: 18px; margin-left: 10px; padding: 10px;">Back</a>
    <div class="body">
    <form method="POST" action="">
        
    <h3 align="center">Create a New Complaint</h3> <hr> <br>
        <label for="resident_name">Resident Name:</label>
        <select name="resident_name" id="resident_name" required>
            <option value="">--Select Resident--</option>
            <?php
            if ($residents_result->num_rows > 0) {
                while ($row = $residents_result->fetch_assoc()) {
                    echo "<option value='" . $row['first_name'] . " " . $row['last_name'] . "'>" 
                        . $row['first_name'] . " " . $row['last_name'] . "</option>";
                }
            } else {
                echo "<option value=''>No residents found</option>";
            }
            ?>
        </select>

        <label for="complaint_type">Complaint Type:</label>
        <input type="text" name="complaint_type" id="complaint_type" placeholder="Enter complaint type" required>

        <label for="description">Description:</label>
        <textarea name="description" id="description" placeholder="Enter complaint details" rows="4" required></textarea>

        <button type="submit" name="submit_complaint">Submit Complaint</button>
    </form>
    </div>
</body>

</html>
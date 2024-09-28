<?php
include 'database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $resident_id = $_POST['resident_id'];
    $tax_year = $_POST['tax_year'];
    $amount = $_POST['amount'];
    $date_paid = $_POST['date_paid'];


    $sql = "INSERT INTO community_tax (resident_id, tax_year, amount, date_paid) 
            VALUES ('$resident_id', '$tax_year', '$amount', '$date_paid')";
    
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Community tax record added successfully!')</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}


$residents_query = "SELECT id, first_name, last_name FROM residents";
$residents_result = $conn->query($residents_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Community Tax</title>
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
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 450px;
            margin: auto;
        }
        input, select {
            width: 95%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ddd;
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

<a href="tax.php" style="font-size: 18px; margin-left: 10px; padding: 10px;">Back</a>

<form method="POST" action="add_community_tax.php">
<h3 align="center">Add Community Tax</h3> <hr> <br>
    <label for="resident_id">Select Resident:</label>
    <select name="resident_id" id="resident_id" required>
        <option value="">--Select Resident--</option>
        <?php
        if ($residents_result->num_rows > 0) {
            while ($row = $residents_result->fetch_assoc()) {
                echo "<option value='{$row['id']}'>{$row['first_name']} {$row['last_name']}</option>";
            }
        } else {
            echo "<option value=''>No residents available</option>";
        }
        ?>
    </select>

    <label for="tax_year">Tax Year:</label>
    <input type="number" name="tax_year" id="tax_year" required>

    <label for="amount">Amount (₱):</label>
    <input type="number" step="0.01" name="amount" id="amount" required>

    <label for="date_paid">Date Paid:</label>
    <input type="date" name="date_paid" id="date_paid" required>

    <button type="submit">Add Community Tax</button>
</form>

</body>
</html>
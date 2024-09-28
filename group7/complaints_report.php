<?php
include 'database.php';

$sql = "SELECT id, first_name, middle_name, last_name, birth_date FROM residents";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resident Report</title>
    <style>
        * { font-family: cursive; }
        body { 
            background-color: #f0f0f0; 
            padding: 20px; 
        }
        .container {
            max-width: 900px;
            margin: 0 auto;
            /* background-color: #ddbea9; */
            padding: 20px;
            border-radius: 10px;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #dddddd;
            border: 1px solid black;
        }
        th {
            /* background-color: #fff1e6; */
        }
        .btn-container {
            text-align: center;
            margin-top: 20px;
        }
        button {
            padding: 10px 15px;
            background-color: #f3036a;
            color: white;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            margin-right: 10px;
        }
        @media print {
            .btn-container {
                display: none;
            }
        }
    </style>
    <script>
        function printPage() {
            window.print();
        }
    </script>
</head>

<body>
<div class="container">
    <h2>Resident Report</h2>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Middle Name</th>
                <th>Last Name</th>
                <th>Date of Birth</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['first_name'] . "</td>";
                    echo "<td>" . $row['middle_name'] . "</td>";
                    echo "<td>" . $row['last_name'] . "</td>";
                    echo "<td>" . $row['birth_date'] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No residents found</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <div class="btn-container">
        <button onclick="printPage()">Print</button>
        <button onclick="window.history.back()">Back</button>
    </div>
</div>

</body>

</html>

<?php
$conn->close();
?>

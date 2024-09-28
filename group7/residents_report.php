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
        body { margin: 0; padding: 0; background-color: #f8f9fa; }
        h1 { text-align: center; color: #333; }

        .container {
            max-width: 900px;
            margin: 50px auto;
            /* background-color: white; */
            padding: 20px;
            border-radius: 10px;
            /* box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table, th, td {
            border: 1px solid #ccc;
        }

        th, td {
            padding: 10px;
            text-align: center;
        }

        th {
            /* background-color: #007bff; */
            /* color: white; */
        }

        td {
            /* background-color: #f8f9fa; */
        }

        .btn-container {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 20px;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            font-size: 16px;
        }

        .btn-print {
            /* background-color: #28a745; */
            background-color: #f3036a;
            color: white;
        }

        .btn-back {
            /* background-color: #dc3545; */
            background-color: #f3036a;
            color: white;
        }

        @media print {
            .btn-container {
                display: none;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Resident Report</h1>
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
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["first_name"] . "</td>";
                    echo "<td>" . $row["middle_name"] . "</td>";
                    echo "<td>" . $row["last_name"] . "</td>";
                    echo "<td>" . $row["birth_date"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No records found</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <div class="btn-container">
        <button class="btn btn-print" onclick="window.print()">Print</button>
        <button class="btn btn-back" onclick="window.history.back()">Back</button>
    </div>
</div>

</body>
</html>

<?php
$conn->close();
?>

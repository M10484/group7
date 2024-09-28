<?php
include 'database.php';

$search_query = "";
if (isset($_GET['search'])) {
    $search_query = $_GET['search'];
}

$sql_complaints = "SELECT * FROM complaints WHERE resident_name LIKE '%$search_query%' ORDER BY date_field DESC";
$complaints_result = $conn->query($sql_complaints);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Complaints</title>
    <style>

        * {
            font-family: cursive;
        }
        body {
            
            background-color: #f0f0f0;
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            /* background-color: #ffffff; */
            background-color: #ddbea9;
            margin-top: 20px;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #dddddd;
            border: 1px solid black;
        }
        th {
            /* background-color: pink;
            color: white; */
            background-color: #fff1e6;
        }
        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
        }
        button {
            padding: 10px 15px;
            /* background-color: #007bff; */
            background-color: #f3036a;
            color: white;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
       
    </style>
</head>

<body>
<a href="complaints.php" style="font-size: 17px; margin-left: 7px;">Back</a>
    <h2>View Complaints</h2>
    <form method="GET" action="">
        <input type="text" name="search" placeholder="Search by Resident Name" value="<?php echo htmlspecialchars($search_query); ?>">
        <button type="submit">Search</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Resident Name</th>
                <th>Complaint Type</th>
                <th>Description</th>
                <th>Date</th>
                <!-- <th>Status</th> -->
            </tr>
        </thead>
        <tbody>
            <?php
            if ($complaints_result->num_rows > 0) {
                while ($row = $complaints_result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['ID'] . "</td>";
                    echo "<td>" . $row['resident_name'] . "</td>";
                    echo "<td>" . $row['complaint_type'] . "</td>";
                    echo "<td>" . $row['description'] . "</td>";
                    echo "<td>" . $row['date_field'] . "</td>";
                    // echo "<td>" . $row['status'] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No complaints found</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>

</html>
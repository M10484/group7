
<?php
include 'database.php';

$search_query = "";
if (isset($_GET['search'])) {
    $search_query = $_GET['search'];
}

$sql = "SELECT community_tax.id, residents.first_name, residents.last_name, community_tax.tax_year, community_tax.amount, community_tax.date_paid 
        FROM community_tax 
        INNER JOIN residents ON community_tax.resident_id = residents.id
        WHERE CONCAT(residents.first_name, ' ', residents.last_name) LIKE '%$search_query%'
        ORDER BY community_tax.date_paid DESC";

$community_tax_result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Community Tax</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>

        * {font-family: cursive;}
        body {
            background-color: #f4f4f4;
            padding: 20px;
        }
        /* table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        } */

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
        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }
    </style>
</head>
<body>
<a href="tax.php" style="font-size: 17px; margin-left: 7px;">Back</a>
<h3 align="center">View Community Tax Records</h3>

<input type="text" id="search" onkeyup="filterTable()" placeholder="Search by Resident Name" value="<?php echo htmlspecialchars($search_query); ?>">

<!-- Table -->
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Resident Name</th>
            <th>Tax Year</th>
            <th>Amount (₱)</th>
            <th>Date Paid</th>
        </tr>
    </thead>
    <tbody id="communityTaxTable">
        <?php
        if ($community_tax_result->num_rows > 0) {
            while ($row = $community_tax_result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['first_name']} {$row['last_name']}</td>
                        <td>{$row['tax_year']}</td>
                        <td>{$row['amount']}</td>
                        <td>{$row['date_paid']}</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No community tax records found.</td></tr>";
        }
        ?>
    </tbody>
</table>

<script>
    function filterTable() {
        const searchInput = document.getElementById('search').value.toLowerCase();
        const tableRows = document.querySelectorAll('#communityTaxTable tr');

        tableRows.forEach(row => {
            const residentName = row.children[1].textContent.toLowerCase();
            if (residentName.includes(searchInput)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }
</script>

</body>
</html>
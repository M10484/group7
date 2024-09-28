<?php
include 'database.php'; 

$search_query = "";
if (isset($_GET['search'])) {
    $search_query = $_GET['search'];
}

$certificates_query = "SELECT certificates.id, certificates.certificate_type, certificates.date_issued, certificates.valid_until, residents.first_name, residents.last_name
                       FROM certificates
                       INNER JOIN residents ON certificates.resident_id = residents.id
                       WHERE residents.first_name LIKE '%$search_query%' 
                       OR residents.last_name LIKE '%$search_query%'
                       ORDER BY certificates.date_issued DESC";

$certificates_result = $conn->query($certificates_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Certificates</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>

        * {
            font-family: cursive;
        }
        body {
           
            background-color: #f4f4f4;
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
        .search-box {
            margin-bottom: 20px;
            display: flex;
            justify-content: flex-start;
        }
        .search-box input {
            padding: 10px;
            width: 100%;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
    </style>
</head>
<body>
<a href="certificates.php" style="font-size: 15px; margin-left: 10px; padding: 10px;">Back</a>
<h2 align="center">View Certificates</h2>

<!-- Search Form -->
<div class="search-box">
    <input type="text" id="searchInput" onkeyup="searchCertificates()" placeholder="Search by resident name..." value="<?php echo htmlspecialchars($search_query); ?>">
</div>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Resident Name</th>
            <th>Certificate Type</th>
            <th>Date Issued</th>
            <th>Valid Until</th>
        </tr>
    </thead>
    <tbody id="certificateTableBody">
        <?php
        if ($certificates_result->num_rows > 0) {
            while ($row = $certificates_result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['first_name']} {$row['last_name']}</td>
                        <td>{$row['certificate_type']}</td>
                        <td>{$row['date_issued']}</td>
                        <td>{$row['valid_until']}</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No certificates found.</td></tr>";
        }
        ?>
    </tbody>
</table>

<script>
    function searchCertificates() {
        var searchQuery = document.getElementById('searchInput').value;
        window.location.href = 'view_certificates.php?search=' + searchQuery;
    }
</script>

</body>
</html>

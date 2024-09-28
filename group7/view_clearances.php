<?php
include 'database.php';

$clearances_query = "SELECT * FROM clearance ORDER BY date_issue DESC";
$clearances_result = $conn->query($clearances_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Clearances</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        * { font-family: cursive; }
        body { background-color: #f4f4f4; padding: 20px; }
        table {
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
        th { background-color: #f2f2f2; }
        button {
            padding: 8px 12px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover { background-color: #218838; }
        .action-buttons a {
            text-decoration: none;
            color: #fff;
            padding: 6px 10px;
            border-radius: 4px;
            margin-right: 5px;
        }
        .edit-btn { background-color: darkorange; }
        .view-btn { background-color: palevioletred; }
        
        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }
        .modal-content {
            line-height: 30px;
            background-color: white;
            padding: 50px;
            border-radius: 5px;
            max-width: 500px;
            width: 100%;
        }
        .close-btn {
            float: right;
            font-size: 18px;
            cursor: pointer;
        }
        #search {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        /* Table Styles */
        table {
            width: 100%;
            background-color: #ddbea9;
            margin-top: 20px;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #dddddd;
            border: 1px solid black;
        }
        th { background-color: #fff1e6; }
        input[type="text"], input[type="date"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
        }
        button { padding: 10px 15px; background-color: #f3036a; color: white; border: none; border-radius: 3px; cursor: pointer; }
    </style>
</head>
<body>
<a href="clearance.php" style="font-size: 15px; margin-left: 10px; padding: 10px;">Back</a>
<h2>View Clearances</h2>

<input type="text" id="search" placeholder="Search by Resident Name..." onkeyup="filterTable()">

<table id="clearanceTable">
    <thead>
        <tr>
            <th>ID</th>
            <th>Resident Name</th>
            <th>Clearance Type</th>
            <th>Date Issued</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($clearances_result->num_rows > 0) {
            while ($row = $clearances_result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['resident_name']}</td>
                        <td>{$row['clearance_type']}</td>
                        <td>{$row['date_issue']}</td>
                        <td>{$row['status']}</td>
                        <td class='action-buttons'>
                            <a href='#' class='view-btn' onclick='openViewModal({$row['id']})'>View</a>
                            <a href='#' class='edit-btn' onclick='openEditModal({$row['id']})'>Edit</a>
                        </td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No clearances found.</td></tr>";
        }
        ?>
    </tbody>
</table>

<!-- View Modal -->
<div id="viewModal" class="modal">
    <div class="modal-content">
        <span class="close-btn" onclick="closeModal('viewModal')">&times;</span>
        <h3>View Clearance Details</h3>
        <p id="viewContent"></p>
    </div>
</div>

<!-- Edit Modal -->
<div id="editModal" class="modal">
    <div class="modal-content">
        <span class="close-btn" onclick="closeModal('editModal')">&times;</span>
        <h3>Edit Clearance</h3>
        <form id="editForm" method="POST" action="edit_clearance.php">
            <!-- JavaScript will insert fields here -->
        </form>
    </div>
</div>

<script>
    function openViewModal(id) {
        fetch('get_clearance.php?id=' + id)
        .then(response => response.json())
        .then(data => {
            document.getElementById('viewContent').innerHTML = `
                <strong>Resident Name:</strong> ${data.resident_name}<br>
                <strong>Clearance Type:</strong> ${data.clearance_type}<br>
                <strong>Date Issued:</strong> ${data.date_issue}<br>
                <strong>Status:</strong> ${data.status}<br>
            `;
            document.getElementById('viewModal').style.display = 'flex';
        });
    }

    function openEditModal(id) {
        fetch('get_clearance.php?id=' + id)
        .then(response => response.json())
        .then(data => {
            document.getElementById('editForm').innerHTML = `
                <label for="clearance_type">Clearance Type:</label>
                <input type="text" name="clearance_type" value="${data.clearance_type}" required>

                <label for="date_issue">Date Issue:</label>
                <input type="date" name="date_issue" value="${data.date_issue}" required>

                <label for="status">Status:</label>
                <input type="text" name="status" value="${data.status}" required>

                <input type="hidden" name="id" value="${data.id}">
                <button type="submit">Save Changes</button>
            `;
            document.getElementById('editModal').style.display = 'flex';
        });
    }

    function closeModal(modalId) {
        document.getElementById(modalId).style.display = 'none';
    }

    function filterTable() {
        const searchInput = document.getElementById("search").value.toLowerCase();
        const table = document.getElementById("clearanceTable");
        const rows = table.getElementsByTagName("tr");

        for (let i = 1; i < rows.length; i++) {
            const residentName = rows[i].getElementsByTagName("td")[1].textContent.toLowerCase();
            if (residentName.includes(searchInput)) {
                rows[i].style.display = "";
            } else {
                rows[i].style.display = "none";
            }
        }
    }
</script>

</body>
</html>

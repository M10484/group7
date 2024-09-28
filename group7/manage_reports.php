<?php
include 'database.php';

$residentQuery = "SELECT COUNT(*) as total_residents FROM residents";
$residentResult = $conn->query($residentQuery);
$residentCount = $residentResult->fetch_assoc()['total_residents'];

$complaintQuery = "SELECT COUNT(*) as total_complaints FROM complaints";
$complaintResult = $conn->query($complaintQuery);
$complaintCount = $complaintResult->fetch_assoc()['total_complaints'];

$officialQuery = "SELECT COUNT(*) as total_officials FROM officials";
$officialResult = $conn->query($officialQuery);
$officialCount = $officialResult->fetch_assoc()['total_officials'];

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Reports</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        * { font-family: cursive; }
        body, html { margin: 0; padding: 0; }

        .logo { padding: 10px; text-transform: uppercase; color: #aa1a4a; text-align: center; }

        a { text-decoration: none; }

        #mainPage { display: flex; height: 100%; padding: 20px; box-sizing: border-box; }

        .sidebar { user-select: none; width: 19%; min-width: 150px; display: flex; flex-direction: column; align-items: flex-start; }

        .folder { background-color: transparent; padding: 10px 15px; margin-bottom: 15px; border-radius: 5px; width: 100%; display: flex; align-items: center; color: #ec407a; font-weight: bold; cursor: pointer; text-align: left; border: 2px solid #ec407a; transition: background-color 0.3s, color 0.3s; }

        .folder:hover { background-color: #ec407a; color: white; }

        .content-container { padding-top: 65px; flex-grow: 1; display: flex; justify-content: center; }

        .content { width: 100%; max-width: 900px; padding: 20px; text-align: center; color: #880e4f; }

        /* Added style for stats */
        .stats-row { display: flex; justify-content: space-between; gap: 20px; margin-top: 90px; }
        .stat-box { flex-grow: 1; padding: 20px; background-color: #f0f0f0; border: 1px solid #ccc; border-radius: 10px; text-align: center; }
        .stat-box h2 { margin: 10px 0; font-size: 24px; color: #333; }
        .stat-box p { font-size: 40px; margin: 0; color: #007bff; font-weight: bold; }

        @media (max-width: 1355px) {
            .logo { font-size: 0.5rem; }
            .content-container { padding-top: 49px; }
        }

        @media (max-width: 935px) {
            #mainPage { flex-direction: column; align-items: center; }
            .logo { display: none; }
            .sidebar { width: 120%; flex-direction: row; flex-wrap: wrap; justify-content: center; margin-bottom: 20px; padding: 0 20px; }
            .folder { width: auto; margin: 5px; }
        }
        .btn {
            background-color: #007bff;
            color: white;
            padding: 5px;
        }
    </style>
</head>

<body>

<div id="mainPage">
    <div class="sidebar">
        <div class="logo">
            <img src="logo.png" alt="Logo" style="width: 100px; height: auto; margin-bottom: 10px;">
            <h1 style="font-size: 23px;">Barangay Maligan</h1>
            <p style="font-size: 15px;">Bo.7 Banga South Cotabato</p>
        </div>
        <a href="dashboard.php" class="folder"><i class="fa fa-home"></i>&nbsp;Dashboard</a>
        <a href="manage_residence.php" class="folder"><i class="fa-solid fa-user-group"></i>&nbsp;Manage Residents</a>
        <a href="manage_complaints.php" class="folder"><i class="fa-solid fa-exclamation-circle"></i>&nbsp;Manage Complaints</a>
        <a href="manage_official.php" class="folder"><i class="fa-solid fa-user-cog"></i>&nbsp;Manage Officials</a>
        <a href="manage_reports.php" class="folder"><i class="fa-solid fa-eye"></i>&nbsp;View Reports</a>
        <a href="login.php" class="folder"><i class="fa-solid fa-right-from-bracket"></i>&nbsp;Logout</a>
    </div>

    <!-- Content -->
    <div class="content-container">
        <div class="content" id="mainContent">
            <h1>Manage Reports</h1>

            <div class="stats-row">
                <div class="stat-box">
                    
                    <h2>Total Residents</h2>
                    <p><?php echo $residentCount; ?></p><br>
                    <a href="residents_report.php" class="btn">Print Report</a>
                </div>
                <div class="stat-box">
                    <h2>Total Complaints</h2>
                    <p><?php echo $complaintCount; ?></p> <br>
                    <a href="complaints_report.php" class="btn">Print Report</a>
                </div>
                <div class="stat-box">
                    <h2>Total Officials</h2>
                    <p><?php echo $officialCount; ?></p> <br>
                    <a href="official_report.php" class="btn">Print Report</a>
                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>

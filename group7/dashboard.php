<?php

include 'database.php';

$sql_households = "SELECT COUNT(DISTINCT lot) AS total_households FROM residents";
$result_households = $conn->query($sql_households);
$row_households = $result_households->fetch_assoc();

$sql_population = "SELECT COUNT(*) AS total_population FROM residents";
$result_population = $conn->query($sql_population);
$row_population = $result_population->fetch_assoc();

$sql_male = "SELECT COUNT(*) AS total_male FROM residents WHERE gender = 'Male'";
$result_male = $conn->query($sql_male);
$row_male = $result_male->fetch_assoc();

$sql_female = "SELECT COUNT(*) AS total_female FROM residents WHERE gender = 'Female'";
$result_female = $conn->query($sql_female);
$row_female = $result_female->fetch_assoc();

$sql_children = "SELECT COUNT(*) AS total_children FROM residents WHERE TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) < 18";
$result_children = $conn->query($sql_children);
$row_children = $result_children->fetch_assoc();

$sql_seniors = "SELECT COUNT(*) AS total_seniors FROM residents WHERE TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) >= 60";
$result_seniors = $conn->query($sql_seniors);
$row_seniors = $result_seniors->fetch_assoc();


$sql_voters = "SELECT COUNT(*) AS total_voters FROM residents WHERE voter_status = 'Yes'";
$result_voters = $conn->query($sql_voters);
$row_voters = $result_voters->fetch_assoc();

$sql_pwd = "SELECT COUNT(*) AS total_pwd FROM residents WHERE person_with_disability = 'Yes'";
$result_pwd = $conn->query($sql_pwd);
$row_pwd = $result_pwd->fetch_assoc();

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="dashboard.css">
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
            <div style="padding-bottom: 20px;">
                <h1>Welcome Admin</h1>
                <p style="font-size: 15px;">Barangay-Information System</p>
            </div>

            <!-- BOX SA CONTENT -->
            <div class="stats-row">
                <div class="stat-box">
                    <h3>Total Households</h3>
                    <p><?php echo $row_households['total_households']; ?></p>
                </div>
                <div class="stat-box">
                    <h3>Total Population</h3>
                    <p><?php echo $row_population['total_population']; ?></p>
                </div>
                <div class="stat-box">
                    <h3>Male</h3>
                    <p><?php echo $row_male['total_male']; ?></p>
                </div>
            </div>

            <div class="stats-row">
                <div class="stat-box">
                    <h3>Female</h3>
                    <p><?php echo $row_female['total_female']; ?></p>
                </div>
                <div class="stat-box">
                    <h3>Children</h3>
                    <p><?php echo $row_children['total_children']; ?></p>
                </div>
                <div class="stat-box">
                    <h3>Seniors</h3>
                    <p><?php echo $row_seniors['total_seniors']; ?></p>
                </div>
            </div>

            <div class="stats-row">
                <div class="stat-box">
                    <h3>Voters</h3>
                    <p><?php echo $row_voters['total_voters']; ?></p>
                </div>
                <div class="stat-box">
                    <h3>Persons with Disabilities</h3>
                    <p><?php echo $row_pwd['total_pwd']; ?></p>
                </div>

                <div class="stat-box" style="visibility: hidden;">
                    <h3>Persons with Disabilities</h3>
                    <p><?php echo $row_pwd['total_pwd']; ?></p> 
                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>

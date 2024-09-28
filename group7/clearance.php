<?php
include 'database.php';

$sql_households = "SELECT COUNT(DISTINCT lot_number) AS total_households FROM manage_residents";
$result_households = $conn->query($sql_households);
$row_households = $result_households->fetch_assoc();

$sql_population = "SELECT COUNT(*) AS total_population FROM manage_residents";
$result_population = $conn->query($sql_population);
$row_population = $result_population->fetch_assoc();

$sql_male = "SELECT COUNT(*) AS total_male FROM manage_residents WHERE gender = 'Male'";
$result_male = $conn->query($sql_male);
$row_male = $result_male->fetch_assoc();

$sql_female = "SELECT COUNT(*) AS total_female FROM manage_residents WHERE gender = 'Female'";
$result_female = $conn->query($sql_female);
$row_female = $result_female->fetch_assoc();

// kung Below 18
$sql_children = "SELECT COUNT(*) AS total_children FROM manage_residents WHERE TIMESTAMPDIFF(YEAR, birthday, CURDATE()) < 18";
$result_children = $conn->query($sql_children);
$row_children = $result_children->fetch_assoc();

// kung 60 pataas
$sql_seniors = "SELECT COUNT(*) AS total_seniors FROM manage_residents WHERE TIMESTAMPDIFF(YEAR, birthday, CURDATE()) >= 60";
$result_seniors = $conn->query($sql_seniors);
$row_seniors = $result_seniors->fetch_assoc();

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
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
/* 
        .stats-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
            gap: 20px;
        }

        .stat-box {
            width: 30%;
            padding: 30px;
            background-color: #f8bbd0;
            border: 2px solid #ec407a;
            border-radius: 10px;
            color: #880e4f;
            text-align: center;
            font-weight: bold;
            font-size: 18px;
            gap: 110px;
        }

        @media (max-width: 935px) {
            .stats-row { flex-direction: column; align-items: center; }
            .stat-box { width: 80%; margin-bottom: 20px; }
        } */

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
            <div style="padding-bottom: 20px;">
            <h1>Manage Complaints</h1>
            <p style="font-size: 15px;"></p>
            </div>

          <main>
            <div class="box">
                <h3 class="color">View Clearance</h3><div class="hr"></div>
                <p>See the list of all issued clearance.</p>
                <a href="view_clearances.php">Go to Clearance List</a>
            </div>
            
            <div class="box">
                <h3 class="color">Add Clearances</h3><div class="hr"></div>
                <p>Add a new clearance for a resident.</p>
                <a href="add_clearance.php">Create clearance</a>
            </div>

           
          </main>
         

          
        </div>
    </div>
</div>
<style>
    .box >a {
        /* border: 1px solid black; */
        padding: 3px;
        position: relative;
        top: 6px;
    }
    .hr {
        width: 100%;
        background-color: black;
        height: 1px;
    }
    main {
        display: grid;
        grid-template-columns: repeat(3 ,1fr);
        padding-top: 90px;
       

        
        
    }
    .box {
        width: 200px;
        height: 200px;
        border: 1px solid black;
        background-color: #ffcaaf;
        border-radius: 5px;
        margin-left: 60%;
        
    }
</style>
</body>
</html>

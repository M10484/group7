<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'database.php';

    function validate_name($name) {
        return preg_match("/^[a-zA-Z\s]+$/", $name);
    }

    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'];
    $last_name = $_POST['last_name'];
    $nick_name = $_POST['nick_name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $telephone = $_POST['telephone'];

    if (!validate_name($first_name) || !validate_name($middle_name) || !validate_name($last_name) || !validate_name($nick_name)) {
        echo "<script>alert('Enter valid name.');</script>";
        exit;
    }

    $email_check_query = "SELECT * FROM residents WHERE email = '$email'";
    $email_check_result = $conn->query($email_check_query);
    if ($email_check_result->num_rows > 0) {
        echo "<script>alert('Email already exists.');</script>";
        exit;
    }


    $phone_check_query = "SELECT * FROM residents WHERE phone_number = '$phone_number' OR telephone = '$telephone'";
    $phone_check_result = $conn->query($phone_check_query);
    if ($phone_check_result->num_rows > 0) {
        echo "<script>alert('Phone number or telephone already exists.');</script>";
        exit;
    }

    $gender = $_POST['gender'];
    $birth_date = $_POST['birth_date'];
    $place_of_birth = $_POST['place_of_birth'];
    $civil_status = $_POST['civil_status'];
    $occupation = $_POST['occupation'];
    $religion = $_POST['religion'];
    $lot = $_POST['lot'];
    $purok = $_POST['purok'];
    $resident_status = $_POST['resident_status'];
    $voter_status = $_POST['voter_status'];
    $person_with_disability = $_POST['person_with_disability'];

    $photo_name = $_FILES['photo']['name'];
    $photo_tmp_name = $_FILES['photo']['tmp_name'];
    $photo_folder = 'uploads/' . $photo_name;

    if (!is_dir('uploads')) {
        mkdir('uploads', 0777, true);
    }

    $sql = "INSERT INTO residents (
        first_name, middle_name, last_name, nick_name, gender, birth_date, place_of_birth, civil_status, 
        occupation, religion, lot, purok, resident_status, voter_status, person_with_disability, 
        email, phone_number, telephone, photo
    ) VALUES (
        '$first_name', '$middle_name', '$last_name', '$nick_name', '$gender', '$birth_date', '$place_of_birth', '$civil_status', 
        '$occupation', '$religion', '$lot', '$purok', '$resident_status', '$voter_status', '$person_with_disability', 
        '$email', '$phone_number', '$telephone', '$photo_name'
    )";

    if ($conn->query($sql) === TRUE) {
        move_uploaded_file($photo_tmp_name, $photo_folder); 
        echo "<script>alert('New resident added successfully');</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>






<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Add Resident</title>
    <style>
        * {
            font-family: cursive;
        }

        body {
            margin: 20px;
            padding: 0;
            background-color: #f8b195;
        }

        h2 {
            color: #333;
        }

        form {
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid black;
            border-radius: 6px;
            background-color: rgb(254, 235, 201);
            display: flex;
            flex-wrap: wrap;
            position: relative;
            bottom: 20px;

            justify-content: space-between;
        }

        label {
            margin-bottom: 5px;
            display: block;
            /* width: 30%; */
        }

        input[type="text"],
        input[type="email"],
        input[type="date"],
        input[type="file"],
        select {
            width: 99%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid black;
            border-radius: 3px;
            box-sizing: border-box;
            background-color: #edafb8;
        }

        input[type="submit"] {
            width: 40%;
            background-color: rgb(233, 123, 142);
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            border: 1px solid black;
        }
    </style>
</head>

<body>
    <div>
    <a href="manage_residence.php" style="color: black; font-size: 20px; text-decoration: none;"> &nbsp;Back</i></a>
    </div>
    <h2 align="center" style="position: relative; bottom: 35px; ">Add Resident</h2>

    <form action="create_resident.php" method="POST" enctype="multipart/form-data">
        
        <div class="form-group">
            <label for="first_name">First Name:</label>
            <input type="text" id="first_name" name="first_name" required>
        </div>

        <div class="form-group">
            <label for="middle_name">Middle Name:</label>
            <input type="text" id="middle_name" name="middle_name" required>
        </div>

        <div class="form-group">
            <label for="last_name">Last Name:</label>
            <input type="text" id="last_name" name="last_name" required>
        </div>

        <div class="form-group">
            <label for="nick_name">Nick Name:</label>
            <input type="text" id="nick_name" name="nick_name">
        </div>

        <div class="form-group">
            <label for="gender">Gender:</label>
            <!-- <input type="text" id="gender" name="gender" required> -->
            <select id="person_with_disability" name="gender" required>
                <option value="" disabled selected>Select</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
        </div>

        <div class="form-group">
            <label for="birth_date">Birth Date:</label>
            <input type="date" id="birth_date" name="birth_date" required>
        </div>

        <div class="form-group">
            <label for="place_of_birth">Place of Birth:</label>
            <input type="text" id="place_of_birth" name="place_of_birth">
        </div>

        <div class="form-group">
            <label for="civil_status">Civil Status:</label>
            <input type="text" id="civil_status" name="civil_status">
        </div>

        <div class="form-group">
            <label for="occupation">Occupation:</label>
            <input type="text" id="occupation" name="occupation">
        </div>

        <div class="form-group">
            <label for="religion">Religion:</label>
            <input type="text" id="religion" name="religion">
        </div>

        <div class="form-group">
            <label for="lot">Lot:</label>
            <input type="text" id="lot" name="lot">
        </div>

        <div class="form-group">
            <label for="purok">Purok:</label>
            <input type="text" id="purok" name="purok">
        </div>

        <div class="form-group">
            <label for="resident_status">Resident Status:</label>
            <input type="text" id="resident_status" name="resident_status">
        </div>

        <div class="form-group">
            <label for="voter_status">Voter Status:</label>
            <select id="voter_status" name="voter_status" required>
                <option value="" disabled selected>Select</option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
            </select>
        </div>

        <div class="form-group">
            <label for="person_with_disability">Person with Disability:</label>
            <select id="person_with_disability" name="person_with_disability" required>
                <option value="" disabled selected>Select</option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
            </select>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>

        <div class="form-group">
            <label for="phone_number">Phone Number:</label>
            <input type="text" id="phone_number" name="phone_number">
        </div>

        <div class="form-group">
            <label for="telephone">Telephone:</label>
            <input type="text" id="telephone" name="telephone">
        </div>

        <div class="form-group">
            <label for="photo">Photo:</label>
            <input type="file" id="photo" name="photo" accept="image/*">
        </div>

        <input type="submit" value="Add Resident">
    </form>

</body>

</html>
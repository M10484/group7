<?php
include 'database.php';

$sql = "SELECT * FROM residents ORDER BY last_name ASC";
$result = $conn->query($sql);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $id = $_POST['id'];
    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'];
    $last_name = $_POST['last_name'];
    $nick_name = $_POST['nick_name'];
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
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $telephone = $_POST['telephone'];

    $sql_update = "UPDATE residents SET 
        first_name='$first_name', 
        middle_name='$middle_name', 
        last_name='$last_name', 
        nick_name='$nick_name', 
        gender='$gender', 
        birth_date='$birth_date', 
        place_of_birth='$place_of_birth', 
        civil_status='$civil_status', 
        occupation='$occupation', 
        religion='$religion', 
        lot='$lot', 
        purok='$purok', 
        resident_status='$resident_status', 
        voter_status='$voter_status', 
        person_with_disability='$person_with_disability', 
        email='$email', 
        phone_number='$phone_number', 
        telephone='$telephone' 
        WHERE id='$id'";

    if ($conn->query($sql_update) === TRUE) {
        echo "<script>alert('Resident updated successfully');</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
    <title>Residents List</title>
    <style>
        body {
            font-family: cursive;
            background-color: #f8b195;
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            /* background-color: #fefbd8; */
            background-color: #ddbea9;
            font-size: 12px;
            width:auto;
        }
        table, th, td {
            border: 1px solid darkslategrey;
            text-align: center;
        }
        th {
            /* background-color: #edafb8; */
            /* background-color: #fff1e6; */
            background-color: #ffcccc;
            color: #1c1c1c;
        }
        th:nth-child(20),
        td:nth-child(20) {
            background-color: #ffcccc;
        }
        
        img {
            width: 105px;
            height: 90px;
            object-fit: cover;
        }

        #search {
            padding: 13px;
            width: 97.9%;
           
        }
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            /* height: 100%; */
            overflow: auto;
            background-color: rgba(0,0,0,0.4);
            padding-top: 60px;
        }
        .modal-content {
            background-color: #fefbd8;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid black;
            width: 25%;
        }
        .update {
            padding: 5px;
            width: 200px;
           position: relative;
           top: 10px;
           background-color: palevioletred;
           border-radius: 10px;
           border: none;
           color: white;
        }
    </style>
</head>

<body><a href="manage_residence.php" style="font-size: 15px; margin-left: 10px; padding: 10px;">Back</a>
    <h2 align="center" style="color: #f3036a;">Residents List</h2>

    <input type="text" id="search" placeholder="Search..." onkeyup="filterTable()"> <hr>
    
    <table>
        <thead>
            <tr>
                <th>Photo</th>
                <th>First Name</th>
                <th>Middle Name</th>
                <th>Last Name</th>
                <th>Nick Name</th>
                <th>Gender</th>
                <th>Birth Date</th>
                <th>Place of Birth</th>
                <th>Civil Status</th>
                <th>Occupation</th>
                <th>Religion</th>
                <th>Lot</th>
                <th>Purok</th>
                <th>Resident Status</th>
                <th>Voter Status</th>
                <th>Person with Disability</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Telephone</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td><img src='uploads/" . $row['photo'] . "' alt='Resident Photo'></td>";
                    echo "<td>" . $row['first_name'] . "</td>";
                    echo "<td>" . $row['middle_name'] . "</td>";
                    echo "<td>" . $row['last_name'] . "</td>";
                    echo "<td>" . $row['nick_name'] . "</td>";
                    echo "<td>" . $row['gender'] . "</td>";
                    echo "<td>" . $row['birth_date'] . "</td>";
                    echo "<td>" . $row['place_of_birth'] . "</td>";
                    echo "<td>" . $row['civil_status'] . "</td>";
                    echo "<td>" . $row['occupation'] . "</td>";
                    echo "<td>" . $row['religion'] . "</td>";
                    echo "<td>" . $row['lot'] . "</td>";
                    echo "<td>" . $row['purok'] . "</td>";
                    echo "<td>" . $row['resident_status'] . "</td>";
                    echo "<td>" . $row['voter_status'] . "</td>";
                    echo "<td>" . $row['person_with_disability'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td>" . $row['phone_number'] . "</td>";
                    echo "<td>" . $row['telephone'] . "</td>";
                    echo "<td><button style='border: none; background-color: transparent; color: darkred;' onclick='openModal(" . $row['id'] . ")'>Edit</button></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='20'>No residents found</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <div id="myModal" class="modal">
        <div class="modal-content">
            <span onclick="closeModal()" style="float:right;cursor:pointer;">&times;</span>
            <h3>Edit Resident</h3>
            <form method="POST" id="editForm">
                <input type="hidden" name="id" id="editId">
                <label>First Name:</label><input type="text" name="first_name" id="editFirstName" required> <br>
                <label>Middle Name:</label><input type="text" name="middle_name" id="editMiddleName" required> <br>
                <label>Last Name:</label><input type="text" name="last_name" id="editLastName" required> <br>
                <label>Nick Name:</label><input type="text" name="nick_name" id="editNickName"> <br>
                <label>Gender:</label><select name="gender" id="editGender" required>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
                <br>
                <label>Birth Date:</label><input type="date" name="birth_date" id="editBirthDate" required> <br>
                <label>Place of Birth:</label><input type="text" name="place_of_birth" id="editPlaceOfBirth"> <br>
                <label>Civil Status:</label><input type="text" name="civil_status" id="editCivilStatus"> <br>
                <label>Occupation:</label><input type="text" name="occupation" id="editOccupation"> <br>
                <label>Religion:</label><input type="text" name="religion" id="editReligion"> <br>
                <label>Lot:</label><input type="text" name="lot" id="editLot"> <br>
                <label>Purok:</label><input type="text" name="purok" id="editPurok"> <br>
                <label>Resident Status:</label><input type="text" name="resident_status" id="editResidentStatus"> <br>
                <label>Voter Status:</label><select name="voter_status" id="editVoterStatus" required> <br>
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                </select> <br>
                <label>Person with Disability:</label><select name="person_with_disability" id="editPersonWithDisability" required>
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                </select>
                <br>
                <label>Email:</label><input type="email" name="email" id="editEmail" required> <br>
                <label>Phone Number:</label><input type="text" name="phone_number" id="editPhoneNumber"> <br>
                <label>Telephone:</label><input type="text" name="telephone" id="editTelephone"> <br>
                <button type="submit" name="update" class="update">Update</button>
            </form>
        </div>
    </div>

    <script>
       
        function filterTable() {
            let input = document.getElementById('search');
            let filter = input.value.toLowerCase();
            let table = document.querySelector('table');
            let rows = table.getElementsByTagName('tr');

            for (let i = 1; i < rows.length; i++) {
                let cells = rows[i].getElementsByTagName('td');
                let match = false;
                for (let j = 0; j < cells.length; j++) {
                    if (cells[j].innerText.toLowerCase().indexOf(filter) > -1) {
                        match = true;
                        break;
                    }
                }
                rows[i].style.display = match ? '' : 'none';
            }
        }

      
        function openModal(id) {
            document.getElementById('myModal').style.display = 'block';
            let row = event.target.parentElement.parentElement;
            document.getElementById('editId').value = id;
            document.getElementById('editFirstName').value = row.cells[1].innerText;
            document.getElementById('editMiddleName').value = row.cells[2].innerText;
            document.getElementById('editLastName').value = row.cells[3].innerText;
            document.getElementById('editNickName').value = row.cells[4].innerText;
            document.getElementById('editGender').value = row.cells[5].innerText;
            document.getElementById('editBirthDate').value = row.cells[6].innerText;
            document.getElementById('editPlaceOfBirth').value = row.cells[7].innerText;
            document.getElementById('editCivilStatus').value = row.cells[8].innerText;
            document.getElementById('editOccupation').value = row.cells[9].innerText;
            document.getElementById('editReligion').value = row.cells[10].innerText;
            document.getElementById('editLot').value = row.cells[11].innerText;
            document.getElementById('editPurok').value = row.cells[12].innerText;
            document.getElementById('editResidentStatus').value = row.cells[13].innerText;
            document.getElementById('editVoterStatus').value = row.cells[14].innerText;
            document.getElementById('editPersonWithDisability').value = row.cells[15].innerText;
            document.getElementById('editEmail').value = row.cells[16].innerText;
            document.getElementById('editPhoneNumber').value = row.cells[17].innerText;
            document.getElementById('editTelephone').value = row.cells[18].innerText;
        }

      
        function closeModal() {
            document.getElementById('myModal').style.display = 'none';
        }
    </script>
</body>

</html>
<?php
include 'database.php';

$sql = "SELECT * FROM officials";
$result = $conn->query($sql);

function calculateAge($birthDate) {
    $birthDate = new DateTime($birthDate);
    $today = new DateTime('today');
    $age = $birthDate->diff($today)->y;
    return $age;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Officials</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        * { font-family: cursive; }
        body, html { margin: 0; padding: 0; }
        .logo { padding: 10px; text-transform: uppercase; color: #aa1a4a; text-align: center; }

        #mainPage { display: flex; height: 100%; padding: 20px; box-sizing: border-box; }

        .sidebar { user-select: none; width: 19%; min-width: 150px; display: flex; flex-direction: column; align-items: flex-start; }

        .folder { background-color: transparent; padding: 10px 15px; margin-bottom: 15px; border-radius: 5px; width: 100%; display: flex; align-items: center; color: #ec407a; font-weight: bold; cursor: pointer; text-align: left; border: 2px solid #ec407a; transition: background-color 0.3s, color 0.3s; }

        .folder:hover { background-color: #ec407a; color: white; }

        .content-container { padding-top: 65px; flex-grow: 1; display: flex; justify-content: center; }

        .content { width: 100%; max-width: 900px; padding: 20px; text-align: center; color: #880e4f; }

        .profile-box {
            width: 290px;
            background-color: #f3e5f5;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            text-align: center;
            position: relative;
            top: 80px;
            
            /* border: 1px solid darkmagenta; */
        }
        .cover-photo {
            height: 100px;
            background-color: #ab47bc;
            border-radius: 8px 8px 0 0;
        }
        .profile-photo {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            position: absolute;
            top: 50px;
            left: 50%;
            transform: translateX(-50%);
            border: 4px solid white;
        }
        .name {
            margin-top: 60px;
            font-size: 1.5rem;
            font-weight: bold;
        }
        .position {
            font-size: 1.1rem;
            color: #7b1fa2;
        }
        .age {
            font-size: 1rem;
            color: #7b1fa2;
        }
        .profile-buttons {
            margin-top: 15px;
        }
        .btn {
            padding: 10px;
            background-color: #ab47bc;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin: 5px;
        }
        .btn:hover {
            background-color: #8e24aa;
        }

        /* Modal */
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
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            width: 400px;
        }
        .close-modal {
            float: right;
            cursor: pointer;
            font-size: 1.2rem;
        }

        a {
            text-decoration: none;
        }

        .add {
            position: relative;
            left: 80%;
            padding: 10px;
            background-color: blue;
            color: wheat;
            height: 14px;
            border-radius: 15px;
            
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
        <div class="add" ><a href="add_official.php" style="color: white; position: relative; top: -5px;">Add Official</a></div>
        <div class="content">
            <h2>Manage Officials</h2>
            <?php if ($result->num_rows > 0) : ?>
                <?php while ($row = $result->fetch_assoc()) : ?>
                    <div class="profile-box">
                        <div class="cover-photo"></div>
                        <img src="uploads/<?php echo $row['photo']; ?>" alt="Profile Photo" class="profile-photo">
                        <div class="name"><?php echo $row['name']; ?></div>
                        <div class="age">Age:<?php echo calculateAge($row['birthday']); ?></div>
                        <div class="position"><?php echo $row['position']; ?></div>
                        
                        <div class="profile-buttons">
                            <button class="btn" onclick="openModal(<?php echo $row['id']; ?>)">View Profile</button>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else : ?>
                <p>No officials found.</p>
            <?php endif; ?>

            <!-- Modal -->
            <!-- <div id="profileModal" class="modal">
                <div class="modal-content">
                    <span class="close-modal" onclick="closeModal()">&times;</span>
                    <div id="modalDetails"></div>
                    <button class="btn" onclick="editProfile()">Edit Profile</button>
                    <button class="btn" onclick="closeModal()">Back</button>
                </div>
            </div> -->
        </div>
    </div>
</div>

<!-- Modal -->
<div id="profileModal" class="modal">
    <div class="modal-content">
        <span class="close-modal" onclick="closeModal()">&times;</span>
        <div id="viewProfileSection">
            <h2 id="modalName"></h2>
            <p><strong>Birthday:</strong> <span id="modalBirthDate"></span></p>
            <p><strong>Age:</strong> <span id="modalAge"></span></p>
            <p><strong>Position:</strong> <span id="modalPosition"></span></p>
            <p><strong>Term Start:</strong> <span id="modalTermStart"></span></p>
            <p><strong>Term End:</strong> <span id="modalTermEnd"></span></p>
           <div style="display: flex;">
           <button class="btn" id="editButton" onclick="showEditForm()">Edit Profile</button>
           <button class="btn" onclick="closeModal()">Back</button>
           </div>
        </div>

      <!-- edit form -->
        <div id="editProfileSection" style="display: none;">
            <h2>Edit Profile</h2>
            <form id="editProfileForm">
                <input type="hidden" id="officialId" name="id">
                <div>
                    <label for="name">Name:</label>
                    <input type="text" id="editName" name="name" required>
                </div>
                <div>
                    <label for="birth_date">Birth Date:</label>
                    <input type="date" id="editBirthDate" name="birth_date" required>
                </div>
                <div>
                    <label for="position">Position:</label>
                    <input type="text" id="editPosition" name="position" required>
                </div>
                <div>
                    <label for="term_start">Term Start:</label>
                    <input type="date" id="editTermStart" name="term_start" required>
                </div>
                <div>
                    <label for="term_end">Term End:</label>
                    <input type="date" id="editTermEnd" name="term_end" required>
                </div>
                <br>
                <button type="submit" class="btn">Save Changes</button>
                <button class="btn" onclick="hideEditForm()">Back to Profile</button>
            </form>
           
        </div>
    </div>
</div>

<script>
    function openModal(id) {
        document.getElementById('profileModal').style.display = 'flex';

        fetch('get_official_details.php?id=' + id)
            .then(response => response.json())
            .then(data => {
                // Profile view fields
                document.getElementById('officialId').value = data.id;
                document.getElementById('modalName').innerText = data.name;
                document.getElementById('modalBirthDate').innerText = data.birthday;
                document.getElementById('modalAge').innerText = calculateAge(data.birthday);
                document.getElementById('modalPosition').innerText = data.position;
                document.getElementById('modalTermStart').innerText = data.term_start;
                document.getElementById('modalTermEnd').innerText = data.term_end;
                
        
                document.getElementById('editProfileSection').style.display = 'none';
                document.getElementById('viewProfileSection').style.display = 'block';
            });
    }

    function calculateAge(birthDate) {
        const today = new Date();
        const birthDateObj = new Date(birthDate);
        let age = today.getFullYear() - birthDateObj.getFullYear();
        const monthDiff = today.getMonth() - birthDateObj.getMonth();
        if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDateObj.getDate())) {
            age--;
        }
        return age;
    }

    function closeModal() {
        document.getElementById('profileModal').style.display = 'none';
    }

    // Show edit form
    function showEditForm() {
        document.getElementById('viewProfileSection').style.display = 'none';
        document.getElementById('editProfileSection').style.display = 'block';

        document.getElementById('editName').value = document.getElementById('modalName').innerText;
        document.getElementById('editBirthDate').value = document.getElementById('modalBirthDate').innerText;
        document.getElementById('editPosition').value = document.getElementById('modalPosition').innerText;
        document.getElementById('editTermStart').value = document.getElementById('modalTermStart').innerText;
        document.getElementById('editTermEnd').value = document.getElementById('modalTermEnd').innerText;
    }

    function hideEditForm() {
        document.getElementById('editProfileSection').style.display = 'none';
        document.getElementById('viewProfileSection').style.display = 'block';
    }

    document.getElementById('editProfileForm').addEventListener('submit', function(event) {
        event.preventDefault();

        const formData = new FormData(this);

        fetch('update_official.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Profile updated successfully!');
                closeModal();
                location.reload(); 
            } else {
                alert('Failed to update profile. Please try again.');
            }
        });
    });
</script>

</body>
</html>

<?php
$conn->close();
?>
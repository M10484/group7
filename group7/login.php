<?php

include 'database.php';

$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM login WHERE email = '$email' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        header("Location: dashboard.php");
    } else {

        $error_message = "Invalid email or password";
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="assets/css/login.css">
    <style>
        /*--------------------------------------------------------------
  #  For login styles
--------------------------------------------------------------*/
* {
    font-family: cursive;
}

*::selection {
    color: white;
    background-color: #d291bc;
}

body,
html {
    margin: 0;
    padding: 0;
    height: 100%;
    box-sizing: border-box;
    background-color: #f8b195;
}

.container {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    align-items: center;
    height: 100vh;
    padding: 0 80px;
}

.left {
    flex: 1;
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
    padding-right: 20px;
    text-align: left;
}

.left > h1 {
    font-size:2rem;
}

.left > p {
    font-size: 1.2rem;
    line-height: 30px;
}

.right {
    flex: 1;
    display: flex;
    justify-content: center;
    align-items: center;
}

form {
    max-width: 300px;
    width: 100%;
    padding: 20px;
    background-color: rgb(254, 235, 201);
    border-radius: 8px;
    border: 1px solid black;
}

::placeholder {
    color: black;
}

input[type="text"],
input[type="password"] {
    width: 100%;
    padding: 10px;
    margin: 10px 0;
    border-radius: 4px;
    border: 1px solid #ccc;
    box-sizing: border-box;
    background-color: #edafb8;
    border: 1px solid black;
    border-radius: 3px;
    box-sizing: border-box;
    font-family: cursive;
    padding: 10px;

}

input[type="submit"] {
    width: 100%;
    padding: 11px;
    color: white;
    cursor: pointer;
    font-weight: bold;
    /* font-family: cursive; */
    margin-top: 6px;
    background-color: rgb(233, 123, 142);
    border: none;
    border-radius: 3px;
}

@media (width < 768px) {
    .container {
        padding: 40px 20px;
    }
}

@media (max-width: 768px) {
    .container {
        flex-direction: column;
        justify-content: center;
    }


    .left,
    .right {
        width: 100%;
        text-align: center;
    }

    .right {
        margin-bottom: 100px;
    }
}

.error-message {
    color: red;
    font-weight: bold;
    text-align: center;
}
    </style>
</head>

<body>
    <div class="container">
        <div class="left">
            <h1>Barangay Maligan Banga South Cotabato</h1>
            <p>Lugar nga kung sa diin damo Gwapo</p>
        </div>
        <div class="right">
            <form method="post" action="">
                <h2 align="center">Login</h2>
                <input type="text" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="submit" value="Login">
                <?php if (!empty($error_message)) { ?>
                    <p class="error-message"><?php echo $error_message; ?></p>
                <?php } ?>
            </form>
        </div>
    </div>
</body>

</html>
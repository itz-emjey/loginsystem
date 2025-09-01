<?php

include 'dbConn.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);

    if (empty($username) || empty($password)) {
        echo "<div style='color:red;'>Please enter both username and password.</div>";
    } else {
        $sql = "SELECT * FROM registered_clients WHERE username = '$username'";
        $result = mysqli_query($conn, $sql);

        if ($row = mysqli_fetch_assoc($result)) {
            if (password_verify($password, $row['password'])) {
                $_SESSION['username'] = $username;
                header("Location: index.php"); // Only redirect on success
                exit;
            } else {
                echo "<div style='color:red;'>Incorrect password.</div>";
            }
        } else {
            echo "<div style='color:red;'>Username not found.</div>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log-In</title>
</head>
<body>

    <div class="container">
        <h2>Log-In</h2>
        <form action="login.php" method="POST">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username"><br><br>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password"><br><br>
    <input type="submit" value="Login">
</form>
        <p>Don't have an account? <a href="register.php">Register here</a></p>


    </div>
    
</body>
</html>



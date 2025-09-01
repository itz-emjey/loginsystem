<?php 
include 'dbConn.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="container">

        <h2>Register</h2>
        <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"])?>" method="POST">
            <label for="username">Full Name:</label>
            <input type="text" id="name" name="name" ><br><br>

            <label for="username">Username:</label>
            <input type="text" id="username" name="username" ><br><br>
            
            <label for="password">Password:</label>
            <input type="password" id="password" name="password"><br><br>

            <?php 
        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_SPECIAL_CHARS);
            $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
            $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);

            if(empty($name) || empty($username) || empty($password)){
                echo '<div style="color:red; margin-bottom:10px; text-align: center;">Please fill in all fields</div>';
            }
        }
    ?>
     <?php 
            if (!empty($name) && !empty($username) && !empty($password)){
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $sql = "INSERT INTO registered_clients (name, username, password) VALUES ('$name', '$username', '$hash')";

                mysqli_query($conn, $sql);
                echo '<div style="color:green; margin-bottom:10px; text-align: center;" >You are now registered!</div>';

            }

        
        mysqli_close($conn);
    ?>
            
            <input type="submit" value="Register" class="register">
        </form>
        <p>Already have an account? <a href="login.php">Login here</a>.</p>
    </div>

   
    
</body>
</html>
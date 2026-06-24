<?php
include "config.php";

$message = "";

if (isset($_POST['register'])) {

    $username = $_POST['username'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
        $message = "Please fill in all fields.";
    }

   
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Invalid email address.";
    }

    
    elseif (strlen($password) < 3) {
        $message = "Password must be at least 3 characters.";
    }

    elseif ($password !== $confirm_password) {
        $message = "Passwords do not match.";
    }

    else {

        $check = $conn->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
        $check->bind_param("ss", $username, $email);
        $check->execute();

        $result = $check->get_result();

        if ($result->num_rows > 0) {
            $message = "Username or Email already exists.";
        } else {

         
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $insert = $conn->prepare("INSERT INTO users (username, email, password_hash) VALUES (?, ?, ?)");
            $insert->bind_param("sss", $username, $email, $hashedPassword);

            if ($insert->execute()) {
                $message = "Registration Successful!";
            } else {
                $message = "Registration Failed.";
            }
            $insert->close();
        }   

        $check->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="register.css">
</head>
<body>
    <div class="container">
        <h2>Register</h2>
        <?php if (!empty($message)) : ?>
            <div class="message">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>
        <form method="POST">
            <input type="text"name="username"placeholder="Username"required>
            <input type="email"name="email"placeholder="Email"required>
            <input type="password"name="password"placeholder="Password"required>
            <input type="password" name="confirm_password"placeholder="Confirm Password"required>
            <button type="submit" name="register">Register</button>
             <p>You have an account? <a href="login.php">Login here</a></p>
        </form>
    </div>
</body>
</html>
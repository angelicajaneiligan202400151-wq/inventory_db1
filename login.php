<?php
include "config.php";
include "auth.php";


$message = "";

if (isset($_POST['login'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {

        $user = mysqli_fetch_assoc($result);

        if (password_verify($password, $user['password_hash'])) {

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            header("Location: index.php");
            exit();

        } else {
            $message = "Invalid username or password.";
        }

    } else {
        $message = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>

    <style>

        body{
 font-family: Arial, sans-serif;
 background: #212529;
 margin: 0;
 padding: 0;
}

        .container{
            width: 300px; 
            padding: 40px;
            margin: 100px auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
        }

        h2{
 text-align: center;
 margin-bottom: 20px;
 color: #e83e8c;   /* pink */
 font-weight: 600;
}

        .message{
            color: red;
            text-align: center;
            margin-bottom: 15px;
        }

        input{
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            box-sizing: border-box;
        }

        /* ===== LOGIN BUTTON ===== */
button{
 width: 100%;
 padding: 10px;
 margin-top: 10px;
 background: #e83e8c;
 color: white;
 border: none;
 border-radius: 6px;
 cursor: pointer;
 transition: 0.3s ease;
}

button:hover{
 background: #d63384;
}

/* ===== REGISTER LINK ===== */
.register a{
 color: #e83e8c;
 text-decoration: none;
 font-weight: 600;
}

.register a:hover{
 color: #d63384;
 text-decoration: underline;
}

    </style>
</head>
<body>

<div class="container">

    <h2>Login</h2>

    <?php if ($message != "") { ?>
        <p class="message"><?php echo $message; ?></p>
    <?php } ?>

    <form method="POST">

        <input type="text"name="username"placeholder="Username"required>
        <input type="password"name="password"placeholder="Password"required>
        <button type="submit" name="login">Login</button>

    </form>

    <p class="register">Don't have an account?<a href="register.php">Register here</a> </p>
</div>
</body>
</html>
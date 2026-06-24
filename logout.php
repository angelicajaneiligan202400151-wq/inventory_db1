<?php
include "auth.php";

/* If user clicks YES */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    logout();
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Confirm Logout</title>

<style>
body{
    font-family: Arial, sans-serif;
    background:#212529;
    margin:0;
    height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
}

.container{
    width:400px;
    background:white;
    padding:30px;
    border-radius:12px;
    text-align:center;
    box-shadow:0 5px 15px rgba(0,0,0,0.3);
}

h2{
    color:#e83e8c;
    margin-bottom:25px;
}

.btn{
    padding:10px 20px;
    border-radius:6px;
    border:none;
    cursor:pointer;
    font-weight:600;
    margin:10px;
    transition:0.3s ease;
    text-decoration:none;
    display:inline-block;
}

/* YES button */
.btn-yes{
    background:#e83e8c;
    color:white;
}

.btn-yes:hover{
    background:#d63384;
}

/* NO button */
.btn-no{
    background:#ccc;
    color:#333;
}

.btn-no:hover{
    background:#aaa;
}
</style>

</head>
<body>

<div class="container">
    <h2>Are you sure you want to logout?</h2>

    <form method="POST" style="display:inline;">
        <button type="submit" class="btn btn-yes">Yes</button>
    </form>

    <a href="index.php" class="btn btn-no">No</a>
</div>

</body>
</html>
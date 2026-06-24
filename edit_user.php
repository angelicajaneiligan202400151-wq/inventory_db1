<?php
require_once 'config.php';
include "auth.php";
requireAdmin();

/* CHECK IF ID EXISTS */
if (!isset($_GET['id'])) {
    header("Location: users.php");
    exit;
}

$id = intval($_GET['id']);

/* FETCH USER DATA */
$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();

/* IF USER NOT FOUND */
if (!$user) {
    header("Location: users.php");
    exit;
}

/* UPDATE USER */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = $_POST['username'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    $stmt = $conn->prepare("UPDATE users SET username=?, email=?, role=? WHERE id=?");
    $stmt->bind_param("sssi", $username, $email, $role, $id);
    $stmt->execute();
    $stmt->close();

    header("Location: users.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit User</title>
<link rel="stylesheet" href="style.css">

<style>
.container{
    width:450px;
    margin:50px auto;
    background:white;
    padding:30px;
    border-radius:12px;
    box-shadow:0 5px 15px rgba(0,0,0,0.2);
}

h1{
    text-align:center;
    color:#e83e8c;
    margin-bottom:25px;
}

label{
    font-weight:600;
    display:block;
    margin-top:15px;
    margin-bottom:5px;
}

input, select{
    width:100%;
    padding:10px;
    border-radius:6px;
    border:1px solid #ccc;
    box-sizing:border-box;
}

button{
    width:100%;
    margin-top:20px;
    padding:12px;
    border:none;
    border-radius:6px;
    background:#e83e8c;
    color:white;
    font-weight:600;
    cursor:pointer;
    transition:0.3s ease;
}

button:hover{
    background:#d63384;
}
</style>

</head>
<body>

<?php include 'navbar.php'; ?>

<div class="container">
    <h1>Edit User</h1>

    <form method="POST">

        <label>Username</label>
        <input type="text" name="username"
        value="<?php echo htmlspecialchars($user['username']); ?>" required>

        <label>Email</label>
        <input type="email" name="email"
        value="<?php echo htmlspecialchars($user['email']); ?>" required>

        <label>Role</label>
        <select name="role">
            <option value="admin" <?php if($user['role']=="admin") echo "selected"; ?>>Admin</option>
            <option value="staff" <?php if($user['role']=="staff") echo "selected"; ?>>Staff</option>
        </select>

        <button type="submit">Update User</button>

    </form>
</div>

</body>
</html>
<?php
require_once 'config.php';
include "auth.php";
requireAdmin(); // only admin can access

$result = mysqli_query($conn, "SELECT id, username, email, role FROM users ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
<title>Manage Users</title>
<link rel="stylesheet" href="style.css">
<style>
    body{
    font-family: Arial, sans-serif;
    background: #212529;
    margin: 0;
}
.container{
    width:95%;
    margin:30px auto;
}

h1{
    color:#e83e8c;
    text-align:center;
}

table{
    width:100%;
    border-collapse:collapse;
    background:white;
}

table th{
    background:#e83e8c;
    color:white;
}

table th, table td{
    padding:10px;
    border:1px solid #ddd;
    text-align:center;
}

.action-btn{
    background:#e83e8c;
    color:white;
    padding:6px 12px;
    border-radius:6px;
    text-decoration:none;
}

.action-btn:hover{
    background:#d63384;
}
</style>
</head>
<body>

<?php include 'navbar.php'; ?>

<div class="container">
<h1>Manage Users</h1>

<table>
<tr>
    <th>ID</th>
    <th>Username</th>
    <th>Email</th>
    <th>Role</th>
    <th>Action</th>
</tr>

<?php while($row = mysqli_fetch_assoc($result)) : ?>
<tr>
    <td><?php echo $row['id']; ?></td>
    <td><?php echo htmlspecialchars($row['username']); ?></td>
    <td><?php echo htmlspecialchars($row['email']); ?></td>
    <td><?php echo htmlspecialchars($row['role']); ?></td>
    <td>
        <a href="edit_user.php?id=<?php echo $row['id']; ?>" class="action-btn">Edit</a>
        <a href="delete_user.php?id=<?php echo $row['id']; ?>" class="action-btn">Delete</a>
    </td>
</tr>
<?php endwhile; ?>

</table>
</div>

</body>
</html>
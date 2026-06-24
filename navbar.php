<?php
if (session_status() == PHP_SESSION_NONE) session_start();
?>

<style>
.navbar{
    width:95%;
    background:#e83e8c;
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:12px 20px;
    border-radius:10px;
    margin:20px auto;
}

.brand a{
    text-decoration:none;
    color:white;
    font-size:22px;
    font-weight:700;
    letter-spacing:1px;
}

.nav-links{
    display:flex;
    align-items:center;
    gap:15px;
}

.nav-links a{
    text-decoration:none;
    color:white;
    padding:8px 14px;
    font-size:14px;
    border-radius:6px;
    font-weight:500;
    transition:0.3s ease;
}

.nav-links a:hover{ 
    background:#d63384;
    color:white;
}

.nav-actions{
    display:flex;
    align-items:center;
    gap:12px;
}

.nav-user{
    font-size:16px;
    font-weight:600;
    color:white;
}

.nav-role{
    font-size:13px;
    font-weight:400;
    color:#ffe6f0;
    margin-left:6px;
}

.logout-form{
    margin:0;
}

.logout-btn{
    border:none;
    background:white;
    color:#e83e8c;
    padding:8px 14px;
    font-size:14px;
    border-radius:6px;
    cursor:pointer;
    font-weight:600;
    transition:.3s ease;
}

.logout-btn:hover{
    background:#ffe6f0;
}
</style>

<nav class="navbar">

    <div class="brand">
        <a>INVENTORY</a>
    </div>

    <div class="nav-links">
        <a href="index.php">Products</a>
        <a href="report.php">Reports</a>
        <a href="add.php">Add Product</a>

        <?php if(isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
            <a href="users.php">Manage Users</a>
        <?php endif; ?>
    </div>

    <div class="nav-actions">
        <?php if (!empty($_SESSION['username'])): ?>
            <span class="nav-user">
                 <?php echo htmlspecialchars($_SESSION['username']); ?>
                 <?php if (!empty($_SESSION['role'])): ?>
                     <span class="nav-role">
                        (<?php echo htmlspecialchars($_SESSION['role']); ?>)
                     </span>
                 <?php endif; ?>
            </span>
        <?php endif; ?>

        <a href="logout.php" class="logout-btn">Logout</a>
    </div>

</nav>
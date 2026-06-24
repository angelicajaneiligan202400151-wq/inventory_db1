<?php
require_once 'config.php';
include "auth.php";
requireAdmin();

/* GET PRODUCT */
if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = intval($_GET['id']);

$stmt = $conn->prepare("
    SELECT p.id, p.name, p.price, p.stock, c.name AS category
    FROM products p
    LEFT JOIN categories c ON p.category_id = c.id
    WHERE p.id = ?
");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();
$stmt->close();

if (!$product) {
    header("Location: index.php");
    exit;
}

/* DELETE CONFIRM */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Confirm Delete</title>
<link rel="stylesheet" href="style.css">

<style>
    body{
    font-family: Arial, sans-serif;
    background: #212529;
    margin: 0;
}
.container{
    width:500px;
    margin:80px auto;
    background:white;
    padding:30px;
    border-radius:12px;
    box-shadow:0 5px 15px rgba(0,0,0,0.2);
}

h2{
    color:#e83e8c;
    text-align:center;
    margin-bottom:20px;
}

ul{
    margin:20px 0;
}

.btn{
    padding:10px 18px;
    border-radius:6px;
    text-decoration:none;
    border:none;
    cursor:pointer;
    font-weight:600;
    transition:0.3s ease;
}

/* Confirm button */
.btn-confirm{
    background:#e83e8c;
    color:white;
}

.btn-confirm:hover{
    background:#d63384;
}

/* Cancel button */
.btn-confirm{
    background:#e83e8c;
    color:white;
}

.btn-confirm:hover{
    background:#d63384;
}

.btn-cancel{
    background:#e83e8c;
    color:white;
    margin-left:10px;
}

.btn-cancel:hover{
    background:#d63384;
}
</style>
</head>

<body>

<?php include 'navbar.php'; ?>

<div class="container">

<h2>Confirm Delete</h2>

<p>Are you sure you want to delete this product?</p>

<ul>
    <li><strong>ID:</strong> <?php echo $product['id']; ?></li>
    <li><strong>Name:</strong> <?php echo htmlspecialchars($product['name']); ?></li>
    <li><strong>Category:</strong> <?php echo htmlspecialchars($product['category']); ?></li>
    <li><strong>Price:</strong> ₱<?php echo number_format($product['price'],2); ?></li>
    <li><strong>Stock:</strong> <?php echo $product['stock']; ?></li>
</ul>

<form method="POST" style="display:inline;">
    <button type="submit" class="btn btn-confirm">Confirm Delete</button>
</form>

<a href="index.php" class="btn btn-cancel">Cancel</a>

</div>

</body>
</html>
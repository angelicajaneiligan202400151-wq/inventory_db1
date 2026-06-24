<?php
require_once 'config.php';
include "auth.php";
requireAdmin();

$categories = mysqli_query($conn, "SELECT id, name FROM categories ORDER BY name");
$suppliers = mysqli_query($conn, "SELECT id, name FROM suppliers ORDER BY name");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $price = (float) $_POST['price'];
    $stock = (int) $_POST['stock'];
    $category_id = (int) $_POST['category_id'];
    $supplier_id = (int) $_POST['supplier_id'];

    if (
        !empty($name) &&
        !empty($description) &&
        $price >= 0 &&
        $stock >= 0 &&
        $category_id > 0 &&
        $supplier_id > 0
    ) {
        $sql = "INSERT INTO products
                (name, description, price, stock, category_id, supplier_id)
                VALUES
                ('$name','$description',$price,$stock,$category_id,$supplier_id)";

        mysqli_query($conn, $sql);

        header("Location: index.php");
        exit();
    }

    echo "<script>alert('Please fill in all required fields.');</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Add Product</title>
<link rel="stylesheet" href="style.css">

<style>
    body{
    font-family: Arial, sans-serif;
    background: #212529;
    margin: 0;
}
.container{
    width:700px;
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
    display:block;
    font-weight:600;
    margin-top:15px;
    margin-bottom:5px;
}

input, textarea, select{
    width:100%;
    padding:10px;
    border:1px solid #ccc;
    border-radius:6px;
    box-sizing:border-box;
}

textarea{
    resize:vertical;
    min-height:100px;
}

button{
    width:100%;
    background:#e83e8c;
    color:white;
    border:none;
    padding:12px;
    border-radius:6px;
    font-size:16px;
    cursor:pointer;
    margin-top:20px;
    transition:0.3s ease;
}

button:hover{
    background:#d63384;
}

.back-btn{
    display:inline-block;
    margin-top:15px;
    background:#e83e8c;
    color:white;
    text-decoration:none;
    padding:10px 18px;
    border-radius:6px;
    transition:0.3s ease;
}

.back-btn:hover{
    background:#d63384;
}
</style>
</head>

<body>

<?php include 'navbar.php'; ?>

<div class="container">

<h1>Add Product</h1>

<form method="POST">

<label>Product Name</label>
<input type="text" name="name" required>

<label>Description</label>
<textarea name="description" required></textarea>

<label>Price</label>
<input type="number" step="0.01" name="price" required>

<label>Stock</label>
<input type="number" name="stock" required>

<label>Category</label>
<select name="category_id" required>
    <option value="">-- Select Category --</option>
    <?php while($cat = mysqli_fetch_assoc($categories)): ?>
        <option value="<?php echo $cat['id']; ?>">
            <?php echo $cat['name']; ?>
        </option>
    <?php endwhile; ?>
</select>

<label>Supplier</label>
<select name="supplier_id" required>
    <option value="">-- Select Supplier --</option>
    <?php while($sup = mysqli_fetch_assoc($suppliers)): ?>
        <option value="<?php echo $sup['id']; ?>">
            <?php echo $sup['name']; ?>
        </option>
    <?php endwhile; ?>
</select>

<button type="submit">Save Product</button>

</form>

<a href="index.php" class="back-btn">Back</a>

</div>

</body>
</html>
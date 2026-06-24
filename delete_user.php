<?php
require_once 'config.php';
include "auth.php";
requireAdmin(); // only admin can delete

if (!isset($_GET['id'])) {
    header("Location: users.php");
    exit;
}

$id = intval($_GET['id']);

/* Optional: Prevent deleting yourself */
if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $id) {
    header("Location: users.php");
    exit;
}

$stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->close();

header("Location: users.php");
exit;
?>
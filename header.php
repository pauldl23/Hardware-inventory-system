<?php
session_start();
$usertype = isset($_SESSION['usertype']) ? $_SESSION['usertype'] : 'Guest';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory System</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="sidebar">
    <div class="logo">
        Inventory System
    </div>
    <nav>
        <ul>
            <?php if ($usertype === 'Admin'): ?>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="inventory.php">Inventory</a></li>
                <li><a href="categories.php">Categories</a></li>
                <li><a href="orders.php">Orders</a></li>
                <li><a href="reports.php">Reports</a></li>
                <li><a href="settings.php">Settings</a></li>
            <?php elseif ($usertype === 'User'): ?>
                <li><a href="products.php">Products</a></li>
                <li><a href="help_support.php">Help/Support</a></li>
            <?php endif; ?>
        </ul>
    </nav>
    <div class="logout">
        <button onclick="location.href='logout.php';">Logout</button>
    </div>
</div>
</body>
</html>

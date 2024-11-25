<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login_screen.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Inventory</title>
</head>
<body>
    <h1>Welcome, <?php echo $_SESSION['username']; ?>!</h1>
    <p>You are logged in as <?php echo $_SESSION['usertype']; ?>.</p>
    <a href="logout.php">Logout</a>

    <div>
        <ul>
            <li><a href="browse_items.php">Browse Items</a></li>
            <li><a href="manage_inventory.php">Manage Inventory</a></li>
            <li><a href="view_transactions.php">View Transactions</a></li>
            <?php if ($_SESSION['usertype'] == 'Admin') { ?>
                <li><a href="manage_users.php">Manage Users</a></li>
            <?php } ?>
        </ul>
    </div>
</body>
</html>

</div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

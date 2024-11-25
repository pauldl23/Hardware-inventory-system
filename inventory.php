<?php include 'header.php'; ?>
<?php
require 'db_connect.php';

// Handle quantity addition
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'], $_POST['quantity'], $_POST['inventory_id'])) {
    $inventory_id = (int)$_POST['inventory_id'];
    $quantity = (int)$_POST['quantity'];
    $action = $_POST['action'];

    // Fetch the current quantity
    $item_query = "SELECT product_quantity FROM tbl_inventory WHERE inventory_id = $inventory_id";
    $item_result = mysqli_query($conn, $item_query);
    $item = mysqli_fetch_assoc($item_result);

    if ($item) {
        $current_quantity = $item['product_quantity'];

        if ($action === 'add') {
            $new_quantity = $current_quantity + $quantity;
            mysqli_query($conn, "UPDATE tbl_inventory SET product_quantity = $new_quantity WHERE inventory_id = $inventory_id");
            echo "<div class='alert alert-success'>Added $quantity items to inventory ID $inventory_id.</div>";
        } elseif ($action === 'deduct' && $current_quantity >= $quantity && $quantity > 0) {
            $new_quantity = $current_quantity - $quantity;
            mysqli_query($conn, "UPDATE tbl_inventory SET product_quantity = $new_quantity WHERE inventory_id = $inventory_id");
            echo "<div class='alert alert-success'>Deducted $quantity items from inventory ID $inventory_id.</div>";
        } else {
            echo "<div class='alert alert-danger'>Invalid quantity operation.</div>";
        }
    }
}

// Fetch inventory items
$result = mysqli_query($conn, "SELECT * FROM tbl_inventory");
$items = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<link rel="stylesheet" href="styles.css">
<div id="inventory" class="main-content">
    <h1>Inventory</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Product ID</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($items as $item): ?>
                <tr>
                    <td><?php echo $item['product_name']; ?></td>
                    <td><?php echo $item['product_ID']; ?></td>
                    <td><?php echo $item['product_price']; ?></td>
                    <td><?php echo $item['product_quantity']; ?></td>
                    <td>
                        <form method="post" class="action-form">
                            <input type="number" name="quantity" min="1" required placeholder="Qty">
                            <input type="hidden" name="inventory_id" value="<?php echo $item['inventory_ID']; ?>">
                            <button type="submit" name="action" value="add" class="btn btn-success">Add</button>
                            <button type="submit" name="action" value="deduct" class="btn btn-danger">Deduct</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>

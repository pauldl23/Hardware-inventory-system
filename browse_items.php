<?php
include 'header.php';
require 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deduct_quantity'], $_POST['inventory_id'])) {
    $inventory_id = (int)$_POST['inventory_id'];
    $deduct_quantity = (int)$_POST['deduct_quantity'];
    $user_id = $_SESSION['userID']; // Adjust based on your session

    $item_result = mysqli_query($conn, "SELECT product_quantity FROM tbl_inventory WHERE inventory_id = $inventory_id");
    $item = mysqli_fetch_assoc($item_result);

    if ($item && $item['product_quantity'] >= $deduct_quantity && $deduct_quantity > 0) {
        $new_quantity = $item['product_quantity'] - $deduct_quantity;
        mysqli_query($conn, "UPDATE tbl_inventory SET product_quantity = $new_quantity WHERE inventory_id = $inventory_id");

        mysqli_query($conn, "INSERT INTO tbl_transaction (user_id, inventory_id, transaction_type, transaction_date) 
                             VALUES ($user_id, $inventory_id, 'deduct', NOW())");

        echo "<p style='color: green;'>Successfully deducted $deduct_quantity items from item ID $inventory_id.</p>";
    } else {
        echo "<p style='color: red;'>Invalid deduction amount. Ensure enough stock is available.</p>";
    }
}

$result = mysqli_query($conn, "SELECT * FROM tbl_inventory");
$items = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<h2>Inventory List</h2>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Product Name</th>
            <th>Product ID</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Deduct Quantity</th>
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
                    <form method="post">
                        <input type="number" name="deduct_quantity" min="1" max="<?php echo $item['product_quantity']; ?>" required>
                        <input type="hidden" name="inventory_id" value="<?php echo $item['inventory_ID']; ?>">
                        <button type="submit" class="btn btn-primary">Deduct</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

</div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

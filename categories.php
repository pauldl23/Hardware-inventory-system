<?php include 'header.php'; ?>
<?php
require 'db_connect.php';
$query = "SELECT DISTINCT product_category FROM tbl_inventory";
$result = mysqli_query($conn, $query);
$categories = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>
<div id="categories" class="main-content">
    <h1>Categories</h1>
    <ul>
        <?php foreach ($categories as $category): ?>
            <li><?php echo $category['product_category']; ?></li>
        <?php endforeach; ?>
    </ul>
</div>
</body>
</html>

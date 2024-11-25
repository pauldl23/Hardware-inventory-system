<?php
session_start();
require 'db_connect.php';

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true || $_SESSION['usertype'] !== 'Admin') {
    header("Location: login_screen.php");
    exit;
}

$result = mysqli_query($conn, "SELECT * FROM tbl_users");
$users = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<?php include 'header.php'; ?>

<h2>Manage Users</h2>

<table>
    <tr>
        <th>Username</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>User Type</th>
    </tr>
    <?php foreach ($users as $user): ?>
        <tr>
            <td><?php echo $user['username']; ?></td>
            <td><?php echo $user['firstname']; ?></td>
            <td><?php echo $user['lastname']; ?></td>
            <td><?php echo $user['usertype']; ?></td>
        </tr>
    <?php endforeach; ?>
</table>
</div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

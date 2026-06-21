<?php
session_start();

// 🛡️ GATEKEEPER: Force login
if (!isset($_SESSION['manager_logged_in']) || $_SESSION['manager_logged_in'] !== true) {
    header("Location: login.php");
    exit();
}

$conn = new mysqli("localhost", "root", "", "bitebase");

// Logout logic
if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    session_destroy();
    header("Location: index.php");
    exit();
}

// Update status logic
if (isset($_POST['update_status'])) {
    $order_id = intval($_POST['order_id']);
    $new_status = $conn->real_escape_string($_POST['order_status']);
    $conn->query("UPDATE orders SET status = '$new_status' WHERE id = $order_id");
    header("Location: order.php"); 
    exit();
}

// Delete order logic
if (isset($_GET['delete_id'])) {
    $conn->query("DELETE FROM orders WHERE id = ".intval($_GET['delete_id']));
    header("Location: order.php"); 
    exit();
}

$orders = $conn->query("SELECT * FROM orders ORDER BY id DESC");
?>
<!DOCTYPE html>
<html>
<head>
    <style>
        body { background: #f4f4f4; font-family: Arial, sans-serif; padding: 40px; }
        .box { max-width: 900px; margin: auto; background: #fff; border: 4px solid #000; padding: 25px; box-shadow: 8px 8px 0 #000; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th { background: #000; color: #fff; padding: 12px; text-align: left; }
        td { padding: 12px; border-bottom: 2px solid #000; font-weight: bold; }
        select { font-weight: bold; cursor: pointer; padding: 5px; border: 2px solid #000; }
    </style>
</head>
<body>
    <div class="box">
        <div style="display:flex; justify-content:space-between; align-items:center;">
            <h1 style="margin:0; font-size: 24px;">🛡️ BITEBASE ADMIN</h1>
            <a href="order.php?action=logout" style="background:#000; color:#fff; padding:10px 20px; text-decoration:none; font-weight:bold;">LOGOUT</a>
        </div>
        <table>
            <tr><th>ID</th><th>CUSTOMER</th><th>STATUS</th><th>ACTION</th></tr>
            <?php while($row = $orders->fetch_assoc()): ?>
            <tr>
                <td>#<?php echo $row['id']; ?></td>
                <td><?php echo htmlspecialchars($row['customer_name']); ?></td>
                <td>
                    <form method="POST">
                        <input type="hidden" name="order_id" value="<?php echo $row['id']; ?>">
                        <select name="order_status" onchange="this.form.submit()">
                            <option value="pending" <?php if($row['status']=='pending') echo 'selected'; ?>>PENDING</option>
                            <option value="delivered" <?php if($row['status']=='delivered') echo 'selected'; ?>>DELIVERED</option>
                        </select>
                        <input type="hidden" name="update_status" value="1">
                    </form>
                </td>
                <td><a href="order.php?delete_id=<?php echo $row['id']; ?>" style="color:red; text-decoration:none;">DELETE</a></td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>
</html>
<?php $conn->close(); ?>
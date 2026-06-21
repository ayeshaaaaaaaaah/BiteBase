<?php 
include 'db_connect.php'; 

// 1. Session Protection
if(!isset($_SESSION['manager_logged_in'])) {
    header("Location: login.php");
    exit();
}
?>
<html>
<head>
    <style>
        body { font-family: sans-serif; margin: 0; padding: 0; background: #fff; }
        .header { background: #000; color: #fff; padding: 20px 50px; display: flex; justify-content: space-between; align-items: center; }
        .header h1 { margin: 0; font-size: 24px; letter-spacing: 2px; }
        .logout-btn { color: #fff; border: 1px solid #fff; padding: 8px 15px; text-decoration: none; font-weight: bold; }
        .logout-btn:hover { background: #fff; color: #000; }
        
        .table-container { padding: 40px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th { border-bottom: 2px solid #000; padding: 10px; text-align: left; text-transform: uppercase; }
        td { border-bottom: 1px solid #ddd; padding: 15px; font-size: 14px; }
        .status-pending { color: red; font-weight: bold; }
        .status-delivered { color: green; font-weight: bold; }
        .action-btn { background: #000; color: #fff; padding: 5px 10px; text-decoration: none; font-size: 12px; }
    </style>
</head>
<body>

    <div class="header">
        <h1>MANAGER PANEL</h1>
        <a href="logout.php" class="logout-btn">LOGOUT</a>
    </div>

    <div class="table-container">
        <h2>Live Orders</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Customer Name</th>
                    <th>Items Ordered</th>
                    <th>Total Price</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // 2. Fetch all orders from the database
                $res = mysqli_query($conn, "SELECT * FROM orders ORDER BY id DESC");
                
                if(mysqli_num_rows($res) > 0) {
                    while($row = mysqli_fetch_assoc($res)) {
                        $statusClass = ($row['status'] == 'Pending') ? 'status-pending' : 'status-delivered';
                        
                        echo "<tr>
                                <td>#".$row['id']."</td>
                                <td>".$row['customer_name']."</td>
                                <td>".$row['items_ordered']."</td>
                                <td>Rs. ".$row['total_amount']."</td>
                                <td class='$statusClass'>".$row['status']."</td>
                                <td>";
                        
                        if($row['status'] == 'Pending') {
                            echo "<a href='update_status.php?id=".$row['id']."' class='action-btn'>MARK DELIVERED</a>";
                        } else {
                            echo "Completed";
                        }
                        
                        echo "</td></tr>";
                    }
                } else {
                    echo "<tr><td colspan='6' style='text-align:center;'>No orders placed yet.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

</body>
</html>
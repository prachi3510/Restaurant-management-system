<?php
session_start();
include '../backend/db.php';

// Admin check - fakt admin@gmail.com la entry
if(!isset($_SESSION['user_id']) || $_SESSION['user_email'] != 'admin@gmail.com'){
    header('Location: login.php?error=Admin access only');
    exit;
}

// Status update karne
if(isset($_POST['update_status'])){
    $order_id = $_POST['order_id'];
    $status = $_POST['status'];
    mysqli_query($conn, "UPDATE orders SET status='$status' WHERE id=$order_id");
    header('Location: admin.php?success=Status Updated');
    exit;
}

// Order delete karne
if(isset($_GET['delete'])){
    $order_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM orders WHERE id=$order_id");
    header('Location: admin.php?success=Order Deleted');
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel | Cafe11</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; margin: 20px; }
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: center; }
        th { background: #ff6b00; color: white; }
        .btn { padding: 5px 10px; border: none; cursor: pointer; border-radius: 4px; }
        .btn-update { background: green; color: white; }
        .btn-delete { background: red; color: white; }
        .success { background: green; color: white; padding: 10px; text-align: center; }
    </style>
</head>
<body>
    <h1>Admin Panel - All Orders</h1>
    <a href="../backend/logout.php">Logout</a>
    
    <?php if(isset($_GET['success'])) echo "<div class='success'>".$_GET['success']."</div>"; ?>

    <table>
        <tr>
            <th>Order ID</th>
            <th>Customer</th>
            <th>Items</th>
            <th>Total</th>
            <th>Date</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        <?php
        $result = mysqli_query($conn, "SELECT orders.*, users.name FROM orders 
                                       JOIN users ON orders.user_id = users.id 
                                       ORDER BY orders.created_at DESC");
        while($row = mysqli_fetch_assoc($result)){
        ?>
        <tr>
            <td>#<?php echo $row['id']; ?></td>
            <td><?php echo $row['customer_name']; ?><br><small><?php echo $row['name']; ?></small></td>
            <td><?php echo $row['items']; ?></td>
            <td>₹<?php echo $row['total_amount']; ?></td>
            <td><?php echo date('d-m-Y h:i A', strtotime($row['created_at'])); ?></td>
            <td>
                <form method="POST" style="display:inline;">
                    <input type="hidden" name="order_id" value="<?php echo $row['id']; ?>">
                    <select name="status" onchange="this.form.submit()">
                        <option <?php if($row['status']=='Pending') echo 'selected'; ?>>Pending</option>
                        <option <?php if($row['status']=='Completed') echo 'selected'; ?>>Completed</option>
                        <option <?php if($row['status']=='Cancelled') echo 'selected'; ?>>Cancelled</option>
                    </select>
                    <input type="hidden" name="update_status" value="1">
                </form>
            </td>
            <td>
                <a href="admin.php?delete=<?php echo $row['id']; ?>" class="btn btn-delete" 
                   onclick="return confirm('Delete this order?')">Delete</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>
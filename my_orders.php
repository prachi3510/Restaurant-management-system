<?php
session_start();
include '../backend/db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php?error=Please login first');
    exit;
}

$user_id = $_SESSION['user_id'];
$result = mysqli_query($conn, "SELECT * FROM orders WHERE user_id = '$user_id' ORDER BY id DESC");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>My Orders</title>
    <style>
        body { font-family: 'Poppins', sans-serif; background: #f4f7f6; padding: 20px; }
        .container { max-width: 900px; margin: auto; }
        h1 { color: #2c3e50; }
        .order-card { background: white; padding: 20px; border-radius: 10px; margin-bottom: 15px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .order-top { display: flex; justify-content: space-between; border-bottom: 1px solid #eee; padding-bottom: 10px; margin-bottom: 10px; }
        .status { padding: 5px 12px; border-radius: 20px; font-size: 0.8rem; font-weight: 600; }
        .Pending { background: #fff3cd; color: #856404; }
        .Confirmed { background: #d1ecf1; color: #0c5460; }
        .Preparing { background: #d4edda; color: #155724; }
        .Out_for_Delivery { background: #cce5ff; color: #004085; }
        .Delivered { background: #d4edda; color: #155724; }
        .Cancelled { background: #f8d7da; color: #721c24; }
        .items { font-size: 0.9rem; color: #555; }
    </style>
</head>
<body>
<div class="container">
    <h1>My Orders</h1>
    <?php if (mysqli_num_rows($result) == 0): ?>
        <p>You haven't placed any orders yet.</p>
    <?php else: ?>
        <?php while($order = mysqli_fetch_assoc($result)): ?>
            <div class="order-card">
                <div class="order-top">
                    <div>
                        <strong>Order #<?php echo $order['id']; ?></strong><br>
                        <small><?php echo date('d M Y, h:i A', strtotime($order['created_at'])); ?></small>
                    </div>
                    <span class="status <?php echo str_replace(' ', '_', $order['status']); ?>"><?php echo $order['status']; ?></span>
                </div>
                <div><strong>Total: ₹<?php echo $order['total_amount']; ?></strong> | <?php echo $order['payment_method']; ?></div>
                <div class="items"><strong>Address:</strong> <?php echo $order['address']; ?></div>
            </div>
        <?php endwhile; ?>
    <?php endif; ?>
</div>
</body>
</html>
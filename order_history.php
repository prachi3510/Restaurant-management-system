<?php
session_start();
include '../backend/db.php';

// Login check
if(!isset($_SESSION['user_id'])){
    header('Location: login.php?error=Please login first');
    exit;
}
$user_id = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Orders | Cafe11</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background: #f5f5f5; margin: 0; }
        .navbar { background: #ff6b00; color: white; padding: 15px; }
        .navbar a { color: white; text-decoration: none; margin: 0 10px; }
        .container { max-width: 900px; margin: 30px auto; padding: 20px; }
        h2 { color: #333; }
        .order-card {
            background: white;
            padding: 20px;
            margin-bottom: 15px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .order-header {
            display: flex;
            justify-content: space-between;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
            margin-bottom: 10px;
        }
        .order-id { font-weight: bold; color: #ff6b00; }
        .status {
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 12px;
            color: white;
        }
        .Pending { background: #ffa500; }
        .Completed { background: #28a745; }
        .Cancelled { background: #dc3545; }
        .order-total { font-size: 18px; font-weight: bold; }
    </style>
</head>
<body>
    <div class="navbar">
        <a href="menu.php">Menu</a> | 
        <a href="cart.php">Cart</a> | 
        <a href="order_history.php">My Orders</a> | 
        Welcome, <?php echo $_SESSION['user_name']; ?> | 
        <a href="../backend/logout.php">Logout</a>
    </div>

    <div class="container">
        <h2>My Order History</h2>
        
        <?php
        $sql = "SELECT * FROM orders WHERE user_id = '$user_id' ORDER BY created_at DESC";
        $res = mysqli_query($conn, $sql);
        
        if(mysqli_num_rows($res) > 0){
            while($order = mysqli_fetch_assoc($res)){
                echo "<div class='order-card'>";
                echo "<div class='order-header'>";
                echo "<span class='order-id'>Order #".$order['id']."</span>";
                echo "<span class='status ".$order['status']."'>".$order['status']."</span>";
                echo "</div>";
                echo "<p><b>Date:</b> ".$order['created_at']."</p>";
                echo "<p><b>Items:</b> ".$order['items']."</p>";
                echo "<p class='order-total'>Total: ₹".$order['total_amount']."</p>";
                echo "</div>";
            }
        } else {
            echo "<p>You haven't placed any orders yet. <a href='menu.php'>Order Now</a></p>";
        }
        ?>
    </div>
</body>
</html>
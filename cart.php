<?php
session_start();
include '../backend/db.php';
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$menu_items = [
    1 => ['name' => 'Paneer Tikka', 'price' => 180],
    2 => ['name' => 'Veg Manchurian', 'price' => 160],
    3 => ['name' => 'Spring Roll', 'price' => 130],
    4 => ['name' => 'Veg Cheese Pizza', 'price' => 250],
    5 => ['name' => 'Veg Burger', 'price' => 120],
    6 => ['name' => 'White Sauce Pasta', 'price' => 220],
    7 => ['name' => 'Grilled Sandwich', 'price' => 90],
    8 => ['name' => 'French Fries', 'price' => 100],
    9 => ['name' => 'Masala Maggie', 'price' => 80],
    10 => ['name' => 'Chicken Biryani', 'price' => 220],
    11 => ['name' => 'Chicken Pizza', 'price' => 320],
    12 => ['name' => 'Chicken Burger', 'price' => 160],
    13 => ['name' => 'Chicken Lollipop', 'price' => 200],
    14 => ['name' => 'Cold Coffee', 'price' => 90],
    15 => ['name' => 'Mint Mojito', 'price' => 110],
    16 => ['name' => 'Fresh Lemonade', 'price' => 70],
    17 => ['name' => 'Chocolate Milkshake', 'price' => 120],
    18 => ['name' => 'Gulab Jamun', 'price' => 60],
    19 => ['name' => 'Chocolate Ice Cream', 'price' => 80],
    20 => ['name' => 'Choco Brownie', 'price' => 110],
    21 => ['name' => 'Chocolate Pastry', 'price' => 70],
];

if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $id => $qty) {
        if (!isset($menu_items[$id]))
            unset($_SESSION['cart'][$id]);
    }
}
$total = 0;
?>
<!DOCTYPE html>
<html>

<head>
    <title>Your Cart | Cafe11</title>
    <style>
        body { margin: 0; font-family: 'Segoe UI', sans-serif; background: #f4f6f8 }
        .navbar { background: #ff6b00; color: white; padding: 12px 5%; display: flex; justify-content: space-between }
        .navbar a { color: white; margin: 0 10px; text-decoration: none }
        .container { max-width: 1000px; margin: 30px auto; padding: 20px; background: white; border-radius: 8px }
        table { width: 100%; border-collapse: collapse }
        th, td { padding: 15px; text-align: center; border-bottom: 1px solid #ddd }
        th { background: #e8f0fe }
        .qty-btn { padding: 4px 8px; margin: 0 3px; cursor: pointer; border: 1px solid #ddd; background: white }
        .remove-btn { background: #e74c3c; color: white; border: none; padding: 6px 10px; border-radius: 4px; cursor: pointer }
        .total { text-align: right; font-size: 20px; font-weight: bold; padding: 20px }
        .order-box { padding: 20px; text-align: right }
        .order-box input { padding: 10px; width: 300px; margin: 5px 0; border: 1px solid #ddd; border-radius: 4px }
        .order-box button { padding: 12px 25px; background: #ff6b00; color: white; border: none; border-radius: 5px; cursor: pointer; font-weight: 600; margin-top: 10px }
        .empty-cart { padding: 40px; text-align: center; color: #777 }
    </style>
</head>

<body>
    <div class="navbar">
        <div>Welcome, <b><?php echo $_SESSION['user_name']; ?></b></div>
        <div>
            <a href="../index.php">Home</a>
            <a href="menu.php">Menu</a>
            <a href="cart.php">Cart</a>
            <a href="order_history.php">My Orders</a>
            <a href="../backend/logout.php">Logout</a>
        </div>
    </div>

    <div class="container">
        <h2>Your Cart</h2>
        <a href="menu.php">← Back to Menu</a>
        <table>
            <tr>
                <th>Name</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Subtotal</th>
                <th>Action</th>
            </tr>
            <?php
            if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                foreach ($_SESSION['cart'] as $id => $qty) {
                    if (isset($menu_items[$id])) {
                        $item = $menu_items[$id];
                        $subtotal = $item['price'] * $qty;
                        $total += $subtotal;
                        echo "<tr>
                            <td>{$item['name']}</td><td>₹{$item['price']}</td>
                            <td><button class='qty-btn' onclick='updateQty($id, -1)'>-</button> $qty <button class='qty-btn' onclick='updateQty($id, 1)'>+</button></td>
                            <td>₹$subtotal</td>
                            <td><button class='remove-btn' onclick='removeItem($id)'>Remove</button></td>
                        </tr>";
                    }
                }
            }
            if ($total == 0)
                echo "<tr><td colspan='5' class='empty-cart'>Cart is empty</td></tr>";
            ?>
        </table>

        <div class="total">Total: ₹<?php echo $total; ?></div>

        <?php if ($total > 0) { ?>
            <div class="order-box">
                <form action="checkout.php" method="POST">
                    <label>Customer Name: </label><br>
                    <input type="text" name="customer_name" value="<?php echo $_SESSION['user_name']; ?>" required><br>
                    
                    <label>Payment Method: </label><br>
                    <input type="text" value="Cash on Delivery" readonly style="background:#eee;"><br>
                    <input type="hidden" name="payment_method" value="COD">
                    
                    <button type="submit">Proceed to Checkout ₹<?php echo $total; ?></button>
                </form>
            </div>
        <?php } ?>
    </div>

    <script>
        function updateQty(id, change) {
            fetch(`../backend/update_cart.php?id=${id}&change=${change}`).then(res => res.json()).then(data => { if (data.status == 'success') location.reload(); });
        }
        function removeItem(id) {
            fetch(`../backend/remove_from_cart.php?id=${id}`).then(res => res.json()).then(data => { if (data.status == 'success') location.reload(); });
        }
    </script>
</body>
</html>
<?php
session_start();
include 'db.php';
header('Content-Type: application/json');

// Menu items cha array - cart.php sarka same pahije
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

$total = 0;
$customer_name = $_POST['customer_name'] ?? $_SESSION['user_name'];
$user_id = $_SESSION['user_id'];

if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])){
    foreach($_SESSION['cart'] as $id => $qty){
        if(isset($menu_items[$id])){
            $total += $menu_items[$id]['price'] * $qty;
        }
    }
    
    // DB madhe order save kar - tujhya table nusar query badal
    // $sql = "INSERT INTO orders (user_id, customer_name, total_amount, order_date) VALUES ('$user_id', '$customer_name', '$total', NOW())";
    // mysqli_query($conn, $sql);
    
    // Cart empty kar
    unset($_SESSION['cart']);
    echo json_encode(['status' => 'success', 'message' => "Order placed! Total: ₹$total"]);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Cart is empty']);
}
?>
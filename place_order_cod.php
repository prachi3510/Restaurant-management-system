<?php
session_start();
include 'db.php';

// Login check
if (!isset($_SESSION['user_id'])) {
    header('Location: ../frontend/login.php?error=Please login first');
    exit;
}

$user_id = $_SESSION['user_id'];
$name = mysqli_real_escape_string($conn, $_POST['name']);
$phone = mysqli_real_escape_string($conn, $_POST['phone']);

// Address details
$street = mysqli_real_escape_string($conn, $_POST['street']);
$landmark = mysqli_real_escape_string($conn, $_POST['landmark']);
$city = mysqli_real_escape_string($conn, $_POST['city']);
$pincode = mysqli_real_escape_string($conn, $_POST['pincode']);
$latitude = mysqli_real_escape_string($conn, $_POST['latitude']);
$longitude = mysqli_real_escape_string($conn, $_POST['longitude']);
$instructions = mysqli_real_escape_string($conn, $_POST['instructions']);

// Full address banavla
$address = "$street, Landmark: $landmark, $city - $pincode";
if (!empty($instructions)) {
    $address .= ", Instructions: $instructions";
}
if (!empty($latitude)) {
    $address .= ", GPS: $latitude, $longitude";
}

$cart = $_SESSION['cart'];

// Menu items + price list
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

// Total calculate kar
$total = 0;
$delivery = 40;
foreach ($cart as $id => $qty) {
    $total += $menu_items[$id]['price'] * $qty;
}
$total += $delivery;

// Cart empty check
if ($total == $delivery) {
    header('Location: ../frontend/cart.php?error=Cart is empty');
    exit;
}

// Order DB madhe save kar
$order_sql = "INSERT INTO orders (user_id, customer_name, phone, address, total_amount, payment_method, status) 
              VALUES ('$user_id', '$name', '$phone', '$address', '$total', 'Cash on Delivery', 'Pending')";
mysqli_query($conn, $order_sql);
$order_id = mysqli_insert_id($conn);

// Order items save kar
foreach ($cart as $id => $qty) {
    $price = $menu_items[$id]['price'];
    mysqli_query($conn, "INSERT INTO order_items (order_id, menu_id, quantity, price) 
                         VALUES ('$order_id', '$id', '$qty', '$price')");
}

// Save address for next time - Saved Addresses feature
$save_address_sql = "UPDATE users SET 
    saved_street = '$street',
    saved_landmark = '$landmark', 
    saved_city = '$city',
    saved_pincode = '$pincode',
    saved_latitude = '$latitude',
    saved_longitude = '$longitude'
    WHERE id = '$user_id'";
mysqli_query($conn, $save_address_sql);

// WhatsApp message tayar kar
$whatsapp_number = "7741001176"; // <-- ITHE TUZA CAFE CHA NUMBER TAK 91 + 10 digit

$msg = "🔔 *New Order #$order_id*\n\n";
$msg .= "*Customer:* $name\n";
$msg .= "*Phone:* $phone\n";
$msg .= "*Total:* ₹$total\n";
$msg .= "*Payment:* Cash on Delivery\n\n";

// ITEMS LIST ADD KELI 👇
$msg .= "*Items Ordered:*\n";
foreach ($cart as $id => $qty) {
    $msg .= "• " . $menu_items[$id]['name'] . " x " . $qty . " = ₹" . ($menu_items[$id]['price'] * $qty) . "\n";
}
$msg .= "\n";

// ESTIMATED TIME ADD KELE 👇
$delivery_time = date('h:i A', strtotime('+40 minutes'));
$msg .= "*Estimated Delivery Time:* $delivery_time (30-40 mins)\n\n";

$msg .= "*Delivery Address:*\n$address";

$whatsapp_link = "https://wa.me/$whatsapp_number?text=" . urlencode($msg);

// 403 fix: Link Session madhe save keli, URL madhe nahi
$_SESSION['wa_link'] = $whatsapp_link;
unset($_SESSION['cart']);
header("Location: ../frontend/order_success.php?order_id=$order_id");
exit;
?>
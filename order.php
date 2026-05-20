<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $user_id = $_SESSION['user_id'];
    $customer_name = $_POST['customer_name'];
    $items = $_POST['items'];
    $total = $_POST['total'];
    
    // SQL Injection sathi clean kar
    $user_id = mysqli_real_escape_string($conn, $user_id);
    $customer_name = mysqli_real_escape_string($conn, $customer_name);
    $items = mysqli_real_escape_string($conn, $items);
    $total = mysqli_real_escape_string($conn, $total);
    
    // Database madhe save kar
    $sql = "INSERT INTO orders (user_id, customer_name, items, total_amount, status) 
            VALUES ('$user_id', '$customer_name', '$items', '$total', 'Pending')";
            
    if (mysqli_query($conn, $sql)) {
        // Cart empty kar
        unset($_SESSION['cart']);
        header("Location: ../frontend/menu.php?success=Order Placed Successfully!");
        exit;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    header("Location: ../frontend/menu.php");
    exit;
}
?>
<?php
session_start();
header('Content-Type: application/json');

$id = $_GET['id'] ?? 0;
$change = $_GET['change'] ?? 0;

if($id > 0){
    // Jar cart madhe item nasel tar 0 set kar
    if(!isset($_SESSION['cart'][$id])){
        $_SESSION['cart'][$id] = 0;
    }
    
    $_SESSION['cart'][$id] += $change;
    
    // Qty 0 kinva kami zali tar cart madhun kadhun tak
    if ($_SESSION['cart'][$id] <= 0) {
        unset($_SESSION['cart'][$id]);
    }
}

echo json_encode(['status' => 'success']);
?>
<?php
session_start();
header('Content-Type: application/json');

$id = $_GET['id'];
unset($_SESSION['cart'][$id]);

echo json_encode(['status' => 'success']);
?>
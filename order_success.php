<?php
session_start();
$order_id = isset($_GET['order_id']) ? $_GET['order_id'] : 'N/A';
$wa_link = isset($_SESSION['wa_link']) ? $_SESSION['wa_link'] : ''; // Session madhun link ghetli
unset($_SESSION['wa_link']); // Ekda vapralyavar delete kar
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Placed - Cafe</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        body { font-family: 'Poppins', sans-serif; background: #f4f7f6; display: flex; align-items: center; justify-content: center; height: 100vh; margin: 0; }
        .success-box { background: white; padding: 40px; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); text-align: center; max-width: 450px; }
        .icon { font-size: 5rem; color: #27ae60; }
        h1 { color: #2c3e50; margin: 20px 0 10px; }
        p { color: #555; margin-bottom: 30px; }
        .btn { padding: 12px 25px; border-radius: 8px; text-decoration: none; font-weight: 600; margin: 5px; display: inline-block; }
        .btn-home { background: #3498db; color: white; }
        .btn-wa { background: #25D366; color: white; }
        .btn-wa i { margin-right: 8px; }
    </style>
</head>
<body>
    <div class="success-box">
        <div class="icon"><i class="fa fa-check-circle"></i></div>
        <h1>Order Placed Successfully!</h1>
        <p>Thank you for your order. Your Order ID is <strong>#<?php echo $order_id; ?></strong>. We will deliver it to you soon.</p>
        
        <?php if (!empty($wa_link)): ?>
        <a href="<?php echo $wa_link; ?>" class="btn btn-wa" target="_blank">
            <i class="fab fa-whatsapp"></i> Send to WhatsApp
        </a>
        <?php endif; ?>
        
        <a href="menu.php" class="btn btn-home">Continue Shopping</a>
    </div>
</body>
</html>
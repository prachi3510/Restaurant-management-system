<?php
session_start();
include '../backend/db.php';
if(!isset($_SESSION['user_id'])){
    header('Location: login.php');
    exit;
}

$menu_items = [
    1 => ['name' => 'Paneer Tikka', 'price' => 180, 'img'=>'paneer-tikka.jpg'],
    2 => ['name' => 'Veg Manchurian', 'price' => 160, 'img'=>'manchurian.jpg'],
    3 => ['name' => 'Spring Roll', 'price' => 130, 'img'=>'spring-roll.jpg'],
    4 => ['name' => 'Veg Cheese Pizza', 'price' => 250, 'img'=>'veg-pizza.jpg'],
    5 => ['name' => 'Veg Burger', 'price' => 120, 'img'=>'veg-burger.jpg'],
    6 => ['name' => 'White Sauce Pasta', 'price' => 220, 'img'=>'pasta.jpg'],
    7 => ['name' => 'Grilled Sandwich', 'price' => 90, 'img'=>'sandwich.jpg'],
    8 => ['name' => 'French Fries', 'price' => 100, 'img'=>'fries.jpg'],
    9 => ['name' => 'Masala Maggie', 'price' => 80, 'img'=>'maggie.jpg'],
    10 => ['name' => 'Chicken Biryani', 'price' => 220, 'img'=>'biryani.jpg'],
    11 => ['name' => 'Chicken Pizza', 'price' => 320, 'img'=>'chicken-pizza.jpg'],
    12 => ['name' => 'Chicken Burger', 'price' => 160, 'img'=>'chicken-burger.jpg'],
    13 => ['name' => 'Chicken Lollipop', 'price' => 200, 'img'=>'lollipop.jpg'],
    14 => ['name' => 'Cold Coffee', 'price' => 90, 'img'=>'coffee.jpg'],
    15 => ['name' => 'Mint Mojito', 'price' => 110, 'img'=>'mojito.jpg'],
    16 => ['name' => 'Fresh Lemonade', 'price' => 70, 'img'=>'lemonade.jpg'],
    17 => ['name' => 'Chocolate Milkshake', 'price' => 120, 'img'=>'milkshake.jpg'],
    18 => ['name' => 'Gulab Jamun', 'price' => 60, 'img'=>'gulabjamun.jpg'],
    19 => ['name' => 'Chocolate Ice Cream', 'price' => 80, 'img'=>'icecream.jpg'],
    20 => ['name' => 'Choco Brownie', 'price' => 110, 'img'=>'brownie.jpg'],
    21 => ['name' => 'Chocolate Pastry', 'price' => 70, 'img'=>'pastry.jpg'],
];

$subtotal = 0;
$delivery = 40;
if(isset($_SESSION['cart'])){
    foreach($_SESSION['cart'] as $id => $qty){
        $subtotal += $menu_items[$id]['price'] * $qty;
    }
}
$total = $subtotal + $delivery;
?>
<!DOCTYPE html>
<html>
<head>
    <title>Checkout | Cafe11</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; }
        body { 
            font-family: 'Poppins', sans-serif; 
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 20px; 
            margin: 0; 
            min-height: 100vh;
        }
        
        .steps { display: flex; justify-content: center; margin-bottom: 30px; gap: 10px; }
        .step { display: flex; align-items: center; color: white; opacity: 0.5; }
        .step.active { opacity: 1; font-weight: 600; }
        .step i { background: rgba(255,255,255,0.2); width: 30px; height: 30px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 8px; }
        .step.active i { background: #fff; color: #667eea; }
        .step-line { width: 40px; height: 2px; background: rgba(255,255,255,0.3); margin: 0 5px; }
        
        .main { display: flex; gap: 20px; max-width: 1200px; margin: 0 auto; flex-wrap: wrap; }
        .container, .summary { 
            background: rgba(255,255,255,0.95); 
            padding: 30px; 
            border-radius: 20px; 
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            backdrop-filter: blur(10px);
        }
        .container { flex: 1.5; min-width: 340px; }
        .summary { flex: 1; min-width: 320px; height: fit-content; position: sticky; top: 20px; }
        
        h2 { margin: 0 0 20px 0; color: #333; font-size: 28px; }
        h3 { margin: 0 0 20px 0; color: #333; font-size: 22px; }
        
        .input-group { position: relative; margin: 15px 0; }
        .input-group i { position: absolute; left: 15px; top: 14px; color: #667eea; }
        input, textarea { 
            width: 100%; 
            padding: 12px 12px 12px 45px; 
            border: 2px solid #e0e0e0; 
            border-radius: 10px; 
            font-size: 15px;
            font-family: 'Poppins';
            transition: 0.3s;
        }
        input:focus, textarea:focus { outline: none; border-color: #667eea; box-shadow: 0 0 0 3px rgba(102,126,234,0.1); }
        
        .row { display: flex; gap: 10px; }
        .row .input-group { width: 50%; }
        
        button { 
            width: 100%; 
            padding: 15px; 
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white; 
            border: none; 
            border-radius: 12px; 
            cursor: pointer; 
            font-size: 17px; 
            font-weight: 600;
            transition: 0.3s;
            box-shadow: 0 5px 15px rgba(102,126,234,0.4);
        }
        button:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(102,126,234,0.6); }
        
        .gps-btn { 
            background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%) !important; 
            margin-bottom: 15px;
            box-shadow: 0 5px 15px rgba(17,153,142,0.4) !important;
        }
        .gps-btn:hover { box-shadow: 0 8px 20px rgba(17,153,142,0.6) !important; }
        
        .badge {
            display: inline-block;
            background: #ffeaa7;
            color: #d63031;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 15px;
        }
        
        .sum-row { 
            display: flex; 
            justify-content: space-between; 
            align-items: center;
            margin: 12px 0;
            color: #555;
        }
        .item-row { display: flex; align-items: center; gap: 10px; margin: 12px 0; }
        .item-img { width: 50px; height: 50px; border-radius: 8px; object-fit: cover; }
        .item-name { flex: 1; font-size: 14px; color: #333; }
        .total { 
            font-weight: 700; 
            font-size: 20px; 
            color: #667eea; 
            border-top: 2px dashed #e0e0e0; 
            padding-top: 15px;
            margin-top: 15px;
        }
        #loc_status { color: #11998e; font-size: 13px; margin-top: -5px; display: block; }
        
        @media(max-width: 768px) {
            .main { flex-direction: column-reverse; }
            .summary { position: static; }
        }
    </style>
</head>
<body>
    <div class="steps">
        <div class="step"><i class="fa fa-shopping-cart"></i> Cart</div>
        <div class="step-line"></div>
        <div class="step active"><i class="fa fa-map-marker-alt"></i> Address</div>
        <div class="step-line"></div>
        <div class="step"><i class="fa fa-check"></i> Success</div>
    </div>

    <div class="main">
        <div class="container">
            <span class="badge"><i class="fa fa-bolt"></i> 30 mins delivery</span>
            <h2><i class="fa fa-money-bill-wave" style="color:#667eea;"></i> Cash on Delivery</h2>
            
            <form action="../backend/place_order_cod.php" method="POST">
                <div class="input-group">
                    <i class="fa fa-user"></i>
                    <input type="text" name="name" placeholder="Full Name" value="<?php echo $_SESSION['user_name']; ?>" required>
                </div>
                
                <div class="input-group">
                    <i class="fa fa-phone"></i>
                    <input type="text" name="phone" placeholder="10 digit mobile number" required pattern="[0-9]{10}">
                </div>
                
                <div class="input-group">
                    <i class="fa fa-home"></i>
                    <input type="text" name="street" placeholder="House No / Building / Street" required>
                </div>
                
                <div class="input-group">
                    <i class="fa fa-map-pin"></i>
                    <input type="text" name="landmark" placeholder="Landmark for easy tracking" required>
                </div>
                
                <div class="row">
                    <div class="input-group">
                        <i class="fa fa-city"></i>
                        <input type="text" name="city" placeholder="City" value="Jintur" required>
                    </div>
                    <div class="input-group">
                        <i class="fa fa-map"></i>
                        <input type="text" name="pincode" placeholder="Pincode" value="431509" required pattern="[0-9]{6}">
                    </div>
                </div>

                <!-- DELIVERY INSTRUCTIONS ADDED -->
                <div class="input-group">
                    <i class="fa fa-comment-dots"></i>
                    <textarea name="instructions" rows="2" placeholder="Delivery Instructions: e.g. Ring bell 2 times, Don't call, Leave at door"></textarea>
                </div>

                <button type="button" class="gps-btn" onclick="getLocation()">
                    <i class="fa fa-location-crosshairs"></i> Use My Current Location
                </button>
                <input type="hidden" name="latitude" id="latitude">
                <input type="hidden" name="longitude" id="longitude">
                <small id="loc_status"></small>
                
                <button type="submit">
                    <i class="fa fa-check-circle"></i> Place Order - COD ₹<?php echo $total; ?>
                </button>
            </form>
        </div>

        <div class="summary">
            <h3><i class="fa fa-receipt"></i> Order Summary</h3>
            <?php
            if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                foreach ($_SESSION['cart'] as $id => $qty) {
                    if (isset($menu_items[$id])) {
                        $item = $menu_items[$id];
                        $item_total = $item['price'] * $qty;
                        $img = isset($item['img']) ? $item['img'] : 'default.jpg';
                        echo "<div class='item-row'>
                                <img src='images/$img' class='item-img' onerror=\"this.src='https://via.placeholder.com/50'\">
                                <span class='item-name'>{$item['name']} x $qty</span>
                                <span><b>₹$item_total</b></span>
                              </div>";
                    }
                }
            } else {
                echo "<div class='sum-row'><span>Cart is empty</span></div>";
            }
            ?>
            <hr style="border: none; border-top: 2px dashed #e0e0e0; margin: 15px 0;">
            <div class='sum-row'><span>Subtotal</span><span>₹<?php echo $subtotal; ?></span></div>
            <div class='sum-row'><span>Delivery Fee</span><span>₹<?php echo $delivery; ?></span></div>
            <div class='sum-row total'><span>Total Amount</span><span>₹<?php echo $total; ?></span></div>
        </div>
    </div>

    <script>
    function getLocation() {
        if (navigator.geolocation) {
            document.getElementById("loc_status").innerText = "⏳ Fetching location...";
            navigator.geolocation.getCurrentPosition(showPosition, showError);
        } else {
            alert("Geolocation is not supported by this browser.");
        }
    }
    function showPosition(position) {
        document.getElementById("latitude").value = position.coords.latitude;
        document.getElementById("longitude").value = position.coords.longitude;
        document.getElementById("loc_status").innerText = "✅ Location Captured Successfully!";
    }
    function showError(error) {
        document.getElementById("loc_status").innerText = "❌ Please allow location permission.";
    }
    </script>
</body>
</html>
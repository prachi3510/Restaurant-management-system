<?php
// Error reporting chalu kar - actual error baghayla
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include '../backend/db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php?error=Please login first');
    exit;
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Menu | Cafe11</title>
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background: #f4f6f8;
        }

        .navbar {
            background: #ff6b00;
            color: white;
            padding: 12px 5%;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar a {
            color: white;
            margin: 0 10px;
            text-decoration: none;
        }

        .navbar a:hover {
            text-decoration: underline;
        }

        .filters {
            text-align: center;
            margin: 20px 0;
        }

        .filters button {
            padding: 10px 20px;
            margin: 5px;
            cursor: pointer;
            border: 1px solid #ddd;
            border-radius: 5px;
            background: white;
        }

        .filters button.active {
            background: #ff5722;
            color: white;
            border-color: #ff5722;
        }

        #menu-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 25px;
            padding: 0 5% 40px 5%;
        }

        .menu-item {
            border: 1px solid #ddd;
            border-radius: 8px;
            background: white;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: 0.3s;
        }

        .menu-item:hover {
            transform: translateY(-5px);
        }

        .menu-item h3 {
            margin: 5px 0;
            font-size: 18px;
        }

        .menu-item p {
            margin: 5px 0;
            color: #555;
        }

        .menu-item button {
            width: 100%;
            padding: 10px;
            background: #e67e22;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 600;
            margin-top: 10px;
        }

        .menu-item button:hover {
            background: #d35400;
        }

        .cart-float {
            position: fixed;
            top: 70px;
            right: 10px;
            background: #ff5722;
            color: white;
            padding: 10px;
            border-radius: 5px;
            text-decoration: none;
        }

        .success-msg {
            background: green;
            color: white;
            padding: 10px;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="navbar">
        <div>
            Welcome, <b><?php echo $_SESSION['user_name']; ?></b>
        </div>
        <div>
            <a href="../index.php">Home</a>
            <a href="menu.php">Menu</a>
            <a href="cart.php">Cart</a>
            <a href="order_history.php">My Orders</a>
            <a href="../backend/logout.php">Logout</a>
        </div>
    </div>

    <?php if (isset($_GET['success']))
        echo "<div class='success-msg'>" . $_GET['success'] . "</div>"; ?>

    <a href="cart.php" class="cart-float">
        🛒 Cart: <span id="cart-count">0</span>
    </a>

    <h2 style="text-align:center;margin-top:20px;">Our Menu</h2>

    <div class="filters">
        <button onclick="filterMenu('All')" class="active">All</button>
        <button onclick="filterMenu('Veg')">Veg</button>
        <button onclick="filterMenu('Non-Veg')">Non-Veg</button>
        <button onclick="filterMenu('Drinks')">Drinks</button>
        <button onclick="filterMenu('Desserts')">Desserts</button>
    </div>

    <div id="menu-container">
        <?php include '../backend/menu.php'; ?>
    </div>

    <script>
        function filterMenu(category) {
            document.querySelectorAll('.filters button').forEach(btn => btn.classList.remove('active'));
            event.target.classList.add('active');

            fetch(`../backend/menu.php?category=${category}`)
                .then(res => res.text())
                .then(data => {
                    document.getElementById('menu-container').innerHTML = data;
                });
        }

        function addToCart(id) {
            fetch(`../backend/add_to_cart.php?id=${id}`)
                .then(res => res.json())
                .then(data => {
                    document.getElementById('cart-count').innerText = data.count;
                });
        }

        fetch('../backend/get_cart_count.php')
            .then(res => res.json())
            .then(data => {
                document.getElementById('cart-count').innerText = data.count;
            });
    </script>
</body>

</html>
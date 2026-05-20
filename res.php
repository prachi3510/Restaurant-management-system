<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cafe11</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        /* ===== GLOBAL ===== */
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            overflow-x: hidden;
        }

        /* ===== GALAXY BACKGROUND ===== */
        .galaxy {
            position: fixed;
            width: 100%;
            height: 100%;
            z-index: -1;
            background: radial-gradient(circle at 20% 30%, #1a2a6c, transparent),
                radial-gradient(circle at 80% 70%, #b21f1f, transparent),
                radial-gradient(circle at 50% 50%, #000000, #050505);
        }

        /* STARS */
        .galaxy::before {
            content: "";
            position: absolute;
            width: 200%;
            height: 200%;
            background: url('https://www.transparenttextures.com/patterns/stardust.png');
            animation: starsMove 120s linear infinite;
            opacity: 0.6;
        }

        /* TWINKLE */
        .galaxy::after {
            content: "";
            position: absolute;
            width: 200%;
            height: 200%;
            background: url('https://www.transparenttextures.com/patterns/stardust.png');
            animation: twinkle 60s linear infinite;
            opacity: 0.3;
        }

        /* ANIMATION */
        @keyframes starsMove {
            from {
                transform: translate(0, 0);
            }

            to {
                transform: translate(-500px, -500px);
            }
        }

        @keyframes twinkle {
            from {
                transform: translate(0, 0);
            }

            to {
                transform: translate(500px, 500px);
            }
        }

        /* ===== HEADER ===== */
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 25px 40px;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(8px);
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 25px;
            font-weight: bold;
        }

        .logo img {
            height: 45px;
            border-radius: 50%;
        }

        /* BUTTONS */
        .auth button {
            margin-left: 10px;
            padding: 8px 16px;
            border-radius: 6px;
            border: none;
            cursor: pointer;
        }

        .login {
            border: 1px solid #333;
            background: #e22626;
        }

        .signup {
            background: #d04f0f;
            color: white;
        }

        /* NAV */
        nav {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(6px);
            padding: 20px;
            display: flex;
            align-items: center;
        }

        nav a {
            margin: 0 15px;
            text-decoration: none;
            color: #333;
        }

        .cart {
            margin-left: auto;
            margin-right: 40px;
        }

        /* ===== SLIDER ===== */
        .slider {
            width: 95%;
            height: 320px;
            margin: 20px auto;
            overflow: hidden;
            border-radius: 10px;
        }

        .slides {
            display: flex;
            width: 300%;
            animation: slide 9s infinite;
        }

        .slide {
            width: 100%;
            position: relative;
        }

        .slide img {
            width: 100%;
            height: 320px;
            object-fit: cover;
        }

        /* OVERLAY */
        .overlay {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            color: white;
        }

        .overlay h2 {
            font-size: 32px;
            margin-bottom: 10px;
            text-shadow: 0 3px 10px rgba(0, 0, 0, 0.6);
        }

        .overlay a {
            padding: 10px 20px;
            background: #ff6b00;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        /* SLIDE ANIMATION */
        @keyframes slide {
            0% {
                margin-left: 0;
            }

            30% {
                margin-left: 0;
            }

            35% {
                margin-left: -100%;
            }

            65% {
                margin-left: -100%;
            }

            70% {
                margin-left: -200%;
            }

            95% {
                margin-left: -200%;
            }

            100% {
                margin-left: 0;
            }
        }

        /* ===== SECTION ===== */
        .section {
            padding: 20px 40px;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
        }

        .card {
            background: rgba(255, 255, 255, 0.9);
            padding: 10px;
            border-radius: 10px;
            text-align: center;
            backdrop-filter: blur(6px);
            transition: 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card img {
            width: 100%;
            border-radius: 10px;
        }

        .price {
            color: #ff6b00;
            font-weight: bold;
        }

        /* FOOTER */
        footer {
            background: rgba(0, 0, 0, 0.8);
            color: white;
            display: flex;
            justify-content: space-around;
            padding: 40px;
        }
    </style>
</head>

<body>

    <!-- GALAXY -->
    <div class="galaxy"></div>

    <!-- HEADER -->
    <header>
        <div class="logo">
            <img src="./image/logo.jpg">
            <span>Cafe11</span>
        </div>

        <div class="auth">
            <button onclick="window.location.href='login.html'">Login</button>
            <button class="signup" onclick="window.location.href='registration.html'">Signup</button>
        </div>
    </header>

    <!-- NAV -->
    <nav>
        <a href="res.html">Home</a>
        <a href="menu.html">Menu</a>
        <a href="checkout.html">Orders</a>
        <a href="cart.html">Cart</a>
        <a href="contact.html">Contact</a>

        <div class="cart">
            <i class="fa fa-shopping-cart"></i>
        </div>
    </nav>

    <!-- SLIDER -->
    <div class="slider">
        <div class="slides">

            <div class="slide">
                <img src="./images/slider1.jpg">
                <div class="overlay">
                    <h2>Delicious Food</h2>
                    <a href="menu.html">Order Now</a>
                </div>
            </div>

            <div class="slide">
                <img src="./images/slider2.jpg.jpeg">
                <div class="overlay">
                    <h2>Fresh & Tasty</h2>
                    <a href="menu.html">Order Now</a>
                </div>
            </div>

            <div class="slide">
                <img src="./images/slider3.jpg">
                <div class="overlay">
                    <h2>Best Quality</h2>
                    <a href="menu.html">Order Now</a>
                </div>
            </div>

        </div>
    </div>

    <!-- POPULAR -->
    <div class="section">
        <h2 style="color:white;">Popular Dishes</h2>

        <div class="cards">
            <div class="card">
                <img src="./images/pizza.png">
                <h4>Pizza</h4>
                <p class="price">₹250</p>
            </div>

            <div class="card">
                <img src="./images/burger.jpg">
                <h4>Burger</h4>
                <p class="price">₹180</p>
            </div>

            <div class="card">
                <img src="./images/pasta.jpg">
                <h4>Pasta</h4>
                <p class="price">₹220</p>
            </div>

            <div class="card">
                <img src="./images/fries.jpg">
                <h4>Fries</h4>
                <p class="price">₹100</p>
            </div>
        </div>
    </div>

    <!-- FOOTER -->
    <!-- FOOTER -->
    <footer style="background:#0b0f2a; color:white; padding:20px; text-align:center;">

        <div>📍7Star Satara</div>
        <div>📞 +91 9561957019</div>
        <div>📧 cafe11@gmail.com</div>

        <div style="margin-top:10px;">
            🕒 Open Hours: 10:00 AM - 11:00 PM
        </div>

        <div style="margin-top:10px;">
            🔗
            <a href="res.html" style="color:#00d4ff; text-decoration:none;">Home</a> |
            <a href="menu.html" style="color:#00d4ff; text-decoration:none;">Menu</a> |
            <a href="about.html" style="color:#00d4ff; text-decoration:none;">About</a> |
            <a href="contact.html" style="color:#00d4ff; text-decoration:none;">Contact</a>
        </div>

        <div style="margin-top:10px;">
            © 2026 7Star satara| All Rights Reserved
        </div>

    </footer>
</body>

</html>
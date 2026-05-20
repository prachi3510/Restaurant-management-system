<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Cafe11</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', sans-serif;
        }

        /* Background */
        body {
            height: 100vh;
            background: linear-gradient(135deg, #667eea, #764ba2);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Glass Card */
        .container {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(12px);
            border-radius: 20px;
            padding: 40px;
            width: 350px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
            text-align: center;
            color: white;
        }

        /* Icon */
        .icon {
            font-size: 50px;
            margin-bottom: 10px;
        }

        /* Title */
        h2 {
            margin-bottom: 20px;
        }

        /* Inputs */
        .input-box {
            width: 100%;
            margin: 10px 0;
            position: relative;
        }

        .input-box input {
            width: 100%;
            padding: 12px;
            border-radius: 10px;
            border: none;
            outline: none;
            background: rgba(255, 255, 255, 0.2);
            color: white;
        }

        .input-box input::placeholder {
            color: #eee;
        }

        /* Options */
        .options {
            display: flex;
            justify-content: space-between;
            font-size: 14px;
            margin: 10px 0;
        }

        .options a {
            color: #fff;
            text-decoration: none;
        }

        /* Buttons */
        .btn {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 10px;
            background: #ffffff;
            color: #333;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn:hover {
            background: #ddd;
            transform: scale(1.05);
        }

        /* Divider */
        .divider {
            margin: 20px 0;
            position: relative;
        }

        .divider::before,
        .divider::after {
            content: "";
            position: absolute;
            width: 40%;
            height: 1px;
            background: #fff;
            top: 50%;
        }

        .divider::before {
            left: 0;
        }

        .divider::after {
            right: 0;
        }

        .divider span {
            padding: 0 10px;
        }

        /* Signup */
        .signup {
            margin-top: 10px;
            font-size: 14px;
        }

        .signup a {
            color: #fff;
            font-weight: bold;
            text-decoration: none;
        }
        
        /* Error/Success Message */
        .error {
            background: rgba(255, 0, 0, 0.3);
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 15px;
            font-size: 14px;
        }
        .success {
            background: rgba(0, 255, 0, 0.3);
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 15px;
            font-size: 14px;
        }
    </style>

</head>

<body>
    <div class="container">
        <div class="icon">
            <i class="fa-regular fa-user"></i>
        </div>

        <h2>Login</h2>
        
        <!-- PHP Messages -->
        <?php if(isset($_GET['error'])) echo "<div class='error'>".$_GET['error']."</div>"; ?>
        <?php if(isset($_GET['success'])) echo "<div class='success'>".$_GET['success']."</div>"; ?>

        <form action="../backend/login.php" method="POST">
            <div class="input-box">
                <input type="email" name="email" placeholder="Email Address" required>
            </div>

            <div class="input-box">
                <input type="password" name="password" placeholder="Password" required>
            </div>

            <div class="options">
                <label><input type="checkbox"> Remember Me</label>
                <a href="#">Forgot?</a>
            </div>

            <button type="submit" name="login" class="btn">Login</button>
        </form>

        <div class="divider">
            <span>OR</span>
        </div>

        <div class="signup">
            New user? <a href="register.php">Create account</a>
        </div>
    </div>

</body>

</html>
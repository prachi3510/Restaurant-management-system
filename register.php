<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Cafe11</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', sans-serif;
        }

        body {
            height: 100vh;
            background: linear-gradient(135deg, #ff6b00, #ff914d);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            width: 400px;
            background: #fff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        .container h2 {
            margin-bottom: 20px;
            color: #333;
        }

        .input-box {
            margin: 10px 0;
            position: relative;
        }

        .input-box input {
            width: 100%;
            padding: 12px;
            border-radius: 8px;
            border: 1px solid #ccc;
            outline: none;
        }

        .input-box i {
            position: absolute;
            right: 10px;
            top: 12px;
            color: #888;
        }

        .btn {
            width: 100%;
            padding: 12px;
            margin-top: 15px;
            border: none;
            background: #ff6b00;
            color: white;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            transition: 0.3s;
        }

        .btn:hover {
            background: #e55a00;
        }

        .link {
            margin-top: 15px;
            font-size: 14px;
        }

        .link a {
            color: #ff6b00;
            text-decoration: none;
            font-weight: bold;
        }

        .error {
            color: red;
            margin-bottom: 10px;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Create Account</h2>

        <?php if(isset($_GET['error'])) echo "<p class='error'>".$_GET['error']."</p>"; ?>
        <?php if(isset($_GET['success'])) echo "<p style='color:green;'>".$_GET['success']."</p>"; ?>

        <form action="../backend/register.php" method="POST">
            <div class="input-box">
                <input type="text" name="name" placeholder="Full Name" required>
                <i class="fa fa-user"></i>
            </div>
            <div class="input-box">
                <input type="email" name="email" placeholder="Email Address" required>
                <i class="fa fa-envelope"></i>
            </div>
            <div class="input-box">
                <input type="password" name="password" placeholder="Password" required>
                <i class="fa fa-lock"></i>
            </div>
            <div class="input-box">
                <input type="password" name="confirm_password" placeholder="Confirm Password" required>
                <i class="fa fa-lock"></i>
            </div>
            <button type="submit" name="register" class="btn">Register</button>
            <div class="link">
                Already have an account?
                <a href="login.php">Login</a>
            </div>
        </form>
    </div>
</body>

</html>
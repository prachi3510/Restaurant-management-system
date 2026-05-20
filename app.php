<?php
session_start();

/* ================= DATABASE ================= */
$conn = new mysqli("localhost", "root", "", "cafe_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

/* ================= ACTION ================= */
$action = $_GET['action'] ?? '';

/* =================================================
   REGISTER
================================================= */
if ($action == "register") {

    if (!isset($_POST['name'], $_POST['email'], $_POST['password'])) {
        die("Missing value in the form!");
    }

    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $password);

    if ($stmt->execute()) {
        echo "<h2>Registration Successful ✅</h2>";
        echo "<a href='../login.html'>Go to Login</a>";
    } else {
        echo "❌ Email already exists!";
    }
}

/* =================================================
   LOGIN
================================================= */ elseif ($action == "login") {

    if (!isset($_POST['email'], $_POST['password'])) {
        die("Missing value in the form!");
    }

    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user['name'];

            header("Location: ../menu.php");
            exit();
        } else {
            echo "❌ Wrong password";
        }
    } else {
        echo "❌ User not found";
    }
}

/* =================================================
   CHECK LOGIN (for menu page)
================================================= */ elseif ($action == "check") {

    if (!isset($_SESSION['user'])) {
        header("Location: ../login.html");
        exit();
    }

    echo "Welcome " . $_SESSION['user'];
}

/* =================================================
   LOGOUT
================================================= */ elseif ($action == "logout") {
    session_destroy();
    header("Location: ../login.html");
    exit();
}
?>
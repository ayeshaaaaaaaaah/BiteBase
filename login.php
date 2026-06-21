<?php
session_start();
$conn = new mysqli("localhost", "root", "", "bitebase");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $_POST['password'];

    // Change 'admin'/'admin' to your desired credentials
    if ($username === 'admin' && $password === 'admin') {
        $_SESSION['manager_logged_in'] = true;
        header("Location: order.php");
        exit();
    } else {
        $error = "Invalid Credentials!";
    }
}
?>
<!DOCTYPE html>
<html>
<body style="background:#f4f4f4; font-family:sans-serif; display:flex; justify-content:center; align-items:center; height:100vh;">
    <form method="POST" style="background:#fff; padding:40px; border:4px solid #000; box-shadow:8px 8px 0 #000; width: 300px;">
        <h2 style="margin-top:0;">MANAGER LOGIN</h2>
        <?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
        <input type="text" name="username" placeholder="Username" required style="width:100%; padding:10px; margin:10px 0; border:2px solid #000; box-sizing:border-box;">
        <input type="password" name="password" placeholder="Password" required style="width:100%; padding:10px; margin:10px 0; border:2px solid #000; box-sizing:border-box;">
        <button type="submit" style="width:100%; padding:10px; background:#000; color:#fff; border:none; font-weight:bold; cursor:pointer;">LOGIN</button>
    </form>
</body>
</html>
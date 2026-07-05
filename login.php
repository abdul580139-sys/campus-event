
<?php
session_start();
include("includes/db.php");

if (isset($_POST['login'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {

        $user = mysqli_fetch_assoc($result);

        if (password_verify($password, $user['password'])) {

            
$_SESSION['user_id'] = $user['id'];
$_SESSION['fullname'] = $user['fullname'];
$_SESSION['role'] = $user['role'];   // Add this line

header("Location: dashboard.php");
exit();

        } else {
            echo "Incorrect password!";
        }

    } else {
        echo "User not found!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login - Campus Event System</title>
    <link rel="stylesheet" href="css/style.css">

</head>
<body>

<div class="container">

    <div class="card" style="max-width:450px;margin:80px auto;">

        <h1 style="text-align:center;color:#0d6efd;">
            Campus Event System
        </h1>

        <h3 style="text-align:center;margin-bottom:25px;">

            Student Login
        </h3>

        <form method="POST">

            <input
                type="email"
                name="email"
                placeholder="Enter your email"
                required>

          
            <input
                type="password"
                name="password"
                placeholder="Enter 

your password"
                required>

            <input
                type="submit"
                name="login"
                value="Login">


        </form>

        <br>

        <p style="text-align:center;">
            Don't have an account?
            <a href="register.php">

Register Here</a>
        </p>

    </div>

</div>

<div class="footer">
    © 2026 Campus Event Management 

System
</div>

</body>
</html>

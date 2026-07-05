<?php
session_start();
include("includes/db.php");

if (isset($_POST['register'])) {

    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $matric_number = $_POST['matric_number'];
    $department = $_POST['department'];
    $phone = $_POST['phone'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users
            (fullname, email, matric_number, department, phone, password)
            VALUES
            ('$fullname', '$email', '$matric_number', '$department', '$phone', '$password')";

    if (mysqli_query($conn, $sql)) {

        // Automatically log the user in
        $_SESSION['user_id'] = mysqli_insert_id($conn);

        // Redirect to dashboard
        header("Location: dashboard.php");
        exit();

    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Student Registration</title>
    <link rel="stylesheet" href="css/style.css">
</head>


<body>

<div class="container">

<div class="card" style="max-width:550px;margin:40px auto;">

<h1 style="text-align:center;color:#0d6efd;">
Student Registration
</h1>

<form method="POST">


<input type="text" name="fullname" placeholder="Enter Full Name" required>


<input type="email" name="email" 

placeholder="Enter Email" required>

<input type="password" name="password" placeholder="Enter Password" required>

<input type="text" name="matric_number" placeholder="Matric Number" required>

<input type="text" name="department" placeholder="Department" required>

<input type="text" name="phone" placeholder="Phone Number" required>
<input type="submit" name="register" value="Create Account">
</form>

<br>


<p style="text-align:center;">
Already have an account?
<a href="login.php">Login Here</a>
</p>

</div>

</div>

<div class="footer">
© 2026 Campus Event Management System
</div>

</body>

</html>

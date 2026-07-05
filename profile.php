<?php
session_start();
include("includes/db.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$query = mysqli_query($conn, "SELECT * FROM users WHERE id='$user_id'");
$user = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Profile</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="navbar">
    <h2>Campus Event</h2>

    <div>
        <a href="dashboard.php">Dashboard</a>
        <a href="events.php">Events</a>
        <a href="register_event.php">Register</a>
        <a href="view_registrations.php">My Events</a>
        <a href="profile.php">Profile</a>
        <a href="logout.php">Logout</a>
    </div>
</div>

<div class="container">

<div class="card" style="max-width:650px;margin:40px auto;">

<h2 style="text-align:center;color:#0d6efd;">My Profile</h2>

<table width="100%" cellpadding="10">

<tr>
    <td><strong>Full Name</strong></td>
    <td><?php echo $user['fullname']; ?></td>
</tr>

<tr>
    <td><strong>Email</strong></td>
    <td><?php echo $user['email']; ?></td>
</tr>

<tr>
    <td><strong>Matric Number</strong></td>
    <td><?php echo $user['matric_number']; ?></td>
</tr>

<tr>
    <td><strong>Department</strong></td>
    <td><?php echo $user['department']; ?></td>
</tr>

<tr>
    <td><strong>Phone Number</strong></td>
    <td><?php echo $user['phone']; ?></td>
</tr>

</table>

<br>

<div style="text-align:center;">
    <a href="edit_profile.php" class="btn">Edit Profile</a>
</div>

</div>

</div>

<div class="footer">
© 2026 Campus Event Management System | Developed by Abdullahi Yakubu
</div>

</body>
</html>
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

if (isset($_POST['update'])) {

    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $matric_number = $_POST['matric_number'];
    $department = $_POST['department'];
    $phone = $_POST['phone'];

    $sql = "UPDATE users SET
            fullname='$fullname',
            email='$email',
            matric_number='$matric_number',
            department='$department',
            phone='$phone'
            WHERE id='$user_id'";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Profile updated successfully!');</script>";

        $query = mysqli_query($conn, "SELECT * FROM users WHERE id='$user_id'");
        $user = mysqli_fetch_assoc($query);
    } else {
        echo "<script>alert('Update failed!');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Profile</title>
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

<div class="card" style="max-width:600px;margin:40px auto;">

<h2>Edit Profile</h2>

<form method="POST">

<label>Full Name</label>
<input type="text" name="fullname" value="<?php echo $user['fullname']; ?>" required>

<label>Email</label>
<input type="email" name="email" value="<?php echo $user['email']; ?>" required>

<label>Matric Number</label>
<input type="text" name="matric_number" value="<?php echo $user['matric_number']; ?>" required>

<label>Department</label>
<input type="text" name="department" value="<?php echo $user['department']; ?>" required>

<label>Phone Number</label>
<input type="text" name="phone" value="<?php echo $user['phone']; ?>" required>

<br><br>

<input type="submit" name="update" value="Update Profile">

</form>

<br>

<a href="profile.php">← Back to Profile</a>

</div>

</div>

<div class="footer">
© 2026 Campus Event Management System
</div>

</body>
</html>
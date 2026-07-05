<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Campus Event Management System</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="navbar">
    <h2>Campus Event</h2>

    <div>
        <a href="dashboard.php">Dashboard</a>
        <a href="events.php">Events</a>
        <a href="register_event.php">Register Event</a>
        <a href="view_registrations.php">My Registrations</a>
        <a href="profile.php">Profile</a>
        <a href="logout.php">Logout</a>
    </div>
</div>

<div class="container">

    <div class="welcome">
        <h1>Welcome to Campus Event Management System</h1>
        <p>Manage campus events quickly and easily.</p>

        <a href="events.php" class="btn">Explore Events</a>
    </div>

    <div class="cards">

        <a href="events.php" class="card">
            <h3>📅 View Events</h3>
            <p>See all available events</p>
        </a>

        <a href="register_event.php" class="card">
            <h3>📝 Register Event</h3>
            <p>Register for any event</p>
        </a>

        <a href="view_registrations.php" class="card">
            <h3>✅ My Registrations</h3>
            <p>View your registrations</p>
        </a>

        <a href="logout.php" class="card">
            <h3>🚪 Logout</h3>
            <p>Exit the system</p>
        </a>

    </div>

</div>

<div class="footer">
    © 2026 Campus Event Management System | Developed by Abdullahi Yakubu
</div>

</body>
</html>
<?php
session_start();
include("includes/db.php");

$sql = "SELECT * FROM events ORDER BY event_date ASC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Available Events</title>
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

<div class="page-title">
    <h1>Campus Events</h1>

    <p>Browse and register for upcoming campus events.</p>
</div>

<div class="container">

    <h1>Available Events</h1>


    <?php while($row = mysqli_fetch_assoc($result)){ ?>

    <div class="event-card">

        <h2><?php 

echo $row['title']; ?></h2>

        <p><strong>Description:</strong><br>
            <?php echo $row['description']; ?>
        </p>

        <p><strong>Date:</strong>
            <?php echo $row['event_date']; ?>
        </p>

        <a href="register_event

.php?event_id=<?php echo $row['id']; ?>" class="btn">
            Register Now
        </a>

    </div>

    <?php } ?>

</div>


<div class="footer">
    &copy; 2026 Campus Event Management System 
</div>
</body>
</html>

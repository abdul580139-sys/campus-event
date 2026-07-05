<?php
session_start();
include("includes/db.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Cancel registration
if (isset($_GET['cancel'])) {
    $id = $_GET['cancel'];

    mysqli_query($conn, "DELETE FROM registrations WHERE id='$id' AND user_id='$user_id'");

    header("Location: view_registrations.php");
    exit();
}

// Show only the logged-in user's registrations
$sql = "SELECT registrations.id,
               users.fullname,
               events.title,
               registrations.registered_date
        FROM registrations
        JOIN users ON registrations.user_id = users.id
        JOIN events ON registrations.event_id = events.id
        WHERE registrations.user_id='$user_id'";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Registrations</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="navbar">
    <h2>Campus Event</h2>

    <div class="nav-links">
        <a href="dashboard.php">Dashboard</a>
        <a href="events.php">Events</a>
        <a href="register_event.php">Register</a>
        <a href="view_registrations.php">My Events</a>
        <a href="profile.php">Profile</a>
        <a href="logout.php">Logout</a>
    </div>
</div>

<div class="page-title">
    <h1>My Registered Events</h1>
    <p>View and manage your event registrations.</p>
</div>

<div class="container">

<?php
if (mysqli_num_rows($result) > 0) {
?>

<table border="1" cellpadding="10" cellspacing="0" width="100%">
    <tr>
        <th>S/N</th>
        <th>Full Name</th>
        <th>Event</th>
        <th>Registration Date</th>
        <th>Action</th>
    </tr>

<?php
$sn = 1;
while ($row = mysqli_fetch_assoc($result)) {
?>

<tr>
    <td><?php echo $sn++; ?></td>
    <td><?php echo $row['fullname']; ?></td>
    <td><?php echo $row['title']; ?></td>
    <td><?php echo $row['registered_date']; ?></td>
    <td>
        <a href="view_registrations.php?cancel=<?php echo $row['id']; ?>"
           onclick="return confirm('Are you sure you want to cancel this registration?');">
           Cancel
        </a>
    </td>
</tr>

<?php
}
?>

</table>

<?php
} else {
    echo "<h3 style='text-align:center; color:red;'>You have not registered for any event yet.</h3>";
}
?>

</div>

<br>

<div style="text-align:center;">
    <a href="dashboard.php">Back to Dashboard</a>
</div>

</body>
</html>
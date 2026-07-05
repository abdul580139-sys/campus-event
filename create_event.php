<?php
session_start();
include("includes/db.php");

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Allow only admins
if ($_SESSION['role'] != 

'admin') {
    die("Access Denied! Only admins can create events.");
}

if (isset($_POST['create'])) {

    $title = $_POST['title'];
    $description = $_POST['description'];
    $venue = $_POST['venue'];
    $event_date = $_POST['event_date'];

    $sql = "INSERT INTO events(title, description, 

venue, event_date)
            VALUES('$title','$description','$venue','$event_date')";

    if (mysqli_query($conn, $sql)) {
        echo "Event created successfully!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>

<html>
<head>
    <title>Create Event</title>
     <link rel="stylesheet" href="css/style.css">

</head>
<body>

<h2>Create Event</h2>

<form method="POST">

    <input type="text" name="title" placeholder="Event Title" required><br><br>

    <textarea 

name="description" placeholder="Event Description" required></textarea><br><br>

    <input type="text" name="venue" placeholder="Venue" required><br><br>

    <input type="date" name="event_date" required><br><br>

    <button type="submit" name="create">Create Event</

button>

</form>

</body>
</html>

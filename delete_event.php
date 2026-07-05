<?php
session_start();
include("includes/db.php");

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Allow only admins

if ($_SESSION['role'] != 'admin') {
    die("Access Denied! Only admins can delete events.");
}

if(isset($_GET['id']))
{
    $id = $_GET['id'];

    $sql = "DELETE FROM events WHERE id='$id'";

    if(mysqli_query($conn, $sql))
    {
        header("Location: events.php");

        exit();
    }
    else
    {
        echo "Error deleting event.";
    }
}
else
{
    echo "No event selected.";
}
?>

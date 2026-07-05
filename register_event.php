<?php
session_start();
include("includes/db.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch logged-in user's details
$user_query = mysqli_query($conn, "SELECT * FROM users WHERE id='$user_id'");
$user = mysqli_fetch_assoc($user_query);

if (isset($_POST['register_event'])) {

    $fullname = $user['fullname'];
    $matric = $user['matric_number'];
    $department = $user['department'];
    $phone = $user['phone'];
    $note = $_POST['note'];
    $event_id = $_POST['event_id'];

    if (empty($event_id)) {

        echo "<p style='color:red;'>No event selected.</p>";

    } else {

        // Check if user has already registered
        $check = mysqli_query($conn, "SELECT * FROM registrations WHERE user_id='$user_id' AND event_id='$event_id'");

        if (mysqli_num_rows($check) > 0) {

            echo "<p style='color:red;'>You have already registered for this event.</p>";

        } else {

            $sql = "INSERT INTO registrations
                    (user_id, event_id, fullname, matric_number, department, phone, note)
                    VALUES
                    ('$user_id', '$event_id', '$fullname', '$matric', '$department', '$phone', '$note')";

            if (mysqli_query($conn, $sql)) {
                echo "<p style='color:green;'>Event registration successful!</p>";
            } else {
                echo "<p style='color:red;'>Error: " . mysqli_error($conn) . "</p>";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register for Event</title>
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

<div class="register-container">

<h2>Register for an Event</h2>

<form action="" method="POST">

<label>Full Name</label>
<input type="text" name="fullname" value="<?php echo $user['fullname']; ?>" readonly>

<label>Matric Number</label>
<input type="text" name="matric" value="<?php echo $user['matric_number']; ?>" readonly>

<label>Select Event</label>
<select name="event_id" required>
    <option value="">Choose an Event</option>

<?php
$result = mysqli_query($conn, "SELECT * FROM events");

while ($row = mysqli_fetch_assoc($result)) {
?>
    <option value="<?php echo $row['id']; ?>">
        <?php echo $row['title']; ?>
    </option>
<?php
}
?>

</select>

<label>Department</label>
<input type="text" name="department" value="<?php echo $user['department']; ?>" readonly>

<label>Phone Number</label>
<input type="text" name="phone" value="<?php echo $user['phone']; ?>" readonly>

<label>Additional Note</label>
<textarea name="note" rows="4"></textarea>

<button type="submit" name="register_event">Register</button>

</form>

</div>

<br><br>

<a href="dashboard.php">Back to Dashboard</a>

</body>
</html>
<?php
include 'db_connect.php'; // Include the database connection

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT Password FROM AdminUsers WHERE Username = '$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['Password'])) {
        // Password is correct, start a new session and redirect to the admin dashboard
        session_start();
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_username'] = $username;
        header('Location: admin_dashboard.php'); // Redirect to the admin dashboard
    } else {
        // Password is not correct
        header('Location: admin_InvaliPasswoed.php'); //
    }
} else {
    // Username not found
    header('Location: admin_unknownUser.php'); // 
}
$conn->close();
?>

<?php
include 'db_connect.php'; // Include the database connection

$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];

// Password hashing for security
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Prepared statement to prevent SQL Injection
$stmt = $conn->prepare("INSERT INTO AdminUsers (Username, Email, Password) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $username, $email, $hashed_password);

if ($stmt->execute() === TRUE) {
    header('Location: new_admin_login.php');
    // Optionally, redirect to the login page or admin dashboard
    // header('Location: admin_login.php');
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>

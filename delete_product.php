<?php
include 'db_connect.php'; // Include the database connection

if (isset($_GET['id'])) {
    $productID = $_GET['id'];

    // First, fetch the image filename from the database
    $sql = "SELECT Image FROM Products WHERE ProductID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $productID);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $imageFile = $row['Image'];

    // Delete the image file from the server
    if ($imageFile && file_exists("uploads/" . $imageFile)) {
        unlink("upload/" . $imageFile);
    }

    // Then, delete the product from the database
    $sql = "DELETE FROM Products WHERE ProductID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $productID);

    if ($stmt->execute()) {
        echo "Product deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    $stmt->close();
} else {
    echo "No product ID provided";
}

$conn->close();
header('Location: admin_dashboard.php'); // Redirect back to the admin dashboard
?>

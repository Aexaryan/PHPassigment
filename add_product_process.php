<?php
include 'db_connect.php'; // Database connection

$name = $_POST['name'];
$description = $_POST['description'];
$price = $_POST['price'];

// Handle the image upload
$target_dir = "upload/";
$target_file = $target_dir . basename($_FILES["image"]["name"]);
move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

$image = basename($_FILES["image"]["name"]); // Store only file name

// Insert the product into the database
$sql = "INSERT INTO Products (Name, Description, Price, Image) VALUES ('$name', '$description', '$price', '$image')";

if ($conn->query($sql) === TRUE) {
    echo "New product added successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
header('Location: admin_dashboard.php'); // Redirect back to the admin dashboard
?>
<?php include 'footer.php'; ?>
<?php

session_start();

// Check if the admin is logged in, if not, redirect to the login page
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: admin_login.php');
    exit;
}
$adminUsername = isset($_SESSION['admin_username']) ? $_SESSION['admin_username'] : "Unknown Admin";
include 'db_connect.php'; // Include the database connection

// Fetch products from the database for display or management
$sql = "SELECT ProductID, Name, Description, Price, Image FROM Products";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <div class="header">
        <h1>Admin Dashboard</h1>
        <span>Welcome, <?php echo htmlspecialchars($adminUsername); ?></span> <!-- Display admin's username -->
        <a href="logout_process.php">Logout</a>
    </div>
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            background-color: #003151;
            color: white;
        }
        .header h1 {
            margin: 0;
        }
        h2 {
        text-align: center;
        color: #003151; /* Adjust the color */
        margin-top: 30px;
        margin-bottom: 30px;
        font-family: 'Arial', sans-serif;
        font-size: 1.8em; /* Adjust the size */
    }
        .header a {
            color: #fff;
            text-decoration: none;
            background-color: #0069d9;
            padding: 8px 15px;
            border-radius: 5px;
        }
        .container {
            padding: 20px;
        }
        .product-add-form, .product {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            margin-bottom: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        input, textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type='submit'] {
            background-color: #28a745;
            color: white;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        input[type='submit']:hover {
            background-color: #218838;
        }
        .product img {
            max-width: 100px;
            height: auto;
            margin-bottom: 10px;
        }
        .product-container {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 20px;
            padding: 20px;
            padding-bottom: 100px;
            background-color: rgb(255,255,255, 0.5)
        }
        .product a {
            text-decoration: none;
            color: #007bff;
             padding-top: 20px;
        }
        .product a:hover {
            text-decoration: underline;
        }
    </style>
    <script>
function confirmDelete(productName, productId) {
    if (confirm("Are you sure you want to delete the product '" + productName + "'?")) {
        window.location.href = "delete_product.php?id=" + productId;
    }
}
</script>
</head>
<body>


    <!-- Form for Adding New Products -->
    <div class="product-add-form">
        <h2>Add New Product</h2>
        <form action="add_product_process.php" method="post" enctype="multipart/form-data">
            <input type="text" name="name" placeholder="Product Name" required><br>
            <textarea name="description" placeholder="Product Description" required></textarea><br>
            <input type="number" name="price" placeholder="Price" step="0.01" required><br>
            <input type="file" name="image" required><br>
            <input type="submit" value="Add Product">
        </form>
    </div>
    <h2>Manage Products</h2>
    <!-- Displaying Products -->
    <div class="product-container">
        
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='product'>";
                echo "<p>ID: " . $row['ProductID'] . "</p>";
                echo "<p>Name: " . $row['Name'] . "</p>";
                echo "<p>Description: " . $row['Description'] . "</p>";
                echo "<p>Price: $" . $row['Price'] . "</p>";
                echo "<p><img src='upload/" . $row['Image'] . "' alt='" . $row['Name'] . "' style='width:100px;'></p>";
                echo "<a href='edit_product.php?id=" . $row['ProductID'] . "'>Edit</a> | <a href='javascript:void(0);' onclick='confirmDelete(\"" . $row['Name'] . "\", " . $row['ProductID'] . ");'>Delete</a>";
                echo "</div>";
            }
        } else {
            echo "<p>No products found</p>";
        }
        ?>
    </div>
</body>
<?php include 'footer.php'; ?>
</html>

<?php
$conn->close();
?>

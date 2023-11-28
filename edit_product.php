<?php
include 'db_connect.php'; // Include the database connection
if (isset($_GET['id'])) {
    $productID = $_GET['id'];

    // Fetch existing product details
    $sql = "SELECT * FROM Products WHERE ProductID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $productID);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();
    
    if (!$product) {
        echo "Product not found";
        exit;
    }
} else {
    echo "No product ID provided";
    exit;
}
$adminUsername = isset($_SESSION['admin_username']) ? $_SESSION['admin_username'] : "Admin";
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $imageChanged = false;

    // Check if a new image was uploaded
    if (!empty($_FILES["image"]["name"])) {
        // Handle the new image upload
        $target_dir = "upload/";
        $imageName = basename($_FILES["image"]["name"]);
        $target_file = $target_dir . $imageName;
        move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
        $imageChanged = true;
    } else {
        $imageName = $product['Image'];
    }

    // Update the product in the database
    $sql = "UPDATE Products SET Name = ?, Description = ?, Price = ?, Image = ? WHERE ProductID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssdsi", $name, $description, $price, $imageName, $productID);

    if ($stmt->execute()) {
        echo "Product updated successfully";
        // Redirect to the admin dashboard
        header('Location: admin_dashboard.php');
        exit;
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Product</title>
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
        .header a, .header span {
            color: #fff;
            text-decoration: none;
            background-color: #0069d9;
            padding: 8px 15px;
            border-radius: 5px;
        }
        .container {
            padding: 20px;
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-top: 10px;
        }
        input[type='text'], input[type='number'], textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type='submit'] {
            margin-top: 20px;
            padding: 10px;
            border: none;
            border-radius: 4px;
            color: white;
            background-color: #28a745;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        input[type='submit']:hover {
            background-color: #218838;
        }
        img {
            margin-top: 15px;
            max-width: 100px;
            height: auto;
            border-radius: 4px;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: blue;
            color: white;
            text-decoration: none; /* Removes underline from links */
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .button:hover {
            background-color: darkblue; /* Change color on hover */
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Edit Product</h1>
        <div>
            <span>Welcome, <?php echo htmlspecialchars($adminUsername); ?></span>
            <a href="logout_process.php">Logout</a>
        </div>
    </div>

    <div class="container">
        <form action="edit_product.php?id=<?php echo $productID; ?>" method="post" enctype="multipart/form-data">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($product['Name']); ?>" required>

            <label for="description">Description:</label>
            <textarea id="description" name="description" required><?php echo htmlspecialchars($product['Description']); ?></textarea>

            <label for="price">Price:</label>
            <input type="number" id="price" name="price" value="<?php echo htmlspecialchars($product['Price']); ?>" step="0.01" required>

            <label for="image">Image:</label>
            <input type="file" id="image" name="image">
            <?php if (!empty($product['Image'])): ?>
                <img src="upload/<?php echo htmlspecialchars($product['Image']); ?>" alt="Product Image">
            <?php endif; ?>

            <input type="submit" value="Update Product">
        </form>
            </br>
        <a href="admin_dashboard.php" class="button">Cancele</a>
    </div>
</body>
<?php include 'footer.php'; ?>
</html>
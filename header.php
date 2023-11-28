<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Alexander Technology Company</title>
    <style>
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 40px;
            background-color: #004766;
            color: white;
            margin-bottom: 40px;
        }
        h1 {
            margin: 0;
            font-size: 1.5em; /* Adjust size as needed */
        }
        .button {
    padding: 10px 20px;
    color: white;
    background-color: #007bff; /* Bright blue, you can choose your color */
    text-decoration: none;
    border: none;
    border-radius: 4px;
    transition: background-color 0.3s, box-shadow 0.3s, transform 0.3s;
    margin-left: 10px; /* Spacing between buttons */
    font-weight: bold; /* Make text bold */
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2); /* Subtle shadow for depth */
}

.button:hover, .button:focus {
    background-color: #0056b3; /* Darker shade on hover */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3); /* Larger shadow on hover for a "lifting" effect */
    transform: translateY(-2px); /* Slight lift on hover */
}

        /
    </style>
</head>
<body>
    <header class="header">
        <h1>Alexander Tech</h1>
        <div>
            <a href="index.php" class="button">Home</a>
            <a href="admin_login.php" class="button">Login</a>
            <a href="admin_register.php" class="button">Sign Up</a>
        </div>
    </header>
</body>
</html>

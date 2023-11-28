<!DOCTYPE html>
<html lang="en">
<?php include 'header.php'; ?>
<head>
    <meta charset="UTF-8">
    <title>Admin Registration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        .form-container {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            max-width: 300px;
            margin: auto;
        }
        input[type='text'], input[type='email'], input[type='password'] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type='submit'] {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 4px;
            color: white;
            background-color: blue;
            cursor: pointer;
        }
        input[type='submit']:hover {
            background-color: darkblue;
        }
    </style>
</head>
<body>
<?php include 'global_body.php'; ?>
    <div class="form-container">
        <h2>Admin Registration</h2>
        <form action="register_process.php" method="post">
            <input type="text" id="username" name="username" placeholder="Username" required><br>
            <input type="email" id="email" name="email" placeholder="Email" required><br>
            <input type="password" id="password" name="password" placeholder="Password" required><br>
            <input type="submit" value="Register">
        </form>
        </br>
    </br>
    
    </div>
</body>
<?php include 'footer.php'; ?>
</html>

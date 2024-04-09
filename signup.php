<?php
    include 'connect.php';
    if(isset($_POST['create']))
    {
        $userName = $_POST['username'];
        $password = $_POST['password'];

        $stmt = $conn->prepare("select * from user where userName = ?");
        $stmt->bind_param("s", $userName);
        $stmt->execute();
        $stmt_result = $stmt->get_result();

        if($stmt_result->num_rows == 0)
        {
            $stmt->close();
            $stmt = $conn->prepare("insert into user(userName, password) values(?,?)");
            $stmt->bind_param("ss", $userName, $password);
            $stmt->execute();
            
            setcookie("userName","$userName");
            header("Location: projectInfo.php");
        }
        else
        {
            echo "Username already exists!";
        }

        $stmt->close();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('bgImg.jpeg'); 
            background-size: cover;
            background-position: center; 
        }

        .login-container {
            width: 300px;
            margin: 100px auto;
            background-color: rgba(255, 255, 255, 0.8); 
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
        }

        .input-group {
            margin-bottom: 20px;
        }

        .input-group label {
            display: block;
            margin-bottom: 5px;
        }

        .input-group input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        p {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Create account</h2>
        <form method="post">
            <div class="input-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" placeholder="Enter new username" required>
            </div>
            <div class="input-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" placeholder="Enter new password" required>
            </div>
            <button type="submit" name="create">Create</button>
        </form>
        <p>Existing user? <a href="login.php">Login</a></p>
    </div>
</body>
</html>
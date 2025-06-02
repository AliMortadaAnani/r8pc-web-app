<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>R8PC - Your PC Companion</title>
    <meta name="description" content="Discover what to buy, upgrade your components, and rate your PC's performance in a beautiful way with R8PC. Explore a seamless experience for optimizing your computer.">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
            margin: 0;
            padding: 0;
        }

        #header {
            background-color: whitesmoke;
            padding: 15px;
            color: white;
            font-size: 20px;
            font-weight: bold;
        }

        #container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #333;
        }

        p {
            color: #555;
        }

        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }

        select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        a {
            display: block;
            margin-top: 20px;
            color: #4caf50;
            text-decoration: none;
        }
        .styled-link {
            display: inline-block;
            padding: 10px 20px;
            background-color: #3498db;
            color: #fff;
            text-decoration: none;
            font-size: 16px;
            border-radius: 5px;
            transition: background-color 0.3s ease-in-out;
        }

        .styled-link:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>

<div id="header">
    <p>R8PC - Your PC Companion</p>
    <p>Discover what to buy, upgrade your components, and rate your PC's performance with R8PC.<br> Explore a seamless experience for optimizing your computer.</p>
</div>

<div id="container">
    <?php
    session_start();

   
    if (isset($_SESSION['username'])) {
        $username = $_SESSION['username'];
        echo "<h1>Welcome, $username!</h1>";
        echo "<p>You are now logged in.</p>";
        echo '<a href="Loginform/logout.php">Logout</a>';
    } else {
    
        header("Location: Loginform/login.php");
        exit();
    }

  
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        $selectedOperation = $_POST['operation'];

    
        switch ($selectedOperation) {
            case 'buyPC':
    
                header("Location:buy.php");
                break;
            case 'upgradePC':
               
                header("Location:upgrade.php");
                break;
            case 'ratePC':
               
                header("Location:rate.php");
                break;
            default:
        }
    }
    ?>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="operation">Choose an operation:</label>
        <select name="operation" id="operation" required>
            <option value="buyPC">Buy PC</option>
            <option value="upgradePC">Upgrade PC</option>
            <option value="ratePC">Rate PC</option>
        </select>
        <br>
        <input type="submit" value="Submit">
    </form>
</div>
<div class="container">
        <a href="statistics.php" class="styled-link">Go to Statistics Page</a>
    </div>
</body>
</html>

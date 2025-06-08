<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
            margin: 0;
            padding: 0;
        }

        #container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #4caf50;
            color: white;
        }

        a {
            display: block;
            margin-top: 20px;
            color: #4caf50;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div id="container">
        <?php  
        
        include "ConnectDB.php";

        
        if (!$dbc) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Most Searched GPUs
        echo "<h2>Most Searched GPUs:</h2>";
        $TopSearchedGPU = "SELECT Name, searched, (searched / (SELECT SUM(searched) FROM gpu)) * 100 AS search_percentage
        FROM gpu
        ORDER BY searched DESC
        LIMIT 5";
        displayTable($TopSearchedGPU);

        // Most Suggested GPUs
        echo "<h2>Most Suggested GPUs:</h2>";
        $TopSuggestedGPU = "SELECT Name, suggested, (suggested / (SELECT SUM(suggested) FROM gpu)) * 100
        FROM gpu
        ORDER BY suggested DESC
        LIMIT 5";
        displayTable($TopSuggestedGPU);

        // Most Searched CPUs
        echo "<h2>Most Searched CPUs:</h2>";
        $TopSearchedCPU = "SELECT Name, searched, (searched/ (SELECT SUM(searched) FROM cpu)) * 100
        FROM cpu
        ORDER BY searched DESC
        LIMIT 5";
        displayTable($TopSearchedCPU);

        // Most Suggested CPUs
        echo "<h2>Most Suggested CPUs:</h2>";
        $TopSuggestedCPU = "SELECT Name, suggested, (suggested / (SELECT SUM(suggested) FROM cpu)) * 100
        FROM cpu
        ORDER BY suggested DESC
        LIMIT 5";
        displayTable($TopSuggestedCPU);

        echo "<h2>Most Suggested Laptops:</h2>";
        $TopSuggestedLaptops = "SELECT Name, suggested, (suggested / (SELECT SUM(suggested) FROM cpu)) * 100
        FROM laptops
        ORDER BY suggested DESC
        LIMIT 5";
        displayTable($TopSuggestedLaptops);

       
        mysqli_close($dbc);

       
        function displayTable($query) {
            global $dbc;
            $result = @mysqli_query($dbc, $query);
            echo "<table>";
            echo "<tr><th>Name</th><th>Value</th><th>Percentage</th></tr>";
            while ($row = @mysqli_fetch_array($result))
            {   
                echo "<tr>";
                echo "<td>".$row[0]."</td><td>".$row[1]."</td><td>".$row[2]."%</td>";
                echo "</tr>";
            }
            echo "</table>";
        }
        ?>
    </div>
    <a href="index.php">Go to Home</a>
</body>
</html>
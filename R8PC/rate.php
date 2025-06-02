
<?php
include "ConnectDB.php";
include "test2.php";
?>


<!DOCTYPE >
<html>

<head>
    <title>Rate PC(What Can your PC Run)</title>
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

        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }

        input[type="text"],
        select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }

        input[type="radio"] {
            margin-top: 10px;
            margin-bottom: 10px;
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
    </style>
</head>

<body>

<h1>Rate PC (What can your PC Run)</h1>
    <form method="post" action="tables.php">

        <label for="hardware">Select hardware : </label>

        <div>
            <select name="cpu" id="hardware" style="width: 186px;">
                <option value="">Select CPU</option>
                <?php
                $query = "select name from cpu";
                $result = executeQuery($dbc, $query);

                if ($result = @mysqli_query($dbc, $query)) {



                    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                        echo "<option value='" . $row['name'] . "'>" . $row['name'] . "</option>";
                    }
                } ?>
            </select>
        </div>
        <div>
            <select name="gpu" id="hardware2"  style="width: 186px;">
                <option value="">Select GPU</option>
                <?php
                $query = "SELECT name from gpu";
                $result = executeQuery($dbc, $query);

                if ($result = @mysqli_query($dbc, $query)) {



                    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                        echo "<option value='" . $row['name'] . "'>" . $row['name'] . "</option>";
                    }
                } ?>
            </select>
        </div>
        <div>
            <select name="ram" id="hardware3"  style="width: 186px;">
                <option value="">Select RAM</option>
                <?php
                $query = "SELECT amount from ram";
                $result = executeQuery($dbc, $query);

                if ($result = @mysqli_query($dbc, $query)) {



                    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                        echo "<option value='" . $row['amount'] . "'>" . $row['amount'] . "</option>";
                    }
                } ?>
            </select>
        </div>
        <br>

        <br>

        <input type="submit" value="Submit">
    </form>

    <?php



mysqli_close($dbc);
?>

<a href="2.php">Go to Home</a>
</body>

</html>
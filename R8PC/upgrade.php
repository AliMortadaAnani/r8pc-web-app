<?php
        include "ConnectDB.php";
        include "test2.php";
        ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upgrade PC(CPU & GPU &RAM Recommendations)</title>
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
<h1>Upgrade PC(CPU & GPU & RAM Recommendations)</h1>
    <div id="container">
       
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        

            <div>
                <label for="software">Select software(favourite):</label>
                <select name="software" id="software">
                    <option value="">Select software</option>

                    <?php
                    $query = "SELECT name from Programs ";
                    $result = executeQuery($dbc, $query);

                    if ($result = @mysqli_query($dbc, $query)) {
                        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                            echo "<option value='".$row['name']."'>" . $row['name'] . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <br>
   

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
          if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        
        
        
    $selectedSoftware = isset($_POST['software']) ? $_POST['software'] : '';
 
    $selectedCPU = isset($_POST['cpu']) ? $_POST['cpu'] : '';
    $selectedGPU = isset($_POST['gpu']) ? $_POST['gpu'] : '';
    $selectedRAM = isset($_POST['ram']) ? $_POST['ram'] : '';
    
    if(
       
        checkEmptyAndAlert($selectedSoftware,"Please select your favourite software!")
        ||

        checkEmptyAndAlert($selectedCPU, "Please enter your cpu!") ||
        checkEmptyAndAlert($selectedGPU, "Please select your gpu!") ||
        checkEmptyAndAlert($selectedRAM, "Please select your ram!")
        )
         {
            exit();
         }
         else{   

        $query = "SELECT lcpu, mcpu, hcpu, lgpu, mgpu, hgpu, lram, mram, hram FROM programs WHERE name = ?";
        $stmt = mysqli_prepare($dbc, $query);
        
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "s", $selectedSoftware);
            mysqli_stmt_execute($stmt);
        
            $result = mysqli_stmt_get_result($stmt);
        
            
            if ($result) {
                $row = $result->fetch_assoc();
        
                if ($row) {
                   
                    $specs = [
                        'hcpu' => $row['hcpu'],
                        'mcpu' => $row['mcpu'],
                        'lcpu' => $row['lcpu'],
                        'hgpu' => $row['hgpu'],
                        'mgpu' => $row['mgpu'],
                        'lgpu' => $row['lgpu'],
                        'hram' => $row['hram'],
                        'mram' => $row['mram'],
                        'lram' => $row['lram']
                    ];
        
                    $lcpu = $specs['lcpu'];
                    $mcpu = $specs['mcpu'];
                    $hcpu = $specs['hcpu'];
                    $lgpu = $specs['lgpu'];
                    $mgpu = $specs['mgpu'];
                    $hgpu = $specs['hgpu'];
                    $lram = $specs['lram'];
                    $mram = $specs['mram'];
                    $hram = $specs['hram'];
                } else {
                    echo "No data found for the selected software.";
                }
            } else {
                echo "Query execution failed: " . mysqli_error($dbc);
            }
        
            mysqli_stmt_close($stmt);
        }else {
            echo "Prepared statement error: " . mysqli_error($dbc);
        }
        





        
         
        

        $cpuPerformance = getData($dbc, $selectedCPU, 'SELECT performance FROM cpu WHERE name = ?');
        $gpuPerformance = getData($dbc, $selectedGPU, 'SELECT performance FROM gpu WHERE name = ?');
        $ramAmount = $selectedRAM;

        
        if ($cpuPerformance < $lcpu)
        {   echo "LOW-Performance CPU Recommendations :<br>";
            fetchPerformanceData($dbc, 'cpu', 'performance', 'name', 'price', $lcpu, $mcpu, 3);
        }
        if ($gpuPerformance < $lgpu)
        {   echo "LOW-Performance GPU Recommendations :<br>";
            fetchPerformanceData($dbc, 'gpu', 'performance', 'name', 'price', $lgpu, $mgpu, 3);
        }
        if ($ramAmount < $lram)
        {   
            echo "LOW-Performance RAM Recommendations :<br>";
            RamUpgrade($lram,$mram,$dbc);
        }
        




        if ($cpuPerformance < $mcpu)
        {   
            echo "MID-Performance CPU Recommendations :<br>";
            fetchPerformanceData($dbc, 'cpu', 'performance', 'name', 'price', $mcpu, $hcpu, 3);
        }
        if ($gpuPerformance < $mgpu)
        {   
            echo "MID-Performance GPU Recommendations :<br>";
            fetchPerformanceData($dbc, 'gpu', 'performance', 'name', 'price', $mgpu, $hgpu, 3);
        }
        if ($ramAmount < $mram)
        {   
            echo "MID-Performance RAM Recommendations :<br>";
            RamUpgrade($mram,$hram,$dbc);
        }    
          


        if ($cpuPerformance < $hcpu)
        {   
            echo "HIGH-Performance CPU Recommendations :<br>";
            fetchPerformanceData($dbc, 'cpu', 'performance', 'name', 'price', $hcpu,$hcpu*1000, 3);
            //unreachable upperbound
        }
        if ($gpuPerformance < $hgpu)
        {   
            echo "HIGH-Performance GPU Recommendations :<br>";
            fetchPerformanceData($dbc, 'gpu', 'performance', 'name', 'price', $hgpu,$hgpu*1000, 3);
        }
        if ($ramAmount < $hram)
        {   
            echo "HIGH-Performance RAM Recommendations :<br>";
            RamUpgrade($hram,1000,$dbc);
        }  


        if ($cpuPerformance > $hcpu)
        {
            echo "No need to upgrade your CPU<br>";
        }
        if ($gpuPerformance > $hgpu)
        {
            echo "No need to upgrade your GPU <br>";
        }
        if ($ramAmount >= $hram)
        {
            echo "NO need to upgrade your RAM <br>";
        } 
           

        








         }
        }
        mysqli_close($dbc); 
        ?>

<a href="index.php">Go to Home</a>
    </div>

</body>

</html>
    
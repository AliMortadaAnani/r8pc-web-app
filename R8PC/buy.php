
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buy PC(CPU & GPU Recommendations)</title>
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
<h1>Buy PC(CPU & GPU & Laptops Recommendations)</h1>
    <div id="container">
        <?php
        include "ConnectDB.php";
        include "test2.php";
        ?>

        <form method="post" action="">
            <label for="budget">Budget($):</label> <br>
            <input type="text" name="budget" id="budget"> <br>
            <br>

            <div>
                <label for="software">Select software(favourite):</label>
                <select name="software" id="software">
                    <option value="">Select software</option>

                    <?php
                    $query = "SELECT name from Programs ";
                    $result = executeQuery($dbc, $query);

                    if ($result = @mysqli_query($dbc, $query)) {
                        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                            echo "<option value='" . $row['name'] . "'>" . $row['name'] . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <br>
            <br> <label>Device :</label> <br>
            <input type="radio" name="device" value="pc"> PC <br>
            <input type="radio" name="device" value="laptop"> Laptop <br><br>
            <input type="submit" value="Submit">
        </form>

        <?php
          if ($_SERVER["REQUEST_METHOD"] == "POST") {
     
       
        $selectedbudget = isset($_POST['budget']) ? $_POST['budget'] : '';
        
        $selectedSoftware = isset($_POST['software']) ? $_POST['software'] : '';
        $selectedDevice = isset($_POST['device']) ? $_POST['device'] : '';
        
       

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
        } else {
            echo "Prepared statement error: " . mysqli_error($dbc);
        }
        





        if(
        checkEmptyAndAlert($selectedbudget,"Please enter your budget!")
        
        ||
        checkEmptyAndAlert($selectedSoftware,"Please select your favourite software!")
        ||
        checkEmptyAndAlert($selectedDevice,"Please select your device!")
        )
         {
            exit();
         }
         else
         {

$MainParts = 0.8 * $selectedbudget;
$othersParts = 0.2 * $selectedbudget;
$RamBudget = 0.10 * $MainParts;
$CPUBudget = 0.40 * $MainParts;
$GPUBudget = 0.50 * $MainParts;

            switch($selectedDevice)
            {
                case "pc":
              
                            
                            $sqlLowCPU = "SELECT name, price FROM cpu 
                                WHERE performance >= '$lcpu'
                                AND performance < '$mcpu' 
                                AND price IS NOT NULL AND price <= '$CPUBudget' 
                                ORDER BY performance DESC LIMIT 3";
                        
                            $sqlMediumCPU = "SELECT name, price FROM cpu 
                                WHERE performance >= '$mcpu' 
                                AND performance < '$hcpu' 
                                AND price IS NOT NULL AND price <= '$CPUBudget' 
                                ORDER BY performance DESC LIMIT 3";
                        
                            $sqlHighCPU = "SELECT name, price FROM cpu 
                                WHERE performance >= '$hcpu' 
                                AND price IS NOT NULL AND price <= '$CPUBudget' 
                                ORDER BY performance DESC LIMIT 3";
                        
                            
                            $resultLowCPU = mysqli_query($dbc, $sqlLowCPU);
                            if ($resultLowCPU) {
                                echo "Low-Performance CPU Names and Prices (Sorted by Performance):<br>";
                                if (mysqli_num_rows($resultLowCPU) > 0) {
                                    while ($rowLowCPU = mysqli_fetch_assoc($resultLowCPU)) {
                                        $cpuName = $rowLowCPU['name'];
                                        $cpuPrice = $rowLowCPU['price'];
                                        echo $cpuName . " - Price: $" . $cpuPrice . "<br>";
                                        increaseSuggested($cpuName,'cpu',$dbc);
                                    }
                                } else {
                                    echo "Cpu with low-performance not found<br>";
                                }
                            } else {
                                echo "Error fetching low-performance CPUs: " . mysqli_error($dbc);
                            }
                        
                            
                            $resultMediumCPU = mysqli_query($dbc, $sqlMediumCPU);
                            if ($resultMediumCPU) {
                                echo "<br>Medium-Performance CPU Names and Prices (Sorted by Performance):<br>";
                                if (mysqli_num_rows($resultMediumCPU) > 0) {
                                    while ($rowMediumCPU = mysqli_fetch_assoc($resultMediumCPU)) {
                                        $cpuName = $rowMediumCPU['name'];
                                        $cpuPrice = $rowMediumCPU['price'];
                                        echo $cpuName . " - Price: $" . $cpuPrice . "<br>";
                                        increaseSuggested($cpuName,'cpu',$dbc);
                                    }
                                } else {
                                    echo "Cpu with medium-performance not found<br>";
                                }
                            } else {
                                echo "Error fetching medium-performance CPUs: " . mysqli_error($dbc);
                            }
                        
                            
                            $resultHighCPU = mysqli_query($dbc, $sqlHighCPU);
                            if ($resultHighCPU) {
                                echo "<br>High-Performance CPU Names and Prices (Sorted by Performance):<br>";
                                if (mysqli_num_rows($resultHighCPU) > 0) {
                                    while ($rowHighCPU = mysqli_fetch_assoc($resultHighCPU)) {
                                        $cpuName = $rowHighCPU['name'];
                                        $cpuPrice = $rowHighCPU['price'];
                                        echo $cpuName . " - Price: $" . $cpuPrice . "<br>";
                                        increaseSuggested($cpuName,'cpu',$dbc);
                                    }
                                } else {
                                    echo "Cpu with high-performance not found<br>";
                                }
                            } else {
                                echo "Error fetching high-performance CPUs: " . mysqli_error($dbc);
                            }
                        
                            
                            $sqlLowGPU = "SELECT name, price FROM gpu 
                                WHERE performance >= '$lgpu' 
                                AND performance < '$mgpu' 
                                AND price IS NOT NULL AND price <= '$GPUBudget' 
                                ORDER BY performance DESC LIMIT 3";
                        
                            $sqlMediumGPU = "SELECT name, price FROM gpu 
                                WHERE performance >= '$mgpu' 
                                AND performance < '$hgpu' 
                                AND price IS NOT NULL AND price <= '$GPUBudget' 
                                ORDER BY performance DESC LIMIT 3";
                        
                            $sqlHighGPU = "SELECT name, price FROM gpu 
                                WHERE performance >= '$hgpu' 
                                AND price IS NOT NULL AND price <= '$GPUBudget' 
                                ORDER BY performance DESC LIMIT 3";
                        
                            
                            $resultLowGPU = mysqli_query($dbc, $sqlLowGPU);
                            if ($resultLowGPU) {
                                echo "<br>Low-Performance GPU Names and Prices (Sorted by Performance):<br>";
                                if (mysqli_num_rows($resultLowGPU) > 0) {
                                    while ($rowLowGPU = mysqli_fetch_assoc($resultLowGPU)) {
                                        $gpuName = $rowLowGPU['name'];
                                        $gpuPrice = $rowLowGPU['price'];
                                        echo $gpuName . " - Price: $" . $gpuPrice . "<br>";
                                        increaseSuggested($gpuName,'gpu',$dbc);
                                    }
                                } else {
                                    echo "Gpu with low-performance  not found<br>";
                                }
                            } else {
                                echo "Error fetching low-performance GPUs: " . mysqli_error($dbc);
                            }
                        
                            
                            $resultMediumGPU = mysqli_query($dbc, $sqlMediumGPU);
                            if ($resultMediumGPU) {
                                echo "<br>Medium-Performance GPU Names and Prices (Sorted by Performance):<br>";
                                if (mysqli_num_rows($resultMediumGPU) > 0) {
                                    while ($rowMediumGPU = mysqli_fetch_assoc($resultMediumGPU)) {
                                        $gpuName = $rowMediumGPU['name'];
                                        $gpuPrice = $rowMediumGPU['price'];
                                        echo $gpuName . " - Price: $" . $gpuPrice . "<br>";
                                        increaseSuggested($gpuName,'gpu',$dbc);
                                    }
                                } else {
                                    echo "Gpu with medium-performance  not found<br>";
                                }
                            } else {
                                echo "Error fetching medium-performance GPUs: " . mysqli_error($dbc);
                            }
                        
                           
                            $resultHighGPU = mysqli_query($dbc, $sqlHighGPU);
                            if ($resultHighGPU) {
                                echo "<br>High-Performance GPU Names and Prices (Sorted by Performance):<br>";
                                if (mysqli_num_rows($resultHighGPU) > 0) {
                                    while ($rowHighGPU = mysqli_fetch_assoc($resultHighGPU)) {
                                        $gpuName = $rowHighGPU['name'];
                                        $gpuPrice = $rowHighGPU['price'];
                                        echo $gpuName . " - Price: $" . $gpuPrice . "<br>";
                                        increaseSuggested($gpuName,'gpu',$dbc);
                                    }
                                } else {
                                    echo "Gpu with high-performance  not found<br>";
                                }
                            } else {
                                echo "Error fetching high-performance GPUs: " . mysqli_error($dbc);
                            }
                            break;
                        
                        
                    

                            case "laptop" :
                               
                                $sqlLowLaptops = $sqlCombinedLaptops = "
                                (
                                    SELECT laptops.name, laptops.price, laptops.brand, cpu.performance AS cpu_performance, gpu.performance AS gpu_performance
                                    FROM laptops
                                    JOIN cpu ON laptops.cpu_name = cpu.name
                                    JOIN gpu ON laptops.gpu_name = gpu.name
                                    WHERE cpu.performance >= $lcpu
                                    AND gpu.performance >= $lgpu
                                    AND laptops.price IS NOT NULL
                                    AND laptops.price <= $selectedbudget
                                    AND (cpu.performance < $mcpu OR gpu.performance < $mgpu )
                                    ORDER BY laptops.price ASC LIMIT 3
                                )
                                UNION
                                (
                                    SELECT laptops.name, laptops.price, laptops.brand, cpu.performance AS cpu_performance, gpu.performance AS gpu_performance
                                    FROM laptops
                                    JOIN cpu ON laptops.cpu_name = cpu.name
                                    JOIN gpu ON laptops.gpu_name = gpu.name
                                    WHERE cpu.performance >= $lcpu
                                    AND gpu.performance >= $lgpu
                                    AND laptops.price IS NOT NULL
                                    AND laptops.price <= $selectedbudget
                                    AND (cpu.performance < $mcpu OR gpu.performance < $mgpu )
                                    ORDER BY laptops.price DESC LIMIT 3
                                )
                            ";
                            ;
                                
                                $sqlMediumLaptops = "
                                (
                                    SELECT laptops.name, laptops.price, laptops.brand, cpu.performance AS cpu_performance, gpu.performance AS gpu_performance
                                    FROM laptops
                                    JOIN cpu ON laptops.cpu_name = cpu.name
                                    JOIN gpu ON laptops.gpu_name = gpu.name
                                    WHERE cpu.performance >= $mcpu
                                    AND gpu.performance >= $mgpu
                                    AND laptops.price IS NOT NULL
                                    AND laptops.price <= $selectedbudget
                                    AND (cpu.performance < $hcpu OR gpu.performance < $hgpu )
                                    ORDER BY laptops.price ASC LIMIT 3
                                )
                                UNION
                                (
                                    SELECT laptops.name, laptops.price, laptops.brand, cpu.performance AS cpu_performance, gpu.performance AS gpu_performance
                                    FROM laptops
                                    JOIN cpu ON laptops.cpu_name = cpu.name
                                    JOIN gpu ON laptops.gpu_name = gpu.name
                                    WHERE cpu.performance >= $mcpu
                                    AND gpu.performance >= $mgpu
                                    AND laptops.price IS NOT NULL
                                    AND laptops.price <= $selectedbudget
                                    AND (cpu.performance < $hcpu OR gpu.performance < $hgpu )
                                    ORDER BY laptops.price DESC LIMIT 3
                                )
                            ";
                                
                                $sqlHighLaptops = $sqlCombinedHighPerformanceLaptops = "
                                (
                                    SELECT laptops.name, laptops.price, laptops.brand, cpu.performance AS cpu_performance, gpu.performance AS gpu_performance
                                    FROM laptops
                                    JOIN cpu ON laptops.cpu_name = cpu.name
                                    JOIN gpu ON laptops.gpu_name = gpu.name
                                    WHERE cpu.performance >= $hcpu
                                    AND gpu.performance >= $hgpu
                                    AND laptops.price IS NOT NULL
                                    AND laptops.price <= $selectedbudget
                                    ORDER BY laptops.price ASC LIMIT 3
                                )
                                UNION
                                (
                                    SELECT laptops.name, laptops.price, laptops.brand, cpu.performance AS cpu_performance, gpu.performance AS gpu_performance
                                    FROM laptops
                                    JOIN cpu ON laptops.cpu_name = cpu.name
                                    JOIN gpu ON laptops.gpu_name = gpu.name
                                    WHERE cpu.performance >= $hcpu
                                    AND gpu.performance >= $hgpu
                                    AND laptops.price IS NOT NULL
                                    AND laptops.price <= $selectedbudget
                                    ORDER BY laptops.price DESC LIMIT 3
                                )
                            ";
                            ;

                        
                        $resultLowLaptops = mysqli_query($dbc, $sqlLowLaptops);
                        if ($resultLowLaptops) {
                            echo "Low-Performance Laptops Names, Brands, and Prices:<br>";
                            if (mysqli_num_rows($resultLowLaptops) > 0) {
                                while ($rowLowLaptops = mysqli_fetch_assoc($resultLowLaptops)) {
                                    $LapName = $rowLowLaptops['name'];
                                    $LapBrand = $rowLowLaptops['brand'];
                                    $LapPrice = $rowLowLaptops['price'];
                                    echo $LapName . " by " . $LapBrand . " - Price: $" . $LapPrice . "<br>";
                                  
                                }
                            } else {
                                echo "Laptop with low-performance not found<br>";
                            }
                        } else {
                            echo "Error fetching low-performance laptops: " . mysqli_error($dbc);
                        }

                        

                       
                        $resultMediumLaptops = mysqli_query($dbc, $sqlMediumLaptops);
                        if ($resultMediumLaptops) {
                            echo "<br>Medium-Performance Laptops Names, Brands, and Prices:<br>";
                            if (mysqli_num_rows($resultMediumLaptops) > 0) {
                                while ($rowMediumLaptops = mysqli_fetch_assoc($resultMediumLaptops)) {
                                    $LapName = $rowMediumLaptops['name'];
                                    $LapBrand = $rowMediumLaptops['brand'];
                                    $LapPrice = $rowMediumLaptops['price'];
                                    echo $LapName . " by " . $LapBrand . " - Price: $" . $LapPrice . "<br>";
                                    
                                }
                            } else {
                                echo "Laptop with medium-performance not found<br>";
                            }
                        } else {
                            echo "Error fetching medium-performance laptops: " . mysqli_error($dbc);
                        }

                        
                        $resultHighLaptops = mysqli_query($dbc, $sqlHighLaptops);
                        if ($resultHighLaptops) {
                            echo "<br>High-Performance Laptops Names, Brands, and Prices:<br>";
                            if (mysqli_num_rows($resultHighLaptops) > 0) {
                                while ($rowHighLaptops = mysqli_fetch_assoc($resultHighLaptops)) {
                                    $LapName = $rowHighLaptops['name'];
                                    $LapBrand = $rowHighLaptops['brand'];
                                    $LapPrice = $rowHighLaptops['price'];
                                  
                                    echo $LapName . " by " . $LapBrand . " - Price: $" . $LapPrice . "<br>";
                                    

                                    
               }
                            } else {
                                echo "Laptop with high-performance not found<br>";
                            }
                        } else {
                            echo "Error fetching high-performance laptops: " . mysqli_error($dbc);
                        }

                        break;

                            
                   
            }
         }
    }


        mysqli_close($dbc);
        ?>

        <a href="2.php">Go to Home</a>
    </div>

</body>

</html>
    
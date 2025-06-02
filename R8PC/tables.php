
<?php
include "ConnectDB.php";
include "test2.php";

echo "<style>
.software-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
}
.software-item {
    width: 200px;
    margin-bottom: 20px;
    text-align: center;
}
.software-image {
    width: 100%;
    max-height: 120px;
    object-fit: cover;
    border-radius: 8px; 
}
.software-title {
    font-size: 16px;
    font-weight: bold;
    margin: 10px 0;
}
.software-description {
    font-size: 14px;
}
</style>";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selectedCPU = isset($_POST['cpu']) ? $_POST['cpu'] : '';
    $selectedGPU = isset($_POST['gpu']) ? $_POST['gpu'] : '';
    $selectedRAM = isset($_POST['ram']) ? $_POST['ram'] : '';

    if (
        checkEmptyAndAlert($selectedCPU, "Please enter your cpu!") ||
        checkEmptyAndAlert($selectedGPU, "Please select your gpu!") ||
        checkEmptyAndAlert($selectedRAM, "Please select your ram!")
    ) {
        exit();
    } else {
        searchCookie($selectedCPU,$selectedGPU,$dbc);
        $cpuPerformance = getData($dbc, $selectedCPU, 'SELECT performance FROM cpu WHERE name = ?');
        $gpuPerformance = getData($dbc, $selectedGPU, 'SELECT performance FROM gpu WHERE name = ?');
        $ramAmount = $selectedRAM;




        

        $softwareQuery = "SELECT * FROM programs 
            WHERE 
            (lcpu > $cpuPerformance OR lgpu > $gpuPerformance OR lram > $ramAmount)";

        $softwareResult = executeQuery($dbc, $softwareQuery);

        if ($softwareResult = @mysqli_query($dbc, $softwareQuery)) {
            while ($softwareRow = mysqli_fetch_array($softwareResult, MYSQLI_ASSOC)) {
                echo "<h3>NON Compatible Software:</h3>";
                echo "<div class='software-container'>";
                while ($softwareRow = mysqli_fetch_array($softwareResult, MYSQLI_ASSOC)) {
                    echo "<div class='software-item'>
                <img class='software-image' src='images/" . $softwareRow['picture'] . "' alt='Software Image'>
                <div class='software-title'>" . $softwareRow['Name'] . "</div>
                <div class='software-description'>" . $softwareRow['Description'] . "</div>
              </div>";
                }

                echo "</div>";
            }
        } else {
            echo "Error fetching software data: " . mysqli_error($dbc);
        }





        $softwareQuery = "SELECT * FROM programs 
            WHERE 
            (lcpu <= $cpuPerformance AND lgpu <= $gpuPerformance AND lram <= $ramAmount)
            AND
            (mcpu > $cpuPerformance OR mgpu > $gpuPerformance Or mram > $ramAmount)
            ";

        $softwareResult = executeQuery($dbc, $softwareQuery);

        if ($softwareResult = @mysqli_query($dbc, $softwareQuery)) {
            while ($softwareRow = mysqli_fetch_array($softwareResult, MYSQLI_ASSOC)) {
                echo "<h3>This  software  runs poorly on your device</h3>";
                echo "<div class='software-container'>";
                while ($softwareRow = mysqli_fetch_array($softwareResult, MYSQLI_ASSOC)) {
                    echo "<div class='software-item'>
                <img class='software-image' src='images/" . $softwareRow['picture'] . "' alt='Software Image'>
                <div class='software-title'>" . $softwareRow['Name'] . "</div>
                <div class='software-description'>" . $softwareRow['Description'] . "</div>
              </div>";
                }
                echo "</div>";
            }
        } else {
            echo "Error fetching software data: " . mysqli_error($dbc);
        }







        $softwareQuery = "SELECT * FROM programs 
            WHERE 
            (mcpu <= $cpuPerformance AND mgpu <= $gpuPerformance AND mram <= $ramAmount)
            AND 
            (hcpu > $cpuPerformance OR hgpu > $gpuPerformance OR hram > $ramAmount)
            ";

        $softwareResult = executeQuery($dbc, $softwareQuery);

        if ($softwareResult = @mysqli_query($dbc, $softwareQuery)) {
            while ($softwareRow = mysqli_fetch_array($softwareResult, MYSQLI_ASSOC)) {
                echo "<h3>This software runs on your pc but can run faster on better hardware</h3>";
                echo "<div class='software-container'>";
                while ($softwareRow = mysqli_fetch_array($softwareResult, MYSQLI_ASSOC)) {
                    echo "<div class='software-item'>
                <img class='software-image' src='images/" . $softwareRow['picture'] . "' alt='Software Image'>
                <div class='software-title'>" . $softwareRow['Name'] . "</div>
                <div class='software-description'>" . $softwareRow['Description'] . "</div>
              </div>";
                }

                echo "</div>";
            }
        } else {
            echo "Error fetching software data: " . mysqli_error($dbc);
        }








        $softwareQuery = "SELECT * FROM programs 
        WHERE 
        (
        hcpu <= $cpuPerformance AND hgpu <= $gpuPerformance AND hram <= $ramAmount)
        ";

        $softwareResult = executeQuery($dbc, $softwareQuery);

        if ($softwareResult = @mysqli_query($dbc, $softwareQuery)) {
            while ($softwareRow = mysqli_fetch_array($softwareResult, MYSQLI_ASSOC)) {
                echo "<h3>This software runs great on your pc</h3>";
                echo "<div class='software-container'>";
                while ($softwareRow = mysqli_fetch_array($softwareResult, MYSQLI_ASSOC)) {
                    echo "<div class='software-item'>
                <img class='software-image' src='images/" . $softwareRow['picture'] . "' alt='Software Image'>
                <div class='software-title'>" . $softwareRow['Name'] . "</div>
                <div class='software-description'>" . $softwareRow['Description'] . "</div>
              </div>";
                }

                echo "</div>";
            }
        } else {
            echo "Error fetching software data: " . mysqli_error($dbc);
        }
    }
}

mysqli_close($dbc); 

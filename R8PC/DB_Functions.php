
<?php
$password='627300';
function connectServer($host,$log,$pass,$mess)
{ 
	//some testing
	$dbc=@mysqli_connect($host,$log,$pass) 
	  or die("connection error:".@mysqli_errno($dbc).
	         ": ".@mysqli_error($dbc)
			 );
	
//	if($mess == 1)	print '<p>Successfully connected to MySQL!</p>';
	return $dbc;
}
/**=====================================================**/
function selectDB($dbc, $db, $mess)
{
	mysqli_select_db($dbc ,$db) 
	 or die ('<p style="color: red;">'.
			 "Could not select the database ".$db.
			 "because:<br/>".mysqli_error($dbc).
			 ".</p>");
	
//	if ($mess == 1) echo "<p>The database $db has been selected.</p>";
}
/**=====================================================**/
function createDB($dbc,$db)
{
	$query= "CREATE DATABASE ".$db;
	mysqli_query($dbc,$query) 
	 or die('<p style="color: red;">'.
	        "Could not create the database ".
			$db." because:<br>".mysqli_error($dbc).
			".</p>");
		
	echo "<p>The database $db has been created!</p>";
}
/**=====================================================**/
function deleteDB($dbc,$db)
{
	$query= "DROP DATABASE IF EXISTS ".$db;
	mysqli_query($dbc,$query) 	 
     or die("DB Error: Could not delete the data base ".
		    $db."! <br>".@mysqli_error($dbc));
	
	print "<p> Data base $db deleted.</p>";
}
/**=====================================================**/
function createTable($dbc,$query,$Tab)
{
	// Execute the query:
	if (@mysqli_query($dbc,$query))
	{
		print "<p> The table $Tab has been created.</p>";
	}
	else
	{
		$str='<p style="color: red;">';
		$str.="Could not create the table $Tab because:<br>";
		$str.=mysqli_error($dbc);
		$str.=".</p><p>The query being run was:".$query."</p>";
		print $str;		    
	}
}
/**=====================================================**/
function deleteDataFromTab($dbc, $Tab)
{
	$query = "DELETE FROM ".$Tab;
    @mysqli_query($dbc,$query) 
    or die ("DB Error: Could not delete data from table $Tab! <br>".
		     @mysqli_error($dbc));
	
	print "<p> All data are deleted inside table $Tab.</p>";
}
/**=====================================================**/
function deleteTable($dbc, $Tab)
{
	$query = "DROP TABLE IF EXISTS ".$Tab;
    @mysqli_query($dbc,$query) 
      or die ("DB Error: Could not delete table person! <br>".
	          @mysqli_error($dbc));
	
	print "<p> Table $Tab deleted.</p>";
}
/**=====================================================**/
function insertDataToTab($dbc, $Tab, $query)
{
    @mysqli_query($dbc,$query) 
      or die ("DB Error: Could not insert $Tab! <br>".
			  @mysqli_error($dbc));
   
   // print ("<h2 style = 'color: blue'> The $Tab was added successfully! </h2>");	
}
/**=====================================================**/
function executeQuery($dbc, $query)
{
    @mysqli_query($dbc,$query) 
      or die ("DB Error: Could not execute the query! <br>".
			  @mysqli_error($dbc));
   
   
}
function checkEmptyAndAlert($variable, $errorMessage) {
    if (empty($variable)) {
        echo "<script>alert('$errorMessage'); window.history.back();</script>";
        die();
		
    }
}

function getData($dbc,$selectedName,$sql) {
    
    
   
    $stmt = $dbc->prepare($sql);
    $stmt->bind_param("s", $selectedName);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['performance'];
    } else {
        return null;
    }
}
function fetchPerformanceData($dbc, $tableName, $performanceColumn, $nameColumn, $priceColumn, $lowerBound, $upperBound, $limit)
{
    $sql = "SELECT $nameColumn, $priceColumn FROM $tableName 
            WHERE $performanceColumn > '$lowerBound' 
            AND $performanceColumn <= '$upperBound' 
			AND $priceColumn is NOT NULL
            ORDER BY $performanceColumn DESC LIMIT $limit";

    $result = mysqli_query($dbc, $sql);

    if ($result) {
        echo "Performance Data for $tableName (Sorted by $performanceColumn):<br>";
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $itemName = $row[$nameColumn];
                $itemPrice = $row[$priceColumn];
				increaseSuggested($itemName,$tableName,$dbc);
                echo "$itemName - Price: $$itemPrice<br>";
            }
			echo "<br><br><br>";
        } else {
            echo "$tableName with specified performance not found<br><br><br><br>";
        }
    } else {
        echo "Error fetching $tableName performance data: " . mysqli_error($dbc);
    }
}

function RamUpgrade($lowerBound,$upperBound,$dbc)
{
	$sql = "SELECT amount FROM ram 
            WHERE amount >= '$lowerBound' 
            AND amount <= '$upperBound' 
			
            ORDER BY amount DESC LIMIT 1";
			$result = mysqli_query($dbc, $sql);

			if (mysqli_num_rows($result) > 0) {
				while ($row = mysqli_fetch_assoc($result)) {
					$itemName = $row['amount'];
					
					echo "Ram suggested : $itemName GB<br>";
				}
				echo "<br><br><br>";
			}
}
function increaseSuggested($name, $table, $dbc)
{
			$addtosearch = "UPDATE $table set suggested = suggested + 1 where Name = ?";
            $someVariable = $dbc->prepare($addtosearch);
            $someVariable->bind_param("s", $name);
            $someVariable->execute();
}
function increaseSearched($name, $table, $dbc)
{
			$addtosearch = "UPDATE $table set searched = searched + 1 where Name = ?";
            $someVariable = $dbc->prepare($addtosearch);
            $someVariable->bind_param("s", $name); 
            $someVariable->execute();
}

function searchCookie($selectedCPU,$selectedGPU,$dbc)
{
	if (!isset($_COOKIE['searching'])) {
		setcookie("searching", 1, time() + 24 * 60 * 60, '/');
		increaseSearched($selectedCPU,'cpu',$dbc);
		increaseSearched($selectedGPU,'gpu',$dbc);
		
	}
}
?>

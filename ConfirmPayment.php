<?php
    
/**
* SQL configuration
*/
$mysqli = new mysqli("mysql.eecs.ku.edu", "slopez", "Password123!", "slopez");

/**
 * Checks to see if sql connection is properly configured
 */
if ($mysqli->connect_errno) 
{
	printf("Connect failed: %s\n", $mysqli->connect_error);
	exit();
}

/**
 * Allows for reading of stored session variables, and for ability to store session variables
 */
session_start();
$groupAdmin = $_SESSION['GroupAdmin'];	
$totalPaid = 0;
$name = "";


if(!empty($_POST['checklist'])) 
{    
	echo "Payment Confirmed! The bill has been updated. <br>"; //echo count($cart);
	
	/**
	* For each checked payment notification, generate a query to update the totalPaid and totalDue columns with calculated values from the payment amount and current 'Bills' table values .
	*/
	foreach ($_POST['checklist'] as $check)
	{
	   // echo $check."<br />";	
	   /**
		* Allows to read in the PayString value that's stored in check, which is a parseable string that contains transaction information.
		*/
		parse_str($check);
		echo "$totalDue"; echo "<br>";echo "$payAmount"; echo "<br>";echo "$totalPaid";
		$difference = $totalDue - $payAmount; 		
		$sum = $totalPaid + $payAmount;
		$nameofbill = $billName;
		//echo "$difference"; echo "$sum";
		/**
		* This query updates the Bills table with calculated values involving existing table values and 
		*/
		$query = "UPDATE Bills SET TotalDue = '$difference', TotalPaid= '$sum' WHERE Name= '$nameofbill' AND GroupAdmin = '$groupAdmin' "; 
		if ($result = $mysqli->query($query)) 
		{             
			$result->free();
		}            
	}
	
}
else
{
	echo "Nobody was removed since no one was selected.";
}    
	 
?>

<?php
    
/**
* sql configuration
*/
$mysqli = new mysqli("mysql.eecs.ku.edu", "slopez", "Password123!", "slopez");

/**
*	Check to see if SQL server is properly connected
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


if(!empty($_POST['checklist'])) 
{
	echo "Success! The following bills were removed: <br>";

	foreach ($_POST['checklist'] as $check)
	{
		echo $check."<br />"; 
		/**
		* Deletes the bill based on the name and the associated group.
		*/
		$query = "DELETE FROM Bills WHERE Name = '$check' AND GroupAdmin = '$groupAdmin' ";

	/*close query*/
		if ($result = $mysqli->query($query)) 
		{                                                                
			$result->free();
		}
		
	}
}
else
{
	echo "No bill was removed since nothing was selected.";
}
		
?>

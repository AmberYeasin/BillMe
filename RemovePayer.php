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

if(!empty($_POST['checklist'])) 
{    
	echo "Success! The following people were removed: <br>"; //echo count($cart);
	foreach ($_POST['checklist'] as $check)
	{   
		echo $check."<br />"; 
		/**
		* Deletes bills associated with the payer being removed.
		*/
		$query = "DELETE FROM Bills WHERE PayerID = '$check' AND GroupAdmin = '$groupAdmin' ";
		if ($result = $mysqli->query($query)) 
		{                                                                
			//$result->free();                
		}                                                          
	}
	
	foreach ($_POST['checklist'] as $check)
	{
	   // echo $check."<br />";
	   /**
		* Removes payer from group by changing the groupname and groupadmin fields to empty field, not allowing the user to access home navigation.
		*/
		$query = "UPDATE BillPayers SET GroupName= '', GroupAdmin= '' WHERE PayerID= '$check'"; 
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

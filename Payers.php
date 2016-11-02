<?php
/**
 * SQL configuration
 */
$mysqli = new mysqli("mysql.eecs.ku.edu", "slopez", "Password123!", "slopez");    

/**
 * Checks to see if sql connection is properly configured
 */
if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}

/**
 * Allows for reading of stored session variables, and for ability to store session variables
 */
session_start();

/**
 * Retrieves and displays all the bill payers in the group, along with the ability to remove a payer.
 */
$query = "SELECT * FROM BillPayers";
if ($result = $mysqli->query($query)) 
{        
	while ($row = $result->fetch_assoc()) 
	{
		if($row['GroupAdmin'] == $_SESSION['GroupAdmin'])
		{
		echo 
		"<tr>
		<td>{$row['PayerID']}</td>
		<td><input type='checkbox' name = 'checklist[]' value = '{$row['PayerID']}' /></td>             
		</tr>\n"; 
		}
									
	}

	$result->free();
}

?>

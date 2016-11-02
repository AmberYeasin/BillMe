<?php
/**
 * SQL configuration
 */
$mysqli = new mysqli("mysql.eecs.ku.edu", "slopez", "Password123!", "slopez");

/**
 * Allows for reading of stored session variables, and for ability to store session variables
 */
session_start();
$name = $_POST['name'];
$totalDue = $_POST['totalDue'];
$groupName = $_SESSION['GroupName'];
$groupAdmin = $_SESSION['GroupAdmin'];
$payerID = $_SESSION['PayerID'];

$dueDate = strtotime($_POST["dueDate"]);
$dueDate = date('Y-m-d H:i:s', $dueDate);

/**
 * Checks to see if sql connection is properly configured
 */
 if ($mysqli->connect_errno) {
     echo"$mysqli->connect_error)";
    exit();
}

echo "Name: $name <br>"; 
echo "Total Due: $totalDue <br>"; 
echo "Group Name: $groupName <br>"; 
echo "Due Date: $dueDate <br>"; 
echo "Group Admin: $groupAdmin <br>"; 
echo "Payer ID: $payerID <br>"; 

$totalPaid = $row["TotalPaid"];

/**
 * This query creates a new bill by taking in post form input variables from the front end as well as session variables initialized upon login to create a bill associated with a group.
 */
$query = "INSERT INTO Bills (Name,TotalDue,TotalPaid,DueDate,PayerID,GroupAdmin) VALUES ('$name','$totalDue','$totalPaid','$dueDate','$payerID','$groupAdmin')";
if ($result = $mysqli->query($query))
{
 	echo "The $name bill was successfully added to the group $groupName by $payerID!";
    $result->free();        
}


/**
 * Closes the connection.
 */
$mysqli->close();
?>

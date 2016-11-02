<?php
/**
 * SQL configuration
 */
$mysqli = new mysqli("mysql.eecs.ku.edu", "slopez", "Password123!", "slopez");

$payerID = $_POST['user'];
$password = $_POST['password'];
$groupName = $_POST['groupName'];
$groupAdmin = $_POST['groupAdmin'];
$join = $_POST['groupAdmin'];

/**
 * Checks to see if SQL connection is properly configured
 */
if ($mysqli->connect_errno) {
     echo"$mysqli->connect_error)";
    exit();
}

$userExists = false;
$groupExists = false;

/**
 * This query is used to check to see if the account already exists, since duplicate accounts are not allowed.
 */
$query = "SELECT PayerID FROM BillPayers";

if ($result = $mysqli->query($query)) {

    while ($row = $result->fetch_assoc()) 
    {	
    	if($row["PayerID"] == $payerID)
		{
		  $userExists = true;
		}
		    	
    }
			
    $result->free();
}

if($groupAdmin != "")
{
	/**
   * If a new user seeking to create an account wants to join an existing group upon creation, this query is to check if the entered group exists by comparing the entered post value for groupAdmin
   */
    $query = "SELECT * FROM BillPayers ";

    if ($result = $mysqli->query($query)) 
    {

        while ($row = $result->fetch_assoc()) 
        {	
  	
            if($row["GroupName"] == $groupName && $row["GroupAdmin"] == $groupAdmin)
            {
                $groupExists = true;
                //$groupAdmin = $row['GroupAdmin'];
            }				
        }
			
        $result->free();
    }
}
else
{
    $groupAdmin = $payerID;
	$groupExists = false;
}

echo "User Exists: $userExists"; echo "<br>";
echo "Group Exists: $groupExists"; echo "<br>";
echo "PayerID: $payerID"; echo "<br>";
echo "Password: $password"; echo "<br>";
echo "GroupName: $groupName"; echo "<br>";
echo "GroupAdmin: $groupAdmin";


 /**
 * If the user is not a duplicate, a new account is created with a group that already exists or one newly created by the new user. GroupAdmin value is determined by PayerID (username) in the case of the latter.
 */
$query = "INSERT INTO BillPayers (PayerID,Password,GroupName,GroupAdmin) VALUES ('$payerID','$password','$groupName','$groupAdmin')";
if($userExists)
{
	echo "This bill payer is already created, cannot create duplicate account.";
}
else if (!$groupExists && $join != "")
{
    echo "No group named $groupName was found with the administrator's username $groupAdmin, could not create account.";
}
else if ($result = $mysqli->query($query))
{
 	echo "The bill payer $payerID was created successfully with the group named $groupName!";
    $result->free();        
}


/**
 * Closes the connection.
 */
$mysqli->close();
?>

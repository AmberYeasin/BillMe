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
	//echo "$mysqli->connect_error)";
	exit();
}

/**
 * Allows for reading of stored session variables, and for ability to store session variables
 */
session_start();

$user_check = $_SESSION['PayerID'];

$ses_sql = mysqli_query("slopez","select PayerID from BillPayers where PayerID = '$user_check' ");

$row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);

$login_session = $row['PayerID'];

if(!isset($_SESSION['PayerID'])){
  header("location:Login.html");
}
?>

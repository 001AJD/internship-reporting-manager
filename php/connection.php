<?php 
/**
 * @author - Ajinkya Dhomne
 * @copyright 2018
 **/
$serverName = "localhost";
$dbUserName = "root";
$dbPassword = "rootuser123";
$dbName = "student_reporting";

//creating connection
$conn =  mysqli_connect($serverName,$dbUserName, $dbPassword, $dbName);

//checking connection
if($conn)
{
	 // echo "connection established!";
}
else
{
	die("connection to db failed". $conn->mysqli_error());
}
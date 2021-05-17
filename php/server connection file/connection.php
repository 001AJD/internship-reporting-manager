<?php 
/**
 * @author - Ajinkya Dhomne
 * @copyright 2018
 **/

$serverName = "SERVER_NAME_HERE";
$dbUserName = "ajinkya";
$dbPassword = "PASSWORD_HERE";
$dbName = "DB_NAME_HERE";

//creating connection

$conn = mysqli_connect($serverName,$dbUserName, $dbPassword, $dbName);
//checking connection
if($conn)
{
	 // echo "<br>connection established!";
}
else
{
	echo "<br>connection to db failed". mysqli_error();
}
?>
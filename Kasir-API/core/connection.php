<?php
$server = "localhost";
$user = "root";
$password = "";
$db_name = "api-kasir";

$connect = mysqli_connect($server, $user,$password,$db_name);
if(!$connect)
{
	echo " Connection Error!!";
}

  ?>
<?php

	require 'connect.inc.php';
	require 'core.inc.php';


	if(isset($_POST['up']))
	{	$query = "SELECT * FROM `stud` WHERE 1";
		
		if($query_run = mysql_query($query))
		{
			
			while($row = mysql_fetch_array($query_run))
			{
				$password = md5($row['pwd']);
				$update = "UPDATE `stud` SET `pwd` = '".$password."' WHERE `id` =".$row['id'];
				if($uprun = mysql_query($update))
				echo $row['prn']."\n";
				else
					echo mysql_error();
			}	
		}
		else
			echo mysql_error();
	}
	else
	{
		echo "Press UP Below ;)";
	}	
?>

<form action = "md5.php" method = "POST">
<input type="submit" name = "up" value="UP">
<form>
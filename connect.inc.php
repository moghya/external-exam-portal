<?php
	$host = 'localhost';	
	$user = 'root';
	$pass = '';

	$db = 'mini';

	if(@!mysql_connect($host,$user,$pass)||@!mysql_select_db($db))
	{
		echo "Sorry an Error has occured.";
		echo "\nWe request you to please report it at novatoscript@gmail.com.";
		echo "\nor please give a call at +919881464434/+919552307569";
		echo mysql_error();
		die();
	}
?>
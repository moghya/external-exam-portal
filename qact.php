<?php
	require 'connect.inc.php';
	require 'core.inc.php';
	if(!isloggedint()||isloggedins())
	{  
		header('Location: error.php');
	}
	else 
	{	if(isset($_GET['qid'],$_GET['batch'],$_GET['value']))
		{
			if($_GET['value']==0)
			{
				$query = "UPDATE `quiz` SET `b".$_GET['batch']."` = 1 WHERE `id` =".$_GET['qid'];
				if($query_run = mysql_query($query))
				{
					header("Location: disp.php?qid=".$_GET['qid']);
				}
				else
				{
					echo "Sorry an Error Occurred.<a href='home.php'>Home</a>";
				}
			}
			else
			{
				$query = "UPDATE `quiz` SET `b".$_GET['batch']."` = 0 WHERE `id` =".$_GET['qid'];
				if($query_run = mysql_query($query))
				{
					header("Location: disp.php?qid=".$_GET['qid']);
				}
				else
				{
					echo "Sorry an Error Occurred.<a href='home.php'>Home</a>";
				}
				
			}
			
		}

	}

?>
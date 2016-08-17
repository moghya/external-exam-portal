<?php
	require 'connect.inc.php';
	require 'core.inc.php';

	$gque = "SELECT * FROM `qstn` WHERE `qid`=".$_GET['qid']." AND `sid` = ".$_SESSION['id'];	
	if($gque_run = mysql_query($gque))
	{	

		if(mysql_num_rows($gque_run)>0)
		{	
			$array = mysql_fetch_assoc($gque_run);
			if($array['done']!=1)
			{
				$yup = time();
				$query  = "update `qstn` set `done`= 1 , `end`=$yup where `qid`=".$_GET['qid']." and `sid` = ".$_SESSION['id'];

				if($query_run = mysql_query($query))
				{
					header('Location: success.php');
				}
				else
				{
					echo '<script type="text/javascript">
							alert("An error occurred");
					  </script>';
				}
			}
			else
			{
				header('Location:error.php');
			}
		}
		else
		{
			
		}
	}
	else
	{
		
	}
?>

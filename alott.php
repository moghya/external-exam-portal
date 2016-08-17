<?php
	require 'connect.inc.php';
	require 'core.inc.php';

	if(!isloggedint()||isloggedins())
	{  
		header('Location: error.php');
	}
	elseif(isset($_GET['qid']))
	{	
		for($batch=1;$batch<=5;$batch++)
		{
			if(isset($batch))
			{	
				
				$qid=$_GET['qid'];
				$que4 = "SELECT * FROM `quiz` WHERE `id`=".$qid;
				if($da4 = mysql_query($que4))
				{
					$row4 = mysql_fetch_assoc($da4);
					
					$ccode = $row4['ccode'];				
				}
				else
				{
					msg("sorry an error ocurred.");
						
				}			
				
				
				$que1="SELECT * from `sub` WHERE `ccode` = '".$ccode."'";
				if($data1=mysql_query($que1))
				{
					$row1=mysql_fetch_assoc($data1);
					$yr=$row1['yr'];
				}
				else
				{
					echo '<script type="text/javascript">
							alert("sorry an error ocurred.");
						  </script>';
				}
				
			/*	$que3="UPDATE `quiz` SET `b".$batch."` = 1 WHERE `id` = ".$qid;
				if($da3=mysql_query($que3))
				{ 
				}
				else 
				{		msg("sorry an error ocurred.");
						
				}
			*/
				$quiz=array();
				$file='quiz/quiz_'.$qid.'.txt';
				$fobj=fopen($file,'r') or die("unable to open file!");
				$x=0;
				while(!feof($fobj))
				{
					$quiz[$x]=fgets($fobj);
					$x++;
				}
				unset($quiz[count($quiz)-1]);
				shuffle($quiz);
				$que="SELECT * from `stud` WHERE `batch` = '".$batch."' AND `yr` = '".$yr."'";
				if($data=mysql_query($que))
				{
					for($x=0,$y=0;$x<mysql_num_rows($data);$x++,$y++)
					{
						if($y == count($quiz)) { shuffle($quiz);  $y=0;  }
						$first=$quiz[$y];	
						if($y == count($quiz)-1) 	$sec=$quiz[0];
						else	$sec=$quiz[$y+1];	
						$row=mysql_fetch_assoc($data);
						$query="INSERT INTO `qstn`(`id`,`qid`,`qn`,`qnre`,`sid`,`batch`) VALUES ('','".$qid."','".$first."','".$sec."','".$row['id']."','".$batch."')";
						if(!mysql_query($query))
						msg("sorry an error ocurred.");
					}
					//msg("Quiz successfully started! You can view the details now.");
					 
				}
				else
				{
					msg("sorry an error ocurred.");
				}
			}
			
		}
		
		header("Location: quizes.php");
		
	}
?>


<?php
	require 'connect.inc.php';
	require 'core.inc.php';
	
	if(!isloggedint()||isloggedins())
	{  
		header('Location: error.php');
	}
	else 
	{
?>
	<html>

		<head>
		<link href='http://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
		<link href="bootstrap.min.css" rel="stylesheet">
		<link href="font-awesome.min.css" rel="stylesheet">
		<link href="login.css" rel="stylesheet">
			<style>
  	 #naam {
                    border-right: 1px solid gray;
                    padding-right: 4px;
                }
  
table, th, td {
				border: 1px solid black;
				border-collapse: collapse;
			}
			th, td {
				padding: 15px;
			}


  </style>  

		</head>

		<body>
<nav class = "navbar navbar-default" role = "navigation">
   
   <div class = "navbar-header">
      <button type = "button" class = "navbar-toggle" 
         data-toggle = "collapse" data-target = "#nav">
         <span class = "sr-only">Toggle navigation</span>
         <span class = "icon-bar"></span>
         <span class = "icon-bar"></span>
         <span class = "icon-bar"></span>
      </button>
		
      <a class = "navbar-brand" href = "#">External Exam Portal</a>
   </div>
   
   <div class = "collapse navbar-collapse" id = "nav">	
		<ul class = "nav navbar-nav navbar-right">  
			<?php echo "<li id='naam'>".$_SESSION['fname']."<br>".$_SESSION['lname']."</li>"; ?>
			<li><a href='home.php'>Home</a></li>
			<li><a href='myprofilet.php'>My Profile</a></li>
			<li><a href='cpwdt.php'>Change Password</a></li>
			<li class="active"><a href='quizes.php'>Quizes</a> </li>
			<li><a href='creq.php'>Add Quiz</a></li>
			<li><a href='logout.php'>Logout</a></li>
		</ul>
	</div>
</nav>
<div class="container" style='background-color:rgba(255, 255, 255, .8);'>

<?php		

		if(isset($_GET['qid']))
		{
			$qid=$_GET['qid'];
			$query = "SELECT a.id,a.ccode,b.cname,b.cred,b.branch,b.yr FROM quiz a, sub b WHERE a.id=".$qid." and a.ccode=b.ccode";
			if($query_run = mysql_query($query))
			{
				$nquiz = mysql_num_rows($query_run);
				if($nquiz>0)
				{
					$array = mysql_fetch_assoc($query_run);
					echo '<br><center><table>
					<tr><td><label>Quiz Id:</label>'.$array['id'].'</td><td>
					<label>Course Code:</label>'.$array['ccode'].'</td><td>
					<label>Course Name:</label>'.$array['cname'].'</td><td>
					<label>Credtis:</label>'.$array['cred'].'</td><td>
					<label>Class:</label>'.$array['yr'].'</td><td>
					<label>Branch:</label>'.$array['branch'].'</td>
					</tr></table></center>';
				}
				else
				{
					echo "Invalid Quiz.";
				}
			}
			else
			{
				msg("Sorry an Error Occurred.");
			}
			
			for($b=1;$b<6;$b++)
			{	
				$que2="SELECT * from `quiz` WHERE `id` =".$qid;
				if($da2=mysql_query($que2))
				{
					if(mysql_num_rows($da2) > 0)
					{	
						$batch = $b;
						$darray = mysql_fetch_array($da2);
						$value = $darray['b'.$b];
						if(isset($batch))
						{
							
							$que="SELECT * from `quiz` WHERE `id` = ".$_GET['qid']." AND `tid` = ".$_SESSION['id'];	
							if($dat=mysql_query($que))
							{
								$query="SELECT * from `qstn` WHERE `qid` = '".$_GET['qid']."' AND `batch` = '".$batch."' ORDER BY `done` DESC";
								if($data=mysql_query($query))
								{
									if(mysql_num_rows($data)==0)
									{
										echo "<center><h3>No Data for Batch:".$batch."</h3></center>";
									 
									}
									else
									{
										echo '<br><br><center><table border="1"><caption>';
										echo '<button class="btn btn-info">Batch:-'.$batch.'</button>&nbsp&nbsp&nbsp';

										if($value==0)
											echo "<a href='qact.php?qid=".$_GET['qid']."& batch=".$batch."& value=".$value."' ><button class='btn btn-success'>Start Quiz</button></a>";
										else
											echo "<a href='qact.php?qid=".$_GET['qid']."& batch=".$batch."& value=".$value."' ><button class='btn btn-danger'>Stop Quiz</button></a>";
									
										
										echo '</caption>
										<tr>						
										<td><label>Student PRN</td>
										<td><label>Problem Statement Attempted</label></td>
										<td><label>Penalty (Y/N)</label></td>
										<td><label>Uploaded File</label></td>
										<td><label>Time Taken</label></td>
										</tr>';
										while($row=mysql_fetch_assoc($data))
										{	$qry="SELECT * from `stud` WHERE `id` = ".$row['sid'];
											$da=mysql_query($qry);
											$ro=mysql_fetch_assoc($da);
											$prn=$ro['prn'];
											
											echo '<tr><td>'.$prn.'</td>';
												if($row['done']==1)
												{
													switch($row['attmp'])
													{	
														
														case 1: echo '<td>'.$row['qn'].'</td>'; break;
														case 2: echo '<td>'.$row['qnre'].'</td>'; break;
													}
												}
												else
												echo '<td>Quiz Not Attempted Yet</td>';
											
												echo '<td>'.$row['penal'].'</td>';
												
												if(file_exists("quiz/".$_GET['qid']."/".$row['file'])&&!empty($row['file']))
												echo '<td><a href="'."quiz/".$_GET['qid']."/".$row['file'].'" download><center><img src="file.png" width="50" height="50" alt="File" ></center></a></td>';
												else echo "<td>File does not exist</td>";
												
												$val = $row['end']-$row['start'];
											echo "<td>".gmdate("H:i:s",$val)."</td>";
											echo "</tr>";
											
										}
										echo '</table></center>';
									}
								}  		
								else
								{
									 msg("sorry an error occurred");
									  
								}	
							}
							else
							{
								 msg("You are not allowed to view the details of this quiz.");
								
							}
						}
				
					}
			
				
				}
				else
				{
				
				}
			}
			
		}
		
	}
?>
</div>
</body>
</html>

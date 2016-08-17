<?php
	require 'connect.inc.php';
	require 'core.inc.php';

	

	if(!isloggedins()||isloggedint())
	{  
		header('Location: error.php');
	}
	elseif(isset($_GET['qid']))
	{		
?>		<html>

		<head>
        <link href='http://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
        <link href="bootstrap.min.css" rel="stylesheet">
        <link href="font-awesome.min.css" rel="stylesheet">
        <link href="login.css" rel="stylesheet">
        </head>
		
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
		<ul class = "nav navbar-nav  navbar-right">  
		<?php echo "<li id='naam'>".$_SESSION['fname']."<br>".$_SESSION['lname']."</li>"; ?>
		<li><a href='home.php'>Home</a></li>
		<li><a href='myprofile.php'>My Profile</a></li>
        <li class="active"><a href="myquizes.php">My Quizes</a> </li>
		<li><a href='cpwd.php'>Change Password</a></li>
		<li><a href='logout.php'>Logout</a></li>
		</ul>
	</div>
</nav>


<div id="1" class="container">
<?php
	if(isset($_POST['squiz'])&&isset($_FILES['fileup']))
	{	
			$file_name = $_FILES['fileup']['name'];
			$file_size =$_FILES['fileup']['size'];
			$file_tmp =$_FILES['fileup']['tmp_name'];
			$file_type=$_FILES['fileup']['type'];
			$file_ext=strtolower(end(explode('.',$_FILES['fileup']['name'])));
			$file_name=$_SESSION['sprn']."_".$_GET['qid'].".".$file_ext;
		
			if($file_size > 2097152)
			msg(" File size must be less than 2 MB");
            else
			{
			
				if(!file_exists($_GET['qid']))
				mkdir("quiz/".$_GET['qid']);
			
				if(move_uploaded_file($file_tmp,"quiz/".$_GET['qid']."/".$file_name))
				{
					$yup = time();
					$query  = "update `qstn` set `done`= 1 , `end`=$yup ,`file` = '$file_name' where `qid`=".$_GET['qid']." and `sid` = ".$_SESSION['id'];
		
					if($query_run = mysql_query($query))
					{
						header('Location: success.php');
					}
					else
					{
						msg("Sorry An error occured");
				        
					}		
					
				
				}
			}
				
		
	}			
	
	if(isset($_POST['btninp']))
	{

		$query  = "update `qstn` set `penal`='Y' , `attmp`=2 where `qid`=".$_GET['qid']." and `sid` = ".$_SESSION['id'];
		
		if($query_run = mysql_query($query))
		{
		}
		else
		{
			msg("Sorry An error occured");
               
		}					
	
	}
	
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
					</tr></table></center><br><br>';
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
		}

	$query = "SELECT * FROM `quiz` WHERE `id`=".$_GET['qid'];
	if($query_run = mysql_query($query))
	{
		$array = mysql_fetch_assoc($query_run);
		
		$batch = "b".$_SESSION['sbatch'];
		$durn = $array['durn']*60;
		
		if($array[$batch]==1)
		{
			$gque = "SELECT * FROM `qstn` WHERE `qid`=".$_GET['qid']." AND `sid` = ".$_SESSION['id'];
			
			if($gque_run = mysql_query($gque))
			{
				if(mysql_num_rows($gque_run)>0)
				{	
					$array = mysql_fetch_assoc($gque_run);				
					
					
					if(empty($array['start']))
					{	
						$yup = time();
						$query  = "update `qstn` set `start` = $yup where `qid`=".$_GET['qid']." and `sid` = ".$_SESSION['id'];
						
						if($query_run = mysql_query($query))
						{
							
						}
						else
						{
							msg("Sorry An error occured");
						}	
					}
					else
					{
						$start = $array['start'];
					}
					
					
					if($array['done']!=1)
					{
						echo '<div class="img-thumbnail">';
						if($array['attmp']!=2)
						{
							echo
							'<div class="container">
							<h3>Problem Statement:</h3>
							<span id="span1" >'.$array['qn'].'</span>							
							'
							;
?>
							<br><br>
							<form action=<?php echo '"tquiz.php?qid='.$_GET['qid'].'"'; ?> method="post">
							<input type="submit" name="btninp" value="Change Problem Statement"/>
							</form>
							</div>
<?php					
						}
						else
						{
							echo
							'<div class="container">
							<h3>Problem Statement:</h3>
							<span>'.$array['qnre'].'</span>
							</div>';
							
						}			
?>
						</div>
						<br><br>
						<div class="img-thumbnail">
						<div class="container">
						<form action=<?php echo '"tquiz.php?qid='.$_GET['qid'].'"'; ?> enctype="multipart/form-data" method="post">
						<h3>Submit File:</h3><input type="file" name="fileup"  required/><br>
						<input type="submit" name="squiz" value="Submit Quiz"/>
						</form>
						</div>
						</div>
						<br><br>
						<div class="thumbnail img-thumbnail">
						<h3>Time Left:<span id="timer"></span></h3>
						</div>
						
						<script src="jquery.min.js"></script>
						<script src="bootstrap.min.js"></script>
						<script>
	$(document).ready(function()
	{
		var c = 
		<?php 
		
		$yup=time(); if(isset($start)&&!empty($start)) echo $durn-($yup-$start); else {  echo $durn;} 
		
		
		?>;
		var t;
		timedCount();
		function timedCount() 
		{
			if(c>0)
			{
				var hours = parseInt( c / 3600 ) % 24;
				var minutes = parseInt( c / 60 ) % 60;
				var seconds = c % 60;
				var result = (hours < 10 ? "0" + hours : hours) + ":" + (minutes < 10 ? "0" + minutes : minutes) + ":" + (seconds  < 10 ? "0" + seconds : seconds);
				$('#timer').html(result);
				if(c == 0 )
				{ 
					alert("Quiz Ended, No Submissions will be accepted."); 
					window.location="done.php?qid=<?php echo $_GET['qid'];?>";
				}
				else
				{
					c = c - 1;
					t = setTimeout(function(){ timedCount() }, 1000);
				}
			}
			else
			{
				var result = "0" + ":" + "0" + ":" + "0" + "<br>Time Up" ;
				$('#timer').html(result);
				alert("Quiz Ended, No Submissions will be accepted."); 
					window.location="done.php?qid=<?php echo $_GET['qid'];?>";
			}
		}
	});
	</script>
<?php
					}
					else
					{
						msg("Quiz Attempted wait for results.");
						echo "<h3>Quiz Attempted wait for results.</h3>";
				            
					}
				}
				else
				{
					msg("No details found");
                   echo "<h2>No details found</h2>";
				}
			}
			else
			{
				msg("Sorry An error occured");
            }			
			
		}
		else
		{
			msg("Quiz not staretd yet.");
			echo "<h2>Quiz not staretd yet.</h2>";
            
		}
		
		
	}
	else
	{
		
	}
?>
	
</div>
</body>

</html>
<?php

	}

?>

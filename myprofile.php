<?php
	require 'connect.inc.php';
	require 'core.inc.php';

	

	if(!isloggedins())
	{  
		header('Location: error.php');
	}
	else
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
		<ul class = "nav navbar-nav navbar-right">  
			<?php echo "<li id='naam'>".$_SESSION['fname']."<br>".$_SESSION['lname']."</li>"; ?>
			<li><a href='home.php'>Home</a></li>
			<li class="active"><a href='myprofile.php'>My Profile</a></li>
			<li><a href="myquizes.php">My Quizes</a> </li>
			<li><a href='cpwd.php'>Change Password</a></li>
			<li><a href='logout.php'>Logout</a></li>
		</ul>
	</div>
</nav>

	
<?php		
		echo "
		<div class='container' style='background-color:rgba(255, 255, 255, .8);'>
			<center><h2>Welcome to your profile :) !!!</h2></center>
			<center><h3>Profile Details</h3></center>
			<div class='container img-thumbnail' style='background-color:rgba(255, 255, 255, .8);' style='border: 1px solid black;'>
			<h4>PRN:\t".$_SESSION['sprn']."</h4>
			<h4>Name of Student:\t".$_SESSION['fname']." ".$_SESSION['lname']."</h4>
			<h4>Class:\t".$_SESSION['syr']." B.Tech ".$_SESSION['sbran']."</h4>
			</div><br><BR>
			<div class='container img-thumbnail' style='background-color:rgba(255, 255, 255, .8);' style='border: 1px solid black;'>
			<h4>Courses:\t</h4>
			";
			$query = "SELECT * FROM `sub` WHERE `yr`= '".$_SESSION['syr']."' AND `branch`='".$_SESSION['sbran']."'";
			if($query_run = mysql_query($query))
			{
				while($array = mysql_fetch_array($query_run))
				{
					echo $array['ccode']."\t".$array['cname']."<br>";
				}				
			}
			else
			{
				msg("Sorry an Error Occurred.");
				echo "Sorry an Error Occurred.";
			}
			
		echo "</div><center><h3>Live Quizzes</h3></center>
		<div class='container img-thumbnail' style='background-color:rgba(255, 255, 255, .8);' style='border: 1px solid black;'>
			";
		
		
		

		
		$query = "SELECT a.qid,b.ccode,c.cname FROM qstn a, quiz b, sub c WHERE a.sid= ".$_SESSION['id']." AND a.done=0 AND a.qid = b.id AND b.ccode = c.ccode AND b.b".$_SESSION['sbatch']." = 1";
			if($query_run = mysql_query($query))
			{
					if(mysql_num_rows($query_run)==0)
					echo"No Live Quizzes";
				
				while($array = mysql_fetch_array($query_run))
				{
					echo $array['qid']."\t".$array['ccode']."\t".$array['cname']."\t<a href='inst.php?qid=".$array['qid']."'>&nbsp&nbsp&nbsp&nbsp<button class='btn btn-success'>Take Quiz</button></a><br>";
				}
			
			}
			else
			{
				msg("Error Occurred.");
			}
		echo"
		<br>
		</div><br><br>
		</div>
		";
		
		//echo "<form action='logout.php' > <input type='submit' name='submit' value='Logout' > </form>";
	

?>


		</body>


		</html>
		
<?php
	}
	



?>		

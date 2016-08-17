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

		<body >		
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
			<li class="active"><a href='myprofilet.php'>My Profile</a></li>
			<li><a href='cpwdt.php'>Change Password</a></li>
			<li><a href='quizes.php'>Quizes</a> </li>
			<li><a href='creq.php'>Add Quiz</a></li>
			<li><a href='logout.php'>Logout</a></li>
		</ul>
	</div>
</nav>
		
<?php		
		echo "<br><br><div class='container'>
			<div class='container img-thumbnail' style='background-color:rgba(255, 255, 255, .8);'>
			<center><h2>Welcome to your Profile :)</h2></center>";
		echo "<center><h3>Profile Details</h3></center>
			<h4>Name of Teacher:\t\t".$_SESSION['fname']." ".$_SESSION['lname']."</h4>";
			
		$query = "SELECT a.ccode,a.cname,a.cred,a.yr,a.branch FROM sub a,trsub b WHERE b.tid=".$_SESSION['id']." and b.sid=a.id"	;
		if($query_run = mysql_query($query))
		{
				if(mysql_num_rows($query_run)==0)
				echo"No Courses assigned yet.";
			
			echo "<br><br><table border='1'style='width:100%'>
				<caption><center><h3>Courses</h3></center></caption>
			";
			echo "<tr><td>Course Code</td><td>Course Name</td><td>Credits</td><td>Class</td><td>Branch</td></tr>";
			while($array = mysql_fetch_array($query_run))
			{
				echo "<tr><td>".$array['ccode']."</td><td>".$array['cname']."</td><td>".$array['cred']."</td><td>".$array['yr']."</td><td>".$array['branch']."</td></tr>";
			}
			echo "</table><br></div>";
		}
		else
		{
			msg("Error Occurred.");
		}	
			
		echo"	
		</div>
		";
	}

?>


</body>


</html>

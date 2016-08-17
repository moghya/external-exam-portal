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
		.btn-block{
			width: 50%;
  	 			  }
  	    #naam {
               		 border-right: 1px solid gray;
               		 padding-right: 4px;
              }
		label
		{
			margin-bottom: .5rem;
			font-family: serif;
			
			font-size: 18px;
			line-height: 1.1;
			color: black;
		}
		span
		{
			font-family: serif;
			font-size: 16px;
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
			<li><a href='myprofilet.php'>My Profile</a></li>
			<li><a href='cpwdt.php'>Change Password</a></li>
			<li class="active"><a href='quizes.php'>Quizes</a> </li>
			<li><a href='creq.php'>Add Quiz</a></li>
			<li><a href='logout.php'>Logout</a></li>
		</ul>
	</div>
</nav>

<div class="container">
<br><br>
  
<?php	

		$query = "SELECT a.dt,a.id,a.ccode,b.cname FROM quiz a, sub b WHERE a.tid=".$_SESSION['id']." and a.ccode=b.ccode ORDER BY a.dt DESC";
		if($query_run = mysql_query($query))
		{
			$nquiz = mysql_num_rows($query_run);
			if($nquiz>0)
			{
				while($array = mysql_fetch_assoc($query_run))
				{
					echo
					'<div class = "col-sm-6 col-md-6">
					<div class="thumbnail img-thumbnail"	style="background-color:rgba(255, 255, 255, .8);  max-width: 80%;">
					<label>Quiz Added on:</label><span>'.$array['dt'].'</span><br>
					<label>Quiz Id:</label><span>'.$array['id'].'</span><br>
					<label>Course Code:</label><span>'.$array['ccode'].'</span>&nbsp&nbsp&nbsp&nbsp&nbsp
					<label>Course Name:</label><span>'.$array['cname'].'</span><br>
					
					<a href="delq.php?qid='.$array['id'].'"><button  class="btn btn-danger pull-right" type="submit">Delete Quiz</button></a>
					<a href="upquiz.php?qid='.$array['id'].'"><button class="btn btn-primary pull-right"  type="submit">Edit Quiz</button></a>
					<a href="disp.php?qid='.$array['id'].'"><button  class="btn btn-info" type="submit">Quiz Details</button></a>
					
					</div>
					</div>';					
				}	
				
//<a href="alott.php?qid='.$array['id'].'"><button class="btn btn-success"  type="submit">Start Quiz</button></a>
					
			}
			else
			{
				
				msg("No quiz created yet");
				echo "<h2>No quiz created yet</h2>";
            }	
			
		}
		else
		{
			
			msg("Sorry An error occured");
              
		}
    }
?>
</div>
</body>
</html>

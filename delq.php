<?php

    require 'connect.inc.php';
	require 'core.inc.php';

	if(!isloggedint()||isloggedins())
	{  
		header('Location: error.php');
	}
	else
    {
		
		
		if(isset($_POST['del']))
		{
			$file = "quiz/quiz_".$_GET['qid'].".txt";
			if(file_exists($file))
			{
				unlink($file);
			}
			$file = "inst/inst".$_GET['qid'].".txt";
			if(file_exists($file))
			{
				unlink($file);
			}
			$query = "DELETE FROM `qstn`  WHERE qid=".$_GET['qid'];
			if($query_run = mysql_query($query))
			
			$query = "DELETE FROM `quiz`  WHERE id=".$_GET['qid'];
			if($query_run = mysql_query($query))
				
			header("Location: quizes.php");
		}	
		
		if(isset($_POST['nodel']))
			header("Location: quizes.php");
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
<br><br>
<div class='container ' style='background-color:rgba(255, 255, 255, .8);'>
			
<?php
		if(isset($_GET['qid']))
		{
			echo 
			'<center><h1 style="color: red;">ALERT!!!</h1><h2>You are about to perform <span style="color: red;">DELETE</span> operation.</h2>
			<h3>All of the following details will be <span style="color: red;">DELETED</span> and none of it is recoverable.</h3>
			<h4>All Questions of the Quiz.</h4>
			<h4>All Instructions of the Quiz.</h4>
			<h4>All details of Student\'s performance related to the quiz.</h4>
			<h3>Are you SURE?</h3>		
			<form action="delq.php?qid='.$_GET['qid'].'" method="post">
			<input class="btn btn-danger" type="submit" name="del" value="Delete Quiz"/>
			<input class="btn btn-success" type="submit" name="nodel" value="Don\'t Delete Quiz"/>
			</form></center>
			';
		}
		else
		{
			header("Location: error.php");
		}

?>
</div>
</body>
</html>
<?php
	}
?>
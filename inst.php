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
        	<style>
  	 #naam {
                    border-right: 1px solid gray;
                    padding-right: 4px;
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
			<li ><a href='myprofile.php'>My Profile</a></li>
			<li class="active"><a href="myquizes.php">My Quizes</a> </li>
			<li><a href='cpwd.php'>Change Password</a></li>
			<li><a href='logout.php'>Logout</a></li>
		</ul>
	</div>
</nav>

<?php

	echo 
	'
	<div class="container content">
	<center><h1>----Instructions----</h1></center>
	<div class="container thumbnail img-thumbnail"	style="background-color:rgba(255, 255, 255, .8);">
	';
	
	$x=0;
	
	$file='inst/cinst.txt';
		$fobj=fopen($file,'r') or die("unable to open file!");
		while(!feof($fobj))
		{
			$x++;
			$ins = fgets($fobj);
			echo "<h4>".$x.")".$ins."</h4>";
		}
		
	$file='inst/inst_'.$_GET['qid'].'.txt';
	if(file_exists($file))
		$fobj=fopen($file,'r') or die("unable to open file!");
		while(!feof($fobj))
		{
			$x++;
			$ins = fgetc($fobj);
			echo $ins;
		}
	echo'
	<br<br>
	<center><button class="btn btn-success" type="submit"><a href="tquiz.php?qid='.$_GET['qid'].'">Take Quiz</a></button></center>
	</div>
	</div>
	';
	}
?>
</body>
</html>

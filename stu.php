<?php

	require 'connect.inc.php';
	require 'core.inc.php';
	if(!isloggedina() || isloggedins() || isloggedint())
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
			<li><a href='myprofilea.php'>My Profile</a></li>
		    <li class="active"><a <?php if(isalert()){?> style="color:red;" <?php } ?> href="do.php">Update</a> </li>
			<li><a href='cpwda.php'>Change Password</a></li>
			<li><a href='logout.php'>Logout</a></li>
			</ul>
		</div>
		</nav>
			<ol class="breadcrumb">
		<li><a href="do.php">Update</a></li>
		<li class="active">Students</li>
		</ol>
		
		<div class="container">

			<ul class="list-group">
			<li class="list-group-item"><a href="ins_s.php">Insert new Record</a></li>
			<li class="list-group-item"><a href="mod_s.php">Modify existing Record</a></li>
			<li class="list-group-item"><a href="del_s.php">Delete a Record</a></li>
			<li class="list-group-item"><a href="get_s.php">Search a Record</a></li>
			</ul>
		</div>
	</body>
</html>
<?php
	}
?>

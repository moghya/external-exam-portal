<?php

	require 'connect.inc.php';
	require 'core.inc.php';
	
	
	if(isloggedint()||isloggedins() || isloggedina())
	{
?>
<html>

<head>
<link href='http://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
<link href="bootstrap.min.css" rel="stylesheet">
<link href="font-awesome.min.css" rel="stylesheet">
<link href="login.css" rel="stylesheet">
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
 </nav>
<?php
		session_destroy();
		echo "<center><h4>You have successfully Logged Out.</h4></center><br>";
		echo "<u><center><h4><a href='home.php'>Home</a></h4></center></u>";
	}
	else
	header('Location: home.php');	
	

?>

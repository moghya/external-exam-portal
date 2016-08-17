<?php

	require 'connect.inc.php';
	require 'core.inc.php';
	if(!isloggedina())
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

		<body background="bg2.jpg">		
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
   
   <div class = "collapse navbar-collapse" id = "example-navbar-collapse">	
		<ul class = "nav navbar-nav navbar-right ">  
			<?php echo "<li id='naam'>".$_SESSION['fname']."<br>".$_SESSION['lname']."</li>"; ?>
			<li><a href='home.php'>Home</a></li>
			<li class="active"><a href='myprofilea.php'>My Profile</a></li>
			<li><a <?php if(isalert()){?> style="color:red;" <?php } ?> href='do.php'>Update</a></li>
			<li><a href='cpwda.php'>Change Password</a></li>
			<li><a href='logout.php'>Logout</a></li>
		</ul>
	</div>
</nav>
		
<?php		
		echo "<div class='container'><h3>Hello ".$_SESSION['fname']." ".$_SESSION['lname']." <b>Welcome to your profile :) !!!</h3></div>";
		
		
	}

?>


		</body>


		</html>

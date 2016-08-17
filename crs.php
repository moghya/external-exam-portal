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
			<li><a href='myprofilea.php'>My Profile</a></li>
		    <li class="active"><a <?php if(isalert()){?> style="color:red;" <?php } ?> href="do.php">Update</a> </li>
			<li><a href='cpwda.php'>Change Password</a></li>
			<li><a href='logout.php'>Logout</a></li>
			</ul>
		</div>
		</nav>
		
		<ol class="breadcrumb">
		<li><a href="do.php">Update</a></li>
		<li class="active">Courses</li>
		</ol>
		
		<div class="container">
			<ul class="list-group">
			<li class="list-group-item"><a href="ins_c.php">Add new Course</a></li>
			<li class="list-group-item"><a href="mod_c.php">Modify existing Course</a></li>
			<li class="list-group-item"><a href="del_c.php">Delete a Course</a></li>
			<li class="list-group-item"><a href="get_c.php">Search a Course</a></li>
			</ul>
		</div>
<?php
		if(isalert())
		{	
			echo '<div class="container">
			<h4 style="color:red;" >Courses need to be updated!!</h4>
			<ul class="list-group">';

			$query="SELECT * FROM `sub` WHERE `alert` = '1'";
			if($data=mysql_query($query))
			{
				while($row=mysql_fetch_assoc($data))
				{
					$ccode=$row['ccode'];
					echo '<li class="list-group-item "> <a href="mod_c.php?ccode='.$ccode.'&submit=submit">'.$ccode.'</a></li>';
				}
			}
			else
			{	
				echo '
					<script type="text/javascript">
					alert( "An error occurred");
					</script>';
			}
			echo'</div>';

		}
?>
</html>
<?php
	}
?>

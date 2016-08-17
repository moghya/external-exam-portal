<?php
	require 'connect.inc.php';
	require 'core.inc.php';
	
	if(isloggedins() || isloggedint()|| !isloggedina())
	{
		header("Location:error.php");
	}
	
	if(isset($_POST['submit']))
	{
		if(!empty($_POST['ccode']))
		{
			$ccode=$_POST['ccode'];
			$query="SELECT * FROM `sub` WHERE `ccode` = '".$ccode."'";
			if($data=mysql_query($query))
			{	
				if(mysql_num_rows($data)==1)
				{
					$row=mysql_fetch_assoc($data);
					$sid=$row['id'];
					$query="DELETE FROM `trsub` WHERE `sid` = '".$sid."'";
					if($data=mysql_query($query))
					{
					
						$query="DELETE FROM `sub` WHERE `ccode` = '".$ccode."'";
						if(mysql_query($query))
						{

							echo '<script type="text/javascript">
							alert( "Record Successfully Deleted");
							</script>';

						}
						else
						{                  
							echo '
							<script type="text/javascript">
							alert("An error occured");
							</script>';

						}
					}
					else
					{
						echo '
							<script type="text/javascript">
							alert("An error occured");
							</script>';
					}
				}
				else
				{                  
					echo '
					<script type="text/javascript">
					alert("Invalid Course Code");
					</script>';

				}
			}
			else
			{                  
				echo '
				<script type="text/javascript">
				alert("An error occured");
				</script>';

			}	
		}
		else
		{                  
			echo '<script type="text/javascript">
			alert( "Please fill in the fields");
			</script>';

		}
	}
	
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
		<li><a href="crs.php">Courses</a></li>
		<li class="active">Delete</li>
		</ol>
	
	<div class="container" >
		<div class="text-center" class="login-form">
			<form id="login-form" method="post" class="form-signin" role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>">
			<label class="text-center">Enter Course Code:</label>
			<input class="text-center" type="text" name="ccode" class="form-control" placeholder="Course Code" autofocus />
			<input type="submit" name="submit" value="Delete"/>
		</div>
	</div>
	</body>
</html>

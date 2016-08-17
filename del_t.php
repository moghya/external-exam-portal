<?php
	require 'connect.inc.php';
	require 'core.inc.php';
	
	if(isloggedins() || isloggedint()|| !isloggedina())
	{
		header("Location:error.php");
	}
	
	if(isset($_POST['submit']))
	{
		if(!empty($_POST['uname']))
		{
			$uname=$_POST['uname'];
			$query="SELECT * FROM `tchr` WHERE `uname` = '".$uname."'";
			if($data=mysql_query($query))
			{
				if(mysql_num_rows($data)==1)
				{
					$row=mysql_fetch_assoc($data);
					$tid=$row['id'];
					$query="SELECT * FROM `trsub` WHERE `tid` = '".$tid."'";
					if($data=mysql_query($query))
					{
						if(mysql_num_rows($data)>0)
						{	
							while($row=mysql_fetch_assoc($data))
							{
								$sid=$row['sid'];
								$que="UPDATE `sub` SET `alert` = '1' WHERE `id` = '".$sid."'";
								if($da=mysql_query($que)){}
								else
								{
									echo '
									<script type="text/javascript">
									alert( "An error occurred");
									</script>';
								}	
							}	
						}
						
						$query="DELETE FROM `tchr` WHERE `uname` = '".$uname."'";
						if($data=mysql_query($query))
						{
							echo '
							<script type="text/javascript">
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
						alert( "An error occurred");
						</script>';
					}						
				}
				else
				{
					echo '
					<script type="text/javascript">
					alert( "Invalid Username");
					</script>';
				}
			}
			else
			{
				echo '
				<script type="text/javascript">
				alert( "An error occurred");
				</script>';
			}
		}
		else
		{                  
			echo '
			<script type="text/javascript">
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
		<li><a href="tch.php">Teacher</a></li>
		<li class="active">Delete</li>
	</ol>
	
	<div class="container" >
		<div class="text-center" class="login-form">
			<form id="login-form" method="post" class="form-signin" role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>">
			<label class="text-center">Enter Username:</label>
			<input class="text-center" type="text" name="uname" class="form-control" placeholder="Username" autofocus />
			<input type="submit" name="submit" value="Delete"/>
		</div>
	</div>
	</body>
</html>

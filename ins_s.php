<?php

	require 'connect.inc.php';
	require 'core.inc.php';
	if(!isloggedina() || isloggedins() || isloggedint())
	{  
		header('Location: error.php');
	}
	if(isset($_POST['prn'],$_POST['pwd'],$_POST['fname'],$_POST['mname'],$_POST['lname'],$_POST['yr'],$_POST['branch'],$_POST['batch']))
	{
		$pwd = $_POST['pwd'];
	    if(!empty($_POST['prn'])&& !empty($_POST['pwd']) && !empty($_POST['fname'])&& !empty($_POST['mname'])&& !empty($_POST['lname'])&& !empty($_POST['yr'])&& !empty($_POST['branch'])&& !empty($_POST['batch']))	
		{
				$pwdhash = md5($pwd);
				$query = "INSERT INTO `stud`(`id`, `prn`, `pwd`, `fname`, `mname`, `lname`, `yr`, `bran`, `batch`) VALUES ('','" .$_POST['prn']. "','" .$pwdhash. "','" .$_POST['fname']. "','" .$_POST['mname']. "','" .$_POST['lname']. "','" .$_POST['yr']. "','" .$_POST['branch']. "','" .$_POST['batch']. "')";
				
				if($query_run = mysql_query($query))
				{			
?>								
								<script type="text/javascript">
								alert("Record Added Succesfully.");
								redirect="myprofilea.php";
								time = 2000;
								function redirect()
								{
									setTimeout("location.href = redirect;",time);
								}
								redirect();
								</script>
<?php
				}
				else
				{
								
								                            ?>
					<script type="text/javascript">
					alert( "Error ocurred ");
					</script>
<?php
				}
			
			}
			else
			{
                            
            ?>
		        <script type="text/javascript">
		        alert("Please fill in all fields.");
		        </script>
            <?php
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
		<li><a href="stu.php">Students</a></li>
		<li class="active">Add</li>
		</ol>
		
		<div class="container">
			<div class="login-form">

				<h2 class="text-center">Please fill in the following fields</h2>
				<div class="form-header">

				</div>
				<form id="login-form" method="post" class="form-signin" role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>">
				<input type="text" name="prn" class="form-control" placeholder="PRN" autofocus><br>
				<input name="pwd" id="email" type="password" class="form-control" placeholder="Password" autofocus><br>
				<input name="fname" id="password" type="text" class="form-control" placeholder="First Name"> <br>
				<input name="mname" id="password" type="text" class="form-control" placeholder="Middle Name"> <br>
				<input name="lname" id="password" type="text" class="form-control" placeholder="Last Name"> <br>
				<input name="yr" id="password" type="text" class="form-control" placeholder="Year e.g: 2 "> <br>
				<input name="branch" id="password" type="text" class="form-control" placeholder="Branch e.g: IT"><br>
				<input name="batch" id="password" type="text" class="form-control" placeholder="Batch e.g: 1"> <br>
				<button class="btn btn-block bt-login" type="submit">Add Record</button>
				</form>
				<br/>

			</div>
		</div>
	</body>
	</html>

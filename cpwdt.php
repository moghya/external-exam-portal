<?php
	require 'connect.inc.php';
	require 'core.inc.php';
	
	if(isloggedint()&&!isloggedins())
	{
		if(isset($_POST['cpwd'])&&isset($_POST['npwd'])&&isset($_POST['cnpwd']))
		{
			$cpwd = $_POST['cpwd']; $npwd = $_POST['npwd']; $cnpwd = $_POST['cnpwd'];
			
			if(!empty($cpwd)&&!empty($npwd)&&!empty($cnpwd))
			{
				$cpwdhash = md5($cpwd);
				$query = "SELECT * FROM `tchr` WHERE `id`='".$_SESSION['id']."' AND `pwd`='".$cpwdhash."'";
				
				if($query_run = mysql_query($query))
				{
					if(mysql_num_rows($query_run)==1)
					{
						if(($npwd===$cnpwd)&&strlen($npwd)>=6&&strlen($npwd)<=12)
						{
							$npwdhash = md5($npwd);
							$queryup = "UPDATE `tchr` SET `pwd`='".$npwdhash."' WHERE `id` = '".$_SESSION['id']."'";
							if($queryup_run = mysql_query($queryup))
							{
								
								
?>								
								<script type="text/javascript">
								alert("Password changed Succesfully.<a href='myprofilet.php'>My Profile</a>");
								redirect="myprofilet.php";
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
								
								msg("sorry an error ocurred.");
				   				 
							}
						}
						else
						{
								echo '<script type="text/javascript">
								alert("New passwords do not match.(Set max of 12 and min of 6 chars in password)");
								</script>';
						}
						
					}
					else
					{
						echo '<script type="text/javascript">
						alert("Invalid Current password .");
						</script>';
					}	
				}
				else
				{
					echo '
					<script type="text/javascript">
					alert("Sorry an error occurred.");
					</script>';
				}
				
				
			}
			else
			{
				
				msg("Please fill in all fields.");
				
			}	
			
		}	




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
			<li><a href='myprofilet.php'>My Profile</a></li>
			<li class="active"><a href='cpwdt.php'>Change Password</a></li>
			<li><a href='quizes.php'>Quizes</a> </li>
			<li><a href='creq.php'>Add Quiz</a></li>
			<li><a href='logout.php'>Logout</a></li>
		</ul>
	</div>
</nav>
	
	<div class="container">
		<div class="login-form">
			
			<h2 class="text-center">Change Password</h2>
			<div class="form-header">
				
			</div>
			<form id="login-form" method="post" class="form-signin" role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>">
				<input type="password" name="cpwd" class="form-control" placeholder="Current Password" autofocus><br>
				<input name="npwd" id="email" type="password" class="form-control" placeholder="New Password" autofocus><br>
				<input name="cnpwd" id="password" type="password" class="form-control" placeholder="Confirm New Password"> 
				<button class="btn btn-block bt-login" type="submit">Change Password</button>
			</form>
			<br/>
			
		</div>
	</div>
	</body>
	</html>
<?php
	
	}
	else
	{
		
		header('Location: error.php');
	}	

?>

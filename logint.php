<?php
	require 'connect.inc.php';
	require 'core.inc.php';
	
	if(isloggedint())	
	{
		header('Location: myprofilet.php');
		
	}
	else
	{
		if(isloggedins())
		header('Location: error.php');

		if(isset($_POST['uname'])&&isset($_POST['pwd']))
		{
			
			$uname = $_POST['uname'];
			$pwd = $_POST['pwd'];
			
			if(!empty($uname)&&!empty($pwd))
			{
				
				$passhash = md5($pwd);
				
				$query = "SELECT * FROM `tchr` WHERE `uname`= '".$uname	."' AND `pwd`= '".$passhash."'";
				if($query_run = mysql_query($query))
				{
					if(mysql_num_rows($query_run)==1)
					{
						
						
						$query_row = mysql_fetch_assoc($query_run);							
						$_SESSION['id'] = $query_row['id'];
						$_SESSION['fname'] = $query_row['fname'];
						$_SESSION['lname'] = $query_row['lname'];
						$_SESSION['pass'] = $query_row['pwd'];
						$_SESSION['r']= "t";
						header('Location: myprofilet.php');
						
					}
					else
					{
						                            ?>
            <script type="text/javascript">
            alert( "Invalid Login");
            </script>
            <?php
					}							
				}
				else
				{
													                            ?>
            <script type="text/javascript">
            alert( "Error ocurred");
            </script>
            <?php
				}	
			}
			else
			{
												                            ?>
            <script type="text/javascript">
            alert( "Fill all fields.");
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
			<li><a href="home.php">Home</a></li>
			<li><a href='logins.php' >Student's Login</a></li>
			<li class="active"><a href='logint.php'>Teacher's Login</a></li>
			<li><a href='logina.php' >Admin's Login</a></li>		
		</ul>
	</div>
</nav>
	
<div class="container">
		
		<div class="login-form">
			
			<h2 class="text-center">Teacher Login</h2>
			<div class="form-header">
				
			</div>
			<form id="login-form" method="post" class="form-signin" role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>">
				<input name="uname" id="email" type="text" class="form-control" placeholder="User Id" autofocus> 
				<br>
				<input name="pwd" id="password" type="password" class="form-control" placeholder="Password"> 
				<button class="btn btn-block bt-login" type="submit">Login</button>
			</form>
			<br/>
			
		</div>
	</div>
		
		</body>


		</html>
<?php		
	}
	
?>	

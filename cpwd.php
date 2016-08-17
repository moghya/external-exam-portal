<?php
	require 'connect.inc.php';
	require 'core.inc.php';
	
	if(isloggedins()&&!isloggedint())
	{
		if(isset($_POST['cpwd'])&&isset($_POST['npwd'])&&isset($_POST['cnpwd']))
		{
			$cpwd = $_POST['cpwd']; $npwd = $_POST['npwd']; $cnpwd = $_POST['cnpwd'];
			
			if(!empty($cpwd)&&!empty($npwd)&&!empty($cnpwd))
			{
				$cpwdhash = md5($cpwd);
				$query = "SELECT * FROM `stud` WHERE `id`='".$_SESSION['id']."' AND `pwd`='".$cpwdhash."'";
				
				if($query_run = mysql_query($query))
				{
					if(mysql_num_rows($query_run)==1)
					{
						if(($npwd===$cnpwd)&&strlen($npwd)>=6&&strlen($npwd)<=12)
						{
							$npwdhash = md5($npwd);
							$queryup = "UPDATE `stud` SET `pwd`='".$npwdhash."' WHERE `id` = '".$_SESSION['id']."'";
							if($queryup_run = mysql_query($queryup))
							{
								
?>								
								<script type="text/javascript">
								alert("Password changed Succesfully.");
								redirect="myprofile.php";
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
            alert( "Error ocurred");
            </script>
            <?php
							}
						}
						else
						{
                                        ?>
            <script type="text/javascript">
            alert( "New passwords don't match.(Set max of 12 and min of 6 chars in password)");
            </script>
            <?php
				
						}
						
					}
					else
					{
						            ?>
            <script type="text/javascript">
            alert("Invalid Current password.");
            </script>
            <?php
					}	
				}
				else
				{
					            ?>
                    <script type="text/javascript">
                    alert("Sorry an error ocurred");
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
   
   <div class = "collapse navbar-collapse " id = "nav">	
		<ul class = "nav navbar-nav navbar-right">  
		<?php echo "<li id='naam'>".$_SESSION['fname']."<br>".$_SESSION['lname']."</li>"; ?>
		<li><a href='home.php'>Home</a></li>
		<li><a href='myprofile.php'>My Profile</a></li>
        <li><a href="myquizes.php">My Quizes</a> </li>
		<li class="active"><a href='cpwd.php'>Change Password</a></li>
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
	
<?php
	
	}
	else
	{
		
		header('Location: error.php');
	}	

?>

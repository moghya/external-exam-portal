<?php

	require 'connect.inc.php';
	require 'core.inc.php';
	
	
	if(!isloggedina() || isloggedins() || isloggedint())
	{  
		header('Location: error.php');
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
		<li class="active">Modify</li>
	</ol>
<?php	
	
	$show=1;
	if(isset($_GET['id'],$_POST['done'],$_POST['ccode'],$_POST['cname'],$_POST['cred'],$_POST['yr'],$_POST['branch'],$_POST['fac']))
	{
		
		$que1="UPDATE `sub` SET `ccode`='".$_POST['ccode']."' , `cred`='".$_POST['cred']."',`cname`='".$_POST['cname']."', `yr`='".$_POST['yr']."',`branch`='".$_POST['branch']."' WHERE `id` ='".$_GET['id']."'";
	
		if($query_run = mysql_query($que1))
		{
			$que1="SELECT * FROM `tchr` WHERE `uname` = '".$_POST['fac']."'";
			if($data=mysql_query($que1))
			{
				if(mysql_num_rows($data)==1)
				{
					$row=mysql_fetch_assoc($data);
					$tid=$row['id'];
					
					$que1="UPDATE `trsub` SET `tid`='".$tid."' WHERE `sid` = '".$_GET['id']."'";
					if(mysql_query($que1))
					{	
						$que2="UPDATE `sub` SET `alert` = '0' WHERE `id` = '".$_GET['id']."'";
						if($data=mysql_query($que2))
						{	$show=1;
							
	?>						<script type="text/javascript">
							alert("Record Updated Succesfully.");
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
							msg("An error occurred");
						}
					}
					else
					{
						msg("An error occurred");
					}
				}
				else
				{
					msg("Invalid Username");
				}
			}
			else
			{
				msg("An error occurred");
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
	

		if(isset($_GET['submit']) )
		{	if(!empty($_GET['ccode']))
			{	$ccode=$_GET['ccode'];
				$que="SELECT * from `sub` WHERE `ccode` = '".$ccode."'";
				if($data=mysql_query($que))
				{
					if(mysql_num_rows($data) == 1)
					{
						$row=mysql_fetch_assoc($data);
						$id=$row['id'];
						$ccode=$row['ccode'];
						$cred=$row['cred'];
						$cname=$row['cname'];
						$yr=$row['yr'];
						$branch=$row['branch'];
						$query="SELECT * FROM `trsub` WHERE sid = '".$id."'";
						if($data=mysql_query($query))
						{
							if(mysql_num_rows($data)==1)
							{
								$row=mysql_fetch_assoc($data);
								$tid=$row['tid'];
								$query="SELECT * FROM `tchr` WHERE `id` = '".$tid."'";
								if($data=mysql_query($query))
								{
									if(mysql_num_rows($data)==1)
									{
										$row=mysql_fetch_assoc($data);
										$uname=$row['uname'];
									}
									else
										$uname="Username of teaching faculty";
		?>					

									<div class="login-form">
										<h2 class="text-center">Please modify the fields as required</h2>
										<div class="form-header">

										</div>
										<?php
										echo "<form id='login-form' method='post' class='form-signin' role='form' action='mod_c.php?id=".$id."'>   
										<input type='text' name='ccode' class='form-control' value='".$ccode."' autofocus><br/>
										<input name='cred'  type='text' class='form-control' value='".$cred."' autofocus><br/>
										<input name='cname'  type='text' class='form-control' value='".$cname."'> <br/>
										<input name='yr' type='text' class='form-control' value='".$yr."'> <br/>
										<input name='branch' type='text' class='form-control' value='".$branch."'><br/>
										<input name='fac' type='text' class='form-control' value='".$uname."'><br/>
										<input name='done' type='submit' class='btn btn-block bt-login' value='Update Course' />
										</form>
										<br/>			
									</div> </body>";
									$show=0;
									
								}
								else
								{
									msg("An error occurred!");
								}
							}
						}
						else
						{
							msg("An error occurred!");
						}
					}
					else
					{
		?>
						<script type="text/javascript">
						alert( "Invalid Course Code");
						</script>
					<?php
					}
				}
				else
				{
		?>
					<script type="text/javascript">
					alert( "An error occurred");
					
					</script>
					
		<?php
				}
			}
			else
			{
		?>
				<script type="text/javascript">
				alert( "Fill in the fields");
				redirect="mod_c.php";
				time=2000;
				function redirect()
				{
					setTimeout("location.href = redirect;",time);
				}
				redirect();
				</script>
			
<?php	
			}
		}
		if($show)
		{
?>	
			<div class="container" >
			<div class="text-center" class="login-form">
				<form id="login-form" method="get" class="form-signin" role="form" action="mod_c.php?ccode=$ccode">
				<label class="text-center"><b>Enter Course Code:</b></label>
				<input class="text-center" type="text" name="ccode" class="form-control" placeholder="Course Code" autofocus />
				<b><input type="submit" name="submit" value="Submit"/></b>
			</div>
		</div>
	
<?php
		}
	
?>
</body>
	</html>
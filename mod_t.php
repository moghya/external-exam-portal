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
		<li><a href="tch.php">Teacher</a></li>
		<li class="active">Modify</li>
	</ol>
<?php	
	$show=1;
	if(isset($_GET['id'],$_POST['done'],$_POST['uname'],$_POST['fname'],$_POST['mname'],$_POST['lname']))
	{
		if(isset($_POST['pwd']))
		{
			$pwd=$_POST['pwd'];
			$pass=md5($pwd);
			$que1="UPDATE `tchr` SET `uname`='".$_POST['uname']."' , `pwd`='".$pass."',`fname`='".$_POST['fname']."',`mname`='".$_POST['mname']."',`lname`='".$_POST['lname']."' WHERE `id` ='".$_GET['id']."'";
		}
		else
		{
			$que1="UPDATE `tchr` SET `uname`='".$_POST['uname']."' ,`fname`='".$_POST['fname']."',`mname`='".$_POST['mname']."',`lname`='".$_POST[lname]."' WHERE `id` ='".$_GET['id']."'";
		
		}
		if($query_run = mysql_query($que1))
		{			$show=1;
?>								
			<script type="text/javascript">
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
						
						                            ?>
			<script type="text/javascript">
			alert( "Error ocurred");
			</script>
<?php
		}
			
	}
	

		if(isset($_POST['submit']) )
		{
			if(!empty($_POST['uname']))
			{	$uname=$_POST['uname'];
				$que="SELECT * from `tchr` WHERE `uname` = '".$uname."'";
				if($data=mysql_query($que))
				{
					if(mysql_num_rows($data) == 1)
					{
						$row=mysql_fetch_assoc($data);
						$id=$row['id'];
						$uname=$row['uname'];
						$pwd=$row['pwd'];
						$fname=$row['fname'];
						$mname=$row['mname'];
						$lname=$row['lname'];
	?>

						<div class="login-form">
							<h2 class="text-center">Please modify the fields as required</h2>
							<div class="form-header">

							</div>
							<?php
							echo "<form id='login-form' method='post' class='form-signin' role='form' action='mod_t.php?id=".$id."'>   
							<input type='text' name='uname' class='form-control' value='".$uname."' autofocus><br>
							<input name='pwd'  type='password' class='form-control' placeholder='fill in password here' autofocus><br>
							<input name='fname'  type='text' class='form-control' value='".$fname."'> <br>
							<input name='mname'  type='text' class='form-control' value='".$mname."'> <br>
							<input name='lname'  type='text' class='form-control' value='".$lname."'> <br>
							<input name='done' type='submit' class='btn btn-block bt-login' value='Update Record' />
							</form>
							<br/>			
						</div> </body>";
						$show=0;
					}
					else
					{
		?>
						<script type="text/javascript">
						alert( "Invalid Username");
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
			</script>	
	<?php	}
		}
		if($show)
		{
?>	
			<div class="container" >
			<div class="text-center" class="login-form">
				<form id="login-form" method="post" class="form-signin" role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>">
				<label class="text-center"><b>Enter Username:</b></label>
				<input class="text-center" type="text" name="uname" class="form-control" placeholder="Username" autofocus />
				<b><input type="submit" name="submit" value="Submit"/></b>
			</div>
		</div>
	</body>
	</html>
<?php
		}
	
?>

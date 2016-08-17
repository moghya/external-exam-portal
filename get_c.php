<?php
	require 'connect.inc.php';
	require 'core.inc.php';
	
	if(isloggedins() || isloggedint()|| !isloggedina())
	{
		header("Location:error.php");
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
		<li class="active"> Search</li>
		</ol>
	
	</body>
</html>	
	
<?php	
	
	if(isset($_POST['submit']))
	{
		$query = "select * from `sub` where ";
		
		if(isset($_POST['ccode']) && !empty($_POST['ccode']))
			$query=$query."`ccode` = '".$_POST['ccode']."' AND ";
		if(isset($_POST['cname']) && !empty($_POST['cname']))
			$query=$query."`cname` = '".$_POST['cname']."' AND ";
		if(isset($_POST['cred']) && !empty($_POST['cred']))
			$query=$query."`cred` = '".$_POST['cred']."' AND ";
		if(isset($_POST['yr']) && !empty($_POST['yr']))
			$query=$query."`yr` = '".$_POST['yr']."' AND ";
		if(isset($_POST['branch']) && !empty($_POST['branch']))
			$query=$query."`branch` = '".$_POST['branch']."' AND ";
		$arr=str_split($query,strlen($query)-4);
		$query=$arr[0];
		
		if($data=mysql_query($query))
		{
			if(mysql_num_rows($data) > 0)
			{
				echo '<div class="container" style="background-color:white;"> <table class="table" ></br>
						<thead>
						  <tr>
							<th>Course Code</th>
							<th>Course Name</th>
							<th>Credits</th>
							<th>Branch</th>
							<th>Year</th>
						  </tr>
						</thead>
						<tbody>';
				while($row = mysql_fetch_assoc($data))
				{	
					echo '
							<tr>
							<td>'.$row['ccode'].'</td>
							<td>'.$row['cname'].'</td>	
							<td>'.$row['cred'].'</td>		
							<td>'.$row['branch'].'</td>
							<td>'.$row['yr'].'</td>
							
							</tr>';
				}
				echo '</tbody> </table> </div>';
			}
			else
			{
				echo '<script type="text/javascript">
							alert("No results found");
					  </script>';
			}
		}
		else
		{
				echo '<script type="text/javascript">
							alert("An error occurred");
					  </script>';
		}
				
	}
	else
	{

?>

		
		<div class="container">
			<div class="login-form">

				<h2 class="text-center">Search</h2>
				<div class="form-header">

				</div>
				<form id="login-form" method="post" class="form-signin" role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>">
				<input type="text" name="ccode" class="form-control" placeholder="Course Code" autofocus><br>
				<input name="cname" id="password" type="text" class="form-control" placeholder="Course Name"> <br>
				<input name="cred" id="password" type="text" class="form-control" placeholder="Credits"> <br>
				<select name="branch" class="form-control" >
					<option value="">--SELECT BRANCH--</option>
					<option value="IT">IT</option>
					<option value="CSE">CSE</option>
					<option value="CV">CV</option
					<option value="ELN">ELN</option>
					<option value="ELE">ELE</option>
					<option value="MECH">MECH</option>
				</select> </br>
				<select name="yr" class="form-control" >
					<option value="">--SELECT YEAR--</option> 
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
				</select> </br>
				
				<input class="btn btn-block bt-login" name="submit" type="submit" value="Search Record">
				</form>
				<br/>

			</div>
		</div>
	</body>
	</html>

<?php
}
?>





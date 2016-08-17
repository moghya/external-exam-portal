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
		<li><a href="stu.php">Students</a></li>
		<li class="active">Search</li>
	</ol>
	
	</body>
</html>	
	
<?php	
	
	if(isset($_POST['submit']))
	{
		$query = "select * from `stud` where ";
		
		if(isset($_POST['prn']) && !empty($_POST['prn']))
			$query=$query."`prn` = '".$_POST['prn']."' AND ";
		if(isset($_POST['fname']) && !empty($_POST['fname']))
			$query=$query."`fname` = '".$_POST['fname']."' AND ";
		if(isset($_POST['mname']) && !empty($_POST['mname']))
			$query=$query."`mname` = '".$_POST['mname']."' AND ";
		if(isset($_POST['lname']) && !empty($_POST['lname']))
			$query=$query."`lname` = '".$_POST['lname']."' AND ";
		if(isset($_POST['yr']) && !empty($_POST['yr']))
			$query=$query."`yr` = '".$_POST['yr']."' AND ";
		if(isset($_POST['branch']) && !empty($_POST['branch']))
			$query=$query."`bran` = '".$_POST['branch']."' AND ";
		if(isset($_POST['batch']) && !empty($_POST['batch']))
			$query=$query."`batch` = '".$_POST['batch']."' AND ";
		$arr=str_split($query,strlen($query)-4);
		$query=$arr[0];
		if($data=mysql_query($query))
		{
			if(mysql_num_rows($data) > 0)
			{
				echo '<div class="container" style="background-color:white;"> </br>
						<table class="table">
						
						<thead>
						  <tr>
							<th>Student PRN</th>
							<th>Student Name</th>
							<th>Branch</th>
							<th>Year</th>
							<th>Batch</th>
						  </tr>
						 </thead>
						 <tbody>';
				while($row = mysql_fetch_assoc($data))
				{	
					echo '
							<tr>
							<td>'.$row['prn'].'</td>
							<td>'.$row['fname'].' '.$row['mname'].' '.$row['lname'].'</td>		
							<td>'.$row['bran'].'</td>
							<td>'.$row['yr'].'</td>
							<td>'.$row['batch'].'</td>	
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
				<input type="text" name="prn" class="form-control" placeholder="PRN" autofocus><br>
				<input name="fname" id="password" type="text" class="form-control" placeholder="First Name"> <br>
				<input name="mname" id="password" type="text" class="form-control" placeholder="Middle Name"> <br>
				<input name="lname" id="password" type="text" class="form-control" placeholder="Last Name"> <br>
				<select name="yr" class="form-control" >
					<option value="">--SELECT YEAR--</option> 
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
				</select> </br>
				<select name="branch" class="form-control" >
					<option value="">--SELECT BRANCH--</option>
					<option value="IT">IT</option>
					<option value="CSE">CSE</option>
					<option value="CV">CV</option
					<option value="ELN">ELN</option>
					<option value="ELE">ELE</option>
					<option value="MECH">MECH</option>
				</select> </br>
				<select name="batch" class="form-control" >
					<option value="">--SELECT BATCH--</option>
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
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





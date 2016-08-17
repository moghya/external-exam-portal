<?php

	require 'connect.inc.php';
	require 'core.inc.php';
	
	if(!isloggedint()||isloggedins())
	{  
		header('Location: error.php');
	}
	else
	{
		
		if(isset($_GET['qid'])&&isset($_POST['inst']))
		{
			$inst = $_POST['inst'];
			$file = 'inst/inst_'.$_GET['qid'].'.txt';
			
			$fobj = fopen($file,'w');
			fwrite($fobj,$inst);
			fclose($fobj);
			header("Location: alott.php?qid=".$_GET['qid']);
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
  
table, th, td {
				border: 1px solid black;
				border-collapse: collapse;
			}
			th, td {
				padding: 15px;
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
			<li><a href='myprofilet.php'>My Profile</a></li>
			<li><a href='cpwdt.php'>Change Password</a></li>
			<li class="active"><a href='quizes.php'>Quizes</a> </li>
			<li><a href='creq.php'>Add Quiz</a></li>
			<li><a href='logout.php'>Logout</a></li>
		</ul>
	</div>
</nav>

<center><h4>Quiz Added Successfully</h4></center>
<div class="container">
<?php

		if(isset($_GET['qid']))
		{
			echo 
			'
			<center><form action="cinst.php?qid='.$_GET['qid'].'" method="post">
			<h4>Add Instructions</h4>
			<textarea rows="20" cols="150" name="inst" required>
			</textarea><br><br>
			<input type="submit" name="submit" value="Add Instructions"/>
			</form>	</center>		
			';
		}
	}
?>
</div>
</body>
</html>
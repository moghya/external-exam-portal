<?php
	require 'connect.inc.php';
	require 'core.inc.php';	

	if(!isloggedins()||isloggedint())
	{  
		header('Location: error.php');
	}
	else
	{
?>		<html>

		<head>
        <link href='http://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
        <link href="bootstrap.min.css" rel="stylesheet">
        <link href="font-awesome.min.css" rel="stylesheet">
        <link href="login.css" rel="stylesheet">
        <link href="login.css" rel="stylesheet">
        </head>


			<style>
  	 			#naam {
                   		 border-right: 1px solid gray;
                   		 padding-right: 4px;
                   	  }

		.btn-block{
			width: 50%;
  	 			  }
  	    #naam {
               		 border-right: 1px solid gray;
               		 padding-right: 4px;
              }
		label
		{
			margin-bottom: .5rem;
			font-family: serif;
			
			font-size: 18px;
			line-height: 1.1;
			color: black;
		}
		span
		{
			font-family: serif;
			font-size: 18px;
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
		<li><a href='myprofile.php'>My Profile</a></li>
        <li class="active"><a href="myquizes.php">My Quizes</a> </li>
		<li><a href='cpwd.php'>Change Password</a></li>
		<li><a href='logout.php'>Logout</a></li>
		</ul>
	</div>
</nav>
<body>

<div class="container">
<div class = "row">
<?php		
	
		$query = "SELECT b.dt,b.durn,b.id,a.ccode ,a.cname, a.cred ,c.done From `sub` a , `quiz` b ,`qstn` c WHERE a.yr =".$_SESSION['syr']." and a.branch ='".$_SESSION['sbran']."' and a.ccode = b.ccode and b.id = c.qid and c.sid=".$_SESSION['id'];
		
		if($query_run = mysql_query($query))
		{
			if(mysql_num_rows($query_run)>0)
			{
				while($array = mysql_fetch_assoc($query_run))
				{
					
					echo 
					'<div class = "col-sm-6 col-md-4"><div class="thumbnail img-thumbnail"	style="background-color:rgba(255, 255, 255, .8);  max-width: 80%;">';
					if($array['done']==1) echo "<label class='label label-success' style='font-size: 100%;'>Quiz Attempted</label><br><br>"; 
					else echo "<label class='label label-danger' style='font-size: 100%;' >Quiz Not Attempted</label><br><br>";
					echo'
					<label>Quiz Id:</label><span>'.$array['id'].
					'</span><br><label>Added on:</label>'.$array['dt'].
					'<br>
					<label>Course:</label><span>'.$array['cname'].
					'</span><br>
					<label>Credits:</label><span>'.$array['cred'].
					'</span>
					<label>Duration:</label><span>'.$array['durn'].
					' mins</span><br>
					';
					
					
					if($array['done']==0)
					echo'<center><a href="inst.php?qid='.$array['id'].'"><button class="btn btn-success" type="submit">Take Quiz</button></a></center>';
					else
					echo '<center><button class="btn btn-info" type="submit">Attempted</button></center>';
					
					echo '
					</div>
					</div>
					';
				}				
			
			}	
			else
			{
				echo '<script type="text/javascript">
                    alert("No Quizes Yet");
                    </script>';
			}
			
		}
		else
		{
			
		}

?>
</div>
</div>
</body>


		</html>
		
<?php
	}
	
?>		

<?php
	require 'connect.inc.php';
	require 'core.inc.php';
	
	if(!isloggedint()||isloggedins())
	{  
		header('Location: error.php');
	}
	else
	{
		
		if(isset($_POST['c'])&&isset($_POST['field_name'])&&isset($_POST['durn']))
		{
			$ccode = $_POST['c']; 
			$fva = $_POST['field_name'];	
			$durn = $_POST['durn'];
			
			if(!empty($ccode)&&!empty($durn))
			{
				
				$query = "INSERT INTO `quiz` (`id`,`ccode`,`tid`,`durn`) VALUES ('','".$ccode."','".$_SESSION['id']."',".$durn.")";
				if($query_run = mysql_query($query))
				{
					$sval = "SELECT * FROM `vals` WHERE `var`='idq'";
					$val = 0;
					if($sval_run = mysql_query($sval))
					{	$arr = mysql_fetch_array($sval_run);
						$val = $arr['val'];
					}
					else
						msg("errorrrr aya");
					
					$countis = $val;
					$val=$val+1;
					$upval = "UPDATE `vals` SET `val`= ".$val." where `var`='idq'";
					if($upval_run=mysql_query($upval))
					{}
					else
						msg("error aya.");
									
					
					
						
						$f=1;
						$file = 'quiz/quiz_'.$countis.'.txt';
						$fobj = fopen($file,'w');
					 
						foreach($fva as $value)
						{
							$value = $value."\n";
							
							fwrite($fobj,$value);
						}
						fclose($fobj);
					 
						
						header("Location: cinst.php?qid=".$countis);
		
				}	
				else
				{
					msg("sorry an error ocurred.");
				   	  
				}	
			
			}
			else
			{
					msg("Fill in all fields.");
				   	  
			}	
		
		}
		else
		{
			
		}	
?>
<html>
<head>
		<link href='http://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
		<link href="bootstrap.min.css" rel="stylesheet">
		<link href="font-awesome.min.css" rel="stylesheet">
		<link href="login.css" rel="stylesheet">
		
<script src="jquery.js"></script>
	<script type="text/javascript">
	$(document).ready(function(){
		var maxField = 50; 
		var addButton = $('.add_button'); 
		var wrapper = $('.field_wrapper'); 
		var fieldHTML = '<div><input type="text" name="field_name[]" value="" class="form-control q " placeholder="Question" required autofocus/><a href="javascript:void(0);" class="remove_button" title="Remove field"><img src="remove-icon.png" alt="remove"/></a></div>';//</div>'; 
		var x = 1; 
		$(addButton).click(function(){ 
			if(x < maxField){ 
				x++; 
				$(wrapper).append(fieldHTML); 
			}
		});
		$(wrapper).on('click', '.remove_button', function(e){
			e.preventDefault();
			$(this).parent('div').remove();
			x--; 
		});
	});
	</script>

	 <style>
	#naam
	{
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
	.q
	{
		width: 90%;
		border: 0.5px solid black;
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
			<li ><a href='myprofilet.php'>My Profile</a></li>
			<li><a href='cpwdt.php'>Change Password</a></li>
			<li><a href='quizes.php'>Quizes</a> </li>
			<li class="active"><a href='creq.php'>Add Quiz</a></li>
			<li><a href='logout.php'>Logout</a></li>
		</ul>
	</div>
</nav>

<br>
<div class="container" style="background-color:rgba(255, 255, 255, .8);">


<div class="login-form" style="width: 1000px;">
			
			<h2 class="text-center">Create Quiz</h2>
			<div class="form-header">
				
			</div>
<form id="login-form" action="creq.php" method="post">

	<?php
	
		$query = "SELECT * FROM `trsub` WHERE `tid` = '".$_SESSION['id']."'";
		
		if($query_run = mysql_query($query))
		{
			echo '<br><label>Course:</label>
			<select style="border: 0.5px solid black;"name ="c" class="form-control" required autofocus>
			<option value="">--SELECT--</option>';
		
			while( $sid  = mysql_fetch_assoc($query_run))
			{
				$sub = $sid['sid'];
				
				$selectsub = "SELECT * FROM `sub` WHERE `id`= '".$sub."'";
				
				if($subrun = mysql_query($selectsub))					
				{
					$subname = mysql_fetch_assoc($subrun);
					
					echo '<option value= "'.$subname['ccode'].'">'.$subname['ccode'].' '.$subname['cname'].'</option>';
				}
				else
				{
					msg("Sorry an error occurred");
				   	 
				}
			}
			echo '</select><br><label>Duration(mins):</label><input type="text" name="durn" class="form-control" style="border: 0.5px solid black;" required autofocus/><br>';
		}
		else
		{
				msg("Sorry an error occurred");
				   	  
		}
	
	?>
	<label>Questions:</label><br>
	<div class="field_wrapper">
		<div>
			<input type="text" name="field_name[]" value=""  class="form-control q " placeholder="Question" required />
		</div>		
	</div>
	<br>
	<a href="javascript:void(0);" class="add_button" title="Add field"><button class="btn btn-success">Add</button></a><br><br>
	<center><button class="btn  bt-login" type="submit">Create Quiz</button></center>
	</div>
</form>
</div>
</body>
</html>
<?php


}
?>

<?php

    require 'connect.inc.php';
	require 'core.inc.php';

	if(!isloggedint()||isloggedins())
	{  
		header('Location: error.php');
	}
	else
	{
		
		if(isset($_GET['qid']))
		{
			$query = "SELECT * FROM `quiz` WHERE `id`=".$_GET['qid']." AND `tid`=".$_SESSION['id'];
			if($query_run = mysql_query($query))
			{		
				$rows = mysql_num_rows($query_run);
				if($rows ==1)
				{
					$file = 'quiz_'.$_GET['qid'].'.txt';
					if(file_exists('quiz/'.$file)&&filesize('quiz/'.$file)>0)
					{
						
						if(isset($_POST['up'])&&isset($_POST['field_name']))
						{
							$fva = $_POST['field_name'];
							$fobj = fopen('quiz/'.$file,'w');
							foreach($fva as $value)
							{
                                $value = $value."\n";
                                
                                fwrite($fobj,$value);
							}
                            fclose($fobj);
							echo '<script type="text/javascript">
				            alert("Quiz Updated");
				            </script>';				
							
						}
						else
						{
							
						}							
?>
<html>
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
			
			<h2 class="text-center">Update Quiz</h2>
			<div class="form-header">
				
			</div>
<form id="login-form"  action= <?php echo "upquiz.php?qid=".$_GET['qid']; ?> method="POST">
<br>
<label>Questions</label>
<div class="field_wrapper">
<?php
		$fobj = fopen('quiz/'.$file,'r');
		$ques = array();
		$lenoffile = filesize('quiz/'.$file);
		while($text = fgets($fobj))
		{
			array_push($ques,$text);
		}
		fclose($fobj);
		
		echo '
		<div>
			<input type="text" name="field_name[]" value="'.$ques[0].'" class="form-control q" placeholder="Question" required />
		</div><br>	';	
		

		
		for ($i=1;$i< count($ques);$i++)
		{						
			echo '<div><input type="text" name="field_name[]" value="'.$ques[$i].'" class="form-control q" placeholder="Question" required autofocus/><a href="javascript:void(0);" class="remove_button" title="Remove field"><img src="remove-icon.png"/></a></div>';
			
			
		}
?>	</div> 
	<br>
	<a href="javascript:void(0);" class="add_button" title="Add field"><button class="btn btn-success">Add</button></a><br><br>
	<center><input class="btn btn-success" type="submit" name="up" value="Update Quiz"/></center>
	</form>
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
				}
				else
				{
					msg("you are not allowed to edit this quiz");
				    
				}	
			}
			else
			{
				msg("Sorry An error occured");
				
			}
		}	
		else
		{
			header('Location: error.php');
		}	
	}	
?>	

<?php

	require 'connect.inc.php';
	require 'core.inc.php';

?>
<html>

<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="popo/css/bootstrap.min.css">
<script src="popo/jquery.min.js"></script>
<script src="popo/css/bootstrap.min.js"></script>
<link href='http://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
<link href="bootstrap.min.css" rel="stylesheet">
<link href="font-awesome.min.css" rel="stylesheet">
<link href="login.css" rel="stylesheet">

</head>
  <style>
  .carousel-inner > .item > img,
  .carousel-inner > .item > a > img {
      width: 70%;
      margin: auto;
  }

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
		<?php
			if(!isloggedint()&&!isloggedins()&&!isloggedina())
			{	echo 
				'<li  class="active"><a href="#">Home</a></li>';
				echo
				"<li ><a href='logins.php'>Student's Login</a></li>
				<li ><a href='logint.php'>Teacher's Login</a></li>
				<li ><a href='logina.php'>Admin's Login</a></li>
				";
			}
			if(isloggedins())
			{			
				echo "<li id='naam'>".$_SESSION['fname']."<br>".$_SESSION['lname']."</li>";
?>
				<li class="active"><a href='home.php'>Home</a></li>
				<li><a href='myprofile.php'>My Profile</a></li>
				<li><a href="myquizes.php">My Quizes</a> </li>
				<li><a href='cpwd.php'>Change Password</a></li>
				<li><a href='logout.php'>Logout</a></li>
<?php
			}
			if(isloggedint())
			{
				echo "<li id='naam'>".$_SESSION['fname']."<br>".$_SESSION['lname']."</li>";
?>
				<li class="active"><a href='home.php'>Home</a></li>
				<li><a href='myprofilet.php'>My Profile</a></li>
				<li><a href='cpwdt.php'>Change Password</a></li>
				<li><a href='quizes.php'>Quizes</a> </li>
				<li><a href='creq.php'>Add Quiz</a></li>
				<li><a href='logout.php'>Logout</a></li>
<?php
			}
			if(isloggedina())
			{
				echo "<li id='naam'>".$_SESSION['fname']."<br>".$_SESSION['lname']."</li>";
?>
      			<li class="active"><a href='home.php'>Home</a></li>
				<li><a href='myprofilea.php'>My Profile</a></li>
				<li ><a <?php if(isalert()){?> style="color:red;" <?php } ?> href='do.php'>Update</a> </li>
				<li><a href='cpwda.php'>Change Password</a></li>
				<li><a href='logout.php'>Logout</a></li>
<?php
			}
?>

		</ul>
	</div>
</nav>


<div class="container">
  
  <div id="myCarousel" class="carousel slide " data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner"   role="listbox">    
      
	  <div class="item active ">
        <img src="img/3.jpg" class="img-thumbnail" style="border:1px solid black;"alt="Three" width="460" height="345">
      </div>
	  
    </div>


  </div>
<center> <h1 style="color: black; font-family:serif;">WELCOME TO ONLINE EXTERNAL EXAMINATION PORTAL</h1></center>

</div>


</body>


</html>

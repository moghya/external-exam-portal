<!DOCTYPE html>
<html lang="en">
<head>
</head>

<body>

	<div class="container content">
	<h2><span id="timer"></span></h2>
	</div>

	<script src="jquery.min.js"></script>
	<script src="bootstrap.min.js"></script>
	<script>
	$(document).ready(function()
	{
		var c = <?php ?>;
		var t;
		timedCount();
		function timedCount() 
		{
			var hours = parseInt( c / 3600 ) % 24;
			var minutes = parseInt( c / 60 ) % 60;
			var seconds = c % 60;
			var result = (hours < 10 ? "0" + hours : hours) + ":" + (minutes < 10 ? "0" + minutes : minutes) + ":" + (seconds  < 10 ? "0" + seconds : seconds);
			$('#timer').html(result);
			if(c == 0 )
			{ 
				alert("Quiz Ended, No Submissions will be accepted.");
			}
			else
			{
				c = c - 1;
				t = setTimeout(function(){ timedCount() }, 1000);
			}
		}
	});
	</script>
</body>
</html>

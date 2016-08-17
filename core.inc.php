<?php

	session_start();
	
	function isloggedint()
	{
		if(isset($_SESSION['id'])&&$_SESSION['r']==="t")
			return true;		
		
		return false;
	}

	function isloggedins()
	{
		if(isset($_SESSION['id'])&&$_SESSION['r']==="s")
			return true;		
		
		return false;
	}
	
	function isloggedina()
	{
		if(isset($_SESSION['id'])&&$_SESSION['r']==="a")
			return true;		
		
		return false;
	}
	
	function msg($str)
	{
		echo 
		'
		<script type="text/javascript">
		alert("'.$str.'");
		</script>		
		';
	}
	
	function isalert()
	{
		$query="SELECT * FROM `sub` WHERE `alert` = '1'";
		if($data=mysql_query($query))
		{
			if(mysql_num_rows($data)>0)
				return 1;
				
			else
				return 0;
			
		}
		else
			echo "An error occurred"; 
		
	}

?>

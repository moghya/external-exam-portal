<?php
	if(file_exists("popo"))
	{
		if(unlink("popo"))
		echo "oyee delte huyi be.";
		else
		echo "oyee delte nahi huyi be.";
	}
	else
	{
		echo "oyee nahi hai be.";
	}

?>
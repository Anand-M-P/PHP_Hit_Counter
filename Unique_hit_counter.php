<?php

/*
This is a unique php hit counter.
The hit count is maintained in a file count.txt.
The IP of the user is checked for verifying the identity.
If not already present in the ip.txt file, the ip is added to the file and
the hit counter is incremented. Updated counter value is written back to file.
*/

function hit_count()
{
	$ip_address=$_SERVER['REMOTE_ADDR'];
	$ip_file = file('ip.txt');;
	foreach ($ip_file as $ip) 
	{
		# code...
		$ip_single= trim($ip);
		if($ip_address==$ip_single)
		{
			$found=true;
			break;
		}
		else
		{
			 $found=false;
		}
	}
	if($found==false)
	{
		$filename='count.txt';
		$handle=fopen($filename, 'r');
		$current = fread($handle, filesize($filename));
		fclose($handle);

		$current_inc = $current +1;

		$handle= fopen($filename, 'w');
		fwrite($handle, $current_inc);
		fclose($handle);

		$handle=fopen('ip.txt', 'a');
		fwrite($handle, $ip_address."\n");
		fclose($handle);
	}
}

?>
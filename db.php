<?php>
	/*
		Copyright: http://josephrogina.com - 2012
		This is for connecting to a mySQL database.
			Use: 'require(db.php);' to call.
	*/

	// set server access variables
		$host = "database host name";
		$user = "database user";
		$pass = "database password";
		$db = "database name";

		// open connection
		$connection = mysql_connect($host, $user, $pass) or die ("Unable to connect!");

		// select database
		mysql_select_db($db) or die ("Unable to select database!");

?>

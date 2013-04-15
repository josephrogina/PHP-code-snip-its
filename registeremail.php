<?php
	/*
		Copyright http://josephrogina.com - 2012
		This will pull in information from a form,
		and save the data to a database. In this case,
		it gathers emails.
		- This example does not include the html form.
	*/
	$fName = $_POST['fName'];
	$lName = $_POST['lName'];
	$fullname = $_POST['fName'] . ' ' . $_POST['lName'];
	$pNumber = $_POST['pNumber'];
	$myEmail = $_POST['myEmail'];
	$myComments = $_POST['myComments'];

	/*
		set server access variables
		open connection
		select database
	*/
	require('db.php');

	$dbc = mysqli_connect($hostname, $username, $password, $dbname)
	or die('Error connecting to MySQL server.');

	$query = "INSERT INTO emails (fName, lName, pNumber, myEmail, myComments) VALUES ('$fName', '$lName', '$pNumber', '$myEmail', '$myComments')";

	$result = mysqli_query($dbc, $query)
	or die('Error querying database.');

	mysqli_close($dbc);

	$subject = "New site registration" ;
	$message = "$fullname has registered on the site.\n" .
	"Contact number: $pNumber.\n" .
	"$myComments";

	mail("joseph@josephrogina.com", $subject, $message, "From:" . $myEmail);
	echo "Thank you for your request, $fullname.";
?>
<!-- Recommend a redirect for after registration. -->
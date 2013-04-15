<?php

// start session. See if user is logged in.
session_start();
if (!$_SESSION['auth'] == 1) {
    // check if authentication was performed
    // else die with error
    die ("ERROR: Unauthorized access!");

    //Refresh so the user can login.
    //Be sure to edit the url bellow.
	?>
	<meta http-equiv="REFRESH" content="2;url=./loginerror.php">
	<?php
}
else {
	?>

	<!-- This was the header area, and start of the body code. -->

	<?php
	/*
		Copyright: http://josephrogina.com - 2012
		This is for changing a users password. The
		user must already be logged in to the site
		for the page to load.
	*/

	// define variables here.
	if (!isset($_POST['submit'])) {
		// form not submitted
		?>

		<div class="btn_grp">
			<div style="width:250px; margin: 0 auto;">
				<form action="<?=$_SERVER['PHP_SELF']?>" method="post" autocomplete="off">
					<div class="rate_item ui-widget"><label for="pass1">New password:</label> <input type="password" name="pass1" id="pass1" class="login" autocomplete="off" autocorrect="off" autocapitalize="off" /></div>
					<div class="rate_item"><label for="pass2">Confirm:</label> <input type="password" name="pass2" id="pass2" class="login" autocomplete="off" autocorrect="off" autocapitalize="off" /></div>
					<input type="submit" name="submit" class="orange_button" />
				</form>
			</div>
		</div>
		<?php
	}
	else {
		// form submitted

		/*  set server access variables
			open connection
			select database
		*/
		require('db.php');

		// get form input
		// check to make sure its all there
		// escape input values for greater safety

		$pass1 = mysql_escape_string($_POST['pass1']);
		$pass2 = mysql_escape_string($_POST['pass2']);

		// open connection
		$connection = mysql_connect($host, $user, $pass) or die ("Unable to connect!");

		// select database
		mysql_select_db($db) or die ("Unable to select database!");

		// Check for blank fields
		if ($_POST['pass1'] == '' || $_POST['pass2'] == '') {
			echo "You must fill in both fields.";
			?>
			<meta http-equiv="REFRESH" content="2;url=./passchange.php">
			<?php
		}
		if ($_POST['pass1'] != $_POST['pass2']) {
			echo "Passwords do not match.";
			?>
			<meta http-equiv="REFRESH" content="2;url=./passchange.php">
			<?php
		}
		else {
			// create query
			$uname = $_COOKIE["username"];
			//This example uses SHA1 for simplicity, but a more secure method is recommended.
			$password = SHA1($_POST['pass1']);
			$query = "UPDATE users SET pass = '$password' WHERE name='$uname'";
			$result = mysql_query($query) or die ("Error in query: $query. ".mysql_error());
		}
		echo "You have changed your password.";
		//Edit url bellow to refresh to the desired page.
		?>
			<meta http-equiv="REFRESH" content="2;url=./welcome.php">
		</div>
		<?php
	}
}
?>

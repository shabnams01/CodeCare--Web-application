<?php
/* ------------------------------------------------------- */
/*  Author : Shabnam Suresh                                */
/*  Website: http://projects.thecdm.ca/codecare/index.html */
/* ------------------------------------------------------- */

$user = json_decode(file_get_contents('php://input')); //to get user details from json headers

if($user->name && $user->pass) {

	/* database connection details*/
	$db_name     = 'codecare';
	$db_user     = 'codecare';
	$db_password = 'eTH@#R';
	$server_url  = 'localhost';


	$mysqli = new mysqli('localhost', $db_user, $db_password, $db_name);

	/* check connection */
	if (mysqli_connect_errno()) {

		print 'Connection Failure';

	} else
	{
		if ($stmt = $mysqli->prepare("SELECT username FROM users WHERE username = ? and password = ?")) {

			/* bind parameters for markers */
			$stmt->bind_param("ss", $user->name, $user->pass);

			/* execute query */
			$stmt->execute();

			/* bind result variables */
			$stmt->bind_result($id);

			/* fetch value */
			$stmt->fetch();

			/* close statement */
			$stmt->close();
		}

		/* close connection */
		$mysqli->close();

		if ($id) {
			print 'success';
		} else {
			print 'Invalid Username/Password';
		}
	}
} else {
	print 'Invalid data';
}

?>

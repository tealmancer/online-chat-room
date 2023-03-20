<?php

//update_last_activity.php

include('includes/dbh.inc.php');

session_start();

$query = "
UPDATE login_details 
SET last_activity = now() 
WHERE login_details_id = '".$_SESSION["login_details_id"]."'
";

$stmt = mysqli_stmt_init($conn);
	if(!mysqli_stmt_prepare($stmt, $query)){
		header("Location: ../index.php?error=sqlerror");
		exit();
	}
	else{
	    mysqli_stmt_execute($stmt);
	}

?>
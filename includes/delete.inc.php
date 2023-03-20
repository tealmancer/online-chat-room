<?php

session_start();
require 'dbh.inc.php';
if(isset($_SESSION['userId'])){
     $id = $_SESSION['userId'];
     $sql = "DELETE FROM chat_message WHERE from_user_id=?";
    $stmt = mysqli_stmt_init($conn);
	if(!mysqli_stmt_prepare($stmt, $sql)){
		header("Location: ../index.php?error=sqlerror");
		exit();
	}
	else{
        mysqli_stmt_bind_param($stmt,"s", $id);
        mysqli_stmt_execute($stmt);
        $ssql = "DELETE FROM users WHERE idUsers=?";
        $sstmt = mysqli_stmt_init($conn);
	    if(!mysqli_stmt_prepare($sstmt, $ssql)){
		    header("Location: ../index.php?error=sqlerror");
		    exit();
	    }
	    else{
            mysqli_stmt_bind_param($sstmt,"s", $id);
            mysqli_stmt_execute($sstmt);
            session_unset();
            session_destroy();
            header("Location: ../login.php?signup=revoked");
            exit();
        }
    }


    
     
     
}
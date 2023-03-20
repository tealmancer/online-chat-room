<?php

$servername = "localhost";
$dBUsername = "root";
$dBPassword = "";
$dBName = "chatsite";

$conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);
$connect = new PDO("mysql:host=localhost;dbname=chatsite", "root", "");

if(!$conn){
    die("Connection Failed:" .mysqli_connect_error());
}

date_default_timezone_set('Europe/Skopje');

function fetch_user_last_activity($user_id, $conn)
{
 $query = "
 SELECT * FROM login_details 
 WHERE user_id = '$user_id' 
 ORDER BY last_activity DESC 
 LIMIT 1
 ";
 $stmt = mysqli_stmt_init($conn);
	if(!mysqli_stmt_prepare($stmt, $query)){
		header("Location: ../index.php?error=sqlerror");
		exit();
	}
	else{
	    mysqli_stmt_execute($stmt);
    }
    
    $result = mysqli_stmt_get_result($stmt);
    if($row = mysqli_fetch_assoc($result)){
        return $row['last_activity'];
    }
}

function fetch_user_chat_history($from_user_id, $to_user_id, $connect)
{
 $query = "SELECT * FROM chat_message 
 WHERE (from_user_id = '".$from_user_id."' 
 AND to_user_id = '".$to_user_id."') 
 OR (from_user_id = '".$to_user_id."' 
 AND to_user_id = '".$from_user_id."') 
 ORDER BY timestamp DESC
 ";
 $statement = $connect->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 $output = '<ul class="list-unstyled">';
 foreach($result as $row)
 {
  $user_name = '';
  if($row["from_user_id"] == $from_user_id)
  {
   $user_name = '<b class="text-success">You</b>';
  }
  else
  {
   $user_name = '<b class="text-danger">'.get_user_name($row['from_user_id'], $connect).'</b>';
  }
  $output .= '
  <li style="border-bottom:1px dotted #ccc">
   <p>'.$user_name.' - '.$row["chat_message"].'
    <div align="right">
     - <small><em>'.$row['timestamp'].'</em></small>
    </div>
   </p>
  </li>
  ';
 }
 $output .= '</ul>';
 return $output;
}
    
 


function get_user_name($user_id, $connect)
{
    $query = "SELECT uidUsers FROM users WHERE idUsers = '$user_id'";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    foreach($result as $row)
    {
     return $row['uidUsers'];
    }
    
}

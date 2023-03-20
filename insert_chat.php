<?php
include('includes/dbh.inc.php');

session_start();


$data = array(
	':to_user_id'  => $_POST['to_user_id'],
	':from_user_id'  => $_SESSION['userId'],
	':chat_message'  => nl2br($_POST['chat_message']),
	':status'   => '1'
   );


   $query = "INSERT INTO chat_message (to_user_id, from_user_id, chat_message, status) VALUES (:to_user_id, :from_user_id, :chat_message, :status)";


$statement = $connect->prepare($query);

if($statement->execute($data))
{
 echo fetch_user_chat_history($_SESSION['userId'], $_POST['to_user_id'], $connect);
}
<?php

//fetch_user.php

include('includes/dbh.inc.php');

session_start();
if(isset($_SESSION['userId'])){
    $query = "
    SELECT * FROM users 
    WHERE idUsers != '".$_SESSION['userId']."' 
    ";
}
else{
    $query = "
    SELECT * FROM users";
}


$stmt = mysqli_stmt_init($conn);
if(!mysqli_stmt_prepare($stmt, $query)){
    header("Location: index.php?error=sqlerror");
    exit();
}
else{
mysqli_stmt_execute($stmt);
}
$result = mysqli_stmt_get_result($stmt);

$output = '
<table class="table table-bordered table-striped">
 <tr>
  <td>Username</td>
  <td>Status</td>
  <td>Action</td>
 </tr>
';

foreach($result as $row)
{
 
 $status = '';
 
 $current_timestamp = strtotime(date("Y-m-d H:i:s") . '- 10 second');
 $current_timestamp = date('Y-m-d H:i:s', $current_timestamp);
 
 
 $user_last_activity = fetch_user_last_activity($row['idUsers'], $conn);
 
 
 if($user_last_activity > $current_timestamp)
 {
  $status = '<span class="label label-success">Online</span>';
 }
 else
 {
  $status = '<span class="label label-danger">Offline</span>';
 }

 $output .= '
 <tr>
  <td>'.$row['uidUsers'].'</td>
  <td>'.$status.'</td>
  <td><button type="button" class="btn btn-info btn-xs 
  start_chat" data-touserid="'.$row['idUsers'].'" 
  data-tousername="'.$row['uidUsers'].'">Start 
  Chat</button></td>
 </tr>
 ';
}

$output .= '</table>';

echo $output;

?>
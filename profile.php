<?php
 include('includes/dbh.inc.php');
 require 'header.php';
 session_start();
 if(!isset($_SESSION['userId'])){
    header("Location: ./login.php?error=loginfirst");
 }
?>
<!DOCTYPE html>
<html>
<head>
 <meta content='text/html; charset=UTF-8' http-equiv='Content-Type'/>
 <link rel="stylesheet" type="text/css" href="style.css" />
 <title>7topics - Login Demo</title>
</head>
<body>


<div id="contentbox">
<?php
$sql="SELECT * FROM users where idUsers ='".$_SESSION['userId']."'";
$stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("Location: ../index.php?error=sqlerror");
        exit();
    }
    else{
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
    }
?>
<?php
while($row=mysqli_fetch_array($result)){
?>


<div>Your Profile</div>
<table class = "proft">
<tr>
    <td>Reg id:</td>
    <td><?php echo $row['idUsers']; ?></td>
</tr>
<tr>
    <td>Username:</td>
    <td><?php echo $row['uidUsers']; ?></td>
</tr>
<tr>
    <td>Email:</td>
    <td><?php echo $row['emailUsers']; ?></td>
</tr>
</table>


<div><a href="includes/logout.inc.php">Sign Out</a></div>
<div><a href="includes/delete.inc.php">Delete Account</a></div>

<?php 
// close while loop 
}
?>
</div>
</br>

</body>
</html>
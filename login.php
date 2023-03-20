<?php
    require "header.php";
?>

<head>
  <meta charset = "utf-8">
  <meta name = "description" content="example of meta description">
  <meta name = viewport content="width=device-width, initial-scale=1">
  <title></title>
  <link rel="stylesheet" href="resetstyle.css">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>

<main>
<div class = "main-content">

<p class = "login-status">Welcome! Please Login or Signup to begin</p>
<?php
if(isset($_GET['error'])){
  if($_GET['error'] == "loginfirst"){
    echo 'You have to login first!';
  }
  else if($_GET['error']== "nouser"){
    echo 'That user does not exist!';
  }
  else if($_GET['error']== "emptyfields"){
    echo 'Cannot login as Nobody.';
  }
  else if($_GET['error']== "wrongpwd"){
    echo 'Wrong password, please try again';
  }
  

}
if(isset($_GET['signup'])){
  if($_GET['signup'] == "success"){
    echo 'Success! You may now login...';
  }
  if($_GET['signup'] == "revoked"){
    echo 'User and messages successfully erased.';
  }
  if($_GET['signup'] == "noteven"){
    echo 'You need to log in first!';
  }
}
?>
<div class = "container">
<br />
<br />
<div class="table-responsive">
    <h4 align="center">Users</h4>
    
    <div id="user_detailss"></div>

</div>
</div>
</div>
</main>

<script>  
$(document).ready(function(){

 fetch_user();

 setInterval(function(){
  update_last_activity();
  fetch_user();
 }, 5000);

 function fetch_user()
 {
  $.ajax({
   url:"fetch_user.php",
   method:"POST",
   success:function(data){
    $('#user_detailss').html(data);
   }
  })
 }

 function update_last_activity()
 {
  $.ajax({
   url:"update_last_activity.php",
   success:function()
   {

   }
  })
 }
});  
</script>
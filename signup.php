<?php
    require "header.php";
?>


<main>
  <div class = "wrapper-main">
    <section class = "section-default">
    <h1>Signup</h1>
    <?php
      if(isset($_GET['error'])){
        if($_GET['error'] == "emptyfields"){
          echo '<p>Fill in all fields!!!</p>';
        }
        else if($_GET['error'] == "ivaliduidmail"){
          echo'<p>Invalid username and E-mail!</p>';
        }
        else if($_GET['error'] == "ivaliduid"){
          echo'<p>Invalid username!</p>';
        }
        else if($_GET['error'] == "ivalidmail"){
          echo'<p>Invalid E-mail!</p>';
        }
        else if($_GET['error'] == "passwordcheck"){
          echo'<p>Passwords do not match!</p>';
        }
        else if($_GET['error'] == "usertaken"){
          echo'<p>Username is already taken!</p>';
        }
      }

    ?>
    <form class=" signup "action = "includes/signup.inc.php" method = "post">
         <input type ="text" name="uid" placeholder = "Username">
         <br>
         <input type ="text" name="mail" placeholder = "E-Mail">
         <br>
         <input type ="password" name="pwd" placeholder = "Password">
         <br>
         <input type ="password" name="pwd-repeat" placeholder = "Repeat password">
         <br>
         <button type="submit" name = "signup-submit">Signup</button>
    </form>
      <?php
        if (isset($_GET["newpwd"])){
          if($_GET["newpwd"] == "passwordupdated"){
            echo '<p>Your password has been reset!</p>';
          }
        }
      ?>
    <a href = "reset-password.php">Forgot your password?</a>
    
    </section>
  </div>
</main>


<?php
    require "footer.php";
?>
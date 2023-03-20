<?php
if(!isset($_SESSION)){
    session_start();
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset = "utf-8">
        <meta name = "description" content="example of meta description">
        <meta name = viewport content="width=device-width, initial-scale=1">
        <title></title>
        <link rel="stylesheet" href="resetstyle.css">
        <link rel="stylesheet" href="style.css">
        
    </head>

    <body>

        <header>
        
            <nav class = "nav-header-main">
                <div class = "options-menu">
                    <div class="option-toggle-button" onclick = "toggleNav()"></div>
                </div>
                <ul class = "headermenu">
                    <li><a href="index.php">Home</a>
                </ul>
                <div class = "header-form">
                <?php
                    if (isset($_SESSION['userId'])){
                      echo '<form action="includes/logout.inc.php" method="post">
                      <button type="submit" name="logout-submit">Logout</button>
                            </form>';
                    }
                    else{
                      echo ' <form action="includes/login.inc.php" method="post">
                      <input type="text" name="mailuid" placeholder="Username/Email">
                      <input type="password" name="pwd" placeholder="Password">
                      <button type="submit" name="login-submit">Login</button>
                      <br><a href="signup.php">Signup</a>
                             </form>';
                    }

                ?>
                   
                    
                </div>
            </nav>
        </header>

        <aside class = "nav-sidebar">
            <ul>
                <li><span>Projects</span>
                <li><a href="profile.php">Profile</a>
            </ul>
        </aside>

    </body>
    <script src="sj.js"></script>
</html>
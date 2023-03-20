<?php

require_once ('PHPMailer-5.2-stable/PHPMailerAutoload.php');
$mail = new PHPMailer();
$mail->isSMTP();
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'ssl';
$mail->Host = 'smtp.gmail.com';
$mail->Port = '465';
$mail->isHTML();
$mail->Username = 'EMAILHERE';
$mail->Password = 'EMAILPASSWORDHERE';
$mail->SetFrom = ("noreply@gmail.com");




if(isset($_POST["reset-request-submit"])){

    $selector = bin2hex(random_bytes(8));
    $token = random_bytes(32);

    $url = "localhost:8080/phpractice 3/create-new-password.php?selector=". $selector . "&validator=" . bin2hex($token);


    $expires = date("U") + 1800;

    require 'dbh.inc.php';

    $userEmail = $_POST["email"];

    $sql = "DELETE from  pwdreset WHERE pwdResetEmail =?;";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){
        echo "There was an error!";
        exit();
    }
    else{
        mysqli_stmt_bind_param($stmt,"s", $userEmail);
        mysqli_stmt_execute($stmt);
    }

    $sql = "INSERT INTO pwdreset (pwdResetEmail, pwdResetSelector, pwdResetToken, pwdResetExpires) VALUES (?,?,?,?);";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){
        echo "There was an error!";
        exit();
    }
    else{
        $hashedToken = password_hash($token,PASSWORD_DEFAULT);
        mysqli_stmt_bind_param($stmt,"ssss", $userEmail, $selector, $hashedToken, $expires);
        mysqli_stmt_execute($stmt);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    $to = $userEmail;

    $mail->Subject = 'Mr. Resetti has arrived';

    $mail->Body = '<p>Do you wish to reset your password? </p><p>Please follow this link to proceed: </br><a href="'.$url.'">'.$url.'</a></p>';

    $mail->AddAddress($userEmail);
    
    $mail->Send();

    header("Location: ../reset-password.php?reset=success");

}else{
    header("Location:../index.php");
}
<?php

if(isset($_POST['submit']))
{
    //grap data //
    $email =  $_POST['email'];
    $password = $_POST['password'];

    // echo $name . " ". $email. " ". $password . " " . $re_password;
    // die();
    //sign up controller
    include "../classes/dbh.classes.php";
    include "../classes/login.classes.php";
    include "../classes/login.controller.php";

    $signup = new loginController($email,$password);

    //run
    $signup->LoginUser();

    //redirect back to front

    header("location: ../index.php?error=none");
}


?>
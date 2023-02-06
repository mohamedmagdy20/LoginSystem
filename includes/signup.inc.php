<?php

if(isset($_POST['submit']))
{
    //grap data //
    $name =  $_POST['name'];
    $email =  $_POST['email'];
    $password = $_POST['password'];
    $re_password = $_POST['re_password'];

    // echo $name . " ". $email. " ". $password . " " . $re_password;
    // die();
    //sign up controller
    include "../classes/dbh.classes.php";
    include "../classes/signup.classes.php";
    include "../classes/signup.controller.php";

    $signup = new SignupController($name,$email,$password,$re_password);

    //run
    $signup->signupUser();

    //redirect back to front

    header("location: ../index.php?error=none");
}


?>
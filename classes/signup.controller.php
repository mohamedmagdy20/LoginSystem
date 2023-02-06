<?php

class SignupController extends Signup{
    private $name;
    private $email;
    private $password;
    private $re_password;


    public function __construct($name,$email,$password,$re_password)
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->re_password = $re_password;
    }

    public function signupUser()
    {
        if($this->emptyInput() == false )
        {
            header("location: ../index.php?error=emptyinput");
            exit();
        }

        if($this->invalidName() == false)
        {
            header("location: ../index.php?error=name");
            exit();
        }

        if($this->invalidEmail() == false)
        {
            header("location: ../index.php?error=email");
            exit();
        }

        if($this->pwdMatch() == false)
        {
            header("location: ../index.php?error=passwordmatch");
            exit();
        }

        if($this->UserCheck() == false)
        {
            header("location: ../index.php?error=useroremailtaken");
            exit();
        }

        $this->setUser($this->name,$this->password,$this->email);
    }

    // Validation //
    private function emptyInput()
    {
        $result;
        if(empty($this->name) || empty($this->email) ||empty($this->password) || empty($this->re_password) )
        {
            $result= false;
        }else{
            $result = true;
        }
        return $result;
    }

    private function invalidName()
    {
        $result ;
        if(!preg_match("/^[a-zA-Z0-9]*$/",$this->name))
        {
            $result = false;
        }else{
            $result = true;
        }

        return $result;
    }

    private function invalidEmail()
    {
        $result ;
        if(!filter_var($this->email,FILTER_VALIDATE_EMAIL))
        {
            $result = false;
        }else{
            $result = true;
        }
        return $result;
    }

    private function pwdMatch()
    {
        $result ;
        if($this->password !== $this->re_password)
        {
            $result = false;
        }else{
            $result = true;
        }
        return $result;
    }


    private function UserCheck()
    {
        $result ;
        if(! $this->checkUser($this->name,$this->email))
        {
            $result = false;
        }else{
            $result = true;
        }
        return $result;
    }





}
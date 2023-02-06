<?php

class Signup extends Dbh{



    protected function setUser($name,$password,$email)
    {
        $stmt = $this->connect()->prepare("INSERT INTO users(name,email,password) VALUES(?,?,?)");

        $hashedPwd = password_hash($password,PASSWORD_DEFAULT);

        if(!$stmt->execute(array($name,$email,$hashedPwd)))
        {
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }
        $stmt = null;
    }
    protected function checkUser($name,$email)
    {
        $stmt = $this->connect()->prepare("SELECT name from users Where name = ? OR email = ?");

        if(! $stmt->execute(array($name,$email)))
        {
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }
        $resultCheck;
    
        if($stmt->rowCount() > 0)
        {
            $resultCheck = false;

        }else{
            $resultCheck = true;
        }

        return $resultCheck;
    }
}
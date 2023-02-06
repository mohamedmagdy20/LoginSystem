<?php
class Login extends Dbh{

    protected function getUser($email,$password)
    {

        $stmt = $this->connect()->prepare("SELECT password From users Where email = ? ");

        if(!$stmt->execute(array($email)))
        {
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }

        if($stmt->rowCount() == 0)
        {
            $stmt = null;
            header("location: ../index.php?error=usernotfound");
            exit();
        }

        $passwordHash = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $checkPwd = password_verify($password,$passwordHash[0]['password']);
        if($checkPwd == false)
        {
            header("location: ../index.php?error=wrongpassword");
        }elseif($checkPwd == true)
        {
            $stmt = $this->connect()->prepare("SELECT * From users Where email = ? ");
            if(!$stmt->execute(array($email)))
            {
                $stmt = null;
                header("location: ../index.php?error=stmtfailed");
                exit();
            }

            if($stmt->rowCount() == 0)
            {
                $stmt = null;
                header("location: ../index.php?error=usernotfound");
                exit();
            }
            $user = $stmt->fetchAll(PDO::FETCH_ASSOC);
            // var_dump($user[0]['name']);
            // die();
            session_start();
            $_SESSION['name'] = $user[0]['name'];
            $_SESSION['email'] = $user[0]['email'];

            echo $_SESSION['name'];
            die();

            $stmt = null;
        }
    }

}
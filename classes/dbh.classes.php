<?php

class Dbh{
    protected function connect()
    {
        try{
            // connect 
            $username = "root";
            $password = "";
            $dbh = new PDO('mysql:host=localhost;dbname=profilesystem',$username,$password);
            return $dbh;

        }catch(PDOException $e)
        {
            print "ERROR".$e->getMessage()."<br/>";
            die();
        }
    }
}
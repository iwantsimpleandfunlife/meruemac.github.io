<?php

// Database handler
class Dbh
{
    protected function connect()
    {
        try
        {
            $username = "root";
            $password = "";
            $dbh = new PDO('mysql:host=localhost;dbname=pbts_db', $username, $password);
            return $dbh;
        }
        catch (PDOException $e)
        {
            print "ERROR: " . e->getMessage() . "<br/>";
            die();
        }
    }
}
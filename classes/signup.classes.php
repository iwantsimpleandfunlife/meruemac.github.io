<?php // All database related stuff like query

class Signup extends Dbh
{      
    protected function setUser($username, $email, $password)
    {
        $query = "INSERT INTO users (user_username, user_password, user_email) VALUES (?,?,?);";
        $stmt = $this->connect()->prepare($query);

        $hashedPwd = password_hash($password, PASSWORD_DEFAULT);

        if (!$stmt->execute(array($username, $hashedPwd, $email)))
        {
            $stmt = null;
            header("location: ../signup.php");
            exit();
        }

        $stmt = null;
    }

    protected function checkUser($username, $email)
    {   
        $query = "SELECT user_id FROM users WHERE user_username = ? OR user_email = ?";
        $stmt = $this->connect()->prepare($query);

        if (!$stmt->execute(array($username, $email)))
        {
            $stmt = null;
            header("location: ../signup.php?error=stmtfailed");
            exit();
        }

        $resultCheck;
        if ($stmt->rowCount() > 0)
        {
            $resultCheck = false;
        }else
        {
            $resultCheck = true;
        }

        return $resultCheck;
    }

    
}
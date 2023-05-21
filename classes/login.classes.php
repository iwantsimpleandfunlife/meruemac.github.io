 <?php

class Login extends Dbh
{
    protected function getUser($username, $password)
    {   
        $query = "SELECT user_password FROM users WHERE user_username = ? OR user_email = ?";
        $stmt = $this->connect()->prepare($query);

        if (!$stmt->execute(array($username, $password)))
        {
            $stmt = null;
            header('location: ../login.php?error=stmtfailed');
            exit(); 
        }

        if ($stmt->rowCount() == 0)
        {
            $stmt = null;
            header('location: ../login.php?error=usernotfound');
            exit();
        }

        $pwdHashed = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $checkPwd = password_verify($password, $pwdHashed[0]["user_password"]);

        if ($checkPwd == false)
        {
            $stmt = null;
            header('location: ../login.php?error=wrongpassword');
            exit();
        }elseif ($checkPwd == true)
        {
            $query = "SELECT * FROM users WHERE user_username = ? OR user_email= ? AND user_password = ?";
            $stmt = $this->connect()->prepare($query);

            if (!$stmt->execute(array($username, $username, $password)))
            {
                $stmt = null;
                header('location: ../login.php?error=stmtfailed');
                exit(); 
            }

            if ($stmt->rowCount() == 0)
            {
                $stmt = null;
                header('location: ../login.php?error=usernotfound');
                exit();
            }

            $user = $stmt->fetchAll(PDO::FETCH_ASSOC);

            session_start();
            $_SESSION['userid'] = $user[0]['user_id'];
            $_SESSION['userusername'] = $user[0]['user_username'];

        }
        

        // HOW I DID IT
        // if ($stmt->rowCount > 0)
        // {
        //     $row = $stmt->fetch();
        //     $hashedPassword = $row['user_password'];
        //     $unhashedPassword = password_verify($password, $hashedPassword);

        //     if ($row['user_username'] != $username && $unhashedPassword != $this->password)
        //     {
        //         return false;
        //         $stmt = null;
        //     }else
        //     {
        //         return true;
        //         $stmt = null;
        //     }
        // }
    }

}
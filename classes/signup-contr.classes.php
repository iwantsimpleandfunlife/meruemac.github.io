<?php // If you want to change something inside the database

class SignupContr extends Signup
{   
    private $username;
    private $email;
    private $password;
    private $password_repeat;

    public function __construct($username, $email, $password, $password_repeat)
    {
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->password_repeat = $password_repeat;
    }

    public function signupUser()
    {   
        if ($this->emptyInputs() == false)
        {
            // echo 'Please fill in all fields';
            header('location: ../signup.php?error=emptyinput');
            exit();
        }

        if ($this->invalidUsername() == false)
        {
            // echo 'Invalid username';
            header('location: ../signup.php?error=invalidusername');
            exit();
        }

        if ($this->invalidEmail() == false)
        {
            // echo 'Invalid email';
            header('location: ../signup.php?error=invalidemail');
            exit();
        }

        if ($this->passwordMatch() == false)
        {
            // echo 'Password does not match';
            header('location: ../signup.php?error=passwordmismatch');
            exit();
        }

        if ($this->userExist() == false)
        {
            // echo 'User already exists';
            header('location: ../signup.php?error=alreadyexist');
            exit();
        }

        $this->setUser($this->username, $this->email, $this->password);
    }

    private function emptyInputs()
    {   
        $result;
        if(empty($this->username) || empty($this->email) || empty($this->password) || empty($this->password_repeat))
        {
            $result = false;
        }else{
            $result = true;
        }
        return $result;
    }

    private function invalidUsername()
    {
        $result;
        if (!preg_match("/^[a-zA-Z0-9]*$/", $this->username))
        {
            $result = false;
        }else
        {
            $result = true;
        }
        return $result;
    }

    private function invalidEmail()
    {
        $result;
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL))
        {
            $result = false;
        }else
        {
            $result = true;
        }
        return $result;
    }

    private function passwordMatch()
    {
        $result;
        $password_min = 4;
        $password_max = 13;
        // if ($this->password <= $password_min || $this->password >= $password_max)
        // {
        //     $result = false;
        // }else
        if ($this->password != $this->password_repeat)
        {
            $result = false;
        }else
        {
            $result = true;
        }
        return $result;
    }

    private function userExist()
    {
        $result;
        if (!$this->checkUser($this->username, $this->email))
        {
            $result = false;
        }else
        {
            $result = true;
        }
        return $result;
    }
}
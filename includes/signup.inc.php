<?php
if (isset($_POST['submit']))
{
    // Get the data
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_repeat = $_POST['password_repeat'];

    // Include php files
    include "../classes/dbh.classes.php";
    include "../classes/signup.classes.php";
    include "../classes/signup-contr.classes.php";

    $signup = new SignupContr($username, $email, $password, $password_repeat);

    // Running error handlers and user signup
    $signup->signupUser();

    // Going back to front page
    header('location: ../signup.php?error=none');
}
?>
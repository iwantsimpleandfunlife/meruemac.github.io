<?php
if (isset($_POST['submit']))
{
    // Get the data
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Include php files
    include "../classes/dbh.classes.php";
    include "../classes/login.classes.php";
    include "../classes/login-contr.classes.php";
    $login = new LoginContr($username, $password);
    

    // Running error handlers and user signup
    $login->loginUser();
    

    // Going to home page
    header('location: ../index.php?error=none');
}
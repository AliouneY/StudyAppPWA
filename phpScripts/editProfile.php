<?php
    include "../classes/db.php";
    include "../classes/user.php";
    
    session_start();
    
    $user = $_SESSION['user'];
    
    if(isset($_FILES['newProfilePic']))
    {
        $newPic = $_FILES['newProfilePic'];
        print_r($newPic);
        $user->setProfilePic($newPic);
        echo $user->getSetterMessage();
    }
    if(isset($_POST['new_username']))
    {
        $uname = $_POST['new_username'];
        $user->setName($uname);
        echo $user->getSetterMessage();
    }
    if(isset($_POST['new_email']))
    {
        $email = $_POST['new_email'];
        $user->setEmail($email);
        echo $user->getSetterMessage(); 
    }
    if(isset($_POST['new_password']) && isset($_POST['confirm_password']))
    {
        $password = $_POST['new_password'];
        $confirmPassword = $_POST['confirm_password'];
        
        if($password === $confirmPassword)
        {
            $password = sha1($password);
            $user->setPass($password);
            echo $user->getSetterMessage();
        }
        else
        {
            echo "Passwords don't match";
        }
    }
    if(isset($_POST['new_phone_number']))
    {
        //somehow filter the phone number to make sure the user can't just enter anything
        $phoneNum = $_POST['new_phone_number'];
        $user->setPhoneNum($phoneNum);
        echo $user->getSetterMessage();
    }
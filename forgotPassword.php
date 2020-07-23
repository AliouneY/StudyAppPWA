<?php
    include "classes/db.php";
    
    if(isset($_POST['userEmail']))
    {
        $email = $_POST['userEmail'];
        $newPasswordString = time() . $email;
        $newPassword = sha1($newPasswordString);
        $password = sha1($newPassword);
        
        $db = new DB();
        $query0 = $db->runQuery("UPDATE users SET password = '$password' WHERE email = '$email'");
        $msg = "This is your new password: <br/> " . $newPassword . " <br/> Use it to login, then change your password from the profile page.";
        
        mail($email, "Your New Password", $msg);
        
        header('Locaiton: home.php');
    }
?>
<html>
    <head>
    </head>
    
    <body>
        <form method = "POST" action="">
            <label>Email: </label><input type = "text" placeholder = "example@mail.com" name = "userEmail"></input>
        </form>
    </body>
</html>
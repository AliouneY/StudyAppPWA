<?php
    include "classes/db.php";
    
    session_start();
    
    if(isset($_SESSION['user']))
    {
        header('Location: home.php');
    }
    
    $message = "<script></script>";
    
    if(isset($_POST['submit']))
    {
        if(!empty($_POST['email']) && !empty($_POST['uname']) && !empty($_POST['password']) && !empty($_POST['confirmPassword']))
        {
            $db = new DB();
            $email = $_POST['email'];
            $uname = $_POST['uname'];
            $pass = $_POST['password'];
            $confirmPass = $_POST['confirmPassword'];
            
            if(filter_var($email, FILTER_VALIDATE_EMAIL))
            {
                try
                {
                    $query0 = $db->runQuery("SELECT * FROM users WHERE email = '$email'");
                    
                    if($query0->rowCount() === 0)
                    {
                        try
                        {
                            $query0 = $db->runQuery("SELECT * FROM users WHERE uname = '$uname'");
                            if($query0->rowCount() === 0)
                            {
                                if($pass === $confirmPass)
                                {
                                    $pass = sha1($pass);
                                    
                                    try
                                    {
                                        $query0 = $db->runQuery("SELECT * FROM users WHERE password = '$pass'");
                                        
                                        if($query0->rowCount() === 0)
                                        {
                                            try
                                            {
                                                $query0 = $db->runQuery("INSERT INTO users (email, uname, password) VALUES ('$email', '$uname', '$pass')");
                                                $message = "<script>alert(\"Succesfully Created Account\")</script>";
                                                header('Location: index.php');
                                            }
                                            catch(Exception $e)
                                            {
                                                $message = "<script>alert(\"The following error occurred: \"" . $e->getMessage() . ");</script>";
                                            }
                                        }
                                        else
                                        {
                                            $message = "<script>alert(\"Password Already Exists\")</script>";
                                        }
                                    }
                                    catch(Exception $e)
                                    {
                                        $message = "<script>alert(\"The following error occurred: \"" . $e->getMessage() . ");</script>";
                                    }
                                }
                                else
                                {
                                    $message = "<script>$(\".error\").css({\"display\":\"block\"});$(\".error\").html(\"Passwords Don't Match\");</script>";
                                }
                            }
                            else
                            {
                                $message = "<script>$(\".error\").css({\"display\":\"block\"});$(\".error\").html(\"Username Already Exists\");</script>";
                            }
                        }
                        catch(Exception $e)
                        {
                            $message = "<script>alert(\"The following error occurred: \"" . $e->getMessage() . ");</script>";
                        }
                    }
                    else
                    {
                        $message = "<script>$(\".error\").css({\"display\":\"block\"});$(\".error\").html(\"Email Already Exists.\");</script>";
                    }
                }
                catch(Exception $e)
                {
                    $message = "<script>alert(\"The following error occurred: \"" . $e->getMessage() . ");</script>";
                }
                
            }
            else
            {
                $message = "<script>$(\".error\").css({\"display\":\"block\"});$(\".error\").html(\"Invalid Email\");</script>";
            }
        }
        else
        {
            $message = "<script>$(\".error\").css({\"display\":\"block\"});$(\".error\").html(\"Empty Fields\");</script>";
        }
        unset($db);
    }
?>
<!Doctype html>
<html>
    <head>
        <!--<link media = "screen and (max-device-width: 600px)" href="css/mobileStyle.css" rel = "stylesheet" type="text/css"/>
        <link media = "screen and (max-device-width: 768px)" href="css/tabletStyle.css" rel = "stylesheet" type="text/css"/>
        <link media = "screen and (max-device-width: 1200px)" href="css/laptopStyle.css" rel = "stylesheet" type="text/css"/>
        <link media = "screen and (max-device-width: 1800px)" href="css/desktopStyle.css" rel = "stylesheet" type="text/css"/>-->
        <link rel="stylesheet" type="text/css" href="css/style.css"> 
        <script src = "https://code.jquery.com/jquery-3.3.1.min.js"></script>
    </head>
    
    <body>
        <div class="signupContainer">
            <form id = "signupContainer" method="POST" action="">
                <input type = "text" placeholder = "Email" class = "customizeInput signinInput" name="email"/><br/><br/>
                <input type = "text" placeholder = "Username" class = "customizeInput signinInput" name="uname"/><br/><br/>
                <input type = "password" placeholder = "Password" class = "customizeInput signinInput" name="password"/><br/><br/>
                <input type = "password" placeholder = "Confirm Password" class = "customizeInput signinInput" name="confirmPassword"/><br/><br/>
                <p class = "error"></p><br/><br/>
                <input type = "submit" value = "Sign Up" class = "customizeButton signinInput signinButton" name="submit"/><br/><br/>
                <input type = "button" value = "Cancel" class = "customizeButton signinInput signinButton"/>
            </form>
        </div>
        <?php echo $message;?>
        <script src="js/signup.js"></script>
    </body>
</html>
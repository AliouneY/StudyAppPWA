<?php
    include "classes/db.php";
    include "classes/user.php";
    
    session_start();
    
    if(isset($_SESSION['user']))
    {
        header('Location: home.php');
    }
    
    $message = "<script></script>";
    
    if(isset($_POST['submit']))
    {
        if(!empty($_POST['emailuname']) && !empty($_POST['password']))
        {
            $db = new DB();
            $useremail = $_POST['emailuname'];
            $pass = $_POST['password'];
            $row = NULL;
            $userExists = false;
            
            try
            {
                $query0 = $db->runQuery("SELECT * FROM users WHERE email = '$useremail'");
                if($query0->rowCount() > 0)
                {
                    $userExists = true;
                    $row = $query0->fetch(PDO::FETCH_ASSOC);
                }
                else
                {
                    try
                    {
                        $query0 = $db->runQuery("SELECT * FROM users WHERE uname = '$useremail'");
                        if($query0->rowCount() > 0)
                        {
                            $userExists = true;
                            $row = $query0->fetch(PDO::FETCH_ASSOC);
                        }
                    }
                    catch(Exception $e)
                    {
                        $message = "<script>alert(\"The following error occurred: \" + " . $e->getMessage() . ");</script>";
                    }
                }
            }
            catch(Exception $e)
            {
                $message = "<script>alert(\"The following error occurred: \" + " . $e->getMessage() . ");</script>";
            }
            
            if($userExists)
            {
                $pass = sha1($pass);
                $confirmPass = $row['password'];
                
                if($pass === $confirmPass)
                {
                    try
                    {
                        $user = new User($row['id'], $row['uname'], $row['email'], $row['password'], $row['phone_number'], $row['profile_pic']);
                        $user_id = $user->getId();
                        $user_name = $user->getName();
                        $query0 = $db->runQuery("INSERT INTO logins (user_id, user_name) VALUES ('$user_id', '$user_name')");
                        $_SESSION['user'] = $user;
                        header('Location: home.php');
                    }
                    catch(Exception $e)
                    {
                        $message = "<script>alert(\"The following error occurred: \" + " . $e->getMessage() . ");</script>";
                    }
                }
                else
                {
                    $message = "<script>$(\".error\").css({\"display\":\"block\"});$(\".error\").html(\"Invalid Password\");</script>";
                }
            }
            else
            {
                $message = "<script>$(\".error\").css({\"display\":\"block\"});$(\".error\").html(\"Username or Email Doesn't Exist\");</script>";
            }
            unset($db);
        }
        else
        {
            $message = "<script>$(\".error\").css({\"display\":\"block\"});$(\".error\").html(\"Empty Fields\");</script>";
        }
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
        <div class = "loginContainer">
            <div class="loginBody">
                <div id = "logo">
                    <img src = "images/logo.png"/>
                </div>
                <form id = "loginsContainer" method="POST" action="">
                    <input type = "text" placeholder = "Email/Username" class = "customizeInput loginInput" name = "emailuname"/><br/><br/>
                    <input type = "password" placeholder = "Password" class = "customizeInput loginInput" name = "password"/><br/><br/>
                    <p class = "error"></p>
                    <!--Login with google should exist somewhere-->
                    <input type = "submit" value = "Login" class = "customizeButton loginInput loginButton" name = "submit"/><br/><br/>
                    <input type = "button" value = "Sign Up" class = "customizeButton loginInput loginButton"/><br/><br/>
                    <a href = "forgotPassword.php">Forgot Your Password?</a>
                </form>
            </div>
        </div>
       <?php echo $message;?>
       <script src = "js/login.js"></script>
    </body>
</html>
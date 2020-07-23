<?php
    include "classes/db.php";
    include "classes/user.php";
    
    session_start();
    
    if(!isset($_SESSION['user']))
    {
        header('Location: index.php');
    }
    $message = "<script></script>";
    $user = $_SESSION['user'];
    
    $profilePic = $user->getProfilePic();
    if(isset($_POST['logoutButton']))
    {
        $db = new DB();
        try
        {
            $user_id = $_SESSION['user']->getId();
            $user_name = $_SESSION['user']->getName();
            $query0 = $db->runQuery("INSERT INTO logouts (user_id, user_name) VALUES ('$user_id', '$user_name')");
            
            session_unset();
            session_destroy();
            header('Location: index.php');
        }
        catch(Exception $e)
        {
            $message = "<script>alert(\"The following error occurred: \" + " . $e->getMessage() . ");</script>";
        }
    }
?>
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
        <div class = "container">
            <div id = "header">
                <a href="profile.php"><img class = "homeProfile" src=<?php echo "\"" . $profilePic . "\"";?>/></a> <!--profile pic-->
            </div>
            <div id="bodyContainer">
                <div id = "body"> <!--hub of activity, can have more stuff, start with this-->
                    <div id="bubbleContainer">
                        <div id = "innerBubbleContainer">
                            <div id = "bubble1">
                            </div>
                            <div id = "bubble2">
                            </div>
                        </div>
                    </div><br>
                    <div id="mainButtonContainer">
                        <button class = "customizeButton homeButton" onclick = "window.location.href = 'createGroup.php'"/>Create Group</button><br/>
                        <button class = "customizeButton homeButton"  onclick = "window.location.href = 'joinGroup.php'"/>Join Group</button><br/>
                        <button class = "customizeButton homeButton"  onclick = "window.location.href = 'feedback.php'"/>Feedback</button><br/>
                        <form id = "logoutForm" method="POST" action="">
                            <button type="submit" name = "logoutButton" class = "customizeButton homeButton">Logout</button>
                        </form>
                    </div>
                    <div id = "userGroupContainer"> <!--Swipe functionality should be implemented-->
                    <!--User Joined Study Groups Should Go Here (Ajax CRUD)-->
                    </div>
                </div>
            </div>
        </div>
        <script src = "js/homePage.js"></script>
        <?php echo $message; ?>
    </body>
</html>
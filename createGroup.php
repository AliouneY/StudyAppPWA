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
    
    if(isset($_POST['submit']))
    {
        if(!empty($_POST['class']) && !empty($_POST['location']) && !empty($_POST['max_capacity']) && !empty($_POST['date']) && !empty($_POST['start']))
        {
            $db = new DB();
            $creator = $user->getName();
            $class = $_POST['class'];
            $location = $_POST['location'];
            $max_capacity = $_POST['max_capacity'];
            $date = $_POST['date'];
            $start = $_POST['start'];
            $end = NULL;
            if(classIsValid($class))
            {
                $class = str_replace(" ", "", $class);
                $class = strtoupper($class);
                
                if(!empty($_POST['end']))
                {
                    $end = $_POST['end'];
                }
                
                try
                {
                    $query0 = $db->runQuery("INSERT INTO groups (creator, class, location, max_capacity, date, start, end) VALUES ('$creator', '$class', '$location', '$max_capacity', '$date', '$start', '$end')");
                    $groupId = $db->getLastInsertedId();
                    $userId = $user->getId();
                    $query0 = $db->runQuery("INSERT INTO user_group_bridge (user_id, group_id) VALUES ('$userId', '$groupId')");
                    $message = "<script>alert(\"Successfully Created Group\");</script>";
                }
                catch(Exception $e)
                {
                    $message = "<script>alert(\"The following error occurred: \" + " . $e->getMessage() . ");</script>";
                }
            }
            else
            {
                $message = "<script>alert(\"Invalid Class Name\");</script>";
            }
            unset($db);
        }
        else
        {
            $message = "<script>alert(\"Empty Fields!\");</script>";
        }
    }
    
    function classIsValid($class)
    {
        $classisvalid = false;
        $class = str_replace(" ", "", $class);
        
        if(strlen($class) === 6)
        {
            if(ctype_alpha(substr($class, 0, 3)) && is_numeric(substr($class, 3, 6)))
            {
                $classisvalid = true;
            }
            else
            {
                $classisvalid = false;
            }
        }
        else
        {
            $classisvalid = false;
        }
        
        return $classisvalid;
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
        <div class = "cgContainer">
            <div class = "ad"></div>
            <form id = "cgForm" method = "POST" action = "">
                <input placeholder = "Class" class = "customizeInput cgInput classInput" name="class"/><br/>
                <input placeholder = "Location" id = "location" class = "customizeInput cgInput locationInput" name = "location"/>
                <!--<div id="map"></div>--><br/>
                <input type = "number"  min = "2" placeholder = "Max Capacity" class = "customizeInput cgInput capacityInput" name = "max_capacity"/><br/>
                <div class = "cgContent">
                    <label>Date:</label><br/>
                    <input type = "date" min = <?php echo "\"".date("Y-m-d")."\"";?> value = <?php echo "\"".date("Y-m-d")."\"";?> class = "customizeInput dateInput" name = "date"/>
                </div><br/>
                <div class = "cgContent">
                    <label>Time:</label><br/>
                    <input type = "time" class = "customizeInput timeInput" name = "start"/> - <input type = "time" class = "customizeInput timeInput" name = "end"/>
                </div><br/>
                
                <input type="submit" class ="customizeButton cgButton"  value = "Submit" name = "submit"/><br/>
                <button class = "customizeButton cgButton" name = "cancel">Cancel</button>
            </form>
            <div class="ad"></div>
        </div>
        <script src = "js/createGroup.js"></script>
        <?php echo $message; ?>
    </body>
</html>
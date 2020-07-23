<?php

    include "classes/user.php";
    include "classes/db.php";

    session_start();
    
    $message = "";
    
    if(!isset($_SESSION['user']))
    {
        header('Location: index.php');
    }
    
    $user = $_SESSION['user'];
	
	if(isset($_POST['submit']))
	{
		$feedback = $_POST['feedback'];
        $userId = $user->getId();
		$db = new DB();
        
		$query0 = $db->runQuery("INSERT INTO feedback (user_id, comment, time) VALUES ('$userId', '$feedback', NOW());");
		$message = "<script>alert(\"Feedback successfully sent. Thank you.\");</script>";
	}
?>
<html> <!--Maybe add doctypes later-->
    <head>
        <!--<link media = "screen and (max-device-width: 600px)" href="css/mobileStyle.css" rel = "stylesheet" type="text/css"/>
        <link media = "screen and (max-device-width: 768px)" href="css/tabletStyle.css" rel = "stylesheet" type="text/css"/>
        <link media = "screen and (max-device-width: 1200px)" href="css/laptopStyle.css" rel = "stylesheet" type="text/css"/>
        <link media = "screen and (max-device-width: 1800px)" href="css/desktopStyle.css" rel = "stylesheet" type="text/css"/>-->
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <script src = "https://code.jquery.com/jquery-3.3.1.min.js"></script>
    </head>
    
    <body>
        <form class = "feedbackContainer" action = "" method = "POST">
            <div class="innerContainer">
				<textarea id = "feedback" name = "feedback" placeholder = "Type your feedback here. We greatly appreciate it..."></textarea><br/><br/><br/>
				<input type = "submit" class = "customizeButton fbButton" value = "Submit" name = "submit"></input><br/><br/>
				<input type = "button" class = "customizeButton fbButton" value = "Back" onclick = "location.href = 'home.php'"></input>
            </div>
		</form>
        <?php echo $message; ?>
    </body>
</html>
<?php
    include "../classes/db.php";
    include "../classes/user.php";

    session_start();

    if(isset($_POST['id']))
    {
        $user = $_SESSION['user'];
        $db = new DB();
        $groupid = $_POST['id'];
        $userid = $user->getId();
        
        $db->runQuery("INSERT INTO user_group_bridge (user_id, group_id) VALUES ('$userid', '$groupid')");
        $db->runQuery("UPDATE groups SET num_members = num_members + 1 WHERE id = '$groupid'");
        
        unset($db);
        echo "Successfully Joined Group!";
    }
    else
    {
        echo "Something went wrong...";
    }